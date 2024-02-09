<header>
        <?php
        // Start the session at the beginning of the script
        session_start();
        ?>
        <a href="/" class="logo">
            <i class='bx bxs-album bx-tada' ></i>
            T-Store
        </a>

        <ul class="navlist">

            <li><a href="/" class="active">Home</a></li>

            <li><a href="erasTour">Eras</a></li>
            
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
        
        <div class="nav-icons">
                    <a href="#"><i class='bx bx-search-alt' ></i></a>

                    <div class="shopping">
                        <a href="#"><i class='bx bx-cart-alt'></i></a>
                        <span class="quantity">0 </span>
                    </div>

                    <div class="bx bx-menu" id="menu-icon"></div>
                </div>


    </header>