-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 10, 2024 at 12:19 PM
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `idPrzedmiotu` int(11) NOT NULL,
  `nazwa` varchar(100) DEFAULT NULL,
  `idUzytkownika` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Kamil', 'Winczewski', 'kamilwinczewski52@gmail.com', '535979774', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zadania`
--

CREATE TABLE `zadania` (
  `idZadania` int(11) NOT NULL,
  `dataRozpoczecia` datetime DEFAULT NULL,
  `dataZakonczenia` datetime DEFAULT NULL,
  `tytul` varchar(100) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `czyEvent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zadania`
--

INSERT INTO `zadania` (`idZadania`, `dataRozpoczecia`, `dataZakonczenia`, `tytul`, `opis`, `czyEvent`) VALUES
(47, '2024-06-01 16:00:00', '2024-06-01 18:00:00', 'Festiwal', 'Zapraszamy na Festiwal Kultury i Sztuki, który odbędzie się w malowniczym parku miejskim w dniach 10-12 sierpnia. To trzydniowe wydarzenie oferuje bogaty program artystyczny, obejmujący koncerty, spektakle teatralne, wystawy plastyczne oraz warsztaty dla dzieci i dorosłych. Festiwal jest okazją do spotkania z lokalnymi artystami, zanurzenia się w różnorodnych formach wyrazu artystycznego i spędzenia czasu w inspirującej atmosferze. W programie znajdą się również strefy gastronomiczne z lokalnymi przysmakami oraz stoiska z rękodziełem. Dołącz do nas i odkryj piękno i różnorodność kultury!', 1),
(48, '2024-06-02 12:00:00', '2024-06-02 14:00:00', 'Grill', NULL, 1),
(49, '2024-06-03 08:00:00', '2024-06-02 10:00:00', 'Hackathon', 'Hackathon', 1),
(50, '2024-06-05 10:00:00', '2024-06-05 11:00:00', 'Impreza', 'Zapraszam na impreze', 1),
(51, '2024-06-07 10:00:00', '2024-06-07 13:00:00', 'Obiadek', 'Pyszny obiad.', 1),
(52, '2024-06-04 08:00:00', '2024-06-04 13:00:00', 'Renault-Event', NULL, 1),
(65, '2024-06-05 12:00:00', '2024-06-05 14:00:00', 'czesc', '', 0);

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
-- Dumping data for table `zadaniauzytkownikow`
--

INSERT INTO `zadaniauzytkownikow` (`id`, `idUzytkownika`, `idZadania`, `czyWazne`) VALUES
(55, 1, 65, 0);

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
  MODIFY `idAktywnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `idOceny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8749655;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `idUzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zadania`
--
ALTER TABLE `zadania`
  MODIFY `idZadania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `zadaniauzytkownikow`
--
ALTER TABLE `zadaniauzytkownikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
