<?php

class Application
{
    public static function process()
    {
        $controllerName = "Article";
        $task = "index";

        if (!empty($_GET['controller'])) {
            $controllerName = ucfirst($_GET['controller']);
        }

        if (!empty($_GET['task'])) {
            $task = $_GET['task'];
        }

        // Definition du controlleur que l'on veut appeler
        $controllerName = "\Controllers\\" . $controllerName;

        // On l'instancie a l'aide de son nom puis on appele la tache voulue
        $controller = new $controllerName();
        $controller->$task();
    }
}
