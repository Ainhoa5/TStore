<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_09</title>
</head>
<body>
    <?php include '../includes/header.php';

// 9. Declara un array con los valores: 1, 2, ‘antonio’, 200, ‘pepe’. Recorre el array empezando
// por el último elemento, ‘pepe’, mostrando cada elemento en una línea separada.

    //Declaración del Array
    $valores = array(1,2,'antonio',200,'pepe');

    //obtención del número total de elementos que hay en el array
    $nvalores = count($valores);

    //Recorrer el array de forma contraria
    for($n = $nvalores -1; $n >= 0; $n--){
        echo $valores[$n]."<br>";
    }
    include '../includes/footer.php';
    ?>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>