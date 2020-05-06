-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 13, 2020 at 04:54 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_bin NOT NULL,
  `description` varchar(255) COLLATE latin1_bin NOT NULL,
  `dietid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `dietid`) VALUES
(1, 'Chicken alfredo', 'pasta with a creamy sauce', 0),
(2, 'PB&J', 'peanut butter and jelly sandwiches on whole wheat bread', 0),
(3, 'Spaghetti and Meatballs', 'beef and sausage meatballs with a marinara sauce.  whole wheat noodles', 0),
(7, 'Spicy Curry Chicken ', 'Lightly spiced chicken thighs with rice and peas. Veggies on the side', 0),
(8, 'Tex Mex Chili', 'Mixed ground beef and chicken chili, with chunky tomatoes and mixed beans, very yummy! Yogurt on the side', 0),
(9, 'Charcuterie Board!', 'Mix of meats, cheeses, grapes and more.  Your child deserves to be as fancy as you :-) Figs and mangosteen side options!  Picnic options (Weather dependent)', 0),
(10, 'Grilled Chicken burgers', 'Exactly as described.\r\n\r\nWe get fries too!\r\nIf you\'d like cheese we can do that too!', 0),
(11, 'Jamacian Patties!', 'Options of mild or medium flavor filled patties.  Side of fruit punch and pineapples!', 1),
(14, 'Perogies and Polish Sausage', 'Traditional back home dish.  Fried perogies and spicy sausages!!', 1),
(15, 'Kidney Bean Casaroll', 'Penne, meatballs blended with kidney beans for extra fibre.  Extra creamy rose sause with faux cheese, cauliflower toppings. ', 1),
(16, 'Ham and Cheese Sandwich', 'Exactly what it says', 1),
(23, 'Rice and Peas', 'Brown rice with kidney beans', 2),
(25, 'Chicken Fajita', 'Grilled chicken on a whole wheat wrap.  Satueed veggies', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dietid` (`dietid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
