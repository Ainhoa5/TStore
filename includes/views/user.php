<?php 
include '../../includes/config/database.php';
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['UsuarioID'])) {
    // IF NOT -> redirect to the sign in / log in form page
    header("Location: login_form.php"); // Replace 'login_form.php' with your actual login form page
    exit();
} else {
    // IF YES -> show user data
    $conn = conectarDB();
    $id = $_SESSION['UsuarioID'];
    $sql = "SELECT * FROM Usuarios WHERE UsuarioID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}
?>
<?php
    include 'includes/funciones.php';
    incluirTemplate('header', false, '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <div>
        <h1><?php echo $user['Nombre']; ?></h1>
        <p><?php echo $user['Apellido']; ?></p> <!-- Assuming you have an Apellido field -->
        <p><?php echo $user['Email']; ?></p> <!-- Assuming you have an Email field -->
        <p><?php echo $user['Direccion']; ?></p> <!-- Assuming you have a Direccion field -->
        <p><?php echo $user['Ciudad']; ?></p> <!-- Assuming you have a Ciudad field -->
        <p><?php echo $user['Estado']; ?></p> <!-- Assuming you have an Estado field -->
        <p><?php echo $user['Pais']; ?></p> <!-- Assuming you have a Pais field -->
        <p><?php echo $user['CodigoPostal']; ?></p> <!-- Assuming you have a CodigoPostal field -->
    </div>
</body>
</html>
