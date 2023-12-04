<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../build/css/adminlogin.css">
    <!-- links icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- links de la fuente de letra -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <title>ADMIN FORM</title>
</head>
<body>

    <div class="container-form">
        <div class="information">
            <div class="info-childs">
                <h2>WELCOME</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui deleniti ratione tempora, alias pariatur non doloremque enim hic impedit praesentium repellat.</p>
                <input type="button" value="Volver" id="sign-up">
            </div>

    <script>
    // Obtener el botón por su ID
    var volverButton = document.getElementById('sign-up');

    // Agregar un evento de clic al botón
    volverButton.addEventListener('click', function() {
        // Redirigir a la página de índice (cambia 'index.html' por la ruta correcta)
        window.location.href = '../../index.php';
        });
    </script>

        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <div class="icons">
                    <i class='bx bx-envelope'></i>
                    <i class='bx bxl-meta'></i>
                </div>
                <p>Iniciar Sesión con una cuenta Administrador</p>
                <form class="form" >
                    <label >
                        <i class='bx bxs-envelope'></i>
                        <input type="email" placeholder="Correo electrónico">
                    </label>
                    <label >
                        <i class='bx bx-lock'></i>
                        <input type="password" placeholder="Contraseña">
                    </label>
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>

    <!-- Enlace al JS -->
    <!-- <script src="scripts/script.js"></script> -->
</body>
</html>