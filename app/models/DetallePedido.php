<?php
namespace App\Models;

// In /app/models/DetallePedido.php

/**
 * Modelo de DetallePedido que extiende de ActiveRecord para manejar las operaciones de la tabla DetallesPedidos.
 *
 * Este modelo proporciona funcionalidades específicas para interactuar con los detalles de los pedidos,
 * permitiendo crear nuevos detalles asociados a un pedido en la base de datos.
 */
class DetallePedido extends \Core\ActiveRecord
{
    /**
     * Constructor de la clase DetallePedido.
     *
     * Inicializa el modelo DetallePedido con la conexión a la base de datos, el nombre de la tabla
     * y la clave primaria de la tabla DetallesPedidos.
     *
     * @param \PDO $db Instancia de la conexión a la base de datos.
     */
    public function __construct($db)
    {
        parent::__construct($db, 'DetallesPedidos', 'DetalleID');
    }
    
    /**
     * Crea un nuevo detalle de pedido en la base de datos.
     *
     * Inserta un registro en la tabla DetallesPedidos asociando un producto a un pedido,
     * incluyendo la cantidad y el precio unitario del producto.
     *
     * @param int $pedidoId ID del pedido al cual se asocia el detalle.
     * @param array $producto Array asociativo que contiene los datos del producto, incluyendo su ID, cantidad y precio.
     */
    public function crearDetallePedido($pedidoId, $producto)
    {
        $stmt = $this->db->prepare("INSERT INTO DetallesPedidos (PedidoID, ProductoID, Cantidad, PrecioUnitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pedidoId, $producto['ProductoID'], $producto['quantity'], $producto['Precio']]);
    }

}
