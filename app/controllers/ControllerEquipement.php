<?php

require_once('app\views\View.php');

class ControllerEquipement {

    private $_managerEquipement;
    private $_view;

    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->equipements();
        }
    }

    private function equipements(){
        $this->_managerEquipement = new ManagerEquipement;
        $equipements = $this->_managerEquipement->getEquipements();
        
        $this->_view = new View('Equipements');
        $this->_view->generate(array('equipements' => $equipements));
    }
}
?>