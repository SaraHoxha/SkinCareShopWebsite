-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2022 at 08:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SkincareShopDB`
--
CREATE DATABASE IF NOT EXISTS `SkincareShopDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `SkincareShopDB`;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
CREATE TABLE `Customer` (
  `CustomerId` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `PersonalCardId` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Passwrd` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `PostalCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `OrderItem`
--

DROP TABLE IF EXISTS `OrderItem`;
CREATE TABLE `OrderItem` (
  `OrderItemId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `RequestedDate` date DEFAULT NULL,
  `ShipDate` date DEFAULT NULL,
  `OrderState` varchar(15) DEFAULT NULL,
  `QuantityOrdered` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `OrderPayment`
--

DROP TABLE IF EXISTS `OrderPayment`;
CREATE TABLE `OrderPayment` (
  `OrderPaymentId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `OrderItemId` int(11) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `TotalAmount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
CREATE TABLE `Product` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `ProductBrand` int(11) DEFAULT NULL,
  `Picture` mediumblob DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL,
  `QuantityAvailable` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CustomerId`),
  ADD UNIQUE KEY `PersonalCardId` (`PersonalCardId`),
  ADD UNIQUE KEY `Passwrd` (`Passwrd`);

--
-- Indexes for table `OrderItem`
--
ALTER TABLE `OrderItem`
  ADD PRIMARY KEY (`OrderItemId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `OrderPayment`
--
ALTER TABLE `OrderPayment`
  ADD PRIMARY KEY (`OrderPaymentId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `OrderItemId` (`OrderItemId`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ProductId`),
  ADD UNIQUE KEY `ProductBrand` (`ProductBrand`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `OrderItem`
--
ALTER TABLE `OrderItem`
  MODIFY `OrderItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `OrderPayment`
--
ALTER TABLE `OrderPayment`
  MODIFY `OrderPaymentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `OrderItem`
--
ALTER TABLE `OrderItem`
  ADD CONSTRAINT `OrderItem_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `Customer` (`CustomerId`),
  ADD CONSTRAINT `OrderItem_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `Product` (`ProductId`);

--
-- Constraints for table `OrderPayment`
--
ALTER TABLE `OrderPayment`
  ADD CONSTRAINT `OrderPayment_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `Customer` (`CustomerId`),
  ADD CONSTRAINT `OrderPayment_ibfk_2` FOREIGN KEY (`OrderItemId`) REFERENCES `OrderItem` (`OrderItemId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
