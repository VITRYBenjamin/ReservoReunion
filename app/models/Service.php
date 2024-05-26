<?php
require_once('app/models/Model.php');

/**
 * Class Service
 * 
 * Représente un service.
 */
class Service{
    public $_id; /**< Identifiant du service. */
    public $_alias; /**< Alias du service. */
    public $_nom; /**< Nom du service. */
    public $_descr; /**< Description du service. */
    public $_prix; /**< Prix du service. */

    /**
     * Constructeur de la classe Service.
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
     * Setter pour l'identifiant du service.
     * 
     * @param int $id Identifiant du service.
     */
    public function setId(int $id)          {$this->_id = $id;}

    /**
     * Setter pour l'alias du service.
     * 
     * @param string $alias Alias du service.
     */
    public function setAlias(string $alias) {$this->_alias = $alias;}

    /**
     * Setter pour le nom du service.
     * 
     * @param string $nom Nom du service.
     */
    public function setNom(string $nom)     {$this->_nom = $nom;}

    /**
     * Setter pour la description du service.
     * 
     * @param string $descr Description du service.
     */
    public function setDescr(string $descr) {$this->_descr = $descr;}

    /**
     * Setter pour le prix du service.
     * 
     * @param int $prix Prix du service.
     */
    public function setPrix(int $prix)   {$this->_prix = $prix;}


    /**
     * Getter pour l'identifiant du service.
     * 
     * @return int Identifiant du service.
     */
    public function getId()    {return $this->_id;}

    /**
     * Getter pour l'alias du service.
     * 
     * @return string Alias du service.
     */
    public function getAlias() {return $this->_alias;}

    /**
     * Getter pour le nom du service.
     * 
     * @return string Nom du service.
     */
    public function getNom()   {return $this->_nom;}

    /**
     * Getter pour la description du service.
     * 
     * @return string Description du service.
     */
    public function getDescr() {return $this->_descr;}

    /**
     * Getter pour le prix du service.
     * 
     * @return int Prix du service.
     */
    public function getPrix()  {return $this->_prix;}

}