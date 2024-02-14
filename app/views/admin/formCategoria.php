<!-- En /app/views/formCategoria.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <h1>Crear una Categoría</h1>
    <form id="category-form">
        <input type="text" id="cat_nom" name="cat_nom" placeholder="Nombre de la Categoría" required>
        <textarea id="cat_obs" name="cat_obs" placeholder="Observaciones de la Categoría"></textarea>

        <button type="submit">Insertar Categoría</button>
    </form>

    <!-- Incluir el script JavaScript -->
    <script src="/scripts/formCategoria.js"></script>
</body>


</html>