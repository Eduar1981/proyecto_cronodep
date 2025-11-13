<?php
namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index(): void
    {
        $usuarios = Usuario::all();
        $this->view('usuarios/index', ['usuarios' => $usuarios]);
    }

    public function show(int $id): void
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            http_response_code(404);
            echo 'Usuario no encontrado';
            return;
        }

        $this->view('usuarios/show', ['usuario' => $usuario]);
    }
}
