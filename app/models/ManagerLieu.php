<?php
require_once('app/models/Model.php');

/**
 * Classe ManagerLieu
 * 
 * Gère les opérations liées aux lieux dans la base de données.
 */
class ManagerLieu extends Model{

    /**
     * Récupère tous les lieux depuis la base de données.
     * 
     * @return array Un tableau d'objets Lieu contenant tous les lieux récupérés.
     */
    public function getLieux(){
        return $this->getAllFromTable('lieu','Lieu');
    }

    /**
     * Récupère un lieu spécifique à partir de son identifiant.
     * 
     * @param int $id L'identifiant du lieu à récupérer.
     * 
     * @return array|null Un tableau contenant les données du lieu s'il est trouvé, sinon null.
     */
    public function getLieu($id){
        $query = "SELECT * FROM lieu WHERE id = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$id]);

        $resultat = $stmt->fetch();
        return $resultat;
    }
}
?>
