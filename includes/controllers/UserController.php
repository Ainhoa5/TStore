<?php

session_start(); // Start the session at the beginning of your script
class ProductController
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function showProducts()
    {
        return $this->model->getProducts();
    }
    
    public function login($email, $password) {
        // Verificar las credenciales y obtener el rol
        $rol = $this->model->verificarCredenciales($email, $password);
    
        // Comprobar si se obtuvo un rol
        if ($rol) {
            // Iniciar la sesión si aún no se ha iniciado
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
    
            // Guardar datos en la sesión
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $rol;
    
            // Opcionalmente, guardar el ID del usuario o cualquier otro dato necesario
            // $_SESSION['user_id'] = ...
    
            // Devolver true para indicar un inicio de sesión exitoso
            return true;
        }
    
        // Devolver false si las credenciales no son correctas
        return false;
    }
    
    
    public function checkAdmin($email, $password) 
    {
    }
    public function logout($email, $password) 
    {
        // Cerrar sesión.
        session_destroy();
    }
}
