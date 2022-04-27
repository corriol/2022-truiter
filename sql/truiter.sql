-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Temps de generació: 27-04-2022 a les 16:44:03
-- Versió del servidor: 10.4.21-MariaDB-1:10.4.21+maria~focal
-- Versió de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `truiter`
--
CREATE DATABASE IF NOT EXISTS `truiter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `truiter`;

-- --------------------------------------------------------

--
-- Estructura de la taula `truit`
--

CREATE TABLE `truit` (
  `id` int(11) NOT NULL,
  `text` varchar(140) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Bolcament de dades per a la taula `truit`
--

INSERT INTO `truit` (`id`, `text`, `created_at`, `user_id`) VALUES
(31, 'Iâ€™m not normally a praying man, but if youâ€™re up there, please save me, Superman.', '2022-04-21 07:55:23', 21),
(32, 'For once, maybe someone will call me â€˜sirâ€™ without adding, â€˜youâ€™re making a scene.\'', '2022-04-21 08:56:23', 22),
(33, 'If God didn\'t want us to eat animals, why did he make them out of meat?', '2022-04-21 11:08:23', 22),
(34, 'English? Who needs that? I\'m never going to England.', '2022-04-21 10:14:23', 21),
(35, 'Facts are meaningless. You can use facts to prove anything thatâ€™s even remotely true.', '2022-04-21 07:52:23', 21),
(36, 'Lisaâ€™s growing up. Itâ€™s a really complicated time in a girlâ€™s life from age eight toâ€¦ Actually, all the rest of the way', '2022-04-21 08:25:23', 21),
(37, 'I\'m not popular enough to be different.', '2022-04-21 10:23:23', 22),
(38, 'If he\'s so smart, how come he\'s dead?', '2022-04-21 09:43:23', 22),
(39, 'Whatâ€™s the point of going out? Weâ€™re just going to wind up back here, anyway.', '2022-04-21 10:27:23', 22),
(40, 'I\'m not popular enough to be different.', '2022-04-21 10:34:23', 22);

-- --------------------------------------------------------

--
-- Estructura de la taula `user`
--

CREATE TABLE `user` (
  `username` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Bolcament de dades per a la taula `user`
--

INSERT INTO `user` (`username`, `name`, `email`, `password`, `id`) VALUES
('homer', 'Homer Simpson', 'hsimpson@springfield.us', '$2y$10$C9tjWYA1plM9.cU60p5sMuT/Jxxul6gIqxfVZeqJJnagtX592Y83G', 21),
('marge', 'Marge Simpson', 'msimpson@springfield.us', '$2y$10$rPgHNWWnI1H8L/MWq9QCBuNrg9AaJ7h4nsL4iM.ZjCw41i1udSQF6', 22);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `truit`
--
ALTER TABLE `truit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_TRUIT_USER` (`user_id`);

--
-- Índexs per a la taula `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `truit`
--
ALTER TABLE `truit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT per la taula `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `truit`
--
ALTER TABLE `truit`
  ADD CONSTRAINT `FK_TRUIT_USER` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
