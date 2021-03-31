-- --------------------------------------------------------
-- Host:                         localhost
-- Server Version:               8.0.21 - MySQL Community Server - GPL
-- Server Betriebssystem:        Linux
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Daten aus Tabelle chefkoch_todo.task: ~15 rows (ungefähr)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` (`id`, `todolist_id`, `name`, `description`) VALUES
	(1, 1, 'Rinderroulade', '10'),
	(2, 1, 'Salz', NULL),
	(4, 1, 'Pfeffer', ''),
	(5, 1, 'Gewürzgurke(n)', '1 Glas'),
	(6, 1, 'Speck', '24 Scheiben'),
	(7, 1, 'Senf', ''),
	(8, 1, 'Suppengemüse', '1 Bund'),
	(9, 1, 'Tomatenmark', NULL),
	(10, 1, 'Sahne', '250 ml'),
	(11, 1, 'Olivenöl', NULL),
	(12, 1, 'Rotwein', NULL),
	(13, 2, 'Rouladen', 'https://www.chefkoch.de/rezepte/1693561277708713/Rouladen.html'),
	(14, 2, 'Schwedische Kartoffeln', 'https://www.chefkoch.de/rezepte/1386571243753438/Schwedische-Kartoffeln.html'),
	(16, 2, 'Goldige Pfirsichmuffins', 'https://www.chefkoch.de/rezepte/385881125229452/Goldige-Pfirsichmuffins.html'),
	(17, 2, 'Lasagne', 'https://www.chefkoch.de/rezepte/745721177147257/Lasagne.html');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;

-- Exportiere Daten aus Tabelle chefkoch_todo.todolist: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `todolist` DISABLE KEYS */;
INSERT INTO `todolist` (`id`, `name`, `description`) VALUES
	(1, 'Einkaufsliste', 'Was wir noch brauchen'),
	(2, 'Rezepte', '');
/*!40000 ALTER TABLE `todolist` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
