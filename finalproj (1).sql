-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 09:53 AM
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
-- Database: `finalproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `recipient` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `sender`, `recipient`, `message`, `timestamp`) VALUES
(1, 'user', 'admin', 'hello', '2024-11-10 15:35:44'),
(2, 'admin', 'user', 'hi wes', '2024-11-10 15:35:50'),
(3, 'user', 'admin', 'hello', '2024-11-10 15:37:07'),
(4, 'admin', 'user', 'hi', '2024-11-10 15:37:13');

-- --------------------------------------------------------

--
-- Table structure for table `moods`
--

CREATE TABLE `moods` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `mood` varchar(50) DEFAULT NULL,
  `plant_tree` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moods`
--

INSERT INTO `moods` (`id`, `user_id`, `mood`, `plant_tree`, `created_at`) VALUES
(35, 1, 'Sad', 1, '2024-11-11 13:04:08'),
(36, 1, 'Sad', 1, '2024-11-11 13:09:03'),
(37, 1, 'Sad', 1, '2024-11-11 13:11:07'),
(38, 1, 'Sad', 1, '2024-11-11 13:15:01'),
(39, 1, 'Sad', 1, '2024-11-11 13:15:18'),
(40, 1, 'Sad', 1, '2024-11-11 13:15:24'),
(41, 1, 'Sad', 1, '2024-11-11 13:16:17'),
(42, 1, 'Happy', 1, '2024-11-11 13:17:27'),
(43, 1, 'Happy', 1, '2024-11-11 13:18:14'),
(44, 1, 'Sad', 1, '2024-11-11 13:18:59'),
(45, 1, 'Sad', 1, '2024-11-11 13:19:39'),
(46, 1, 'Sad', 1, '2024-11-11 13:19:57'),
(47, 1, 'Sad', 1, '2024-11-11 13:22:46'),
(48, 1, 'Sad', 1, '2024-11-12 13:09:13'),
(49, 1, 'Sad', 1, '2024-11-21 14:06:56'),
(50, 1, 'Anxious', 1, '2024-11-21 14:08:24'),
(51, 1, 'Sad', 1, '2024-11-21 14:09:10'),
(52, 1, 'Sad', 1, '2024-11-21 14:10:53'),
(53, 1, 'Sad', 1, '2024-11-21 14:11:01'),
(54, 1, 'Happy', 0, '2024-11-22 13:23:35'),
(55, 1, 'Happy', 0, '2024-11-22 13:25:22'),
(56, 1, 'Happy', 0, '2024-11-22 13:26:32'),
(57, 1, 'Happy', 0, '2024-11-22 13:26:52'),
(58, 1, 'Happy', 0, '2024-11-22 13:27:33'),
(59, 1, 'Sad', 0, '2024-11-22 13:29:28'),
(60, 1, 'Sad', 0, '2024-11-22 13:29:31'),
(61, 1, 'Sad', 0, '2024-11-22 13:33:33'),
(62, 1, 'Sad', 1, '2024-11-23 05:39:18'),
(63, 1, 'Sad', 1, '2024-11-23 05:40:25'),
(64, 1, 'Sad', 1, '2024-11-23 05:41:48'),
(65, 1, 'Sad', 1, '2024-11-23 05:42:42'),
(66, 1, 'Sad', 1, '2024-11-23 05:43:00'),
(67, 1, 'Sad', 1, '2024-11-24 10:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','progress','completed','recently_deleted') NOT NULL DEFAULT 'active',
  `progress` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `status`, `progress`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Solar Panel ', 'We need sponshorship for our sustainabuilkity proh=ject which is the solar panel.', 'recently_deleted', 0, '2024-11-17 12:21:20', '2024-11-17 12:40:06', NULL),
(2, 'Solar Panel ', 'We need sponshorship for our sustainabuilkity proh=ject which is the solar panel.', 'recently_deleted', 0, '2024-11-17 12:28:28', '2024-11-17 12:41:13', NULL),
(3, 'Solar Panel ', 'We need sponshorship for our sustainabuilkity proh=ject which is the solar panel.', 'recently_deleted', 31, '2024-11-17 12:28:32', '2024-11-17 12:43:44', NULL),
(4, 'Solar Panel ', 'We need sponshorship for our sustainabuilkity proh=ject which is the solar panel.', 'recently_deleted', 0, '2024-11-17 12:28:35', '2024-11-17 12:45:01', NULL),
(5, 'Donation ', 'Help us to have donations for foods and clothes due to typhoon.', 'recently_deleted', 0, '2024-11-17 12:38:58', '2024-11-17 12:52:22', NULL),
(6, 'Donation ', 'Help us to have donations for foods and clothes due to typhoon.', 'recently_deleted', 0, '2024-11-17 12:39:02', '2024-11-17 12:54:03', NULL),
(7, 'Donation ', 'Help us to have donations for foods and clothes due to typhoon.', 'recently_deleted', 0, '2024-11-17 12:39:23', '2024-11-17 12:54:09', NULL),
(8, 'vrevbb', 'berhebner', 'recently_deleted', 0, '2024-11-17 12:49:08', '2024-11-17 12:50:43', NULL),
(9, 'vrevbb', 'berhebner', 'recently_deleted', 0, '2024-11-17 12:49:11', '2024-11-17 12:50:21', NULL),
(10, 'vrevbb', 'berhebner', 'recently_deleted', 0, '2024-11-17 12:49:57', '2024-11-17 12:50:40', NULL),
(11, 'ikiki', 'uikik', 'recently_deleted', 0, '2024-11-17 12:50:04', '2024-11-17 12:50:31', NULL),
(12, 'cddc', 'dcdcd', 'recently_deleted', 0, '2024-11-17 12:53:24', '2024-11-17 12:53:29', NULL),
(16, 'Clean Up Drive', 'Help for our brangay clean up drive need materials for donation.', 'active', 21, '2024-11-17 13:10:38', '2024-11-24 13:13:43', '2024-11-24 21:13:43'),
(17, 'SolarPanel', 'We need a sponsor for the project that we are developing.', 'active', 0, '2024-11-23 03:14:36', '2024-11-23 03:14:36', NULL),
(18, 'donation food', 'We need donator for our food.', 'active', 0, '2024-11-23 03:15:35', '2024-11-24 13:15:12', '2024-11-24 21:15:12'),
(19, 'donation food', 'We need donator for our food.', 'active', 0, '2024-11-23 03:16:19', '2024-11-24 13:16:56', '2024-11-24 21:16:56'),
(21, 'Donation of Clothes', 'Help us for clothes donation due to flood.', 'active', 15, '2024-11-23 03:28:06', '2024-11-24 13:17:26', '2024-11-24 21:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `email`, `created_at`) VALUES
(11, 'cam', '12345', 'admin', 'heyming95@gmail.com', '2024-11-27 08:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin_user', '12345678', 'admin@example.com', 'admin'),
(2, 'test_user', '87654321', 'user@example.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moods`
--
ALTER TABLE `moods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `moods`
--
ALTER TABLE `moods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
