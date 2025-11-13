<?php
namespace App\Controllers;

use App\Models\Club;
use PDOException;

class ClubController extends Controller
{
    public function index(): void
    {
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = $status === 'created' ? 'Club registrado correctamente.' : null;

        $this->view('clubs/index', [
            'clubs' => Club::all(),
            'message' => $message,
        ]);
    }

    public function create(): void
    {
        $this->view('clubs/create', [
            'data' => [
                'nombre_club' => '',
                'correo_contacto' => '',
                'telefono_contacto' => '',
                'direccion' => '',
                'estado' => 'activo',
                'documento_operador' => '',
            ],
            'errors' => [],
        ]);
    }

    public function store(): void
    {
        $input = [
            'nombre_club' => trim($_POST['nombre_club'] ?? ''),
            'correo_contacto' => trim($_POST['correo_contacto'] ?? ''),
            'telefono_contacto' => trim($_POST['telefono_contacto'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'estado' => trim($_POST['estado'] ?? 'activo'),
            'documento_operador' => trim($_POST['documento_operador'] ?? ''),
        ];

        $errors = [];

        if ($input['nombre_club'] === '') {
            $errors['nombre_club'] = 'El nombre del club es obligatorio.';
        }

        if ($input['correo_contacto'] !== '' && !filter_var($input['correo_contacto'], FILTER_VALIDATE_EMAIL)) {
            $errors['correo_contacto'] = 'Ingresa un correo electrónico válido.';
        }

        if ($input['estado'] === '' || !in_array($input['estado'], ['activo', 'inactivo'], true)) {
            $input['estado'] = 'activo';
        }

        if ($errors) {
            $this->view('clubs/create', [
                'data' => $input,
                'errors' => $errors,
            ]);
            return;
        }

        $payload = [
            'nombre_club' => $input['nombre_club'],
            'correo_contacto' => $input['correo_contacto'] ?: null,
            'telefono_contacto' => $input['telefono_contacto'] ?: null,
            'direccion' => $input['direccion'] ?: null,
            'estado' => $input['estado'],
            'documento_operador' => $input['documento_operador'] ?: null,
        ];

        try {
            Club::create($payload);
        } catch (PDOException $e) {
            $this->view('clubs/create', [
                'data' => $input,
                'errors' => ['general' => 'No fue posible registrar el club. Verifica la información e intenta nuevamente.'],
            ]);
            return;
        }

        $this->redirect('/clubs', ['status' => 'created']);
    }
}
