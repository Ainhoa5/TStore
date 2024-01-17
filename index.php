<?php 
// In /index.php
require 'Router.php';
require 'app/controllers/HomeController.php';
require 'app/controllers/AdminController.php';

$router = new Router;

$router->define([
    '' => 'HomeController@index',
    'admin/dashboard' => 'AdminController@showDashboard',
    // other routes...
]);

$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/Projects/TStore/', '', $uri); // Adjust this based on your project structure
$uri = trim($uri, '/');
$router->direct($uri);


