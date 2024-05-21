<?php

session_start();

require_once('app\views\View.php');

class ControllerReservation {
    
    private $_managerReservation;
    private $_view;

    private $_managerEquipement;
    private $_managerService;
    private $_managerLieu;
    
    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        }
        if(isset($_SESSION['User']) && $_SESSION['User'] == "User"){
            $this->reservation();
        } else {
            $this->showReservation();
        }
    }

    private function reservation(){
        $this->_managerReservation = new ManagerReservation;
        $reservations = $this->_managerReservation->getReservation();
        
        $this->_view = new View('Reservation');
        $this->_view->generate(array('reservations' => $reservations));
    }

    private function reservations(){
        $this->_managerReservation = new ManagerReservation;
        $reservations = $this->_managerReservation->getReservations();
        
        $this->_view = new View('Reservation');
        $this->_view->generate(array('reservations' => $reservations));
    }

    private function showReservation(){
        $this->_managerEquipement = new ManagerEquipement;
        $this->_managerService = new ManagerService;
        $this->_managerLieu = new ManagerLieu;

        $equipements = $this->_managerEquipement->getEquipements();
        $services = $this->_managerService->getServices();
        $lieux = $this->_managerLieu->getLieux();

        $this->_view = new View('Reservation');
        $this->_view->generate(array(
            'equipements' => $equipements,
            'services' => $services,
            'lieux' => $lieux
        ));
    }
}
?>
