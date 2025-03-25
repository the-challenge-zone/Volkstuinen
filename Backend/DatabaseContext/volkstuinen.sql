-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 17 mrt 2025 om 14:17
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
-- Database: `volkstuinen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `complexes`
--

CREATE TABLE `complexes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `complexes`
--

INSERT INTO `complexes` (`Id`, `Name`) VALUES
(1, 'Baandert I'),
(2, 'Baandert II'),
(3, 'Ophoven'),
(4, 'De Moustem'),
(5, 'De Gats'),
(6, 'Lahrhöfke'),
(7, 'Sanderbout'),
(8, 'Slachthuis'),
(9, 'Overhoven'),
(10, 'Braokerhofke'),
(11, 'Den Haof'),
(12, 'Wehrer Beemd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE `messages` (
  `Id` int(11) NOT NULL,
  `Receiver` varchar(255) DEFAULT NULL,
  `Sender` varchar(255) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Message` varchar(255) DEFAULT NULL,
  `User` int(11) NOT NULL,
  `Complex` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parcel`
--

CREATE TABLE `parcel` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Size` int(11) NOT NULL,
  `Complex` int(11) NOT NULL,
  `User` int(11) DEFAULT NULL,
  `Price` int(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `parcel`
--

INSERT INTO `parcel` (`Id`, `Name`, `Size`, `Complex`, `User`, `Price`, `user_id`) VALUES
(1, 'marc dober', 7, 3, 3, 50, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parcel-request`
--

CREATE TABLE `parcel-request` (
  `Id` int(11) NOT NULL,
  `Parcel` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Complex` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parcel_free`
--

CREATE TABLE `parcel_free` (
  `id` int(11) NOT NULL,
  `Size` int(11) NOT NULL,
  `Complex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `parcel_free`
--

INSERT INTO `parcel_free` (`id`, `Size`, `Complex`) VALUES
(1, 24, 'Baandert 1'),
(2, 11, 'Baandert 2'),
(3, 7, 'Ophoven'),
(4, 14, 'De Moustem'),
(5, 33, 'De Gats'),
(6, 21, 'Lahrhofke'),
(7, 15, 'Sanderbout'),
(8, 22, 'Slachthuis'),
(9, 10, 'Overhoven'),
(10, 44, 'Braokerhofke'),
(11, 50, 'Den Haof'),
(12, 37, 'Wehrer Beemd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `requests`
--

CREATE TABLE `requests` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `ZipCode` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Motive` text NOT NULL,
  `Complex1` int(11) NOT NULL,
  `Complex2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(11) DEFAULT NULL,
  `ZipCode` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Complex` int(11) DEFAULT NULL,
  `UserType` int(3) DEFAULT 1,
  `Membership` tinyint(1) DEFAULT 0,
  `Payment` tinyint(1) DEFAULT 0,
  `user_id` int(100) DEFAULT NULL,
  `identifier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`Id`, `Name`, `Email`, `Password`, `PhoneNumber`, `ZipCode`, `Address`, `Complex`, `UserType`, `Membership`, `Payment`, `user_id`, `identifier`) VALUES
(1, 'Jonathan Ilunga', 'ilunga866@gmail.com', '$2y$10$G5BKEy90R55FImgSh8Th0.o6xOMFxvoKFcZOYnuO/.XCkkkQeZfge', '0623484527', '5637 JA', 'lindelaan 5', NULL, 3, NULL, NULL, NULL, ''),
(2, 'Jeff Dober', 'jeffdober@gmail.com', '$2y$10$kwXvDPAF3OQ4isjUrweYIeFgt0LhqQtsQsbZlvTKRB9wfpkxyTKPy', '587-504-143', '6791BB', 'westwaystreet 72', 1, 2, NULL, NULL, NULL, ''),
(3, 'Marc Dober', 'Marcdober@gmail.com', '$2y$10$CtMDZk4/7rny4.2FrZV1uOuGLSl6zPqYAYSJSVhd2PVOCCJVAU2GK', '508-544-141', '6791BB', 'westwaystreet 72', 1, 1, NULL, NULL, NULL, ''),
(4, 'test123', 'test@gmail.com', '$2y$10$rrsNLlE8qqlXDa5xuAtVkeSdGbkdl5eHigJI1yaajulB15gh1FY16', '061115467', '5463 AM', '37', NULL, 1, 0, 0, NULL, ''),
(5, 'test123', 'test123@gmail.com', '$2y$10$yVRxoUEXta9XsUgc.ltG7ef4xTJQiWHxGbgyiT.XfoJx3CphRC.42', '061115467', '5463 AM', '37', NULL, 1, 0, 0, NULL, ''),
(6, 'John Doe', 'johndoe@gmail.com', '$2y$10$8FFH/xQrY9Z/TCu4JtXadOX1kcTvt3IkggQBaDtfwWnOC2Z1RRtgy', '580-104-343', '2141DB', 'Nethernowstreet 72', 1, 1, NULL, NULL, NULL, ''),
(7, 'John Doe', 'johndoe@gmail.com', '$2y$10$JWbiPn5jc8C.igM74ySIPuHVa2gXOQ1CeMEhY5I70e.oD42BLIsYu', '580-104-343', '2141DB', 'Nethernowstreet 72', 1, 1, NULL, NULL, NULL, ''),
(8, 'John Doe', 'johndoe@gmail.com', '$2y$10$RemmZ4B0Wz9gmx37WSY9Zu2Mcb5OE/RXpx23oy6q1ttXDISgcD88u', '580-104-343', '2141DB', 'Nethernowstreet 72', 1, 1, NULL, NULL, NULL, ''),
(9, 'Thomas', 'johndoe@gmail.com', '$2y$10$KD55Uvz/KtxlbFqBHjKRauu8jF3hH2X1MPgtP0F19wd.CHCFU3Ka.', '580-104-343', '2141DB', 'Nethernowstreet 72', 1, 1, NULL, NULL, NULL, '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `complexes`
--
ALTER TABLE `complexes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User` (`User`),
  ADD KEY `Complex` (`Complex`);

--
-- Indexen voor tabel `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User` (`User`),
  ADD KEY `Complex` (`Complex`);

--
-- Indexen voor tabel `parcel-request`
--
ALTER TABLE `parcel-request`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Complex` (`Complex`),
  ADD KEY `User` (`User`),
  ADD KEY `Parcel` (`Parcel`);

--
-- Indexen voor tabel `parcel_free`
--
ALTER TABLE `parcel_free`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Complex1` (`Complex1`),
  ADD KEY `Complex2` (`Complex2`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Complex` (`Complex`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `complexes`
--
ALTER TABLE `complexes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `parcel`
--
ALTER TABLE `parcel`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `parcel-request`
--
ALTER TABLE `parcel-request`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `parcel_free`
--
ALTER TABLE `parcel_free`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `requests`
--
ALTER TABLE `requests`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`User`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Complex`) REFERENCES `complexes` (`Id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `parcel_ibfk_1` FOREIGN KEY (`User`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel_ibfk_2` FOREIGN KEY (`Complex`) REFERENCES `complexes` (`Id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `parcel-request`
--
ALTER TABLE `parcel-request`
  ADD CONSTRAINT `parcel-request_ibfk_1` FOREIGN KEY (`Complex`) REFERENCES `complexes` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel-request_ibfk_2` FOREIGN KEY (`User`) REFERENCES `users` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parcel-request_ibfk_3` FOREIGN KEY (`Parcel`) REFERENCES `parcel` (`Id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`Complex1`) REFERENCES `complexes` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`Complex2`) REFERENCES `complexes` (`Id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Complex`) REFERENCES `complexes` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
