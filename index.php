<?php
require 'service/Autoloader.php';
spl_autoload_register([new Autoloader(), 'loadClass']);
session_start();

$manager = new User();
$user = $manager->getCurrent();

if(is_null($user)){
    $controllerName = 'AuthController';
}else{
    $controllerName = $_REQUEST['c'];
    if(!$controllerName){
        $controllerName = 'article';
    }
    $controllerName = ucfirst($controllerName)  . "Controller";
    $actionName = $_REQUEST['a'];
}

/**
 * @var Controller $controller
 */
$controller = new $controllerName();
$controller->setAction($actionName)->run();

