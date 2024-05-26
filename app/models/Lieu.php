<?php
require_once('app/models/Model.php');

/**
 * Classe Lieu
 * 
 * Représente un lieu avec ses caractéristiques telles que l'identifiant, l'alias, le nom, la description
 * et le prix.
 */
class Lieu{
    /**
     * @var int $_id L'identifiant du lieu.
     */
    public $_id;
    
    /**
     * @var string $_alias L'alias du lieu.
     */
    public $_alias;
    
    /**
     * @var string $_nom Le nom du lieu.
     */
    public $_nom;
    
    /**
     * @var string $_descr La description du lieu.
     */
    public $_descr;
    
    /**
     * @var int $_prix Le prix du lieu.
     */
    public $_prix;

    /**
     * Constructeur de la classe Lieu.
     * 
     * @param array $data Les données à utiliser pour l'hydratation.
     */
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    /**
     * Méthode d'hydratation de l'objet Lieu.
     * 
     * @param array $data Les données à utiliser pour l'hydratation.
     * 
     * @return void
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
     * Setter pour l'identifiant du lieu.
     * 
     * @param int $id L'identifiant du lieu.
     * 
     * @return void
     */
    public function setId(int $id)          {$this->_id = $id;}

    /**
     * Setter pour l'alias du lieu.
     * 
     * @param string $alias L'alias du lieu.
     * 
     * @return void
     */
    public function setAlias(string $alias) {$this->_alias = $alias;}

    /**
     * Setter pour le nom du lieu.
     * 
     * @param string $nom Le nom du lieu.
     * 
     * @return void
     */
    public function setNom(string $nom)     {$this->_nom = $nom;}

    /**
     * Setter pour la description du lieu.
     * 
     * @param string $descr La description du lieu.
     * 
     * @return void
     */
    public function setDescr(string $descr) {$this->_descr = $descr;}

    /**
     * Setter pour le prix du lieu.
     * 
     * @param int $prix Le prix du lieu.
     * 
     * @return void
     */
    public function setPrix(int $prix)   {$this->_prix = $prix;}


    /**
     * Getter pour l'identifiant du lieu.
     * 
     * @return int L'identifiant du lieu.
     */
    public function getId()    {return $this->_id;}

    /**
     * Getter pour l'alias du lieu.
     * 
     * @return string L'alias du lieu.
     */
    public function getAlias() {return $this->_alias;}

    /**
     * Getter pour le nom du lieu.
     * 
     * @return string Le nom du lieu.
     */
    public function getNom()   {return $this->_nom;}

    /**
     * Getter pour la description du lieu.
     * 
     * @return string La description du lieu.
     */
    public function getDescr() {return $this->_descr;}

    /**
     * Getter pour le prix du lieu.
     * 
     * @return int Le prix du lieu.
     */
    public function getPrix()  {return $this->_prix;}
}
