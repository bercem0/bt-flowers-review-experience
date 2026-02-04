-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 22 jun 2025 om 23:24
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact_form_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `flower_comments`
--

CREATE TABLE `flower_comments` (
  `id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `flower_comments`
--

INSERT INTO `flower_comments` (`id`, `flower_id`, `name`, `message`, `created_at`) VALUES
(1, 1, 'bercem:)', 'Beste bloemenwebsite. Mijn favorite boeketten.', '2025-03-28 11:32:48'),
(2, 2, 'Bercem Yildirim', 'beste boeket', '2025-03-28 13:08:33'),
(3, 1, 'Tugche Sezer', 'Ik vind deze boeket heel mooi.', '2025-03-28 21:24:30'),
(4, 1, 'Tugche Sezer', 'mooi', '2025-03-28 21:40:18'),
(5, 1, 'dkm', 'dkcxm', '2025-03-28 21:40:59'),
(6, 1, 'kdsmf', 'sdkfl', '2025-03-29 11:22:47'),
(7, 5, 'sdklmf', 'dlkmf', '2025-03-29 11:25:53'),
(8, 5, 'spdofk', 'dfgrt5r', '2025-03-29 11:26:52'),
(9, 3, 'oqwpaeri', 'weposfidrgj', '2025-03-29 11:27:03'),
(10, 4, 'skoodk', 'dkcfm', '2025-03-29 12:43:00'),
(11, 5, 'owedfskj', 'skcvn', '2025-03-30 22:33:21');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'fdsfds', 'fdfd@test.com', 'fdsf', '2025-03-28 11:23:26'),
(2, 'fdsfds', 'fdfd@test.com', 'fdsf', '2025-03-28 11:24:20'),
(3, 'Zekiye Bercem Yildirim', 'bercem.yildirimm@gmail.com', 'Hallo. Ik ben Bercem.', '2025-03-28 11:33:23'),
(4, 'Zekiye Bercem Yildirim', 'bercem.yildirimm@gmail.com', 'Hallo. Ik ben Bercem.', '2025-03-28 11:34:19'),
(5, 'Zekiye Bercem Yildirim', 'bercem.yildirimm@gmail.com', 'Hallo allemaal!', '2025-03-28 11:34:39'),
(6, 'Bercem Yildirim', 'bercemyildirim02@gmail.com', 'Hallo!', '2025-03-28 13:08:52'),
(7, 'Bercem Yildirim', 'bercmeyildirm@gmail.com', 'Hallo!', '2025-03-28 20:33:06'),
(8, 'Tugche Sezer', 'tugchesezeer@gmail.com', 'Hallo! Ik ben Tugche :)', '2025-03-30 22:32:45');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `flower_comments`
--
ALTER TABLE `flower_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- Indexen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `flower_comments`
--
ALTER TABLE `flower_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
