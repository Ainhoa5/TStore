<?php
    require_once '../config/database.php';
    require_once '../models/Product.php';
    require_once '../controllers/ProductController.php';
    
    // instanciate the model and controller
    $db = conectarDB();
    $productModel = new Product($db);
    $productController = new ProductController($productModel);
    
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Let the controller handle the form submission
        $productController->createProduct();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../build/css/forms.css">
</head>

<body>
    <form action="create_product_form.php" method="post" id="modern-form">
        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category">
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url">
            </div>

            <input type="submit" value="Create Product">
    </form>
</body>

</html>