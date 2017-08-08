-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2017 at 06:44 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `data_ads`
--

CREATE TABLE `data_ads` (
  `AdsID` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Embed` text,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Amount` double NOT NULL,
  `Viewer` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_company`
--

CREATE TABLE `data_company` (
  `CompanyID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_ads`
--
ALTER TABLE `data_ads`
  ADD PRIMARY KEY (`AdsID`),
  ADD KEY `AdsID` (`AdsID`),
  ADD KEY `CompanyID` (`CompanyID`),
  ADD KEY `Title` (`Title`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `Created_at` (`Created_at`),
  ADD KEY `Username` (`Username`) USING BTREE,
  ADD KEY `EndDate` (`EndDate`);

--
-- Indexes for table `data_company`
--
ALTER TABLE `data_company`
  ADD PRIMARY KEY (`CompanyID`),
  ADD KEY `CompanyID` (`CompanyID`),
  ADD KEY `Name` (`Name`),
  ADD KEY `Phone` (`Phone`),
  ADD KEY `Email` (`Email`),
  ADD KEY `Website` (`Website`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `Created_at` (`Created_at`),
  ADD KEY `Username` (`Username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_ads`
--
ALTER TABLE `data_ads`
  MODIFY `AdsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_company`
--
ALTER TABLE `data_company`
  MODIFY `CompanyID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_ads`
--
ALTER TABLE `data_ads`
  ADD CONSTRAINT `data_ads_ibfk_1` FOREIGN KEY (`CompanyID`) REFERENCES `data_company` (`CompanyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_ads_ibfk_2` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_ads_ibfk_3` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_company`
--
ALTER TABLE `data_company`
  ADD CONSTRAINT `data_company_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_company_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
