<?php

namespace Metinbaris\Vero;

class Dotenv
{
    private array $data = [];

    public function __construct(private string $filePath)
    {
        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->filePath)) {
            throw new \Exception('.env file not found');
        }

        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            [$key, $value] = explode('=', $line, 2);
            $this->data[$key] = $value;
            $_ENV[$key] = $value;
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }
}
