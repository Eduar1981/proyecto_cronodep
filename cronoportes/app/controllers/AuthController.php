<?php
namespace App\Controllers;

use App\Models\Club;
use App\Models\Usuario;
use PDOException;

class AuthController extends Controller
{
    public function login(): void
    {
        if (isset($_SESSION['usuario'])) {
            $this->redirect($this->redirectRoute($_SESSION['rol'] ?? ''));
        }

        $clubsRegistrados = Club::countAll();
        if ($clubsRegistrados === 0) {
            $this->redirect('/register-club');
        }

        $this->view('auth/login', [
            'data' => ['correo' => '', 'clubs_registrados' => $clubsRegistrados],
            'errors' => [],
        ]);
    }

    public function auth(): void
    {
        $correo = trim($_POST['correo'] ?? '');
        $clave = $_POST['clave'] ?? '';

        $errors = [];
        if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errors['correo'] = 'Ingresa un correo válido.';
        }

        if ($clave === '') {
            $errors['clave'] = 'Ingresa tu contraseña.';
        }

        if ($errors) {
            $this->view('auth/login', [
                'data' => ['correo' => $correo, 'clubs_registrados' => Club::countAll()],
                'errors' => $errors,
            ]);
            return;
        }

        if (Club::countAll() === 0) {
            $this->redirect('/register-club');
        }

        $usuario = Usuario::findByCorreo($correo);
        if (!$usuario || !password_verify($clave, $usuario['clave'])) {
            $this->view('auth/login', [
                'data' => ['correo' => $correo, 'clubs_registrados' => Club::countAll()],
                'errors' => ['general' => 'Credenciales incorrectas.'],
            ]);
            return;
        }

        $_SESSION['usuario'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombres'] . ' ' . $usuario['apellidos'],
            'correo' => $usuario['correo'],
            'id_club' => $usuario['id_club'],
        ];
        $_SESSION['rol'] = $usuario['rol'];

        $this->redirect($this->redirectRoute($usuario['rol']));
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();

        $this->redirect('/login');
    }

    public function registerClub(): void
    {
        if (isset($_SESSION['usuario'])) {
            $this->redirect($this->redirectRoute($_SESSION['rol'] ?? ''));
        }

        if (Club::countAll() > 0) {
            $this->redirect('/login');
        }

        $this->view('auth/register_club', [
            'data' => $this->defaultClubData(),
            'errors' => [],
        ]);
    }

    public function storeClub(): void
    {
        if (isset($_SESSION['usuario'])) {
            $this->redirect($this->redirectRoute($_SESSION['rol'] ?? ''));
        }

        if (Club::countAll() > 0) {
            $this->redirect('/login');
        }

        $input = [
            'nombre_club' => trim($_POST['nombre_club'] ?? ''),
            'correo_contacto' => trim($_POST['correo_contacto'] ?? ''),
            'telefono_contacto' => trim($_POST['telefono_contacto'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'documento_operador' => trim($_POST['documento_operador'] ?? ''),
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'documento' => trim($_POST['documento'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'clave' => $_POST['clave'] ?? '',
            'confirmacion' => $_POST['confirmacion'] ?? '',
        ];

        $errors = [];

        if ($input['nombre_club'] === '') {
            $errors['nombre_club'] = 'El nombre del club es obligatorio.';
        }

        if ($input['correo_contacto'] !== '' && !filter_var($input['correo_contacto'], FILTER_VALIDATE_EMAIL)) {
            $errors['correo_contacto'] = 'Ingresa un correo de contacto válido.';
        }

        if ($input['nombres'] === '') {
            $errors['nombres'] = 'Ingresa los nombres del responsable.';
        }

        if ($input['apellidos'] === '') {
            $errors['apellidos'] = 'Ingresa los apellidos del responsable.';
        }

        if ($input['documento'] === '') {
            $errors['documento'] = 'El documento del responsable es obligatorio.';
        }

        if ($input['correo'] === '' || !filter_var($input['correo'], FILTER_VALIDATE_EMAIL)) {
            $errors['correo'] = 'Ingresa un correo de acceso válido.';
        }

        if ($input['clave'] === '') {
            $errors['clave'] = 'Ingresa una contraseña.';
        } elseif ($input['clave'] !== $input['confirmacion']) {
            $errors['confirmacion'] = 'Las contraseñas no coinciden.';
        }

        if ($errors) {
            $this->view('auth/register_club', [
                'data' => array_merge($this->defaultClubData(), $input),
                'errors' => $errors,
            ]);
            return;
        }

        try {
            $clubId = Club::create([
                'nombre_club' => $input['nombre_club'],
                'correo_contacto' => $input['correo_contacto'] ?: null,
                'telefono_contacto' => $input['telefono_contacto'] ?: null,
                'direccion' => $input['direccion'] ?: null,
                'estado' => 'activo',
                'documento_operador' => $input['documento_operador'] ?: null,
            ]);

            $usuarioId = Usuario::create([
                'id_club' => $clubId,
                'nombres' => $input['nombres'],
                'apellidos' => $input['apellidos'],
                'tipo_documento' => null,
                'documento' => $input['documento'],
                'correo' => $input['correo'],
                'clave' => password_hash($input['clave'], PASSWORD_BCRYPT),
                'rol' => 'superadmin',
                'fecha_nacimiento' => null,
                'tipo_sangre' => null,
                'celular' => null,
                'estado' => 'activo',
                'documento_operador' => $input['documento_operador'] ?: null,
            ]);
        } catch (PDOException $e) {
            if (isset($clubId)) {
                Club::deleteById((int) $clubId);
            }
            $this->view('auth/register_club', [
                'data' => array_merge($this->defaultClubData(), $input),
                'errors' => ['general' => 'No fue posible registrar el club inicial. Intenta nuevamente.'],
            ]);
            return;
        }

        $_SESSION['usuario'] = [
            'id' => $usuarioId,
            'nombre' => $input['nombres'] . ' ' . $input['apellidos'],
            'correo' => $input['correo'],
            'id_club' => $clubId,
        ];
        $_SESSION['rol'] = 'superadmin';

        $this->redirect($this->redirectRoute('superadmin'));
    }

    private function defaultClubData(): array
    {
        return [
            'nombre_club' => '',
            'correo_contacto' => '',
            'telefono_contacto' => '',
            'direccion' => '',
            'documento_operador' => '',
            'nombres' => '',
            'apellidos' => '',
            'documento' => '',
            'correo' => '',
            'clave' => '',
            'confirmacion' => '',
        ];
    }

    private function redirectRoute(string $rol): string
    {
        return match ($rol) {
            'superadmin', 'admin', 'instructor', 'tesorero', 'acudiente', 'deportista' => '/dashboard',
            default => '/',
        };
    }
}
