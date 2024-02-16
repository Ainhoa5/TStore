<?php
namespace App\Controllers;
// In /app/controllers/AdminController.php

/**
 * Controlador del administrador para gestionar las acciones del panel de administración.
 *
 * Proporciona funcionalidades para visualizar el dashboard del administrador,
 * así como gestionar productos y categorías desde la interfaz de administración.
 */
class AdminController
{
    /**
     * Modelo de producto para interactuar con la base de datos de productos.
     *
     * @var \App\Models\Product
     */
    private $productModel;

    /**
     * Constructor del controlador de administración.
     *
     * Inicializa la conexión a la base de datos y el modelo de producto.
     */
    public function __construct() {
        $db = \Config\Database::connect(); // Get the PDO instance
        $this->productModel = new \App\Models\Product($db); // Pass it to the Product model
    }

    /**
     * Muestra el dashboard del administrador con una lista de productos.
     * @return void
     */
    public function showDashboard()
    {
        $products = $this->productModel->findAll();
        require VIEWS_DIR . 'admin/dashboard.php'; // Load the view
    }

    /**
     * Muestra el dashboard de categorías del administrador.
     * @return void
     */
    public function showCategoriasDashboard()
    {
        require VIEWS_DIR . 'admin/dashboardCategorias.php'; // Load the view
    }

    // Otros métodos para crear, actualizar, eliminar...
}

?>