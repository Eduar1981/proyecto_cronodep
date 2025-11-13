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

    protected function redirect(string $path, array $query = []): void
    {
        $url = $this->url($path, $query);
        header('Location: ' . $url);
        exit;
    }

    protected function url(string $path, array $query = []): string
    {
        $normalized = $this->normalizePath($path);
        $baseUrl = $GLOBALS['baseUrl'] ?? '/';
        $url = ($baseUrl === '/' || $baseUrl === '') ? $normalized : rtrim($baseUrl, '/') . $normalized;

        if (!empty($query)) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        return $url;
    }

    private function normalizePath(string $path): string
    {
        $trimmed = trim($path);
        if ($trimmed === '' || $trimmed === '/') {
            return '/';
        }

        return '/' . ltrim($trimmed, '/');
    }
}
