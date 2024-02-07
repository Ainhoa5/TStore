<?php 
namespace Config;
// config/database.php

class Database {
    private static $host;
    private static $db_name;
    private static $username;
    private static $password;
    private static $conn;

    public static function connect() {
        if (!self::$conn) {
            self::$host = $_ENV['DB_HOST'];
            self::$db_name = $_ENV['DB_DB'];
            self::$username = $_ENV['DB_USER'];
            self::$password = $_ENV['DB_PASS'];

            try {
                self::$conn = new \PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // Assuming Functions is a class with a static method logError
                Functions::logError($e->getMessage());
                // It's a good practice to throw an exception so it can be handled by the caller
                return null; // or false
            }
        }
        return self::$conn;
    }
}

?>
