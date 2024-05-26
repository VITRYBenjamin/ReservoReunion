<?php
require_once('app/models/Model.php');

class ManagerEquipement extends Model{

    public function getEquipements(){
        return $this->getAllFromTable('equipement','Equipement');
    }

    public function getEquipement($id){
        $query = "SELECT * FROM equipement WHERE id = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$id]);

        $resultat = $stmt->fetch();
        return $resultat;
    }
}
?>