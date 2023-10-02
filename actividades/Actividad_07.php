    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actividad_07</title>
    </head>
    <body>
        <!-- Crea y muestra un array con los números pares entre 1 y 100. -->

        <?php include '../includes/header.php';

        //Array para almacenar los numero pares
        $npares = array();
        //bucle for del 1 al 100
        for($n =1; $n <=100; $n++){
            //verificar si un numero es par
            if($n % 2 ==0){ //Si es par se añade al array
                $npares[] =$n;
            }
        }
        echo var_dump($npares);

        include '../includes/footer.php';
        ?>
        <br>
        <ul>
        <li><a href="../index.php">Volver a la anterior Página</a></li>
        </ul>

    </body>
    </html>