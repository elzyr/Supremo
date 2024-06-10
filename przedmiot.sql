-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 10, 2024 at 12:10 PM
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
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `idPrzedmiotu` int(11) NOT NULL,
  `nazwa` varchar(100) DEFAULT NULL,
  `idUzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `przedmiot`
--

INSERT INTO `przedmiot` (`idPrzedmiotu`, `nazwa`, `idUzytkownika`) VALUES
(1, 'PIO', 248658),
(2, 'KCK', 248658),
(3, 'Java', 248658),
(4, 'SO2', 248658);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`idPrzedmiotu`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD CONSTRAINT `przedmiot_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
