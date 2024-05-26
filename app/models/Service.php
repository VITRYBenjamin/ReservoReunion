<?php
require_once('app/models/Model.php');

class Service{
    public $_id;
    public $_alias;
    public $_nom;
    public $_descr;
    public $_prix;

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
    public function setId(int $id)          {$this->_id = $id;}

    public function setAlias(string $alias) {$this->_alias = $alias;}

    public function setNom(string $nom)     {$this->_nom = $nom;}

    public function setDescr(string $descr) {$this->_descr = $descr;}

    public function setPrix(int $prix)   {$this->_prix = $prix;}


    // getters
    public function getId()    {return $this->_id;}

    public function getAlias() {return $this->_alias;}

    public function getNom()   {return $this->_nom;}

    public function getDescr() {return $this->_descr;}

    public function getPrix()  {return $this->_prix;}

}