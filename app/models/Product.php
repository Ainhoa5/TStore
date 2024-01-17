<?php 
// In /app/models/Product.php
require_once 'config/app.php';

class Product extends ActiveRecord {
    public function __construct($db) {
        parent::__construct($db, 'Productos');
    }

    // Add any product-specific methods here
}
