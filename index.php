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
    <?php include 'includes/templates/header.php'; ?>

  <!-- INDEX -->

<!-- SLIDER -->
<div class="slider">
    <div class="slides">
        <!-- radio buttons-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <input type="radio" name="radio-btn" id="radio4">
        <input type="radio" name="radio-btn" id="radio5">
        <!-- slide images start -->
        <div class="slide first">
            <img src="/build/img/index/01_Speak_Now_Slider.png" alt="">
        </div>
        <div class="slide">
            <img src="/build/img/index/02_Red_Slider.png" alt="">
        </div>
        <div class="slide">
            <img src="/build/img/index/03_1989_Slider.png" alt="">
        </div>
        <div class="slide">
            <img src="/build/img/index/04_Reputation_Slider.png" alt="">
        </div>
        <div class="slide">
            <img src="/build/img/index/05_Lover_Slider.png" alt="">
        </div>

        <!-- automatic navigation -->
        <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
            <div class="auto-btn5"></div>
        </div>
    </div>
    <!-- manual navigation  -->
    <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
        <label for="radio4" class="manual-btn"></label>
        <label for="radio5" class="manual-btn"></label>
    </div>
</div>
<!-- SLIDER SCRIPT -->
<script type="text/javascript">
    var counter = 1;
    setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 5){
            counter = 1;
        }
    }, 3500);
</script>





  <!-- <section class="home" id="home">
        <div class="home-text">
            <h1>Full Website</h1>
            <h2>Products the <br> Most interesting Things</h2>
            <a href="#" class="btn">Today's Stock</a>
        </div>
        <div class="home-img">
            <img src="build/img/index/DICS-1989.png">
        </div>
    </section> -->

    <!--ABOUT-->
    <!-- <section class="about" id="about">
        <div class="about-img">
            <img src="build/img/index/merch.png">
        </div>
        <div class="about-text">
            <span>About US</span>
            <h2>We speak of Taylor's merch</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et fuga omnis ipsam consequuntur dolor consequatur ullam, voluptas esse optio minima porro corrupti eveniet. Sint, quos ullam aliquid maxime sit tenetur.</p>
            <a href="#" class="btn">Today's Stock</a>
        </div>
    </section> -->

    <!-- MERCH -->
    <!-- <section class="merch" id="merch">
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
    </section> -->

    <!--Footer-->
    <?php include 'includes/templates/footer.php'; ?>

    <!--Scroll top-->
    <a href="#" class="scroll">
    <i class='bx bxs-up-arrow bx-tada' ></i>
    </a>

    <!--LOADER-->
    <div class="loader-container">
        <i class='bx bxs-album bx-spin' ></i>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    
    <!--Enlace al JS-->
    <script src="/build/scripts/index.js"></script>

    
</body>
</html>