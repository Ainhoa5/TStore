<?php
// In /Router.php

class Router {
    protected $routes = [];

    public function define($routes) {
        $this->routes = $routes;
    }

    public function direct($uri) {
        if (array_key_exists($uri, $this->routes)) {
            return $this->callAction(
                ...explode('@', $this->routes[$uri])
            );
        }

        throw new Exception('No route defined for this URI.');
    }

    protected function callAction($controller, $action) {
        $controller = new $controller;
        if (! method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}
