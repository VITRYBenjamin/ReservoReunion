<?php

require_once('app/views/View.php');
require_once('app/models/ManagerUtilisateur.php');
require_once('app/models/ManagerEquipement.php');
require_once('app/models/ManagerService.php');
require_once('app/models/ManagerLieu.php');

class ControllerUtilisateur {

    private $_managerUtilisateur;
    private $_view;

    public function __construct(){
        $this->_managerUtilisateur = new ManagerUtilisateur;
    }

    public function getUtilisateurs(){
        $utilisateurs = $this->_managerUtilisateur->getUtilisateurs();
        
        $this->_view = new View('Utilisateurs');
        $this->_view->generate(array('utilisateurs' => $utilisateurs));
    }

    public function getUtilisateur(){
        $utilisateur = $this->_managerUtilisateur->getUtilisateur();
        
        $this->_view = new View('Utilisateur');
        $this->_view->generate(array('utilisateur' => $utilisateur));
    }

    public function connection(){
        $emailUser = $_POST['email'];
        $passwordUser = $_POST['password'];

        if(isset($emailUser, $passwordUser) && !empty($emailUser) && !empty($passwordUser)) {
            // Récupérer le mot de passe haché de l'utilisateur à partir de la base de données
            $pwdData = $this->_managerUtilisateur->getPwd($emailUser);
        
            if ($pwdData === NULL || empty($pwdData['pwd'])) {
                // L'utilisateur n'est pas inscrit
                $this->_view = new View('Login');
                $this->_view->generate(array('message' => 'Vous n\'êtes pas inscrit chez nous, faites-le dès maintenant.'));

            } elseif (!password_verify($passwordUser, $pwdData['pwd'])) {
                // Mot de passe incorrect
                $this->_view = new View('Login');
                $this->_view->generate(array('message' => 'Identifiant ou mot de passe incorrect.'));

            } else {
                // Authentification réussie
                $id = $this->_managerUtilisateur->getId($emailUser);
                $_SESSION['id'] = $id['id'];
                $this->_view = new View('Home');
                $this->_view->generate(array('message' => 'Vous êtes maintenant connecté.'));
            }
        }        
    }

    public function registration(){
        $name = $_POST['name'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_confirm = $_POST['passwordConfirm'];

        if($password != $password_confirm){
            $this->_view = new View('Register');
            $this->_view->generate(array('message' => 'Vous devez utiliser vos mot de passe son différents, réessayer.'));
        }else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $utilisateur = $this->_managerUtilisateur->registerUser($name,$firstName,$email,$phone,$hashedPassword);
            
            $id = $this->_managerUtilisateur->getId($email);
            $_SESSION['id'] = $id['id'];
            $this->_view = new View('Home');
            $this->_view->generate(array('message' => 'Bienvenue à vous '. $firstName));
        }
    }

    public function register(){
        $this->_view = new View('Register');
        $this->_view->generate(array('info' => 'none'));
    }

    public function login(){
        $this->_view = new View('Login');
        $this->_view->generate(array('info' => 'none'));
    }

    public function logout(){
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();
        $this->_view = new View('Home');
        $this->_view->generate(array('info' => 'none'));
    }

    public function Utilisateur(){
        if (isset($_SESSION['id'])) {
            $utilisateur = $this->_managerUtilisateur->getUtilisateur($_SESSION['id']);

            $this->_view = new View('Utilisateur');
            $this->_view->generate(array('utilisateur' => $utilisateur));
        }
    }

    public function showUserReservation(){
        if (isset($_SESSION['id'])) {
            $reservations = new ManagerReservation();
            $reservationsInfo = $reservations->getReservationsUser($_SESSION['id']);
            
            $lieux = new Managerlieu();
            $equipements = new ManagerEquipement();
            $services = new ManagerService();

            $userReservations = [];
            
            foreach ($reservationsInfo as $Infos) {

                $equipementReservation = [];
                $lieuReservation = [];
                $serviceReservation = [];

                foreach ($Infos[1] as $element) {
                    
                    $objet = match ($element['type_item']) {
                        'lieu' => $lieuReservation[] = $lieux->getLieu($element['id_item']),
                        'service' => $serviceReservation[] = $services->getService($element['id_item']),
                        default => "Ceci n'est pas dans la base..."
                    };

                    if ($element['type_item'] == 'equipement') {
                        $equipement = $equipements->getEquipement($element['id_item']);
                        $objet = [$equipement[2],$equipement[3], $element['quantite']];
                        $equipementReservation[] = $objet;
                    }
                }
                $userReservations[] = [$Infos[0], $equipementReservation, $lieuReservation, $serviceReservation];
            }

            $this->_view = new View('MesReservation');
            $this->_view->generate(array('reservations' => $userReservations));
        }
    }
}
?>
