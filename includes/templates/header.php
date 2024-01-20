
<!-- header.php -->

<?php
    // Verificar la página actual
    $currentPage = basename($_SERVER['PHP_SELF']);

    if ($currentPage == 'index.php') {
?>
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
            <li><a href="/includes/views/Eras.php">Eras</a></li>
            <li><a href="/includes/views/user_form.php">Formulario</a></li>
        </ul>

        <div class="nav-icons">
            <a href="/pages/widget.html"><i class='bx bx-search-alt' ></i></a>
            <a href="/pages/tienda.html"><i class='bx bx-cart-alt'></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
</header>
<?php
    } elseif ($currentPage == 'Eras.php') {
?>
    <header>
            <a href="../../index.php" class="logo">
                <i class='bx bxs-album'></i>
                T-Store
            </a>
    
            <ul class="navlist">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="#" class="active">Speak Now</a></li>
                <li><a href="#" >Red</a></li>
                <li><a href="#">1989</a></li>
                <li><a href="#" >Reputation</a></li>
                <li><a href="#">Lover</a></li>
            </ul>
    
            <div class="nav-icons">
                <a href="#"><i class='bx bx-search-alt' ></i></a>
                <a href="#"><i class='bx bx-cart-alt'></i></a>
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
    </header>
<?php
    }
?>



