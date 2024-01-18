<!-- In /app/views/admin/dashboard.php -->
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
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $cssPath; ?>admin.css">
    <!-- Add this line for Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <a href="../">Go Back</a>
    <div class="button-link-div">
        <a href="product/create" class="button-link">Create a Product</a>


    </div>
    <div class="product-parent">
        <?php
        ?>
        <?php foreach ($products as $product): ?>
            <div class="product-container">
                <?php echo $product['ImagenURL']; ?>
                <img src="<?php echo file_exists('public/img/products/' . $product['ImagenURL']) ? $imgPath . '/' . $product['ImagenURL'] : $imgPath . '/default-placeholder.png'; ?>"
                    alt="Product Image">


                <h1>
                    <?php echo htmlspecialchars($product['Nombre']); ?>
                </h1>
                <p>
                    <?php echo htmlspecialchars($product['Descripcion']); ?>
                </p>
                <div class="product-data">
                    <p>
                        <?php echo htmlspecialchars($product['Precio']); ?>
                    </p>
                    <p>
                        <?php echo htmlspecialchars($product['Stock']); ?>
                    </p>
                    <p>
                        <?php echo htmlspecialchars($product['Categoria']); ?>
                    </p>
                </div>
                <div class="product-buttons">
                    <!-- Update Button/Form -->
                    <a href="admin/product/edit/<?php echo $product['ProductoID']; ?>" class="button-link">Edit</a>



                    <!-- Delete Button/Form -->
                    <form action="<?php echo $RELATIVE_PATH_TO_ROOT . 'includes/actions/ProductActions.php' ?>"
                        method="post">
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