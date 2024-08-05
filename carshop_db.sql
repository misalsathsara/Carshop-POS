-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 05, 2024 at 07:17 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Speakers'),
(2, 'Subwoofer'),
(3, 'Head light');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`) VALUES
(1, 'Sanindu Dewsith', '0775412357'),
(2, 'Ranuga', '0775285044'),
(3, 'ushan', '123'),
(4, 'mama', '123'),
(5, 'ushan', '123'),
(6, 'mama', '123');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `Name`, `password`) VALUES
(1, 'sandun', '123');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `cost_price`, `price`, `selling_price`, `stock`, `created_at`) VALUES
(1, 'Speakers', 'Speaker', '500.00', '460.00', '450.00', 20, '2024-08-04 16:57:02'),
(3, 'Subwoofer', 'Subwoofer Model A', '50.00', '75.00', '100.00', 30, '2024-08-05 06:36:41'),
(4, 'Subwoofer', 'Subwoofer Model B', '55.00', '80.00', '105.00', 25, '2024-08-05 06:36:41'),
(5, 'Subwoofer', 'Subwoofer Model C', '60.00', '85.00', '110.00', 20, '2024-08-05 06:36:41'),
(6, 'Subwoofer', 'Subwoofer Model D', '65.00', '90.00', '115.00', 15, '2024-08-05 06:36:41'),
(7, 'Subwoofer', 'Subwoofer Model E', '70.00', '95.00', '120.00', 10, '2024-08-05 06:36:41'),
(8, 'Subwoofer', 'Subwoofer Model F', '75.00', '100.00', '125.00', 5, '2024-08-05 06:36:41'),
(9, 'Subwoofer', 'Subwoofer Model G', '80.00', '105.00', '130.00', 12, '2024-08-05 06:36:41'),
(10, 'Subwoofer', 'Subwoofer Model H', '85.00', '110.00', '135.00', 8, '2024-08-05 06:36:41'),
(11, 'Subwoofer', 'Subwoofer Model I', '90.00', '115.00', '140.00', 18, '2024-08-05 06:36:41'),
(12, 'Subwoofer', 'Subwoofer Model J', '95.00', '120.00', '145.00', 22, '2024-08-05 06:36:41'),
(13, 'Subwoofer', 'Subwoofer Model K', '100.00', '125.00', '150.00', 17, '2024-08-05 06:36:41'),
(14, 'Subwoofer', 'Subwoofer Model L', '105.00', '130.00', '155.00', 14, '2024-08-05 06:36:41'),
(15, 'Subwoofer', 'Subwoofer Model M', '110.00', '135.00', '160.00', 20, '2024-08-05 06:36:41'),
(16, 'Subwoofer', 'Subwoofer Model N', '115.00', '140.00', '165.00', 11, '2024-08-05 06:36:41'),
(17, 'Subwoofer', 'Subwoofer Model O', '120.00', '145.00', '170.00', 13, '2024-08-05 06:36:41'),
(18, 'Subwoofer', 'Subwoofer Model P', '125.00', '150.00', '175.00', 16, '2024-08-05 06:36:41'),
(19, 'Subwoofer', 'Subwoofer Model Q', '130.00', '155.00', '180.00', 9, '2024-08-05 06:36:41'),
(20, 'Subwoofer', 'Subwoofer Model R', '135.00', '160.00', '185.00', 23, '2024-08-05 06:36:41'),
(21, 'Subwoofer', 'Subwoofer Model S', '140.00', '165.00', '190.00', 27, '2024-08-05 06:36:41'),
(22, 'Subwoofer', 'Subwoofer Model T', '145.00', '170.00', '195.00', 19, '2024-08-05 06:36:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
