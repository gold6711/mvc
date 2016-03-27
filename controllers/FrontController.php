<?php
class FrontController extends Controller
{
    public function actionIndex()
    {
        $controllerName = $_GET['c'] . "Controller";
        $actionName = $_GET['a'];

        if(!class_exists($controllerName)){
            $controllerName = 'ArticleController';
        }

        /**
         * @var Controller $controller
         */
        $controller = new $controllerName;
        $controller->setAction($actionName)->run();
    }
}