<?php

require_once('app/views/View.php');

/**
 * Classe ControllerEquipement
 * 
 * Cette classe est responsable du contrôle des équipements. Elle gère l'affichage
 * des équipements en utilisant un manager et une vue.
 */
class ControllerEquipement {

    /**
     * @var ManagerEquipement $_managerEquipement Le manager d'équipements.
     */
    private $_managerEquipement;

    /**
     * @var View $_view La vue utilisée pour afficher les équipements.
     */
    private $_view;

    /**
     * Constructeur de la classe ControllerEquipement.
     * 
     * @param array $url L'URL fournie pour accéder au contrôleur.
     * 
     * @throws Exception Si l'URL contient plus d'un segment, une exception est levée.
     */
    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } else {
            $this->equipements();
        }
    }

    /**
     * Gère l'affichage des équipements.
     * 
     * Cette méthode utilise le ManagerEquipement pour récupérer les équipements,
     * puis utilise la vue pour générer l'affichage des équipements.
     * 
     * @return void
     */
    private function equipements(){
        $this->_managerEquipement = new ManagerEquipement;
        $equipements = $this->_managerEquipement->getEquipements();
        
        $this->_view = new View('Equipements');
        $this->_view->generate(array('equipements' => $equipements));
    }
}
?>
