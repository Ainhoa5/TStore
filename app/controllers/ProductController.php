<?php

namespace App\Controllers;

use Config\Functions;

// In /app/controllers/ProductController.php
//require_once 'config/app.php';
class ProductController
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


    public function createForm($id = null)
    {
        $product = null;


        session_start();
        if (isset($_SESSION['form_data'])) {
            $product = $_SESSION['form_data'];
        } elseif ($id) {
            $product = $this->productModel->findById($id); // Fetch product data for editing
        }

        require VIEWS_DIR . 'admin/formProduct.php';
    }

    public function delete($id)
    {
        $this->productModel->delete($id); // Fetch product data for editing
        // Redirect to the dashboard
        header("Location: /admin/dashboard");
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
            // ... extract other fields
        ];
        // Validation rules
        $rules = [
            'Nombre' => ['isEmpty', 'isValidString'],
            'Descripcion' => ['isEmpty'],
            'Precio' => ['isEmpty', 'isValidDecimal'],
            'Stock' => ['isEmpty', 'isNumeric'],
            'Categoria' => ['isEmpty', 'isValidString'],
            'ImagenURL' => ['isValidImage'],
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

            header("Location: /admin/product/create");
            exit;
        }

        // Aquí maneja la carga de la imagen si no hay errores
        if (isset($_FILES['ImagenURL']) && $_FILES['ImagenURL']['error'] == UPLOAD_ERR_OK) {

            // Asumiendo que ya has validado la imagen con 'isValidImage'
            // Obtiene la extensión original del archivo
            $extension = pathinfo($_FILES['ImagenURL']['name'], PATHINFO_EXTENSION);

            // Genera un nombre de archivo único para evitar sobrescribir archivos existentes
            $uniqueFileName = uniqid('img_', true) . '.' . $extension; // Prefijo 'img_' y extensión original

            // Construye la ruta de destino con el nombre de archivo único
            $targetPath = IMG_PRODUCTS_PATH . $uniqueFileName;

            if (move_uploaded_file($_FILES['ImagenURL']['tmp_name'], $targetPath)) {
                // Si la imagen se guarda correctamente, guarda el nombre del archivo único en $data
                $data['ImagenURL'] = $uniqueFileName; // Guarda el nombre único del fichero en $data
            } else {
                // Manejar el error de carga de la imagen
            }
        }



        // Proceed with creating or updating the product
        if (empty($_POST['ProductoID'])) {
            $this->productModel->create($data);
        } else {
            $this->productModel->update($data, $_POST['ProductoID']);
        }

        // Redirect to dashboard
        header("Location: /admin/dashboard");
        exit;
    }
}
