-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2025 at 03:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `Additional_description` text DEFAULT NULL,
  `Gender` enum('male','female','baby') DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL COMMENT '1="shirts"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `image`, `price`, `Additional_description`, `Gender`, `cat_id`) VALUES
(1, ' Alpha Cotton Shirt', 'A breathable, 100% cotton shirt designed for everyday comfort. Features a relaxed fit with reinforced stitching and a soft collar to ensure lasting durability and a polished look.\r\n\r\n', 'kCEOmKhtWR.jpg', ' $24.99', 'Ideal for both casual Fridays at the office and weekend brunches. Available in multiple colors. Washes well without fading. Pre-shrunk to maintain size after multiple washes.', 'male', 1),
(2, 'Trendix Checked Shirt', 'A stylish checkered shirt crafted from a premium cotton-poly blend. The blue and green pattern gives it a vibrant, youthful look perfect for casual occasions or laid-back office environments.', 'WXKVNkBacF.jpg', ' $31.50', 'Includes a front pocket, wooden-style buttons, and adjustable cuff buttons. Easy to iron and keeps its shape all day. Great for layering or wearing on its own.', 'male', 1),
(3, 'Nova Formal Shirt', 'Tailored for the modern professional, this formal shirt features a sleek silhouette, narrow collar, and matte finish. Designed with breathable fabric that keeps you cool during long meetings.', 'RzLYwdTIjH.jpg', ' $324.99', 'Pair it with dress pants or a blazer for a complete look. Moisture-wicking and odor-resistant technology helps keep you fresh through the day. French cuffs add an elegant touch.', 'male', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
