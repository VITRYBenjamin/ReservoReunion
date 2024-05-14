SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `ingredient_chk_1` CHECK ((`prix` >= 0)),
  CONSTRAINT `ingredient_chk_2` CHECK ((`quantite` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `date_menu` date DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `repas`;
CREATE TABLE `repas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `recette` text,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `repas_chk_1` CHECK ((`prix` >= 0))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `repas_ingredients`;
CREATE TABLE `repas_ingredients` (
  `id_repas` int NOT NULL,
  `id_ingredient` int NOT NULL,
  `quantite` int NOT NULL,
  `unite` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_repas`,`id_ingredient`),
  KEY `id_ingredient` (`id_ingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `repas_menu`;
CREATE TABLE `repas_menu` (
  `id_menu` int NOT NULL,
  `id_repas` int NOT NULL,
  PRIMARY KEY (`id_menu`,`id_repas`),
  KEY `id_repas` (`id_repas`),
  CONSTRAINT `repas_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  CONSTRAINT `repas_menu_ibfk_2` FOREIGN KEY (`id_repas`) REFERENCES `repas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DELIMITER ;;

CREATE TRIGGER `check_max_repas_menu` BEFORE INSERT ON `repas_menu` FOR EACH ROW
BEGIN
    DECLARE repas_count INT;
    SELECT COUNT(*) INTO repas_count FROM repas_menu WHERE id_menu = NEW.id_menu;
    IF repas_count >= 14 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Le nombre maximal de repas pour ce menu est atteint.';
    END IF;
END;;

DELIMITER ;

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;