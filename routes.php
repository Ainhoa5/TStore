<?php 
// In /routes.php

$router = new Router();

$router->define([
    '' => 'HomeController@index', // Example route for the root URI
    'admin/dashboard' => 'AdminController@showDashboard',
    // other routes...
]);

?>