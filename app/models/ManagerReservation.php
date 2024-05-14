<?php

class ManagerReservation extends Model{

    public function getReservations(){
        return $this->getAllFromTable('reservation','Reservation');
    }

    public function getReservation(){
        $query = "SELECT * FROM reservation";
        
        $stmt = self::getBdd()->query($query);
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $className($row);
        }
        return $results;
    }

    public function inputReservation(){
        $user = new ManagerUtilisateur;
        
    }
}
?>