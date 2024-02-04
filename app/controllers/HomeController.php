<?php
namespace App\Controllers;
// In /app/controllers/HomeController.php

class HomeController {
    private $productModel;

    public function __construct() {
        $db = \Config\Database::connect();
        $this->productModel = new \App\Models\Product($db);
    }
    public function index() {
        $latestProducts = $this->productModel->getLatestProducts(); // Method to fetch latest products
        require VIEWS_DIR . 'home.php';
    }
    public function erasTour() {
        require VIEWS_DIR . 'erasTour.php';
    }
}
