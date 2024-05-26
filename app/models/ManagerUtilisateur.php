<?php

require_once('app/models/Utilisateur.php');

/**
 * Class ManagerUtilisateur
 * 
 * Gère les opérations liées aux utilisateurs telles que la récupération des utilisateurs, la récupération des détails de l'utilisateur et l'enregistrement de l'utilisateur.
 */
class ManagerUtilisateur extends Model{
    
    /**
     * Récupère tous les utilisateurs depuis la base de données.
     * 
     * @return array Tableau des utilisateurs.
     */
    public function getUtilisateurs(){
        return $this->getAllFromTable('utilisateur','Utilisateur');
    }

    /**
     * Récupère les informations concernant un utilisateur spécifique.
     * 
     * @param int $id Identifiant de l'utilisateur.
     * @return Utilisateur|null Informations sur l'utilisateur s'il est trouvé, sinon null.
     */
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

    /**
     * Récupère le mot de passe haché associé à un email donné.
     * 
     * @param string $email Email de l'utilisateur.
     * @return string|null Mot de passe haché s'il est trouvé, sinon null.
     */
    public function getPwd($email){
        $query = "SELECT pwd FROM utilisateur WHERE email = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $retVal = ($result) ? $result : null ;
        return $retVal;
    }

    /**
     * Récupère l'identifiant associé à un email donné.
     * 
     * @param string $email Email de l'utilisateur.
     * @return int|null Identifiant s'il est trouvé, sinon null.
     */
    public function getId($email){
        $query = "SELECT id FROM utilisateur WHERE email = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $retVal = ($result) ? $result : null ;
        return $retVal;
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     * 
     * @param string $name Nom de l'utilisateur.
     * @param string $firstName Prénom de l'utilisateur.
     * @param string $email Email de l'utilisateur.
     * @param string $phone Numéro de téléphone de l'utilisateur.
     * @param string $hashedPassword Mot de passe haché de l'utilisateur.
     * @return mixed|null Résultat de l'opération d'insertion, sinon null.
     */
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