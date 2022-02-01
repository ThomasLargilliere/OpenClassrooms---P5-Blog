<?php

class Application
{
    public static function process()
    {
        $controllerName = "Router";
        $task = "index";

        if (!empty($_GET['action'])){
            $controllerName = ucfirst($_GET['action']);
        }

        if (!empty($_GET['task'])){
            $task = $_GET['task'];
        }

        $controllerName = "\Controllers\\" . $controllerName;

        $controller = new $controllerName();
        $controller->$task();
    }
}