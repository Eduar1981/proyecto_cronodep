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
}
