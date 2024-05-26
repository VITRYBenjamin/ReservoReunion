<?php

require_once 'app/views/View.php';
require_once 'app/models/ManagerReservation.php';
require_once 'app/models/ManagerEquipement.php';
require_once 'app/models/ManagerService.php';
require_once 'app/models/ManagerLieu.php';

class ControllerReservation {

    private $_view;
    private $_mng;
    private $_managerEquipement;
    private $_managerService;
    private $_managerLieu;


    public function __construct() {
        $this->_mng = new ManagerReservation();
        $this->_managerService = new ManagerService();
        $this->_managerLieu = new ManagerLieu();
        $this->_managerEquipement = new ManagerEquipement();
    }

    public function Reservations() {
        $reservations = $this->_mng->getReservations();
        $this->_view = new View('Reservations');
        $this->_view->generate(array('reservations' => $reservations));
    }

    public function Reservation($id) {
        $reservation = $this->_mng->getReservationUser($id);
        $this->_view = new View('Reservation');
        $this->_view->generate(array('reservation' => $reservation));
    }

    public function NewReservation()
    {    
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

    public function recapReservation() {
        $_SESSION['DayRes']   = $_POST['DayRes'];
        $_SESSION['StartRes'] = $_POST['StartRes'];
        $_SESSION['EndRes']   = $_POST['EndRes'];
        $_SESSION['Remarque'] = $_POST['Remarque'];

        $this->_managerEquipement = new ManagerEquipement();
        $this->_managerService = new ManagerService();
        $this->_managerLieu = new ManagerLieu();
    
        $equipements = $this->_managerEquipement->getEquipements();
        $services = $this->_managerService->getServices();
        $lieux = $this->_managerLieu->getLieux();
    
        $equipementsRecap = [];
        $servicesRecap = [];
        $lieuxRecap = [];
    
        $equipementsQty = [];
        $servicesQty = [];
        $lieuxQty = [];
    
        $_SESSION['equipements'] = [];
        $_SESSION['services'] = [];
        $_SESSION['lieux'] = [];
    
        $_SESSION['equipementsQty'] = [];
        $_SESSION['servicesQty'] = [];
        $_SESSION['lieuxQty'] = [];
        
        foreach ($equipements as $equipement) {
            if (isset($_POST[$equipement->getAlias()]) && $_POST[$equipement->getAlias()] > 0) {
                $equipementsRecap[] = $equipement;
                $_SESSION['equipements'][] = $equipement->getId();
                
                $equipementsQty[] = (int) $_POST[$equipement->getAlias()];
                $_SESSION['equipementsQty'][] = (int) $_POST[$equipement->getAlias()];
            }
        }

        foreach ($lieux as $lieu) {
            if (isset($_POST[$lieu->getAlias()]) && $_POST[$lieu->getAlias()] > 0) {
                $lieuxRecap[] = $lieu;
                $_SESSION['lieux'][] = $lieu->getId();
                
                $lieuxQty[] = (int) $_POST[$lieu->getAlias()];
            }
        }
    
        foreach ($services as $service) {
            if (isset($_POST[$service->getAlias()]) && $_POST[$service->getAlias()] > 0) {
                $servicesRecap[] = $service;
                $_SESSION['services'][] = $service->getId();
                
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

    public function insertReservation() {
        $this->_mng->insertReservation();

        $this->_view = new View('Home');
        $this->_view->generate(array('message' => 'Votre réservation à bien était enregistrer.'));
    }
}
?>
