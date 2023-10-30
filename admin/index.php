<?php
// relative path
$path = '../';
include $path . 'includes/config/database.php';

// Execute the query
$result = customQuery("SELECT * FROM Productos ", [], '');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- boton crear -->
    <form action="propiedades/create.php">
        <input type="submit" value="Create">
    </form>
    <hr>
    
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div>
        <h1>
            <?php echo $row["Nombre"] ?>
        </h1>
        <p>
            <?php echo $row["Precio"] ?>
        </p>
        <p>
            <?php echo $row["Stock"] ?>
        </p>
        <p>
            <?php echo $row["Categoria"] ?>
        </p>
        <p>
            <?php echo $row["Descripción"] ?>
        </p>
        <form action="propiedades/update.php" method="GET">
            <input type="hidden" name="id_to_edit" value="<?php echo $row['id']; ?>">
            <input type="submit" value="Edit">
        </form>
        <form action="propiedades/delete.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $row['id']; ?>">
            <input type="submit" value="Delete">
        </form>
    </div>
    <?php endwhile; ?>
</body>

</html>