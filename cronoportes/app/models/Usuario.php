<?php
namespace App\Models;

class Usuario extends Model
{
    protected static string $table = 'usuarios';

    public static function all(): array
    {
        $sql = 'SELECT u.*, c.nombre_club FROM ' . self::$table . ' u
                LEFT JOIN clubs c ON u.id_club = c.id_club
                ORDER BY u.nombres, u.apellidos';
        $stmt = self::db()->query($sql);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $sql = 'SELECT u.*, c.nombre_club FROM ' . self::$table . ' u
                LEFT JOIN clubs c ON u.id_club = c.id_club
                WHERE u.id_usuario = :id LIMIT 1';
        $stmt = self::db()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }
}
