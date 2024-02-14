<?php
namespace Config;

// config/database.php


/**
 * Clase Database para la gestión de conexiones a la base de datos.
 *
 * Proporciona una conexión a la base de datos utilizando el patrón Singleton para evitar múltiples conexiones.
 * La configuración de la conexión se obtiene de las variables de entorno.
 */
class Database
{
    /**
     * @var string Host de la base de datos.
     */
    private static $host;

    /**
     * @var string Nombre de la base de datos.
     */
    private static $db_name;

    /**
     * @var string Nombre de usuario para la conexión a la base de datos.
     */
    private static $username;

    /**
     * @var string Contraseña para la conexión a la base de datos.
     */
    private static $password;

    /**
     * @var \PDO|NULL Instancia de la conexión a la base de datos (PDO).
     */
    private static $conn;

    /**
     * Establece una conexión a la base de datos y retorna una instancia de PDO.
     *
     * Utiliza el patrón Singleton para asegurarse de que solo exista una instancia de la conexión.
     * La configuración de la conexión se lee de las variables de entorno.
     *
     * @return \PDO|NULL Retorna una instancia de PDO si la conexión es exitosa, o NULL en caso de error.
     */
    public static function connect()
    {
        if (!self::$conn) {
            self::$host = $_ENV['DB_HOST'];
            self::$db_name = $_ENV['DB_DB'];
            self::$username = $_ENV['DB_USER'];
            self::$password = $_ENV['DB_PASS'];

            try {
                self::$conn = new \PDO('mysql:host=' . self::$host . ';dbname=' . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                \Config\Functions::logError($e->getMessage());
                return null;
            }
        }
        return self::$conn;
    }
}

?>