<?php include '../includes/header.php';
// Realizar un programa en el que se declare una variable de cada tipo de dato;  -->
// Booleans
$logueado = true;
echo var_dump($logueado)."<- Boolean"."<br>";

// Integers
$numero = 13;
echo var_dump($numero)."<- Integers"."<br>";

// Floats
$float = 200.15; // Made a slight modification to represent a float.
echo var_dump($float)."<- Floats"."<br>";

// Strings
$string = "Hello, World!";
echo var_dump($string)."<- Strings"."<br>";

// NULL
$nullVar = NULL;
echo var_dump($nullVar)."<- NULL"."<br>";

// Arrays
$albums = array("Reputation","1989","Speak Now", "Evermore", "Guts");
echo var_dump($albums)."<- Arrays"."<br>";

// Objects
$nullVar = NULL;
echo var_dump($nullVar)."<- NULL"."<br>";



// Que se utilicen las comillas simples y dobles;  -->
// que se concatenen varias cadenas;  -->
// que se concatenen varias cadenas con sus valores correspondientes;  -->
// que se realice la salida de una de las cadenas mediante echo y mediante print;  -->
// que se declare una constante (mediante define y const);  -->
// que se utilice var_dump();  -->
// donde se realice una conversión explícita de tipos; donde haga uso de referencias  -->
include '../includes/footer.php';
?>