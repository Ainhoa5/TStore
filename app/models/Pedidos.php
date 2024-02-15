<?php
namespace App\Models;

// In /app/models/Pedidos.php

/**
 * Modelo de Pedidos que extiende de ActiveRecord para manejar operaciones de base de datos.
 *
 * Proporciona funcionalidades específicas para interactuar con la tabla de pedidos,
 * incluyendo la creación de pedidos y la asociación de productos a estos mediante detalles de pedido.
 */
class Pedidos extends \Core\ActiveRecord
{
    /**
     * Constructor de la clase Pedidos.
     *
     * Inicializa el modelo de Pedidos con la conexión a la base de datos, el nombre de la tabla
     * y la clave primaria de la tabla de pedidos.
     *
     * @param \PDO $db Instancia de la conexión a la base de datos.
     */
    public function __construct($db)
    {
        parent::__construct($db, 'Pedidos', 'PedidoID');
    }

    /**
     * Crea un nuevo pedido con sus detalles asociados en la base de datos.
     *
     * Inserta un registro de pedido en la tabla 'Pedidos' y luego utiliza el modelo 'DetallePedido'
     * para insertar cada producto como detalle del pedido creado, asociándolos mediante el ID del pedido.
     *
     * @param int $usuarioId ID del usuario que realiza el pedido.
     * @param array $productos Array de productos que se incluirán en el pedido.
     * @param \App\Models\DetallePedido $modelDetallePedido Modelo de detalle de pedido para insertar los productos.
     * @return array Asociativo con el estado de la operación ('success' y 'message') y el 'pedidoId' creado.
     */
    public function crearPedidoConDetalles($usuarioId, $productos, $modelDetallePedido)
    {
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
