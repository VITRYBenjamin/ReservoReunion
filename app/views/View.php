<?php

/**
 * Class View
 * 
 * Gère l'affichage des vues.
 */
Class View{
    private $_file; /**< Chemin vers le fichier de vue. */
    private $_t; /**< Titre de la vue. */

    /**
     * Constructeur de la classe View.
     * 
     * @param string $action Action associée à la vue.
     */
    public function __construct($action){

        $this->_file = 'app/views/view'.$action.'.php';

    }

    /**
     * Génère et affiche la vue.
     * 
     * @param array $data Données à passer à la vue.
     */
    public function generate($data){
        
        // partie précifique de la vue
        $content = $this->generateFile($this->_file, $data);

        // template
        $view = $this->generateFile('app/views/template.php', 
        array('t'=> $this->_t,'content'=> $content));

        echo $view;
    }

    /**
     * Génère un fichier vue et renvoie le résultat produit.
     * 
     * @param string $file Chemin vers le fichier vue.
     * @param array $data Données à passer à la vue.
     * @return string Contenu généré du fichier vue.
     * @throws Exception Si le fichier vue est introuvable.
     */
    private function generateFile($file, $data){
        if (file_exists($file)) {
            extract($data);

            ob_start();

            // Inclut le fichier vue
            require $file;

            return ob_get_clean();
        }else {
            throw new Exception('Fichier '.$file.' introuvable', 405);
            
        }
    }
}
