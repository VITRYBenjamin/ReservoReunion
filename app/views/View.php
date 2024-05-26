<?php

Class View{
    private $_file;
    private $_t;

    public function __construct($action){

        $this->_file = 'app/views/view'.$action.'.php';

    }

    // Génére et affiche la vue
    public function generate($data){
        
        // partie précifique de la vue
        $content = $this->generateFile($this->_file, $data);

        // template
        $view = $this->generateFile('app/views/template.php', 
        array('t'=> $this->_t,'content'=> $content));

        echo $view;
    }

    // Génére un fichier vue et renvoie le résultat produit
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