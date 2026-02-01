-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2026 at 05:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eacosmetics`
--
CREATE DATABASE IF NOT EXISTS `eacosmetics` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eacosmetics`;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `message`, `created_at`) VALUES
(1, 'reinaa', 'reinaa', 'reina@gmail.com', 'the best!!!', '2026-01-29 22:55:58'),
(2, 'ertaaa', 'ertaa', 'reina@gmail.com', 'so good!!!', '2026-01-29 22:56:51'),
(3, 'reina', 'ahmeti', 'reina@gmail.com', 'EA THE BEST', '2026-02-01 15:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` varchar(40) NOT NULL DEFAULT 'all',
  `image` varchar(255) NOT NULL DEFAULT 'img/default-product.png',
  `alt` varchar(150) NOT NULL DEFAULT 'Product image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `sale_price`, `quantity`, `created_at`, `category`, `image`, `alt`) VALUES
(1, 'Perfect Brow Pencil', 'This precision brow pencil is designed to define, shape, and fill your brows with natural-looking color. Its smooth, creamy formula glides effortlessly onto the skin, allowing you to create soft strokes or bold definition with ease. The long-lasting, smudge-resistant finish keeps your brows looking flawless all day.', 9.90, NULL, 16, '2026-01-30 23:50:17', 'eyes', 'img/prod-brow1.png', 'Brow Pencil'),
(2, 'Dreamy Eyeshadow Palette', 'A versatile eyeshadow palette featuring richly pigmented matte and shimmer shades. The silky texture blends seamlessly, allowing you to create endless eye looks from soft daytime styles to dramatic evening glam. Long-wearing formula that stays vibrant without creasing.', 45.00, 30.00, 8, '2026-01-31 00:00:12', 'eyes sale', 'img/prod-shad1.png', 'Eyeshadow Palette'),
(3, 'Precision Brow Gel', 'This lightweight brow gel shapes, sets, and defines your brows while keeping them in place all day. The non-sticky formula dries quickly, leaving a natural finish with flexible hold. Perfect for taming unruly brows and adding subtle volume.', 22.00, 16.00, 11, '2026-01-31 00:02:10', 'eyes sale', 'img/prod-brow2.png', 'Brow Gel'),
(4, 'Volume Mascara', 'A high-performance mascara that delivers dramatic volume and length with every coat. The precision brush separates each lash while lifting and defining without clumping or flaking. Enjoy bold, full lashes that last from morning to night.', 18.00, NULL, 23, '2026-01-31 00:03:12', 'eyes', 'img/prod-eyes2.png', 'Mascara'),
(5, 'Liquid Foundation', 'This liquid foundation provides buildable coverage that smooths out skin tone while maintaining a natural, breathable finish. Its lightweight formula blends effortlessly and feels comfortable all day. Ideal for creating a flawless, radiant complexion.', 54.00, 40.00, 7, '2026-01-31 00:04:12', 'face sale', 'img/prod-face1.png', 'Foundation'),
(6, 'Matte Concealer', 'A creamy, high-coverage concealer designed to hide imperfections, dark circles, and blemishes. The soft matte finish blends seamlessly into the skin without creasing or settling into fine lines.', 26.00, NULL, 14, '2026-01-31 00:05:00', 'face', 'img/prod-face2.png', 'Concealer'),
(7, 'Silky Compact Powder', 'A finely milled compact powder that sets makeup while controlling excess shine. Leaves the skin feeling smooth and soft with a lightweight, natural look that lasts all day.', 31.00, 19.00, 13, '2026-01-31 00:06:01', 'face sale', 'img/prod-face3.png', 'Powder'),
(8, 'Natural Blush', 'This soft, blendable blush adds a healthy flush of color to the cheeks. Its silky texture applies evenly for a fresh, radiant appearance that complements all skin tones.', 28.00, NULL, 20, '2026-01-31 00:06:59', 'face', 'img/prod-face4.png', 'Blush'),
(9, 'Glow Highlighter', 'Create a luminous glow with this radiant highlighter. The smooth formula melts into the skin, reflecting light beautifully for a natural yet glamorous finish.', 42.00, 28.00, 10, '2026-01-31 00:08:35', 'face sale', 'img/prod-face5.png', 'Highlighter'),
(10, 'Hydrating Lip Balm', 'An ultra-nourishing lip balm that deeply hydrates and protects lips from dryness. Leaves your lips soft, smooth, and naturally glossy.', 13.00, NULL, 26, '2026-01-31 00:10:12', 'lips', 'img/prod-lips1.png', 'Lip Balm'),
(11, 'Matte Liquid Lipstick', 'A long-lasting liquid lipstick with intense pigment and a smooth matte finish. Lightweight and comfortable, it stays in place without smudging or fading.', 30.00, 20.00, 4, '2026-01-31 00:16:00', 'lips sale', 'img/prod-lips2.png', 'Liquid Lipstick'),
(12, 'Creamy Lip Pencil', 'A creamy lip liner that defines and shapes lips for a perfect contour. Helps prevent lipstick from feathering while enhancing color longevity.', 18.00, NULL, 17, '2026-01-31 00:17:51', 'lips', 'img/prod-lips3.png', 'Lip Pencil'),
(13, 'Glossy Lip Shine', 'A high-shine lip gloss that adds volume and brilliance to your lips. Non-sticky formula keeps lips smooth and comfortable.', 23.00, 15.00, 7, '2026-01-31 00:18:46', 'lips sale', 'img/prod-lips4.png', 'Lip Gloss'),
(14, 'Velvet Lipstick', 'A luxurious lipstick with rich color payoff and a velvety smooth finish. Glides effortlessly for bold, beautiful lips.', 24.00, 17.00, 13, '2026-01-31 00:21:15', 'lips sale', 'img/prod-lips5.png', 'Lipstick'),
(15, 'Foundation Brush', 'A dense, soft brush designed for flawless foundation application. Delivers smooth, even coverage with no streaks.', 14.00, NULL, 15, '2026-01-31 00:23:32', 'brushes', 'img/prod-brush1.png', 'Foundation Brush'),
(16, 'Blending Brush', 'Perfect for blending eyeshadows seamlessly. Soft bristles allow smooth transitions between colors.', 22.00, 16.00, 9, '2026-01-31 00:37:53', 'brushes sale', 'img/prod-brush2.png', 'Blending Brush'),
(17, 'Powder Brush', 'A large, fluffy brush ideal for applying powder evenly for a natural finish.', 25.00, 19.00, 5, '2026-01-31 00:38:39', 'brushes', 'img/prod-brush3.png', 'Powder Brush'),
(18, 'Makeup Sponge', 'A soft, flexible sponge that blends liquid and cream products for an airbrushed look.', 12.00, 9.00, 19, '2026-01-31 00:39:33', 'brushes sale', 'img/prod-acc1.png', 'Makeup Sponge'),
(19, 'Cosmetic Bag', 'A stylish and practical bag to store your makeup and beauty tools safely.', 40.00, 27.00, 20, '2026-01-31 00:40:17', 'brushes', 'img/prod-acc2.png', 'Cosmetic Bag'),
(20, 'Beauty Headband', 'Keeps your hair away during makeup and skincare. Soft, stretchy, and comfortable for daily beauty routines.', 8.00, NULL, 30, '2026-01-31 00:42:08', 'brushes', 'img/prod-acc3.png', 'Beauty Headband');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `surname` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password_hash`, `role`) VALUES
(5, 'erta', 'erta', 'erta@gmail.com', 'erta123', '$2y$10$ao41dvSvnYCfi6PUECJQjuiwHEyBTzuyRHrm7sqcGVdIM8MNxHlxi', 'user'),
(6, 'roveda', 'marevci', 'roveda@gmail.com', 'roveda123', '$2y$10$USYceFQqiipGaMJpo7NMXu1Lzb54ATBUaddbOFFzt06V8Hm7uKZrO', 'user'),
(7, 'admin', 'admin', 'admin@gmail.com', 'adminadmin', '$2y$10$PzM3U4NSKG9osUeaXluHRuDORarJGJuN4npZVcRTSot3.3/D5c34y', 'admin'),
(8, 'reina', 'reina', 'reina@gmail.com', 'reina123', '$2y$10$Y2WzvQnrawhPJEYCluwP7uvdkFKtoOwd66M47i/qytjBcwwtJP1ym', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
