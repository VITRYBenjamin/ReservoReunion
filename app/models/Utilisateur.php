<?php
require_once('app/models/Model.php');

class Utilisateur {
    public $_id;
    public $_nom;
    public $_prenom;
    public $_email;
    public $_phone;
    public $_pwd;

    // Constructeur
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    // Méthode d'hydratation
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Setters
    public function setId(int $id)              {$this->_id = $id;}

    public function setNom(string $nom)         {$this->_nom = $nom;}

    public function setPrenom(string $prenom)   {$this->_prenom = $prenom;}

    public function setEmail(string $email)     {$this->_email = $email;}

    public function setPhone(string $phone)     {$this->_phone = $phone;}

    public function setPwd(string $pwd)         {$this->_pwd = $pwd;}

    // getters
    public function getId()     {return $this->_id;}

    public function getNom()    {return $this->_nom;}

    public function getPrenom() {return $this->_prenom;}

    public function getEmail()  {return $this->_email;}
    
    public function getPhone()  {return $this->_phone;}

    public function getPwd()    {return $this->_pwd;}

}