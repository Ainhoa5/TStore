<?php 
// In /index.php
require_once 'config/app.php';
$router = new Router();

require_once 'routes.php'; // This should be here to ensure routes are loaded

// Get the 'url' parameter from the query string
$uri = $_GET['url'] ?? '';  // Use the null coalescing operator for default empty string

echo "URI: $uri"; // Debugging line
list($controller, $method) = explode('@', $router->direct($uri));

// Instantiate the controller and call the method
$controllerInstance = new $controller();
$controllerInstance->$method();

