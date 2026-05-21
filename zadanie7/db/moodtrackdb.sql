-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 21, 2026 at 07:52 PM
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
-- Database: `moodtrackdb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mood`
--

CREATE TABLE `mood` (
  `idMood` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `mood`
--

INSERT INTO `mood` (`idMood`, `name`) VALUES
(1, 'Energiczny'),
(2, 'Relaksujący'),
(3, 'Smutny'),
(4, 'Radosny'),
(5, 'Melancholia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `isActive` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`idRole`, `name`, `isActive`) VALUES
(1, 'Admin', 1),
(2, 'User', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `song`
--

CREATE TABLE `song` (
  `idSong` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idMood` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `artist` varchar(100) NOT NULL,
  `intensity` int(11) DEFAULT NULL,
  `addedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`idSong`, `idUser`, `idMood`, `title`, `artist`, `intensity`, `addedAt`) VALUES
(1, 2, 4, 'Stick With You', 'TOMORROW X TOGETHER', 8, '2026-05-21 19:49:56');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `login`, `password`, `createdAt`) VALUES
(1, 'admin', '$2y$10$nva75EyYEyWWKyuVhJIFm.nYOeLuw/kiP1RPOSc2EXdzcp9E9us92', '2026-05-06 18:53:12'),
(2, 'user', '$2y$10$Fk47yqZ72qG8ATnHG0lTyeq4PC7ejM4sRDnBwag.SyEbtQZo9UDbi', '2026-05-21 19:48:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_role`
--

CREATE TABLE `user_role` (
  `idUser` int(11) NOT NULL,
  `idRole` int(11) NOT NULL,
  `assignedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`idUser`, `idRole`, `assignedAt`) VALUES
(1, 1, '2026-05-06 18:53:12'),
(2, 2, '2026-05-21 19:48:27');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `mood`
--
ALTER TABLE `mood`
  ADD PRIMARY KEY (`idMood`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);

--
-- Indeksy dla tabeli `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`idSong`),
  ADD KEY `fk_song_user_idx` (`idUser`),
  ADD KEY `fk_song_mood_idx` (`idMood`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indeksy dla tabeli `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`idUser`,`idRole`),
  ADD KEY `fk_role_idx` (`idRole`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mood`
--
ALTER TABLE `mood`
  MODIFY `idMood` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `idSong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `fk_song_mood` FOREIGN KEY (`idMood`) REFERENCES `mood` (`idMood`),
  ADD CONSTRAINT `fk_song_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
