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
-- Struktura tabeli dla tabeli `aktywnosci`
--

CREATE TABLE `aktywnosci` (
  `idAktywnosci` int(11) NOT NULL,
  `idPrzedmiotu` int(11) NOT NULL,
  `nazwa` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktywnosci`
--

INSERT INTO `aktywnosci` (`idAktywnosci`, `idPrzedmiotu`, `nazwa`) VALUES
(1, 1, 'Lab GitHub ^_^'),
(2, 2, 'Figma'),
(3, 3, 'Server'),
(4, 1, 'Suszarka');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aktywnosci`
--
ALTER TABLE `aktywnosci`
  ADD PRIMARY KEY (`idAktywnosci`),
  ADD KEY `idPrzedmiotu` (`idPrzedmiotu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktywnosci`
--
ALTER TABLE `aktywnosci`
  MODIFY `idAktywnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktywnosci`
--
ALTER TABLE `aktywnosci`
  ADD CONSTRAINT `aktywnosci_ibfk_1` FOREIGN KEY (`idPrzedmiotu`) REFERENCES `przedmiot` (`idPrzedmiotu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
