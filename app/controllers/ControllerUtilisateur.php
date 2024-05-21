<?php

require_once('app\views\View.php');

class ControllerUtilisateur {

    private $_managerUtilisateur;
    private $_view;

    public function __construct($url){
        if(isset($url) && count($url) > 1){
            throw new Exception("Page introuvable", 1);
        } 

        // Vérifie si l'URL contient "inscription"
        if (isset($url[0]) && $url[0] === "inscription") {
            $this->inscriptionUtilisateur();
        }
        
        // Vérifie si l'URL contient "connexion"
        elseif (isset($url[0]) && $url[0] === "connexion") {
            $this->connexionUtilisateur();
        }
        
        // Si aucune action spécifique n'est spécifiée, affiche tous les utilisateurs
        else {
            $this->utilisateurs();
        }
    }

    private function utilisateurs(){
        $this->_managerUtilisateur = new ManagerUtilisateur;
        $utilisateurs = $this->_managerUtilisateur->getUtilisateurs();
        
        $this->_view = new View('Utilisateur');
        $this->_view->generate(array('utilisateurs' => $utilisateurs));
    }
}
?>
