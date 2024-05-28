<?php

use Metinbaris\Vero\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
new Dotenv(__DIR__ . '/.env');
require_once __DIR__ . '/src/routes.php';