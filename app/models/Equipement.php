<?php
/**
 * Classe Equipement
 * 
 * Représente un équipement avec ses caractéristiques telles que l'identifiant, l'alias, le nom, la description,
 * le nombre disponible et le prix.
 */
class Equipement{
    /**
     * @var int $_id L'identifiant de l'équipement.
     */
    public $_id;
    
    /**
     * @var string $_alias L'alias de l'équipement.
     */
    public $_alias;
    
    /**
     * @var string $_nom Le nom de l'équipement.
     */
    public $_nom;
    
    /**
     * @var string $_descr La description de l'équipement.
     */
    public $_descr;
    
    /**
     * @var int $_nombre Le nombre disponible de l'équipement.
     */
    public $_nombre;
    
    /**
     * @var int $_prix Le prix de l'équipement.
     */
    public $_prix;

    /**
     * Constructeur de la classe Equipement.
     * 
     * @param array $data Les données à utiliser pour l'hydratation.
     */
    public function __construct(array $data) {
        $this->hydrate($data);
    }

    /**
     * Méthode d'hydratation de l'objet Equipement.
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
     * Setter pour l'identifiant de l'équipement.
     * 
     * @param int $id L'identifiant de l'équipement.
     * 
     * @return void
     */
    public function setId(int $id)              {$this->_id = $id;}

    /**
     * Setter pour l'alias de l'équipement.
     * 
     * @param string $alias L'alias de l'équipement.
     * 
     * @return void
     */
    public function setAlias(string $alias)     {$this->_alias = $alias;}

    /**
     * Setter pour le nom de l'équipement.
     * 
     * @param string $nom Le nom de l'équipement.
     * 
     * @return void
     */
    public function setNom(string $nom)         {$this->_nom = $nom;}

    /**
     * Setter pour la description de l'équipement.
     * 
     * @param string $descr La description de l'équipement.
     * 
     * @return void
     */
    public function setDescr(string $descr)     {$this->_descr = $descr;}

    /**
     * Setter pour le nombre disponible de l'équipement.
     * 
     * @param string $nombre Le nombre disponible de l'équipement.
     * 
     * @return void
     */
    public function setNombre(string $nombre)   {$this->_nombre = $nombre;}

    /**
     * Setter pour le prix de l'équipement.
     * 
     * @param int $prix Le prix de l'équipement.
     * 
     * @return void
     */
    public function setPrix(int $prix)       {$this->_prix = $prix;}


    /**
     * Getter pour l'identifiant de l'équipement.
     * 
     * @return int L'identifiant de l'équipement.
     */
    public function getId()     {return $this->_id;}

    /**
     * Getter pour l'alias de l'équipement.
     * 
     * @return string L'alias de l'équipement.
     */
    public function getAlias()  {return $this->_alias;}

    /**
     * Getter pour le nom de l'équipement.
     * 
     * @return string Le nom de l'équipement.
     */
    public function getNom()    {return $this->_nom;}

    /**
     * Getter pour la description de l'équipement.
     * 
     * @return string La description de l'équipement.
     */
    public function getDescr()  {return $this->_descr;}

    /**
     * Getter pour le nombre disponible de l'équipement.
     * 
     * @return int Le nombre disponible de l'équipement.
     */
    public function getNombre() {return $this->_nombre;}

    /**
     * Getter pour le prix de l'équipement.
     * 
     * @return int Le prix de l'équipement.
     */
    public function getPrix()   {return $this->_prix;}
}
