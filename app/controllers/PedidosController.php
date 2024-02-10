<?php
namespace App\Controllers;
// In /app/controllers/PedidosController.php
class PedidosController
{
    private $modelPedido;
    private $modelDetallePedido;

    public function __construct() {
        $db = \Config\Database::connect(); // Get the PDO instance
        $this->modelPedido = new \App\Models\Pedidos($db);
        $this->modelDetallePedido = new \App\Models\DetallePedido($db);
    }

    public function crearPedido() {
        
        $data = json_decode(file_get_contents('php://input'), true);
        $productos = $data['productos'];
        $resultado = null;
        //$usuarioId = $data['usuarioId']; // Asegúrate de incluir el usuarioId en tu solicitud fetch
        session_start();
        if (isset($_SESSION['user_id'])){
            $resultado = $this->modelPedido->crearPedidoConDetalles($_SESSION['user_id'], $productos,$this->modelDetallePedido);
        }else{
            $resultado = ['success' => false, 'message' => 'Error al crear el pedido, inicia sesión'];
        }
       

        header('Content-Type: application/json');
        echo json_encode($resultado);
    }


    
}

?>