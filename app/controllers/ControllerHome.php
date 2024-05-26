<?php

/**
 * Classe ControllerHome
 * 
 * Cette classe est responsable du contrôle de la page d'accueil.
 */
class ControllerHome {
    
    /**
     * @var View $_view La vue utilisée pour afficher la page d'accueil.
     */
    private $_view;

    /**
     * Constructeur de la classe ControllerHome.
     * 
     * Initialise le contrôleur sans aucun paramètre.
     */
    public function __construct() {}

    /**
     * Gère l'affichage de la page d'accueil.
     * 
     * Cette méthode initialise la vue de la page d'accueil et génère son affichage
     * avec des données par défaut.
     * 
     * @return void
     */
    public function home() {
        require_once('app/views/View.php');
        
        $this->_view = new View('Home');
        $this->_view->generate(array('info' => 'aucune'));
    }
}
?>