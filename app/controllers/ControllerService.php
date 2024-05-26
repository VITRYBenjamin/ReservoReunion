<?php

require_once('app/views/View.php');

/**
 * Classe ControllerService
 * 
 * Cette classe est responsable du contrôle des services. Elle gère l'affichage
 * des services en utilisant un manager et une vue.
 */
class ControllerService {

    /**
     * @var ManagerService $_managerService Le manager des services.
     */
    private $_managerService;

    /**
     * @var View $_view La vue utilisée pour afficher les services.
     */
    private $_view;

    /**
     * Constructeur de la classe ControllerService.
     * 
     * @param array $url L'URL fournie pour accéder au contrôleur.
     * 
     * @throws Exception Si l'URL contient plus d'un segment, une exception est levée.
     */
    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->services();
        }
    }

    /**
     * Gère l'affichage des services.
     * 
     * Cette méthode utilise le ManagerService pour récupérer les services,
     * puis utilise la vue pour générer l'affichage des services.
     * 
     * @return void
     */
    private function services(){
        $this->_managerService = new ManagerService;
        $services = $this->_managerService->getServices();
        
        $this->_view = new View('Services');
        $this->_view->generate(array('services' => $services));
    }
}
?>