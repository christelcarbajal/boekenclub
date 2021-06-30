-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 jun 2021 om 06:21
-- Serverversie: 10.4.19-MariaDB
-- PHP-versie: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cle4`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `docenten`
--

CREATE TABLE `docenten` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `docenten`
--

INSERT INTO `docenten` (`id`, `name`, `mail`, `school`, `password`) VALUES
(3, 'Bram Ekelschot', 'bramekelschot@hotmail.nl', 'hr', '$2y$10$ENv0RhEHEJluIgINsSfUZu/TWGOZWcKmW0z73Ken1pNnFNyL/gxZS'),
(4, 'Bram Ekelschot', 'bramekelschot@outlook.com', 'Lyceum Rotterdam', '$2y$10$/5Qwt9B6sDMimTA3Z09pxOc5XjQzuo.Ei1oEnVGQN3/k3o.zE8rd6');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kinderen`
--

CREATE TABLE `kinderen` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `LV1 goed` int(11) NOT NULL,
  `LV2 goed` int(11) NOT NULL,
  `LV3 goed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `kinderen`
--

INSERT INTO `kinderen` (`id`, `name`, `school`, `LV1 goed`, `LV2 goed`, `LV3 goed`) VALUES
(10001, 'Bram Ekelschot', 'hr', 2, 5, 1),
(10002, 'Jan Klaas', 'hr', 1, 3, 2),
(10004, 'Joe Biden', 'hr', 0, 0, 0),
(10005, 'Donald Trump', 'hr', 0, 0, 0),
(10012, 'Jeff Bakker', 'Lyceum Rotterdam', 0, 0, 0),
(10013, 'Obama', 'hr', 0, 0, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `docenten`
--
ALTER TABLE `docenten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `kinderen`
--
ALTER TABLE `kinderen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `docenten`
--
ALTER TABLE `docenten`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `kinderen`
--
ALTER TABLE `kinderen`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10014;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
