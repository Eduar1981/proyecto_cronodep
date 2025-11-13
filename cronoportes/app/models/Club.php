<?php
namespace App\Models;

class Club extends Model
{
    protected static string $table = 'clubs';

    public static function all(): array
    {
        $stmt = self::db()->query('SELECT * FROM ' . self::$table . ' ORDER BY nombre_club');
        return $stmt->fetchAll();
    }

    public static function options(): array
    {
        $stmt = self::db()->query('SELECT id_club, nombre_club FROM ' . self::$table . ' WHERE estado = "activo" ORDER BY nombre_club');
        return $stmt->fetchAll();
    }

    public static function create(array $data): int
    {
        $sql = 'INSERT INTO ' . self::$table . ' (nombre_club, correo_contacto, telefono_contacto, direccion, estado, documento_operador)'
            . ' VALUES (:nombre_club, :correo_contacto, :telefono_contacto, :direccion, :estado, :documento_operador)';

        $stmt = self::db()->prepare($sql);

        $stmt->execute([
            'nombre_club' => $data['nombre_club'],
            'correo_contacto' => $data['correo_contacto'],
            'telefono_contacto' => $data['telefono_contacto'],
            'direccion' => $data['direccion'],
            'estado' => $data['estado'],
            'documento_operador' => $data['documento_operador'],
        ]);

        return (int) self::db()->lastInsertId();
    }

    public static function countAll(): int
    {
        $stmt = self::db()->query('SELECT COUNT(*) AS total FROM ' . self::$table);
        $row = $stmt->fetch();

        return (int) ($row['total'] ?? 0);
    }

    public static function deleteById(int $id): void
    {
        $stmt = self::db()->prepare('DELETE FROM ' . self::$table . ' WHERE id_club = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
    }
}
