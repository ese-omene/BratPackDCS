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
-- Table structure for table `staff_directory`
--

CREATE TABLE `staff_directory` (
  `staffID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `jobtitle` varchar(50) NOT NULL,
  `photo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_directory`
--

INSERT INTO `staff_directory` (`staffID`, `firstname`, `lastname`, `email`, `phone`, `jobtitle`, `photo`) VALUES
(2, 'Susan', 'Boratynska', 'susan.boratynska@gmail.com', '6134008924', 'Child Care Worker', 'images/staffdirectory/avatar.png'),
(3, 'Kevin', 'Tran', 'k.tran11@hotmail.com', '6133042201', 'Child Care Worker', 'images/staffdirectory/Amir.png'),
(4, 'Yi', 'Boratynska', 'yi.borat@yahoo.com', '4166375201', 'Administrator', 'images/staffdirectory/Derek.png'),
(6, 'Leona', 'Liu', 'leona.liu@gmail.com', '1231231255', 'Administrator', 'images/staffdirectory/Amir.png'),
(7, 'Angela', 'Lopez', 'susan.boratynska@gmail.com', '6134008924', 'Caretaker', 'images/staffdirectory/Angela.png'),
(8, 'Sean', 'Szeto', 'test@test.com', '1231231234', 'Caretaker', 'images/staffdirectory/Sean.png'),
(10, 'Natalie', 'Lewins', 'natlewins@test.com', '6134008924', 'Administrator', 'images/staffdirectory/Tabitha.png'),
(11, 'Tabitha', 'Bowling', 'tb@test.com', '6134008924', 'Child Care Worker', 'images/staffdirectory/Tabitha.png'),
(12, 'Marilyn ', 'Kehl', 'mk@mk.com', '6134008924', 'Caretaker', 'images/staffdirectory/Natalie.png'),
(13, 'Patrick', 'Keene', 'PK@pk.com', '6134008924', 'Administrator', 'images/staffdirectory/Derek.png'),
(14, 'Rachel', 'Blais', 'rb@rb.com', '1231231234', 'Administrator', 'images/staffdirectory/Tabitha.png'),
(29, 'Susan', 'Boratynska', 'susan.boratynska@gmail.com', '6134008924', 'Caretaker', 'images/staffdirectory/avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff_directory`
--
ALTER TABLE `staff_directory`
  ADD PRIMARY KEY (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff_directory`
--
ALTER TABLE `staff_directory`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
