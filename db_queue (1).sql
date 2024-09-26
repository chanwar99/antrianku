-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 26, 2024 at 04:24 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_queue`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Retail'),
(2, 'Food');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `location`, `category`, `created_at`) VALUES
(1, 'Merchant ABC', 'Jl. Sudirman No. 45', 'Retail', '2024-09-24 11:20:46'),
(2, 'Merchant DFG', 'Jl. Aceh No. 01', 'Retail', '2024-09-24 11:21:02'),
(3, 'Merchant XYZ', 'Jl. Melati No. 10', 'Food', '2024-09-24 11:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `merchant_categories`
--

CREATE TABLE `merchant_categories` (
  `merchant_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merchant_categories`
--

INSERT INTO `merchant_categories` (`merchant_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1727275887),
('m240925_140040_create_users_table', 1727275893),
('m240925_140041_create_merchants_table', 1727275895),
('m240925_140042_create_services_table', 1727275895),
('m240925_140043_create_categories_table', 1727275895),
('m240925_140044_create_merchant_categories_table', 1727275895),
('m240925_140045_create_queues_table', 1727275897),
('m240926_050251_insert_initial_data', 1727327264);

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `merchant_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `queue_number` int NOT NULL,
  `queue_status` enum('waiting','processing','completed') DEFAULT 'waiting',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`id`, `user_id`, `merchant_id`, `service_id`, `queue_number`, `queue_status`, `created_at`) VALUES
(12, 1, 3, 5, 1, 'processing', '2024-09-26 07:12:57'),
(13, 1, 3, 5, 2, 'waiting', '2024-09-26 07:14:32'),
(14, 3, 3, 5, 3, 'waiting', '2024-09-26 07:16:02'),
(15, 3, 2, 3, 1, 'processing', '2024-09-26 07:27:44'),
(16, 3, 1, 1, 1, 'processing', '2024-09-26 07:28:44'),
(17, 1, 3, 5, 4, 'waiting', '2024-09-26 08:32:24'),
(18, 5, 1, 1, 2, 'waiting', '2024-09-26 08:36:55'),
(19, 5, 3, 5, 5, 'waiting', '2024-09-26 08:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `merchant_id` int DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `merchant_id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 1, 'Cuci Mobil', 'Layanan cuci mobil standar', '50000.00', '2024-09-24 11:21:11'),
(2, 1, 'Cuci Motor', 'Layanan cuci motor matic', '20000.00', '2024-09-24 11:21:33'),
(3, 2, 'Service HP', 'Layanan benerin hp', '500000.00', '2024-09-24 11:22:04'),
(4, 2, 'Service Laptop', 'Layanan benerin laptop', '800000.00', '2024-09-24 11:22:41'),
(5, 3, 'Makan Siang', 'Layanan makanan siang', '15000.00', '2024-09-24 11:30:00'),
(6, 3, 'Minum Malam', 'Layanan minuman malam', '10000.00', '2024-09-24 11:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `auth_token`, `created_at`) VALUES
(1, 'chanwar99', 'erulanwar93@gmail.com', '$2y$13$FKho0TVDsL.3NfmA3vEiZ.pWAoBO0fSAF9ORVCGNtlR/ycK36zCaK', NULL, '2024-09-25 16:22:04'),
(2, 'chanwar99p', '99chanwar@gmail.com', '$2y$13$UOGqEH/5Ga.euOwsPcyCpuzThQ6y38R.epMO6DBce4jNzt7H.WZAi', NULL, '2024-09-25 18:40:00'),
(3, 'chanwar', 'erul@gmail.com', '$2y$13$.Yp/H3iu5QOo3EYV10il9ufYNq8kYKC0TZahGFMTCDq4zn5p1Wjz6', NULL, '2024-09-26 14:15:25'),
(4, 'erul', 'chanwar@mail.com', '$2y$13$QT1GOJY7o40JKDz5VZWVM.qAQRZKL9swUJ5AT0hR7Xj3.2ZBSwXiy', NULL, '2024-09-26 14:35:47'),
(5, 'erul123', 'mail@mail.com', '$2y$13$5Smh/W0CqtF1IPZqztBvPOQ8i5YO7LFYWWzrruTGS5b8HVH47M.Sq', NULL, '2024-09-26 15:33:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchant_categories`
--
ALTER TABLE `merchant_categories`
  ADD PRIMARY KEY (`merchant_id`,`category_id`),
  ADD KEY `fk-merchant_categories-category_id` (`category_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-queues-user_id` (`user_id`),
  ADD KEY `fk-queues-merchant_id` (`merchant_id`),
  ADD KEY `fk-queues-service_id` (`service_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-services-merchant_id` (`merchant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `queues`
--
ALTER TABLE `queues`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `merchant_categories`
--
ALTER TABLE `merchant_categories`
  ADD CONSTRAINT `fk-merchant_categories-category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-merchant_categories-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `fk-queues-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-queues-service_id` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-queues-user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `fk-services-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
