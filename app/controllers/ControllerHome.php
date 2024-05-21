<?php

require_once('app\views\View.php');

class ControllerHome {

    private $_managerHome;
    private $_view;

    public function __construct($url){
        if((!empty($url) && count($url) > 1)){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->home();
        }
    }
    

    private function home(){
        $this->_view = new View('Home');
        $this->_view->generate(array('info' => "aucune"));
    }
}

?>