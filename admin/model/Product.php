<?php
class Product
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getProducts()
    {
        $sql = "SELECT * FROM productos";
        $result = $this->db->query($sql);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }
    public function createProduct($data)
    {
        // Prepare an SQL statement to insert the product data
        $stmt = $this->db->prepare("INSERT INTO Productos (Nombre, Descripcion, Precio, Stock, Categoria, ImagenURL) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssdis",
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
    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare('DELETE FROM productos WHERE ProductoID = ?');
        $stmt->bind_param('i', $id);

        $success = $stmt->execute();
        // Check if the deletion was successful.
        if ($success) {
            // If successful, commit the transaction and close the statement.
            $this->db->commit();
            $stmt->close();
            return true;
        } else {
            echo 'error '.$stmt->error;
            // If not successful, report the error.
            error_log("Error: " . $stmt->error);
            $stmt->close();
            return false;
        }
    }
    public function findById($productId){
        // Prepare a statement for execution and returns a statement object
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE ProductoID = :productId");
    
        // Bind the input parameter, productId, to the prepared statement
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    
        // Execute the statement
        if ($stmt->execute()) {
            // Fetch the product; assuming you expect only one result back
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($product) {
                // If a product was found, return the product array
                return $product;
            } else {
                // No product was found with that ID
                return null;
            }
        } else {
            // Handle an error in execution, perhaps log it and/or return false
            error_log("Error in findById: " . $stmt->errorInfo()[2]);
            return false;
        }
    }
    public function update($data){
    
    }
}

?>