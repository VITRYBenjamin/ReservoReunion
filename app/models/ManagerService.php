<?php

require_once('app/models/Model.php');

/**
 * Class ManagerService
 * 
 * Manages services including operations like fetching all services and retrieving a specific service.
 */
class ManagerService extends Model{

    /**
     * Retrieves all services from the database.
     * 
     * @return array Array of services.
     */
    public function getServices(){
        return $this->getAllFromTable('service','Service');
    }

    /**
     * Retrieves information about a specific service.
     * 
     * @param int $id Service ID.
     * @return mixed Information about the service.
     */
    public function getService($id){
        $query = "SELECT * FROM service WHERE id = ?";

        $stmt = self::getBdd()->prepare($query);
        
        $stmt->execute([$id]);

        $resultat = $stmt->fetch();
        return $resultat;
    }
}
?>