

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_11</title>
</head>
<body>

<!-- . Dado un array de números, un número es “líder” si su valor es mayor que la suma de
todos los números que se encuentran a su derecha. Escribir un programa que dado un
array de números, devuelva otro array conteniendo los números líderes. -->

<?php include '../includes/header.php';

function encontrarLideres($myarray) {

    $elementos = count($myarray);// Contamos los elementos que hay dentro del array
    $lideres = []; //Se almacena los lideres en este array
    $maxDerecha =$myarray[$elementos - 1];

    for ($i = $elementos - 1; $i >= 0; $i--) {
        if ($myarray[$i] > $maxDerecha) {
            $lideres[] = $myarray[$i];
        }
        $maxDerecha = max($maxDerecha, $myarray[$i]);
    }

    // Invertir el array que contiene los líderes para que estén en el orden original
    $lideres = array_reverse($lideres);

    return $lideres;
}


$myarray = [16, 17, 4, 3, 5, 2];
$lideres = encontrarLideres($myarray);
echo "Los números líderes son: " . implode(", ", $lideres);

include '../includes/footer.php';
?>

    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>


