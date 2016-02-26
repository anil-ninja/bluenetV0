-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2016 at 02:24 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bluenet_v0`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `area`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `type` enum('worker','employee','request') NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_id` int(15) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `details` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `location` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `clients`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `feedback_id` int(15) NOT NULL,
  `type` enum('client','worker') NOT NULL,
  `request_id` int(15) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operator_id` int(11) NOT NULL,
  `next_date` date NOT NULL,
  `status` enum('open','done') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `match_id` int(15) NOT NULL,
  `meeting_time` datetime NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cem_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `meetings`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sr_id` int(11) NOT NULL,
  `note` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cem_id` int(11) NOT NULL,
  `about` enum('worker','client_request','employee','match','meeting') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `img_url` varchar(70) NOT NULL,
  `plans` varchar(800) NOT NULL,
  `status` int(2) NOT NULL,
  `creation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `services`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE IF NOT EXISTS `service_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `mobile` varchar(35) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `requirements` varchar(100) DEFAULT NULL,
  `gender` enum('male','female','any') NOT NULL,
  `timings` varchar(40) NOT NULL,
  `min_salary` varchar(40) NOT NULL,
  `max_salary` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `needed_from` date NOT NULL,
  `area` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `worker_area` varchar(200) NOT NULL,
  `work_time` int(3) NOT NULL,
  `created_time` date NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `me_id` int(11) NOT NULL DEFAULT '0',
  `cem_id` int(11) NOT NULL DEFAULT '0',
  `status` enum('open','me_open','meeting','demo','done','decay','followback','salary_issue','not_interested','delete','feedback','just_to_know') NOT NULL DEFAULT 'open',
  `match_id` int(11) NOT NULL DEFAULT '0',
  `match2_id` int(11) NOT NULL DEFAULT '0',
  `last_updated` timestamp NULL DEFAULT NULL,
  `done_worker_id` int(11) NOT NULL DEFAULT '0',
  `fixed_salary` varchar(10) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `priority` int(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `service_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('open','deleted') NOT NULL DEFAULT 'open',
  `type` enum('worker','client') NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`skill_id`,`type`,`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `skills`
--

-- --------------------------------------------------------

--
-- Table structure for table `skill_name`
--

CREATE TABLE IF NOT EXISTS `skill_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `skill_name`
--

-- --------------------------------------------------------

--
-- Table structure for table `sr_area`
--

CREATE TABLE IF NOT EXISTS `sr_area` (
  `id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`,`sr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sr_area`
--

-- --------------------------------------------------------

--
-- Table structure for table `teastamonials`
--

CREATE TABLE IF NOT EXISTS `teastamonials` (
  `name` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `testamonial` varchar(700) NOT NULL,
  `image` varchar(35) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `teastamonials`
--

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE IF NOT EXISTS `updates` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request_id` int(15) NOT NULL,
  `old_status` varchar(20) NOT NULL,
  `new_status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `updates`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_type` enum('operator','me','cem','admin','accountant','ba','dev','cem_manager') DEFAULT NULL,
  `team_head` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE IF NOT EXISTS `workers` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `phone` varchar(35) NOT NULL,
  `gender` enum('male','female','other') NOT NULL DEFAULT 'female',
  `area` varchar(100) NOT NULL,
  `birth_date` date NOT NULL,
  `age` varchar(12) NOT NULL,
  `education` varchar(15) NOT NULL,
  `languages` varchar(50) NOT NULL,
  `min_salary` varchar(35) NOT NULL,
  `max_salary` varchar(35) NOT NULL,
  `current_address` varchar(40) NOT NULL,
  `permanent_address` varchar(40) NOT NULL,
  `timings` varchar(25) NOT NULL,
  `work_time` int(3) NOT NULL,
  `varification_status` enum('yes','no') NOT NULL,
  `emergency_phone` varchar(15) NOT NULL,
  `address_proof_name` varchar(25) NOT NULL,
  `address_proof_id` varchar(35) NOT NULL,
  `id_proof_name` varchar(25) NOT NULL,
  `id_proof_id` varchar(35) NOT NULL,
  `experience` varchar(15) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service` varchar(35) NOT NULL,
  `status` enum('available','working','decayed','deleted','placed','part_time','followback') NOT NULL,
  `me_id` int(11) NOT NULL,
  `last_updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `first_name` (`first_name`,`phone`,`age`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Dumping data for table `workers`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
