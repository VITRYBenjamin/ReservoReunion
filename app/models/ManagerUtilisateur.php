<?php

require_once('app/models/Utilisateur.php');

// Now you can use your classes
use App\Models\ManagerReservation;
use App\Models\Lieu;
use App\Models\Equipement;
use App\Models\Service;

class ManagerUtilisateur extends Model{
    public function getUtilisateurs(){
        return $this->getAllFromTable('utilisateur','Utilisateur');
    }

    public function getUtilisateur($id) {
        $query = "SELECT * FROM utilisateur WHERE id = ?;";
    
        $stmt = self::getBdd()->prepare($query);
        $stmt->execute([$id]);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Utilisateur($row);
        } else {
            return null;
        }
    }

    public function getPwd($email){
        $query = "SELECT pwd FROM utilisateur WHERE email = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $retVal = ($result) ? $result : null ;
        return $retVal;
    }

    public function getId($email){
        $query = "SELECT id FROM utilisateur WHERE email = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $retVal = ($result) ? $result : null ;
        return $retVal;
    }

    public function registerUser($name,$firstName,$email,$phone,$hashedPassword){
        $query = "INSERT INTO `utilisateur`(`nom`, `prenom`, `email`, `phone`, `pwd`) 
        VALUES (?,?,?,?,?)";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$name,$firstName,$email,$phone,$hashedPassword]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $retVal = ($result) ? $result : null ;
        return $retVal;
    }
}

?>
