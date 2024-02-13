<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tienda de la página web Aromas&Recetas">
    <title>T-Store-Shop</title>
    <link rel="stylesheet" href="css/erasTour.css">
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
        <?php include '../app/views/partials/header.php'; ?>
     
    <script>
    // Incrusta los datos del producto en una variable de JavaScript
    const productos = <?php echo $productosJson; ?>;

    </script>

        <div class="container">
            <div class="list">

            </div>

            

        </div>

    <!--TIENDA-->
    <div class="card">
            <h1>Card</h1>
            <ul class="listCard"></ul>
            <div class="checkout">
            <button onclick="finalizeOrder()">Puta</button>
                <div class="total">0</div>
                <div class="closeShopping">Close</div>
                
            </div>
        </div>        

   
   
 <!--LOADER-->
 <div class="loader-container">
    <i class='bx bx-dollar bx-tada' ></i>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    
  <!-- JavaScript -->
  <script src=<?php echo JS_PATH."erasTour.js"?>></script>
</body>
</html>