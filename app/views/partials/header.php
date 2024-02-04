
<header>
        <?php
        // Start the session at the beginning of the script
        session_start();
        ?>
        <a href="#" class="logo">
            <i class='bx bxs-album bx-tada' ></i>
            T-Store
        </a>

        <ul class="navlist">

            <li><a href="#" class="active">Home</a></li>

            <li><a href="#">Eras</a></li>
            
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

            <div class="nav-icons">
            <a href="/pages/widget.html"><i class='bx bx-search-alt' ></i></a>
            <a href="/pages/tienda.html"><i class='bx bx-cart-alt'></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
            </div>
        </ul>


    </header>