<?php
namespace App\Models;
// In /app/models/Pedidos.php

class Pedidos extends \Core\ActiveRecord
{
    public function __construct($db)
    {
        parent::__construct($db, 'Pedidos');
    }


    public function crearPedidoConDetalles($usuarioId, $productos,$modelDetallePedido) {
        try {
            $this->db->beginTransaction();

            // Inserta el pedido en la tabla Pedidos y obtiene su ID
            $stmt = $this->db->prepare("INSERT INTO Pedidos (UsuarioID, Fecha, EstadoPedido) VALUES (?, NOW(), 'En Proceso')");
            $stmt->execute([$usuarioId]);
            $pedidoId = $this->db->lastInsertId();

            // Inserta cada producto como un detalle del pedido
            foreach ($productos as $producto) {
                $modelDetallePedido->crearDetallePedido($pedidoId, $producto);
            }

            $this->db->commit();
            return ['success' => true, 'message' => 'Pedido creado con éxito', 'pedidoId' => $pedidoId];
        } catch (\Exception $e) {
            $this->db->rollback();
            return ['success' => false, 'message' => 'Error al crear el pedido'];
        }
    }    

}
