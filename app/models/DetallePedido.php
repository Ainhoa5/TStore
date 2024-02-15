<?php
namespace App\Models;
// In /app/models/DetallePedido.php

class DetallePedido extends \Core\ActiveRecord
{
    public function __construct($db)
    {
        parent::__construct($db, 'DetallesPedidos');
    }

    public function crearDetallePedido($pedidoId, $producto) {
        $stmt = $this->db->prepare("INSERT INTO DetallesPedidos (PedidoID, ProductoID, Cantidad, PrecioUnitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$pedidoId, $producto['ProductoID'], $producto['quantity'], $producto['Precio']]);
    }

}
