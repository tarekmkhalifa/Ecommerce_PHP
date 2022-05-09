-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 08:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `floor` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `details` text DEFAULT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `floor`, `flat`, `details`, `region_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Mahmoud Hegazy', 'El zahraa', '7', '13', 'Fo2 ayman net', 1, 46, '2021-12-26 05:55:10', '2021-12-26 07:12:45'),
(2, 'El Ahly Street', 'El nasria', '1', '2', NULL, 3, 46, '2021-12-26 05:55:10', '2021-12-26 07:12:48'),
(12, 'adsa', 'sasa', 'sasa', 's', 'dada', 3, 46, '2021-12-26 11:43:11', '2021-12-26 11:43:11'),
(14, 'asdmka', 'ska', 'smkad', 'mdsak', 'askdmak', 3, 46, '2021-12-26 11:43:43', '2021-12-26 11:43:43'),
(15, 'asmkda', 'mkdsa', 'mkdsamk', 'mkdsa', '', 3, 46, '2021-12-26 11:44:16', '2021-12-26 11:44:16'),
(18, 'شارع محمود حجازي', 'عمارة الزهراء', 'الدور السابع', 'شقة 13', '', 1, 46, '2021-12-27 10:57:13', '2021-12-27 13:10:51');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'brand_default.png',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=> not active brand, 1=> active brand',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Apple', 'brand_default.png', 1, '2021-12-08 18:20:43', '2021-12-08 18:21:30'),
(2, 'Samsung', 'brand_default.png', 1, '2021-12-08 18:20:43', '2021-12-08 18:20:43'),
(3, 'Huawei', 'brand_default.png', 1, '2021-12-08 18:21:15', '2021-12-08 18:21:15'),
(4, 'Xiaomi', 'brand_default.png', 1, '2021-12-08 18:21:15', '2021-12-08 18:21:15'),
(5, 'Nike', 'brand_default.png', 1, '2021-12-08 18:37:40', '2021-12-08 18:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'category_default.png',
  `status` tinyint(1) DEFAULT 0 COMMENT '0=> not active category, 1=> active category',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'category_default.png', 1, '2021-12-08 18:28:58', '2021-12-08 18:31:34'),
(2, 'Clothes', 'category_default.png', 1, '2021-12-08 18:30:29', '2021-12-08 18:31:26'),
(3, 'Health & Beauty', 'category_default.png', 1, '2021-12-29 09:43:44', '2021-12-29 09:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `lat` decimal(10,8) DEFAULT NULL,
  `long` decimal(11,8) DEFAULT NULL,
  `radius` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `lat`, `long`, `radius`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 1, '10.00000000', '11.00000000', '1', '2021-12-26 05:45:57', '2021-12-26 05:45:57'),
(2, 'Alex', 1, '11.00000000', '12.00000000', '2', '2021-12-26 05:49:23', '2021-12-26 05:50:23'),
(3, 'Rashid', 1, '13.00000000', '13.00000000', '3', '2021-12-26 05:49:23', '2021-12-26 05:50:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `code` varchar(30) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(5) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0=> product not active, 1=> product active',
  `brand_id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `code`, `price`, `quantity`, `status`, `brand_id`, `subcategory_id`, `created_at`, `updated_at`) VALUES
(1, 'Nike T-shirt For Men', 'Nike t-shirt for men and youth S,M,L,XL,2XL ', '10000', '450.00', 10, 1, 5, 4, '2021-12-30 10:16:15', '2021-12-30 10:16:15'),
(2, 'Sweetpants For Men', 'Sweetpants for men size: M,L,XL,2XL', '20000', '550.00', 15, 1, 5, 4, '2021-12-30 10:24:39', '2021-12-30 10:24:39'),
(3, 'Sweetpants For Men', 'sweetpants for men and youth size: S, M, L, XL, 2XL', '20001', '600.00', 5, 1, 5, 4, '2021-12-30 10:25:55', '2021-12-30 10:25:55'),
(4, 'iPhone-13-Pro-Max 256GB', 'iPhone-13-Pro-Max 256GB 2B Ram Blue', '50000', '22999.00', 0, 1, 1, 1, '2021-12-30 10:43:05', '2021-12-31 10:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `image` varchar(250) NOT NULL,
  `primary_image` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-> secondary,1->primary',
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`image`, `primary_image`, `product_id`) VALUES
('niketshirt.jpg', 1, 1),
('niketshirtwhite.jpg', 0, 1),
('sweetpants.jpg', 1, 2),
('sweetpants2.jpg', 1, 3),
('iPhone-13-Pro-Max.jpg', 1, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_ratings`
-- (See below for the actual view)
--
CREATE TABLE `products_ratings` (
`id` int(10) unsigned
,`name` varchar(255)
,`details` text
,`code` varchar(30)
,`price` decimal(8,2)
,`quantity` int(5)
,`status` tinyint(1)
,`brand_id` int(10) unsigned
,`subcategory_id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`reviewAvg` decimal(11,0)
,`reviewsNumber` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0=> active region, 1=> not active region',
  `lat` decimal(10,8) NOT NULL,
  `long` decimal(11,8) NOT NULL,
  `rad` varchar(20) DEFAULT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `status`, `lat`, `long`, `rad`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Vectoria', 1, '10.00000000', '11.00000000', '1', 2, '2021-12-26 05:51:32', '2021-12-26 05:51:32'),
(2, 'Smouha', 1, '11.00000000', '12.00000000', '2', 2, '2021-12-26 05:53:08', '2021-12-26 05:53:08'),
(3, 'Nasr City', 1, '10.00000000', '11.00000000', '1', 1, '2021-12-26 05:53:08', '2021-12-26 05:53:08'),
(4, 'Ramsis', 1, '11.00000000', '12.00000000', '2', 1, '2021-12-26 05:53:08', '2021-12-26 05:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `ratevalue` int(1) NOT NULL,
  `comment` text DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`user_id`, `product_id`, `ratevalue`, `comment`, `date`) VALUES
(46, 1, 1, 'bad', '2022-01-16 20:47:20'),
(46, 2, 1, 'so bad', '2022-01-17 10:26:25'),
(46, 3, 1, 'سيء', '2022-05-07 10:22:34'),
(46, 4, 5, 'excellent', '2021-12-31 10:43:51'),
(48, 2, 4, 'very good', '2022-01-16 19:26:20'),
(48, 4, 1, 'bad', '2021-12-31 13:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT 'subcategory_default.png',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=> not active, 1=> active',
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `image`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Mobiles', 'subcategory_default.png', 1, 1, '2021-12-08 18:33:25', '2021-12-08 18:33:25'),
(2, 'Laptops', 'subcategory_default.png', 1, 1, '2021-12-08 18:33:25', '2021-12-08 18:33:25'),
(3, 'Computers', 'subcategory_default.png', 1, 1, '2021-12-08 18:33:25', '2021-12-08 18:33:25'),
(4, 'Men\'s Sports Wear', 'subcategory_default.png', 1, 2, '2021-12-29 09:45:46', '2021-12-30 10:20:49'),
(5, 'Hair Care', 'subcategory_default.png', 1, 3, '2021-12-29 09:46:19', '2021-12-30 10:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(50) NOT NULL,
  `code` mediumint(6) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `image` varchar(255) DEFAULT 'user_default.png',
  `status` tinyint(1) DEFAULT 0 COMMENT '0=> user not verified, 1=> user verified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `code`, `gender`, `image`, `status`, `created_at`, `updated_at`) VALUES
(46, 'Tarek Khalifa', '01100037060', 'user.tarek@outlook.com', '9285e37e701e3a3b7d59d9d19e29ad695f2c9185', 92112, 'm', '46-user-1640066088.jpg', 1, '2021-12-18 04:18:00', '2022-05-09 06:19:17'),
(48, 'Tarek Mohamed', '01201848279', 'user.tarek1@gmail.com', '9285e37e701e3a3b7d59d9d19e29ad695f2c9185', 33739, 'm', 'user_default.png', 1, '2021-12-31 13:46:10', '2021-12-31 13:47:29');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_cart`
-- (See below for the actual view)
--
CREATE TABLE `user_cart` (
`name` varchar(200)
,`products_count` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `products_ratings`
--
DROP TABLE IF EXISTS `products_ratings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_ratings`  AS SELECT `products`.`id` AS `id`, `products`.`name` AS `name`, `products`.`details` AS `details`, `products`.`code` AS `code`, `products`.`price` AS `price`, `products`.`quantity` AS `quantity`, `products`.`status` AS `status`, `products`.`brand_id` AS `brand_id`, `products`.`subcategory_id` AS `subcategory_id`, `products`.`created_at` AS `created_at`, `products`.`updated_at` AS `updated_at`, if(round(avg(`reviews`.`ratevalue`),0) is null,0,round(avg(`reviews`.`ratevalue`),0)) AS `reviewAvg`, count(`reviews`.`product_id`) AS `reviewsNumber` FROM (`products` left join `reviews` on(`reviews`.`product_id` = `products`.`id`)) GROUP BY `products`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `user_cart`
--
DROP TABLE IF EXISTS `user_cart`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_cart`  AS   (select `users`.`name` AS `name`,count(`cart`.`product_id`) AS `products_count` from (`cart` join `users` on(`users`.`id` = `cart`.`user_id`)) group by `cart`.`user_id`)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_FK` (`region_id`),
  ADD KEY `user_FK` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `product_FK` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `brand_FK` (`brand_id`),
  ADD KEY `subcategory_FK` (`subcategory_id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD KEY `product_image_fk` (`product_id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_FK` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `reviews_product_fk` (`product_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_FK` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `region_FK` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cart_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brand_FK` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subcategory_FK` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `product_image_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `city_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `category_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
