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

-- A despejar dados para tabela projeto.inscricoes_eventos: ~3 rows (aproximadamente)
INSERT INTO `inscricoes_eventos` (`id_inscricao`, `id_socio`, `nome`, `email`, `telefone`, `id_evento`, `data_inscricao`) VALUES
	(1, 4, NULL, NULL, NULL, 'xadrez', '2025-12-15 16:42:44'),
	(5, 12, NULL, NULL, NULL, 'cluedo', '2025-12-16 14:42:31'),
	(6, 12, NULL, NULL, NULL, 'xadrez', '2025-12-16 15:08:45'),
	(11, NULL, 'Mara Gomes', 'mara123@gmail.com', '987321654', 'cluedo', '2025-12-16 20:05:27'),
	(13, NULL, 'Maria Figueiredo', 'maria123@gmail.com', '965855544', 'monopoly', '2025-12-16 20:08:19'),
	(15, NULL, 'Maria Gomes', 'maria123@gmail.com', '965855544', 'ticket-to-ride', '2025-12-16 21:59:19'),
	(16, 5, 'Iara Gomes', 'iarag8656@gmail.com', '956478123', 'pandemic', '2025-12-16 22:05:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
