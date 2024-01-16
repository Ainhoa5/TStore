<?php 
// In /routes.php

$router = new Router();

$router->define([
    'admin/dashboard' => 'Controllers\AdminController@showDashboard',
    // other routes...
]);

?>