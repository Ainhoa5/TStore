<?php
namespace App\Controllers;

// In /app/controllers/PedidosController.php

/**
 * Controlador para manejar las operaciones de pedidos en la aplicación.
 *
 * Este controlador gestiona la creación de pedidos y sus detalles asociados,
 * utilizando los modelos Pedidos y DetallePedido para interactuar con la base de datos.
 */
class PedidosController
{
    /**
     * Modelo para gestionar los pedidos.
     *
     * @var \App\Models\Pedidos
     */
    private $modelPedido;

    /**
     * Modelo para gestionar los detalles de los pedidos.
     *
     * @var \App\Models\DetallePedido
     */
    private $modelDetallePedido;

    /**
     * Constructor del controlador PedidosController.
     *
     * Establece la conexión con la base de datos y inicializa los modelos de Pedidos y DetallePedido.
     */
    public function __construct()
    {
        $db = \Config\Database::connect(); // Get the PDO instance
        $this->modelPedido = new \App\Models\Pedidos($db);
        $this->modelDetallePedido = new \App\Models\DetallePedido($db);
    }

    /**
     * Crea un pedido con sus detalles basado en la entrada de datos JSON.
     *
     * Este método recibe datos de un pedido y sus productos asociados, crea un nuevo pedido
     * en la base de datos y luego agrega los detalles del pedido. Requiere que el usuario esté
     * autenticado y tenga un ID de usuario válido en la sesión.
     */
    public function crearPedido()
    {

        $data = json_decode(file_get_contents('php://input'), true);
        $productos = $data['productos'];
        $resultado = null;
        session_start();
        if (isset($_SESSION['user_id'])) {
            // Crear pedido y sus detalles si el usuario está autenticado
            $resultado = $this->modelPedido->crearPedidoConDetalles($_SESSION['user_id'], $productos, $this->modelDetallePedido);
        } else {
            // Retornar error si el usuario no está autenticado
            $resultado = ['success' => false, 'message' => 'Error al crear el pedido, inicia sesión'];
        }


        header('Content-Type: application/json');
        echo json_encode($resultado);
    }



}

?>