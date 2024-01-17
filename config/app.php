<?php 
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

// Core classes
require_once CORE_DIR . 'ActiveRecord.php'; // Include the ActiveRecord class
require_once ROOT_DIR . '/Router.php';       // Include the Router class

// Database configuration
require_once CONFIG_DIR . 'database.php';    // Include the Database class

// Models
require_once MODELS_DIR . 'Product.php';     // Include the Product model

// Additional configuration
require_once CONFIG_DIR . 'functions.php'; 


