<?php include '../includes/header.php';

    // Realizar un programa en PHP que muestre un valor al azar entre 1 y 6 con las caras de
    // un dado. Para ello puedes utilizar la función rand(valor_inicio, valor_final) y realizar la
    // captura de seis imágenes de un dado para hacerlo más visual.

    function dados(){
        $caras = ['<img src=../img/Dado_1.png/','<img src=../img/Dado_2.png/','<img src=../img/Dado_3.png/','<img src=../img/Dado_4.png/','<img src=../img/Dado_5.png/','<img src=../img/Dado_6.png/'];
        $misdados= array_rand($caras);
        echo $caras[$misdados];
    } 
    //LLamo a la función
    dados();
    include '../includes/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_05</title>
</head>
<body>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>