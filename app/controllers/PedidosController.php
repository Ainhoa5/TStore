<?php
namespace App\Controllers;
// In /app/controllers/PedidosController.php
class PedidosController
{
    private $model;

    public function __construct() {
        $db = \Config\Database::connect(); // Get the PDO instance
        $this->model = new \App\Models\Pedidos($db); // Pass it to the Product model
    }

    

    
}

?>