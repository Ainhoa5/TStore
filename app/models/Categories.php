<?php
namespace App\Models;

// En /app/models/Categories.php

/**
 * Clase Categories para manejar operaciones relacionadas con categorías.
 *
 * Esta clase se encarga de comunicarse con una API externa para realizar
 * operaciones CRUD sobre categorías utilizando un cliente API.
 */
class Categories
{
    /**
     * Cliente API para realizar solicitudes HTTP.
     *
     * @var ApiClient
     */
    private $apiClient;

    /**
     * Constructor de la clase Categories.
     *
     * @param ApiClient $apiClient Instancia del cliente API para realizar solicitudes HTTP.
     */
    public function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Obtiene todas las categorías desde la API.
     *
     * @return array Lista de categorías obtenidas de la API.
     */
    public function getCategories()
    {
        return $this->apiClient->sendRequest('GET', 'getAllCategorias');
    }
    /**
     * Añade una nueva categoría a través de la API.
     *
     * @param array $data Datos de la categoría a añadir.
     * @return array Respuesta de la API al añadir la categoría.
     */
    public function addCategoria($data)
    {
        return $this->apiClient->sendRequest('POST', 'insertCategoria', $data);
    }
    /**
     * Elimina una categoría a través de la API.
     *
     * @param array $data Datos necesarios para eliminar la categoría, incluyendo su ID.
     * @return array Respuesta de la API a la eliminación de la categoría.
     */
    public function deleteCategoria($data)
    {
        return $this->apiClient->sendRequest('POST', 'deleteCategoria', $data);
    }

    /**
     * Actualiza una categoría existente a través de la API.
     *
     * @param array $data Datos de la categoría a actualizar, incluyendo su ID.
     * @return array Respuesta de la API a la actualización de la categoría.
     */
    public function updateCategoria($data)
    {
        return $this->apiClient->sendRequest('POST', 'updateCategoria', $data);
    }
    /**
     * Obtiene los detalles de una categoría específica por su ID a través de la API.
     *
     * @param array $data Datos necesarios para obtener la categoría, incluyendo su ID.
     * @return array Detalles de la categoría obtenida de la API.
     */
    public function getCategoriaById($data)
    {
        return $this->apiClient->sendRequest('POST', 'getCategoriaById', $data);
    }

}
