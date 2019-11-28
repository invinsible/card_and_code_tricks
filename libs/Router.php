<?php

/**
 * Class Router
 */
class Router
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * Сохраняем в переменную массив
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Роутинг
     * @param string $getParam
     */
    public function run(string $getParam)
    {
        $controllerName = 'IndexController';
        $actionName = 'actionIndex';

        if (array_key_exists($getParam, $this->routes)) {

            $controllerName = $this->routes[$getParam]['controller'];
            $actionName = $this->routes[$getParam]['action'];

        } elseif ($getParam != '/') {

            $paramParts = explode('/', $getParam);

            $controllerName = ucfirst($paramParts[0]) . 'Controller';

            if (isset($paramParts[1])) {
                $actionName = 'action' . ucfirst($paramParts[1]);
            };
        }

        $is404 = $this->isPage404($controllerName, $actionName);

        if ($is404) {
            $response = 'page 404';
        } else {
            $response = $this->startController($controllerName, $actionName);
        }

        $this->output($response);

    }

    /**
     * Проверка наличия контроллера и экшена
     * @param string $controllerName
     * @param string $actionName
     * @return bool
     */
    public function isPage404(string $controllerName, string $actionName): bool
    {
        if (!file_exists('controllers/' . $controllerName . '.php')) {
            return true;
        }

        require_once 'controllers/' . $controllerName . '.php';

        return !method_exists($controllerName, $actionName);
    }

    /**
     * Запуск нужного контроллера и экшена
     * @param string $controllerName
     * @param string $actionName
     * @return string
     */
    public function startController(string $controllerName, string $actionName): string
    {
        require_once 'controllers/' . $controllerName . '.php';

        $controller = new $controllerName;

        return $controller->$actionName();
    }

    /**
     * Вывод на экран
     * @param string $response
     */
    public function output(string $response)
    {
//        echo '****HEADER****<br>';
        echo $response;
//        echo '<br>****FOOTER****';
    }

}
