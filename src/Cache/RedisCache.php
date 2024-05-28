<?php

namespace Metinbaris\Vero\Cache;

use Predis\Client;

class RedisCache
{
    protected $redis;

    public function __construct(Client $redis)
    {
        $this->redis = $redis;
    }

    public function set(string $key, $value, int $duration)
    {
        $this->redis->setex($key, $duration, serialize($value));
    }

    public function get(string $key)
    {
        $serializedValue = $this->redis->get($key);

        if ($serializedValue !== null) {
            return unserialize($serializedValue);
        }

        return null;
    }
    
    public function remove(string $key)
    {
        $this->redis->del($key);
    }
}
