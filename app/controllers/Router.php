<?php

session_start();

require_once ('app/models/ManagerReservation.php');
require_once ('app/models/ManagerEquipement.php');
require_once ('app/models/ManagerService.php');
require_once ('app/models/ManagerLieu.php');

/**
 * Classe Router
 * 
 * Cette classe gère le routage des requêtes entrantes. Elle analyse l'URL, détermine le contrôleur,
 * l'action et les paramètres, puis invoque l'action du contrôleur correspondant.
 */
class Router
{
    /**
     * @var mixed $_ctrl Une instance de la classe contrôleur.
     */
    private $_ctrl;

    /**
     * Constructeur de la classe Router.
     * 
     * Aucune initialisation requise pour le moment.
     */
    public function __construct() {
        // Aucune initialisation requise pour le moment
    }

    /**
     * Routage de la requête entrante.
     * 
     * Cette méthode gère la logique de routage. Elle charge automatiquement les modèles,
     * nettoie et analyse l'URL, détermine le contrôleur, l'action et les paramètres,
     * puis invoque l'action du contrôleur correspondant.
     * 
     * @return void
     */
    public function routeReq() {
        try {
            // Chargement automatique des modèles
            spl_autoload_register(
                function($class) {
                    $file = 'models/' . $class . '.php';
                    if (file_exists($file)) {
                        require_once($file);
                    }
                }
            );

            // Nettoyage et analyse de l'URL
            $url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];

            // Contrôleur/action par défaut
            $controller = 'Home';
            $action = 'home';
            $params = [];

            // Extraction du contrôleur, de l'action et des paramètres de l'URL
            if (!empty($url[0])) {
                $controller = ucfirst(array_shift($url));
            }
            if (!empty($url[0])) {
                $action = array_shift($url);
            }
            $params = $url;

            $controllerClass = "Controller" . $controller;
            $controllerFile = 'app/controllers/' . $controllerClass . '.php';

            // Vérification de l'existence du fichier du contrôleur
            if (file_exists($controllerFile)) {
                require_once($controllerFile);
                if (class_exists($controllerClass)) {
                    $this->_ctrl = new $controllerClass();
                    if (method_exists($this->_ctrl, $action)) {
                        call_user_func_array([$this->_ctrl, $action], $params);
                    } else {
                        throw new Exception("Action '$action' non trouvée", 406);
                    }
                } else {
                    throw new Exception("Classe contrôleur '$controllerClass' non trouvée", 405);
                }
            } else {
                throw new Exception("Fichier contrôleur '$controllerFile' non trouvé", 405);
            }
        } catch (Exception $e) {
            $this->handleError($e);
        }
    }

    /**
     * Gère les erreurs survenues lors du routage.
     * 
     * Cette méthode est responsable de la gestion des exceptions survenues lors du routage.
     * Elle affiche un message d'erreur et un code.
     * 
     * @param Exception $exception L'objet d'exception.
     * 
     * @return void
     */
    private function handleError($exception) {
        $errorMsg = $exception->getMessage();
        $errorCode = $exception->getCode();
        require_once 'app/views/viewError.php';
    }
}
