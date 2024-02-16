<?php
namespace App\Controllers;

use Config\Functions;

// In /app/controllers/AuthController.php

/**
 * Controlador de autenticación para gestionar las operaciones relacionadas con el usuario.
 *
 * Este controlador maneja las vistas de formulario de autenticación, registro, y la lógica de inicio
 * y cierre de sesión de los usuarios.
 */
class AuthController
{
    /**
     * Modelo de usuario para interactuar con la base de datos de usuarios.
     *
     * @var \App\Models\User
     */
    private $userModel;

    /**
     * Constructor del AuthController.
     *
     * Establece la conexión con la base de datos e inicializa el modelo de usuario.
     */
    public function __construct()
    {
        $db = \Config\Database::connect();
        if (!$db) {
            // Manejar el error de conexión:
            session_start();
            $_SESSION['error'] = 'No se pudo establecer la conexión con la base de datos.';
            header('Location: errorPage'); // redirigir a la página de error genérica
            exit;
        }
        $this->userModel = new \App\Models\User($db);
    }

    /**
     * Muestra el formulario de autenticación para inicio de sesión o registro.
     * @return void
     */
    public function showAuthForm()
    {
        require VIEWS_DIR . 'auth/authForm.php';
    }

    /**
     * Muestra la página de perfil del usuario.
     * @return void
     */
    public function showUserPage()
    {
        require VIEWS_DIR . 'auth/user.php';
    }

    /**
     * Procesa el inicio de sesión del usuario.
     *
     * Este método valida los campos de correo electrónico y contraseña del formulario de inicio de sesión.
     * Si los campos son válidos, verifica las credenciales contra los registros de la base de datos.
     * Si la autenticación es exitosa, almacena la información relevante del usuario en la sesión y
     * redirige al usuario a la página de inicio o dashboard. En caso de error en la validación o 
     * credenciales incorrectas, redirige al usuario de nuevo al formulario de inicio de sesión
     * con mensajes de error adecuados.
     *
     * @uses \Config\Validator para validar los campos del formulario.
     * @uses \App\Models\User::verificarCredenciales() para verificar las credenciales del usuario.
     *
     * @return void No retorna directamente, pero envía al cliente a diferentes rutas basadas en el resultado de la autenticación.
     */
    public function processLogin()
    {
        $validator = new \Config\Validator();

        $fields = [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
        ];
        $rules = [
            'email' => ['isEmpty', 'isValidEmail'],
            'password' => ['isEmpty'],
        ];

        $errors = $validator->validate($fields, $rules);

        // If there are no initial validation errors, proceed to check against the database
        if (empty($errors)) {
            if ($this->userModel->verificarCredenciales($fields)) {
                // Credentials are correct
                $userInfo = $this->userModel->getUserInfoByEmail($fields['email']);
                $userId = $userInfo['UsuarioID'];
                $userRole = $userInfo['Rol'];
                $userEmail = $userInfo['Email'];

                // Store in session
                session_start();
                $_SESSION['user_id'] = $userId;
                $_SESSION['user_role'] = $userRole;
                $_SESSION['user_email'] = $userEmail;
               
            

                // Redirect to the dashboard or appropriate page
                header('Location: ./');
                exit;
            } else {
                // Credentials are incorrect
                $errors['login'] = ['Incorrect email or password'];
            }
        }

        // If there are any errors (either initial validation or credential checking)
        if (!empty($errors)) {
            session_start();
            $_SESSION['validation_errors'] = $errors;
            header('Location: authForm'); // Redirect back to login with error messages
            exit;
        }
    }

    /**
     * Procesa el registro de un nuevo usuario.
     *
     * Valida los campos de correo electrónico y contraseña proporcionados a través del formulario de registro.
     * Además, realiza validaciones adicionales según sea necesario (por ejemplo, comprobar si el correo electrónico ya está registrado).
     * Si todas las validaciones son exitosas, procede a crear un nuevo registro de usuario en la base de datos,
     * hash de la contraseña incluido. Luego, almacena la información del usuario recién creado en la sesión y redirige
     * al usuario a una página apropiada (por ejemplo, el dashboard). Si hay errores de validación o el proceso de registro falla,
     * redirige al usuario de nuevo al formulario de registro con mensajes de error adecuados.
     *
     * @uses \Config\Validator para realizar la validación de los campos del formulario.
     * @uses \App\Models\User::emailExists() para verificar si el correo electrónico ya está registrado.
     * @uses \App\Models\User::createUser() para crear el registro del nuevo usuario en la base de datos.
     *
     * @return void No retorna ningún valor directamente, pero produce una redirección basada en el resultado del proceso de registro.
     */
    public function processSignUp()
    {
        $validator = new \Config\Validator();

        $fields = [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            // Add other fields as needed
        ];
        $rules = [
            'email' => ['isEmpty', 'isValidEmail'],
            'password' => ['isEmpty', 'isSecurePassword'] // Add other rules like 'isSecurePassword' as needed
        ];

        $errors = $validator->validate($fields, $rules);
        // Complex validations

        if (empty($errors['email']) && $this->userModel->emailExists($fields['email'])) {
            $errors['email'][] = 'Email already in use';
        }

        /* SEND BACK IF ERROR */
        if (!empty($errors)) {
            // Save errors and form data to the session
            session_start();
            $_SESSION['validation_errors'] = $errors;
            $_SESSION['form_data'] = $fields; // Exclude password for security reasons
            // Redirect back to the sign-up form
            header('Location: authForm');
            exit;
        }

        /* CONTINUE */
        // Hash the password
        // Continue with the user creation process
        $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

        if ($this->userModel->createUser($fields)) {
            $userInfo = $this->userModel->getUserInfoByEmail($fields['email']);
            $userId = $userInfo['UsuarioID'];
            $userRole = $userInfo['Rol'];
          

            // Store in session
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_role'] = $userRole;
           

            // Redirect to the appropriate page
            header('Location: ./');
            exit;
        } else {
            // Handle errors
            // You can iterate over $errors to display them to the user

            // Redirect to the appropriate page
            header('Location: authForm');
            exit;
        }
    }

    /**
     * Cierra la sesión del usuario activo.
     *
     * Este método finaliza la sesión del usuario actual al eliminar todos los datos de sesión existentes.
     * Tras limpiar la sesión, redirige al usuario a la página principal. Es importante para garantizar
     * que no queden datos de sesión residuales que puedan afectar a la seguridad o al comportamiento
     * de la aplicación para futuras solicitudes.
     *
     * @uses session_start() para asegurar que la sesión esté iniciada antes de intentar manipularla.
     * @uses session_unset() para liberar todas las variables de sesión.
     * @uses session_destroy() para destruir la sesión.
     *
     * @return void No retorna ningún valor, pero envía al cliente a la raíz del sitio web.
     */
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ./"); // Redirigir a la página de inicio de sesión
        exit();
    }
}
