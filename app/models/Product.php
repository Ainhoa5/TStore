<?php
// In /app/models/Product.php
require_once 'config/app.php';

class Product extends ActiveRecord
{
    public function __construct($db)
    {
        parent::__construct($db, 'Productos');
    }

    // Add any product-specific methods here
    public function getLatestProducts()
    {
        try {
            $query = "SELECT * FROM Productos ORDER BY fecha_creacion DESC LIMIT 9";

            // Prepare the statement
            $stmt = $this->db->prepare($query);

            // Execute the query
            $stmt->execute();

            // Fetch and return the results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            Functions::logError($e->getMessage());
            return false;
        }

    }

}
