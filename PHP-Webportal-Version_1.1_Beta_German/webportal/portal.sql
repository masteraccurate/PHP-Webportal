-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: masteraccurate.lima-db.de:3306
-- Erstellungszeit: 25. Jun 2020 um 18:48
-- Server-Version: 5.7.29-32-log
-- PHP-Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_227636_3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `comments` text COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board`
--

CREATE TABLE `board` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `comment` text COLLATE utf8mb4_german2_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `subcatid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_cat`
--

CREATE TABLE `board_cat` (
  `catid` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `board_subcat`
--

CREATE TABLE `board_subcat` (
  `subcatid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `description` text COLLATE utf8mb4_german2_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `description` text COLLATE utf8mb4_german2_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `files_cat`
--

CREATE TABLE `files_cat` (
  `catid` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gbook`
--

CREATE TABLE `gbook` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_german2_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `description` text COLLATE utf8mb4_german2_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images_cat`
--

CREATE TABLE `images_cat` (
  `catid` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `description` text COLLATE utf8mb4_german2_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `links_cat`
--

CREATE TABLE `links_cat` (
  `catid` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `description` text COLLATE utf8mb4_german2_ci NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `media_cat`
--

CREATE TABLE `media_cat` (
  `catid` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messenger`
--

CREATE TABLE `messenger` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `message` text COLLATE utf8mb4_german2_ci NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `homepage` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `opt1` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `opt2` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `opt3` varchar(255) COLLATE utf8mb4_german2_ci NOT NULL,
  `comment` text COLLATE utf8mb4_german2_ci NOT NULL,
  `signatur` text COLLATE utf8mb4_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_german2_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `board_cat`
--
ALTER TABLE `board_cat`
  ADD PRIMARY KEY (`catid`),
  ADD UNIQUE KEY `catid` (`catid`,`category`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `board_subcat`
--
ALTER TABLE `board_subcat`
  ADD PRIMARY KEY (`subcatid`);

--
-- Indizes für die Tabelle `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indizes für die Tabelle `files_cat`
--
ALTER TABLE `files_cat`
  ADD PRIMARY KEY (`catid`),
  ADD UNIQUE KEY `catid` (`catid`,`category`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `gbook`
--
ALTER TABLE `gbook`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indizes für die Tabelle `images_cat`
--
ALTER TABLE `images_cat`
  ADD PRIMARY KEY (`catid`),
  ADD UNIQUE KEY `catid` (`catid`,`category`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indizes für die Tabelle `links_cat`
--
ALTER TABLE `links_cat`
  ADD PRIMARY KEY (`catid`),
  ADD UNIQUE KEY `catid` (`catid`,`category`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indizes für die Tabelle `media_cat`
--
ALTER TABLE `media_cat`
  ADD PRIMARY KEY (`catid`),
  ADD UNIQUE KEY `catid` (`catid`,`category`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `messenger`
--
ALTER TABLE `messenger`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `files_cat`
--
ALTER TABLE `files_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gbook`
--
ALTER TABLE `gbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `images_cat`
--
ALTER TABLE `images_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `links_cat`
--
ALTER TABLE `links_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `media_cat`
--
ALTER TABLE `media_cat`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `messenger`
--
ALTER TABLE `messenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
