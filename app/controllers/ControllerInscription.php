<?php

require_once('app\views\View.php');

class ControllerInscription {

    private $_view;

    public function __construct(){
        $this->inscription();
    }

    private function inscription(){
        // Votre logique d'inscription ici
        // Par exemple, vérification des données postées, enregistrement dans la base de données, etc.

        // Après le processus d'inscription, afficher la vue d'inscription réussie
        $this->_view = new View('InscriptionReussie');
        $this->_view->generate();
    }
}
?>
