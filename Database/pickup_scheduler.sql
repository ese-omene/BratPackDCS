-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 05:02 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daycare`
--

-- --------------------------------------------------------

--
-- Table structure for table `pickup_scheduler`
--

CREATE TABLE `pickup_scheduler` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `child_first_name` varchar(50) NOT NULL,
  `child_last_name` varchar(50) NOT NULL,
  `pickup_first_name` varchar(50) NOT NULL,
  `pickup_last_name` varchar(50) NOT NULL,
  `pickup_phone_number` varchar(10) NOT NULL,
  `pickup_email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pickup_scheduler`
--

INSERT INTO `pickup_scheduler` (`id`, `date`, `child_first_name`, `child_last_name`, `pickup_first_name`, `pickup_last_name`, `pickup_phone_number`, `pickup_email`) VALUES
(1, '2020-02-18', 'Emma', 'Swan', 'Elizabeth', 'Macias', '6641256373', ''),
(3, '2020-02-21', 'Snow', 'White', 'Alexa', 'Perez', '6641863999', ''),
(4, '2020-04-09', 'Emma', 'Swan', 'Alexa', 'Perez', '6473451818', 'em@email.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pickup_scheduler`
--
ALTER TABLE `pickup_scheduler`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pickup_scheduler`
--
ALTER TABLE `pickup_scheduler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
