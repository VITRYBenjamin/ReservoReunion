<?php

class ManagerEquipement extends Model{

    public function getEquipements(){
        return $this->getAllFromTable('equipement','Equipement');
    }

    public function getEquipement(){
        $query = "SELECT * FROM equipement";
        
        $stmt = self::getBdd()->query($query);
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $className($row);
        }
        return $results;
    }
}
?>