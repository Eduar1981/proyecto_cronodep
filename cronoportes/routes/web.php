<?php
use App\Controllers\HomeController;
use App\Controllers\UsuarioController;
use App\Controllers\ClubController;

return function (Core\Router $router) {
    $router->get('/', [new HomeController(), 'index']);
    $router->get('/usuarios', [new UsuarioController(), 'index']);
    $router->get('/usuarios/{id}', [new UsuarioController(), 'show']);
    $router->get('/clubs', [new ClubController(), 'index']);
};
