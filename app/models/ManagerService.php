<?php

class ManagerService extends Model{

    public function getServices(){
        return $this->getAllFromTable('service','Service');
    }

    public function getService(){
        $query = "SELECT * FROM service";
        
        $stmt = self::getBdd()->query($query);
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $className($row);
        }
        return $results;
    }
}
?>