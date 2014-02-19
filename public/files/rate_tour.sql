-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2014 at 02:09 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tourist_attraction`
--

-- --------------------------------------------------------

--
-- Table structure for table `rate_tour`
--

CREATE TABLE IF NOT EXISTS `rate_tour` (
  `Tour_attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `number_votes` int(11) NOT NULL,
  `total_point` int(11) NOT NULL,
  `deg_avg` double NOT NULL,
  `whole_avg` int(11) NOT NULL,
  PRIMARY KEY (`Tour_attr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rate_tour`
--

INSERT INTO `rate_tour` (`Tour_attr_id`, `number_votes`, `total_point`, `deg_avg`, `whole_avg`) VALUES
(1, 1, 5, 5, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
