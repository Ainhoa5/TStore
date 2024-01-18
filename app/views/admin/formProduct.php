<!-- In /app/views/admin/formProduct.php -->

<form action="/product/save" method="POST">
    <input type="hidden" name="id" value="<?php echo isset($product) ? $product['id'] : ''; ?>">

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo isset($product) ? $product['name'] : ''; ?>">

    <!-- Add other fields similarly -->

    <button type="submit"><?php echo isset($product) ? 'Update' : 'Create'; ?> Product</button>
</form>
