<?php
require_once 'Model.php';

class User extends Model {
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $stmt->execute([$username, md5($password)]);
        return $stmt->fetch();
    }
}
