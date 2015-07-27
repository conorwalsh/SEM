-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
--                Conor Walsh 2015
--        Website: http://www.conorwalsh.net
--      GitHub:  https://github.com/conorwalsh
-- Project: Smart Environment Monitoring system (S.E.M.)
--
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `emaillogs`
--

CREATE TABLE IF NOT EXISTS `emaillogs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `emailstatus` varchar(300) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

--
-- Dumping data for table `emaillogs`
--

INSERT INTO `emaillogs` (`id`, `emailstatus`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `environment1`
--

CREATE TABLE IF NOT EXISTS `environment1` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `inttemp` float NOT NULL,
  `exttemp` float NOT NULL,
  `inthum` int(10) NOT NULL,
  `exthum` int(10) NOT NULL,
  `light` float NOT NULL,
  `conditions` varchar(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `admin`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `timeout` int(5) NOT NULL,
  `brandname` varchar(35) NOT NULL,
  `brandpagetitle` varchar(35) NOT NULL,
  `brandheaderimage` varchar(100) NOT NULL,
  `brandfavicon` varchar(100) NOT NULL,
  `fromemail` varchar(200) NOT NULL,
  `toemail` varchar(200) NOT NULL,
  `emailenabled` int(1) NOT NULL DEFAULT '0',
  `tofirstname` varchar(100) NOT NULL,
  `tolastname` varchar(100) NOT NULL,
  `emailtime` int(2) NOT NULL,
  `weatherapi` varchar(40) NOT NULL,
  `weatherlong` decimal(10,6) NOT NULL,
  `weatherlat` decimal(10,6) NOT NULL,
  `tosms` varchar(20) NOT NULL,
  `smsenabled` int(1) NOT NULL,
  `tosmsfirstname` varchar(100) NOT NULL,
  `tosmslastname` varchar(100) NOT NULL,
  `phppass` varchar(24) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `timeout`, `brandname`, `brandpagetitle`, `brandheaderimage`, `brandfavicon`, `fromemail`, `emailenabled`, `emailtime`, `weatherlong`, `weatherlat`, `smsenabled`, `phppass`) VALUES
(1, 20, 'Smart Environment Monitoring', 'S.E.M.', 'img/header_logo.png', 'semfavicon.ico', 'noreply@sem.conorwalsh.net', 0, 7, '-122.423132', '37.826711', 0, 'semcw2015');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
