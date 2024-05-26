<?php
require_once('app/models/Model.php');

/**
 * Classe ManagerEquipement
 * 
 * Gère les opérations liées aux équipements dans la base de données.
 */
class ManagerEquipement extends Model{

    /**
     * Récupère tous les équipements depuis la base de données.
     * 
     * @return array Un tableau d'objets Equipement contenant tous les équipements récupérés.
     */
    public function getEquipements(){
        return $this->getAllFromTable('equipement','Equipement');
    }

    /**
     * Récupère un équipement spécifique à partir de son identifiant.
     * 
     * @param int $id L'identifiant de l'équipement à récupérer.
     * 
     * @return array|null Un tableau contenant les données de l'équipement s'il est trouvé, sinon null.
     */
    public function getEquipement($id){
        $query = "SELECT * FROM equipement WHERE id = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$id]);

        $resultat = $stmt->fetch();
        return $resultat;
    }
}
?>
