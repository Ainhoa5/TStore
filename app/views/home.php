<!-- 
    View: Home
    Purpose: Display the homepage of the Eras Tour website, featuring a slider of albums and a selection of the latest products.
    Data Expected:
        - $latestProducts: An array of product objects to be displayed in the merchandise section.
    Interactivity:
        - Slider: Cycles through album images automatically every 3.5 seconds.
        - Scroll to Top Button: Allows users to scroll back to the top of the page.
    Styling: 
        - Primary styling: css/index.css
        - Icons: Boxicons
        - Fonts: Google Fonts (Inter, Lato, Poppins)
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">

    <!-- ICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Eras Tour</title>

</head>

<body>
    <!-- NOSCRIPT: Mensaje de advertencia si JavaScript está deshabilitado en el navegador del usuario. -->
    <noscript>
        <div style="background-color: white; color: black; padding: 10px; text-align: center;">
            Parece que JavaScript no está habilitado en tu navegador. Algunas características de esta página no
            funcionarán correctamente sin JavaScript.
        </div>
    </noscript>

    <!-- TEMPLATE HEADER: Inclusión del archivo de encabezado común a varias páginas. -->
    <?php include '../app/views/partials/header.php'; ?>

    <!-- SLIDER: Presenta un carrusel de imágenes destacadas. -->
    <div class="slider">
        <!-- Contenedor de los slides. -->
        <div class="slides">
            <!-- Botones de radio para la navegación automática del slider. -->
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">
            <input type="radio" name="radio-btn" id="radio5">
            <!-- slide images start -->
            <div class="slide first">
                <img src="img/index/01_Speak_Now_Slider.png" alt="">
            </div>
            <div class="slide">
                <img src="img/index/02_Red_Slider.png" alt="">
            </div>
            <div class="slide">
                <img src="img/index/03_1989_Slider.png" alt="">
            </div>
            <div class="slide">
                <img src="img/index/04_Reputation_Slider.png" alt="">
            </div>

            <div class="slide">
                <img src="img/index/05_Lover_Slider.png" alt="">
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
        setInterval(function () {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 5) {
                counter = 1;
            }
        }, 3500);
    </script>


    <div class="merch-container">
        <?php foreach ($latestProducts as $product): ?>
            <div class='box'>

                <div class='box-img'>
                    <a href="/erasTour">
                        <!-- Image and product details -->
                        <?php
                        // Assuming $imgPath contains the path to the image folder relative to the server file system
                        $imgRealPath = IMG_PRODUCTS_PATH;
                        // Check if the image file exists, and set the image URL accordingly
                        $imageUrl = file_exists($imgRealPath . $product['ImagenURL'])
                            ? $imgRealPath . $product['ImagenURL']
                            : $imgRealPath . 'default-placeholder.png';
                        ?>

                        <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="Product Image">
                    </a>
                </div>
                <h2>
                    <?php echo htmlspecialchars($product['Nombre']); ?>
                </h2>
                <h3>
                    <?php echo htmlspecialchars($product['Descripcion']); ?>
                </h3>
                <span>
                    <?php echo htmlspecialchars($product['Precio']); ?>€
                </span><a href="/erasTour">
                    <i class='bx bxs-badge-dollar bx-tada'></i>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    </section>


    <!-- TEMPLATE FOOTER -->
    <?php include '../app/views/partials/footer.php'; ?>


    <!--Scroll top-->
    <a href="#" class="scroll">
        <i class='bx bxs-up-arrow bx-tada'></i>
    </a>

    <!--LOADER-->
    <div class="loader-container">
        <i class='bx bxs-album bx-spin'></i>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- JavaScript -->
    <script src=<?php echo JS_PATH . "index.js" ?>></script>

</body>

</html>