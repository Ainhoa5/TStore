<header>
        <?php
        // Start the session at the beginning of the script
        session_start();

        $isHome = basename($_SERVER['PHP_SELF']) === 'user';
        $isErasTourPage = basename($_SERVER['PHP_SELF']) === 'erasTour';
        ?>
        <a href="/" class="logo">
            <i class='bx bxs-album bx-tada' ></i>
            T-Store
        </a>

        <ul class="navlist">
        
            <li><a href="/"<?php if (!$isHome && !$isErasTourPage) echo 'class="active"' ?> >Home</a></li>
            <li><a href="/erasTour" <?php if ($isErasTourPage) echo 'class="active"' ?>>Eras</a></li>
        
            <?php if (isset($_SESSION['user_role'])): ?>
                <!-- User is logged in, show user page link -->
                <li><a href="user" <?php if ($isHome) echo 'class="active"' ?>>User Page</a></li>

                <?php if ($_SESSION['user_role'] == 'admin'): ?>
                    <!-- Additional link for admin users -->
                    <li><a href="admin/dashboard">Dashboard</a></li>
                <?php endif; ?>

        <?php else: ?>
            <!-- User is not logged in, show login link -->
            <li><a href="authForm">LOGIN</a></li>
        <?php endif; ?>
    </ul>
        
        <div class="nav-icons">
                    <a href="#"><i class='bx bx-search-alt' ></i></a>

                    <div class="shopping">
                        <a href="#"><i class='bx bx-cart-alt'></i></a>
                        <span class="quantity">0 </span>
                    </div>

                    <div class="bx bx-menu" id="menu-icon"></div>
                </div>


    </header>