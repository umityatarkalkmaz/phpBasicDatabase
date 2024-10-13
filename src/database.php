<?php

namespace Umityatarkalkmaz;
use PDO;
use PDOException;
class Database
{
    private static string $host = 'localhost';
    private static string $dbName = 'framework';
    private static string $user = 'root';
    private static string $pass = '';
    private static string $charset = 'utf8mb4';
    private static string $dsn;
    protected PDO $db;

    public function __construct()
    {
        try {
            // new PDO("mysql:host=xxx;port=xxx;dbname=xxx;user=xxx;password=xxx");
            self::$dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$dbName . ';dbname=' . self::$dbName;
            $this->db = new PDO(self::$dsn, self::$user, self::$pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
