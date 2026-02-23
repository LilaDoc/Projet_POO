<?php

namespace App\Infrastructure;

use PDO;
use PDOException;
use RuntimeException;

class DbConnection
{
    private static $instance = null;
    private PDO $pdo;
    private static $properties = null;
    private const ENV_PATH = __DIR__ . '/../../.env';

    private function __construct() {

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $this->pdo = new PDO(
                self::$properties["dsn"], 
                self::$properties["user"],
                self::$properties["pass"],
                $options
            );
            
            // à remplacer par une vrai classe de log
            echo "Database connection established.\n";
        } catch (PDOException $e) {
            throw new RuntimeException("Database connection failed.");
        }     
    }

    private static function setProperties() {
        if (self::$properties === null) {

            $env = file_exists(self::ENV_PATH) 
                ? parse_ini_file(self::ENV_PATH) : die("File .env not found !");
            
            self::$properties = [
                'dsn' => "mysql:host={$env["DB_HOST"]};dbname={$env["DB_NAME"]};charset={$env["DB_CHARSET"]}",
                'user' => $env["DB_USER"],
                'pass' => $env["DB_PASS"]
            ];
        }
    }

    public static function getInstance() {

        if (self::$instance === null) {
            self::setProperties();
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    public function getPdo() : PDO {
        return $this->pdo;
    }
}
?>