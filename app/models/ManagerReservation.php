<?php
require_once('app/models/Model.php');
require_once 'app/models/Equipement.php';
require_once 'app/models/Service.php';
include_once 'app/models/Lieu.php';

class ManagerReservation extends Model{

    private $_managerEquipement;
    private $_managerService;
    private $_managerLieu;


    public function __construct() {
        $this->_managerService = new ManagerService();
        $this->_managerLieu = new ManagerLieu();
        $this->_managerEquipement = new ManagerEquipement();
    }

    public function getReservations(){
        return $this->getAllFromTable('reservation','Reservation');
    }

    public function getReservationsUser($id){
        $reservationsUsers = [];

        $reservationsList = $this->getReservationsList($id);

        foreach ($reservationsList as $reservation) {

            $contenueInformation = $this->getReservationInformation($reservation['id'],$id);

            $reservationInformation = $this->getReservation($reservation['id']);

            $reservationsUsers[] = [$reservationInformation, $contenueInformation];

        }
        return $reservationsUsers;
    }

    public function getReservation($id){
        $query = "SELECT * FROM reservation WHERE id=?";
        
        $stmt = self::getBdd()->prepare($query);
        $stmt->execute([$id]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = [$result['id'], $result['date_reservation'], $result['heure_debut'], $result['heure_fin']];
        return $result;
    }

    public function getLastReservation(){
        $query = "SELECT id FROM reservation ORDER BY id DESC LIMIT ?";
        
        $stmt = self::getBdd()->prepare($query);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result[0];
    }

    public function insertReservation(){

        if(!isset($_SESSION['lieux']) && !isset($_SESSION['equipements']) && !isset($_SESSION['services'])){
            return false;
        }

        //Insertion de la réservation.
        $query = "INSERT INTO reservation(`id_utilisateur`, `date_reservation`, `heure_debut`, `heure_fin`) VALUES (?,?,?,?)";
        $stmt = self::getBdd()->prepare($query);
        $stmt->execute([$_SESSION['id'],$_SESSION['DayRes'] ,$_SESSION['StartRes'],$_SESSION['EndRes']]);

        $resultR = $stmt->fetch(PDO::FETCH_ASSOC);

        $idReservation = $this->getLastReservation();

        //Insertion des lieux réserver
        foreach ($_SESSION['lieux'] as $id) {
            $query = "INSERT INTO `reservation_lieu`(`id_reservation`, `id_lieu`) VALUES (?,?)";
            $stmt = self::getBdd()->prepare($query);
            $stmt->execute([$idReservation,$id]);
        }

        $i=0;
        //Insertion des équipements réserver
        foreach ($_SESSION['equipements'] as $id) {
            $query = "INSERT INTO `reservation_equipement`(`id_reservation`, `id_equipement`, `quantite`) VALUES (?,?,?)";
            $stmt = self::getBdd()->prepare($query);
            $stmt->execute([$idReservation,$id,$_SESSION['equipementsQty'][$i]]);
            $i++;
        }

        //Insertion des services réserver
        foreach ($_SESSION['services'] as $id) {
            $query = "INSERT INTO `reservation_service`(`id_reservation`, `id_service`) VALUES (?,?)";
            $stmt = self::getBdd()->prepare($query);
            $stmt->execute([$idReservation,$id]);
        }
        
        $retVal = ($resultR) ? $resultR : null ;

        return $retVal;
    }

    public function getReservationsList($id){
        
        $query = "SELECT r.id
        FROM reservation r
        WHERE r.id_utilisateur = ?;";
        $stmt = self::getBdd()->prepare($query);
        $stmt->execute([$id]);

        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getReservationInformation($reservation,$id){
        $query = "SELECT 'equipement' AS `type_item`, `id_equipement` AS `id_item`, `quantite` 
        FROM `reservation_equipement`
        INNER JOIN `reservation` r ON r.id = id_reservation
        WHERE id_reservation = ? AND r.id_utilisateur = ?
        
        UNION ALL
        
        SELECT 'lieu' AS `type_item`, `id_lieu` AS `id_item`, NULL AS `quantite` 
        FROM `reservation_lieu`
        INNER JOIN `reservation` r ON r.id = id_reservation
        WHERE r.id = ? AND r.id_utilisateur = ?
        
        UNION ALL
        
        SELECT 'service' AS `type_item`, `id_service` AS `id_item`, NULL AS `quantite` 
        FROM `reservation_service`
        INNER JOIN `reservation` r ON r.id = id_reservation
        WHERE r.id = ? AND r.id_utilisateur = ?;
        ";

        $params = [$reservation,$id, $reservation,$id, $reservation,$id];

        $stmt = self::getBdd()->prepare($query);
        $stmt->execute($params);

        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>