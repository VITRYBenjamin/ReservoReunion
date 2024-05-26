<?php

require_once('app/models/Model.php');

class ManagerService extends Model{

    public function getServices(){
        return $this->getAllFromTable('service','Service');
    }

    public function getService($id){
        $query = "SELECT * FROM service WHERE id = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$id]);

        $resultat = $stmt->fetch();
        return $resultat;
    }
}
?>