<?php
namespace App\Controllers;

use App\Models\Club;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function index(): void
    {
        $usuarios = Usuario::all();
        $clubs = Club::all();

        $this->view('home/index', [
            'usuarios' => $usuarios,
            'clubs' => $clubs,
        ]);
    }
}
