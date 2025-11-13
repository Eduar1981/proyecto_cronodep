<?php
declare(strict_types=1);

spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\' => __DIR__ . '/../app/',
        'Core\\' => __DIR__ . '/../core/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($class, $prefix, $len) !== 0) {
            continue;
        }

        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

$config = require __DIR__ . '/../app/config/config.php';

define('BASE_URL', rtrim($config['app']['base_url'], '/') ?: '/');

templateGlobals(['appName' => $config['app']['name'], 'baseUrl' => BASE_URL]);

\App\Models\Model::init($config['db']);

$router = new \Core\Router();

$routes = require __DIR__ . '/../routes/web.php';
$routes($router);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

function templateGlobals(array $data): void
{
    foreach ($data as $key => $value) {
        $GLOBALS[$key] = $value;
    }
}
