<!-- En /app/views/formCategoria.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>forms.css">
        <!--BOX ICONS-->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <form id="category-form">
        <div class="form-group">
        <input type="text" id="cat_nom" name="cat_nom" placeholder="Category Name" required>
        <textarea id="cat_obs" name="cat_obs" placeholder="Category Description"></textarea>
        <button  type="submit">Create a Category</button>
        </div>

  
    </form>

    <!--Scroll top-->
    <a href="/admin/dashboard/categorias" class="scroll">
        <i class='bx bxs-ghost bx-tada'></i>
    </a>

    <!-- Incluir el script JavaScript -->
    <script src="/scripts/formCategoria.js"></script>
</body>


</html>