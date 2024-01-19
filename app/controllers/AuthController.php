<?php
// In /app/controllers/AuthController.php

class AuthController
{
    private $userModel;
    public function __construct()
    {
        $db = Database::connect(); // Assuming you have a static method to get the DB instance
        $this->userModel = new User($db);
    }
    public function showAuthForm()
    {
        require 'app/views/auth/authForm.php'; // Path to your home view file
    }
    public function showUserPage()
    {
        require 'app/views/auth/user.php'; // Path to your home view file
    }
    public function processLogin() /* UPDATE ERRORS */
    {

        $validator = new Validator();

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
        if (empty($errors) && $this->userModel->verificarCredenciales($fields)) {
            $userInfo = $this->userModel->getUserInfoByEmail($fields['email']);
            $userId = $userInfo['UsuarioID'];
            $userRole = $userInfo['Rol'];

            // Store in session

            session_start();
            $_SESSION['user_id'] = $userId;
            $_SESSION['user_role'] = $userRole;

            // Redirect to the appropriate page
            header('Location: ./');
            exit;
        } else {
            // Authentication failed
            // Handle error, maybe redirect back to login with an error message
            Functions::debug($errors);
            header('Location: authForm');
            exit;
        }
    }

    public function processSignUp()
    {
        $validator = new Validator();

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

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ./"); // Redirigir a la página de inicio de sesión
        exit();
    }
}
