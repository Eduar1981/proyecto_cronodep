<?php
namespace App\Models;

class Usuario extends Model
{
    protected static string $table = 'usuarios';

    public static function all(): array
    {
        $sql = 'SELECT u.*, c.nombre_club FROM ' . self::$table . ' u'
            . ' LEFT JOIN clubs c ON u.id_club = c.id_club'
            . ' ORDER BY u.nombres, u.apellidos';
        $stmt = self::db()->query($sql);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $sql = 'SELECT u.*, c.nombre_club FROM ' . self::$table . ' u'
            . ' LEFT JOIN clubs c ON u.id_club = c.id_club'
            . ' WHERE u.id_usuario = :id LIMIT 1';
        $stmt = self::db()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public static function roles(): array
    {
        return ['superadmin', 'admin', 'instructor', 'deportista', 'acudiente', 'tesorero'];
    }

    public static function create(array $data): int
    {
        $sql = 'INSERT INTO ' . self::$table
            . ' (id_club, nombres, apellidos, tipo_documento, documento, correo, clave, rol, fecha_nacimiento, tipo_sangre, celular, estado, documento_operador)'
            . ' VALUES (:id_club, :nombres, :apellidos, :tipo_documento, :documento, :correo, :clave, :rol, :fecha_nacimiento, :tipo_sangre, :celular, :estado, :documento_operador)';

        $stmt = self::db()->prepare($sql);

        $stmt->execute([
            'id_club' => $data['id_club'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'tipo_documento' => $data['tipo_documento'],
            'documento' => $data['documento'],
            'correo' => $data['correo'],
            'clave' => $data['clave'],
            'rol' => $data['rol'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'tipo_sangre' => $data['tipo_sangre'],
            'celular' => $data['celular'],
            'estado' => $data['estado'],
            'documento_operador' => $data['documento_operador'],
        ]);

        return (int) self::db()->lastInsertId();
    }
}
