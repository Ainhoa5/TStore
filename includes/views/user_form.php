<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../build/css/clientlogin.css">
    <!-- links icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- links de la fuente de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <title>CLIENT FORM</title>
</head>

<body>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui deleniti ratione tempora, alias pariatur non doloremque enim hic impedit praesentium repellat.</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>

        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una Cuenta</h2>
                <div class="icons">
                    <i class='bx bx-envelope'></i>
                    <i class='bx bxl-meta'></i>
                </div>
                <p>o usa tu email para registrarte</p>
                <form class="form" action="../controllers/UserController.php" method="post">
                    <label>
                        <i class='bx bx-user'></i>
                        <input type="text" placeholder="Nombre">
                    </label>
                    <label>
                        <i class='bx bxs-envelope'></i>
                        <input type="email" name="email" placeholder="Correo electrónico">
                    </label>
                    <label>
                        <i class='bx bx-lock'></i>
                        <input type="password" name="password" placeholder="Contraseña">
                    </label>
                    <input type="submit" name="registrarse" value="Registrarse">
                </form>
            </div>
        </div>
    </div>



    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui deleniti ratione tempora, alias pariatur non doloremque enim hic impedit praesentium repellat.</p>
                <input type="button" value="Registrarse" id="sign-up">
            </div>

        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <div class="icons">
                    <i class='bx bx-envelope'></i>
                    <i class='bx bxl-meta'></i>
                </div>
                <p>Iniciar Sesión con una cuenta</p>
                <form class="form" action="../controllers/UserController.php" method="post">
                    <label>
                        <i class='bx bxs-envelope'></i>
                        <input type="email" name="email" placeholder="Correo electrónico">
                    </label>
                    <label>
                        <i class='bx bx-lock'></i>
                        <input type="password" name="password" placeholder="Contraseña">
                    </label>

                    <input type="submit" name="login" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>

    <!-- Enlace al JS -->
    <script src="../../build/scripts/clientlogin.js"></script>
</body>

</html>