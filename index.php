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
    public function __construct() {
        $url = $_GET;
        foreach ($url as $key => $value) {
            $result = explode ('/', $value);
            $this->check($result);
        }
    }
    public function check($arr) {
        if (count($arr) == 1) {
            echo ('Вы в разделе ' . $arr[0]);
        } else {
            echo('Вы в разделе ' . $arr[0] . ' на странице ' . $arr[1]);  
        }
    }
    
}

$route = new Router;

