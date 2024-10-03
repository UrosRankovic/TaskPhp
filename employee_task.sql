-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 05:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_task`
--
CREATE DATABASE IF NOT EXISTS `employee_task` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `employee_task`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `task_id`, `user_id`, `title`, `content`, `created_at`) VALUES
(64, 10, 123, 'fdsf', 'sfdfdssfd', '2023-06-07 11:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 7
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `url`, `priority`) VALUES
(1, 'Tasks', 'http://localhost/Project/Tasks.php', 8),
(2, 'Task Groups', 'http://localhost/Project/TaskGroups.php', 9),
(3, 'Comments', 'http://localhost/Project/Comments.php', 8),
(4, 'Users', 'http://localhost/Project/Users.php', 10),
(5, 'User Types', 'http://localhost/Project/UserTypes.php', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `assignee_id` int(10) UNSIGNED NOT NULL,
  `task_group_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `priority` int(11) NOT NULL DEFAULT 1,
  `status` enum('completed','canceled','in progress') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `due_date`, `assignee_id`, `task_group_id`, `created_at`, `priority`, `status`) VALUES
(10, 'Something', '     Description', '2022-01-31 00:02:00', 117, 8, '2023-06-06 15:44:45', 3, ''),
(11, 'Testingss', '', '2023-06-22 00:00:00', 117, 8, '2023-06-06 18:01:19', 3, 'in progress'),
(12, 'sdfsdfsdfsdsdf', '', '0000-00-00 00:00:00', 117, 8, '2023-06-06 18:02:33', 4, 'in progress'),
(15, 'Zadatak 4', '', '2023-06-23 00:00:00', 118, 10, '2023-06-07 05:52:52', 5, ''),
(16, 'Zadatak 6', '', '2023-06-15 00:00:00', 117, 10, '2023-06-07 11:04:05', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `task_executors`
--

CREATE TABLE `task_executors` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `executor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_executors`
--

INSERT INTO `task_executors` (`id`, `task_id`, `executor_id`) VALUES
(7, 10, 119),
(18, 10, 123),
(9, 11, 120),
(10, 12, 120),
(17, 16, 120);

-- --------------------------------------------------------

--
-- Table structure for table `task_groups`
--

CREATE TABLE `task_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_groups`
--

INSERT INTO `task_groups` (`id`, `title`, `created_at`) VALUES
(8, 'Prva Grupa', '2023-06-06 00:06:06'),
(10, 'Druga Grupa', '2023-06-07 05:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `verification_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_type_id` int(10) UNSIGNED NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `phone_number`, `email`, `birth_date`, `verification_token`, `created_at`, `user_type_id`, `is_verified`) VALUES
(117, 'Test', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', 'Testing', '', 'test@gmail.com', '0000-00-00', '', '2023-06-06 01:02:20', 2, 0),
(118, 'pera', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', 'Pera', '', 'pera@gmail.com', '0000-00-00', '', '2023-06-06 15:15:36', 2, 0),
(119, 'pera1', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', 'Pero', '', 'pera1@gmail.com', '0000-00-00', '', '2023-06-06 15:16:18', 3, 0),
(120, 'pera2', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', 'Tsetsd', '', 'pera2@gmail.com', '0000-00-00', '', '2023-06-06 15:18:03', 3, 1),
(121, 'kajmak', '0549ab26aefcba2df2f37dc4a2820597b0142f86ac8984214951c44621b63d1696f03cc3093ba1c7c88a7259d5cc83e7396e1614d1a5f3c3c0ad96e70cdfd0d7', 'Uros Rankovic', '', 'kajmaok@gmail.com', '2023-06-15', '', '2023-06-07 01:36:52', 4, 1),
(122, 'pera3', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e', 'Pera Peric', '55555', 'pera3@gmail.com', '2023-06-22', '', '2023-06-07 10:52:14', 3, 1),
(123, 'Uros2000', '2f116a908cf26341547be5d4eec5d9e325fa75f1b6bfd6ba1618d9283b9aeb60cfb00a6a8508e0bcff4e673a52abf31cad6d7b26ba3994c087a0566ead3b2330', 'Uros Rankovic', '', 'uki.rankovic@gmail.com', '2023-06-06', '', '2023-06-07 11:00:31', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `priority` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`, `priority`) VALUES
(1, 'Admin', 10),
(2, 'Manager', 9),
(3, 'Executor', 8),
(4, 'User', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignee_id` (`assignee_id`),
  ADD KEY `task_group_id` (`task_group_id`);

--
-- Indexes for table `task_executors`
--
ALTER TABLE `task_executors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_task_executor` (`task_id`,`executor_id`),
  ADD KEY `executor_id` (`executor_id`);

--
-- Indexes for table `task_groups`
--
ALTER TABLE `task_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_name` (`title`),
  ADD UNIQUE KEY `title` (`title`),
  ADD UNIQUE KEY `title_2` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `task_executors`
--
ALTER TABLE `task_executors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_groups`
--
ALTER TABLE `task_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assignee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`task_group_id`) REFERENCES `task_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_executors`
--
ALTER TABLE `task_executors`
  ADD CONSTRAINT `task_executors_ibfk_1` FOREIGN KEY (`executor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_executors_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
