<?php
/* En /app/views/errorPage.php */
session_start();

// Comprobar si hay un mensaje de error en la sesión
$errorMsg = isset($_SESSION['error']) ? $_SESSION['error'] : 'Un error desconocido ha ocurrido.';
// Limpiar el mensaje de error de la sesión para no mostrarlo de nuevo accidentalmente
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            color: #d9534f;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Error</h1>
        <p><?= htmlspecialchars($errorMsg) ?></p>
        <a href="./">Volver al inicio</a>
    </div>
</body>
</html>
