<?php include '../includes/header.php';

    // Realizar un program en el que se declare una variable de cada tipo:
    
    // 1. Que se utilicen las comillas simples y dobles
    
    // 2. Que se concatenen varias cadenas %

    // 3. Que se concatenen varias cadenas con sus valores correspondientes
    
    // 4. Que se realice la salida de una de las cadenas mediante echo y mediante print-
    
    // 5. Que se declare una constante mediante define y const
    
    // 6. Utilizar var_dump();
    
    // 7. Realizar una conersión de tipos donde haga uso de referencias.
    
        //String
        $string = "Hola, soy Damián";
        $apellido ="Y mi apellido es Rodríguez";
        echo var_dump($string).$apellido."<br>";

        //Constante
        define("NOMBRE",    "Damián");
        const MIN_VALUE = 0.0; 
        const MAX_VALUE = 10.0;

        //Boolean
        $admin = false;
        echo var_dump($admin)."<br>";
       

        //Int
        $edad=21;
        // echo var_dump($edad)."<br>";
        print($edad)."<br>";
        
        //Float
        $pi=3.1416;
        echo var_dump($pi)."<br>";

        //Null/Vacío
        $Mynull= NULL;
        echo var_dump($Mynull)."<br>";

        //Array
        $comida = array("Paella","Papas con mojo","Hamburguesa", "Pizza");
        echo var_dump($comida)."<br>";

    include '../includes/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad_01</title>
</head>
<body>
    <br>
    <ul>
    <li><a href="../index.php">Volver a la anterior Página</a></li>
    </ul>

</body>
</html>