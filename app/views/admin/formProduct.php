<!-- In /app/views/admin/formProduct.php -->
<?php
// Include the Functions class
require_once 'config/functions.php';

// Use the function
$baseUrl = Functions::getBaseUrl();
$cssPath = $baseUrl . '/public/css/';
$imgPath = $baseUrl . '/public/img/products';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($product) ? 'Edit Product' : 'Create Product'; ?></title>
    <link rel="stylesheet" href="<?php echo $cssPath; ?>forms.css">
</head>

<body>
    
    <form action="<?php echo $baseUrl; ?>/product/save" method="POST" id="modern-form" enctype="multipart/form-data">
        <input type="hidden" name="ProductoID" value="<?php echo isset($product) ? $product['ProductoID'] : ''; ?>">
        <?php echo isset($product) ? $product['ProductoID'] : 'No tiene'; ?>

        <div class="form-group">
            <label for="Nombre">Product Name:</label>
            <input type="text" id="Nombre" name="Nombre" value="<?php echo isset($product) ? $product['Nombre'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="Descripcion">Description:</label>
            <textarea id="Descripcion" name="Descripcion" required><?php echo isset($product) ? $product['Descripcion'] : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="Precio">Price:</label>
            <input type="number" id="Precio" name="Precio" step="0.01" value="<?php echo isset($product) ? $product['Precio'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="Stock">Stock:</label>
            <input type="number" id="Stock" name="Stock" value="<?php echo isset($product) ? $product['Stock'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="Categoria">Category:</label>
            <input type="text" id="Categoria" name="Categoria" value="<?php echo isset($product) ? $product['Categoria'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="ImagenURL">Image URL:</label>
            <input type="file" id="ImagenURL" name="ImagenURL" accept="image/jpeg, image/png">
        </div>
        <button type="submit">Send</button>
    </form>
    <?php 
    if (isset($_SESSION['form_data'])) {
        // Form fields are populated using $_SESSION['form_data']
        unset($_SESSION['form_data']); // Clear the form data after populating the form
    }
    ?>
</body>

</html>