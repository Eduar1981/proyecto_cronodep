<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $userModel = new User();
            $user = $userModel->authenticate($username, $password);
            if ($user) {
                echo 'Bienvenido ' . htmlspecialchars($user['username']);
            } else {
                $error = 'Credenciales inválidas';
                view('user/login', compact('error'));
            }
        } else {
            view('user/login');
        }
    }
}
