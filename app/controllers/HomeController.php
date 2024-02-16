<?php
namespace App\Controllers;

// In /app/controllers/HomeController.php

/**
 * Controlador de la página de inicio para gestionar la visualización de la página principal y otras páginas estáticas.
 *
 * Este controlador se encarga de preparar y mostrar los datos necesarios para la vista de la página de inicio,
 * así como de manejar la visualización de otras páginas estáticas como 'erasTour'.
 */
class HomeController
{
    /**
     * Modelo de producto para interactuar con la base de datos de productos.
     *
     * @var \App\Models\Product
     */
    private $productModel;

    /**
     * Constructor del HomeController.
     *
     * Establece la conexión con la base de datos y inicializa el modelo de productos.
     * Redirige a una página de error si no puede establecerse la conexión.
     */
    public function __construct()
    {
        $db = \Config\Database::connect(); // Obtener la instancia de PDO
        if (!$db) {
            session_start();
            $_SESSION['error'] = 'No se pudo establecer la conexión con la base de datos.';
            header('Location: errorPage'); // Redirecciona a una página de error genérica.
            exit;
        }
        $this->productModel = new \App\Models\Product($db);
    }

    /**
     * Muestra la página de inicio de la aplicación.
     *
     * Recupera los últimos productos del modelo de productos y carga la vista de inicio
     * para mostrarlos.
     * @return void No retorna ningún valor, pero incluye la vista home.php para su renderización en el navegador.
     */
    public function index()
    {
        $latestProducts = $this->productModel->getLatestProducts(); // Método para obtener los últimos productos
        require VIEWS_DIR . 'home.php'; // Cargar la vista de inicio
    }
    /**
     * Muestra la página 'Eras Tour'.
     *
     * Carga la vista correspondiente a la página 'Eras Tour'.
     * @return void No retorna ningún valor, pero incluye la vista erasTour.php para su renderización en el navegador.
     */
    public function erasTour()
    {
        require VIEWS_DIR . 'erasTour.php'; // Cargar la vista de 'Eras Tour'
    }
}
