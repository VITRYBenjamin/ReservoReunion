<?php

session_start();

require_once('C:\wamp64\www\ReservoReunion\app\views\View.php');

require_once('C:\wamp64\www\ReservoReunion\app\models\ManagerEquipement.php');
require_once('C:\wamp64\www\ReservoReunion\app\models\ManagerService.php');
require_once('C:\wamp64\www\ReservoReunion\app\models\ManagerLieu.php');

class ControllerAttenteReservation {
    
    private $_managerReservation;
    private $_view;

    private $_managerEquipement;
    private $_managerService;
    private $_managerLieu;
    
    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->showReservation();
        }
    }

    private function showReservation(){
        $this->_managerEquipement = new ManagerEquipement;
        $this->_managerService = new ManagerService;
        $this->_managerLieu = new ManagerLieu;
    
        $equipements = $this->_managerEquipement->getEquipements();
        $services = $this->_managerService->getServices();
        $lieux = $this->_managerLieu->getLieux();
    
        $equipementsRecap = [];
        $servicesRecap = [];
        $lieuxRecap = [];
    
        $equipementsQty = [];
        $servicesQty = [];
        $lieuxQty = [];
    
        foreach ($lieux as $lieu) {
            if(isset($_POST[$lieu->getAlias()])){
                $lieuxRecap[] = $lieu;
                $lieuxQty[] = (int) $_POST[$lieu->getAlias()];
            }
        }
    
        foreach ($equipements as $equipement) {
            if(isset($_POST[$equipement->getAlias()]) && $_POST[$equipement->getAlias()] > 0){
                $equipementsRecap[] = $equipement;
                $equipementsQty[] = (int) $_POST[$equipement->getAlias()];
            }
        }
    
        foreach ($services as $service) {
            if(isset($_POST[$service->getAlias()])){
                $servicesRecap[] = $service;
                $servicesQty[] = (int) $_POST[$service->getAlias()];
            }
        }

        $this->_view = new View('RecapReservation');
        $this->_view->generate(array(
            'equipementsR' => $equipementsRecap,
            'servicesR' => $servicesRecap,
            'lieuxR' => $lieuxRecap,
            'equipementsQ' => $equipementsQty,
            'servicesQ' => $servicesQty,
            'lieuxQ' => $lieuxQty
        ));
    }
}
?>