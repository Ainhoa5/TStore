<?php 
// Tomar Valores del formulario
// Validar
// Insertar en la base de datos
// Volver
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="create.php">
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre">

        <label for="Descripción">Descripción</label>
        <input type="text" name="Descripción">

        <label for="Descripción">Descripción</label>
        <input type="text" name="Descripción">

        <label for="Precio">Precio</label>
        <input type="text" name="Precio">

        <label for="Stock">Stock</label>
        <input type="text" name="Stock">

        <label for="Categoria">Categoria</label>
        <select name="Categoria" id="Categoria">
            <option value="Red">Red</option>
            <option value="Speak Now">Speak Now</option>
        </select>
    </form>
</body>

</html>