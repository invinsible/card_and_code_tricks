<?php

class Router
{

    protected $routes = [];

    public function __construct(array $routes)
    {

        foreach ($routes as $key => $val) {
            $this->add($key, $val);
        }

    }

    public function add($route, $param)
    {
        if ($route != '/') {
            $route = ltrim($route, '/');
        }

        $route = '#^' . $route . '$#';
        $this->routes[$route] = $param;
    }

    public function getRoute(string $getParam)
    {
        foreach ($this->routes as $route => $param) {
            
            if (preg_match($route, $getParam)) { 
                require 'controllers/' . $param['controller'] . '.php';

                $controller = new $param['controller'];
                $action = $param['action'];
                
                return $controller->$action();
            }
        }
        return false;
    }

    public function run(string $getParam)
    {
        echo $this->getRoute($getParam);

    }
}
