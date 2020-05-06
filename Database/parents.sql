-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2020 at 07:02 AM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bratpack`
--

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `address` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`id`, `first_name`, `last_name`, `address`, `email`, `phone`) VALUES
(1, 'John', 'Martin', '12 Willow Dr', 'john@martin.com', '123-456-7891'),
(2, 'Anne', 'Parrish', '46 Main Street', 'anne@test.com', '555-012-3456'),
(3, 'Joan', 'Ryder', '78 Flynn Ave', 'joan@test.com', '555-111-2222'),
(4, 'Hellen', 'Heath', '129 Hunter Drive', 'hellen@test.com', '987-654-1234'),
(5, 'Allen', 'Mcclain', '79 Main Street', 'allen@test.com', '876-098-2453'),
(6, 'Alice', 'Green', '789 King Street', 'alice@test.com', '999-098-7654'),
(7, 'Lisa', 'Smith', '76 Queen Street', 'lisa@example.com', '907-789-5799'),
(8, 'Shane', 'Austin', '999 Fifth Ave', 'shane@example.com', '876-988-2134'),
(9, 'Jeremy', 'Gates', '876 Bloom Court', 'jeremy@example.com', '123-333-4444');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
