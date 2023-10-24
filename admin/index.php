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
    <button type="button">CREAR</button>
    <hr>
    <!-- tabla -->
    <table border="1">
        <thead>
            <!-- <th>Imagen</th> -->
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Descripción</th>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                <td><?php echo $row["Nombre"]?></td>
                <td><?php echo $row["Precio"]?></td>
                <td><?php echo $row["Stock"]?></td>
                <td><?php echo $row["Categoria"]?></td>
                <td><?php echo $row["Descripción"]?></td>
                <td>
                    <form action="propiedades/update.php" method="GET">
                        <input type="hidden" name="id_to_edit" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </td>
                <td>
                    <form action="propiedades/delete.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
            
        </tbody>
    </table>
</body>

</html>