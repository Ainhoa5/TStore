
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_06</title>
</head>
<body>
    <?php include '../includes/header.php';
    $tamaño = rand(200, 700) / 100; // Dividir entre 100% para obtener el porcentaje

    //Mostrar por pantalla el nombre con el tamaño aleatorio
    echo '<h1 style="font-size: ' . $tamaño . 'em;">Damián</h1>';
    include '../includes/footer.php';
    ?>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>