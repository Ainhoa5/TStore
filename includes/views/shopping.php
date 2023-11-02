<?php
    include 'includes/funciones.php';
    incluirTemplate('header', false, '');
?>
<!-- Check if the user is logged in -->
<!-- IF NOT -> redirect to the sign in / log in form page -->
<!-- IF YES -> check if the user has an order -->
<!-- IF NOT -> show form to make an order -->
<!-- IF YES -> show same form to modify order -->