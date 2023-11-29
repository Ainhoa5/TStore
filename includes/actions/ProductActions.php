<?php
// This is a separate 'ProductActions.php' script that handles form submissions

require_once '../config/database.php';
require_once '../models/Product.php';
require_once '../controllers/ProductController.php';

$dbConnection = Database::getInstance()->getConnection();
$productModel = new Product($dbConnection);
$productController = new ProductController($productModel);

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'delete':
            $productController->deleteProduct($_POST['product_id']);
            break;
        case 'edit':
            $productController->showUpdateForm($_POST['product_id']);
            break;
        case 'update':
            $productController->updateProduct($_POST);
            break;
        case 'create':
            $productController->createProduct($_POST);
            break;
        default:
            break;
            // Other cases for 'update', etc.
    }

    // After action is performed, redirect back to the view (product list page)
    /* header('Location: path_to_your_product_list_view.php'); */
    exit();
}
