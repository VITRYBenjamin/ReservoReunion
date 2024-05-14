<?php

class ManagerUtilisateur extends Model{
    public function getUtilisateurs(){
        return $this->getAllFromTable('utilisateur','Utilisateur');
    }

    public function getUtilisateur($email){
        $query = "SELECT * FROM utilisateur WHERE email = ";
        
        $stmt = self::getBdd()->query($query);
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $className($row);
        }
        return $results;
    }
}

?>
