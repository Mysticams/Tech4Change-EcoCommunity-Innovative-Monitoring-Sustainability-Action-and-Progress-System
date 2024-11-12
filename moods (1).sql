-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 02:28 PM
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
-- Database: `mood_tracker`
--

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
(48, 1, 'Sad', 1, '2024-11-12 13:09:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moods`
--
ALTER TABLE `moods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `moods`
--
ALTER TABLE `moods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
