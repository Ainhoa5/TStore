<!-- In /app/views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>admin.css">
    <!-- Add this line for Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!--BOX ICONS-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="button-link-div">
        <a href="product/create" class="button-link">Create a Product</a>
        <a href="/admin/dashboard/categorias" class="button-link">Manejar Categorias</a>


    </div>
    <div class="product-parent">
        <?php
        ?>
        <?php foreach ($products as $product) : ?>
            <div class="product-container">

                <?php
                $imgRealPath = IMG_PRODUCTS_PATH;
                // Check if the image file exists, and set the image URL accordingly
                $imageUrl = file_exists($imgRealPath . $product['ImagenURL'])
                    ? $imgRealPath . $product['ImagenURL']
                    : $imgRealPath . 'default-placeholder.png';
                    
                ?>


                <img src="<?php echo htmlspecialchars('/' . $imageUrl); ?>" alt="Product Image">


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
                    <a href="product/edit/<?php echo $product['ProductoID']; ?>" class="button-link">Edit</a>



                    <!-- Delete Button/Form -->
                    <a href="product/delete/<?php echo $product['ProductoID']; ?>" class="button-link2">Delete</a>

                </div>
            </div>
        <?php endforeach; ?>

    </div>

        <!--Scroll top-->
        <a href="/" class="scroll">
          <i class='bx bxs-ghost bx-tada' ></i>
        </a>

    <!--LOADER-->
    <div class="loader-container">
    <i class='bx bxs-ghost bx-tada' ></i>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    
    <script src="/scripts/admin.js"></script>
    

</body>

</html>