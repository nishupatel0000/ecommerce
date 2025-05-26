-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 03:19 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`) VALUES
(1, 'Black'),
(2, 'Green'),
(3, 'Blue'),
(4, 'White'),
(5, 'Yellow'),
(6, 'Brown'),
(7, 'Orange');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_iid` int(11) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `total_order` decimal(10,2) NOT NULL,
  `total_payable` decimal(10,2) NOT NULL,
  `order_status` tinyint(2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `refund_ammount` decimal(10,2) NOT NULL,
  `payment_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `Qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES
('jjgjgjgj31@gmail.com', '5fcf3af0cb7a8bf82a144a161bbe64fc4cfc5c5820', '2025-05-24 07:53:50'),
('jjgjgjgj31@gmail.com', '5fcf3af0cb7a8bf82a144a161bbe64fc79366c2c0d', '2025-05-24 07:58:40'),
('jjgjgjgj31@gmail.com', '5fcf3af0cb7a8bf82a144a161bbe64fca525232136', '2025-05-24 08:27:09'),
('admin@gmail.com', 'e1f70d2df2e7e2f6d593e8e8f49c9e01b63cff4b07', '2025-05-24 13:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `cat_id` int(11) NOT NULL COMMENT '1="shirts"',
  `color_id` int(11) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `is_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `image`, `price`, `additional_description`, `gender`, `cat_id`, `color_id`, `discount_price`, `is_date`, `is_active`) VALUES
(1, ' Alpha Cotton Shirt', 'A breathable, 100% cotton shirt designed for everyday comfort. Features a relaxed fit with reinforced stitching and a soft collar to ensure lasting durability and a polished look.\r\n\r\n', 'kCEOmKhtWR.jpg', 1500, 'Ideal for both casual Fridays at the office and weekend brunches. Available in multiple colors. Washes well without fading. Pre-shrunk to maintain size after multiple washes.\r\nMake a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it s built to last. Easy to care for and wrinkle-resistant, it s a wardrobe essential you ll reach for again and again.', 'male', 1, 4, NULL, '2025-05-26 08:51:13', 1),
(2, 'Trendix Checked Shirt', 'A stylish checkered shirt crafted from a premium cotton-poly blend. The blue and green pattern gives it a vibrant, youthful look perfect for casual occasions or laid-back office environments.', 'WXKVNkBacF.jpg', 1700, 'Includes a front pocket, wooden-style buttons, and adjustable cuff buttons. Easy to iron and keeps its shape all day. Great for layering or wearing on its own.Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you\'re heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it\'s built to last. Easy to care for and wrinkle-resistant, it\'s a wardrobe essential you\'ll reach for again and again.', 'male', 1, 1, NULL, '2025-05-26 08:51:13', 1),
(3, 'Nova Formal Shirt', 'Tailored for the modern professional, this formal shirt features a sleek silhouette, narrow collar, and matte finish. Designed with breathable fabric that keeps you cool during long meetings.', 'OzgLJNtECh.jpg', 200, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'male', 1, 7, NULL, '2025-05-26 08:51:13', 1),
(18, 'Classic Denim Jeans', 'A pair of timeless denim jeans designed for comfort and style. Crafted with a blend of cotton and elastane for the perfect fit.', 'JWYbcRduHZ.jpg', 1200, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'male', 2, 4, NULL, '2025-05-26 08:51:13', 1),
(19, 'Slim Fit Stretch Jeans', 'Tailored for a sleek, modern look, these slim-fit jeans offer flexibility and shape retention. Made with stretch denim for all-day comfort.', 'qVdvWwOgJB.jpg', 2900, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'female', 2, 3, NULL, '2025-05-26 08:51:13', 1),
(20, 'Baby Soft Denim Jeans', 'Gentle on baby skin, these soft denim jeans offer the classic jeans look with all-day comfort. Designed for crawlers, walkers, and little explorers.', 'RUdOozryZW.jpg', 400, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'baby', 2, 3, NULL, '2025-05-26 08:51:13', 1),
(21, 'Baby Stretch Fit Jeans', 'These baby jeans feature a stretchable fit for active little ones. Soft, durable denim keeps them comfy through every wiggle and crawl.', 'ipRxCcsaUz.jpg', 450, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'baby', 2, 4, NULL, '2025-05-26 08:51:13', 1),
(22, 'Classic Pullover Hoodie', 'A timeless pullover hoodie designed for warmth and everyday wear. Soft fleece lining makes it your go-to for cool weather.', 'YMghKkRGSe.jpg', 780, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'male', 4, 1, NULL, '2025-05-26 08:51:13', 1),
(23, ' Classic Zip Hoodie', 'A versatile full-zip hoodie perfect for everyday wear. Combines classic style with lightweight comfort for year-round use.', 'ZRrpXJLefI.jpg', 630, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'female', 4, 1, NULL, '2025-05-26 08:51:13', 1),
(24, 'Oversized Hoodie', 'Stay cozy in this trendy oversized hoodie, ideal for relaxed weekends and cool evenings. Features a roomy fit and ultra', 'tRUXlCrLDY.jpg', 450, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'female', 4, 4, NULL, '2025-05-26 08:51:13', 0),
(25, 'Cropped Hoodie', 'A modern cropped hoodie with a sporty edge, perfect for layering or wearing solo. Lightweight and breathable for all-day wear.', 'tJrvayETdN.jpg', 650, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'female', 4, 2, NULL, '2025-05-26 08:51:13', 1),
(26, 'Fleece Zip Hoodie', 'Keep your baby warm and cozy with this soft fleece zip hoodie. Designed for comfort, ease, and all-day wear.', 'jHgJfkCXVd.jpg', 580, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'baby', 4, 1, NULL, '2025-05-26 08:51:13', 1),
(27, 'Bear Ears Hoodie', 'Adorably soft hoodie with cute bear ears on the hood. Combines warmth, comfort, and irresistible cuteness.', 'zTcWanBxYi.jpg', 2500, 'Made from brushed fleece for extra warmth, this hoodie offers a slouchy fit with dropped shoulders and a longline design. The oversized hood and kangaroo pocket enhance the laid back look. Available in popular tones like Sage Green, Washed Black and Mauve. Ideal for pairing with leggings or biker shorts for a casual streetwear vibe. The ribbed cuffs and hem help maintain shape over time. Whether you re lounging at home or out on the go this hoodie brings effortless comfort and style. Make a statement with the Trendix Checked Shirt — a perfect blend of timeless style and everyday comfort. Crafted from a premium cotton blend, this shirt offers a breathable and soft feel, making it ideal for all-day wear. Its modern fit strikes the right balance between tailored and relaxed, providing a flattering silhouette for any body type. The bold yet classic checked pattern adds a touch of personality without being overpowering, making it easy to pair with both jeans and chinos. Whether you are heading to a casual meeting or a weekend outing, the Trendix Checked Shirt ensures you look sharp with minimal effort. Designed with attention to detail, from its sturdy button-down collar to its smooth cuffs, this shirt is not just stylish — it is built to last. Easy to care for and wrinkle-resistant, it is a wardrobe essential you will reach for again and again.', 'baby', 4, 2, NULL, '2025-05-26 08:51:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0="Inactive" 1="active"',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_type` enum('android','ios','web') NOT NULL,
  `device_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `mobile`, `email`, `password`, `image`, `status`, `created_at`, `updated_at`, `device_type`, `device_token`) VALUES
(3, 'Nishant Patel', '8846790074', 'user@gmail.com', '0e11d184398255abe79cac2d7d7fec73', 'iIRAaNjGVE.jpg', 1, '2025-05-26 12:42:11', '2025-05-22 04:05:33', 'web', 'sdfsdfsf'),
(4, 'shivam', '8527485968', 'shivam@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'xUdGLiyZMA.jpg', 1, '2025-05-26 12:42:15', '2025-05-22 12:29:19', 'web', 'asdasdg'),
(5, 'Akash', '9726274614', 'akash@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'sGjBtqxrfe.jpg', 0, '2025-05-26 12:42:38', '2025-05-26 04:16:25', 'web', 'ddddd');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_payment` (`order_id`),
  ADD KEY `fk_user_payment` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_color_id` (`color_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`) USING BTREE,
  ADD KEY `fk_product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_order_payment` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_payment` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_color_id` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`),
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_useer_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
