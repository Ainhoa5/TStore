<?php 
// In /index.php

// to start:
// php -S localhost:3000 -t public
require '../config/app.php';

$router = new Router;

$router->define([
    '' => 'HomeController@index',
    'errorPage' => 'ErrorController@errorPage',
    'user' => 'AuthController@showUserPage',
    'authForm' => 'AuthController@showAuthForm',
    'process-login' => 'AuthController@processLogin',
    'process-signup' => 'AuthController@processSignUp',
    'logout' => 'AuthController@logout',
    'admin/dashboard' => 'AdminController@showDashboard',
    'admin/product/create' => 'ProductController@createForm',
    'admin/product/edit/(:num)' => 'ProductController@createForm',
    'admin/product/delete/(:num)' => 'ProductController@delete',
    'product/save' => 'ProductController@save',
    'erasTour' => 'HomeController@erasTour',
    // API
    'admin/dashboard/categorias' => 'AdminController@showCategoriasDashboard',
    'createCategoria' => 'CategoriesController@showForm',
    'api/categorias' => 'CategoriesController@getCategoriasJson',
    'api/deleteCategoria' => 'CategoriesController@deleteCategoria',
    'api/getCategoriaById' => 'CategoriesController@getCategoriaById',
    'api/addCategoria' => 'CategoriesController@addCategoria',
    'api/updateCategoria' => 'CategoriesController@updateCategoria',
    'updateFormCategoria' => 'CategoriesController@fillUpdateForm',
    // other routes...
]);

$uri = $_SERVER['REQUEST_URI'];
$uri = str_replace('/proyectos/TStore/', '', $uri); // Adjust this based on your project structure
$uri = trim($uri, '/');
$router->direct($uri);


