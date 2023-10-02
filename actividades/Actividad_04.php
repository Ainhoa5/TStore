<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_04</title>
</head>
<body>
        <?php include '../includes/header.php';

        // Realizar un programa en PHP que muestre un valor al azar entre 1 y 1000. Para ello
        // puedes utilizar la función rand(valor_inicio, valor_final)
        $numero = rand(1, 1000);
        print("El numero aleatorio es: ");
        echo var_dump($numero);

        include '../includes/footer.php';
        ?>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>