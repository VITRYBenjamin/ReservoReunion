<?php

session_start();

require_once ('app/models/ManagerReservation.php');
require_once ('app/models/ManagerEquipement.php');
require_once ('app/models/ManagerService.php');
require_once ('app/models/ManagerLieu.php');


class Router
{
    private $_ctrl;

    public function __construct() {
        // No initialization required for now
    }

    public function routeReq() {
        try {
            // Autoload models
            spl_autoload_register(
                function($class) {
                    $file = 'models/' . $class . '.php';
                    if (file_exists($file)) {
                        require_once($file);
                    }
                }
            );

            // Sanitize and parse the URL
            $url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];

            // Default controller/action
            $controller = 'Home';
            $action = 'home';
            $params = [];

            // Extract controller, action, and params from the URL
            if (!empty($url[0])) {
                $controller = ucfirst(array_shift($url));
            }
            if (!empty($url[0])) {
                $action = array_shift($url);
            }
            $params = $url;

            $controllerClass = "Controller" . $controller;
            $controllerFile = 'app/controllers/' . $controllerClass . '.php';

            // Check if the controller file exists
            if (file_exists($controllerFile)) {
                require_once($controllerFile);
                if (class_exists($controllerClass)) {
                    $this->_ctrl = new $controllerClass();
                    if (method_exists($this->_ctrl, $action)) {
                        call_user_func_array([$this->_ctrl, $action], $params);
                    } else {
                        throw new Exception("Action '$action' not found", 406);
                    }
                } else {
                    throw new Exception("Controller class '$controllerClass' not found", 405);
                }
            } else {
                throw new Exception("Controller file '$controllerFile' not found", 405);
            }
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    private function handleError($exception) {
        $errorMsg = $exception->getMessage();
        $errorCode = $exception->getCode();
        require_once 'app/views/viewError.php';
    }
}