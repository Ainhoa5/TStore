<?php 
// relative path
$path = '../../';
include $path . 'includes/config/database.php';

// Execute the query
$result = customQuery("SELECT * FROM Productos ", [], '');

// Fetch data and print it out
/* if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ProductoID: " . $row["ProductoID"] . " - Nombre: " . $row["Nombre"] . " - Precio: " . $row["Precio"] . "<br>";
    }
} else {
    echo "0 results";
} */

?>