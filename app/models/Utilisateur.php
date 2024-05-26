<?php
require_once('app/models/Model.php');

/**
 * Class Utilisateur
 * 
 * Représente un utilisateur.
 */
class Utilisateur {
    public $_id; /**< Identifiant de l'utilisateur. */
    public $_nom; /**< Nom de l'utilisateur. */
    public $_prenom; /**< Prénom de l'utilisateur. */
    public $_email; /**< Email de l'utilisateur. */
    public $_phone; /**< Numéro de téléphone de l'utilisateur. */
    public $_pwd; /**< Mot de passe de l'utilisateur. */

    /**
     * Constructeur de la classe Utilisateur.
     * 
     * @param array $data Données à utiliser pour l'initialisation.
     */
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    /**
     * Méthode d'hydratation de l'objet.
     * 
     * @param array $data Données à utiliser pour l'hydratation.
     */
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Setter pour l'identifiant de l'utilisateur.
     * 
     * @param int $id Identifiant de l'utilisateur.
     */
    public function setId(int $id)              {$this->_id = $id;}

    /**
     * Setter pour le nom de l'utilisateur.
     * 
     * @param string $nom Nom de l'utilisateur.
     */
    public function setNom(string $nom)         {$this->_nom = $nom;}

    /**
     * Setter pour le prénom de l'utilisateur.
     * 
     * @param string $prenom Prénom de l'utilisateur.
     */
    public function setPrenom(string $prenom)   {$this->_prenom = $prenom;}

    /**
     * Setter pour l'email de l'utilisateur.
     * 
     * @param string $email Email de l'utilisateur.
     */
    public function setEmail(string $email)     {$this->_email = $email;}

    /**
     * Setter pour le numéro de téléphone de l'utilisateur.
     * 
     * @param string $phone Numéro de téléphone de l'utilisateur.
     */
    public function setPhone(string $phone)     {$this->_phone = $phone;}

    /**
     * Setter pour le mot de passe de l'utilisateur.
     * 
     * @param string $pwd Mot de passe de l'utilisateur.
     */
    public function setPwd(string $pwd)         {$this->_pwd = $pwd;}

    /**
     * Getter pour l'identifiant de l'utilisateur.
     * 
     * @return int Identifiant de l'utilisateur.
     */
    public function getId()     {return $this->_id;}

    /**
     * Getter pour le nom de l'utilisateur.
     * 
     * @return string Nom de l'utilisateur.
     */
    public function getNom()    {return $this->_nom;}

    /**
     * Getter pour le prénom de l'utilisateur.
     * 
     * @return string Prénom de l'utilisateur.
     */
    public function getPrenom() {return $this->_prenom;}

    /**
     * Getter pour l'email de l'utilisateur.
     * 
     * @return string Email de l'utilisateur.
     */
    public function getEmail()  {return $this->_email;}
    
    /**
     * Getter pour le numéro de téléphone de l'utilisateur.
     * 
     * @return string Numéro de téléphone de l'utilisateur.
     */
    public function getPhone()  {return $this->_phone;}

    /**
     * Getter pour le mot de passe de l'utilisateur.
     * 
     * @return string Mot de passe de l'utilisateur.
     */
    public function getPwd()    {return $this->_pwd;}

}
