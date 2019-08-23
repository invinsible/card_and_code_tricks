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

if ($_GET) {


class Router {

    protected $routes = [];
    
    public function __construct() {
        $arr = require 'routs.php';        

        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
        
        $this->run();
    }

    public function add($route, $param) {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $param;
    }

    public function check() {
        $url = $_GET;
        foreach ($this->routes as $route => $param) {
            if (preg_match ($route, $url['r'])) {
                return true;
            }
        }
        return false;        
    }

    public function run() {
        if($this->check() == true) {
            echo ('Маршрут найден');
        } else {
            echo ('Чирик');
        }
        
    }
    
}

$route = new Router;

} else {
    echo ('<a href="/?r=tricks/first">First trick</a>');
}