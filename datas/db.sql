-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           8.0.21 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour jeux_video
DROP DATABASE IF EXISTS `jeux_video`;
CREATE DATABASE IF NOT EXISTS `jeux_video` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `jeux_video`;

-- Listage de la structure de la table jeux_video. categorie
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int unsigned NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(64) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table jeux_video.categorie : ~5 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
	(1, 'Action'),
	(2, 'Aventure'),
	(3, 'RPG'),
	(4, 'Sport'),
	(5, 'Indépendant'),
	(6, 'Battle Royale'),
	(7, 'Simulation');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table jeux_video. editeur
DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `idEditeur` int unsigned NOT NULL AUTO_INCREMENT,
  `nomEditeur` varchar(64) NOT NULL,
  `siteEditeur` varchar(64) NOT NULL,
  PRIMARY KEY (`idEditeur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table jeux_video.editeur : ~0 rows (environ)
/*!40000 ALTER TABLE `editeur` DISABLE KEYS */;
INSERT INTO `editeur` (`idEditeur`, `nomEditeur`, `siteEditeur`) VALUES
	(1, 'Kinetic Games', 'kineticgames.co.uk'),
	(2, 'Devolver Digital', 'devolverdigital.com'),
	(3, 'Paradox Interactive', 'https://www.paradoxplaza.com'),
	(4, '2K', 'https://store.steampowered.com/app/1225330/NBA_2K21/'),
	(5, 'Xbox Game Studio', 'https://www.xbox.com/fr-FR/xbox-game-studios');
/*!40000 ALTER TABLE `editeur` ENABLE KEYS */;

-- Listage de la structure de la table jeux_video. jeux
DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `idJeux` int unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `pegi` int DEFAULT NULL,
  `siteJeux` varchar(64) DEFAULT NULL,
  `dateSortie` date DEFAULT NULL,
  `idCategorie` int unsigned NOT NULL,
  `idEditeur` int unsigned NOT NULL,
  `idPlateforme` int unsigned NOT NULL,
  PRIMARY KEY (`idJeux`),
  UNIQUE KEY `idJeux_UNIQUE` (`idJeux`),
  KEY `fk_categorie_idx` (`idCategorie`),
  KEY `fk_editeur_idx` (`idEditeur`),
  KEY `fk_plateforme_idx` (`idPlateforme`),
  CONSTRAINT `fk_categorie` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`),
  CONSTRAINT `fk_editeur` FOREIGN KEY (`idEditeur`) REFERENCES `editeur` (`idEditeur`),
  CONSTRAINT `fk_plateforme` FOREIGN KEY (`idPlateforme`) REFERENCES `plateforme` (`idPlateforme`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table jeux_video.jeux : ~5 rows (environ)
/*!40000 ALTER TABLE `jeux` DISABLE KEYS */;
INSERT INTO `jeux` (`idJeux`, `titre`, `description`, `pegi`, `siteJeux`, `dateSortie`, `idCategorie`, `idEditeur`, `idPlateforme`) VALUES
	(1, 'Fall Guys: Ultimate Knockout', 'Fall Guys: Ultimate Knockout réunit, pêle-mêle, des hordes de concurrents en ligne, et les précipite sans ménagement dans une compétition maboule composée de rounds de plus en plus anarchiques où les participants sont joyeusement dézingués jusqu\'à ce qu\'il n\'en reste plus qu\'un seul ! Surmontez des obstacles bizarroïdes, bousculez des rivaux turbulents et défiez les lois inflexibles de la physique pour vous frayer un chemin jusqu\'à la splendeur suprême ! Laissez votre amour propre au vestiaire et préparez-vous à subir des échecs burlesques avant de pouvoir espérer brandir fièrement la couronne !', NULL, 'https://fallguys.com', '2020-08-04', 6, 2, 3),
	(2, 'Phasmophobia', 'Phasmophobia is a 4 player online co-op psychological horror where you and your team members of paranormal investigators will enter haunted locations filled with paranormal activity and gather as much evidence of the paranormal as you can. You will use your ghost hunting equipment to search for and record evidence of whatever ghost is haunting the location to sell onto a ghost removal team.', NULL, 'https://store.steampowered.com/app/739630/Phasmophobia/', '2020-09-18', 5, 1, 4),
	(3, 'Crusader Kings III', 'Paradox Development Studio vous propose la suite d\'un des jeux de stratégie les plus populaires de tous les temps. Issu d\'une longue lignée mêlant histoire et stratégie de grande envergure, Crusader Kings III se dote au passage de nombreux moyens inédits pour garantir la prospérité de votre maison.', NULL, 'https://store.steampowered.com/app/1158310/Crusader_Kings_III/', '2020-09-01', 3, 3, 2),
	(4, 'NBA 2K21', 'https://store.steampowered.com/app/1225330/NBA_2K21/', NULL, NULL, '2020-09-04', 4, 4, 1),
	(6, 'Microsoft Flight Simulator', 'Des appareils légers aux gros porteurs, pilotez des avions détaillés et fidèles dans la nouvelle génération de Microsoft Flight Simulator. Mettez à l\'épreuve vos compétences dans des conditions exigeantes telles que le vol de nuit, la simulation atmosphérique et la météo réelle, dans un monde vivant et dynamique. Créez votre plan de vol et allez partout. Microsoft Flight Simulator comprend 20 avions extrêmement détaillés avec des modèles de vol uniques et 30 aéroports reproduits à la main.', 3, 'https://store.steampowered.com/app/1250410/', '2020-09-18', 7, 5, 1);
/*!40000 ALTER TABLE `jeux` ENABLE KEYS */;

-- Listage de la structure de la table jeux_video. plateforme
DROP TABLE IF EXISTS `plateforme`;
CREATE TABLE IF NOT EXISTS `plateforme` (
  `idPlateforme` int unsigned NOT NULL AUTO_INCREMENT,
  `nomPlateforme` varchar(64) NOT NULL,
  PRIMARY KEY (`idPlateforme`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table jeux_video.plateforme : ~5 rows (environ)
/*!40000 ALTER TABLE `plateforme` DISABLE KEYS */;
INSERT INTO `plateforme` (`idPlateforme`, `nomPlateforme`) VALUES
	(1, 'PC'),
	(2, 'PS4'),
	(3, 'PS5'),
	(4, 'Xbox One'),
	(5, 'Wii');
/*!40000 ALTER TABLE `plateforme` ENABLE KEYS */;

-- Listage de la structure de la table jeux_video. utilisateurs
DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut` enum('utilisateur','admin') NOT NULL DEFAULT 'utilisateur',
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table jeux_video.utilisateurs : ~0 rows (environ)
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` (`idUtilisateur`, `pseudo`, `email`, `password`, `statut`) VALUES
	(1, 'Azeaze', 'aze@aze.aze', 'azeazeaze', 'utilisateur'),
	(2, 'Foo', 'fo@goo.foo', 'foofoofoo', 'utilisateur');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
