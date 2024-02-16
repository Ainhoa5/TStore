<?php
namespace App\Controllers;

// In /app/controllers/ProductController.php

/**
 * Controlador para gestionar productos dentro del panel de administración.
 *
 * Proporciona métodos para crear, editar, eliminar y guardar productos,
 * incluyendo la validación de los datos del formulario.
 */
class ProductController
{

    /**
     * Modelo de producto para interactuar con la base de datos de productos.
     *
     * @var \App\Models\Product
     */
    private $productModel;

    /**
     * Constructor de la clase.
     *
     * Establece la conexión con la base de datos e inicializa el modelo de producto.
     */
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

    /**
     * Muestra el formulario para crear o editar un producto.
     *
     * Si se proporciona un ID, carga los datos del producto para editar.
     * De lo contrario, muestra un formulario vacío para crear un nuevo producto.
     *
     * @param int|null $id ID del producto para editar, null para crear un nuevo producto.
     */
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

    /**
     * Elimina un producto basado en el ID proporcionado.
     *
     * @param int $id ID del producto a eliminar
     */
    public function delete($id)
    {
        $this->productModel->delete($id); // Fetch product data for editing
        // Redirect to the dashboard
        header("Location: /admin/dashboard");
        exit;
    }

    /**
     * Maneja la solicitud de guardar un producto.
     *
     * Este método valida los datos del formulario recibidos a través de $_POST, crea un nuevo producto o actualiza uno existente
     * dependiendo de si se proporcionó un ID de producto. Finalmente, redirige al dashboard de administración.
     * Utiliza la clase Validator para realizar la validación de los datos del formulario.
     * 
     * @uses \Config\Validator Para validar los datos del formulario de producto.
     * 
     * No retorna un valor explícitamente pero realiza una redirección a otra página basada en el resultado de la operación.
     * @return void
     */
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
            // ... extraer otros campos
        ];
        // Validation rules
        $rules = [
            'Nombre' => ['isEmpty', 'isValidString'],
            'Descripcion' => ['isEmpty'],
            'Precio' => ['isEmpty', 'isValidDecimal'],
            'Stock' => ['isEmpty', 'isNumeric'],
            'Categoria' => ['isEmpty', 'isValidString'],
            //'ImagenURL' => ['isEmpty'],
            // ... reglas adicionales
        ];

        // Realizar validación
        $errors = $validator->validate($data, $rules);

        if (!empty($errors)) {
            // Guardar errores y datos del formulario en la sesión
            session_start();
            $_SESSION['validation_errors'] = $errors;
            $data['ProductoID'] = $_POST['ProductoID']; // add ID to data
            $_SESSION['form_data'] = $data;

            header("Location: /admin/product/create");
            exit;
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
