<?php

namespace Router;

use Controller;

class Router
{
    public function dispatch()
    {
        $controllerName = $_GET['controller'];
        $actionName = $_GET['action'];
        $controllerName = 'todo';
        $actionName = 'addActivity';

        if (empty($controllerName) || empty($actionName)) {
            echo "您访问的接口不存在";
            return;
        }

        $controllerName = '\Controller\\' . ucwords($controllerName);

        if (class_exists($controllerName, true) == false) {
            echo "您访问的接口不存在111";
            return;
        }

        $controller = new $controllerName();

        if (method_exists($controller, $actionName) == false) {
            echo "您访问的接口不存在";
            return;
        }

        $controller->$actionName();  
    }
}