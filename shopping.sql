-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 03:09 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`) VALUES
(1, 'Shirts', 'QAnEtkZwjB.jpg'),
(2, 'Jeans', 'udsUKPYqDz.jpg'),
(4, 'Hoodies', 'hXmFBPOlYv.jpg'),
(5, 'Trousers', 'oZdEBSlsGm.jpg'),
(6, 'Sweaters', 'MVsGWlRUjT.jpg'),
(8, 'Joggers', 'ynhKsTDcAN.jpg'),
(10, 'Jackets', 'EzALBpXPGo.jpg'),
(11, 'Leggings', 'uYqcGSJoMh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(250) NOT NULL,
  `additional_description` longtext NOT NULL,
  `gender` enum('male','female','baby') NOT NULL,
  `cat_id` int(11) NOT NULL COMMENT '1="shirts"'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `image`, `price`, `additional_description`, `gender`, `cat_id`) VALUES
(1, ' Alpha Cotton Shirt', 'A breathable, 100% cotton shirt designed for everyday comfort. Features a relaxed fit with reinforced stitching and a soft collar to ensure lasting durability and a polished look.\r\n\r\n', 'kCEOmKhtWR.jpg', 1500, 'Ideal for both casual Fridays at the office and weekend brunches. Available in multiple colors. Washes well without fading. Pre-shrunk to maintain size after multiple washes.', 'male', 1),
(2, 'Trendix Checked Shirt', 'A stylish checkered shirt crafted from a premium cotton-poly blend. The blue and green pattern gives it a vibrant, youthful look perfect for casual occasions or laid-back office environments.', 'WXKVNkBacF.jpg', 700, 'Includes a front pocket, wooden-style buttons, and adjustable cuff buttons. Easy to iron and keeps its shape all day. Great for layering or wearing on its own.', 'female', 1),
(3, 'Nova Formal Shirt', 'Tailored for the modern professional, this formal shirt features a sleek silhouette, narrow collar, and matte finish. Designed with breathable fabric that keeps you cool during long meetings.', 'OzgLJNtECh.jpg', 200, 'Pair it with dress pants or a blazer for a complete look. Moisture-wicking and odor-resistant technology helps keep you fresh through the day. French cuffs add an elegant touch.', 'baby', 1),
(18, 'Classic Denim Jeans', 'A pair of timeless denim jeans designed for comfort and style. Crafted with a blend of cotton and elastane for the perfect fit.', 'JWYbcRduHZ.jpg', 1200, 'Available in a variety of sizes ranging from 28 to 36 and three stylish colors: Dark Blue, Black, and Light Wash. These jeans are versatile enough for casual wear or dressing up for an evening out. The high-quality fabric ensures durability and breathability, making them comfortable all day long. Featuring a classic fit with a medium rise, they offer just the right amount of stretch to move with you. Machine washable for easy maintenance, these jeans will maintain their shape and color even after multiple washes. The perfect addition to any wardrobe!', 'male', 2),
(19, 'Slim Fit Stretch Jeans', 'Tailored for a sleek, modern look, these slim-fit jeans offer flexibility and shape retention. Made with stretch denim for all-day comfort.', 'qVdvWwOgJB.jpg', 500, 'These jeans feature a slim leg design that’s perfect for pairing with both casual and semi-formal outfits. Crafted with a durable cotton-spandex blend, they ensure long-lasting performance while moving with your body. A mid-rise waist adds comfort and support without compromising style. Designed with reinforced seams and functional front/back pockets for convenience. Available in Indigo Blue, Faded Gray, and Jet Black. Suitable for both work and weekend wear. Machine washable and easy to care for.\r\n\r\n', 'female', 2),
(20, 'Baby Soft Denim Jeans', 'Gentle on baby skin, these soft denim jeans offer the classic jeans look with all-day comfort. Designed for crawlers, walkers, and little explorers.', 'RUdOozryZW.jpg', 400, 'Made from ultra-soft cotton denim with a hint of stretch, these jeans are perfect for growing babies. The elastic waistband ensures a snug but comfy fit and makes diaper changes quick and easy. Designed with a relaxed fit to allow freedom of movement during playtime. Faux front pockets and a stitched fly add a stylish, grown-up look. Available in Light Blue, Dark Denim, and Soft Gray. Machine washable for quick cleanup after spills or messes. Ideal for babies aged 6 to 24 months, providing both comfort and cuteness in one go.', 'baby', 2),
(21, 'Baby Stretch Fit Jeans', 'These baby jeans feature a stretchable fit for active little ones. Soft, durable denim keeps them comfy through every wiggle and crawl.', 'ipRxCcsaUz.jpg', 450, 'Designed with growing babies in mind, these jeans offer a flexible waistband and soft denim blend that moves with your child. The fabric includes a touch of elastane for added stretch, making them great for crawling and early walking. Classic jean details like faux front pockets and contrast stitching add charm. The pull-on style makes dressing simple and fuss-free. Comes in three cute washes: Light Blue, Classic Indigo, and Washed Black. Suitable for babies aged 3 to 18 months. These jeans combine the classic denim look with modern baby-friendly comfort.', 'baby', 2),
(22, 'Classic Pullover Hoodie', 'A timeless pullover hoodie designed for warmth and everyday wear. Soft fleece lining makes it your go-to for cool weather.', 'YMghKkRGSe.jpg', 780, 'Crafted from a high-quality cotton-poly blend, this hoodie offers lasting comfort and durability. The kangaroo pocket in front provides room to warm your hands or stash essentials. Ribbed cuffs and hem offer a snug fit that stays in place. The adjustable drawstring hood provides added protection against wind and chill. Available in Black, Heather Gray, Navy, and Olive. Perfect for layering or wearing solo in mild temperatures. Machine washable and built to maintain shape after multiple washes.', 'male', 4),
(23, ' Classic Zip Hoodie', 'A versatile full-zip hoodie perfect for everyday wear. Combines classic style with lightweight comfort for year-round use.', 'ZRrpXJLefI.jpg', 630, 'This hoodie features a soft cotton-polyester blend that feels gentle on the skin and resists pilling over time. The full-length zipper allows for easy layering over tanks or tees. Ribbed cuffs and waistband offer a snug fit, while front pockets keep your hands warm or hold small essentials. Available in soft neutrals like Cream, Dusty Rose, and Charcoal. Designed with a relaxed fit for easy movement and casual layering. Machine washable and perfect for workouts, errands, or lounging.', 'female', 4),
(24, 'Oversized Hoodie', 'Stay cozy in this trendy oversized hoodie, ideal for relaxed weekends and cool evenings. Features a roomy fit and ultra', 'tRUXlCrLDY.jpg', 450, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style.\r\n\r\n', 'female', 4),
(25, 'Cropped Hoodie', 'A modern cropped hoodie with a sporty edge, perfect for layering or wearing solo. Lightweight and breathable for all-day wear.', 'tJrvayETdN.jpg', 650, 'This hoodie hits just above the waist for a flattering silhouette that pairs well with high-waisted bottoms. Made from soft French terry fabric  it offers breathability and light warmth. The raw hemline adds a touch of street style while the adjustable drawstring hood provides function. Great for workouts  travel, or casual hangouts. Available in Sky Blue, Lavender  and Off White. A must have for stylish comfort lovers looking for a fresh twist on a hoodie classic.', 'female', 4),
(26, 'Fleece Zip Hoodie', 'Keep your baby warm and cozy with this soft fleece zip hoodie. Designed for comfort, ease, and all-day wear.', 'jHgJfkCXVd.jpg', 580, 'Made from ultra-soft fleece, this hoodie is gentle on your baby’s skin and perfect for cooler days. The full-length zipper makes dressing quick and hassle-free. Features a cozy hood and two front pockets for tiny essentials or warming little hands. Stretchy ribbed cuffs and hem keep the fit snug and secure. Available in Light Gray, Baby Blue, and Blush Pink. Ideal for layering over onesies or tees. Machine washable for easy care after playtime or messes.\r\n\r\n', 'baby', 4),
(27, 'Bear Ears Hoodie', 'Adorably soft hoodie with cute bear ears on the hood. Combines warmth, comfort, and irresistible cuteness.', 'zTcWanBxYi.jpg', 600, 'This hoodie is crafted from plush cotton blend fabric to keep your little one warm without overheating. The hood features tiny 3D bear ears, adding a playful touch that’s perfect for photos. Elastic cuffs and waistband ensure a snug, secure fit. Zip closure makes dressing and undressing easy for parents. Available in Cream, Soft Tan, and Dusty Rose. Suitable for ages 3 to 24 months. A charming choice for chilly walks, daycare days, or lounging at home.', 'baby', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
