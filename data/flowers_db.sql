-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 22 jun 2025 om 23:23
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
-- Database: `flowers_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Boeketten'),
(2, 'Verse Bloemen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `flowers`
--

CREATE TABLE `flowers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `flowers`
--

INSERT INTO `flowers` (`id`, `name`, `price`, `image`, `description`, `category_id`) VALUES
(1, 'Carnation', 35.00, 'carnation-for-special-days.jpg', '\"Elke bloem vertelt een verhaal, maar de anjer is de krachtigste uitdrukking van loyaliteit, liefde en verfijning. Met zijn tijdloze schoonheid voegt het betekenis toe aan speciale momenten en weerspiegelt het emoties op hun puurste manier. Laat een boodschap uit het diepste van je hart achter bij je dierbaren—met de verfijning van een anjer...\"', 1),
(2, 'Madeliefje & Sweet William', 50.00, 'madeliefje-sweet-william-for-special-days.jpg\r\n', '\"De mooiste combinatie van natuur en elegantie! De pure schoonheid van madeliefjes gecombineerd met de verfijnde aanraking van Sweet William bloemen vormt de perfecte harmonie om elke speciale dag te verfraaien. Zowel fris als betekenisvol, dit boeket zal je dierbaren onvergetelijke momenten schenken.\"', 1),
(3, 'Peony', 40.00, 'peony-flower-for-special-days.jpg', 'Een vleugje elegantie voor speciale momenten! De pioenroos, met zijn betoverende en weelderige bloei, maakt elke speciale dag onvergetelijk. Dit boeket, zowel verfijnd als indrukwekkend, is de perfecte keuze om je gevoelens op de meest betekenisvolle manier over te brengen naar je dierbaren. Fris, elegant en betekenisvol!', 1),
(4, 'Red & White Rozes', 90.00, 'red-white-rose-for-special-days.jpg', '\"De perfecte combinatie van liefde en elegantie! Rode rozen zijn het symbool van passie en liefde, terwijl witte rozen de representatie van puurheid en verfijning zijn. Dit speciale boeket maakt elk moment betekenisvoller en drukt je diepste gevoelens op de meest verfijnde manier uit. Zowel visueel verbluffend als betekenisvol, een prachtig cadeau.\"', 1),
(5, 'Mix Roses', 80.00, 'roses-flowers.png', '\"Vol van de elegantie en magie van rozen! De combinatie van alle rozen is de perfecte keuze om elk speciaal moment te verfraaien. Van rood tot wit, van roze tot geel, elke kleur drukt je gevoelens op de meest betekenisvolle manier uit. Geef je dierbaren een onvergetelijk cadeau, de mooiste uitdrukking van liefde, passie en elegantie.\"', 1),
(6, 'Madeliefje & Rode Rose', 50.00, 'madeliefje-rose-for-special-days.jpg', '\"Simpliciteit en passie in perfecte harmonie! De elegante en pure schoonheid van de witte madeliefjes wordt versterkt door de vur krachtige uitstraling van één rode roos. Dit boeket, waarin de puurste vorm van liefde tot uiting komt, is een cadeau dat elk speciaal moment onvergetelijk maakt. Breng je gevoelens op een elegante en betekenisvolle manier over naar je dierbaren!\"', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `flower_comments`
--

CREATE TABLE `flower_comments` (
  `id` int(11) NOT NULL,
  `flower_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `flower_comments`
--

INSERT INTO `flower_comments` (`id`, `flower_id`, `name`, `message`, `likes`, `created_at`) VALUES
(1, 1, 'Bercem Yildirim', 'mooi', 17, '2025-06-19 17:31:41'),
(2, 2, 'bercem', 'heel mooi', 0, '2025-06-19 17:28:26'),
(3, 1, 'Bercem Yildirim', 'mooi', 25, '2025-06-19 17:29:47');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `flowers`
--
ALTER TABLE `flowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexen voor tabel `flower_comments`
--
ALTER TABLE `flower_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flower_id` (`flower_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `flowers`
--
ALTER TABLE `flowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `flower_comments`
--
ALTER TABLE `flower_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
