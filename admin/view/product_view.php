<?php
require_once '../../includes/config/database.php';
require_once '../model/Product.php';
require_once '../controller/ProductController.php';
require_once '../../includes/config/Database.php';

// instanciate the model and controller
$dbConnection = Database::getInstance()->getConnection();
$productModel = new Product($dbConnection);
$productController = new ProductController($productModel);
$products = $productController->showProducts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../build/css/admin.css">
    <!-- Add this line for Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <h1>ADMIN PANEL</h1>
    <a href="create_product_form.php">Create a Product</a>
    <div class="product-parent">
        <?php
        ?>
        <?php foreach ($products as $product) : ?>
            <div class="product-container">
                <img src="../../build/img/products/default-placeholder.png" alt="">
                <h1><?php echo htmlspecialchars($product['Nombre']); ?></h1>
                <p><?php echo htmlspecialchars($product['Descripcion']); ?></p>
                <div class="product-data">
                    <p><?php echo htmlspecialchars($product['Precio']); ?></p>
                    <p><?php echo htmlspecialchars($product['Stock']); ?></p>
                    <p><?php echo htmlspecialchars($product['Categoria']); ?></p>
                </div>
                <div class="product-buttons">
                    <!-- Update Button/Form -->
                    <form action="../../includes/actions/ProductActions.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['ProductoID']; ?>">
                        <input type="hidden" name="action" value="update_form">
                        <button type="submit">Update</button>
                    </form>

                    <!-- Delete Button/Form -->
                    <form action="../../includes/actions/ProductActions.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['ProductoID']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</body>

</html>