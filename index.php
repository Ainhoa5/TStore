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
    <meta name="description" content="Home of T-Store">
    <title>T-Store</title>
    <link rel="stylesheet" href="/build/css/index.css">
    <!--BOX ICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
        <!-- NOSCRIPT -->
        <noscript>
            <div style="background-color: white; color: black; padding: 10px; text-align: center;">
                Parece que JavaScript no está habilitado en tu navegador. Algunas características de esta página no funcionarán correctamente sin JavaScript.
            </div>
        </noscript>
    <!--HEADER-->
    <header>
        <a href="#" class="logo">
            <!-- <i class='bx bx-music'></i> -->
            <!-- <i class='bx bxs-music'></i> -->
            <!-- <i class='bx bx-store'></i> -->
            <!-- <i class='bx bxs-album'></i> -->
            <i class='bx bxs-album bx-tada' ></i>
            T-Store
        </a>

        <ul class="navlist">
            <li><a href="#" class="active">Home</a></li>
            <li><a href="/includes/views/shop.php">Eras</a></li>
            <li><a href="/pages/form.html">Formulario</a></li>
        </ul>

        <div class="nav-icons">
            <a href="/pages/widget.html"><i class='bx bx-search-alt' ></i></a>
            <a href="/pages/tienda.html"><i class='bx bx-cart-alt'></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
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

    <!--Contact-->
    <section class="contact" id="contact">
        <div class="contact-content">
           <div class="contact-text">
                <h2>Contáctanos</h2>
                <p>
                    Para contactarnos, no dudes en utilizar la información proporcionada a continuación.
                    Puedes escribirnos a nuestra dirección de correo electrónico o llamarnos.
                    Además, te invitamos a seguirnos en nuestras redes sociales para mantenerte al tanto de nuestras últimas novedades y actualizaciones.
                   
                </p>
                <div class="social">
                    <a href="#" class="clr"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-whatsapp'></i></a>
                    <a href="#"><i class='bx bx-envelope'></i></a>
                </div>
           </div>

           <div class="details">
                <!--Ubicación-->
                <div class="main-d">
                    <a href="#"><i class='bx bx-location-plus'></i>Las Palmas de Gran Canaria</a>
                </div>

                <!--Correo-->
                <div class="main-d">
                    <a href="#"><i class='bx bx-envelope'></i></i>Aromas&Recetas@gmail.com</i></a>
                </div>

                <!--Telefono-->
                <div class="main-d">
                    <a href="#"><i class='bx bx-phone-call'></i>+34 726 15 43 19</i></a>
                </div>

           </div>
        </div>
    </section>

    <!--Scroll top-->
    <a href="#" class="scroll">
        <i class='bx bxs-up-arrow'></i>
    </a>

    <!--LOADER-->
    <div class="loader-container">
        <!-- <img src="img/index/Cube-white.gif" alt=""> -->
        <i class='bx bxs-album bx-spin' ></i>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    
    <!--Enlace al JS-->
    <script src="/build/scripts/index.js"></script>

    
</body>
</html>