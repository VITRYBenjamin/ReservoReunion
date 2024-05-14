<?php

require_once('C:\wamp64\www\ReservoReunion\app\views\View.php');

class ControllerConnexion {

    private $_view;

    public function __construct(){
        $this->connexion();
    }

    private function connexion(){
        $this->_view = new View('Connexion');
        $this->_view->generate(array('info' => "aucune"));
    }
}
?>
