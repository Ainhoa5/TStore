<?php
// In /app/controllers/AdminController.php

require_once 'config/app.php';
class AdminController
{
    private $productModel;

    public function __construct() {
        $db = Database::connect(); // Get the PDO instance
        $this->productModel = new Product($db); // Pass it to the Product model
    }

    public function showDashboard()
    {
        $products = $this->productModel->findAll();
        require 'app/views/admin/dashboard.php'; // Load the view
    }

    // Other methods for handling create, update, delete...
}

?>