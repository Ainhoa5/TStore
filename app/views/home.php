<!-- In /app/views/home.php -->

<?php
// Include the Functions class
require_once 'config/functions.php';

// Use the function
$baseUrl = Functions::getBaseUrl();
$cssPath = $baseUrl . '/public/css/';
$scriptPath = $baseUrl . '/public/scripts/';
$imgPath = $baseUrl . '/public/img/index/';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $cssPath; ?>index.css">
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
    

    <header>
    <?php
    // Start the session at the beginning of the script
    session_start();
    echo $_SESSION['user_role'];
    ?>
        <a href="#" class="logo">Eras Tour</a>
        <div class="bx bx-menu" id="menu-icon"></div>
        <ul class="navbar">
            <li><a href="#">HOME</a></li>
            <li><a href="#">ERAS TOUR</a></li>

            <?php if (isset($_SESSION['user_role'])): ?>
                <!-- User is logged in, show user page link -->
                <li><a href="user">USER PAGE</a></li>

                <?php if ($_SESSION['user_role'] == 'admin'): ?>
                    <!-- Additional link for admin users -->
                    <li><a href="admin/dashboard">ADMIN</a></li>
                <?php endif; ?>

            <?php else: ?>
                <!-- User is not logged in, show login link -->
                <li><a href="authForm">LOGIN</a></li>
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
            <img src="<?php echo $imgPath; ?>DICS-1989.png">
        </div>
    </section>

    <!--ABOUT-->
    <section class="about" id="about">
        <div class="about-img">
            <img src="<?php echo $imgPath; ?>merch.png">
        </div>
        <div class="about-text">
            <span>About US</span>
            <h2>We speak of Taylor's merch</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et fuga omnis ipsam consequuntur dolor
                consequatur ullam, voluptas esse optio minima porro corrupti eveniet. Sint, quos ullam aliquid maxime
                sit tenetur.</p>
            <a href="#" class="btn">Today's Stock</a>
        </div>
    </section>
    <section class="merch" id="merch">
        <div class="heading">
            <span>Merch</span>
            <h2>Taylor's Products</h2>
        </div>

        <div class="merch-container">
            <?php foreach ($latestProducts as $product): ?>
                <div class='box'>
                    <div class='box-img'>
                        <!-- Image and product details -->
                        <?php
                        // Assuming $imgPath contains the path to the image folder relative to the server file system
                        $imgRealPath = "public/img/products/";
                        // Check if the image file exists, and set the image URL accordingly
                        $imageUrl = file_exists($imgRealPath . $product['ImagenURL'])
                            ? $imgRealPath . $product['ImagenURL']
                            : $imgRealPath . 'default-placeholder.png';
                        ?>

                        <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="Product Image">

                    </div>
                    <h2>
                        <?php echo htmlspecialchars($product['Nombre']); ?>
                    </h2>
                    <h3>
                        <?php echo htmlspecialchars($product['Descripcion']); ?>
                    </h3>
                    <span>
                        <?php echo htmlspecialchars($product['Precio']); ?>€
                    </span>
                    <i class='bx bxs-cart'></i>
                </div>
            <?php endforeach; ?>
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
    <script src="<?php echo $scriptPath; ?>index.js"></script>

</body>

</html>