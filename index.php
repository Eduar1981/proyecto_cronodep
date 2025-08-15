<?php
require_once __DIR__ . '/config/config.php';

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . '/app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerClass();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Action not found';
    }
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'Controller not found';
}
