<?php

use Metinbaris\Vero\Controllers\DatasetController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Main route
if ($uri === "/") {
    $datasetController = new DatasetController();
    $datasetController->index();
} else {
    // Route not found
    http_response_code(404);
    echo "404 Not Found";
    exit;
}
