<?php 
namespace Config;

use Dotenv\Dotenv;

// In /config/app.php

// Define directories
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


// Core classes
require_once CORE_DIR . 'ActiveRecord.php';
require_once ROOT_DIR . '/Router.php';

// Config files
require __DIR__ . '/../vendor/autoload.php';

require_once CONFIG_DIR . 'database.php';
require_once CONFIG_DIR . 'functions.php';
require_once CONFIG_DIR . 'Validator.php';

// Models
require_once MODELS_DIR . 'Categories.php';
require_once MODELS_DIR . 'DetallePedido.php';  
require_once MODELS_DIR . 'Pedidos.php';
require_once MODELS_DIR . 'Product.php';
require_once MODELS_DIR . 'User.php';

// Controllers 
require CONTROLLERS_DIR . 'AdminController.php';
require CONTROLLERS_DIR . 'ApiClient.php';
require CONTROLLERS_DIR . 'AuthController.php';
require CONTROLLERS_DIR . 'CategoriesController.php';
require CONTROLLERS_DIR . 'ErasController.php';
require CONTROLLERS_DIR . 'ErrorController.php';
require CONTROLLERS_DIR . 'HomeController.php';
require CONTROLLERS_DIR . 'PedidosController.php';
require CONTROLLERS_DIR . 'ProductController.php';

// Define enviroment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

