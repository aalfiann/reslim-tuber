-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 02:03 PM
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
-- Table structure for table `core_status`
--

CREATE TABLE `core_status` (
  `StatusID` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_status`
--

INSERT INTO `core_status` (`StatusID`, `Status`) VALUES
(1, 'active'),
(2, 'allocated'),
(3, 'approved'),
(4, 'authorized'),
(5, 'banned'),
(6, 'blank'),
(7, 'canceled'),
(8, 'checked'),
(9, 'closed'),
(10, 'commented'),
(11, 'compared'),
(12, 'deleted'),
(13, 'disabled'),
(14, 'downloaded'),
(15, 'edited'),
(16, 'enabled'),
(17, 'error'),
(18, 'expired'),
(19, 'failed'),
(20, 'hidden'),
(21, 'installed'),
(22, 'listed'),
(23, 'locked'),
(24, 'maintenance'),
(25, 'merged'),
(26, 'moved'),
(27, 'ok'),
(28, 'on hold'),
(29, 'on process'),
(30, 'on request'),
(31, 'open'),
(32, 'outstanding'),
(33, 'overdue'),
(34, 'paid'),
(35, 'pending'),
(36, 'registered'),
(37, 'rejected'),
(38, 'removed'),
(39, 'signed'),
(40, 'stopped'),
(41, 'success'),
(42, 'suspended'),
(43, 'unauthorized'),
(44, 'unknown'),
(45, 'uploaded'),
(46, 'viewed'),
(47, 'void'),
(48, 'waiting'),
(49, 'public'),
(50, 'private'),
(51, 'publish'),
(52, 'draft');

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

-- --------------------------------------------------------

--
-- Table structure for table `data_liked`
--

CREATE TABLE `data_liked` (
  `LikeID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `IP` varchar(50) NOT NULL,
  `Liked` int(11) NOT NULL,
  `Disliked` int(11) NOT NULL,
  `Created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_post`
--

CREATE TABLE `data_post` (
  `PostID` int(11) NOT NULL,
  `Image` varchar(500) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Embed_video` text NOT NULL,
  `Duration` time NOT NULL,
  `Stars` varchar(500) DEFAULT NULL,
  `Cast` varchar(500) DEFAULT NULL,
  `Director` varchar(250) DEFAULT NULL,
  `Tags` varchar(500) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `Released` int(4) DEFAULT NULL,
  `Rating` decimal(2,1) NOT NULL DEFAULT '0.0',
  `Liked` int(11) NOT NULL,
  `Disliked` int(11) NOT NULL,
  `StatusID` int(11) DEFAULT NULL,
  `Viewer` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Username` varchar(50) NOT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_report`
--

CREATE TABLE `data_report` (
  `ReportID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Issue` varchar(500) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_api`
--

CREATE TABLE `user_api` (
  `Domain` varchar(50) NOT NULL,
  `ApiKey` varchar(255) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Username` varchar(50) NOT NULL,
  `Updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE `user_auth` (
  `Username` varchar(50) NOT NULL,
  `RS_Token` varchar(255) NOT NULL,
  `Created` datetime NOT NULL,
  `Expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Fullname` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Aboutme` varchar(255) DEFAULT NULL,
  `Avatar` text,
  `RoleID` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`UserID`, `Username`, `Password`, `Fullname`, `Address`, `Phone`, `Email`, `Aboutme`, `Avatar`, `RoleID`, `StatusID`, `Created_at`, `Updated_at`) VALUES
(1, 'reslim', '$2y$11$D9ZWJOhKvLoor7RyUA70hOVzbwJ9RA.nk909QLENotxq26F6k/Qxu', 'Master', 'INDONESIA', '12345', 'your@yourdomain.com', 'Master of reSlim Project', '', 1, 1, '2016-12-28 20:17:12', '2016-12-28 20:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_forgot`
--

CREATE TABLE `user_forgot` (
  `Email` varchar(50) NOT NULL,
  `Verifylink` varchar(255) NOT NULL,
  `Created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Expired` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `RoleID` int(11) NOT NULL,
  `Role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`RoleID`, `Role`) VALUES
(1, 'superuser'),
(2, 'admin'),
(3, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `user_upload`
--

CREATE TABLE `user_upload` (
  `ItemID` int(11) NOT NULL,
  `Date_Upload` datetime NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Alternate` varchar(255) DEFAULT NULL,
  `External_link` varchar(255) DEFAULT NULL,
  `Filename` varchar(255) NOT NULL,
  `Filepath` varchar(255) NOT NULL,
  `Filetype` varchar(255) NOT NULL,
  `Filesize` double NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL,
  `StatusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `core_status`
--
ALTER TABLE `core_status`
  ADD PRIMARY KEY (`StatusID`),
  ADD KEY `StatusID` (`StatusID`) USING BTREE;

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
-- Indexes for table `data_liked`
--
ALTER TABLE `data_liked`
  ADD PRIMARY KEY (`LikeID`),
  ADD KEY `LikeID` (`LikeID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `IP` (`IP`);

--
-- Indexes for table `data_post`
--
ALTER TABLE `data_post`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `Title` (`Title`),
  ADD KEY `Duration` (`Duration`),
  ADD KEY `Stars` (`Stars`),
  ADD KEY `Cast` (`Cast`),
  ADD KEY `Director` (`Director`),
  ADD KEY `Tags` (`Tags`),
  ADD KEY `Country` (`Country`),
  ADD KEY `Rating` (`Rating`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `Created_at` (`Created_at`),
  ADD KEY `PostID` (`PostID`) USING BTREE,
  ADD KEY `Username` (`Username`) USING BTREE,
  ADD KEY `Released` (`Released`) USING BTREE;

--
-- Indexes for table `data_report`
--
ALTER TABLE `data_report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `ReportID` (`ReportID`),
  ADD KEY `PostID` (`PostID`),
  ADD KEY `Email` (`Email`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `Created_at` (`Created_at`),
  ADD KEY `IP` (`IP`),
  ADD KEY `Fullname` (`Fullname`) USING BTREE;

--
-- Indexes for table `user_api`
--
ALTER TABLE `user_api`
  ADD PRIMARY KEY (`Domain`),
  ADD KEY `Domain` (`Domain`),
  ADD KEY `StatusID` (`StatusID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `ApiKey` (`ApiKey`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`Username`,`RS_Token`),
  ADD KEY `token` (`Username`,`RS_Token`,`Expired`) USING BTREE;

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`UserID`,`Username`),
  ADD KEY `user_data_ibfk_1` (`StatusID`),
  ADD KEY `user_data_ibfk_2` (`RoleID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `Fullname` (`Fullname`) USING BTREE,
  ADD KEY `Password` (`Password`),
  ADD KEY `Email` (`Email`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `user_forgot`
--
ALTER TABLE `user_forgot`
  ADD PRIMARY KEY (`Email`,`Verifylink`),
  ADD KEY `Email` (`Email`),
  ADD KEY `Verifylink` (`Verifylink`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`RoleID`),
  ADD KEY `ID` (`RoleID`);

--
-- Indexes for table `user_upload`
--
ALTER TABLE `user_upload`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `Date_Upload` (`Date_Upload`),
  ADD KEY `Filename` (`Filename`),
  ADD KEY `Filetype` (`Filetype`),
  ADD KEY `Username` (`Username`) USING BTREE,
  ADD KEY `StatusID` (`StatusID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `core_status`
--
ALTER TABLE `core_status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
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
-- AUTO_INCREMENT for table `data_liked`
--
ALTER TABLE `data_liked`
  MODIFY `LikeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_post`
--
ALTER TABLE `data_post`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_report`
--
ALTER TABLE `data_report`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_upload`
--
ALTER TABLE `user_upload`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;
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

--
-- Constraints for table `data_liked`
--
ALTER TABLE `data_liked`
  ADD CONSTRAINT `data_liked_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `data_post` (`PostID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_post`
--
ALTER TABLE `data_post`
  ADD CONSTRAINT `data_post_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_post_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_report`
--
ALTER TABLE `data_report`
  ADD CONSTRAINT `data_report_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `data_post` (`PostID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `data_report_ibfk_2` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_api`
--
ALTER TABLE `user_api`
  ADD CONSTRAINT `user_api_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_api_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD CONSTRAINT `user_token` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_data_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `user_role` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_forgot`
--
ALTER TABLE `user_forgot`
  ADD CONSTRAINT `user_forgot_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user_data` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_upload`
--
ALTER TABLE `user_upload`
  ADD CONSTRAINT `user_upload_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_upload_ibfk_2` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
