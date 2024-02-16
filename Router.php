<?php
// In /Router.php

class Router
{
    /**
     * @var array $routes Asocia todas las rutas URI con sus controladores y acciones correspondientes.
     */
    protected $routes = [];

    /**
     * definir todas las rutas disponibles en la aplicación.
     * 
     * $routes es un arreglo asociativo donde las llaves son las rutas URI 
     * y los valores son las acciones del controlador, 
     * por ejemplo, 'admin/dashboard' => 'AdminController@showDashboard'.
     *
     * @param array $routes Las rutas a definir, donde las claves son las rutas URI y los valores son las acciones del controlador.
     * @return void
     */
    public function define($routes)
    {
        $this->routes = $routes;
    }

    /**
     * punto de entrada para manejar una solicitud URI
     *
     * Recibe $uri, que es la URI solicitada, y la compara con las rutas definidas.
     * Utiliza un bucle foreach para iterar a través de todas las rutas definidas 
     * y utiliza el método match para verificar si alguna coincide con la $uri.
     * 
     * @param string $uri La URI solicitada.
     * @return mixed El resultado de la acción del controlador llamado.
     * @throws \Exception Si no se encuentra una ruta definida para la URI.
     */
    public function direct($uri)
    {
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

    /**
     * 
     * Compara una ruta definida con la URI solicitada para encontrar una coincidencia.
     * 
     *         Este método compara una ruta definida ($route) con la URI solicitada ($uri).
     * Divide ambas cadenas en segmentos basados en '/' y luego compara estos segmentos.
     * Si la ruta definida incluye un segmento (:num), verifica que el segmento correspondiente en la $uri sea numérico.
     * Si todos los segmentos coinciden (teniendo en cuenta los segmentos dinámicos), retorna true; de lo contrario, false.
     * 
     * @param string $route La ruta definida.
     * @param string $uri La URI solicitada.
     * @return array Un array que contiene un booleano indicando si hay una coincidencia y un array de parámetros capturados.
     */
    protected function match($route, $uri)
    {
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


    /**
     * Llama a la acción del controlador especificada, pasando los parámetros adicionales si los hay.
     *
     * Una vez que se encuentra una coincidencia, 
     * este método es llamado con el controlador y la acción extraídos de la ruta definida.
     * 
     * Crea una instancia del controlador y luego llama al método de acción correspondiente en ese controlador.
     * Los parámetros adicionales de la URI (si los hay) se pasan a este método de acción. 
     * Utiliza array_slice para obtener estos parámetros, 
     * asumiendo que la estructura de la URI es siempre /base/controller/method/param.
     * 
     * @param string $controller El nombre del controlador.
     * @param string $action La acción del controlador a llamar.
     * @param mixed ...$params Parámetros adicionales para pasar a la acción del controlador.
     * @return mixed El resultado de la acción del controlador.
     * @throws \Exception Si el controlador o la acción especificados no existen.
     */
    protected function callAction($controller, $action, ...$params)
    {
        $controller = "App\\Controllers\\" . $controller;

        if (!class_exists($controller)) {
            throw new Exception("Controller {$controller} not found.");
        }

        $controllerInstance = new $controller();

        if (!method_exists($controllerInstance, $action)) {
            throw new Exception("{$controller} does not respond to the {$action} action.");
        }

        return $controllerInstance->{$action}(...$params);
    }




}
