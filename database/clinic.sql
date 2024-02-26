-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2024 at 06:11 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned`
--

CREATE TABLE IF NOT EXISTS `assigned` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `text` text,
  `treated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `assigned`
--


-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `diagnosis` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=657 ;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `p_id`, `diagnosis`) VALUES
(655, 15, 'jslkdfakjofislkjklzs'),
(654, 14, 'poiuytfds'),
(653, 23, 'erty'),
(652, 13, 'dgfvnbfgtrfgvb'),
(651, 22, 'i diadfdagq4wdafs'),
(649, 11, 'dcscs'),
(650, 21, 'diadgonnl'),
(26, 10, 'tyu'),
(29, 8, 'aklgnfjnkdlsdghbvmhrgcmvmhtrtevvhrteghvmmhgchgrghmvbhtrhgchvbhgrgvgfxggngrngrnng'),
(27, 10, 'tyu'),
(28, 10, 'fth'),
(23, 11, 'overwight'),
(656, 24, 'gjhghkgh');

-- --------------------------------------------------------

--
-- Table structure for table `lab_test`
--

CREATE TABLE IF NOT EXISTS `lab_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `lab_test`
--


-- --------------------------------------------------------

--
-- Table structure for table `lab_test_store`
--

CREATE TABLE IF NOT EXISTS `lab_test_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lab_test_store`
--

INSERT INTO `lab_test_store` (`id`, `p_id`, `instruction`, `result`) VALUES
(1, 8, 'test for ebola', 'negative'),
(2, 10, 'test for typhoid', 'positive'),
(3, 12, 'test for hjpol', 'akjfdhgn'),
(4, 12, 'test for hiv', 'positive'),
(5, 13, 'test for efefesfesfs', 'dsfafda'),
(6, 13, 'tjsfsjdkl', 'dfgh');

-- --------------------------------------------------------

--
-- Table structure for table `lab_test_view`
--

CREATE TABLE IF NOT EXISTS `lab_test_view` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lab_test_view`
--


-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `patients`
--


-- --------------------------------------------------------

--
-- Table structure for table `payed_lab_test`
--

CREATE TABLE IF NOT EXISTS `payed_lab_test` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payed_lab_test`
--


-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `name`, `sex`, `email`, `phone_number`, `status`, `p_id`) VALUES
(55, 'feleke', 'male', 'fele@gmaail.com', '098765', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `reg_patients`
--

CREATE TABLE IF NOT EXISTS `reg_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `reg_patients`
--

INSERT INTO `reg_patients` (`id`, `name`, `sex`, `email`, `phone_number`) VALUES
(13, 'feleke', 'male', 'fele@gmaail.com', '098765'),
(12, 'johon', 'male', 'be@gmail.com', '09876'),
(10, 'abel', 'male', 'abel@gmail.com', '093456'),
(11, 'amanuel', 'male', 'aman@gmail.com', '096543'),
(8, 'tom', 'male', 'be@gmail.com', '0999'),
(9, 'alemayehu', 'male', 'alem@gmail.com', '1234'),
(6, 'hiewot', 'female', 'heiwot@gmail.com', '091123433'),
(7, 'hosana', 'male', 'hos@gmail.com', '099876'),
(1, 'patient0', 'male', 'be@gmail.com', '0999'),
(2, 'abeba', 'female', 'abeba@gmail.com', 'uh'),
(3, 'hello', 'male', 'hello@gmail.com', '0911'),
(4, 'test', 'male', 'test@gmail.com', '00'),
(5, 'testonlab', 'male', 'be@gmail.com', '234'),
(14, 'yohannes', 'male', 'jo@gmail.com', '09876r'),
(15, 'nahom', 'male', 'doc@gmail.com', '0976544');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `account_type` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `account_type`, `status`) VALUES
(26, 'labt', 'labt', 'labt@gmail.com', 'lab_technician', 'active'),
(25, 'nina', 'nina', 'nina@gmail.com', 'nurse', 'active'),
(24, 'kebede', 'kebe', 'kebe@gmail.com', 'doctor', 'active'),
(22, 'doc', 'doc', 'be@gmail.com', 'doctor', 'active'),
(23, 'abebe', 'kljfds', 'dflkj@gmail.com', 'doctor', 'active'),
(21, 'fa', 'fa', 'doc@gmail.com', 'admin', 'active'),
(27, 'cash', 'cash', 'cash@gmail.com', 'cashier', 'active'),
(28, 'pam', 'pam', 'pam@gmail.com', 'receptionist', 'active');
