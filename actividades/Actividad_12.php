

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_12</title>
</head>
<body>
    <!-- Desarrollar un programa que recibe una cadena de valores enteros separados por coma
    que representa los “saltos". El mismo deberá mostrar el número en la posición actual y
    a continuación saltar tantas posiciones como el número indicado, mostrando en esas
    posiciones _ (underscore) y volviendo a empezar. En el caso de mostrar un 0, se finaliza. -->
    <?php include '../includes/header.php';

function calcularSaltos($nsaltos) {
    // Convertir la cadena en un array con numeros
    $myarray = explode(',', $nsaltos);
    
    // Inicializar la posición actual en 0
    $posicionActual = 0;
    
    // Recorrer el array de saltos
    while ($posicionActual < count($myarray)) { //Count sirve para contar los elementos que hay dentro de un array
        // Obtener el valor en la posición actual
        $salto = $myarray[$posicionActual];
        
        // Comprobar si el salto es 0, cual caso se terminaría
        if ($salto == 0) {
            break;
        }
        
        // Mostrar el número en la posición actual
        echo $salto;
        
        // Avanzar tantas posiciones como indique el salto
        for ($i = 0; $i < $salto; $i++) {
            $posicionActual++;
            // Mostrar un _ en las posiciones avanzadas
            if ($posicionActual < count($myarray)) {
                echo '_';
            }
        }
    }
}

$nsaltos = "3,2,1,2,4,1,0,5";
calcularSaltos($nsaltos);


    include '../includes/footer.php';
    ?>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>