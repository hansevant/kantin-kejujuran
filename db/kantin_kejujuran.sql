-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2022 at 12:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantin_kejujuran`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_box`
--

CREATE TABLE `balance_box` (
  `id` int(11) NOT NULL,
  `balance` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance_box`
--

INSERT INTO `balance_box` (`id`, `balance`) VALUES
(1, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_sold` int(1) NOT NULL DEFAULT 0 COMMENT '1 sold',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_image`, `product_description`, `product_price`, `product_sold`, `created_at`) VALUES
(1, 'Makaroni', '1657017671_5ef3070f8504c.jpg', 'Makaroni Manis Dengan Keju', '5000', 0, '2022-07-05 10:41:10'),
(2, 'Jagung Bakar', '1657017728_photo.jpg', 'Sebuah Jagung yang di taruh di api panas selama beberapa menit', '20000', 0, '2022-07-05 10:42:07'),
(3, 'Pisang Kuning', '1657017797_615940ea1d591.jpg', 'Kuning adalah warna kesukaan spongebob, maka dari itu spongebob loves this banana', '6000', 0, '2022-07-05 10:43:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_box`
--
ALTER TABLE `balance_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_box`
--
ALTER TABLE `balance_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
