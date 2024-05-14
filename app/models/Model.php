<?php
abstract class Model{
    private static $_bdd;

    // Méthode pour instancier la connexion à la base de données
    private static function setBdd(){
        
        // Paramètres de connexion à la base de données
        $dbHost = 'localhost';          // Hôte de la base de données
        $dbName = 'reservoreunion';     // Nom de la base de données
        $dbUser = 'benjamin';           // Nom d'utilisateur de la base de données
        $dbPass = 'Abcd_1234';          // Mot de passe de la base de données

        // Connexion à la base de données avec PDO
        try {
            self::$_bdd = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
            self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // En cas d'échec de la connexion, affichez un message d'erreur
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Méthode pour récupérer l'instance de la connexion à la base de données
    protected static function getBdd() {
        // Vérifie si la connexion à la base de données a déjà été établie
        if (self::$_bdd === null) {
            // Si ce n'est pas le cas, instancie la connexion
            self::setBdd();
        }
        
        return self::$_bdd;
    }

    // Méthode pour récupérer tous les enregistrements d'une table sous forme d'objets d'une classe spécifique
    public static function getAllFromTable($tableName, $className) {
        $query = "SELECT * FROM $tableName";
        
        $stmt = self::getBdd()->query($query);
        
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new $className($row);
        }
        return $results;
    }
    
}
