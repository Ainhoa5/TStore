<?php
/* add header */
require_once '../../includes/funciones.php';
$RELATIVE_PATH_TO_ROOT = "../../";
incluirTemplate('header', true, $RELATIVE_PATH_TO_ROOT);
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
    <form action="<?php echo $RELATIVE_PATH_TO_ROOT.'includes/actions/ProductActions.php'?>" method="post" id="modern-form" enctype="multipart/form-data">
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
                <input type="text" id="category" name="category" required>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="file" id="image_url" name="image_url" accept="image/jpeg, image/png" required>
            </div>

            <input type="hidden" name="action" value="create">
            <input type="submit" value="Create Product">
    </form>
</body>

</html>