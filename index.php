<?php

// Вывод ошибок на экран (notice, warning и тд)
ini_set ('display_erroes', 1);
error_reporting(E_ALL);


// Функция, чтобы быстрее и удобнее смотреть работу
function debug($str) {
    echo ('<pre>');
    var_dump($str);
    echo ('</pre>');
};



class Router {

    protected $routes = [];
    
    public function __construct() {
        $arr = require 'routs.php';        

        foreach ($arr as $key) {
            $this->add($key);
        }
        
        $this->check();
    }

    public function add($route) {
        $route = '#^' . $route . '$#';
        $this->routes[] = $route;
    }

    public function check() {
        $url = $_GET;
        foreach ($this->routes as $route) {
            if (preg_match ($route, $url['r'])) {
                echo ('Hello');
            } else {
                echo ('404');
            }
        }
        
    }
    
}

$route = new Router;

