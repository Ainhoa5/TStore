<?php
namespace App\Controllers;
// In /app/controllers/HomeController.php

/**
 * Controlador encargado de manejar las páginas de error dentro de la aplicación.
 *
 * Este controlador se utiliza para mostrar una vista genérica de error cuando ocurre
 * una situación excepcional o se solicita una ruta no existente.
 */
class ErrorController {
    
    /**
     * Muestra la página de error.
     *
     * Este método carga la vista correspondiente a la página de error, proporcionando
     * una respuesta visual al usuario cuando algo va mal en la aplicación.
     */
    public function errorPage() {
        require VIEWS_DIR . 'errorPage.php';
    }
}
