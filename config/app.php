<?php 
namespace Config;
// In /config/app.php

use Dotenv\Dotenv;

/**
 * Configuración principal de la aplicación.
 *
 * Este archivo contiene definiciones de rutas de directorios, configuración de entorno,
 * y la inclusión de clases y archivos necesarios para la operación de la aplicación.
 */

// Definición de rutas de directorios para facilitar el acceso a diferentes partes de la aplicación.
define('ROOT_DIR', realpath(__DIR__ . '/..'));
define('VIEWS_DIR', ROOT_DIR . '/app/views/');
define('MODELS_DIR', ROOT_DIR . '/app/models/');
define('CONTROLLERS_DIR', ROOT_DIR . '/app/controllers/');
define('CORE_DIR', ROOT_DIR . '/core/');
define('PARTIALS_DIR', VIEWS_DIR . 'partials/');
define('PRODUCTS_DIR', VIEWS_DIR . 'products/');
define('CONFIG_DIR', ROOT_DIR . '/config/');
define('CSS_PATH', '/css/');
define('IMG_PATH', 'img/');
define('IMG_INDEX_PATH', IMG_PATH .'index/');
define('IMG_PRODUCTS_PATH', IMG_PATH .'products/');
define('JS_PATH', 'scripts/');


// Carga de clases core de la aplicación.
require_once CORE_DIR . 'ActiveRecord.php'; // Clase base para el patrón Active Record.
require_once ROOT_DIR . '/Router.php'; // Clase para manejar el enrutamiento.

// Carga automática de dependencias a través de Composer.
require __DIR__ . '/../vendor/autoload.php';

// Carga de archivos de configuración y utilidades.
require_once CONFIG_DIR . 'database.php'; // Configuración de la conexión a la base de datos.
require_once CONFIG_DIR . 'functions.php'; // Funciones de utilidad.
require_once CONFIG_DIR . 'Validator.php'; // Clase para validación de datos.

// Carga de modelos.
require_once MODELS_DIR . 'Categories.php';
require_once MODELS_DIR . 'DetallePedido.php';  
require_once MODELS_DIR . 'Pedidos.php';
require_once MODELS_DIR . 'Product.php';
require_once MODELS_DIR . 'User.php';

// Carga de controladores.
require CONTROLLERS_DIR . 'AdminController.php';
require CONTROLLERS_DIR . 'ApiClient.php';
require CONTROLLERS_DIR . 'AuthController.php';
require CONTROLLERS_DIR . 'CategoriesController.php';
require CONTROLLERS_DIR . 'ErasController.php';
require CONTROLLERS_DIR . 'ErrorController.php';
require CONTROLLERS_DIR . 'HomeController.php';
require CONTROLLERS_DIR . 'PedidosController.php';
require CONTROLLERS_DIR . 'ProductController.php';

// Configuración de variables de entorno.
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad(); // Carga segura de variables de entorno desde el archivo .env.

