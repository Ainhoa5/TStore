
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_10</title>
</head>
<body>
<!-- Recibes una string de valores separados por coma. Debes eliminar del string los valores
duplicados, mostrando el valor inicial y el valor tras eliminar los duplicados.  -->
   
   <?php include '../includes/header.php';

    //Declaración de la String
    $string ="1,1,2,3,3,4,5,6,6";

    //Convierto la String en un array
    $miarray= explode(",",$string);

    //metodo que elimina los valores duplicados en un array
    $unique = array_unique($miarray);

    //Convertir un array en una string/cadena
    $unique = implode(",", $unique);
    echo "String original: ".$string."<br>";
    echo "String sin repeticiones: ".$unique;

    include '../includes/footer.php';
    ?>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>