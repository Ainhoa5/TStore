<?php 
class Product {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProducts(){
        $sql = "SELECT * FROM productos";
        $result = $this->db->query($sql);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
    public function createProduct($data) {
        // Prepare an SQL statement to insert the product data
        $stmt = $this->db->prepare("INSERT INTO Productos (Nombre, Descripcion, Precio, Stock, Categoria, ImagenURL) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", 
            $data['name'], 
            $data['description'], 
            $data['price'], 
            $data['stock'], 
            $data['category'],
            $data['image_url']
        );
        $stmt->execute();
        
        // Check for successful insertion and handle any errors
    }
}

?>
