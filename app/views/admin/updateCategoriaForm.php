<!-- En /app/views/updateCategoriaForm.php -->
<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/updateForm.css">
</head>

<body>
    <h1>Update Product</h1>
    <form id="edit-categoria-form">
        <input type="hidden" id="cat_id" name="cat_id">
        <input type="text" id="cat_nom" name="cat_nom" placeholder="Nombre de la Categoría" required>
        <textarea id="cat_obs" name="cat_obs" placeholder="Observaciones de la Categoría"></textarea>

        <button type="submit">Actualizar Producto</button>
    </form>
    <script>
    /**
     * Escucha el evento DOMContentLoaded para asegurarse de que el DOM esté completamente cargado
     * antes de intentar acceder a los elementos del formulario de categoría.
     */
    document.addEventListener('DOMContentLoaded', function () {
        // Parsea los datos de la categoría almacenados en localStorage.
        const categoriaArray = JSON.parse(localStorage.getItem('categoryData'));
        const categoria = categoriaArray[0];

        if (categoria) {
            // Rellena los campos del formulario con los datos de la categoría.
            document.getElementById('cat_id').value = categoria.cat_id;
            document.getElementById('cat_nom').value = categoria.cat_nom;
            document.getElementById('cat_obs').value = categoria.cat_obs;

            // Opcional: Limpia localStorage para evitar el uso de datos desactualizados.
            localStorage.removeItem('categoryData');
        }
    });
</script>

    <script src="/scripts/updateCategoriaForm.js"></script>
</body>

</html>