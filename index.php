<?php 
// In /index.php
require 'config/app.php';

$router = new Router;

$router->define([
    '' => 'HomeController@index',
    'authForm' => 'AuthController@showAuthForm',
    'user' => 'AuthController@showUserPage',
    'process-login' => 'AuthController@processLogin',
    'process-signup' => 'AuthController@processSignUp',
    'logout' => 'AuthController@logout',
    'admin/dashboard' => 'AdminController@showDashboard',
    'admin/product/create' => 'ProductController@createForm',
    'admin/product/edit/(:num)' => 'ProductController@createForm',
    'admin/product/delete/(:num)' => 'ProductController@delete',
    'product/save' => 'ProductController@save',
    // other routes...
]);

$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/Projects/TStore/', '', $uri); // Adjust this based on your project structure
$uri = trim($uri, '/');
$router->direct($uri);


