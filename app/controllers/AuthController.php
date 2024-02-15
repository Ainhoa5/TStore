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
     */
    public function showAuthForm()
    {
        require VIEWS_DIR . 'auth/authForm.php';
    }

    /**
     * Muestra la página de perfil del usuario.
     */
    public function showUserPage()
    {
        require VIEWS_DIR . 'auth/user.php';
    }

    /**
     * Procesa el inicio de sesión del usuario.
     *
     * Valida los campos del formulario y verifica las credenciales contra la base de datos.
     * Redirige al usuario según el resultado de la autenticación.
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
     * Valida los campos del formulario y, si son válidos, crea un nuevo registro de usuario en la base de datos.
     * Redirige al usuario según el resultado del registro.
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
     * Cierra la sesión del usuario.
     *
     * Elimina los datos de la sesión del usuario y redirige a la página de inicio de sesión.
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
