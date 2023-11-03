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
    
    
    public function update($data) {
        // Check if ProductID is set in $data
        if (!isset($data['ProductID'])) {
            // Handle the error appropriately, maybe log it or throw an exception
            error_log('ProductID not set in the update data');
            return false;
        }
    
        // Start building the SQL UPDATE statement
        // The SQL string will contain placeholder names for the PDO prepared statement
        $sql = "UPDATE productos SET ";
        $updates = [];
        $params = [];
    
        // Loop through the data and build the SQL dynamically
        foreach ($data as $key => $value) {
            // Skip the ProductID since it's used in the WHERE clause, not SET clause
            if ($key != 'ProductID') {
                $updates[] = "{$key} = :{$key}";
                $params[$key] = $value;
            }
        }
    
        // Join all the individual column assignments into one string separated by commas
        $sql .= implode(', ', $updates);
        // Finish the SQL with the WHERE clause
        $sql .= " WHERE ProductoID = :ProductID";
    
        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);
    
        // Bind the values from $data to the corresponding placeholders in the SQL
        foreach ($params as $key => &$val) {
            $stmt->bindParam(':'.$key, $val);
        }
    
        // Bind the ProductID separately
        $stmt->bindParam(':ProductID', $data['ProductID'], PDO::PARAM_INT);
    
        // Execute the statement and return the result
        if ($stmt->execute()) {
            // Check if any rows were updated
            if ($stmt->rowCount()) {
                return true;
            } else {
                // No rows updated - could mean the ProductID was not found
                return false;
            }
        } else {
            // Handle execution error
            error_log("Error in update: " . $stmt->errorInfo()[2]);
            return false;
        }
    }
    
}

?>