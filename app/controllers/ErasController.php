<?php
namespace App\Controllers;

// In /app/controllers/ErasController.php

/**
 * Controlador para manejar las acciones relacionadas con las 'Eras' en la aplicación.
 *
 * Este controlador gestiona la visualización y manejo de las 'Eras', incluyendo la carga
 * y presentación de productos asociados a diferentes eras históricas o categorías.
 */
class ErasController
{
    /**
     * Modelo de producto para interactuar con la base de datos de productos.
     *
     * @var \App\Models\Product
     */
    private $productModel;

    /**
     * Constructor de ErasController.
     *
     * Inicializa la conexión con la base de datos y establece el modelo de productos
     * para ser utilizado en las acciones del controlador.
     */
    public function __construct()
    {
        $db = \Config\Database::connect(); // Obtener la instancia de PDO
        $this->productModel = new \App\Models\Product($db); // Pasarlo al modelo Product
    }

    /**
     * Muestra la página de 'Eras Tour'.
     *
     * Recupera todos los productos disponibles y los prepara para ser presentados
     * en la vista de 'Eras Tour', codificándolos en formato JSON para su uso en el cliente.
     * @return void No retorna ningún valor, pero incluye la vista erasTour.php para su renderización en el navegador.
     */
    public function erasTour()
    {
        $products = $this->productModel->findAll(); // Obtener todos los productos

        $productosJson = json_encode($products); // Codificar productos en JSON

        require VIEWS_DIR . 'erasTour.php'; // Cargar la vista de 'Eras Tour'
    }

    // Otros métodos para crear, actualizar, eliminar...

}

?>