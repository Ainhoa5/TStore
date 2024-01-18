<?php 
// In /index.php
require 'config/app.php';

$router = new Router;

$router->define([
    '' => 'HomeController@index',
    'admin/dashboard' => 'AdminController@showDashboard',
    'admin/product/create' => 'ProductController@createForm',
    'admin/product/edit/(:num)' => 'ProductController@createForm',
    'product/save' => 'ProductController@save',
    // other routes...
]);

$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/Projects/TStore/', '', $uri); // Adjust this based on your project structure
$uri = trim($uri, '/');
$router->direct($uri);


