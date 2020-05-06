-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2020 at 07:27 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `daycare`
--

-- --------------------------------------------------------

--
-- Table structure for table `fieldtrips`
--

CREATE TABLE `fieldtrips` (
  `fieldtripID` int(11) NOT NULL,
  `location` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `tripdate` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `staffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fieldtrips`
--

INSERT INTO `fieldtrips` (`fieldtripID`, `location`, `description`, `tripdate`, `starttime`, `endtime`, `staffID`) VALUES
(1, 'Ontario Science Centre', '', '2020-04-08', '10:00:00', '14:00:00', 3),
(2, 'Ripley\'s Aquarium', 'An opportunity for kids to the explore the underwater world.', '2020-04-17', '11:00:00', '15:00:00', 2),
(3, 'Playground', 'Daycare Park', '2020-05-27', '10:00:00', '12:00:00', 3),
(4, 'Playground', 'Test', '2020-05-29', '10:00:00', '12:00:00', 4),
(5, 'Waterpark', 'Waterpark - Public Pool', '2020-06-30', '14:00:00', '15:00:00', 4),
(6, 'Water Park', 'Wave pool', '2020-04-30', '09:00:00', '11:00:00', 14),
(11, 'Splash Pad', 'Come join us in the splash pad!', '2020-04-30', '10:00:00', '12:00:00', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fieldtrips`
--
ALTER TABLE `fieldtrips`
  ADD PRIMARY KEY (`fieldtripID`),
  ADD KEY `staffID` (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fieldtrips`
--
ALTER TABLE `fieldtrips`
  MODIFY `fieldtripID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fieldtrips`
--
ALTER TABLE `fieldtrips`
  ADD CONSTRAINT `fieldtrips_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `staff_directory` (`staffID`);
