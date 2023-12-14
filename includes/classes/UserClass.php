<?php 
class UserClass {
    public $usuarioID;
    public $nombre;
    public $apellido;
    public $email;
    public $direccion;
    public $ciudad;
    public $estado;
    public $pais;
    public $codigoPostal;
    public $rol;

    // Updated Constructor
    public function __construct($usuarioID, $nombre, $apellido, $email, $rol, $direccion = '', $ciudad = '', $estado = '', $pais = '', $codigoPostal = '') {
        $this->usuarioID = $usuarioID;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->rol = $rol;
        $this->direccion = $direccion;
        $this->ciudad = $ciudad;
        $this->estado = $estado;
        $this->pais = $pais;
        $this->codigoPostal = $codigoPostal;
    }

    // Otros métodos relacionados con el usuario
}

?>