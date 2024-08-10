-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 10, 2024 at 11:22 AM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `saleid` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `saleid`, `productName`, `qty`, `item_price`, `selling_price`, `total_price`) VALUES
(1, 'SALE1723280087', 'Speaker', 4, '460.00', '4000.00', '16000.00'),
(2, 'SALE1723280628', 'Speaker', 2, '500.00', '450.00', '900.00'),
(3, 'SALE1723280813', 'Speaker', 6, '500.00', '440.00', '2640.00'),
(4, 'SALE1723281058', 'Speaker', 6, '500.00', '440.00', '2640.00'),
(5, 'SALE1723281571', 'Speaker', 6, '500.00', '440.00', '2640.00'),
(6, 'SALE1723281881', 'Speaker', 1, '500.00', '450.00', '450.00'),
(7, 'SALE1723282015', 'Speaker', 6, '500.00', '440.00', '2640.00'),
(8, 'SALE1723282143', 'Speaker', 6, '500.00', '440.00', '2640.00');

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
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `product_id`, `product_name`, `quantity`, `selling_price`) VALUES
(12, 25, 'Kiwi', 20, '20.00'),
(13, 25, 'Kiwi', 20, '20.00'),
(14, 25, 'Kiwi', 20, '20.00'),
(15, 26, 'sadasd', 20, '20.00'),
(16, 1, 'Speaker', 5, '440.00'),
(17, 1, 'Speaker', 10, '430.00'),
(18, 1, 'Speaker', 15, '420.00');

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
-- Table structure for table `gps`
--

CREATE TABLE `gps` (
  `id` int(11) NOT NULL,
  `saleid` varchar(255) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sim_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gps`
--

INSERT INTO `gps` (`id`, `saleid`, `app_name`, `server`, `username`, `password`, `sim_no`, `created_at`) VALUES
(1, 'SALE1723280813', 'jana', 'localhost', 'sandun', 'jana123', '112233', '2024-08-10 09:06:53'),
(2, 'SALE1723281571', 'jana', 'localhost', 'sandun', 'password', '112233', '2024-08-10 09:19:31'),
(3, 'SALE1723281881', 'jana', 'localhost', 'sandun', 'password', '112233', '2024-08-10 09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `wholesale_price` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `warranty` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `cost_price`, `wholesale_price`, `price`, `selling_price`, `stock`, `warranty`, `created_at`) VALUES
(1, 'Speakers', 'Speaker', '300.00', '258.00', '500.00', '450.00', 10, '1 year', '2024-08-04 16:57:02'),
(3, 'Subwoofer', 'Subwoofer Model A', '50.00', '0.00', '120.00', '100.00', 30, '1 year', '2024-08-05 06:36:41'),
(4, 'Subwoofer', 'Subwoofer Model B', '55.00', '0.00', '80.00', '105.00', 25, '', '2024-08-05 06:36:41'),
(5, 'Subwoofer', 'Subwoofer Model C', '60.00', '0.00', '85.00', '110.00', 20, '', '2024-08-05 06:36:41'),
(6, 'Subwoofer', 'Subwoofer Model D', '65.00', '0.00', '90.00', '115.00', 15, '', '2024-08-05 06:36:41'),
(7, 'Subwoofer', 'Subwoofer Model E', '70.00', '0.00', '95.00', '120.00', 10, '', '2024-08-05 06:36:41'),
(8, 'Subwoofer', 'Subwoofer Model F', '75.00', '0.00', '100.00', '125.00', 5, '', '2024-08-05 06:36:41'),
(9, 'Subwoofer', 'Subwoofer Model G', '80.00', '0.00', '105.00', '130.00', 12, '', '2024-08-05 06:36:41'),
(10, 'Subwoofer', 'Subwoofer Model H', '85.00', '0.00', '110.00', '135.00', 8, '', '2024-08-05 06:36:41'),
(11, 'Subwoofer', 'Subwoofer Model I', '90.00', '0.00', '115.00', '140.00', 18, '', '2024-08-05 06:36:41'),
(12, 'Subwoofer', 'Subwoofer Model J', '95.00', '0.00', '120.00', '145.00', 22, '', '2024-08-05 06:36:41'),
(13, 'Subwoofer', 'Subwoofer Model K', '100.00', '0.00', '125.00', '150.00', 17, '', '2024-08-05 06:36:41'),
(14, 'Subwoofer', 'Subwoofer Model L', '105.00', '0.00', '130.00', '155.00', 14, '', '2024-08-05 06:36:41'),
(15, 'Subwoofer', 'Subwoofer Model M', '110.00', '0.00', '135.00', '160.00', 20, '', '2024-08-05 06:36:41'),
(16, 'Subwoofer', 'Subwoofer Model N', '115.00', '0.00', '140.00', '165.00', 11, '', '2024-08-05 06:36:41'),
(17, 'Subwoofer', 'Subwoofer Model O', '120.00', '0.00', '145.00', '170.00', 13, '', '2024-08-05 06:36:41'),
(18, 'Subwoofer', 'Subwoofer Model P', '125.00', '0.00', '150.00', '175.00', 16, '', '2024-08-05 06:36:41'),
(19, 'Subwoofer', 'Subwoofer Model Q', '130.00', '0.00', '155.00', '180.00', 9, '', '2024-08-05 06:36:41'),
(20, 'Subwoofer', 'Subwoofer Model R', '135.00', '0.00', '160.00', '185.00', 23, '', '2024-08-05 06:36:41'),
(21, 'Subwoofer', 'Subwoofer Model S', '140.00', '0.00', '165.00', '190.00', 27, '', '2024-08-05 06:36:41'),
(22, 'Subwoofer', 'Subwoofer Model T', '145.00', '0.00', '170.00', '195.00', 19, '', '2024-08-05 06:36:41'),
(23, 'Head light', 'Bike Head light', '350.00', '360.00', '380.00', '360.00', 25, ' ', '2024-08-06 08:20:09'),
(24, 'Head light', 'Car Head light', '5500.00', '5600.00', '6000.00', '5800.00', 19, ' ', '2024-08-06 08:30:34'),
(25, 'Speakers', 'Kiwi', '5000.00', '5200.00', '6800.00', '6500.00', 15, '6 months', '2024-08-06 17:55:29'),
(26, 'Speakers', 'sadasd', '1551.00', '5445.00', '5454.00', '5445.00', 4545, '6 months', '2024-08-06 18:11:14'),
(27, 'Subwoofer', 'buffer2', '10000.00', '12000.00', '20000.00', '18000.00', 10000, '3 years', '2024-08-09 04:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `id` int(11) NOT NULL,
  `saleid` varchar(255) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profit`
--

INSERT INTO `profit` (`id`, `saleid`, `profit`, `date`) VALUES
(1, 'SALE1723280087', '13000.00', '2024-08-10 08:54:47'),
(2, 'SALE1723280628', '200.00', '2024-08-10 09:03:48'),
(3, 'SALE1723280813', '640.00', '2024-08-10 09:06:53'),
(4, 'SALE1723281058', '640.00', '2024-08-10 09:10:58'),
(5, 'SALE1723281571', '640.00', '2024-08-10 09:19:31'),
(6, 'SALE1723281881', '150.00', '2024-08-10 09:24:41'),
(7, 'SALE1723282015', '640.00', '2024-08-10 09:26:55'),
(8, 'SALE1723282143', '640.00', '2024-08-10 09:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `saleid` varchar(255) NOT NULL,
  `numberOfItem` int(11) NOT NULL,
  `total_Qty` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Total_Discount` decimal(10,2) NOT NULL,
  `Customer_Profit` decimal(10,2) NOT NULL,
  `subTotal` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `saleid`, `numberOfItem`, `total_Qty`, `Total`, `Total_Discount`, `Customer_Profit`, `subTotal`, `paid_amount`, `balance`, `Date`) VALUES
(1, 'SALE1723280087', 1, 4, '15000.00', '1000.00', '1000.00', '16000.00', '20000.00', '5000.00', '2024-08-10 08:54:47'),
(2, 'SALE1723280628', 1, 2, '800.00', '100.00', '100.00', '900.00', '1000.00', '200.00', '2024-08-10 09:03:48'),
(3, 'SALE1723280813', 1, 6, '2500.00', '200.00', '210.00', '2700.00', '1000.00', '-1500.00', '2024-08-10 09:06:53'),
(4, 'SALE1723281058', 1, 6, '2440.00', '200.00', '210.00', '2640.00', '5000.00', '2560.00', '2024-08-10 09:10:58'),
(5, 'SALE1723281571', 1, 6, '2440.00', '200.00', '200.00', '2640.00', '5000.00', '2560.00', '2024-08-10 09:19:31'),
(6, 'SALE1723281881', 1, 1, '450.00', '0.00', '0.00', '450.00', '55555.00', '55105.00', '2024-08-10 09:24:41'),
(7, 'SALE1723282015', 1, 6, '2440.00', '200.00', '200.00', '2640.00', '5000.00', '2560.00', '2024-08-10 09:26:55'),
(8, 'SALE1723282143', 1, 6, '2440.00', '200.00', '260.00', '2640.00', '5000.00', '2560.00', '2024-08-10 09:29:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
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
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gps`
--
ALTER TABLE `gps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gps`
--
ALTER TABLE `gps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
