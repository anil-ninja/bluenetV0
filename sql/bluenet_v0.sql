-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2016 at 06:34 AM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bluenethack_v0`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(3, 'any place'),
(4, 'badshahpur'),
(5, 'chakkarpur'),
(6, 'faridabad'),
(7, 'ghata'),
(8, 'gurgaon'),
(9, 'harizen colony'),
(10, 'islampur'),
(11, 'jharsa'),
(12, 'kanhai'),
(13, 'nathupur'),
(14, 'new delhi'),
(1, 'saraswati Kunj 1'),
(15, 'sikenderpur'),
(16, 'sushant lok'),
(17, 'tigra'),
(2, 'wazirabad');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

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
-- Table structure for table `service_request`
--

CREATE TABLE IF NOT EXISTS `service_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `mobile` varchar(35) DEFAULT NULL,
  `requirements` varchar(100) DEFAULT NULL,
  `gender` enum('male','female','any') NOT NULL,
  `timings` varchar(40) NOT NULL,
  `expected_salary` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `area` varchar(30) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `worker_area` varchar(100) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `skill_name`
--

CREATE TABLE IF NOT EXISTS `skill_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `skill_name`
--

INSERT INTO `skill_name` (`id`, `name`) VALUES
(19, 'Bengali'),
(5, 'Brooming'),
(15, 'Chinese'),
(13, 'Cleaning kitchen'),
(4, 'Cloth cleaning'),
(16, 'Continental'),
(12, 'Cooking'),
(2, 'Dusting'),
(3, 'Glass cleaning'),
(8, 'Ironing'),
(26, 'Italian'),
(25, 'Non-veg'),
(10, 'Old age care'),
(11, 'Patient care'),
(9, 'Pet care'),
(17, 'Punjabi'),
(23, 'Pure veg'),
(18, 'Rajasthani'),
(20, 'Snacks'),
(21, 'Soups'),
(14, 'South Indian'),
(22, 'Special Salad'),
(24, 'Sweet dishes'),
(1, 'Toilet cleaning'),
(7, 'Utensils cleaning'),
(6, 'Wiping');

-- --------------------------------------------------------

--
-- Table structure for table `sr_area`
--

CREATE TABLE IF NOT EXISTS `sr_area` (
  `id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`,`sr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `teastamonials`
--

INSERT INTO `teastamonials` (`name`, `email`, `testamonial`, `image`, `date`, `id`) VALUES
('Rajnish', 'rajnish@blueteam.in', 'BlueTeam provides reliability for services: Cook/Maid/Driver/Electrician/Plumber/Carpenter.\r\nBlueTeam have on-demand/part-time/8 hr/10 hr/12 hr services.', 'Rajnish.jpg', '2016-01-06 04:38:23', 1),
('Meera Dubby', 'meera.dubby4478@gmail.com', 'BlueTeam provided me maid at the time. I needed her most. I just called them and told my requirments and next the they brought one for interviewing. Most awesome thing is they provide FREE OF COST REPLACEMENT on more then 3 holiday in month. Thank You BlueTeam', 'Meera Dubby.jpg', '2016-01-06 04:51:33', 2);

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
  `employee_type` enum('operator','me','cem','admin','accountant','ba','dev') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `reg_date`, `employee_type`) VALUES
(1, 'anil', 'kumar', 'anil@blueteam.in', '9541254636', 'e2798af12a7a0f4f70b4d69efbc25f4d', '2016-01-13 09:14:51', 'operator'),
(2, 'Ashish', 'Haritash', 'ashishharitash33@gmail.com', '9891464719', '77428787dba9797b96448b6d0c6d71b0', '2016-01-13 09:30:13', 'me'),
(3, 'rahul', 'lahoria', 'rahul@blueteam.in', '9599075955', 'e2798af12a7a0f4f70b4d69efbc25f4d', '2016-01-13 09:30:24', 'me'),
(4, 'raj', 'gaurav', 'singhrajgaurav20@gmail.com', '8882864025', '7e802df2366c431563d1d0ff1b70fcc8', '2016-01-13 09:37:05', 'cem'),
(5, 'rahul', 'tiwari', 'rahultwr635@gmail.com', '9716403308', 'a27308a81afc1cac5fd084e8e0c1229d', '2016-01-13 09:44:48', 'me'),
(6, 'Rajnish', 'Kumar', 'rajnish@blueteam.in', '8901414422', 'e2798af12a7a0f4f70b4d69efbc25f4d', '2016-01-13 10:37:38', 'cem'),
(7, 'mallika', 'pal', 'mallikapal786@gmail.com', '9891610960', '4771ce5075ecbb315f07ebe5f66479b3', '2016-01-13 13:06:23', 'operator'),
(8, 'vikas', 'nagar', 'vikas@blueteam.in', '9560625626', 'bebe68374a49cb41b7c9219e97250044', '2016-01-14 07:31:01', 'me'),
(9, 'Dilip', 'Kumar', 'Mr.dilipkumar.kc@gmail.com', '9686567985', 'b70bb76b96ecd81603894aa94b7a4729', '2016-01-15 15:38:32', 'dev'),
(10, 'Vikas', 'Kumar', 'vik2321@yahoo.com', '9911771748', 'bebe68374a49cb41b7c9219e97250044', '2016-01-16 14:04:01', 'cem'),
(11, 'firoj', 'khan', 'firoj@blueteam.in', '8527415728', 'cea4ef4715c2f6fbb54a81917fc2aef7', '2016-01-16 14:29:50', 'operator'),
(12, 'Deepak', 'Singh', 'deepak@blueteam.in', '8800683242', 'ef9ed1c9b0fc3fb132e69fe35c1475e2', '2016-01-18 06:19:36', 'dev');

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
  `birth_date` date NOT NULL,
  `age` varchar(12) NOT NULL,
  `education` varchar(15) NOT NULL,
  `languages` varchar(50) NOT NULL,
  `expected_salary` varchar(35) NOT NULL,
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
