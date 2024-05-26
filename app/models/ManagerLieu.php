<?php

require_once('app/models/Model.php');

class ManagerLieu extends Model{

    public function getLieux(){
        return $this->getAllFromTable('lieu','Lieu');
    }

    public function getLieu($id){
        $query = "SELECT * FROM lieu WHERE id = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$id]);

        $resultat = $stmt->fetch();
        return $resultat;
    }
}
?>