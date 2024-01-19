<!-- In /app/models/User.php -->
<?php
class User
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function verificarCredenciales($fields) {
    
        // Preparar la consulta SQL para obtener el usuario y su rol
        $query = "SELECT * FROM Usuarios WHERE Email = :email";
    
        // Preparar el statement
        $stmt = $this->db->prepare($query);
    
        // Vincular parámetros
        $stmt->bindParam(':email', $fields['email']);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener los resultados
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si el usuario existe y si la contraseña es correcta
        if ($user && password_verify($fields['password'], $user['UPassword'])) {
            // Retornar el nombre del rol si las credenciales son correctas
            return true;
        }
    
        // Retornar false si las credenciales no son correctas
        return false;
    }
    

    
    public function createUser($fields) {
        // Ensure all required fields are set and valid
        if (empty($fields['email']) || empty($fields['password'])) {
            // Handle the case where necessary fields are not provided
            return false;
        }
    
        // Assuming 'password' field holds the hashed password
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
    }
    
    public function getUserInfoByEmail($email) {
        $query = "SELECT UsuarioID, Rol FROM Usuarios WHERE Email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function emailExists($email) {
        $query = "SELECT COUNT(*) FROM Usuarios WHERE Email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Fetch the count result
        $count = $stmt->fetchColumn();

        return $count > 0;
    }
}