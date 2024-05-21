<?php

require_once('app\views\View.php');

class ControllerService {

    private $_managerService;
    private $_view;

    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->services();
        }
    }

    private function services(){
        $this->_managerService = new ManagerService;
        $services = $this->_managerService->getServices();
        
        $this->_view = new View('Services');
        $this->_view->generate(array('services' => $services));
    }
}
?>