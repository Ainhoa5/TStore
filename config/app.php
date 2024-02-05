<?php 
namespace Config;
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
require_once CORE_DIR . 'ActiveRecord.php'; // Include the ActiveRecord class
require_once ROOT_DIR . '/Router.php';       // Include the Router class

// Config files
require_once CONFIG_DIR . 'database.php';    // Include the Database class
require_once CONFIG_DIR . 'functions.php'; // last
require_once CONFIG_DIR . 'Validator.php'; // last

// Models
require_once MODELS_DIR . 'Product.php';     // Include the Product model
require_once MODELS_DIR . 'User.php';     // Include the Product model

// Controllers 
require CONTROLLERS_DIR . 'HomeController.php';
require CONTROLLERS_DIR . 'AdminController.php';
require CONTROLLERS_DIR . 'ProductController.php';
require CONTROLLERS_DIR . 'AuthController.php';
require CONTROLLERS_DIR . 'ErrorController.php';


