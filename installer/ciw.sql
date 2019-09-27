-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2019 at 08:56 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciw`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_persian_ci NOT NULL,
  `mime_type` varchar(64) COLLATE utf8_persian_ci NOT NULL,
  `size` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `path` varchar(128) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `name`, `mime_type`, `size`, `created_at`, `path`) VALUES
(2, '2019-09-03-21-21-46-shadmehri.PNG', 'image/png', '102738', '2019-09-03 19:21:46', '/files/profiles/2019-09-03-21-21-46-shadmehri.PNG'),
(3, '2019-09-03-21-23-59-shadmehri.PNG', 'image/png', '102738', '2019-09-03 19:23:59', '/files/profiles/2019-09-03-21-23-59-shadmehri.PNG'),
(4, '2019-09-26-22-15-39-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-26 20:15:39', '/files/profiles/2019-09-26-22-15-39-sweet-potato-spotted.jpg'),
(5, '2019-09-26-22-18-45-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-26 20:18:45', '/files/profiles/2019-09-26-22-18-45-sweet-potato-spotted.jpg'),
(6, '2019-09-26-22-24-41-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-26 20:24:41', '/files/profiles/2019-09-26-22-24-41-sweet-potato-spotted.jpg'),
(7, '2019-09-27-16-44-32-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 14:44:32', '/files/profiles/2019-09-27-16-44-32-sweet-potato-spotted.jpg'),
(8, '2019-09-27-16-45-57-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 14:45:57', '/files/profiles/2019-09-27-16-45-57-sweet-potato-spotted.jpg'),
(9, '2019-09-27-16-46-45-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 14:46:45', '/files/profiles/2019-09-27-16-46-45-sweet-potato-spotted.jpg'),
(10, '2019-09-27-16-47-09-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 14:47:09', '/files/profiles/2019-09-27-16-47-09-sweet-potato-spotted.jpg'),
(11, '2019-09-27-16-50-38-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 14:50:38', '/files/profiles/2019-09-27-16-50-38-sweet-potato-spotted.jpg'),
(12, '2019-09-27-16-53-18-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 14:53:18', '/files/profiles/2019-09-27-16-53-18-sweet-potato-spotted.jpg'),
(13, '2019-09-27-17-50-57-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 15:50:57', '/files/profiles/2019-09-27-17-50-57-sweet-potato-spotted.jpg'),
(14, '2019-09-27-17-51-18-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 15:51:18', '/files/profiles/2019-09-27-17-51-18-sweet-potato-spotted.jpg'),
(15, '2019-09-27-17-51-28-sweet-potato-spotted.jpg', 'image/jpeg', '34331', '2019-09-27 15:51:28', '/files/profiles/2019-09-27-17-51-28-sweet-potato-spotted.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8_persian_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL,
  `item_order` int(11) UNSIGNED NOT NULL,
  `icon` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `link` varchar(128) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `auther_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(256) COLLATE utf8_persian_ci NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  `status` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts_categories`
--

CREATE TABLE `posts_categories` (
  `post_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `permissions` text COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`) VALUES
(1, 'مدیر کل', ''),
(2, 'کاربر ساده', '');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `value` varchar(100) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `gender` int(1) NOT NULL,
  `username` varchar(32) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_persian_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_persian_ci NOT NULL,
  `avatar_id` int(11) UNSIGNED NOT NULL,
  `activation_code` varchar(64) COLLATE utf8_persian_ci NOT NULL,
  `activation_type` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `status` varchar(16) COLLATE utf8_persian_ci NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `username`, `password`, `email`, `phone`, `avatar_id`, `activation_code`, `activation_type`, `status`, `role_id`, `is_admin`, `register_date`) VALUES
(1, 'Iman', 'Shadmehri', 1, 'admin', 'ebe4f972686a2f8c04d38d1aa02c2e65', 'shadmehri.iman@outlook.com', '09376630385', 15, '', 'manual', '1', 0, 1, '2019-09-27 16:46:49'),
(6, 'سارا', 'شادمهری', 0, 'paras2b', 'de90d765bd1c83ffe465c079952e09e7', 'ali@ali.com', '09376630385', 2, '', '', '', 0, 1, '2019-09-27 14:53:49'),
(8, 'dfsdfvsd', 'shdfvhsdfg', 0, 'sdjhfvsdhf', 'e13ef34e72d9af383c9351409d97fdd0', 'sdhvfgsdvfj@dsfdf.comc', '09308645859', 0, '', '', '', 0, 1, '2019-09-27 15:48:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
