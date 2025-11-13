<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $action): void
    {
        $this->routes['GET'][$this->normalize($path)] = $action;
    }

    public function post(string $path, callable $action): void
    {
        $this->routes['POST'][$this->normalize($path)] = $action;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';
        $path = $this->normalize($path);

        $routes = $this->routes[$method] ?? [];
        $action = $routes[$path] ?? null;
        $params = [];

        if (!$action) {
            foreach ($routes as $routePath => $routeAction) {
                $pattern = $this->routeToPattern($routePath);
                if (preg_match($pattern, $path, $matches)) {
                    $action = $routeAction;
                    array_shift($matches);
                    $params = array_map(function ($value) {
                        return ctype_digit($value) ? (int) $value : $value;
                    }, $matches);
                    break;
                }
            }
        }

        if (!$action) {
            http_response_code(isset($this->routes[$method]) ? 404 : 405);
            echo isset($this->routes[$method]) ? 'Ruta no encontrada' : 'Método no permitido';
            return;
        }

        call_user_func_array($action, $params);
    }

    private function normalize(string $path): string
    {
        $path = '/' . trim($path, '/');
        return $path === '//' ? '/' : ($path === '/' ? $path : rtrim($path, '/'));
    }

    private function routeToPattern(string $route): string
    {
        $pattern = preg_replace('#\{([^/]+)\}#', '([^/]+)', $route);
        if ($pattern === null) {
            $pattern = $route;
        }
        return '#^' . $pattern . '$#';
    }
}
