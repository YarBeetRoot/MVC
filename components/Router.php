<?php

/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 24.12.2017
 * Time: 11:07
 */
class Router
{

    private $routes;

    public function __construct() {
        $routePath = ROOT . '/config/routes.php';
        $this->routes = include($routePath);
    }

    private function getUri() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run() {
        $uri = $this->getUri();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //news/test/

                //'news/([a-zA-Z]+)' => 'news/index/$1',
                //var_dump($internalRoute);

                //test/10

                //Разбиваем строку на элементы
                $segments = explode('/', $internalRoute);
                //var_dump($segments);

                //Получаем первый элемент и формируем имя Контроллера
                $controllerName =  ucfirst(array_shift($segments) . 'Controller');
                //var_dump($segments);
                //var_dump($controllerName);

                //Получаем первый элемент и формируем имя Action
                $actionName = 'action'. ucfirst(array_shift($segments));
                //var_dump($segments);
                //var_dump($actionName);

                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;
                //var_dump($controllerObject);
                //var_dump($actionName);

                $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                //$result = $controllerObject->$actionName($parameters);

                if ($result != NULL) {
                    break;
                }
            }
        }
    }
}