<?php
// In /app/controllers/ProductController.php
require_once 'config/app.php';
class ProductController
{
    private $productModel;

    public function __construct()
    {
        $db = Database::connect(); // Assuming you have a static method to get the DB instance
        $this->productModel = new Product($db);
    }


    public function createForm($id = null)
    {
        $product = null;
        if ($id) {
            $product = $this->productModel->findById($id); // Fetch product data for editing
        }

        require 'app/views/admin/formProduct.php';
    }

    public function delete($id)
    {
        $this->productModel->delete($id); // Fetch product data for editing
        // Redirect to the dashboard
        $baseUrl = Functions::getBaseUrl();
        header("Location: $baseUrl/admin/dashboard");
        exit;
    }

    public function save()
    {
        $data = $_POST;
        if (empty($data['ProductoID'])) {
            // Create product
            $this->productModel->create($data);
        } else {
            // Update product
            $this->productModel->update($data, $data['ProductoID']);
        }
        // Redirect to dashboard
        $baseUrl = Functions::getBaseUrl();
        header("Location: $baseUrl/admin/dashboard");
        exit;
    }
}
