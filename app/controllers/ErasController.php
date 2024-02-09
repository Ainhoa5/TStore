<?php
namespace App\Controllers;
// In /app/controllers/ErasController.php
class ErasController
{
    private $productModel;

    public function __construct() {
        $db = \Config\Database::connect(); // Get the PDO instance
        $this->productModel = new \App\Models\Product($db); // Pass it to the Product model
    }

    public function erasTour()
    {
        $products = $this->productModel->findAll();
        require VIEWS_DIR . 'erasTour.php'; // Load the view
    }

    // Other methods for handling create, update, delete...
}

?>