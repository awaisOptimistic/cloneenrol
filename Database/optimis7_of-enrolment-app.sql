-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2021 at 08:17 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optimis7_of-enrolment-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `demographics`
--

CREATE TABLE `demographics` (
  `id` int(11) NOT NULL,
  `employmentStatus` int(32) NOT NULL,
  `employmentRole` int(32) NOT NULL,
  `employmentSector` int(32) NOT NULL,
  `schoolingStatus` varchar(4) NOT NULL,
  `schoolingLevel` int(32) DEFAULT NULL,
  `schoolingLevelYear` varchar(14) NOT NULL,
  `birthCountry` int(32) NOT NULL,
  `speakEnglish` int(32) NOT NULL,
  `speakStatus` int(32) NOT NULL,
  `TSIorigin` int(32) NOT NULL,
  `disability` int(32) NOT NULL,
  `usrid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demographics`
--

INSERT INTO `demographics` (`id`, `employmentStatus`, `employmentRole`, `employmentSector`, `schoolingStatus`, `schoolingLevel`, `schoolingLevelYear`, `birthCountry`, `speakEnglish`, `speakStatus`, `TSIorigin`, `disability`, `usrid`) VALUES
(20, 2, 6, 7, 'Yes', 6, '2011', 916, 114, 1, 4, 3, 38),
(21, 3, 2, 19, 'Yes', 7, '2014', 92, 114, 3, 2, 2, 39);

-- --------------------------------------------------------

--
-- Table structure for table `disability`
--

CREATE TABLE `disability` (
  `id` int(11) NOT NULL,
  `disabilityCondition` int(32) DEFAULT NULL,
  `usrid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disability`
--

INSERT INTO `disability` (`id`, `disabilityCondition`, `usrid`) VALUES
(5, 4, 39),
(6, 9, 39),
(7, 4, 38);

-- --------------------------------------------------------

--
-- Table structure for table `localnextofkin`
--

CREATE TABLE `localnextofkin` (
  `id` int(11) NOT NULL,
  `relationname` varchar(20) NOT NULL,
  `relationship` int(32) NOT NULL,
  `relationhomeNumber` varchar(20) NOT NULL,
  `relationmobile` varchar(20) NOT NULL,
  `usrid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `localnextofkin`
--

INSERT INTO `localnextofkin` (`id`, `relationname`, `relationship`, `relationhomeNumber`, `relationmobile`, `usrid`) VALUES
(17, 'Ammad', 42, '0415555569', '425555555', 38),
(18, 'rana', 51, '0142225555', '415556565', 39);

-- --------------------------------------------------------

--
-- Table structure for table `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genderDetails` int(32) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `residentialAddress` varchar(255) NOT NULL,
  `suburbtown` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `postalAddress` varchar(255) NOT NULL,
  `homePhone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `noVSN` varchar(9) DEFAULT NULL,
  `usi` varchar(10) DEFAULT NULL,
  `concessionCard` varchar(20) NOT NULL,
  `concessionExpiry` varchar(20) NOT NULL,
  `std_id` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personal`
--

INSERT INTO `personal` (`id`, `title`, `genderDetails`, `firstname`, `middlename`, `lastname`, `dob`, `residentialAddress`, `suburbtown`, `state`, `postcode`, `postalAddress`, `homePhone`, `mobile`, `fax`, `email`, `noVSN`, `usi`, `concessionCard`, `concessionExpiry`, `std_id`) VALUES
(38, 'Mrs.', 4, 'waleed', '', 'ali', '07/01/2021', ' 2 king street', 'Broadmeadows', 4, 3048, '2 copper lane hadfield', '(042) 222-5555', '(042) 555-5555', '04255555569', 'waleed@gmail.com', '', '454484512', '2121217847', '07/14/2021', 'OF0006'),
(39, 'Mr.', 1, 'Awais ', '', 'Ahmed', '07/24/2001', ' 8 center road ', 'broadmeadows', 4, 3047, '8 center road broadmeadows VIC', '(047) 478-5457', '(042) 545-6977', '55874125', 'Awais@gmail.com', '', '54ad454545', '45464845G', '07/05/2023', 'OF0003');

-- --------------------------------------------------------

--
-- Table structure for table `previousqualification`
--

CREATE TABLE `previousqualification` (
  `id` int(11) NOT NULL,
  `qualificationName` int(32) NOT NULL,
  `qualificationType` int(32) NOT NULL,
  `usrid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `previousqualification`
--

INSERT INTO `previousqualification` (`id`, `qualificationName`, `qualificationType`, `usrid`) VALUES
(31, 7, 1, 38),
(32, 6, 2, 38),
(33, 7, 2, 38),
(34, 6, 3, 39),
(35, 1, 1, 39);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demographics`
--
ALTER TABLE `demographics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usrid` (`usrid`);

--
-- Indexes for table `disability`
--
ALTER TABLE `disability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usrid` (`usrid`);

--
-- Indexes for table `localnextofkin`
--
ALTER TABLE `localnextofkin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usrid` (`usrid`);

--
-- Indexes for table `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previousqualification`
--
ALTER TABLE `previousqualification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usrid` (`usrid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demographics`
--
ALTER TABLE `demographics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `disability`
--
ALTER TABLE `disability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `localnextofkin`
--
ALTER TABLE `localnextofkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `previousqualification`
--
ALTER TABLE `previousqualification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `demographics`
--
ALTER TABLE `demographics`
  ADD CONSTRAINT `demographics_ibfk_1` FOREIGN KEY (`usrid`) REFERENCES `personal` (`id`);

--
-- Constraints for table `disability`
--
ALTER TABLE `disability`
  ADD CONSTRAINT `disability_ibfk_1` FOREIGN KEY (`usrid`) REFERENCES `personal` (`id`);

--
-- Constraints for table `localnextofkin`
--
ALTER TABLE `localnextofkin`
  ADD CONSTRAINT `localnextofkin_ibfk_1` FOREIGN KEY (`usrid`) REFERENCES `personal` (`id`);

--
-- Constraints for table `previousqualification`
--
ALTER TABLE `previousqualification`
  ADD CONSTRAINT `previousqualification_ibfk_1` FOREIGN KEY (`usrid`) REFERENCES `personal` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
