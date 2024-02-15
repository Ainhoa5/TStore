<?php
namespace App\Models;
// In /app/models/Product.php

/**
 * Modelo de Producto que extiende de ActiveRecord para manejar operaciones de base de datos.
 *
 * Proporciona funcionalidades específicas para interactuar con la tabla de productos,
 * incluyendo la recuperación de los últimos productos añadidos.
 */
class Product extends \Core\ActiveRecord
{
    /**
     * Constructor de la clase Producto.
     *
     * Inicializa el modelo de Producto con la conexión a la base de datos, el nombre de la tabla
     * y la clave primaria de la tabla de productos.
     *
     * @param \PDO $db Instancia de la conexión a la base de datos.
     */
    public function __construct($db)
    {
        parent::__construct($db, 'Productos', 'ProductoID');
    }

    /**
     * Obtiene los últimos productos añadidos a la base de datos.
     *
     * Retorna los 9 productos más recientemente creados ordenados por su fecha de creación.
     *
     * @return array|false Un array de productos en caso de éxito, o false en caso de error.
     */
    public function getLatestProducts()
    {
        try {
            $query = "SELECT * FROM Productos ORDER BY fecha_creacion DESC LIMIT 9";

            // Prepare the statement
            $stmt = $this->db->prepare($query);

            // Execute the query
            $stmt->execute();

            // Fetch and return the results
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

}
