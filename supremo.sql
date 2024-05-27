-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 25, 2024 at 03:46 PM
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

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`idUzytkownika`, `imie`, `nazwisko`, `email`, `nrTelefonu`, `haslo`) VALUES
(248658, 'ILYA', 'KHOTSIM', 'ilyathebest0@gmail.com', '720417342', 'c4048b088d3fe9adf1bec674b4cc4ddc');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `idZadania` int(11) NOT NULL,
  `dataRozpoczecia` datetime DEFAULT NULL,
  `dataZakonczenia` datetime DEFAULT NULL,
  `tytul` varchar(100) DEFAULT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zadania`
--

INSERT INTO `zadania` (`idZadania`, `dataRozpoczecia`, `dataZakonczenia`, `tytul`, `opis`) VALUES
(1, '2024-05-24 10:32:54', '2024-05-31 10:32:54', 'Impreza', 'qeiruhgoipuadhgpai');

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
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`idOceny`),
  ADD KEY `idUzytkownika` (`idUzytkownika`),
  ADD KEY `idPrzedmiotu` (`idPrzedmiotu`),
  ADD KEY `idAktywnosci` (`idAktywnosci`);

--
-- Indeksy dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`idPrzedmiotu`),
  ADD KEY `idUzytkownika` (`idUzytkownika`);

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
-- AUTO_INCREMENT for table `aktywnosci`
--
ALTER TABLE `aktywnosci`
  MODIFY `idAktywnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `idOceny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8749652;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `idUzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248659;

--
-- AUTO_INCREMENT for table `zadania`
--
ALTER TABLE `zadania`
  MODIFY `idZadania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zadaniauzytkownikow`
--
ALTER TABLE `zadaniauzytkownikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktywnosci`
--
ALTER TABLE `aktywnosci`
  ADD CONSTRAINT `aktywnosci_ibfk_1` FOREIGN KEY (`idPrzedmiotu`) REFERENCES `przedmiot` (`idPrzedmiotu`);

--
-- Constraints for table `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`),
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`idPrzedmiotu`) REFERENCES `przedmiot` (`idPrzedmiotu`),
  ADD CONSTRAINT `oceny_ibfk_3` FOREIGN KEY (`idAktywnosci`) REFERENCES `aktywnosci` (`idAktywnosci`);

--
-- Constraints for table `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD CONSTRAINT `przedmiot_ibfk_1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy` (`idUzytkownika`);

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
