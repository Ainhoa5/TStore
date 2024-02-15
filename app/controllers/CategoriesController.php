<?php
namespace App\Controllers;

// In /app/controllers/CategoriesController.php

/**
 * Controlador para gestionar las operaciones de categorías.
 *
 * Este controlador maneja las vistas y operaciones CRUD para las categorías
 * a través de una API, utilizando AJAX para una interactividad dinámica.
 */
class CategoriesController
{
    /**
     * Modelo de categorías para interactuar con la API.
     *
     * @var Categories
     */
    private $model;

    /**
     * Constructor del CategoriesController.
     *
     * Inicializa el modelo de categorías con una instancia de ApiClient.
     */
    public function __construct()
    {
        // Asegúrate de que la clase ApiClient y la URL base sean correctas.
        $apiClient = new ApiClient('http://localhost/Projects/PERSONAL_WebServicePostman/index.php?op=');
        $this->model = new \APP\Models\Categories($apiClient);
    }
    /**
     * Muestra el dashboard de categorías.
     *
     * Carga la vista del dashboard de categorías, donde se utilizará AJAX
     * para cargar dinámicamente el contenido.
     */
    public function showDashboard()
    {
        require VIEWS_DIR . 'dashboardCategoria.php';
    }

    /**
     * Muestra el formulario para añadir una nueva categoría.
     */
    public function showForm()
    {
        require VIEWS_DIR . 'admin/formCategoria.php';
    }

    /**
     * Envía las categorías existentes en formato JSON.
     *
     * Recupera todas las categorías a través del modelo y las devuelve en formato JSON.
     */
    public function getCategoriasJson()
    {
        $categories = $this->model->getCategories();
        header('Content-Type: application/json');
        echo json_encode($categories);
        exit;
    }

    /**
     * Elimina una categoría específica.
     *
     * Recibe los datos necesarios para eliminar una categoría y la elimina a través del modelo.
     */
    public function deleteCategoria()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->model->deleteCategoria($data);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Añade una nueva categoría.
     *
     * Recibe los datos de la nueva categoría y la añade a través del modelo.
     */
    public function addCategoria()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // Aquí, procesa $data y utiliza tu modelo o ApiClient para añadir el producto
        $result = $this->model->addCategoria($data);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Actualiza una categoría existente.
     *
     * Recibe los datos actualizados de una categoría y la actualiza a través del modelo.
     */
    public function updateCategoria()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->model->updateCategoria($data);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Obtiene los detalles de una categoría específica por su ID.
     *
     * Recibe el ID de una categoría y devuelve sus detalles a través del modelo.
     */
    public function getCategoriaById()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->model->getCategoriaById($data);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    /**
     * Carga el formulario de actualización de categorías que será rellenado con los datos de una categoría específica.
     */
    public function fillUpdateForm()
    {
        require VIEWS_DIR . 'admin/updateCategoriaForm.php';
    }

}
