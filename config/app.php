<?php 
// app.php
define('ROOT_DIR', realpath(__DIR__ . '/..'));
define('VIEWS_DIR', ROOT_DIR . '/app/views/');
define('MODELS_DIR', ROOT_DIR . '/app/models/');
define('CONTROLLERS_DIR', ROOT_DIR . '/app/controllers/');
define('CORE_DIR', ROOT_DIR . '/core/');
define('PARTIALS_DIR', VIEWS_DIR . 'partials/');
define('PRODICTS_DIR', VIEWS_DIR . 'products/');
define('CONFIG_DIR', ROOT_DIR . '/config/');

// views
require_once VIEWS_DIR . 'admin/dashboard.php'; // Include the Product model
// models
require_once MODELS_DIR . 'Product.php'; // Include the Product model
// controllers
// other
require_once CONFIG_DIR . 'database.php'; // Include the Database class
require_once CORE_DIR . 'ActiveRecord.php'; // Include the ActiveRecord class
?>