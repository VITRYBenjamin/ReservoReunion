<?php

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq(){

        try {
            spl_autoload_register(function ($class) {
                require_once 'app\\models\\' . $class . '.php';
            });            
        
            $url ='';

            if(isset($_GET['url'])){
                $url = explode('/', filter_var($_GET['url'],FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "app\controllers\\".$controllerClass.".php";
                
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }else {
                    throw new Exception("Page introuvable", 404);
                }
            }else {
                require_once('app\controllers\ControllerHome.php');
                $this->_ctrl = new ControllerHome($url);
            }

        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            require_once('app\views\viewError.php');
        }
    }
}