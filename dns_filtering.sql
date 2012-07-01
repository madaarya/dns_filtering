-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2012 at 12:15 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dns_filtering`
--

-- --------------------------------------------------------

--
-- Table structure for table `CONTACT`
--

CREATE TABLE IF NOT EXISTS `CONTACT` (
  `pk_contact` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `message` text NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url_server` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`pk_contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `CONTACT`
--


-- --------------------------------------------------------

--
-- Table structure for table `DATALOG`
--

CREATE TABLE IF NOT EXISTS `DATALOG` (
  `pk_datalog` int(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `nama_komputer` varchar(100) NOT NULL,
  `browser` varchar(200) NOT NULL,
  `url_server` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL,
  PRIMARY KEY (`pk_datalog`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `DATALOG`
--


-- --------------------------------------------------------

--
-- Table structure for table `REASONS_BLOCKED`
--

CREATE TABLE IF NOT EXISTS `REASONS_BLOCKED` (
  `pk_reasons` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`pk_reasons`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `REASONS_BLOCKED`
--


-- --------------------------------------------------------

--
-- Table structure for table `URL_BLOKED`
--

CREATE TABLE IF NOT EXISTS `URL_BLOKED` (
  `pk_url` int(20) NOT NULL AUTO_INCREMENT,
  `url_name` varchar(100) NOT NULL,
  `fk_reasons` int(11) NOT NULL,
  PRIMARY KEY (`pk_url`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `URL_BLOKED`
--


-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `userid` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`userid`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'administrator', 'admin');
