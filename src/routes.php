<?php

use Metinbaris\Vero\Controllers\DatasetController;
use Metinbaris\Vero\Services\DatasetService;
use Metinbaris\Vero\Cache\RedisCache;
use Predis\Client;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Main route
if ($uri === "/") {
    $redisClient = new Client([
        'scheme' => 'tcp',
        'host'   => 'redis',
        'port'   => 6379,
    ]);
    $cache = new RedisCache($redisClient);
    $datasetService = new DatasetService($cache);    
    $datasetController = new DatasetController($datasetService);
    
    $datasetController->index();
} else {
    // Route not found
    http_response_code(404);
    echo "404 Not Found";
    exit;
}
