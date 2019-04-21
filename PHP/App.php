<?php

function autoload($className)
{
    $path = '';

    $className = str_replace("\\", "/", $className);
    
    if ($className[0] == "\\") {
        $path = __DIR__ ."/" . $className . '.php';
    } else {
        $path = __DIR__ . __NAMESPACE__ ."/" . $className . '.php';
    }
    
    include_once($path);
}

spl_autoload_register('autoload');



class App
{
    public function run()
    {
        $router = new Router\Router();
        $router->dispatch();
    }
}

$app = new App();
$app->run();