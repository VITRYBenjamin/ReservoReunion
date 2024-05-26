<?php

require_once('app/views/View.php');

/**
 * Classe ControllerLieu
 * 
 * Cette classe est responsable du contrôle des lieux. Elle gère l'affichage
 * des lieux en utilisant un manager et une vue.
 */
class ControllerLieu {

    /**
     * @var ManagerLieu $_managerLieu Le manager des lieux.
     */
    private $_managerLieu;

    /**
     * @var View $_view La vue utilisée pour afficher les lieux.
     */
    private $_view;

    /**
     * Constructeur de la classe ControllerLieu.
     * 
     * @param array $url L'URL fournie pour accéder au contrôleur.
     * 
     * @throws Exception Si l'URL contient plus d'un segment, une exception est levée.
     */
    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->lieux();
        }
    }

    /**
     * Gère l'affichage des lieux.
     * 
     * Cette méthode utilise le ManagerLieu pour récupérer les lieux,
     * puis utilise la vue pour générer l'affichage des lieux.
     * 
     * @return void
     */
    private function lieux(){
        $this->_managerLieu = new ManagerLieu;
        $lieux = $this->_managerLieu->getLieux();
        
        $this->_view = new View('Lieux');
        $this->_view->generate(array('lieux' => $lieux));
    }
}
?>
