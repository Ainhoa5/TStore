<?php

require_once 'includes/classes/UserClass.php';
require_once 'includes/config/database.php';
require_once 'includes/controllers/ProductController.php';
require_once 'includes/models/Product.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/index.css">
    <!-- ICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- links de la fuente de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Eras Tour</title>
</head>

<body>
    <!-- HEADER -->
    <?php
    // Start the session at the beginning of the script
    session_start();
    ?>

    <header>
        <a href="#" class="logo">Eras Tour</a>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="#">HOME</a></li>
            <li><a href="#">ERAS TOUR</a></li>
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- User is logged in, show user page link -->
                <li><a href="includes/views/user_page.php">USER PAGE</a></li>
            <?php else : ?>
                <!-- User is not logged in, show login link -->
                <li><a href="includes/views/user_form.php">LOGIN</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']->rol == 'admin') : ?>
                <li><a href="admin/">ADMIN</a></li>
            <?php endif; ?>
        </ul>
    </header>


    <!-- INDEX -->
    <section class="home" id="home">
        <div class="home-text">
            <h1>Full Website</h1>
            <h2>Products the <br> Most interesting Things</h2>
            <a href="#" class="btn">Today's Stock</a>
        </div>
        <div class="home-img">
            <img src="build/img/index/DICS-1989.png">
        </div>
    </section>

    <!--ABOUT-->
    <section class="about" id="about">
        <div class="about-img">
            <img src="build/img/index/merch.png">
        </div>
        <div class="about-text">
            <span>About US</span>
            <h2>We speak of Taylor's merch</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et fuga omnis ipsam consequuntur dolor consequatur ullam, voluptas esse optio minima porro corrupti eveniet. Sint, quos ullam aliquid maxime sit tenetur.</p>
            <a href="#" class="btn">Today's Stock</a>
        </div>
    </section>

    <!-- MERCH -->
    <section class="merch" id="merch">
        <div class="heading">
            <span>Merch</span>
            <h2>Taylor's Products</h2>
        </div>

        <div class="merch-container">
            <?php
            // Suponiendo que ya has instanciado tu controlador

            $dbConnection = Database::getInstance()->getConnection();
            $model = new Product($dbConnection); // Asegúrate de que la clase User esté incluida o cargada
            $controller = new ProductController($model);

            $latestProducts = $controller->showLatestProducts();

            foreach ($latestProducts as $product) {
                echo "<div class='box'>";
                echo "<div class='box-img'>";

                // Construir la ruta de la imagen
                $imagePath = "build/img/products/";
                $fullImagePath = $imagePath . $product['ImagenURL'];

                // Verificar si el archivo de imagen existe
                if (!empty($product['ImagenURL']) && file_exists($fullImagePath)) {
                    $imagePath .= $product['ImagenURL']; // Utilizar la imagen de la base de datos
                } else {
                    $imagePath .= "default-placeholder.png"; // Utilizar imagen por defecto
                }

                echo "<img src='" . htmlspecialchars($imagePath) . "'>";
                echo "</div>";
                echo "<h2>" . htmlspecialchars($product['Nombre']) . "</h2>";
                echo "<h3>" . htmlspecialchars($product['Descripcion']) . "</h3>";
                echo "<span>" . htmlspecialchars($product['Precio']) . "€</span>";
                echo "<i class='bx bxs-cart'></i>";
                echo "</div>";
            }

            ?>
        </div>
    </section>


    <!-- FOOTER -->
    <section id="contact">
        <div class="footer">
            <div class="main">

                <div class="col">
                    <h4>Menu Links</h4>
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">ERAS TOUR</a></li>
                        <li><a href="#">CART</a></li>
                        <li><a href="#">ADMIN</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Term & Conditions</a></li>
                    </ul>
                </div>

                <div class="col">
                    <h4>Contact US</h4>
                    <div class="social">
                        <a href=""><i class='bx bxl-twitter'></i></a>
                        <a href=""><i class='bx bxl-instagram-alt'></i></a>
                        <a href=""><i class='bx bxl-youtube'></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="build/scripts/index.js"></script>

</body>

</html>