<?php
namespace App\Controllers;

// In /app/controllers/HomeController.php

class HomeController
{
    private $productModel;

    public function __construct()
    {
        $db = \Config\Database::connect();
        if (!$db) {
            // Manejar el error de conexión, por ejemplo:
            session_start();
            $_SESSION['error'] = 'No se pudo establecer la conexión con la base de datos.';
            header('Location: errorPage'); // Suponiendo que tienes una página de error genérica
            exit;
        }
        $this->productModel = new \App\Models\Product($db);
    }
    public function index()
    {
        $latestProducts = $this->productModel->getLatestProducts(); // Method to fetch latest products
        require VIEWS_DIR . 'home.php';
    }
    public function erasTour()
    {
        require VIEWS_DIR . 'erasTour.php';
    }
}
