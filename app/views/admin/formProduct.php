<!-- In /app/views/admin/formProduct.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo isset($product) ? 'Edit Product' : 'Create Product'; ?>
    </title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>forms.css">
    <!--BOX ICONS-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <form action="/product/save" method="POST" id="modern-form" enctype="multipart/form-data">
        <input type="hidden" name="ProductoID" value="<?php echo isset($product) ? $product['ProductoID'] : ''; ?>">

        <!-- NOMBRE -->
        <div class="form-group">
            <label for="Nombre">Product Name:</label>
            <input type="text" id="Nombre" name="Nombre"
                value="<?php echo isset($product) ? $product['Nombre'] : ''; ?>" required>
        </div>
        <?php if (isset($_SESSION['validation_errors']['Nombre'])): ?>
            <div class="error-message">
                <?php foreach ($_SESSION['validation_errors']['Nombre'] as $error): ?>
                    <p>
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- DESCRIPCION -->
        <div class="form-group">
            <label for="Descripcion">Description:</label>
            <textarea id="Descripcion" name="Descripcion"
                required><?php echo isset($product) ? $product['Descripcion'] : ''; ?></textarea>
        </div>
        <?php if (isset($_SESSION['validation_errors']['Descripcion'])): ?>
            <div class="error-message">
                <?php foreach ($_SESSION['validation_errors']['Descripcion'] as $error): ?>
                    <p>
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Precio -->
        <div class="form-group">
            <label for="Precio">Price:</label>
            <input type="number" id="Precio" name="Precio" step="0.01"
                value="<?php echo isset($product) ? $product['Precio'] : ''; ?>" required>
        </div>
        <?php if (isset($_SESSION['validation_errors']['Precio'])): ?>
            <div class="error-message">
                <?php foreach ($_SESSION['validation_errors']['Precio'] as $error): ?>
                    <p>
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Stock -->
        <div class="form-group">
            <label for="Stock">Stock:</label>
            <input type="number" id="Stock" name="Stock" value="<?php echo isset($product) ? $product['Stock'] : ''; ?>"
                required>
        </div>
        <?php if (isset($_SESSION['validation_errors']['Stock'])): ?>
            <div class="error-message">
                <?php foreach ($_SESSION['validation_errors']['Stock'] as $error): ?>
                    <p>
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Categoria -->
        <div class="form-group">
            <label for="Categoria">Category:</label>
            <select id="Categoria" name="Categoria" required>
                <!-- Las opciones se llenarán dinámicamente -->
            </select>
        </div>
        <?php if (isset($_SESSION['validation_errors']['Categoria'])): ?>
            <div class="error-message">
                <?php foreach ($_SESSION['validation_errors']['Categoria'] as $error): ?>
                    <p>
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- ImagenURL -->
        <div class="form-group">
            <label for="ImagenURL">Image URL:</label>
            <input type="file" id="ImagenURL" name="ImagenURL" accept="image/jpeg, image/png">
        </div>
        <?php if (isset($_SESSION['validation_errors']['ImagenURL'])): ?>
            <div class="error-message">
                <?php foreach ($_SESSION['validation_errors']['ImagenURL'] as $error): ?>
                    <p>
                        <?php echo htmlspecialchars($error); ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


        <button type="submit">Send</button>
    </form>
    <?php
    if (isset($_SESSION['form_data'])) {
        // Form fields are populated using $_SESSION['form_data']
        unset($_SESSION['validation_errors'], $_SESSION['form_data']); // Clear the form data after populating the form
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function loadCategories() {
            $.ajax({
                url: '/api/categorias', // Adjust this URL to your correct endpoint.
                method: 'GET',
                dataType: 'json', // Expects a response in JSON format.
                success: function (categories) {
                    const select = $('#Categoria'); // Use jQuery to select the element.
                    categories.forEach(category => {
                        // Append an option element to the select element for each category.
                        select.append($('<option>', {
                            value: category.cat_nom, // Use the category name as the option value.
                            text: category.cat_nom // Also use the category name as the option text.
                        }));
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error loading categories:', textStatus, errorThrown);
                }
            });
        }

        $(document).ready(loadCategories);
    </script>


    <!--Scroll top-->
    <a href="/admin/dashboard" class="scroll">
        <i class='bx bxs-ghost bx-tada'></i>
    </a>
</body>

</html>