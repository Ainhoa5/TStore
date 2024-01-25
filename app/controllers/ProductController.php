<?php
namespace App\Controllers;
// In /app/controllers/ProductController.php
require_once 'config/app.php';
class ProductController
{
    private $productModel;

    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->productModel = new \App\Models\Product($db);
    }


    public function createForm($id = null)
    {
        $product = null;
        

        session_start();
        if (isset($_SESSION['form_data'])) {
            $product = $_SESSION['form_data'];
        } elseif ($id) {
            $product = $this->productModel->findById($id); // Fetch product data for editing
        }

        require 'app/views/admin/formProduct.php';
    }

    public function delete($id)
    {
        $this->productModel->delete($id); // Fetch product data for editing
        // Redirect to the dashboard
        $baseUrl = \Config\Functions::getBaseUrl();
        header("Location: $baseUrl/admin/dashboard");
        exit;
    }

    public function save()
    {
        $validator = new \Config\Validator();

        // Extract the data from $_POST
        $data = [
            'Nombre' => $_POST['Nombre'] ?? '',
            'Descripcion' => $_POST['Descripcion'] ?? '',
            'Precio' => $_POST['Precio'] ?? '',
            'Stock' => $_POST['Stock'] ?? '',
            'Categoria' => $_POST['Categoria'] ?? '',
            //'ImagenURL' => $_POST['ImagenURL'] ?? '',
            // ... extract other fields
        ];

        // Validation rules
        $rules = [
            'Nombre' => ['isEmpty', 'isValidString'],
            'Descripcion' => ['isEmpty'],
            'Precio' => ['isEmpty', 'isValidDecimal'],
            'Stock' => ['isEmpty', 'isNumeric'],
            'Categoria' => ['isEmpty', 'isValidString'],
            //'ImagenURL' => ['isEmpty'],
            // ... additional rules
        ];

        // Perform validation
        $errors = $validator->validate($data, $rules);

        if (!empty($errors)) {
            // Save errors and form data to the session
            session_start();
            $_SESSION['validation_errors'] = $errors;
            $data['ProductoID'] = $_POST['ProductoID']; // add ID to data
            $_SESSION['form_data'] = $data;

            // Redirect back to the form
            $baseUrl = \Config\Functions::getBaseUrl();
            $redirectUrl = "$baseUrl/admin/product/create";
            header("Location: $redirectUrl");
            exit;
        }
        // Proceed with creating or updating the product
        if (empty($_POST['ProductoID'])) {
            $this->productModel->create($data);
        } else {
            $this->productModel->update($data, $_POST['ProductoID']);
        }

        // Redirect to dashboard
        $baseUrl = \Config\Functions::getBaseUrl();
        header("Location: $baseUrl/admin/dashboard");
        exit;
    }
}
