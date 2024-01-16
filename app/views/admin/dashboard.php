<!-- In /app/views/admin/dashboard.php -->

<h1>Product Dashboard</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock</th>
        <!-- Add other fields as needed -->
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo htmlspecialchars($product['ProductoID']); ?></td>
            <td><?php echo htmlspecialchars($product['Nombre']); ?></td>
            <td><?php echo htmlspecialchars($product['Descripcion']); ?></td>
            <td><?php echo htmlspecialchars($product['Precio']); ?></td>
            <td><?php echo htmlspecialchars($product['Stock']); ?></td>
            <!-- Display other fields as needed -->
        </tr>
    <?php endforeach; ?>
</table>
