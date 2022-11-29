<?php

declare(strict_types=1);

namespace App\Connection;

use PDO;

class DatabaseConnection
{
    public static function abrirConexao(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    }
}

