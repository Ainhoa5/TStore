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
        // Prepare SQL query to prevent SQL injection
        $sql = "SELECT * FROM productos";

        // Use try-catch block for error handling
        try {
            $result = $this->db->query($sql);

            // Check if the query was successful
            if (!$result) {
                throw new Exception('Query failed: ' . $this->db->error);
            }

            // Fetch all rows at once
            $products = $result->fetch_all(MYSQLI_ASSOC);

        } catch (Exception $e) {
            // Handle any exceptions/errors here
            // Log the error message and/or display a user-friendly message
            error_log($e->getMessage());
            return []; // Return an empty array on failure
        }

        return $products;
    }

    public function createProduct($data)
    {
        try {
            // Prepare an INSERT statement
            $stmt = $this->db->prepare("INSERT INTO Productos (Nombre, Descripcion, Precio, Stock, Categoria, ImagenURL) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $this->db->errno . ") " . $this->db->error);
            }

            // Bind the parameters to the statement
            if (!$stmt->bind_param('ssdiss', $data['name'], $data['description'], $data['price'], $data['stock'], $data['category'], $data['ImagenURL'])) {
                throw new Exception("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }

            // Check if the insert was successful
            return $stmt->affected_rows > 0;

        } catch (Exception $e) {
            // Log the exception message
            error_log($e->getMessage(), 3, "../../error.log");
            return false;
        }
    }



    public function deleteProduct($id)
{
    try {
        // First, find the product to get the image URL
        $product = $this->findById($id);
        if (!$product) {
            throw new Exception("Product not found with ID: $id");
        }

        // Delete the image file if it exists
        if (!empty($product['ImagenURL'])) {
            $imagePath = '../../build/img/products/' . $product['ImagenURL'];
            if (file_exists($imagePath)) {
                if (!unlink($imagePath)) {
                    // Optional: Decide how to handle the situation where the image file cannot be deleted
                    // For instance, you can throw an exception or just log the error
                    error_log("Failed to delete image file: $imagePath", 3, "../../error.log");
                }
            }
        }

        // Prepare the DELETE statement for the product
        $stmt = $this->db->prepare('DELETE FROM productos WHERE ProductoID = ?');
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->db->error);
        }

        // Bind the parameter
        $stmt->bind_param('i', $id);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // The delete was successful
        return true;

    } catch (Exception $e) {
        // Log the exception message
        error_log($e->getMessage(), 3, "../../error.log");
        return false;

    } finally {
        // Close the statement in any case
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}



    public function findById($productId)
    {
        try {
            // Prepare a SELECT statement
            $stmt = $this->db->prepare("SELECT * FROM productos WHERE ProductoID = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->db->error);
            }

            // Bind the input parameter, productId, to the prepared statement
            if (!$stmt->bind_param('i', $productId)) {
                throw new Exception("Binding parameters failed: " . $stmt->error);
            }

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            // Fetch the product
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            return $product ?: null; // Returns the product if found, otherwise null

        } catch (Exception $e) {
            // Log the exception message
            error_log($e->getMessage(), 3, "../../error.log");
            return null; // Return null if an exception occurred
        } finally {
            // Close the statement if it has been set
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function update($data)
    {
        try {
            // Prepare an UPDATE statement
            $stmt = $this->db->prepare("UPDATE Productos SET Nombre = ?, Descripcion = ?, Precio = ?, Stock = ?, Categoria = ?, ImagenURL = ? WHERE ProductoID = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->db->error);
            }

            // Bind the parameters to the statement
            if (!$stmt->bind_param('ssdisss', $data['name'], $data['description'], $data['price'], $data['stock'], $data['category'], $data['ImagenURL'], $data['ProductoID'])) {
                throw new Exception("Binding parameters failed: " . $stmt->error);
            }

            // Execute the statement
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            // Check if the update was successful
            
            return $stmt->affected_rows > 0;

        } catch (Exception $e) {
            // Log the exception message
            error_log($e->getMessage(), 3, "../../error.log");
            return false;
        } finally {
            // Ensure the statement is closed
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }

    public function getLatestProducts($limit = 6) {
        $query = "SELECT * FROM productos WHERE stock > 0 ORDER BY fecha_creacion DESC LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }
}
