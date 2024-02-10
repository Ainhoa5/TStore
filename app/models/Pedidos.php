<?php
namespace App\Models;
// In /app/models/Pedidos.php

class Pedidos extends \Core\ActiveRecord
{
    public function __construct($db)
    {
        parent::__construct($db, 'Pedidos');
    }

    

}
