<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
// views/update_product_form.php

<form action="ProductActions.php" method="post">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="product_id" value="<?php echo $product['ProductoID']; ?>">

    <!-- Other form fields pre-populated with $product data -->
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['Nombre']); ?>">
    <!-- ... more fields ... -->

    <button type="submit">Update Product</button>
</form>

</body>
</html>