<!-- En /app/views/updateCategoriaForm.php -->
<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Update</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>forms.css">
        <!--BOX ICONS-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <form id="edit-categoria-form">
        <br>
        <div class="form-group">
        <input type="hidden" id="cat_id" name="cat_id">
        <input type="text" id="cat_nom" name="cat_nom" placeholder="Category Name" required>
        <br>
        <textarea id="cat_obs" name="cat_obs" placeholder="Category Description"></textarea>
        <br>

        <button  type="submit">Update Product</button>
        </div>

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

    <!--Scroll top-->
    <a href="/admin/dashboard/categorias" class="scroll">
        <i class='bx bxs-ghost bx-tada'></i>
    </a>

    <script src="/scripts/updateCategoriaForm.js"></script>

</body>

</html>