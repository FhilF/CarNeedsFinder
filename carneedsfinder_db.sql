-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 04:30 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carneedsfinder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `number` varchar(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `activation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `firstname`, `lastname`, `email`, `password`, `address`, `birthday`, `number`, `image`, `activation`) VALUES
(1, 'Main', 'CNF', 'cnf@yahoo.com', '12345', 'cnf', '2018-09-01', '0123456789', 'admin.png', 'Main'),
(2, 'Fhilip', 'Fernandez', 'fhilipfernandez@yahoo.com', '12345', 'Cabanatuan City', '1999-07-09', '09568850144', '20180708020211Q3sK53RF.jpeg', 'Main'),
(3, 'Fhilip', 'Fernandez', 'fhilipfernandez12@yahoo.com', '12345', '32 Abigail St. Kapitan Pepe Cabanatuan City', '1999-07-09', '09568850144', '20180708020211Q3sK53RF.jpeg', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `adminreview`
--

CREATE TABLE `adminreview` (
  `idadminreview` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `admin_idadmin` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `state` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminreview`
--

INSERT INTO `adminreview` (`idadminreview`, `comment`, `shop_idshop`, `admin_idadmin`, `date`, `time`, `state`) VALUES
(133, 'Application Submitted', 26, 1, '2018-12-06', '22:30:08', 1),
(134, 'Your Shop is being reviewed by the Admin, Thank You!', 26, 3, '2018-12-06', '22:33:42', 1),
(135, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 26, 3, '2018-12-06', '22:35:31', 1),
(136, 'Application Submitted', 33, 1, '2018-12-07', '14:23:43', 1),
(137, 'Your Shop is being reviewed by the Admin, Thank You!', 33, 3, '2018-12-07', '14:25:17', 1),
(138, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 33, 3, '2018-12-07', '14:25:24', 1),
(139, 'Application Submitted', 34, 1, '2018-12-07', '14:41:34', 0),
(140, 'Your Shop is being reviewed by the Admin, Thank You!', 34, 3, '2018-12-07', '14:41:50', 0),
(141, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 34, 3, '2018-12-07', '14:41:56', 0),
(142, 'Application Submitted', 35, 1, '2018-12-07', '14:57:56', 0),
(143, 'Your Shop is being reviewed by the Admin, Thank You!', 35, 3, '2018-12-07', '14:58:22', 0),
(144, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 35, 3, '2018-12-07', '14:58:29', 0),
(145, 'Application Submitted', 36, 1, '2018-12-07', '15:30:15', 0),
(146, 'Your Shop is being reviewed by the Admin, Thank You!', 36, 3, '2018-12-07', '15:30:34', 0),
(147, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 36, 3, '2018-12-07', '15:30:41', 0),
(148, 'Application Submitted', 37, 1, '2018-12-07', '16:01:56', 0),
(149, 'Your Shop is being reviewed by the Admin, Thank You!', 37, 3, '2018-12-07', '16:02:14', 0),
(150, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 37, 3, '2018-12-07', '16:02:23', 0),
(151, 'Application Submitted', 38, 1, '2018-12-07', '16:16:36', 0),
(152, 'Your Shop is being reviewed by the Admin, Thank You!', 38, 3, '2018-12-07', '16:16:47', 0),
(153, 'Your Shop is being reviewed by the Admin, Thank You!', 38, 3, '2018-12-07', '16:16:48', 0),
(154, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 38, 3, '2018-12-07', '16:16:54', 0),
(155, 'Application Submitted', 39, 1, '2018-12-07', '21:41:18', 0),
(156, 'Your Shop is being reviewed by the Admin, Thank You!', 39, 3, '2018-12-07', '21:41:42', 0),
(157, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 39, 3, '2018-12-07', '21:41:48', 0),
(158, 'Application Submitted', 40, 1, '2018-12-07', '22:08:36', 0),
(159, 'Your Shop is being reviewed by the Admin, Thank You!', 40, 3, '2018-12-07', '22:12:25', 0),
(160, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 40, 3, '2018-12-07', '22:12:32', 0),
(161, 'Application Submitted', 41, 1, '2018-12-08', '00:20:46', 0),
(162, 'Your Shop is being reviewed by the Admin, Thank You!', 41, 3, '2018-12-08', '00:21:03', 0),
(163, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 41, 3, '2018-12-08', '00:21:09', 0),
(164, 'Application Submitted', 42, 1, '2018-12-08', '14:46:12', 0),
(165, 'Your Shop is being reviewed by the Admin, Thank You!', 42, 3, '2018-12-08', '14:46:28', 0),
(166, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 42, 3, '2018-12-08', '14:46:34', 0),
(167, 'Application Submitted', 43, 1, '2018-12-08', '15:00:14', 0),
(168, 'Your Shop is being reviewed by the Admin, Thank You!', 43, 3, '2018-12-08', '15:00:30', 0),
(169, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 43, 3, '2018-12-08', '15:00:39', 0),
(170, 'Application Submitted', 44, 1, '2018-12-08', '15:28:10', 0),
(171, 'Your Shop is being reviewed by the Admin, Thank You!', 44, 3, '2018-12-08', '15:28:20', 0),
(172, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 44, 3, '2018-12-08', '15:28:26', 0),
(173, 'Application Submitted', 45, 1, '2018-12-08', '15:49:08', 0),
(174, 'Your Shop is being reviewed by the Admin, Thank You!', 45, 3, '2018-12-08', '15:49:20', 0),
(175, 'Your Shop is being reviewed by the Admin, Thank You!', 45, 3, '2018-12-08', '15:49:21', 0),
(176, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 45, 3, '2018-12-08', '15:49:26', 0),
(177, 'Application Submitted', 46, 1, '2018-12-09', '14:58:21', 0),
(178, 'Your Shop is being reviewed by the Admin, Thank You!', 46, 3, '2018-12-09', '14:58:36', 0),
(179, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 46, 3, '2018-12-09', '14:58:45', 0),
(180, 'Application Submitted', 47, 1, '2018-12-09', '15:26:41', 0),
(181, 'Your Shop is being reviewed by the Admin, Thank You!', 47, 3, '2018-12-09', '15:27:18', 0),
(182, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 47, 3, '2018-12-09', '15:27:24', 0),
(183, 'Application Submitted', 48, 1, '2018-12-09', '15:37:41', 0),
(184, 'Your Shop is being reviewed by the Admin, Thank You!', 48, 3, '2018-12-09', '15:37:56', 0),
(185, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 48, 3, '2018-12-09', '15:38:01', 0),
(186, 'Application Submitted', 49, 1, '2018-12-09', '15:54:10', 0),
(187, 'Your Shop is being reviewed by the Admin, Thank You!', 49, 3, '2018-12-09', '15:54:23', 0),
(188, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 49, 3, '2018-12-09', '15:54:27', 0),
(189, 'Application Submitted', 50, 1, '2018-12-09', '16:30:21', 0),
(190, 'Your Shop is being reviewed by the Admin, Thank You!', 50, 3, '2018-12-09', '16:30:32', 0),
(191, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 50, 3, '2018-12-09', '16:30:37', 0),
(192, 'Application Submitted', 51, 1, '2018-12-09', '16:44:28', 0),
(193, 'Your Shop is being reviewed by the Admin, Thank You!', 51, 3, '2018-12-09', '16:45:46', 0),
(194, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 51, 3, '2018-12-09', '16:45:52', 0),
(195, 'Application Submitted', 52, 1, '2018-12-11', '15:27:32', 1),
(196, 'Application Submitted', 53, 1, '2018-12-11', '15:27:33', 1),
(197, 'Your Shop is being reviewed by the Admin, Thank You!', 52, 3, '2018-12-11', '15:28:35', 1),
(198, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 52, 3, '2018-12-11', '15:28:49', 1),
(199, 'Application Submitted', 54, 1, '2018-12-11', '15:33:59', 1),
(200, 'Your Shop is being reviewed by the Admin, Thank You!', 54, 3, '2018-12-11', '15:34:11', 1),
(201, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 54, 3, '2018-12-11', '15:34:18', 1),
(202, 'Application Submitted', 55, 1, '2018-12-11', '15:48:16', 0),
(203, 'Your Shop is being reviewed by the Admin, Thank You!', 55, 3, '2018-12-11', '15:48:26', 0),
(204, 'Your Shop is being reviewed by the Admin, Thank You!', 53, 3, '2018-12-11', '15:48:34', 0),
(205, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 55, 3, '2018-12-11', '15:49:03', 0),
(206, 'Application Submitted', 56, 1, '2018-12-11', '15:55:10', 0),
(207, 'Your Shop is being reviewed by the Admin, Thank You!', 56, 3, '2018-12-11', '15:56:27', 0),
(208, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 56, 3, '2018-12-11', '15:56:35', 0),
(209, 'Application Submitted', 57, 1, '2018-12-11', '16:04:24', 0),
(210, 'Your Shop is being reviewed by the Admin, Thank You!', 57, 3, '2018-12-11', '16:05:03', 0),
(211, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 57, 3, '2018-12-11', '16:05:48', 0),
(212, 'Application Submitted', 58, 1, '2018-12-11', '16:18:47', 0),
(213, 'Your Shop is being reviewed by the Admin, Thank You!', 58, 3, '2018-12-11', '16:19:06', 0),
(214, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 58, 3, '2018-12-11', '16:19:16', 0),
(215, 'Application Submitted', 59, 1, '2018-12-11', '16:27:29', 0),
(216, 'Your Shop is being reviewed by the Admin, Thank You!', 59, 3, '2018-12-11', '16:27:42', 0),
(217, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 59, 3, '2018-12-11', '16:28:02', 0),
(218, 'Application Submitted', 60, 1, '2018-12-11', '16:35:28', 0),
(219, 'Your Shop is being reviewed by the Admin, Thank You!', 60, 3, '2018-12-11', '16:35:55', 0),
(220, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 60, 3, '2018-12-11', '16:36:03', 0),
(221, 'Application Submitted', 61, 1, '2018-12-11', '16:47:15', 0),
(222, 'Your Shop is being reviewed by the Admin, Thank You!', 61, 3, '2018-12-11', '16:47:51', 0),
(223, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 61, 3, '2018-12-11', '16:48:01', 0),
(224, 'Application Submitted', 62, 1, '2018-12-11', '16:57:52', 0),
(225, 'Your Shop is being reviewed by the Admin, Thank You!', 62, 3, '2018-12-11', '16:58:03', 0),
(226, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 62, 3, '2018-12-11', '16:58:12', 0),
(227, 'Application Submitted', 63, 1, '2018-12-11', '22:00:44', 0),
(228, 'Your Shop is being reviewed by the Admin, Thank You!', 63, 3, '2018-12-11', '22:01:27', 0),
(229, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 63, 3, '2018-12-11', '22:01:34', 0),
(230, 'Application Submitted', 64, 1, '2018-12-11', '22:07:04', 0),
(231, 'Your Shop is being reviewed by the Admin, Thank You!', 64, 3, '2018-12-11', '22:07:18', 0),
(232, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 64, 3, '2018-12-11', '22:07:24', 0),
(233, 'Application Submitted', 65, 1, '2018-12-11', '22:28:36', 0),
(234, 'Your Shop is being reviewed by the Admin, Thank You!', 65, 3, '2018-12-11', '22:28:48', 0),
(235, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 65, 3, '2018-12-11', '22:28:56', 0),
(236, 'Application Submitted', 66, 1, '2018-12-12', '14:13:12', 0),
(237, 'Your Shop is being reviewed by the Admin, Thank You!', 66, 3, '2018-12-12', '14:14:23', 0),
(238, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 66, 3, '2018-12-12', '14:14:30', 0),
(239, 'Application Submitted', 67, 1, '2018-12-12', '14:25:16', 0),
(240, 'Your Shop is being reviewed by the Admin, Thank You!', 67, 3, '2018-12-12', '14:25:33', 0),
(241, 'Your Shop is now activated. You may now add your products and services to your shop, Thank You!', 67, 3, '2018-12-12', '14:25:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `idmessage` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `admin_idadmin` int(11) NOT NULL,
  `messagestate` tinyint(1) NOT NULL,
  `datetimesent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operatinghours`
--

CREATE TABLE `operatinghours` (
  `idoperatinghours` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `opening` time NOT NULL,
  `closing` time NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operatinghours`
--

INSERT INTO `operatinghours` (`idoperatinghours`, `day`, `opening`, `closing`, `shop_idshop`) VALUES
(35, 'Monday', '09:00:00', '17:00:00', 26),
(36, 'Tuesday', '09:00:00', '17:00:00', 26),
(37, 'Wednesday', '09:00:00', '17:00:00', 26),
(38, 'Thursday', '09:00:00', '17:00:00', 26),
(39, 'Friday', '09:00:00', '17:00:00', 26),
(40, 'Saturday', '09:00:00', '17:00:00', 26),
(41, 'Sunday', '09:00:00', '17:00:00', 26),
(42, 'Monday', '07:00:00', '20:00:00', 33),
(43, 'Tuesday', '07:00:00', '20:00:00', 33),
(44, 'Wednesday', '07:00:00', '20:00:00', 33),
(45, 'Thursday', '07:00:00', '20:00:00', 33),
(46, 'Friday', '07:00:00', '20:00:00', 33),
(47, 'Saturday', '07:00:00', '20:00:00', 33),
(48, 'Sunday', '07:00:00', '20:00:00', 33),
(49, 'Monday', '06:00:00', '18:00:00', 34),
(50, 'Tuesday', '06:00:00', '18:00:00', 34),
(51, 'Wednesday', '06:00:00', '18:00:00', 34),
(52, 'Thursday', '06:00:00', '18:00:00', 34),
(53, 'Friday', '06:00:00', '18:00:00', 34),
(54, 'Saturday', '06:00:00', '18:00:00', 34),
(55, 'Sunday', '06:00:00', '18:00:00', 34),
(56, 'Monday', '08:00:00', '17:00:00', 35),
(57, 'Tuesday', '08:00:00', '17:00:00', 35),
(58, 'Wednesday', '08:00:00', '17:00:00', 35),
(59, 'Thursday', '08:00:00', '17:00:00', 35),
(60, 'Friday', '08:00:00', '17:00:00', 35),
(61, 'Saturday', '08:00:00', '17:00:00', 35),
(62, 'Sunday', '08:00:00', '17:00:00', 35),
(63, 'Monday', '08:00:00', '18:00:00', 36),
(64, 'Tuesday', '08:00:00', '18:00:00', 36),
(65, 'Wednesday', '08:00:00', '18:00:00', 36),
(66, 'Thursday', '08:00:00', '18:00:00', 36),
(67, 'Friday', '08:00:00', '18:00:00', 36),
(68, 'Saturday', '08:00:00', '18:00:00', 36),
(69, 'Sunday', '08:00:00', '18:00:00', 36),
(70, 'Monday', '07:00:00', '19:00:00', 37),
(71, 'Tuesday', '07:00:00', '19:00:00', 37),
(72, 'Wednesday', '07:00:00', '19:00:00', 37),
(73, 'Thursday', '07:00:00', '19:00:00', 37),
(74, 'Friday', '07:00:00', '19:00:00', 37),
(75, 'Saturday', '07:00:00', '19:00:00', 37),
(76, 'Sunday', '07:00:00', '19:00:00', 37),
(77, 'Monday', '07:30:00', '17:00:00', 38),
(78, 'Tuesday', '07:30:00', '17:00:00', 38),
(79, 'Wednesday', '07:30:00', '17:00:00', 38),
(80, 'Thursday', '07:30:00', '17:00:00', 38),
(81, 'Friday', '07:30:00', '17:00:00', 38),
(82, 'Saturday', '07:30:00', '17:00:00', 38),
(83, 'Sunday', '07:30:00', '17:00:00', 38),
(84, 'Monday', '08:00:00', '17:00:00', 40),
(85, 'Tuesday', '08:00:00', '17:00:00', 40),
(86, 'Wednesday', '08:00:00', '17:00:00', 40),
(87, 'Thursday', '08:00:00', '17:00:00', 40),
(88, 'Friday', '08:00:00', '17:00:00', 40),
(89, 'Saturday', '08:00:00', '17:00:00', 40),
(90, 'Sunday', '08:00:00', '17:00:00', 40),
(91, 'Monday', '08:30:00', '17:00:00', 39),
(92, 'Tuesday', '08:30:00', '17:00:00', 39),
(93, 'Wednesday', '08:30:00', '17:00:00', 39),
(94, 'Thursday', '08:30:00', '17:00:00', 39),
(95, 'Friday', '08:30:00', '17:00:00', 39),
(96, 'Saturday', '08:30:00', '17:00:00', 39),
(97, 'Sunday', '08:30:00', '17:00:00', 39),
(98, 'Monday', '07:30:00', '17:00:00', 42),
(99, 'Tuesday', '07:30:00', '17:00:00', 42),
(100, 'Wednesday', '07:30:00', '17:00:00', 42),
(101, 'Thursday', '07:30:00', '17:00:00', 42),
(102, 'Friday', '07:30:00', '17:00:00', 42),
(103, 'Saturday', '07:30:00', '17:00:00', 42),
(104, 'Sunday', '07:30:00', '17:00:00', 42),
(105, 'Monday', '09:00:00', '18:00:00', 43),
(106, 'Tuesday', '09:00:00', '18:00:00', 43),
(107, 'Wednesday', '09:00:00', '18:00:00', 43),
(108, 'Thursday', '09:00:00', '18:00:00', 43),
(109, 'Friday', '09:00:00', '18:00:00', 43),
(110, 'Saturday', '09:00:00', '18:00:00', 43),
(112, 'Monday', '08:00:00', '17:00:00', 44),
(113, 'Tuesday', '08:00:00', '17:00:00', 44),
(114, 'Wednesday', '08:00:00', '17:00:00', 44),
(115, 'Thursday', '08:00:00', '17:00:00', 44),
(116, 'Friday', '08:00:00', '17:00:00', 44),
(117, 'Saturday', '08:00:00', '17:00:00', 44),
(118, 'Sunday', '08:00:00', '17:00:00', 44),
(119, 'Monday', '08:00:00', '17:00:00', 45),
(120, 'Tuesday', '08:00:00', '17:00:00', 45),
(121, 'Wednesday', '08:00:00', '17:00:00', 45),
(122, 'Thursday', '08:00:00', '17:00:00', 45),
(123, 'Friday', '08:00:00', '17:00:00', 45),
(124, 'Saturday', '08:00:00', '17:00:00', 45),
(125, 'Sunday', '08:00:00', '17:00:00', 45),
(126, 'Monday', '08:00:00', '17:00:00', 46),
(127, 'Tuesday', '08:00:00', '17:00:00', 46),
(128, 'Wednesday', '08:00:00', '17:00:00', 46),
(129, 'Thursday', '08:00:00', '17:00:00', 46),
(130, 'Friday', '08:00:00', '17:00:00', 46),
(131, 'Saturday', '08:00:00', '17:00:00', 46),
(132, 'Sunday', '08:00:00', '17:00:00', 46),
(133, 'Monday', '08:00:00', '17:00:00', 47),
(134, 'Tuesday', '08:00:00', '17:00:00', 47),
(135, 'Wednesday', '08:00:00', '17:00:00', 47),
(136, 'Thursday', '08:00:00', '17:00:00', 47),
(137, 'Friday', '08:00:00', '17:00:00', 47),
(138, 'Saturday', '08:00:00', '17:00:00', 47),
(139, 'Sunday', '08:00:00', '17:00:00', 47),
(140, 'Monday', '08:00:00', '17:00:00', 48),
(141, 'Tuesday', '08:00:00', '17:00:00', 48),
(142, 'Wednesday', '08:00:00', '17:00:00', 48),
(143, 'Thursday', '08:00:00', '17:00:00', 48),
(144, 'Friday', '08:00:00', '17:00:00', 48),
(145, 'Saturday', '08:00:00', '17:00:00', 48),
(146, 'Sunday', '08:00:00', '17:00:00', 48),
(147, 'Monday', '08:00:00', '17:00:00', 49),
(148, 'Tuesday', '08:00:00', '17:00:00', 49),
(149, 'Wednesday', '08:00:00', '17:00:00', 49),
(150, 'Thursday', '08:00:00', '17:00:00', 49),
(151, 'Friday', '08:00:00', '17:00:00', 49),
(152, 'Saturday', '08:00:00', '17:00:00', 49),
(153, 'Sunday', '08:00:00', '17:00:00', 49),
(154, 'Monday', '08:30:00', '18:00:00', 50),
(155, 'Tuesday', '08:30:00', '18:00:00', 50),
(156, 'Wednesday', '08:30:00', '18:00:00', 50),
(157, 'Thursday', '08:30:00', '18:00:00', 50),
(158, 'Friday', '08:30:00', '18:00:00', 50),
(159, 'Saturday', '08:30:00', '18:00:00', 50),
(161, 'Monday', '08:00:00', '17:00:00', 51),
(162, 'Tuesday', '08:00:00', '17:00:00', 51),
(163, 'Wednesday', '08:00:00', '17:00:00', 51),
(164, 'Thursday', '08:00:00', '17:00:00', 51),
(165, 'Friday', '08:00:00', '17:00:00', 51),
(166, 'Saturday', '08:00:00', '17:00:00', 51),
(167, 'Sunday', '08:00:00', '17:00:00', 51),
(168, 'Monday', '00:00:00', '00:00:00', 55),
(169, 'Tuesday', '00:00:00', '00:00:00', 55),
(170, 'Wednesday', '00:00:00', '00:00:00', 55),
(171, 'Thursday', '00:00:00', '00:00:00', 55),
(172, 'Friday', '00:00:00', '00:00:00', 55),
(173, 'Saturday', '00:00:00', '00:00:00', 55),
(174, 'Sunday', '00:00:00', '00:00:00', 55),
(175, 'Monday', '06:00:00', '21:00:00', 56),
(176, 'Tuesday', '06:00:00', '21:00:00', 56),
(177, 'Wednesday', '06:00:00', '21:00:00', 56),
(178, 'Thursday', '06:00:00', '21:00:00', 56),
(179, 'Friday', '06:00:00', '21:00:00', 56),
(180, 'Saturday', '06:00:00', '21:00:00', 56),
(181, 'Sunday', '06:00:00', '21:00:00', 56),
(182, 'Monday', '06:00:00', '21:00:00', 57),
(183, 'Tuesday', '06:00:00', '21:00:00', 57),
(184, 'Wednesday', '06:00:00', '21:00:00', 57),
(185, 'Thursday', '06:00:00', '21:00:00', 57),
(186, 'Friday', '06:00:00', '21:00:00', 57),
(187, 'Saturday', '06:00:00', '21:00:00', 57),
(188, 'Sunday', '06:00:00', '21:00:00', 57),
(189, 'Monday', '06:00:00', '21:00:00', 58),
(190, 'Tuesday', '06:00:00', '21:00:00', 58),
(191, 'Wednesday', '06:00:00', '21:00:00', 58),
(192, 'Thursday', '06:00:00', '21:00:00', 58),
(193, 'Friday', '06:00:00', '21:00:00', 58),
(194, 'Saturday', '06:00:00', '21:00:00', 58),
(195, 'Sunday', '06:00:00', '21:00:00', 58),
(196, 'Monday', '06:00:00', '21:00:00', 59),
(197, 'Tuesday', '06:00:00', '21:00:00', 59),
(198, 'Wednesday', '06:00:00', '21:00:00', 59),
(199, 'Thursday', '06:00:00', '21:00:00', 59),
(200, 'Friday', '06:00:00', '21:00:00', 59),
(201, 'Saturday', '06:00:00', '21:00:00', 59),
(202, 'Sunday', '06:00:00', '21:00:00', 59),
(203, 'Monday', '06:00:00', '21:00:00', 60),
(204, 'Tuesday', '06:00:00', '21:00:00', 60),
(205, 'Wednesday', '06:00:00', '21:00:00', 60),
(206, 'Thursday', '06:00:00', '21:00:00', 60),
(207, 'Friday', '06:00:00', '21:00:00', 60),
(208, 'Saturday', '06:00:00', '21:00:00', 60),
(209, 'Sunday', '06:00:00', '21:00:00', 60),
(210, 'Monday', '06:00:00', '21:00:00', 61),
(211, 'Tuesday', '06:00:00', '21:00:00', 61),
(212, 'Wednesday', '06:00:00', '21:00:00', 61),
(213, 'Thursday', '06:00:00', '21:00:00', 61),
(214, 'Friday', '06:00:00', '21:00:00', 61),
(215, 'Saturday', '06:00:00', '21:00:00', 61),
(216, 'Sunday', '06:00:00', '21:00:00', 61),
(217, 'Monday', '06:00:00', '21:00:00', 62),
(218, 'Tuesday', '06:00:00', '21:00:00', 62),
(219, 'Wednesday', '06:00:00', '21:00:00', 62),
(220, 'Thursday', '06:00:00', '21:00:00', 62),
(221, 'Friday', '06:00:00', '21:00:00', 62),
(222, 'Saturday', '06:00:00', '21:00:00', 62),
(223, 'Sunday', '06:00:00', '21:00:00', 62),
(224, 'Monday', '06:00:00', '21:00:00', 63),
(225, 'Tuesday', '06:00:00', '21:00:00', 63),
(226, 'Wednesday', '06:00:00', '21:00:00', 63),
(227, 'Thursday', '06:00:00', '21:00:00', 63),
(228, 'Friday', '06:00:00', '21:00:00', 63),
(229, 'Saturday', '06:00:00', '21:00:00', 63),
(230, 'Sunday', '06:00:00', '21:00:00', 63),
(231, 'Monday', '00:00:00', '00:00:00', 64),
(232, 'Tuesday', '00:00:00', '00:00:00', 64),
(233, 'Wednesday', '00:00:00', '00:00:00', 64),
(234, 'Thursday', '00:00:00', '00:00:00', 64),
(235, 'Friday', '00:00:00', '00:00:00', 64),
(236, 'Saturday', '00:00:00', '00:00:00', 64),
(237, 'Sunday', '00:00:00', '00:00:00', 64),
(238, 'Monday', '06:00:00', '21:00:00', 65),
(239, 'Tuesday', '06:00:00', '21:00:00', 65),
(240, 'Wednesday', '06:00:00', '21:00:00', 65),
(241, 'Thursday', '06:00:00', '21:00:00', 65),
(242, 'Friday', '06:00:00', '21:00:00', 65),
(243, 'Saturday', '06:00:00', '21:00:00', 65),
(244, 'Sunday', '06:00:00', '21:00:00', 65),
(245, 'Monday', '06:00:00', '21:00:00', 66),
(246, 'Tuesday', '06:00:00', '21:00:00', 66),
(247, 'Wednesday', '06:00:00', '21:00:00', 66),
(248, 'Thursday', '06:00:00', '21:00:00', 66),
(249, 'Friday', '06:00:00', '21:00:00', 66),
(250, 'Saturday', '06:00:00', '21:00:00', 66),
(251, 'Sunday', '06:00:00', '21:00:00', 66),
(252, 'Monday', '08:00:00', '17:00:00', 67),
(253, 'Tuesday', '08:00:00', '17:00:00', 67),
(254, 'Wednesday', '08:00:00', '17:00:00', 67),
(255, 'Thursday', '08:00:00', '17:00:00', 67),
(256, 'Friday', '08:00:00', '17:00:00', 67),
(257, 'Saturday', '08:00:00', '17:00:00', 67),
(258, 'Sunday', '08:00:00', '17:00:00', 67);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `idshop` int(11) NOT NULL,
  `shopname` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `telephonenumber` varchar(45) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `latitude` varchar(40) NOT NULL,
  `longitude` varchar(40) NOT NULL,
  `website` varchar(60) DEFAULT NULL,
  `facebook` varchar(60) DEFAULT NULL,
  `shopowner_idshopowner` int(11) NOT NULL,
  `shoptype` varchar(100) NOT NULL,
  `shopicon` varchar(100) NOT NULL,
  `activation` varchar(20) NOT NULL,
  `businesspermitno` varchar(40) DEFAULT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateeditted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`idshop`, `shopname`, `address`, `phonenumber`, `telephonenumber`, `description`, `latitude`, `longitude`, `website`, `facebook`, `shopowner_idshopowner`, `shoptype`, `shopicon`, `activation`, `businesspermitno`, `datecreated`, `dateeditted`) VALUES
(26, 'AAR', '582 General Tinio Street Brgy dimasalang Cabanatuan City', '09166103369', '', 'AAR is a car accessories shop with auto mechanic located at General Tinio Street Brgy Dimasalang Cabanatuan City', '15.485557152147958', '120.96437191594487', '', '', 20, 'Auto Mechanic,Car Accessories', '20181206033007AAR.jpg', 'Active', NULL, '2018-12-06 14:30:07', '2018-12-13 05:26:12'),
(33, 'Juls car wash', '42 Don Manuel Avenue Kapitan Pepe Cabanatuan City', '9069107001', '', 'Juls car wash is a car wash located at Don Manuel Avenue Kapitan Pepe Cabanatuan City', '15.484610682494061', '120.9580547221799', '', '', 21, 'Car Wash', '2018120707234247389847_350930028819234_6171547230424530944_n.jpg', 'Active', NULL, '2018-12-07 06:23:42', '2018-12-13 05:26:29'),
(34, 'Kuz kuz', 'Dona Encarnacion Avenue Kapitan Pepe Cabanatuan City', '09238213770', '', 'Kuz kuz is a car wash located at Dona Encarnacion Avenue Kapitan Pepe Cabanatuan City', '15.480768620807545', '120.95414543056108', '', '', 22, 'Car Wash', '2018120707413447353093_602247423539677_1781029792695451648_n.jpg', 'Active', NULL, '2018-12-07 06:41:34', '2018-12-13 05:26:42'),
(35, 'J\'s autoshine', 'General Tinio Street Extension Kapitan Pepe Cabanatuan City', '9272272662', '', 'J\'s autoshine is a car accessories shop with car wash located at General Tinio Street Extension Kapitan Pepe Cabanatuan City', '15.472246845074086', '120.94953449069476', '', '', 23, 'Car Accessories,Car Wash', '2018120707575647572401_212095269714702_6903675992879923200_n.jpg', 'Active', NULL, '2018-12-07 06:57:56', '2018-12-13 05:27:37'),
(36, 'Radz', 'San Juan ACCFA Maharlika Highway Cabanatuan City', '09328554063', '', 'Radz is a car accessories shop with car wash located at San Juan ACCFA Maharlika Highway Cabanatuan City', '15.471308368941237', '120.95591000247293', '', 'Radz Carwash & Auto Accessories', 24, 'Auto Mechanic,Car Accessories,Car Wash', '2018120708301513428545_1656541581257068_8824789995903834203_n.jpg', 'Active', NULL, '2018-12-07 07:30:15', '2018-12-13 05:27:55'),
(37, 'Jay D car aircon', 'San Juan ACCFA Maharlika Highway Cabanatuan City', '09058918915', '', 'Jay D car aircon is a car aircon mechanic with car wash located at San Juan ACCFA Maharlika Highway Cabanatuan City', '15.473865726466077', '120.95712739828969', '', '', 25, 'Car Aircon,Car Wash', '2018120709015647579427_278125296241158_8072490083367780352_n.jpg', 'Active', NULL, '2018-12-07 08:01:56', '2018-12-13 05:28:56'),
(38, 'Banting auto supply', 'Sumacab Este Maharlika Highway Cabanatuan City', '', '', 'Banting auto supply is a car accessories shop with auto mechanic located at Sumacab Este Maharlika Highway Cabanatuan City', '15.4458441450482', '120.9440186637205', '', '', 26, 'Auto Mechanic,Car Accessories', '2018120709163647571886_1872513232866603_648105638638911488_n.jpg', 'Active', NULL, '2018-12-07 08:16:36', '2018-12-13 05:29:17'),
(39, 'Gatorcab', 'Sumacab Este Maharlika Highway Cabanatuan City', '', '044 940 3747', 'Gatorcab is a car accessories shop with auto mechanic located at Sumacab Este Maharlika Highway Cabanatuan City', '15.445629233855296', '120.9439424994714', '', '', 27, 'Auto Mechanic,Car Accessories', '2018120702411747679800_728152767541474_3814579103772704768_n.jpg', 'Active', NULL, '2018-12-07 13:41:17', '2018-12-13 05:29:37'),
(40, 'Autobits', 'Sumacab Este Maharlika Highway Cabanatuan City', '', '', 'Autobits is a car accessories shop with auto mechanic and car aircon mechanic located at Sumacab Este Maharlika Highway Cabanatuan City', '15.446299010546609', '120.94426346443629', '', 'autobits', 28, 'Auto Mechanic,Car Accessories,Car Aircon,Tire Supply', '2018120703083647573264_1681652538601495_4456010139895332864_n.jpg', 'Active', NULL, '2018-12-07 14:08:36', '2018-12-13 05:30:04'),
(41, 'Cruiser auto service', 'Sumacab Este Maharlika Highway Cabanatuan City', '0923990990', '', 'Cruiser auto service is a auto mechanic located at Sumacab Este Maharlika Highway Cabanatuan City', '15.443385', '120.942953', '', 'Cruiser Auto Service Center Cabanatuan City', 29, 'Auto Mechanic', '2018120705204647465555_2883749248317841_4862742636588433408_n.jpg', 'Active', NULL, '2018-12-07 16:20:46', '2018-12-07 16:25:49'),
(42, 'A.G.Combe Tire Supply', 'Maharlika Highway Cabanatuan City', '', ' (044) 463 2389', 'A.G.Combe Tire Supply is a tire shop with auto mechanic located at Maharlika Highway Cabanatuan City', '15.493234315800319', '120.97577668458644', '', 'A.G.Combe Tire Supply', 30, 'Auto Mechanic,Tire Supply', '20181208074612A.G.Combe Tire Supply.jpg', 'Active', NULL, '2018-12-08 06:46:12', '2018-12-13 05:30:40'),
(43, 'Sir Troy Carshop And Accessories', 'Maharlika Highway Valdefuente Fortaleza Rd, Cabanatuan City', '09277741750', '', 'Sir Troy Carshop And Accessories is a car accessories shop with tire shop, car wash and auto mechanic at Maharlika Highway Valdefuente Fortaleza Rd Cabanatuan City', '15.508086969075514', '120.96138510931951', '', 'SIR TROY CARSHOP', 30, 'Auto Mechanic,Car Accessories,Car Wash,Tire Supply', '2018120808001313332959_1686276418302364_2667882536138264829_n.jpg', 'Active', NULL, '2018-12-08 07:00:13', '2018-12-13 05:31:18'),
(44, 'ROXRIX AUTO SUPPLY', '607 General Tinio St Brgy Dimasalang Cabanatuan City', '', '0444636330', 'ROXRIX AUTO SUPPLY is a car accessories shop with car wash located at 607 General Tinio St Brgy Dimasalang Cabanatuan City', '15.485884965291056', '120.96536549684765', '', 'Roxrix Autosupply', 30, 'Car Accessories', '2018120808281041603545_103786207250542_1291144478588928_n.jpg', 'Active', NULL, '2018-12-08 07:28:10', '2018-12-13 05:31:44'),
(45, 'Oro Tire Supply', '175 Gen Luna Street Cabanatuan City', '', '044463 2040', 'Oro Tire Supply is a car tire shop with auto mechanic at Gen Luna Street, Cabanatuan City\r\n', '15.487352319298662', '120.9657512935405', '', 'ORO TIRE Supply', 30, 'Auto Mechanic,Tire Supply', '2018120808490817361820_1914871735447379_8477463252520397410_n.jpg', 'User Deleted', NULL, '2018-12-08 07:49:08', '2018-12-11 15:05:06'),
(46, 'New Palayan Auto Part Shop', 'Sanciangco street Cabanatuan City', '', '', 'New Palayan Auto Part Shop is a car accessories shop at Sanciangco street Cabanatuan City', '15.48601873061997', '120.96297709066198', '', '', 30, 'Car Accessories', '20181209075821Untitled.jpg', 'Active', NULL, '2018-12-09 06:58:21', '2018-12-09 06:58:45'),
(47, 'J.A OCAMPO Auto SupplyY & Accessories', '574 General Tinio Street Cabanatuan City', '', '940 1493', 'J.A OCAMPO Auto SupplyY & Accessories is a car accessories shop located at General Tinio Street Cabanatuan City', '15.485181371068299', '120.96353496506765', '', '', 31, 'Car Accessories', '20181209082640Untitled.jpg', 'Active', NULL, '2018-12-09 07:26:40', '2018-12-13 05:32:24'),
(48, 'RB\'s SURPLUS & AUTO PARTS', 'General Tinio Street Cabanatuan City', '', '602-5114', 'RB\'s SURPLUS & AUTO PARTSis a car accessories shop located at General Tinio Street Cabanatuan City', '15.485168093502551', '120.96342578509143', '', '', 31, 'Car Accessories', '20181209083741Untitled.jpg', 'Active', NULL, '2018-12-09 07:37:41', '2018-12-09 07:38:01'),
(49, 'ARITA AUTO SUPPLY', 'General Tinio Street Cabanatuan City', '', '600-5494', 'ARITA AUTO SUPPLY is a car accessories shop  located at General Tinio Street Cabanatuan City', '15.485145215969464', '120.96349854678488', '', '', 31, 'Car Accessories', '20181209085410ARITA AUTO SUPPLY.png', 'Active', NULL, '2018-12-09 07:54:10', '2018-12-09 07:54:27'),
(50, 'Bridgestone ', 'Sumacab Este, Maharlika Highway Cabanatuan City', '', '(044) 464 3872', 'Bridgestone  is a car tire shop with auto mechanic located at Sumacab Este, Maharlika Highway Cabanatuan City', '15.439526108756397', '120.94166505637156', '', 'Bridgestone Cabanatuan - Motorhub Inc.', 31, 'Auto Mechanic,Tire Supply', '2018120909302114054993_303168293368423_710826483665124313_n.jpg', 'Active', NULL, '2018-12-09 08:30:21', '2018-12-13 05:33:35'),
(51, 'Denso', 'Pantoc 2 Daan Sarile Cabanatuan City', '', '(044) 600 1952', 'Denso is a car accessories shop with car aircon auto mechanic located at Pantoc 2 Daan Sarile Cabanatuan City', '15.504126452059687', '120.97645557729732', '', 'Jethro - Denso Cabanatuan', 31, 'Car Accessories,Car Aircon', '20181209094428Denso_Service,_Maharlika_Hwy,_Daang_Sarile,_Cabanatuan_City,_Mueva_Ecija.jpg', 'Active', NULL, '2018-12-09 08:44:28', '2018-12-13 05:33:58'),
(52, 'Jet-Matic Rewind', 'Maharlika Highway Cabanatuan City', '', '', 'Jet-Matic Rewind is a  located at Maharlika Highway Cabanatuan City', '15.48573984836771', '120.97159892320633', '', '', 32, 'Auto Mechanic', '20181211082732Untitled.png', 'Active', NULL, '2018-12-11 07:27:32', '2018-12-13 05:34:15'),
(53, 'Jet-Matic Rewind', 'Maharlika Highway Cabanatuan City', '', '', 'Jet-Matic Rewind is a  located at Maharlika Highway', '15.48573984836771', '120.97159892320633', '', '', 32, 'Auto Mechanic', '20181211082733Untitled.png', 'Marked', NULL, '2018-12-11 07:27:33', '2018-12-11 14:19:03'),
(54, 'MRF TYRES', 'Maharlika Highway Cabanatuan City', '', '', 'MRF TYRES is a car tire shop located at Maharlika Highway', '15.485511068396672', '120.97080955374531', '', '', 32, 'Tire Supply', '20181211083359MRF TYRES.png', 'User Deleted', NULL, '2018-12-11 07:33:59', '2018-12-11 15:05:37'),
(55, 'Shell', 'Maharlika Highway Cabanatuan City', '', '', 'Shell is a gasoline station at Maharlika Highway Cabanatuan City', '15.48100682540395', '120.96052200345332', '', 'Shell Cabanatuan', 33, 'Gas Station', '2018121108481625591769_2043820929189051_7533766691295506606_n.jpg', 'Active', NULL, '2018-12-11 07:48:16', '2018-12-11 07:49:03'),
(56, 'Flying V', 'Melencio Street Cabanatuan City', '', '', 'Flying V is a gas station at Melencio Street Cabanatuan City', '15.48590517252085', '120.96069022356573', '', '', 33, 'Gas Station', '20181211085510Flying V.jpg', 'User Deleted', NULL, '2018-12-11 07:55:10', '2018-12-11 13:47:06'),
(57, 'Petron', 'General Tinio Street Extension Cabanatuan City', '', '', 'Petron is a gas station at General Tinio Street Extension Cabanatuan City', '15.47301241950769', '120.94972681652246', '', '', 33, 'Gas Station', '201812110904241200px-Logo_of_Petron.svg.png', 'Active', NULL, '2018-12-11 08:04:24', '2018-12-11 08:05:48'),
(58, 'Petron', 'Mabini Street Extension', '', '', 'Petron is a gas station at Mabini Street Extension', '15.481909288355405', '120.97565159520809', '', '', 33, 'Gas Station', '201812110918471200px-Logo_of_Petron.svg.png', 'Active', NULL, '2018-12-11 08:18:47', '2018-12-11 08:19:16'),
(59, 'Phoenix Gas Station', 'Sanciangco Street, Cabanatuan City', '', '', 'Phoenix Gas Station is a gas station at Sanciangco Street, Cabanatuan City', '15.483086205519383', '120.96431944646474', '', '', 33, 'Gas Station', '20181211092729Phoenix Gas Station.png', 'Active', NULL, '2018-12-11 08:27:29', '2018-12-11 08:28:02'),
(60, 'ptt', 'Circumferential road Cabanatuan City', '', '', 'ptt is a gas station at Circumferential road Cabanatuan City', '15.47165903868805', '120.96706507595127', '', '', 33, 'Gas Station', '20181211093528ptt.jpg', 'User Deleted', NULL, '2018-12-11 08:35:28', '2018-12-11 13:47:00'),
(61, 'Caltex', 'Aurora Road Cabanatuan City', '', '', 'Caltex is a gas station at Aurora Road Cabanatuan City', '15.493087535832585', '120.97778989612266', '', '', 33, 'Gas Station', '20181211094715caltex.jpg', 'Active', NULL, '2018-12-11 08:47:15', '2018-12-13 05:35:01'),
(62, 'Uno', 'Maharlika Highway', '', '', 'Uno is a gas station at Maharlika Highway', '15.466016060233855', '120.95343990233187', '', '', 33, 'Gas Station', '201812110957521530604137Logo_Uno_Fuel.jpg', 'User Deleted', NULL, '2018-12-11 08:57:52', '2018-12-11 13:47:15'),
(63, 'Lamarang Gas Station', 'Bato-Bato Bridge, Cabanatuan City', '', '', 'Lamarang Gas Station is a gas station at Bato-Bato Bridge, Cabanatuan City', '15.466538328888493', '120.9621619306871', '', '', 33, 'Gas Station', '20181211030044download.png', 'Active', NULL, '2018-12-11 14:00:44', '2018-12-11 14:01:34'),
(64, 'Shell', 'Maharlika Highway Cabanatuan City,', '', '', 'Shell is a gas station at Maharlika Highway Cabanatuan City,', '15.456507916283476', '120.94900003520752', '', 'Shell Cabanatuan', 33, 'Gas Station', '20181211030703shell.jpg', 'Active', NULL, '2018-12-11 14:07:04', '2018-12-11 14:07:24'),
(65, 'SEAOIL', 'Maharlika Highway Cabanatuan City', '', '', 'SEAOIL is a gas station at Maharlika Highway Cabanatuan City', '15.454663591952748', '120.94813338481686', ' seaoil.com.ph', '', 33, 'Gas Station', '20181211032836SEAOIL.jpg', 'Active', NULL, '2018-12-11 14:28:36', '2018-12-11 14:28:56'),
(66, 'Petron', 'Mabini Street Extension Cabanatuan City', '', '', 'Petron is a gas station at Mabini Street Extension Cabanatuan City', '15.481894444802366', '120.97565152299183', '', '', 35, 'Gas Station', '20181212071312petron.png', 'Active', NULL, '2018-12-12 06:13:12', '2018-12-12 06:14:30'),
(67, 'Golden E', 'General Tinito Cabanatuan City', '', '463-0335', 'Golden E is a car accessories at General Tinito Cabanatuan City', '15.485474914934613', '120.96433963185677', '', '', 35, 'Car Accessories', '20181212072516Untitled.png', 'Active', NULL, '2018-12-12 06:25:16', '2018-12-12 06:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `shopcopy`
--

CREATE TABLE `shopcopy` (
  `idshopcopy` int(11) NOT NULL,
  `shopname` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `telephonenumber` varchar(45) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `latitude` varchar(40) NOT NULL,
  `longitude` varchar(40) NOT NULL,
  `website` varchar(60) DEFAULT NULL,
  `facebook` varchar(60) DEFAULT NULL,
  `shopowner_idshopowner` int(11) NOT NULL,
  `shoptype` varchar(100) NOT NULL,
  `shopicon` varchar(100) NOT NULL,
  `businesspermitno` varchar(40) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shopimage`
--

CREATE TABLE `shopimage` (
  `idshopimage` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopimage`
--

INSERT INTO `shopimage` (`idshopimage`, `image`, `shop_idshop`) VALUES
(27, '20181206033752AARproduct.jpg', 26),
(28, '2018120707270947580136_502615896898692_5223052541176053760_n.jpg', 33),
(29, '2018120707423247431713_282271149143223_4850920524357828608_n.jpg', 34),
(30, '2018120707424247477617_2229452547313374_3445780690245779456_n.jpg', 34),
(31, '2018120707425447571545_184658169155242_1121454963583614976_n.jpg', 34),
(32, '2018120708490947284481_324526031478633_527032980170866688_n.jpg', 36),
(33, '2018120708495547429721_1239858139498732_4210865119015469056_n.jpg', 36),
(34, '2018120708501547455495_1924701954309619_4505594407751254016_n.jpg', 36),
(35, '20181207085027R.jpg', 36),
(36, '2018120703161147576574_324200071642673_5009213743075164160_n.jpg', 40),
(37, '2018120703162447339483_2197119760609557_6371417789856481280_n.jpg', 40),
(38, '2018120703163847685658_378490019623630_289735818023534592_n.jpg', 40),
(39, '2018120808094313325693_1686275898302416_4784054291559793156_n.jpg', 43),
(40, '2018120808095213344593_1686944618235544_8350449279388796119_n.jpg', 43),
(41, '2018120808103346913291_2437445816283813_4464154381436059648_n.jpg', 42),
(42, '2018120808104141702438_2328531223841940_848036568131174400_n.jpg', 42),
(43, '2018120808510517309873_1913382538929632_4678164011844042013_n.jpg', 45),
(44, '2018120909305813962598_303786779973241_9001140301731708426_n.jpg', 50),
(45, '20181209094613Denso_Service,_Maharlika_Hwy,_Quezon_District,_Cabanatuan_City,_Nueva_Ecija.jpg', 51),
(46, '20181211024922Phoenix-Logo1-01.png', 59),
(47, '20181211031114shell.jpg', 55);

-- --------------------------------------------------------

--
-- Table structure for table `shopowner`
--

CREATE TABLE `shopowner` (
  `idshopowner` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  `usernumber` varchar(11) NOT NULL,
  `accountstate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`idshopowner`, `firstname`, `lastname`, `email`, `address`, `usernumber`, `accountstate`) VALUES
(20, 'Alfonso', 'Roque', 'fhilip02099@gmail.com', '582 General tinio street brgy dimasalang', '9166103369', 'Active'),
(21, 'Julius', 'Capinding', 'carwashjuliuscapinding@gmail.com', 'Kapitan Pepe', '9069107001', 'Active'),
(22, 'Jun jun', 'trinidad', 'kuzjunjuntrinidad@gmail.com', 'Dona Encarnacion Avenue Kapitan Pepe', '9238213770', 'Active'),
(23, 'Carlo', 'De Guzman', 'carlodeguzman@gmail.com', 'General Tinio Street Extension Kapitan Pepe', '9272272662', 'Active'),
(24, 'Derek', 'Beltran', 'derekbeltran@gmail.com', 'San Juan ACCFA Maharlika Highway', '9328554063', 'Active'),
(25, 'Jay ', 'Bernardo', 'jaybernardo@gmail.com', 'San Juan ACCFA Maharlika Highway', '9058918915', 'Active'),
(26, 'Danilo', 'Banting', 'danilobanting@gmail.com', 'Sumacab Este Maharlika Highway Cabanatuan City', '9553688741', 'Active'),
(27, 'Glenda', 'Dacanay', 'glendadacanay@gmail.com', 'Sumacab Este Maharlika Highway Cabanatuan City', '0449403747', 'Active'),
(28, 'Marvin', 'Tiangco', 'marvintiangco@gmail.com', 'Sumacab Este Maharlika Highway Cabanatuan City', '9054478213', 'Active'),
(29, 'Ian', 'Mallari', 'ianmallari@gmail.com', 'Sumacab Este Maharlika Highway Cabanatuan City', '0923990990', 'Active'),
(30, 'ag', 'combe', 'agcombe@gmail.com', 'Maharlika Highway', '0444632389', 'Active'),
(31, 'kurt', 'espiritu', 'kurtespiritu@gmail.com', 'Sanciangco Street Cabanatuan City', '0446005592', 'Active'),
(32, 'mark', 'apan', 'markapan@gmail.com', 'Maharlika Highway\r\n', '0927515376', 'Active'),
(33, 'kim', 'chua', 'kimchua@gmail.com', 'Cabanatuan City', '9275156733', 'Active'),
(34, 'cristopher', 'de jesus', 'cristopherde jesus@gmail.com', 'Cabanatuan City', '9169324481', 'Active'),
(35, 'hanz', 'bautista', 'hanzbautista0125@gmail.com', 'Cabanatuan City', '9568850144', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `shopproduct`
--

CREATE TABLE `shopproduct` (
  `idshopproduct` int(11) NOT NULL,
  `productname` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(12) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopproduct`
--

INSERT INTO `shopproduct` (`idshopproduct`, `productname`, `description`, `price`, `image`, `shop_idshop`) VALUES
(3, 'Car motor clean cham synthetic chamois', '-Its water absorbency makes it good for other uses\r\n-Ideal for car and household cleaning', '100PHP', '20181207062105cleanchasm.jpg', 26),
(4, '4 In 1 3.1A Dual USB Car Charger Voltmeter Bl', '-Type: 4 in 1 Car Charger\r\n-Case Color: Black\r\n-LCD Digital Color: Red, Blue\r\n-Output Interface: USB\r\n-Input Voltage: DC 12-24V (Â±0.2V)\r\n-Output Voltage: DC 5V (Â±0.1A)', '362PHP', 'aar2.jpg_', 26),
(5, 'DS123 Car Back Seat Organizer Multipurpose', '-Car Back Seat Organizer Hanging Bottle Holder Travel Storage Bag Box Case Kitchen Multi-Pocket\r\n-Wonderful design and workmanship, Convenient installation, Wear-proof, long holding time.\r\n-The tissues dispenser at the bottom of the bag helps keep clean t', '300PHP', '20181207062733DS123 Car Back Seat Organizer Multipurpose.jpg', 26),
(6, 'PTT Performa Super Synthetic SAE 0W-30 Car En', '- Fully Synthetic- Designed for modern vehicles using gasoline, ethanol blended gasoline E10, E20 and E85.\r\n- Recommend for engine under start-stop system.\r\n- Can be used for gas fuelled (CNG or LPG) engines.- DI-SYN Protect to deliver unsurpassed levels ', '1895PHP', '20181207062932PTT Performa Super Synthetic SAE 0W-30 Car Engine Oil 4 Liters.jpg', 26),
(7, 'YM0111 Hydrophobic Waterproof CAR WAX (BLACK)', '-BLACK Variantfor darkcolored cars (Black, Red, Iron Red, Green- all dark colors)\r\n-BEST SELLER Hydrophobic Waterproof Wax\r\n-EASY to apply wax\r\n-LAST up to 45 days\r\n-GOOD for 25-30 applications\r\n-Authentic formula greenish in solution for dark cars\r\n-SAFE', '1299PHP', 'aar3.jpg', 26),
(8, '11x professional polishing sponge set 100mm p', '-Individually polished direct use,easy to replace.\r\n-Can be washed, re-use, to reduce cost, economical.\r\n-with the polishing liquid (paste, powder) used in conjunction with the surface to be polished to achieve better\r\n-Polishing effect.\r\n-Polishing befor', '789PHP', '2018120708041111x-professional-polishing-sponge-set-100mm-polishing-machine-polishing-set-polishing-', 35),
(9, 'ADVENTURERS 40 Pcs Car Repair Tools Maintance', '-Universal\r\n-Technical\r\n-Durable\r\n-Easy to fit\r\n-Small volume\r\n-Convenient to carry', '400PHP', 'j3.jpg', 35),
(10, 'MAG 1 5W30 GM dexos1 licensed API SN Full Syn', '-Advanced formulation provides highest level of engine protection, even under severe operating conditions\r\n-100% synthetic base oils provide exceptional resistance to high temperature oxidation\r\n-Sophisticated FMX additives prevent sludge formation, keep ', '1870PHP', '20181207081010d2365a5b9aa33f5f1a94c1fa64477f1d.png', 35),
(11, 'Mr Squeaky Watermark Remover', '-Mr Squeaky Watermark Removeris a strong acidic mixture that softens the hard minerals that have been left off by the water especially nearby sprinklers.\r\n-Eliminates calcium deposits and minerals.\r\n-Softens and clean the hard minerals that have been left', '549PHP', '201812070840033a0514451e97e20df45e37fd09d18480.jpg', 36),
(12, 'Rivers Perfect Shine Car Wax, Multi-Purpose P', '-Perfect Shine: Maximum synthetic polymer paint protection with exceptional durability\r\n-Perfect Shine: Gloss enhancing polymer bonds to paintwork at the nano-level\r\n-Perfect Shine: Delivers a vibrant reflective perfect shine\r\n-Protectant: Protects and re', '239PHP', '20181207084204e7991bf7de18e28cba0ceebd97133e9d.jpg', 36),
(13, 'Pertua Apex Synthetic Performance Gasoline En', '-Formulated with Pertua\'s DuraSyn Technology\r\n-Safe and suitable for all types of gasoline engines\r\n-Speeds up engine responsiveness\r\n-Meets the most demanding driving conditions\r\n-maximum protection for both oil and metal surfaces\r\n-longer periods betwee', '454PHP', '20181207084344dc6fbae4f100af96e14eb37401e5927b068e0896_0.jpg', 36),
(14, 'CASTROL MAGNATEC DIESEL 15W-40 (Diesel Cars &', '-SAE 15W-40\r\n-5 Liter\r\n-Recommended for Diesel Cars & SUV\r\n-CASTROL MAGNATEC DIESEL 15W-40- suitable for naturally aspirated, turbocharged and inter-cooled turbocharged engines. Also suitable for direct and indirect injection diesel engines. Not recommend', '1800PHP', '20181207084527AUS-5L-Mag-DX-Diesel-5W-40.jpg', 36),
(15, 'Multi-function Car Seat Back Organizer Bevera', '-Car Seat Back Organizer\r\n-Beverage Food Storage Bag\r\n-Tissue Container\r\n-Phone Holder', '2699PHP', 'radz22.jpg', 36),
(16, 'CLAY BAR KIT', '-3MariasGM Clay Lube is a non-abrasive formula which gives excellent lubrication for use with all types of detailing clay. Safe on all types of paint and clear coat finishes. Also works great on removing fingerprints, smudges and light dust, leaving a smo', '500PHP', '20181207092348download.jpg', 38),
(17, 'Detailing Beast Acid Rain Remover water mark ', '250ml spray bottle of Acid Rain RemoverUsed for glassMade in the PhilippinesSteps:Clean the glass surfacePour a few drops into a clean clothRub the surface to be cleaned with the cloth until water marks disappearRinse surface with waterWipe clean', '250PHP', '20181207093211download.jpg', 38),
(18, 'BVS Car Drink Cup Holder Valet Travel Coffee ', '-100% high quality\r\n-Durable\r\n-Multi functional\r\n-AUTO Electronics Accessories\r\n-Easy to operate\r\n-Auto Fans\' best choice\r\n-High quality and Professional, which can Meet your demand\r\n-Affordable', '300PHP', '2018120709341484f09cb96315715d64b787da5e241c5e.jpg', 38),
(19, '2x Car Seat Genuine Leather Headrest Neck Pil', '-100% Brand New.\r\n-Material: Synthetic Leather and Polyester\r\n-Filling: High-density Cotton\r\n-Color: Black,Brown,Gray,Beige', '599PHP', '20181207093713c297840b9c941083369eeeabfda6af86.jpg', 38),
(20, 'Head Hunters Type R Universal Fit PU Leather ', '-INCLUDES: 4 front seat covers + 2 back seat covers + 2 headrest covers + 2x seat belt cover\r\n-COMPATIBLE: Universal application fits almost all seats ( Cars, Trucks, Vans, & SUV )\r\n-HIGH QUALITY: Materials are Made from Durable & Comfortable PU Leather- ', '1699PHP', '201812070940280da36f8a1bf8d007011bbe665041360b.jpg', 38),
(21, '9pcs/Set Universal Car Seat Covers Washable S', '-Made of premium material, it is durable and comfortable.\r\n-Help to protect car seat form spills, stains, fading and dirt.\r\n-Provides a convenient way to protect a brand new seat or decorate an old one.', '3950PHP', '2018120702454661-RSbAY-jL._SY355_.jpg', 39),
(22, 'Universal 360Â° Rotating Auto Car Windshield ', 'Powerful suction, super pulling force, can mount on any surface such as winshield, dash \r\nboard, desk and so on.\r\nMounts all cellphones, MP4 and GPS devices up to 5-inch screens.\r\nFlexible holder can rotate 360 degrees, freely adjust to any desired viewin', '250PHP', '20181207024752s-l640.jpg', 39),
(23, '20cm x 14cm Non-Slip Mat Dashboard Sticky Pad', '-Place the skid pad on the instrument panel, cell phone, cigarette, pen, coin, eye, etc. anything will be placed on it. Even the brakes or the vibrations will not fall;\r\n-Environmental protection latex work fine, both soft and flexible, anti slip effect i', '690PHP', '20181207024949download.jpg', 39),
(24, 'Universal Car-styling Car Storage Box Organiz', '-Mini cup shape car storage box, light weight, convenient to carry.\r\n-Can place your stuffs such as coins, card, keys, cigarette, pens, etc.\r\n-Features an independent coin slot and a card slot, specially designed for collecting coins and cards.\r\n-Small an', '439PHP', 'sc.jpg', 39),
(25, 'pcs Universal Car Front Bumper Lip Splitter F', '-Material: PP\r\n-Process: Injection molding\r\n-Size: Big: 41 X 12.5 cm/16.14 X 4.92 in, Small: 36.5 X 12.5 cm/14.37 X 4.92 in\r\n-Weight: approx. 200 g\r\n-Suitable for most car models, with back sticker, just apply on your car front bumper.', '1048PHP', 'carbumb.jpg', 39),
(26, 'Car Accessory 4 x 3LED 12V Interior Decorativ', '-Light up your car and your night with this LED Dome Light\r\n-Low power consumption and low temperature\r\n-High brightness, Long service life', '429PHP', '20181207033938s-l300.jpg', 40),
(27, 'bwa Car Charging Adapter, 2 Socket Dual USB O', '-FUNCTION:Convert and increase your vehicle cigarette lighter from 1 splitter to 2 plug sockets as well as 2 USB ports, can charging up to 4 devices at once. Dual power socket, total output 80W, Fit for 12/24V car, provide a total up to power 80W. Excelle', '1862PHP', 'char.jpg', 40),
(28, 'LUOWAN Car Seat Lumbar Cushion Memory Foam Ba', '-The pillows are made of premium memory foam,which makes the pillow soft and comfortable, it will offer strong support to your back and keep in shape even in long time driving\r\n-The car lumbar back support cushion is useful to release pressure of back and', '5497PHP', '20181207034417be4f21c41fa14b94ecc2c1d76c6de2a5.jpg', 40),
(29, 'Stainless Steel Dual Exhaust Pipe Car Rear Ta', 'Car muffler decorative tail throat can not only protect exhaust pipe from deformation, but also can act as pressurization and spoiler functions. And it can reduce the noise causing by exhaust pipe.', '1608PHP', 'pipecar.jpg', 40),
(30, 'Petron Sprint 4T Racer 4-Stroke Motor Oil SAE', 'PETRON SPRINT 4T RACER is a fully synthetic, superior quality engine oil specially formulated with advanced additive technology to provide outstanding protection and improved clutch operation for modern, high-performance motorcycles. It is suitable for bo', '329PHP', '20181207040018bd9febee007e6740a672d47a38cc28af.jpg', 40),
(31, 'Car solid wax paint care protection scratch r', '-BLACK Variantfor darkcolored cars (Black, white, grey - all dark colors)\r\n-BEST SELLER Hydrophobic Waterproof Wax\r\n-EASY to apply wax\r\n-LAST up to 45 days\r\n-GOOD for 25-30 applications\r\n-Authentic formula greenish in solution for dark cars\r\n-SAFE to use ', '499PHP', 'carcare.jpg', 40),
(32, '2 pieces Quality Car Tires Thunderer 205/65R1', '-Made in Thailand\r\n-Great grip on both dry and wet road conditions\r\n-Excellent hydroplaning resistance\r\n-Enhanced responsive steering and cornering performance', '6998PHP', '20181207041640c21b3f2870d4e3f7c0dfe2ca903af459d12ae690_0.jpg', 40),
(33, 'Blade Car Cover Hatchback (Grey) Indoor', '-Soft cushioning layer protects your paint\r\n-Superior, breathable 3-layer fabric is highly water resistance, even during downpours\r\n-Fabric naturally resists rot and mildew\r\n-No leak construction achieved through ultrasonic welding UV stable materials ens', '999PHP', '20181208080604download.jpg', 43),
(34, 'Universal 7010B 7inch Car MP5 Player 2Din Tou', '--For Vehicle Brands/Model:Audi\r\n-Material Type:Electronic Components,Metal,Plastic\r\n-Digital Media Format:JPEG,WMA,Mp3,Mp4\r\n-Special Features:MP3 Players,Mobile Phone,FM Transmitter,Radio Tuner,Bluetooth,Touch -Screen\r\n-Max External Memory:32G\r\n-Interfac', '5999PHP', '20181208080828HTB1YGzxnBDH8KJjSszcq6zDTFXa7.jpg', 43),
(35, 'PTT Performa Racing Synthetic 5W-50 Car Engin', '- Fully Synthetic- Designed for extreme performance luxurious sports cars and racing cars.\r\n- Recommended for vehicles using gasoline, ethanol blended gasoline E10, E20 and E85.\r\n- Suitable for high mileage cars with high engine top-up rate.\r\n- Can be use', '1325PHP', '20181208080925715e9b91a1efaf062c2d2c6c3d9a3be0.jpg', 43),
(36, 'Universal Auto Car Design 3D Vent Hood Scoop ', 'Product details of Universal Auto Car Design 3D Vent Plastic Sticker Hood Scoop Exterior Decoration Black', '999PHP', '20181208083120d796f1cd0fd58adcf3dbc6a51c21b323.jpg', 44),
(37, 'Back seat organizer eat car', 'This Gizmobaba car organizer is incredibly easy to use as it doesn\'t require any installation or adding any extra hook. Install in 1 minute! It can attach to the headrest of the front seats, so that whoever is at the back can easily reach the belongings. ', '499PHP', 'backseat.jpg', 44),
(38, 'Dynamics 360 Degree Car CD Slot Mount Mobile ', '-Stretchable clamp/bracket can hold up to 3.5 inch wide\r\n-CD car mount is designed to fit for most types of vehicle.\r\n-Just add extra Three attachable clips(if necessary) onto the mount for perfect fit', '899PHP', '2018120808342031935.jpg', 44),
(39, 'Petron Ultron Extra Gasoline Engine Oil Multi', '-Heavy-duty engine oil that provides sufficient engine protection for moderate drving conditions.\r\n-It provides protection against wear and deposits.\r\n-Longer engine pretection\r\n', '859PHP', '20181209080113f2547ae0bbc00f5d4c3a4d6f4c045173ecd657ca_0.jpg', 46),
(40, '2 pcs 31mm 6LED 1210 Light Bulb DC 12V Car In', '-Car Interior Light Bulb\r\n-Bulb\r\n-LED Light Bulb\r\n-6LED 1210 Light Bulb\r\n-Festoon Light Bulb\r\n', '258PHP', '2018120908023541yhoN9H20L._SY355_.jpg', 46),
(41, 'Car Stereo Bluetooth Mp3 player USB/SD AUX Au', '-For orders outside Luzon, please expect additional fifteen (15) days shipping due to airline safety restrictions\r\n-Specificationï¼šV2.0\r\n-Supports advanced audio distribution profile\r\n-Off time display function', '1899PHP', 'carstereo.jpg', 46),
(42, 'Waterproof Lightweight Nylon Car Cover for Au', '-Made from 100% nylon taffeta\r\n-Lightweight and durable\r\n-Whole body cover\r\n-Perfect match for your car\r\n-Size: 480 x 175 x 120 cm', '1299PHP', '2018120908055041kVCFfGAVL._SL500_AC_SS350_.jpg', 46),
(43, '4pcs Full Set Carpet Floor Mats Universal Fit', '-CARPET DESIGN--Carpet anti-slip backing stays right in place on any fabric or carpet surface.\r\n-PROTECT CAR FLOOR WELL--Do well in protecting your car interior floors from getting all of the dirt and mud,snow that comes throughout the seasons.\r\n-EASY TO ', '999PHP', '2018120908065661+C80iyK8L._SX522_.jpg', 46),
(44, 'MAG 1 Rubberized Undercoating 16oz (473ml/453', '-Provides superior and tough professional-grade protective shield that will remainelastic and will not crack\r\n-Contains high rubber concentration\r\n-Provides excellent rust and corrosion protection, and acts as heavy coating for superior sound deadening\r\n', '1120PHP', '2018120908292455146824_B.png', 47),
(45, 'CASTROL MAGNATEC 10W-40 (Petrol & Diesel cars', '-Recommended for Petrol & Diesel Cars\r\n-Dramatisation of roughness, comparing the same SW-30 oil with and without Castrol Magnatec molecules in the squence IVA wear test.', '370PHP', '20181209083037AUS-5L-Mag-10W-40.jpg', 47),
(46, '4Pair Universal Engine Car Door Pin Switch Ad', '-Durable\r\n-Convenience\r\n-High quality\r\n-100% Brand new', '524PHP', 'carpinsw.jpg', 47),
(47, 'Tookie 1Pc Plastic DC 12V 40A Car 4 Pin SPST ', '-100% brand new and high quality\r\n-Easy for installation and use.\r\n-Used for many car electronic applications to turn on/off almost any device', '199PHP', 'v40.jpg', 47),
(48, 'Motolite Car Battery NS60/R ENDURO BATTERY be', '-Reliable starting power for everyday driving conditions, for normal everyday use vehicles.\r\n-Built with optimum materials to adequately supply energy requirements of most vehicles in the market Specifically engineered for use in hot climates\r\n-Powered by', '4945PHP', '2018120908414596cb3b2f9e9c0d728669b4b4596f5dd667d14f7c_0.jpg', 48),
(49, 'Car Battery Motolite Gold 3SMF / N70 for SUVs', '-Engineered for use in hot climates (Tropicalized)\r\n-Long-lasting power for heavy duty vehicle use\r\n-Recommended for most Japanese, Korean, American, European car makes and models\r\n-Powered by EGX Technology\r\n', '8109PHP', '201812090842473853_1.jpg', 48),
(50, 'FS Racing 53632/53610 LED car light 1/10 RC C', '-Brand name: FS Racing\r\n-Item name: LED car light\r\n-Voltage:6V\r\n-Power:0.5 W', '718PHP', '20181209084358download.jpg', 48),
(51, 'PTT Performa Super Synthetic SAE 0W-40 Car En', '- Fully Synthetic- Designed for modern vehicles using gasoline, ethanol blended gasoline E10, E20 and E85.\r\n- Recommend for engine under start-stop system.\r\n- Can be used for gas fuelled (CNG or LPG) engines- DI-SYN Protect to deliver unsurpassed levels o', '2500PHP', '201812090846043891b13c98739c81150db6d7fd185011.jpg', 48),
(52, 'brake drum', 'The brake drum is generally made of a special type of cast iron that is heat-conductive and wear-resistant. It rotates with the wheel and axle. When a driver applies the brakes, the lining pushes radially against the inner surface of the drum, and the ens', '1066PHP', '20181209090013centric_premium_brake_drums_hero_1.jpg', 49),
(53, 'DC 12V 40A 4 Pin Automotive Alarm Relay For C', 'Used for many car electronic applications to turn on/off almost any device', '137PHP', 'alarm.jpg', 49),
(54, '5M Car Styling Interior Decoration Strips Mou', '-Material:Senior latex\r\n-Applicable model:Universal\r\n-Length:5M\r\n-Brand new and high quality\r\n-Decoration Line Strips   ', '229PHP', 'styling.jpg', 49),
(55, 'BolehDeals Two x White P13W LED Bulbs 18 SMD ', '-100% Brand new and high quality;\r\n-Easy installation, just plug & play;\r\n-Low power consumption;\r\n-Operation Voltage: 12V\r\n-Power: 3.6 W\r\n-Lifespan: 50000 working hours', '420PHP', '2018120909041841K5FILaT0L._SX463_.jpg', 49),
(56, '2 PCS SY-089A 360 Degree Rotatable Two Side A', '-Assistant Mirror In Car Exterior Accessories Side\r\n-Exterior Accessories', '1197PHP', '201812090905561afa1b3d4d7d6d.jpg', 49),
(57, '2pcs/set Fashion Universal Cotton Seat belt S', '-100% brand new and high quality\r\n-Fit for all cars\r\n-Feels soft and comfortable.\r\n-Ideal for car, truck,etc.\r\n-Install and use easily.', '930PHP', '20181209094854rBVaJFmmkAmAKnPTAAKjbbxZGAo097.jpg', 51),
(58, 'URXTRAL Front Rear Universal Car Seat Covers ', '-100% Brand new and high quality!\r\n- Secure hook for under seat.\r\n-It is for easy installation.\r\n-Universal for cars.\r\n-Durable for used.\r\n-Special for a unique look and comfort.', '1665PHP', '2018120909500075d7c3f8ee1c8639b1ece46e09b36c8a.jpg', 51),
(59, '1 Pair 3D Solid Metal Wings Pattern Car Exter', '-Made of solid metal, no fading even after long time using, suitable for most cars.\r\n-Polished smooth surface, a great decoration for your car.', '349PHP', '20181209095129download.jpg', 51),
(60, '4-in-1 Car Interior Decoration auto light Glo', '-Fit all automatic car\r\n-360 degrees to adjust\r\n-adhesive tap duplexing for installation\r\n-A total of 4 lights and each light includes 3 LED', '2031PHP', '2018120909530961HdABgaIbL._SX425_.jpg', 51),
(61, '10PCS M6 x 20 Car Styling Universal Modificat', '-100% brand new and of high quality\r\n-The fender washers will fit any 10mm bolt hole under the hood\r\n-The 6Mx20 bolts is recommended for all parts under your hood such as fenders, -headlights, bumpers.\r\n-Easy to install', '227PHP', '20181209095535HTB1UJV1RVXXXXbhXpXXq6xXFXXXG.jpg_640x640q90.jpg', 51),
(62, 'Stainless Steel T-Bolt TBolt Clamp Turbo', '-3inch\r\n-Silvery\r\n-Brand new', '323PHP', '20181212072919Stainless Steel T-Bolt TBolt Clamp Turbo.jpg', 67),
(63, 'Horizontal Shaft Support Linear Shaft Rail Su', '-MPN:Does not apply\r\n-Brand:Unbranded/Generic\r\n-Type: SHF16\r\n-Shaft Dimension: 16mm\r\n-Material : Aluminum Alloy\r\n-used for supporting the two sides of the linear rail shaft', '310PHP', '20181212073115Horizontal Shaft Support Linear Shaft Rail Support CNC Parts SHF16.jpg', 67),
(64, 'RYT Air Conditioning Air Outlet Bright Rings ', '-surface hardness, scratch resistant\r\n-Color beautiful, do not fade\r\n-The use of double-sided adhesive, do not damage the car paint, without leaving a trace', '573PHP', '20181212073338RYT Air Conditioning Air Outlet Bright Rings Car Decorative Rings Interior Decoration ', 67);

-- --------------------------------------------------------

--
-- Table structure for table `shopreport`
--

CREATE TABLE `shopreport` (
  `idshopreport` int(11) NOT NULL,
  `report` varchar(150) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reportstate` tinyint(1) NOT NULL,
  `reportername` varchar(100) NOT NULL,
  `reporteremail` varchar(120) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `adminstate` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopreview`
--

CREATE TABLE `shopreview` (
  `idshopreview` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `rate` int(11) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shop_idshop` int(11) NOT NULL,
  `reviewstate` tinyint(1) NOT NULL,
  `reviewername` varchar(100) NOT NULL,
  `revieweremail` varchar(120) NOT NULL,
  `reportstate` tinyint(1) NOT NULL,
  `adminstate` tinyint(1) NOT NULL,
  `datereported` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopreview`
--

INSERT INTO `shopreview` (`idshopreview`, `comment`, `rate`, `datetime`, `shop_idshop`, `reviewstate`, `reviewername`, `revieweremail`, `reportstate`, `adminstate`, `datereported`) VALUES
(1, 'a', 2, '2019-03-13 10:31:47', 40, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00'),
(2, 'a', 2, '2019-03-13 10:31:51', 40, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00'),
(3, 'a', 2, '2019-03-13 10:31:56', 40, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00'),
(4, 's', 3, '2019-03-13 10:32:00', 40, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00'),
(5, 'a', 3, '2019-03-13 10:32:08', 40, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00'),
(6, 'nice', 2, '2019-06-06 19:48:22', 37, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00'),
(7, 'Great!', 5, '2019-06-06 19:54:45', 26, 0, 'Fhilip Jhune Fernandez', 'fhilip02099@gmail.com', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shopservice`
--

CREATE TABLE `shopservice` (
  `idshopservice` int(11) NOT NULL,
  `servicename` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shopservice`
--

INSERT INTO `shopservice` (`idshopservice`, `servicename`, `price`, `shop_idshop`) VALUES
(39, 'Car wash ', '120PHP', 33),
(40, 'Car wash with wax', '180PHP', 33),
(41, 'Car wash', '120PHP', 34),
(42, 'Car wash with wax', '180PHP', 34),
(43, 'Car wash', '120PHP', 35),
(44, 'Car wash with wax', '180PHP', 35),
(45, 'Car wash', '120PHP', 36),
(46, 'Car wash with wax', '200PHP', 36),
(47, 'Car wash ', '100PHP', 37),
(48, 'Car wash with wax', '160PHP', 37),
(49, 'Car wash', '130PHP', 43),
(50, 'Car wash with wax', '190PHP', 43);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(25) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phonenumber` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `adminreview`
--
ALTER TABLE `adminreview`
  ADD PRIMARY KEY (`idadminreview`),
  ADD KEY `fk_adminreview_shop1_idx` (`shop_idshop`),
  ADD KEY `fk_adminreview_admin1_idx` (`admin_idadmin`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idmessage`),
  ADD KEY `fk_reportedReview_shop1_idx` (`shop_idshop`),
  ADD KEY `fk_reportedReview_admin1_idx` (`admin_idadmin`);

--
-- Indexes for table `operatinghours`
--
ALTER TABLE `operatinghours`
  ADD PRIMARY KEY (`idoperatinghours`),
  ADD KEY `fk_operatinghours_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`idshop`),
  ADD KEY `fk_shop_shopowner1_idx` (`shopowner_idshopowner`);

--
-- Indexes for table `shopcopy`
--
ALTER TABLE `shopcopy`
  ADD PRIMARY KEY (`idshopcopy`),
  ADD KEY `fk_shop_shopowner1_idx` (`shopowner_idshopowner`),
  ADD KEY `fk_shopcopy_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopimage`
--
ALTER TABLE `shopimage`
  ADD PRIMARY KEY (`idshopimage`),
  ADD KEY `fk_shopimage_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopowner`
--
ALTER TABLE `shopowner`
  ADD PRIMARY KEY (`idshopowner`);

--
-- Indexes for table `shopproduct`
--
ALTER TABLE `shopproduct`
  ADD PRIMARY KEY (`idshopproduct`),
  ADD KEY `fk_shopproduct_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopreport`
--
ALTER TABLE `shopreport`
  ADD PRIMARY KEY (`idshopreport`),
  ADD KEY `fk_shopreport_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopreview`
--
ALTER TABLE `shopreview`
  ADD PRIMARY KEY (`idshopreview`),
  ADD KEY `fk_shopreview_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopservice`
--
ALTER TABLE `shopservice`
  ADD PRIMARY KEY (`idshopservice`),
  ADD KEY `fk_shopservice_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `adminreview`
--
ALTER TABLE `adminreview`
  MODIFY `idadminreview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operatinghours`
--
ALTER TABLE `operatinghours`
  MODIFY `idoperatinghours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `idshop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `shopcopy`
--
ALTER TABLE `shopcopy`
  MODIFY `idshopcopy` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopimage`
--
ALTER TABLE `shopimage`
  MODIFY `idshopimage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `shopowner`
--
ALTER TABLE `shopowner`
  MODIFY `idshopowner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `shopproduct`
--
ALTER TABLE `shopproduct`
  MODIFY `idshopproduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `shopreport`
--
ALTER TABLE `shopreport`
  MODIFY `idshopreport` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopreview`
--
ALTER TABLE `shopreview`
  MODIFY `idshopreview` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shopservice`
--
ALTER TABLE `shopservice`
  MODIFY `idshopservice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adminreview`
--
ALTER TABLE `adminreview`
  ADD CONSTRAINT `fk_adminreview_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adminreview_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_reportedReview_admin1` FOREIGN KEY (`admin_idadmin`) REFERENCES `admin` (`idadmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reportedReview_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operatinghours`
--
ALTER TABLE `operatinghours`
  ADD CONSTRAINT `fk_operatinghours_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `fk_shop_shopowner1` FOREIGN KEY (`shopowner_idshopowner`) REFERENCES `shopowner` (`idshopowner`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopcopy`
--
ALTER TABLE `shopcopy`
  ADD CONSTRAINT `fk_shop_shopowner10` FOREIGN KEY (`shopowner_idshopowner`) REFERENCES `shopowner` (`idshopowner`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_shopcopy_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopimage`
--
ALTER TABLE `shopimage`
  ADD CONSTRAINT `fk_shopimage_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopproduct`
--
ALTER TABLE `shopproduct`
  ADD CONSTRAINT `fk_shopproduct_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopreport`
--
ALTER TABLE `shopreport`
  ADD CONSTRAINT `fk_shopreport_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopreview`
--
ALTER TABLE `shopreview`
  ADD CONSTRAINT `fk_shopreview_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopservice`
--
ALTER TABLE `shopservice`
  ADD CONSTRAINT `fk_shopservice_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
