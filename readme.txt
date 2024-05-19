-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 09:02 PM
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
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `idUzytkownika` int(11) NOT NULL,
  `imie` varchar(60) NOT NULL,
  `nazwisko` varchar(60) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nrTelefonu` varchar(9) DEFAULT NULL,
  `haslo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `idZadania` int(11) NOT NULL,
  `dataRozpoczecia` date DEFAULT NULL,
  `dataZakonczenia` date DEFAULT NULL,
  `tytul` varchar(100) DEFAULT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadaniauzytkownikow`
--

CREATE TABLE `zadaniauzytkownikow` (
  `id` int(11) NOT NULL,
  `idUzytkownika` int(11) DEFAULT NULL,
  `idZadania` int(11) DEFAULT NULL,
  `czyWazne` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------
--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `idPrzedmiotu` int(11) NOT NULL,
  `nazwa` varchar(100) DEFAULT NULL,
  `idUzytkownika` int(11) DEFAULT NULL, 
  PRIMARY KEY (`idPrzedmiotu`),
  KEY `idUzytkownika` (`idUzytkownika`),
  CONSTRAINT `przedmiot_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `idOceny` int(11) NOT NULL AUTO_INCREMENT,
  `idUzytkownika` int(11) NOT NULL,
  `idPrzedmiotu` int(11) NOT NULL,
  `idAktywnosci` int(11) NOT NULL,
  `ocena` decimal(3,2) NOT NULL,
  PRIMARY KEY (`idOceny`),
  KEY `idUzytkownika` (`idUzytkownika`),
  KEY `idPrzedmiotu` (`idPrzedmiotu`),
  KEY `idAktywnosci` (`idAktywnosci`),
  CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`),
  CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`idPrzedmiotu`) REFERENCES `przedmiot` (`idPrzedmiotu`),
  CONSTRAINT `oceny_ibfk_3` FOREIGN KEY (`idAktywnosci`) REFERENCES `aktywnosci` (`idAktywnosci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Struktura tabeli dla tabeli `aktywnosci`
--

CREATE TABLE `aktywnosci` (
  `idAktywnosci` int(11) NOT NULL AUTO_INCREMENT,
  `idPrzedmiotu` int(11) NOT NULL,
  `nazwa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idAktywnosci`),
  KEY `idPrzedmiotu` (`idPrzedmiotu`),
  CONSTRAINT `aktywnosci_ibfk_1` FOREIGN KEY (`idPrzedmiotu`) REFERENCES `przedmiot` (`idPrzedmiotu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- Indeksy dla zrzutÃ³w tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`idUzytkownika`);

--
-- Indeksy dla tabeli `zadania`
--
ALTER TABLE `zadania`
  ADD PRIMARY KEY (`idZadania`);

--
-- Indeksy dla tabeli `zadaniauzytkownikow`
--
ALTER TABLE `zadaniauzytkownikow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `idZadania` (`idZadania`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `idUzytkownika` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zadania`
--
ALTER TABLE `zadania`
  MODIFY `idZadania` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zadaniauzytkownikow`
--
ALTER TABLE `zadaniauzytkownikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zadaniauzytkownikow`
--
ALTER TABLE `zadaniauzytkownikow`
  ADD CONSTRAINT `zadaniauzytkownikow_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`),
  ADD CONSTRAINT `zadaniauzytkownikow_ibfk_2` FOREIGN KEY (`idZadania`) REFERENCES `zadania` (`idZadania`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;