<?php
namespace App\Models;

// In /app/models/User.php

/**
 * Modelo de usuario para manejar las operaciones de la base de datos relacionadas con los usuarios.
 *
 * Este modelo proporciona funcionalidades para verificar credenciales de usuario,
 * crear nuevos usuarios, y obtener información de usuario específica.
 */
class User
{
    /**
     * Instancia de la base de datos para realizar operaciones de base de datos.
     *
     * @var \PDO
     */
    protected $db;

    /**
     * Constructor del modelo de usuario.
     *
     * @param \PDO $db Instancia de la conexión a la base de datos.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Verifica las credenciales de inicio de sesión del usuario.
     *
     * @param array $fields Contiene los campos 'email' y 'password' para autenticación.
     * @return bool Retorna true si las credenciales son correctas, de lo contrario false.
     */
    public function verificarCredenciales($fields)
    {
        try {
            // Preparar la consulta SQL para obtener el usuario y su rol
            $query = "SELECT * FROM Usuarios WHERE Email = :email";

            // Preparar el statement
            $stmt = $this->db->prepare($query);

            // Vincular parámetros
            $stmt->bindParam(':email', $fields['email']);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            // Verificar si el usuario existe y si la contraseña es correcta
            if ($user && password_verify($fields['password'], $user['UPassword'])) {
                // Retornar el nombre del rol si las credenciales son correctas
                return true;
            }

            // Retornar false si las credenciales no son correctas
            return false;
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }


    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @param array $fields Contiene los campos necesarios para crear el usuario, incluyendo 'email' y 'password'.
     * @return bool Retorna true si el usuario es creado con éxito, de lo contrario false.
     */
    public function createUser($fields)
    {
        try {
            // Ensure all required fields are set and valid
            if (empty($fields['email']) || empty($fields['password'])) {
                // Handle the case where necessary fields are not provided
                return false;
            }

            // 'password' field holds the hashed password
            $email = $fields['email'];
            $passwordHash = $fields['password'];

            // Additional fields can be added here as needed

            // Prepare the SQL query to insert the new user
            $query = "INSERT INTO Usuarios (Email, UPassword) VALUES (:email, :password)";

            // Prepare and execute the query
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->execute();

            // Check if the insertion was successful
            if ($stmt->rowCount() > 0) {
                return true; // User created successfully
            }
            return false; // Error creating the user
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }
    }

    /**
     * Obtiene la información de usuario por email.
     *
     * @param string $email El email del usuario para buscar su información.
     * @return array|false Retorna un array asociativo con la información del usuario o false en caso de error.
     */
    public function getUserInfoByEmail($email)
    {
        try {
            $query = "SELECT UsuarioID, Rol FROM Usuarios WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    /**
     * Verifica si el email ya existe en la base de datos.
     *
     * @param string $email El email a verificar.
     * @return bool Retorna true si el email ya existe, de lo contrario false.
     */
    public function emailExists($email)
    {
        try {
            $query = "SELECT COUNT(*) FROM Usuarios WHERE Email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Fetch the count result
            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }
}