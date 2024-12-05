-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 30, 2024 at 05:09 PM
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
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_type` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'admin', 'user', 'hi', '2024-11-10 15:37:13'),
(5, 'admin', 'user', '21313', '2024-11-30 15:52:52'),
(6, 'user', 'admin', 'fdgsag', '2024-11-30 15:54:07');

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
(3, 'Solar Panel', 'Hello, can you find a sponsorship for our project. This would help our barangay to be safe especially at night because there are many crimes that happening due to lack of streetlight. This would also help conserve energy.', 'active', 29, '2024-11-29 14:10:52', '2024-11-30 15:31:22', NULL),
(4, 'Solar Panel', 'We need some sponsors for solar panel this is really great for safety and also helps conserve energy.', 'active', 34, '2024-11-29 14:50:29', '2024-11-29 15:37:07', '2024-11-29 23:37:07'),
(5, 'Solar ', 'We need help for the safety of our the people of our barangay and also it helps conserve energy. Help[ us to find sponsor for solar panel.', 'progress', 33, '2024-11-29 14:57:59', '2024-11-30 12:15:20', NULL),
(6, 'Donation of tree seeds', 'We need some seeds to be planted. Looking for sponsors.', 'active', 68, '2024-11-29 15:07:05', '2024-11-29 15:30:49', NULL),
(7, 'Tree planting', 'twegGG', 'active', 0, '2024-11-30 12:16:42', '2024-11-30 12:16:42', NULL),
(8, 'iuliull', 'tyjrh', 'active', 0, '2024-11-30 13:46:13', '2024-11-30 13:46:13', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `email`, `created_at`, `is_deleted`) VALUES
(14, '2144', '', 'admin', 'sggggs@gmail.com', '2024-11-30 07:34:43', 0),
(15, 'sus', '', 'admin', 'sggggs@gmail.com', '2024-11-30 07:51:42', 0),
(16, 'josh', '123', 'user', 'josh@gmail.com', '2024-11-30 07:53:26', 0),
(17, 'wes', '234', 'admin', 'wesley@gmail.com', '2024-11-30 15:08:41', 1),
(19, 'wes', '', 'admin', 'sggggs@gmail.com', '2024-11-30 15:31:55', 0),
(20, 'josh', '', 'admin', 'sggggs@gmail.com', '2024-11-30 16:02:03', 0),
(21, 'tototo', '', 'admin', 'sggggs@gmail.com', '2024-11-30 16:02:29', 0);

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
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `moods`
--
ALTER TABLE `moods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
