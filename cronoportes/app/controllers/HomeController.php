<?php
namespace App\Controllers;

use App\Models\Club;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'clubsRegistrados' => Club::countAll(),
        ]);
    }

    public function dashboard(): void
    {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect('/login');
        }

        $rol = $_SESSION['rol'] ?? '';
        $view = $this->dashboardView($rol);

        $data = [
            'usuario' => $_SESSION['usuario'],
            'rol' => $rol,
        ];

        if (in_array($rol, ['superadmin', 'admin'], true)) {
            $data['usuarios'] = Usuario::all();
            $data['clubs'] = Club::all();
        }

        $this->view($view, $data);
    }

    private function dashboardView(string $rol): string
    {
        return match ($rol) {
            'superadmin' => 'dashboard/superadmin',
            'admin' => 'dashboard/admin',
            default => 'dashboard/deportista',
        };
    }
}
