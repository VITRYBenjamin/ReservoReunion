<?php

class ManagerLieu extends Model{

    public function getLieux(){
        return $this->getAllFromTable('lieu','Lieu');
    }

    public function getLieu(){
        $query = "SELECT * FROM lieu";
        
        $stmt = self::getBdd()->query($query);
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $className($row);
        }
        return $results;
    }
}
?>