-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 10, 2024 at 12:09 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supremo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `idOceny` int(11) NOT NULL,
  `idUzytkownika` int(11) NOT NULL,
  `idPrzedmiotu` int(11) NOT NULL,
  `idAktywnosci` int(11) NOT NULL,
  `ocena` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oceny`
--

INSERT INTO `oceny` (`idOceny`, `idUzytkownika`, `idPrzedmiotu`, `idAktywnosci`, `ocena`) VALUES
(1, 248658, 1, 1, 2.00),
(784654, 248658, 1, 4, 3.00),
(981654, 248658, 2, 2, 2.00),
(8749651, 248658, 3, 3, 3.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`idOceny`),
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `idPrzedmiotu` (`idPrzedmiotu`),
  ADD KEY `idAktywnosci` (`idAktywnosci`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `idOceny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8749654;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`),
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`idPrzedmiotu`) REFERENCES `przedmiot` (`idPrzedmiotu`),
  ADD CONSTRAINT `oceny_ibfk_3` FOREIGN KEY (`idAktywnosci`) REFERENCES `aktywnosci` (`idAktywnosci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
