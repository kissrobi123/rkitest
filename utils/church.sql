-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2014 at 11:44 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `church`
--

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `active`) VALUES
(1, 'Romana', 1),
(2, 'English', 1),
(3, 'Magyar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lang_keys`
--

CREATE TABLE IF NOT EXISTS `lang_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` int(11) NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lang_keys`
--

INSERT INTO `lang_keys` (`id`, `language`, `key`, `value`) VALUES
(1, 1, 'Nume:', 'Num');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `position`, `parent`, `state`) VALUES
(2, 'Contact', 2, -1, 1),
(1, 'Produse', 1, -1, 1),
(3, 'Despre noi', 3, -1, 1),
(4, 'Scaune', 1, 1, 1),
(5, 'Mese', 2, 1, 1),
(6, 'Mobilier', 3, 1, 1),
(7, 'Pliabil', 1, 4, 1),
(8, 'Old--Fix', 2, 4, 0),
(9, 'Fix', 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_values`
--

CREATE TABLE IF NOT EXISTS `menu_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `menu_values`
--

INSERT INTO `menu_values` (`id`, `menu`, `language`, `value`) VALUES
(2, 11, 1, 'vfdvfd');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `value` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `menu`, `language`, `title`, `keywords`, `value`) VALUES
(1, 2, 1, 'vdfvfd', 'vfdvfd', 0x3c703e7666646d7666646d6c20766d66646b6c6d766c6b66643c2f703e);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `length` varchar(50) DEFAULT NULL,
  `width` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `shortDescr` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `menu`, `name`, `length`, `width`, `height`, `shortDescr`) VALUES
(1, 7, 'Scaun fag', '13', '21', '21', ''),
(2, 7, 'Scaun fag 2', '0', '0', '0', ''),
(3, 9, 'Scaun fix 1', '10', '10', '10', 'vnfdjvndfk vndfjkvd nvjfdk'),
(4, 9, 'Scaun fix 2', '0', '0', '0', ''),
(5, 9, 'Scaun fix 3', '0', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_langs`
--

CREATE TABLE IF NOT EXISTS `product_langs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `language` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `shortDescr` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product_langs`
--

INSERT INTO `product_langs` (`id`, `product`, `language`, `name`, `shortDescr`) VALUES
(1, 1, 1, 'vfdvfd123', 'vdfvfd321 vndfkj njdfvnjkd nvdfjnvjd vnfkfd nvfdjknvkfd nvjdfknkjvfd nvjfdknvkd nvjdnvkjdf nvdfjknvd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
