<?php

require_once('app/views/View.php');

class ControllerLieu {

    private $_managerLieu;
    private $_view;

    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->lieux();
        }
    }

    private function lieux(){
        $this->_managerLieu = new ManagerLieu;
        $lieux = $this->_managerLieu->getLieux();
        
        $this->_view = new View('Lieux');
        $this->_view->generate(array('lieux' => $lieux));
    }
}
?>