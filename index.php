<?php

// Вывод ошибок на экран (notice, warning и тд)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'libs/Router.php';
$routes = require 'routes.php';

// Функция, чтобы быстрее и удобнее смотреть работу
function debug($str)
{
    echo('<pre>');
    var_dump($str);
    echo('</pre>');
}


$route = new Router($routes);
$route->run($_GET['r'] ?? '/');
