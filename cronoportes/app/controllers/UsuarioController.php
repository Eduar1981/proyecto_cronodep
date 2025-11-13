<?php
namespace App\Controllers;

use App\Models\Club;
use App\Models\Usuario;
use PDOException;

class UsuarioController extends Controller
{
    public function index(): void
    {
        $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = $status === 'created' ? 'Usuario registrado correctamente.' : null;

        $this->view('usuarios/index', [
            'usuarios' => Usuario::all(),
            'message' => $message,
        ]);
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

    public function create(): void
    {
        $this->view('usuarios/create', [
            'data' => $this->defaultData(),
            'errors' => [],
            'roles' => Usuario::roles(),
            'clubs' => Club::options(),
        ]);
    }

    public function store(): void
    {
        $input = [
            'id_club' => $_POST['id_club'] ?? null,
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'tipo_documento' => trim($_POST['tipo_documento'] ?? ''),
            'documento' => trim($_POST['documento'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'clave' => $_POST['clave'] ?? '',
            'rol' => trim($_POST['rol'] ?? ''),
            'fecha_nacimiento' => trim($_POST['fecha_nacimiento'] ?? ''),
            'tipo_sangre' => trim($_POST['tipo_sangre'] ?? ''),
            'celular' => trim($_POST['celular'] ?? ''),
            'estado' => trim($_POST['estado'] ?? 'activo'),
            'documento_operador' => trim($_POST['documento_operador'] ?? ''),
        ];

        $errors = [];
        $roles = Usuario::roles();

        $clubId = filter_var($input['id_club'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: null;

        if ($input['nombres'] === '') {
            $errors['nombres'] = 'Los nombres son obligatorios.';
        }

        if ($input['apellidos'] === '') {
            $errors['apellidos'] = 'Los apellidos son obligatorios.';
        }

        if ($input['documento'] === '') {
            $errors['documento'] = 'El documento es obligatorio.';
        }

        if ($input['correo'] === '') {
            $errors['correo'] = 'El correo es obligatorio.';
        } elseif (!filter_var($input['correo'], FILTER_VALIDATE_EMAIL)) {
            $errors['correo'] = 'Ingresa un correo válido.';
        }

        if ($input['clave'] === '') {
            $errors['clave'] = 'La clave es obligatoria.';
        }

        if (!in_array($input['rol'], $roles, true)) {
            $errors['rol'] = 'Selecciona un rol válido.';
        }

        if ($input['estado'] === '' || !in_array($input['estado'], ['activo', 'inactivo'], true)) {
            $input['estado'] = 'activo';
        }

        if ($input['fecha_nacimiento'] !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $input['fecha_nacimiento'])) {
            $errors['fecha_nacimiento'] = 'La fecha debe tener el formato AAAA-MM-DD.';
        }

        if ($errors) {
            $input['id_club'] = $clubId ? (string) $clubId : '';
            $this->view('usuarios/create', [
                'data' => array_merge($this->defaultData(), $input),
                'errors' => $errors,
                'roles' => $roles,
                'clubs' => Club::options(),
            ]);
            return;
        }

        $payload = [
            'id_club' => $clubId,
            'nombres' => $input['nombres'],
            'apellidos' => $input['apellidos'],
            'tipo_documento' => $input['tipo_documento'] ?: null,
            'documento' => $input['documento'],
            'correo' => $input['correo'],
            'clave' => password_hash($input['clave'], PASSWORD_BCRYPT),
            'rol' => $input['rol'],
            'fecha_nacimiento' => $input['fecha_nacimiento'] ?: null,
            'tipo_sangre' => $input['tipo_sangre'] ?: null,
            'celular' => $input['celular'] ?: null,
            'estado' => $input['estado'],
            'documento_operador' => $input['documento_operador'] ?: null,
        ];

        try {
            Usuario::create($payload);
        } catch (PDOException $e) {
            $this->view('usuarios/create', [
                'data' => array_merge($this->defaultData(), $input, ['id_club' => $clubId ? (string) $clubId : '']),
                'errors' => ['general' => 'No fue posible registrar el usuario. Verifica la información e intenta nuevamente.'],
                'roles' => $roles,
                'clubs' => Club::options(),
            ]);
            return;
        }

        $this->redirect('/usuarios', ['status' => 'created']);
    }

    private function defaultData(): array
    {
        return [
            'id_club' => '',
            'nombres' => '',
            'apellidos' => '',
            'tipo_documento' => '',
            'documento' => '',
            'correo' => '',
            'clave' => '',
            'rol' => 'deportista',
            'fecha_nacimiento' => '',
            'tipo_sangre' => '',
            'celular' => '',
            'estado' => 'activo',
            'documento_operador' => '',
        ];
    }
}
