<?php

require_once('app/views/View.php');
require_once('app/models/ManagerUtilisateur.php');
require_once('app/models/ManagerEquipement.php');
require_once('app/models/ManagerService.php');
require_once('app/models/ManagerLieu.php');

/**
 * Classe ControllerUtilisateur
 * 
 * Cette classe est responsable du contrôle des utilisateurs. Elle gère l'affichage,
 * la connexion, l'inscription, et d'autres actions liées aux utilisateurs en utilisant des managers et des vues.
 */
class ControllerUtilisateur {

    /**
     * @var ManagerUtilisateur $_managerUtilisateur Le manager des utilisateurs.
     */
    private $_managerUtilisateur;

    /**
     * @var View $_view La vue utilisée pour afficher les utilisateurs.
     */
    private $_view;

    /**
     * Constructeur de la classe ControllerUtilisateur.
     * 
     * Initialise le manager des utilisateurs.
     */
    public function __construct(){
        $this->_managerUtilisateur = new ManagerUtilisateur();
    }

    /**
     * Gère l'affichage de la liste des utilisateurs.
     * 
     * Cette méthode utilise le ManagerUtilisateur pour récupérer les utilisateurs,
     * puis utilise la vue pour générer l'affichage des utilisateurs.
     * 
     * @return void
     */
    public function getUtilisateurs(){
        $utilisateurs = $this->_managerUtilisateur->getUtilisateurs();
        
        $this->_view = new View('Utilisateurs');
        $this->_view->generate(array('utilisateurs' => $utilisateurs));
    }

    /**
     * Gère l'affichage d'un utilisateur spécifique.
     * 
     * Cette méthode utilise le ManagerUtilisateur pour récupérer l'utilisateur,
     * puis utilise la vue pour générer l'affichage de l'utilisateur.
     * 
     * @return void
     */
    public function getUtilisateur(){
        $utilisateur = $this->_managerUtilisateur->getUtilisateur();
        
        $this->_view = new View('Utilisateur');
        $this->_view->generate(array('utilisateur' => $utilisateur));
    }

    /**
     * Gère la connexion d'un utilisateur.
     * 
     * Cette méthode vérifie les informations d'identification fournies,
     * puis utilise la vue pour générer l'affichage approprié en fonction du résultat de la connexion.
     * 
     * @return void
     */
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

    /**
     * Gère l'inscription d'un nouvel utilisateur.
     * 
     * Cette méthode vérifie les informations fournies, crée un nouvel utilisateur,
     * puis utilise la vue pour générer l'affichage approprié en fonction du résultat de l'inscription.
     * 
     * @return void
     */
    public function registration(){
        $name = $_POST['name'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_confirm = $_POST['passwordConfirm'];

        if($password != $password_confirm){
            $this->_view = new View('Register');
            $this->_view->generate(array('message' => 'Vos mots de passe sont différents, réessayez.'));
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->_managerUtilisateur->registerUser($name, $firstName, $email, $phone, $hashedPassword);
            
            $id = $this->_managerUtilisateur->getId($email);
            $_SESSION['id'] = $id['id'];
            $this->_view = new View('Home');
            $this->_view->generate(array('message' => 'Bienvenue à vous ' . $firstName));
        }
    }

    /**
     * Affiche la vue d'inscription.
     * 
     * Cette méthode utilise la vue pour générer l'affichage de la page d'inscription.
     * 
     * @return void
     */
    public function register(){
        $this->_view = new View('Register');
        $this->_view->generate(array('info' => 'none'));
    }

    /**
     * Affiche la vue de connexion.
     * 
     * Cette méthode utilise la vue pour générer l'affichage de la page de connexion.
     * 
     * @return void
     */
    public function login(){
        $this->_view = new View('Login');
        $this->_view->generate(array('info' => 'none'));
    }

    /**
     * Déconnecte l'utilisateur.
     * 
     * Cette méthode détruit la session de l'utilisateur,
     * puis utilise la vue pour générer l'affichage de la page d'accueil.
     * 
     * @return void
     */
    public function logout(){
        // Supprimer toutes les variables de session
        session_unset();

        // Détruire la session
        session_destroy();
        $this->_view = new View('Home');
        $this->_view->generate(array('info' => 'none'));
    }

    /**
     * Gère l'affichage des informations de l'utilisateur connecté.
     * 
     * Cette méthode utilise le ManagerUtilisateur pour récupérer les informations
     * de l'utilisateur connecté, puis utilise la vue pour générer l'affichage.
     * 
     * @return void
     */
    public function Utilisateur(){
        if (isset($_SESSION['id'])) {
            $utilisateur = $this->_managerUtilisateur->getUtilisateur($_SESSION['id']);

            $this->_view = new View('Utilisateur');
            $this->_view->generate(array('utilisateur' => $utilisateur));
        }
    }

    /**
     * Affiche les réservations de l'utilisateur connecté.
     * 
     * Cette méthode utilise le ManagerReservation pour récupérer les réservations de l'utilisateur connecté,
     * ainsi que les détails des lieux, équipements et services associés, puis utilise la vue pour générer l'affichage.
     * 
     * @return void
     */
    public function showUserReservation(){
        if (isset($_SESSION['id'])) {
            $reservations = new ManagerReservation();
            $reservationsInfo = $reservations->getReservationsUser($_SESSION['id']);
            
            $lieux = new ManagerLieu();
            $equipements = new ManagerEquipement();
            $services = new ManagerService();

            $userReservations = [];
            
            foreach ($reservationsInfo as $Infos) {
                $equipementReservation = [];
                $lieuReservation = [];
                $serviceReservation = [];

                foreach ($Infos[1] as $element) {
                    switch ($element['type_item']) {
                        case 'lieu':
                            $lieuReservation[] = $lieux->getLieu($element['id_item']);
                            break;
                        case 'service':
                            $serviceReservation[] = $services->getService($element['id_item']);
                            break;
                        default:
                            // Ajouter un traitement pour les autres types si nécessaire
                            break;
                    }

                    if ($element['type_item'] == 'equipement') {
                        $equipement = $equipements->getEquipement($element['id_item']);
                        $objet = [$equipement[2], $equipement[3], $element['quantite']];
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
