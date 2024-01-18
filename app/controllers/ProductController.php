<?php 
// In /app/controllers/ProductController.php
require_once 'config/app.php';
class ProductController {
    private $productModel;

    public function __construct() {
        $db = Database::connect(); // Assuming you have a static method to get the DB instance
        $this->productModel = new Product($db);
    }


    public function createForm($id = null) {
        $product = null;

        if ($id) {
            $product = $this->productModel->findById($id); // Fetch product data for editing
        }

        require 'app/views/admin/formProduct.php';
    }

    public function save() {
        $data = $_POST;
        if (empty($data['id'])) {
            // Create product
            $this->productModel->create($data);
        } else {
            // Update product
            $this->productModel->update($data, $data['id']);
        }
        // Redirect to dashboard
        require 'app/views/admin/dashboard.php';
    }

}
