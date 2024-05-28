<?php

namespace Metinbaris\Vero\Controllers;

abstract class Controller
{
    public function view(string $name, array $data = [])
    {
        $viewPath = __DIR__ . '/../Views/' . strtolower($name) . '.php';

        if (file_exists($viewPath)) {
            extract($data);
            require $viewPath;
        } else {
            die('View file not found');
        }
    }
}