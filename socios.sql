-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- A despejar dados para tabela projeto.socios: ~6 rows (aproximadamente)
INSERT INTO `socios` (`id_socio`, `nome`, `email`, `telemovel`, `data_nascimento`, `password`, `consentimento`, `iniciais`) VALUES
	(5, 'Iara Gomes', 'iarag8656@gmail.com', '965855544', '2005-07-02', '$2y$10$ZyQAwr6eIznQ5h7Oopb5BuFOjWN.0TGPQ8D585nie2LBYd15GXvmu', 1, 'IG'),
	(6, 'Rute Lopes', 'rutelopes@gmail.com', '926547813', '2000-11-09', '$2y$10$hW2o43Wk5BYcRLh8Cd7S4uuxjovUG1Z.zSZ9unm7fGcbXXH.HAoS2', 1, 'RL'),
	(7, 'Tiago Santos', 'tiagosantos@gmail.com', '987321654', '2001-07-07', '$2y$10$NDRTijpyrHZ.vvjYpZMVh.RGdT9meiqC7LzcMMHBeWLNbtBRTqeuG', 1, 'TS'),
	(8, 'Luísa Sousa', 'luisasousa@gmail.com', '951357462', '2002-02-21', '$2y$10$b7yJcoOGZIcBTHxrZP.hEufJRO3qK1bUWAMK1Thu83366R9XvvRsO', 1, 'LS'),
	(9, 'Sebastião Mota', 'sebastiaomota@gmail.com', '956478123', '2003-10-30', '$2y$10$ANhgZB6rq65Mz2nXGL8x0eST5T21t.xAxD1osdw8GtMS08s49za86', 1, 'SM'),
	(12, 'Rita Vinagreiro', 'rita.vinagreiro@gmail.com', '918402904', '2005-05-24', '$2y$10$WX06FKMT6Rej7U3NwXM10OmAs/db17aXdBXQkVGfykqirE0WIYl5G', 1, 'RV');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
