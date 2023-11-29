<?php
class User
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function verificarCredenciales($email, $password) {
        // Preparar la consulta SQL para obtener el usuario y su rol
        $query = "SELECT u.UsuarioID, u.UPassword, r.RoleName FROM Usuarios u
                  LEFT JOIN UsuarioRoles ur ON u.UsuarioID = ur.UserID
                  LEFT JOIN Roles r ON ur.RoleID = r.RoleID
                  WHERE u.Email = ?";

        // Preparar el statement
        $stmt = $this->db->prepare($query);

        // Vincular parámetros
        $stmt->bind_param("s", $email);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verificar si el usuario existe y si la contraseña es correcta
        if ($user && password_verify($password, $user['UPassword'])) {
            // Retornar el nombre del rol si las credenciales son correctas
            return $user['RoleName'];
        }

        // Retornar false si las credenciales no son correctas
        return false;
    }
    function verifyAdmin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
            header('Location: login.php'); // Redirige al login
            exit();
        }
    }
    public function getUserRole()
    {
    }



}
