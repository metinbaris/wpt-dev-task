<?php

namespace Metinbaris\Vero\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Metinbaris\Vero\Cache\RedisCache;

class DatasetService
{
    const CONSTANT_BASE_URI = "https://api.baubuddy.de";
    const CONSTANT_CACHE_DURATION_SECONDS = 3600;

    public function __construct(private RedisCache $cache, private Client $client)
    {
        $this->authorize();
    }

    protected function authorize(): void
    {
        if ($this->isAccessTokenValid()) {
            return;
        }

        try {
            $accessTokenResponse = $this->getAccessTokenResponse();
            $this->storeAccessToken($accessTokenResponse);
        } catch (GuzzleException $e) {
            error_log("Error occured on " . self::class . $e->getMessage());
        }
    }

    protected function isAccessTokenValid(): bool
    {
        $accessTokenCacheKey = 'baubuddy_oauth_' . self::cacheValue();
        $cacheValue = $this->cache->get($accessTokenCacheKey);

        if ($cacheValue === null) {
            return false;
        }

        return true;
    }

    private function getAccessTokenResponse()
    {
        $response = $this->client->post('/index.php/login', [
            'json' => [
                'username' => $_ENV['BAUBUDDY_USERNAME'],
                'password' => $_ENV['BAUBUDDY_PASSWORD']
            ],
            'headers' => [
                'Authorization' => 'Basic ' . $_ENV['BAUBUDDY_BASIC_TOKEN']
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    protected function storeAccessToken($accessTokenResponse)
    {
        $accessTokenCacheKey = 'baubuddy_oauth_' . self::cacheValue();
        $this->cache->set($accessTokenCacheKey, $accessTokenResponse->oauth, $accessTokenResponse->oauth->expires_in);
    }

    public function getDataset()
    {
        $dataset = $this->cache->get('baubuddy_dataset_' . self::cacheValue());
        if ($dataset !== null) {
            return $dataset;
        }

        try {
            $response = $this->getTaskSelectResponse();
            $this->cache->set('baubuddy_dataset_' . self::cacheValue(), $response, self::CONSTANT_CACHE_DURATION_SECONDS);

            return $response;
        } catch (GuzzleException $e) {
            error_log("Error occured on " . self::class . $e->getMessage());
            throw $e;
        }
    }

    private function getTaskSelectResponse()
    {
        $response = $this->client->get("/dev/index.php/v1/tasks/select", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->cache->get('baubuddy_oauth_' . self::cacheValue())->access_token
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    private static function cacheValue(): string
    {
        return md5($_ENV['BAUBUDDY_BASIC_TOKEN'] . $_ENV['BAUBUDDY_USERNAME'] . $_ENV['BAUBUDDY_PASSWORD']);
    }
}
