<?php
namespace App\Middleware;

class AuthMiddleware
{
    public static function handle(array $roles, callable $next): callable
    {
        return function (...$params) use ($roles, $next) {
            if (!isset($_SESSION['usuario'])) {
                header('Location: ' . route('/login'));
                exit;
            }

            if ($roles && !in_array($_SESSION['rol'] ?? null, $roles, true)) {
                http_response_code(403);
                echo 'No tienes permiso para acceder a esta sección.';
                return;
            }

            return $next(...$params);
        };
    }

    public static function requireAuth(callable $next): callable
    {
        return self::handle([], $next);
    }
}
