<?php
use App\Controllers\AuthController;
use App\Controllers\ClubController;
use App\Controllers\HomeController;
use App\Controllers\UsuarioController;
use App\Middleware\AuthMiddleware;

return function (Core\Router $router) {
    $home = new HomeController();
    $auth = new AuthController();
    $usuarios = new UsuarioController();
    $clubs = new ClubController();

    $router->get('/', [$home, 'index']);
    $router->get('/login', [$auth, 'login']);
    $router->post('/login', [$auth, 'auth']);
    $router->post('/logout', [$auth, 'logout']);
    $router->get('/register-club', [$auth, 'registerClub']);
    $router->post('/register-club', [$auth, 'storeClub']);

    $router->get('/dashboard', AuthMiddleware::requireAuth([$home, 'dashboard']));

    $router->get('/usuarios', AuthMiddleware::handle(['superadmin', 'admin'], [$usuarios, 'index']));
    $router->get('/usuarios/crear', AuthMiddleware::handle(['superadmin', 'admin'], [$usuarios, 'create']));
    $router->post('/usuarios', AuthMiddleware::handle(['superadmin', 'admin'], [$usuarios, 'store']));
    $router->get('/usuarios/{id}', AuthMiddleware::handle(['superadmin', 'admin'], [$usuarios, 'show']));

    $router->get('/clubs', AuthMiddleware::handle(['superadmin', 'admin'], [$clubs, 'index']));
    $router->get('/clubs/crear', AuthMiddleware::handle(['superadmin'], [$clubs, 'create']));
    $router->post('/clubs', AuthMiddleware::handle(['superadmin'], [$clubs, 'store']));
};
