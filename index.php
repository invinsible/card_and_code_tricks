<?php

// Вывод ошибок на экран (notice, warning и тд)
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'libs/SingletonTrait.php';
require_once 'libs/Router.php';
require_once 'libs/BaseModel.php';
require_once 'libs/DB.php';
require_once 'models/Deck.php';
require_once 'models/Requisite.php';
require_once 'libs/Config.php';

$myConfig = Config::getInstance();
$myConfig->load(require 'config.php');

// Функция, чтобы быстрее и удобнее смотреть работу
function debug($str)
{
    echo('<pre>');
    var_dump($str);
    echo('</pre>');

    die();
}


$route = new Router($myConfig->routes);
$route->run($_GET['r'] ?? '/');
