-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2018 at 09:17 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carneedsfinder_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `firstname`, `lastname`, `email`, `password`, `address`, `birthday`, `number`, `image`, `activation`) VALUES
(2, 'Fhilip', 'Fernandez', 'fhilipfernandez@yahoo.com', '12345', 'Cabanatuan City', '1999-07-09', '09568850144', '20180708020211Q3sK53RF.jpeg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `adminreview`
--

CREATE TABLE IF NOT EXISTS `adminreview` (
`idadminreview` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `adminreview`
--

INSERT INTO `adminreview` (`idadminreview`, `comment`, `shop_idshop`) VALUES
(3, 'asdada', 4);

-- --------------------------------------------------------

--
-- Table structure for table `operatinghours`
--

CREATE TABLE IF NOT EXISTS `operatinghours` (
`idoperatinghours` int(11) NOT NULL,
  `opening` time NOT NULL,
  `closing` time NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
`idshop` int(11) NOT NULL,
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
  `activation` varchar(10) NOT NULL,
  `businesspermitno` varchar(40) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`idshop`, `shopname`, `address`, `phonenumber`, `telephonenumber`, `description`, `latitude`, `longitude`, `website`, `facebook`, `shopowner_idshopowner`, `shoptype`, `shopicon`, `activation`, `businesspermitno`) VALUES
(1, 'Radz', 'San Juan ACCFA, Maharlika Highway, Cabanatuan City, 3100 Nueva Ecija', '09512345678', '', 'Radz Car Wash', '15.471921073725008', '120.95576785228718', 'www.radzcar.com', 'https://www.facebook.com/radzcarwash/', 1, 'Car Accessories,Car Wash', '20180704110318radz.jpg', 'Active', '1558-556-5654'),
(2, 'dsadadasdadadad asadadadadaddadsa dadadadadadadadada ', '32 Abigail St Kapitan Pepe cabanatauan city', '09124567897', '55487888', 'sadadadadaddadsds,amd,landk,lahnkjdjhakldjhakjdhkajhdkjahdkj jahsdkjhakjshdkjahdakam,sdmadnalmkndlkj', '15.481201599999997', '120.95298569999999', 'dasdad', 'adsada', 1, 'Car Accessories,Car Wash,Car Aircon', '20180705011430shutterstock-540056203.jpg', 'Inactive', 'dsadad'),
(3, 'Test', 'Test', '09123456789', '245454545', 'Test', '15.4911519', '120.9673198', 'Test', 'Test', 1, 'Auto Mechanic,Car Aircon', '20180707035352file-png.png', 'Active', '5545454545'),
(4, 'dasdadada', 'Cabanatuan City', '121212', '12121', 'dasdada', '', '', 'dsadad', 'adadada', 1, 'Car Accessories,Car Aircon', '20180709012651shutterstock-540056203.jpg', 'Inactive', 'dsadada'),
(5, 'dasdadada', 'Cabanatuan City', '121212', '12121', 'dasdada', '', '', 'dsadad', 'adadada', 1, 'Car Accessories,Car Aircon', '20180709012701shutterstock-540056203.jpg', 'Active', 'dsadada');

-- --------------------------------------------------------

--
-- Table structure for table `shopimage`
--

CREATE TABLE IF NOT EXISTS `shopimage` (
  `idshopimage` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shopowner`
--

CREATE TABLE IF NOT EXISTS `shopowner` (
`idshopowner` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `usernumber` varchar(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `shopowner`
--

INSERT INTO `shopowner` (`idshopowner`, `firstname`, `lastname`, `email`, `password`, `address`, `birthday`, `usernumber`) VALUES
(1, 'Fhilip', 'Fernandez', 'fhilipfernandez@yahoo.com', '12345', 'Cabanatuan City', '1999-02-09', '09568850144');

-- --------------------------------------------------------

--
-- Table structure for table `shopproduct`
--

CREATE TABLE IF NOT EXISTS `shopproduct` (
`idshopproduct` int(11) NOT NULL,
  `product` varchar(45) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` varchar(12) DEFAULT NULL,
  `image` varchar(100) NOT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shopreview`
--

CREATE TABLE IF NOT EXISTS `shopreview` (
`idshopreview` int(11) NOT NULL,
  `comment` varchar(45) NOT NULL,
  `rate` int(11) NOT NULL,
  `shop_idshop` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shopservice`
--

CREATE TABLE IF NOT EXISTS `shopservice` (
  `idshopservice` int(11) NOT NULL,
  `service` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  `shop_idshop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`iduser` int(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(25) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phonenumber` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
 ADD PRIMARY KEY (`idadminreview`), ADD KEY `fk_adminreview_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `operatinghours`
--
ALTER TABLE `operatinghours`
 ADD PRIMARY KEY (`idoperatinghours`), ADD KEY `fk_operatinghours_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
 ADD PRIMARY KEY (`idshop`), ADD KEY `fk_shop_shopowner1_idx` (`shopowner_idshopowner`);

--
-- Indexes for table `shopimage`
--
ALTER TABLE `shopimage`
 ADD PRIMARY KEY (`idshopimage`), ADD KEY `fk_shopimage_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopowner`
--
ALTER TABLE `shopowner`
 ADD PRIMARY KEY (`idshopowner`);

--
-- Indexes for table `shopproduct`
--
ALTER TABLE `shopproduct`
 ADD PRIMARY KEY (`idshopproduct`), ADD KEY `fk_shopproduct_shop1_idx` (`shop_idshop`);

--
-- Indexes for table `shopreview`
--
ALTER TABLE `shopreview`
 ADD PRIMARY KEY (`idshopreview`), ADD KEY `fk_shopreview_shop1_idx` (`shop_idshop`), ADD KEY `fk_shopreview_user1_idx` (`user_iduser`);

--
-- Indexes for table `shopservice`
--
ALTER TABLE `shopservice`
 ADD PRIMARY KEY (`idshopservice`), ADD KEY `fk_shopservice_shop1_idx` (`shop_idshop`);

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
MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `adminreview`
--
ALTER TABLE `adminreview`
MODIFY `idadminreview` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `operatinghours`
--
ALTER TABLE `operatinghours`
MODIFY `idoperatinghours` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
MODIFY `idshop` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `shopowner`
--
ALTER TABLE `shopowner`
MODIFY `idshopowner` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shopproduct`
--
ALTER TABLE `shopproduct`
MODIFY `idshopproduct` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shopreview`
--
ALTER TABLE `shopreview`
MODIFY `idshopreview` int(11) NOT NULL AUTO_INCREMENT;
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
ADD CONSTRAINT `fk_adminreview_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Constraints for table `shopreview`
--
ALTER TABLE `shopreview`
ADD CONSTRAINT `fk_shopreview_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_shopreview_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopservice`
--
ALTER TABLE `shopservice`
ADD CONSTRAINT `fk_shopservice_shop1` FOREIGN KEY (`shop_idshop`) REFERENCES `shop` (`idshop`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
