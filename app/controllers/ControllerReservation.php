<?php

require_once 'app/views/View.php';
require_once 'app/models/ManagerReservation.php';
require_once 'app/models/ManagerEquipement.php';
require_once 'app/models/ManagerService.php';
require_once 'app/models/ManagerLieu.php';

/**
 * Classe ControllerReservation
 * 
 * Cette classe est responsable du contrôle des réservations. Elle gère l'affichage,
 * la création, et la récapitulation des réservations en utilisant des managers et des vues.
 */
class ControllerReservation {

    /**
     * @var View $_view La vue utilisée pour afficher les réservations.
     */
    private $_view;

    /**
     * @var ManagerReservation $_mng Le manager de réservations.
     */
    private $_mng;

    /**
     * @var ManagerEquipement $_managerEquipement Le manager des équipements.
     */
    private $_managerEquipement;

    /**
     * @var ManagerService $_managerService Le manager des services.
     */
    private $_managerService;

    /**
     * @var ManagerLieu $_managerLieu Le manager des lieux.
     */
    private $_managerLieu;

    /**
     * Constructeur de la classe ControllerReservation.
     * 
     * Initialise les managers de réservations, équipements, services, et lieux.
     */
    public function __construct() {
        $this->_mng = new ManagerReservation();
        $this->_managerService = new ManagerService();
        $this->_managerLieu = new ManagerLieu();
        $this->_managerEquipement = new ManagerEquipement();
    }

    /**
     * Gère l'affichage des réservations.
     * 
     * Cette méthode utilise le ManagerReservation pour récupérer les réservations,
     * puis utilise la vue pour générer l'affichage des réservations.
     * 
     * @return void
     */
    public function Reservations() {
        $reservations = $this->_mng->getReservations();
        $this->_view = new View('Reservations');
        $this->_view->generate(array('reservations' => $reservations));
    }

    /**
     * Gère l'affichage d'une réservation spécifique.
     * 
     * @param int $id L'identifiant de la réservation.
     * 
     * Cette méthode utilise le ManagerReservation pour récupérer la réservation spécifique,
     * puis utilise la vue pour générer l'affichage de la réservation.
     * 
     * @return void
     */
    public function Reservation($id) {
        $reservation = $this->_mng->getReservationUser($id);
        $this->_view = new View('Reservation');
        $this->_view->generate(array('reservation' => $reservation));
    }

    /**
     * Gère l'affichage de la page de nouvelle réservation.
     * 
     * Cette méthode récupère les équipements, services, et lieux disponibles
     * pour une nouvelle réservation, puis utilise la vue pour générer l'affichage.
     * 
     * @return void
     */
    public function NewReservation() {    
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

    /**
     * Gère la récapitulation de la réservation.
     * 
     * Cette méthode stocke les informations de la réservation en session, récupère les équipements,
     * services, et lieux sélectionnés, puis utilise la vue pour générer l'affichage de la récapitulation.
     * 
     * @return void
     */
    public function recapReservation() {
        $_SESSION['DayRes']   = $_POST['DayRes'];
        $_SESSION['StartRes'] = $_POST['StartRes'];
        $_SESSION['EndRes']   = $_POST['EndRes'];
        $_SESSION['Remarque'] = $_POST['Remarque'];

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

    /**
     * Insère une nouvelle réservation.
     * 
     * Cette méthode utilise le ManagerReservation pour insérer une nouvelle réservation,
     * puis utilise la vue pour générer l'affichage d'un message de confirmation.
     * 
     * @return void
     */
    public function insertReservation() {
        $this->_mng->insertReservation();

        $this->_view = new View('Home');
        $this->_view->generate(array('message' => 'Votre réservation a bien été enregistrée.'));
    }
}
?>
