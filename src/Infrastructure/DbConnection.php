<?php

namespace App\Infrastructure;

use PDO;
use PDOException;
use RuntimeException;

class DbConnection
{
    private static $instance = null;
    private $pdo = null;
    private static $properties = null;
    private const ENV_PATH = __DIR__ . '/../../.env';

    public function __construct() {

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        try {
            $pdo = new PDO(
                self::$properties["dsn"], 
                self::$properties["user"],
                self::$properties["pass"],
                $options
            );
        } catch (PDOException $e) {
            throw new RuntimeException("Database connection failed.");
        }     
    }

    public static function getInstance() {

        if (self::$instance === null) {
            echo "instance pdo\n";
            self::setProperties();
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    private static function setProperties() {
        if (self::$properties === null) {
            echo "init properties\n";

            $env = file_exists(self::ENV_PATH) 
                ? parse_ini_file(self::ENV_PATH) : die("File .env not found !");
            
            self::$properties = [
                'dsn' => "mysql:host={$env["DB_HOST"]};dbname={$env["DB_NAME"]};charset={$env["DB_CHARSET"]}",
                'user' => $env["DB_USER"],
                'pass' => $env["DB_PASS"]
            ];
        }
    }
}
?>