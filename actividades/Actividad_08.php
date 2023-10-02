<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_08</title>
</head>
<body>
<!-- 8. Crea un array de 5 números aleatorios entre 20 y 30, y muestralo -->
    
    <?php include '../includes/header.php';

     //Array 
     $numeros= array();

     //Bucle for 
     for($n =0; $n < 5; $n++){
        $numeros2 = rand(20, 30);// Numero aleatorio entre 20 y 30
        $numeros[] = $numeros2; //Se va añadiendo el numero en el array
    }
    echo var_dump($numeros);


    include '../includes/footer.php';
    ?>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>