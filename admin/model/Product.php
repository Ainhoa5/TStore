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
    
    public function createProduct($data) // TO DO
    {
        // get form data
        // create query
        // execute
        // handle errors
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

    public function findById($productId)
    {
        // Prepare a statement for execution and return a statement object or false on failure
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE ProductoID = ?");
    
        if (!$stmt) {
            // Prepare failed
            error_log("Prepare failed: (" . $this->db->errno . ") " . $this->db->error);
            return false;
        }
    
        // Bind the input parameter, productId, to the prepared statement
        if (!$stmt->bind_param('i', $productId)) {
            // Bind failed
            error_log("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
            return false;
        }
    
        // Execute the statement and check for errors after execution
        if (!$stmt->execute()) {
            // Execute failed
            error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            return false;
        }
    
        // Fetch the product
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        if ($product) {
            return $product;
        } else {
            // No product was found
            return null;
        }
    }
    
    
    public function update($data) // TO DO
    { 
        // get form data
        // create query
        // execute
        // handle errors
    }
    
}
