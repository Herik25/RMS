-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 08:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `srno` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(4) NOT NULL,
  `ctgr` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`srno`, `name`, `image`, `price`, `ctgr`) VALUES
(1, 'burger', './images/64b0ff0838a5a_burger.jpg', 90, 'fastfood'),
(2, 'pizza', './images/64b0ff74afb5a_pizza.jpg', 180, 'fastfood'),
(3, 'pasta', './images/64b0ff84b90d4_pasta.jpg', 140, 'fastfood'),
(4, 'idly', './images/64b0ffa749aaa_idly.jpeg', 40, 'southindian'),
(5, 'hakka noodles', './images/64b0ffc43f91a_Hakka-Noodles.jpg', 120, 'chinese'),
(6, 'manchurian', './images/64b0ffec17fff_manchurian.jpg', 150, 'chinese'),
(7, 'red velvet slice', './images/64b1000dde016_red-velvet-slice.jpg', 90, 'deserts'),
(8, 'kitkat shake', './images/64b10030a8119_kitkat-shake.jpg', 160, 'drinks'),
(9, 'mendu vada', './images/64b10169a1608_mendu-vada.jpg', 40, 'southindian'),
(10, 'dosa', './images/64b101863826b_dosa.jpg', 70, 'southindian'),
(11, 'donut', './images/64b1019d12954_donut.jpg', 60, 'deserts'),
(12, 'french fries', './images/64b101b64e502_french-fries.jpg', 90, 'fastfood'),
(13, 'sandwich', './images/64b272f2a51fc_sandwich.jpg', 140, 'fastfood'),
(14, 'tacos', './images/64b27316d22f7_tacos.jpg', 80, 'fastfood'),
(15, 'burrito', './images/64b2732cbe0c6_burrito.jpg', 90, 'fastfood'),
(16, 'onion rings', './images/64b273469ef87_onion-rings.jpg', 50, 'fastfood'),
(17, 'potato bites', './images/64b2735876197_potato-bites.jpg', 60, 'fastfood'),
(18, 'nacho mix', './images/64b2736d961e1_nacho-mix.jpg', 100, 'fastfood'),
(19, 'rava dosa', './images/64b27386d3220_rava-dosa.jpg', 60, 'southindian'),
(20, 'rava idly', './images/64b27395deefc_rava-idly.jpg', 40, 'southindian'),
(21, 'uttapam', './images/64b273a6a0607_uttapam.JPG', 170, 'southindian'),
(22, 'cold coco', './images/64b274751bdd8_cold-coco.jpg', 70, 'drinks'),
(23, 'masala dosa', './images/64b274c007220_masala dosa.jpg', 100, 'southindian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `srno` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
