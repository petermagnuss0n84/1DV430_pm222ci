-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Skapad: 22 maj 2014 kl 19:36
-- Serverversion: 5.6.11-log
-- PHP-version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `mjukvaruutveckling`
--
CREATE DATABASE IF NOT EXISTS `mjukvaruutveckling` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mjukvaruutveckling`;

-- --------------------------------------------------------

--
-- Tabellstruktur `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumpning av Data i tabell `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'Spel'),
(2, 'Android'),
(3, 'PC'),
(4, 'iOS'),
(5, 'Windows Phone'),
(6, 'Mobil'),
(7, 'Webb');

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(500) NOT NULL,
  `postid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `INDEX` (`postid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `comment`, `postid`) VALUES
(4, 'sadsd', 6),
(7, 'testar denna med', 5),
(9, 'xcvcxvc', 6),
(10, 'tredje kommentaren', 6),
(11, 'testar att kommentera inna jag ska spela igen', 6),
(12, 'kommentar1', 8),
(13, 'testar', 10),
(15, 'as', 11),
(16, 'kommentar2', 8),
(17, 'ssss', 9);

-- --------------------------------------------------------

--
-- Tabellstruktur `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin` int(11) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumpning av Data i tabell `login`
--

INSERT INTO `login` (`userID`, `username`, `password`, `admin`) VALUES
(1, 'login', 'Pass123', 0),
(2, 'user', 'Pass123', 0),
(3, 'test', 'Pass123', 0),
(4, 'admin', 'Pass123', 1),
(5, 'test123', 'Pass123', 0),
(6, 'test2', 'Pass123', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `post` text NOT NULL,
  `author` varchar(30) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `commentCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `title`, `post`, `author`, `categoryID`, `commentCount`) VALUES
(2, 'test2', 'test2', 'peter', NULL, NULL),
(4, 'cvcv', 'ffdg', 'peter', NULL, NULL),
(5, 'cccc2', 'sdadsa sdsadsa\r\n\r\n\r\nsadsad', 'peter', NULL, NULL),
(7, 'hhhhkkkkk', 'Testar att skriva ett inlägg nu när jag har tagit bort några require once\r\n\r\n...', 'Peter', NULL, NULL),
(8, 'En Titel', 'test', 'peter', NULL, NULL),
(9, 'redigerar', 'redigerar', 'peter1', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
