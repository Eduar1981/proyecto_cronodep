<?php
namespace App\Models;

use PDO;
use PDOException;

class Model
{
    protected static PDO $connection;

    public static function init(array $config): void
    {
        if (isset(self::$connection)) {
            return;
        }

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['database'],
            $config['charset']
        );

        try {
            self::$connection = new PDO($dsn, $config['username'], $config['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            throw new PDOException('Error al conectar con la base de datos: ' . $e->getMessage());
        }
    }

    protected static function db(): PDO
    {
        if (!isset(self::$connection)) {
            throw new PDOException('La conexión a la base de datos no se ha inicializado.');
        }

        return self::$connection;
    }
}
