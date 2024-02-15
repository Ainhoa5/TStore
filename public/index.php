<?php 
// In /index.php
/**
 * Punto de entrada principal de la aplicación web.
 *
 * Este archivo inicia la aplicación, configurando y despachando rutas a los controladores correspondientes.
 * Incluye la configuración principal y define las rutas de la aplicación.
 */

// to start:
// php -S localhost:3000 -t public
require '../config/app.php';

/**
 * Instancia del Router.
 *
 * Se utiliza para definir todas las rutas de la aplicación y mapearlas a los controladores correspondientes.
 */
$router = new Router();

/**
 * Definición de rutas.
 *
 * Aquí se especifican todas las rutas disponibles en la aplicación y los controladores que deben manejarlas.
 * Cada ruta se asocia con una acción específica en un controlador.
 */
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
    'erasTour' => 'ErasController@erasTour',
    'order' => 'PedidosController@crearPedido',
    // API
    'admin/dashboard/categorias' => 'AdminController@showCategoriasDashboard',
    'createCategoria' => 'CategoriesController@showForm',
    'api/categorias' => 'CategoriesController@getCategoriasJson',
    'api/deleteCategoria' => 'CategoriesController@deleteCategoria',
    'api/getCategoriaById' => 'CategoriesController@getCategoriaById',
    'api/addCategoria' => 'CategoriesController@addCategoria',
    'api/updateCategoria' => 'CategoriesController@updateCategoria',
    'updateFormCategoria' => 'CategoriesController@fillUpdateForm',
]);

/**
 * Despachar la ruta solicitada.
 *
 * Obtiene la URI actual, la limpia y solicita al router que dirija la solicitud a la acción del controlador correspondiente.
 */
$uri = trim($_SERVER['REQUEST_URI'], '/');
$router->direct($uri);


