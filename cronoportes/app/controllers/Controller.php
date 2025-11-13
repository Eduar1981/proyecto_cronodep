<?php
namespace App\Controllers;

class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data);
        $contentFile = __DIR__ . '/../views/' . $template . '.php';
        if (!file_exists($contentFile)) {
            http_response_code(404);
            echo 'Vista no encontrada';
            return;
        }

        include __DIR__ . '/../views/layouts/main.php';
    }
}
