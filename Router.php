<?php
// In /Router.php

class Router
{
    protected $routes = [];

    /* 
        definir todas las rutas disponibles en la aplicación.

        $routes es un arreglo asociativo donde las llaves son las rutas URI 
        y los valores son las acciones del controlador, 
        por ejemplo, 'admin/dashboard' => 'AdminController@showDashboard'.
    */
    public function define($routes)
    {
        $this->routes = $routes;
    }

    /* 
        punto de entrada para manejar una solicitud URI

        Recibe $uri, que es la URI solicitada, y la compara con las rutas definidas.
        Utiliza un bucle foreach para iterar a través de todas las rutas definidas 
        y utiliza el método match para verificar si alguna coincide con la $uri.
    */
    public function direct($uri) {
        foreach ($this->routes as $route => $action) {
            list($match, $params) = $this->match($route, $uri);
            if ($match) {
                return $this->callAction(
                    ...explode('@', $action),
                    ...$params
                );
            }
        }
    
        throw new Exception('No route defined for this URI.');
    }
    
    

    /* 
        Este método compara una ruta definida ($route) con la URI solicitada ($uri).
        Divide ambas cadenas en segmentos basados en '/' y luego compara estos segmentos.
        Si la ruta definida incluye un segmento (:num), verifica que el segmento correspondiente en la $uri sea numérico.
        Si todos los segmentos coinciden (teniendo en cuenta los segmentos dinámicos), retorna true; de lo contrario, false.
    */
    protected function match($route, $uri) {
        $routeParts = explode('/', $route);
        $uriParts = explode('/', $uri);
        $params = [];
    
        if (count($routeParts) != count($uriParts)) {
            return [false, $params];
        }
    
        foreach ($routeParts as $key => $part) {
            if (strpos($part, '(:num)') !== false) {
                if (!is_numeric($uriParts[$key])) {
                    return [false, $params];
                }
                $params[] = $uriParts[$key];
            } elseif ($part !== $uriParts[$key]) {
                return [false, $params];
            }
        }
    
        return [true, $params];
    }
    
    


    /* 
        Una vez que se encuentra una coincidencia, 
        este método es llamado con el controlador y la acción extraídos de la ruta definida.
    
        Crea una instancia del controlador y luego llama al método de acción correspondiente en ese controlador.
        Los parámetros adicionales de la URI (si los hay) se pasan a este método de acción. 
        Utiliza array_slice para obtener estos parámetros, 
        asumiendo que la estructura de la URI es siempre /base/controller/method/param.
    */
    protected function callAction($controller, $action, ...$params) {
        $controller = new $controller;
    
        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }
    
        return $controller->{$action}(...$params);
    }
    
    
    
}
