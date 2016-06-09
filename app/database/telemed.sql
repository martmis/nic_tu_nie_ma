-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Maj 2016, 22:05
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `telemed`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `badania`
--

CREATE TABLE `badania` (
  `id_badania` int(11) NOT NULL,
  `id_pacjenta` int(11) NOT NULL,
  `typ` text COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `data_file` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `badania`
--

INSERT INTO `badania` (`id_badania`, `id_pacjenta`, `typ`, `data`, `data_file`) VALUES
(3, 1, 'bieganie', '2016-05-10', 'badanie1.xlsx'),
(4, 1, 'bieganie', '2016-05-17', 'badanie1.xlsx'),
(5, 2, 'skakanie', '2016-05-01', 'badanie2.xlsx'),
(7, 1, 'marsz', '2016-05-11', 'badanie4.xlsx'),
(8, 1, 'marsz', '2016-05-04', 'badanie4.xlsx'),
(12, 4, 'bieganie', '2016-05-30', 'badanie8.xlsx'),
(13, 3, 'marsz', '2016-05-30', 'badanie7.xlsx'),
(14, 2, 'bieganie', '2016-05-30', 'badanie6.xlsx');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjenci`
--

CREATE TABLE `pacjenci` (
  `id_pacjenta` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `wiek` int(11) NOT NULL,
  `pesel` varchar(12) NOT NULL,
  `plec` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pacjenci`
--

INSERT INTO `pacjenci` (`id_pacjenta`, `imie`, `nazwisko`, `pesel`) VALUES
(1, 'Jan', 'Kowalski', 123456789),
(2, 'Adam', 'Nowak', 789456123),
(3, 'Anna', 'Zawierucha', 456123789),
(4, 'Martyna', 'Kot', 987123654);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `badania`
--
ALTER TABLE `badania`
  ADD PRIMARY KEY (`id_badania`);

--
-- Indexes for table `pacjenci`
--
ALTER TABLE `pacjenci`
  ADD PRIMARY KEY (`id_pacjenta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `badania`
--
ALTER TABLE `badania`
  MODIFY `id_badania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `pacjenci`
--
ALTER TABLE `pacjenci`
  MODIFY `id_pacjenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
