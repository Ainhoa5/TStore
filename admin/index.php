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
    <!-- tabla -->
    <table border="1">
        <thead>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Descripción</th>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <form action="update.php" method="GET">
                        <input type="hidden" name="id_to_edit" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Edit">
                    </form>
                </td>
                <td>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $row['id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>