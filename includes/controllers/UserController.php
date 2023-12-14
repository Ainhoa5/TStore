<?php
require_once '../models/User.php';
require_once '../config/database.php';
require_once '../classes/UserClass.php';
session_start(); // Start the session at the beginning of your script
class ProductController
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login($email, $password)
{
    // Verificar las credenciales y obtener los datos del usuario
    $user = $this->model->verificarCredenciales($email, $password);
    // Comprobar si se obtuvieron los datos del usuario
    if ($user) {
        // Iniciar la sesión si aún no se ha iniciado
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Crear una instancia de UserClass con los datos del usuario
        $userObj = new UserClass(
            $user['UsuarioID'],
            $user['Nombre'],
            $user['Apellido'],
            $user['Email'],
            $user['Rol'],
            $user['Direccion'],
            $user['Ciudad'],
            $user['Estado'],
            $user['Pais'],
            $user['CodigoPostal']
        );

        // Guardar el objeto usuario en la sesión
        $_SESSION['user'] = $userObj;

        // Devolver true para indicar un inicio de sesión exitoso
        return true;
    }

    // Devolver false si las credenciales no son correctas
    return false;
}



    public function signup($email, $password)
    {
        // Hashear la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Llamar al modelo para guardar los datos del usuario, incluyendo la contraseña hasheada
        return $this->model->createUser($email, $passwordHash);
    }
    public function logout($email, $password)
    {
        // Cerrar sesión.
        session_destroy();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Crear una instancia del modelo y del controlador
        $dbConnection = Database::getInstance()->getConnection();
        $userModel = new User($dbConnection); // Asegúrate de que la clase User esté incluida o cargada
        $controller = new ProductController($userModel);

        // Obtener datos del formulario
        $email = $_POST['email']; // Asegúrate de que 'email' sea el nombre del campo de email en tu formulario
        $password = $_POST['password']; // Asegúrate de que 'password' sea el nombre del campo de contraseña en tu formulario

        // Intentar iniciar sesión
        if ($controller->login($email, $password)) {
            // Redirigir a la página de inicio o panel de usuario
            header("Location: ../../index.php"); // Asegúrate de que la ruta sea correcta
            exit();
        } else {
            // Manejar el error de inicio de sesión
            // Por ejemplo, puedes redirigir a la misma página con un mensaje de error
            // O simplemente mostrar un mensaje de error en esta página
            echo "<pre>";
            echo "error login";
            echo "<pre>";
            exit;
        }
    }
    if (isset($_POST['registrarse'])) {
        // Crear una instancia del modelo y del controlador
        $dbConnection = Database::getInstance()->getConnection();
        $userModel = new User($dbConnection); // Asegúrate de que la clase User esté incluida o cargada
        $controller = new ProductController($userModel);

        // Obtener datos del formulario
        $email = $_POST['email']; // Asegúrate de que 'email' sea el nombre del campo de email en tu formulario
        $password = $_POST['password']; // Asegúrate de que 'password' sea el nombre del campo de contras

        if ($controller->signup($email, $password)) {
            // Redirigir a la página de inicio o panel de usuario
            header("Location: ../../index.php"); // Asegúrate de que la ruta sea correcta
            exit();
        } else {
            // Manejar el error de inicio de sesión
            // Por ejemplo, puedes redirigir a la misma página con un mensaje de error
            // O simplemente mostrar un mensaje de error en esta página
            echo "<pre>";
            echo "sign up";
            echo "<pre>";
            exit;
        }
    }
}
