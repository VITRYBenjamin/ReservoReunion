<?php



class ControllerHome {

    private $_view;

    public function __construct() {
        
    }

    public function home() {
        require_once('app/views/View.php');
        
        $this->_view = new View('Home');
        $this->_view->generate(array('info' => 'aucune'));
    }
}
?>