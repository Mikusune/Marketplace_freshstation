-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2025 at 11:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshstation`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '517538cebe8d9b88019515c8383ae40f', '2025-04-17 23:18:16'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'b28e05b0dad899c6a76ce211f5732434', '2025-04-17 23:31:58'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '3ffee0813559c62799893faf5f6f07db', '2025-04-17 23:44:25'),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '412a910aaed97328220e86a7a9547f42', '2025-04-17 23:51:59'),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '9e609c0a6bdcc586d3175de7b776ea59', '2025-04-18 01:05:56'),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '9c747749da1d021f8353334fc795932e', '2025-04-21 19:37:22'),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', '612625b56891b1287e8693426106d55d', '2025-04-22 01:36:33'),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0', 'bd976c92f499f06c69bc86ca1c29dbe6', '2025-04-22 01:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'customer', 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 3),
(2, 11),
(2, 12),
(2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin', NULL, '2025-02-06 06:02:13', 0),
(2, '::1', 'admin', NULL, '2025-02-06 06:03:34', 0),
(3, '::1', 'admin', NULL, '2025-02-06 06:05:00', 0),
(4, '::1', 'admin@gmail.com', NULL, '2025-02-06 06:30:56', 0),
(5, '::1', 'admin', NULL, '2025-02-06 16:24:54', 0),
(6, '::1', 'Admin123', NULL, '2025-02-06 16:35:27', 0),
(7, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 16:35:49', 1),
(8, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:01:26', 1),
(9, '::1', 'admin', NULL, '2025-02-06 17:02:52', 0),
(10, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:03:06', 1),
(11, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:05:10', 1),
(12, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:09:27', 1),
(13, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:10:00', 1),
(14, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:18:43', 1),
(15, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:34:15', 1),
(16, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:43:48', 1),
(17, '::1', 'Admin123', NULL, '2025-02-06 17:47:39', 0),
(18, '::1', 'Admin123', NULL, '2025-02-06 17:47:48', 0),
(19, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:47:59', 1),
(20, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:51:30', 1),
(21, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 17:51:56', 1),
(22, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 20:34:56', 1),
(23, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-06 21:21:18', 1),
(24, '::1', 'Admin123', NULL, '2025-02-07 13:30:50', 0),
(25, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-07 13:30:58', 1),
(26, '::1', 'Admin123', NULL, '2025-02-08 06:39:24', 0),
(27, '::1', 'Admin123', NULL, '2025-02-08 06:39:32', 0),
(28, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-08 06:39:41', 1),
(29, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-08 07:43:58', 1),
(30, '::1', 'Admin123', NULL, '2025-02-08 08:58:13', 0),
(31, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-08 08:58:20', 1),
(32, '::1', 'trimuryanto78@gmail.com', 2, '2025-02-09 06:20:21', 1),
(33, '::1', 'admin', NULL, '2025-04-02 07:34:42', 0),
(34, '::1', 'admin', NULL, '2025-04-02 07:34:47', 0),
(35, '::1', 'admin', NULL, '2025-04-02 07:37:35', 0),
(36, '::1', 'admin', NULL, '2025-04-02 07:37:37', 0),
(37, '::1', 'admin', NULL, '2025-04-02 07:38:57', 0),
(38, '::1', 'admin', NULL, '2025-04-02 07:39:00', 0),
(39, '::1', 'admin', NULL, '2025-04-02 07:39:10', 0),
(40, '::1', 'admin', NULL, '2025-04-02 07:39:16', 0),
(41, '::1', 'admin', NULL, '2025-04-02 07:39:18', 0),
(42, '::1', 'admin', NULL, '2025-04-02 07:39:21', 0),
(43, '::1', 'Admin123', NULL, '2025-04-02 07:39:28', 0),
(44, '::1', 'mury', NULL, '2025-04-02 07:39:35', 0),
(45, '::1', 'mury', NULL, '2025-04-02 07:39:37', 0),
(46, '::1', 'Admin123', NULL, '2025-04-02 07:40:00', 0),
(47, '::1', 'Admin123', NULL, '2025-04-02 07:40:05', 0),
(48, '::1', 'Admin123', NULL, '2025-04-02 07:40:10', 0),
(49, '::1', 'Admin123', NULL, '2025-04-02 07:40:18', 0),
(50, '::1', 'Admin123', NULL, '2025-04-02 07:40:23', 0),
(51, '::1', 'Admin123', NULL, '2025-04-02 07:40:26', 0),
(52, '::1', 'Admin123', NULL, '2025-04-02 07:40:31', 0),
(53, '::1', 'Admin123', NULL, '2025-04-02 07:40:36', 0),
(54, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:41:33', 0),
(55, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:26', 0),
(56, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:33', 0),
(57, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:38', 0),
(58, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:43', 0),
(59, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:50', 0),
(60, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:53:57', 0),
(61, '::1', 'admin', NULL, '2025-04-02 07:56:07', 0),
(62, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:56:55', 0),
(63, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:57:03', 0),
(64, '::1', 'trimuryanto78@gmail.com', NULL, '2025-04-02 07:57:12', 0),
(65, '::1', 'Admin123', NULL, '2025-04-02 07:58:21', 0),
(66, '::1', 'Admin123', NULL, '2025-04-02 07:58:40', 0),
(67, '::1', 'Admin123', NULL, '2025-04-02 07:58:48', 0),
(68, '::1', 'admin', NULL, '2025-04-02 08:06:23', 0),
(69, '::1', 'admin123', NULL, '2025-04-02 08:07:07', 0),
(70, '::1', 'mury', 3, '2025-04-02 08:07:48', 0),
(71, '::1', 'admin@admin.com', 3, '2025-04-02 08:08:30', 1),
(72, '::1', 'admin@admin.com', 3, '2025-04-02 17:04:11', 1),
(73, '::1', 'admin@admin.com', 3, '2025-04-03 07:37:59', 1),
(74, '::1', 'admin@admin.com', 3, '2025-04-03 12:52:35', 1),
(75, '::1', 'admin@admin.com', 3, '2025-04-03 18:07:40', 1),
(76, '::1', 'admin@admin.com', 3, '2025-04-04 00:17:35', 1),
(77, '::1', 'admin@admin.com', 3, '2025-04-07 10:06:28', 1),
(78, '::1', 'mikusune123@gmail.com', 5, '2025-04-17 23:23:59', 1),
(79, '::1', 'mikusune123', NULL, '2025-04-17 23:43:52', 0),
(80, '::1', 'mikusune123', 9, '2025-04-17 23:51:45', 0),
(81, '::1', 'mikusune123@gmail.com', 9, '2025-04-17 23:52:05', 1),
(82, '::1', 'mikusune123@gmail.com', 9, '2025-04-18 00:04:40', 1),
(83, '::1', 'admin@admin.com', 3, '2025-04-18 00:05:22', 1),
(84, '::1', 'mikusune123@gmail.com', 11, '2025-04-18 01:06:03', 1),
(85, '::1', 'admin@admin.com', 3, '2025-04-18 01:11:32', 1),
(86, '::1', 'mikusune123@gmail.com', 11, '2025-04-18 01:12:47', 1),
(87, '::1', 'mikusune123@gmail.com', 11, '2025-04-18 12:24:09', 1),
(88, '::1', 'mikusune123@gmail.com', 11, '2025-04-20 13:38:40', 1),
(89, '::1', 'mikusune123@gmail.com', 11, '2025-04-20 15:04:06', 1),
(90, '::1', 'admin@admin.com', 3, '2025-04-20 15:38:05', 1),
(91, '::1', 'mikusune123@gmail.com', 11, '2025-04-20 15:40:51', 1),
(92, '::1', 'mikusune123@gmail.com', 11, '2025-04-21 00:52:11', 1),
(93, '::1', 'admin@admin.com', 3, '2025-04-21 01:48:18', 1),
(94, '::1', 'admin@admin.com', 3, '2025-04-21 14:50:38', 1),
(95, '::1', 'admin@admin.com', 3, '2025-04-21 16:02:08', 1),
(96, '::1', 'mikusune123@gmail.com', 11, '2025-04-21 18:32:19', 1),
(97, '::1', 'trimuryanto895@gmail.com', 12, '2025-04-21 19:37:30', 1),
(98, '::1', 'mikusune123@gmail.com', 11, '2025-04-21 19:40:50', 1),
(99, '::1', 'admin@admin.com', 3, '2025-04-21 19:47:19', 1),
(100, '::1', 'admin@admin.com', 3, '2025-04-21 23:50:42', 1),
(101, '::1', 'mikusune123@gmail.com', 11, '2025-04-22 00:14:42', 1),
(102, '::1', 'mikusune123@gmail.com', 11, '2025-04-22 00:52:45', 1),
(103, '::1', 'mikusune123@gmail.com', 11, '2025-04-22 01:03:14', 1),
(104, '::1', 'mikusune123@gmail.com', 11, '2025-04-22 01:14:14', 1),
(105, '::1', 'muryxmiku@gmail.com', 13, '2025-04-22 01:36:38', 1),
(106, '::1', 'raihan123', NULL, '2025-04-22 01:45:41', 0),
(107, '::1', 'raihan123', NULL, '2025-04-22 01:45:44', 0),
(108, '::1', 'muryxmiku@gmail.com', 14, '2025-04-22 01:46:31', 1),
(109, '::1', 'admin@admin.com', 3, '2025-04-22 02:06:32', 1),
(110, '::1', 'mikusune123@gmail.com', 11, '2025-04-22 12:12:10', 1),
(111, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 10:45:16', 1),
(112, '::1', 'admin@admin.com', 3, '2025-04-25 10:45:39', 1),
(113, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 11:10:11', 1),
(114, '::1', 'admin@admin.com', 3, '2025-04-25 11:11:02', 1),
(115, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 12:25:49', 1),
(116, '::1', 'admin@admin.com', 3, '2025-04-25 12:27:34', 1),
(117, '::1', 'admin@admin.com', 3, '2025-04-25 13:45:54', 1),
(118, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 13:46:49', 1),
(119, '::1', 'admin@admin.com', 3, '2025-04-25 13:47:21', 1),
(120, '::1', 'admin@admin.com', 3, '2025-04-25 13:52:21', 1),
(121, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 13:57:59', 1),
(122, '::1', 'admin@admin.com', 3, '2025-04-25 14:00:49', 1),
(123, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:01:14', 1),
(124, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:05:20', 1),
(125, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:05:34', 1),
(126, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:05:52', 1),
(127, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:08:10', 1),
(128, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:12:40', 1),
(129, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:17:11', 1),
(130, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:20:53', 1),
(131, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:29:01', 1),
(132, '::1', 'mikusune123@gmail.com', 11, '2025-04-25 14:31:24', 1),
(133, '::1', 'admin@admin.com', 3, '2025-04-25 16:53:58', 1),
(134, '::1', 'admin@admin.com', 3, '2025-04-27 04:51:26', 1),
(135, '::1', 'admin@admin.com', 3, '2025-04-28 10:21:54', 1),
(136, '::1', 'admin@admin.com', 3, '2025-05-02 06:02:37', 1),
(137, '::1', 'mikusune123@gmail.com', 11, '2025-05-02 07:26:59', 1),
(138, '::1', 'mikusune123@gmail.com', 11, '2025-05-02 10:03:21', 1),
(139, '::1', 'admin@admin.com', 3, '2025-05-02 11:59:18', 1),
(140, '::1', 'admin@admin.com', 3, '2025-05-07 09:01:40', 1),
(141, '::1', 'admin@admin.com', 3, '2025-05-07 09:02:46', 1),
(142, '::1', 'mikusune123@gmail.com', 11, '2025-05-07 09:04:54', 1),
(143, '::1', 'admin@admin.com', 3, '2025-05-07 09:12:23', 1),
(144, '::1', 'mikusune123@gmail.com', 11, '2025-05-07 09:17:27', 1),
(145, '::1', 'admin@admin.com', 3, '2025-06-16 16:04:24', 1),
(146, '::1', 'muryxmiku@gmail.com', 14, '2025-06-16 16:25:50', 1),
(147, '::1', 'mikusune123@gmail.com', 11, '2025-06-16 16:28:14', 1),
(148, '::1', 'trimuryanto895@gmail.com', 12, '2025-06-16 16:28:27', 1),
(149, '::1', 'admin@admin.com', 3, '2025-06-16 16:43:30', 1),
(150, '::1', 'trimuryanto895@gmail.com', 12, '2025-06-16 16:44:29', 1),
(151, '::1', 'mikusune123@gmail.com', 11, '2025-06-23 13:01:15', 1),
(152, '::1', 'mikusune123', NULL, '2025-06-23 13:01:36', 0),
(153, '::1', 'mikusune123@gmail.com', 11, '2025-06-23 13:03:50', 1),
(154, '::1', '\' OR \'1\'=\'1', NULL, '2025-06-23 13:10:03', 0),
(155, '::1', '\' OR \'1\'=\'1', NULL, '2025-06-23 13:10:33', 0),
(156, '::1', 'mikusune123', NULL, '2025-06-23 13:11:58', 0),
(157, '::1', 'mikusune123', NULL, '2025-06-23 13:12:01', 0),
(158, '::1', 'mikusune123', NULL, '2025-06-23 13:12:04', 0),
(159, '::1', 'mikusune123', NULL, '2025-06-23 13:12:06', 0),
(160, '::1', 'mikusune123', NULL, '2025-06-23 13:12:09', 0),
(161, '::1', 'mikusune123', NULL, '2025-06-23 13:12:13', 0),
(162, '::1', 'mikusune123', NULL, '2025-06-23 13:12:18', 0),
(163, '::1', 'mikusune123', NULL, '2025-06-23 13:12:22', 0),
(164, '::1', 'mikusune123', NULL, '2025-06-23 13:12:25', 0),
(165, '::1', 'mikusune123', NULL, '2025-06-23 13:12:27', 0),
(166, '::1', 'mikusune123', NULL, '2025-06-23 13:12:29', 0),
(167, '::1', 'mikusune123', NULL, '2025-06-23 13:12:32', 0),
(168, '::1', 'mikusune123', NULL, '2025-06-23 13:12:35', 0),
(169, '::1', 'mikusune123', NULL, '2025-06-23 13:12:38', 0),
(170, '::1', 'mikusune123', NULL, '2025-06-23 13:12:41', 0),
(171, '::1', 'mikusune123', NULL, '2025-06-23 13:12:43', 0),
(172, '::1', 'mikusune123', NULL, '2025-06-23 13:12:47', 0),
(173, '::1', 'mikusune123', NULL, '2025-06-23 13:12:50', 0),
(174, '::1', 'ZAP', NULL, '2025-06-23 13:52:00', 0),
(175, '::1', 'mikusune123@gmail.com', 11, '2025-07-25 13:51:58', 1),
(176, '::1', 'mikusune123@gmail.com', 11, '2025-07-25 17:09:41', 1),
(177, '::1', 'mikusune123@gmail.com', 11, '2025-07-25 17:15:04', 1),
(178, '::1', 'mikusune123@gmail.com', 11, '2025-07-25 17:16:20', 1),
(179, '::1', 'admin@admin.com', 3, '2025-07-25 17:19:16', 1),
(180, '::1', 'admin@admin.com', 3, '2025-07-26 09:46:07', 1),
(181, '::1', 'mikusune123@gmail.com', 11, '2025-07-26 09:46:27', 1),
(182, '::1', 'admin@admin.com', 3, '2025-07-26 11:20:19', 1),
(183, '::1', 'admin@admin.com', 3, '2025-07-27 12:31:45', 1),
(184, '192.168.1.7', 'mikusune123@gmail.com', 11, '2025-07-27 13:16:24', 1),
(185, '::1', 'admin@admin.com', 3, '2025-08-04 03:08:06', 1),
(186, '::1', 'admin@admin.com', 3, '2025-08-19 04:55:58', 1),
(187, '::1', 'admin@admin.com', 3, '2025-08-20 10:04:45', 1),
(188, '::1', 'mikusune123@gmail.com', 11, '2025-08-20 15:17:23', 1),
(189, '::1', 'admin@admin.com', 3, '2025-08-20 15:57:50', 1),
(190, '::1', 'admin@admin.com', 3, '2025-08-20 15:57:51', 1),
(191, '::1', 'admin@admin.com', 3, '2025-08-22 04:59:21', 1),
(192, '::1', 'admin@admin.com', 3, '2025-08-25 07:28:14', 1),
(193, '::1', 'mikusune123@gmail.com', 11, '2025-08-25 07:38:34', 1),
(194, '::1', 'admin@admin.com', 3, '2025-09-19 02:02:58', 1),
(195, '::1', 'admin@admin.com', 3, '2025-10-08 10:11:44', 1),
(196, '::1', 'admin@admin.com', 3, '2025-10-08 10:11:45', 1),
(197, '::1', 'admin@admin.com', 3, '2025-10-10 07:50:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `permission_id` int UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `id_item` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `id_item`, `quantity`, `created_at`, `updated_at`) VALUES
(49, 11, 42, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `from_type` enum('customer','admin') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'customer',
  `created_at` datetime NOT NULL,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `message`, `from_type`, `created_at`, `is_read`) VALUES
(1, 3, 'halo', 'customer', '2025-04-25 11:04:03', 1),
(2, 3, 'hlo', 'customer', '2025-04-25 11:08:00', 1),
(3, 11, 'p', 'customer', '2025-04-25 11:10:15', 1),
(4, 2, 'Halo, saya ingin bertanya tentang produk', 'customer', '2025-04-25 10:00:00', 1),
(5, 2, 'Baik, ada yang bisa kami bantu?', 'admin', '2025-04-25 10:01:00', 1),
(6, 2, 'Apakah produk sayuran masih fresh?', 'customer', '2025-04-25 10:02:00', 1),
(7, 3, 'w', 'customer', '2025-04-25 11:27:06', 1),
(8, 3, 'iya', 'admin', '2025-04-25 12:20:54', 0),
(9, 11, 'iya', 'admin', '2025-04-25 12:21:01', 1),
(10, 11, 'mantap', 'customer', '2025-04-25 12:26:41', 1),
(11, 11, 'k', 'customer', '2025-04-25 12:26:50', 1),
(12, 3, 'halo', 'admin', '2025-04-25 12:28:52', 0),
(13, 3, 'p', 'customer', '2025-04-25 12:29:39', 1),
(14, 3, 'p', 'customer', '2025-04-25 12:32:22', 1),
(15, 3, 'halo', 'customer', '2025-04-25 12:32:28', 1),
(16, 3, 'wasalam', 'customer', '2025-04-25 12:34:50', 1),
(17, 3, 'waasdpkasdf', 'admin', '2025-04-25 12:35:09', 0),
(18, 3, 'mantap', 'customer', '2025-04-25 12:35:23', 1),
(19, 3, 'iya', 'customer', '2025-04-25 12:40:51', 1),
(20, 3, 'halo apakah tersedia', 'customer', '2025-04-25 12:44:19', 1),
(21, 3, 'p', 'customer', '2025-04-25 12:50:10', 1),
(22, 3, 'ok', 'customer', '2025-04-25 12:52:36', 1),
(23, 3, 'p', 'customer', '2025-04-25 12:57:59', 1),
(24, 3, 'saya order', 'customer', '2025-04-25 13:41:57', 1),
(25, 3, 'ok', 'admin', '2025-04-25 13:42:06', 0),
(26, 11, 'mikusune123', 'customer', '2025-04-25 13:47:10', 1),
(27, 14, 'hallo...', 'customer', '2025-06-16 16:26:05', 1),
(28, 12, 'Halo, saya ingin bertanya tentang produk', 'customer', '2025-06-16 16:43:10', 1),
(29, 12, 'Baik, ada yang bisa kami bantu?', 'admin', '2025-06-16 16:43:56', 0),
(30, 12, 'Apakah produk sayuran masih fresh?', 'customer', '2025-06-16 16:44:36', 1),
(31, 11, '<script>alert(\'XSS Test\');</script>', 'customer', '2025-06-23 13:03:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int UNSIGNED NOT NULL,
  `nama_produk` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_type` varchar(120) NOT NULL,
  `brand` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `berat` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(50) NOT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `stok` int NOT NULL,
  `harga_jual` int DEFAULT '0',
  `gambar` varchar(255) NOT NULL,
  `deskripsi` varchar(5000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga_beli` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `nama_produk`, `kode_type`, `brand`, `berat`, `status`, `is_featured`, `stok`, `harga_jual`, `gambar`, `deskripsi`, `harga_beli`) VALUES
(35, 'daging ', 'dg', 'lokal', '1000', '1', 1, 0, 150000, '1743730319_f81201622943133ff00c.jpg', '-', 130000),
(36, 'apel fuji', 'buh', 'lokal', '1kg', '1', 0, 10, 12000, '1743747986_47cf038f7f9f19b94179.jpeg', '-', 10000),
(37, 'ikan tenggiri', 'ikn', 'lokal', '1kg', '1', 0, 0, 70000, '1743748032_f2595aeee45014954c93.jpeg', '-', 60000),
(38, 'ayam broiler', 'dg', 'lokal', '800gram', '1', 1, 0, 41000, '1745251210_c4dc3f3bcf89ef194c21.jpg', 'ayam broiler lokal', 36000),
(39, 'beras organik', 'smb', 'petani organik', '5000', '1', 0, 13, 110000, '1745735712_1e886cd4a67b34552bf8.jpg', 'beras organik', 100000),
(40, 'salmon fillet', 'ikn', 'lokal', '1000', '1', 1, 20, 299900, '1745736817_eb771f491b7d4c1b75dd.webp', '-', 280000),
(41, 'wortel', 'sy', 'lokal', '500', '1', 0, 30, 7000, '1745737359_9610d96499abde9e4a5e.jpg', '-', 6000),
(42, 'bawang bombay', 'sy', 'lokal', '100', '1', 0, 69, 11800, '1745737854_32f48de8e6bd061c4f66.png', '-', 11000),
(43, 'Caisim/ Sawi Hijau Segar', 'sy', 'lokal', '100', '1', 1, 68, 3000, '1745744976_178f03c8711847fe202f.webp', '-', 2800),
(44, 'bayam segar', 'sy', 'lokal', '100', '1', 0, 59, 3000, '1745739985_a21c4c79c36f27e03951.jpg', '-', 2800);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1738816392, 1),
(2, '2025-04-18-012829', 'App\\Database\\Migrations\\CreateCartsTable', 'default', 'App', 1744941210, 2),
(4, '2024_03_21_021600', 'App\\Database\\Migrations\\CreatePromosTable', 'default', 'App', 1745201951, 3),
(5, '2025-04-22-000001', 'App\\Database\\Migrations\\CreateOrdersTable', 'default', 'App', 1745263235, 4),
(6, '2025-04-22-000002', 'App\\Database\\Migrations\\CreateOrderItemsTable', 'default', 'App', 1745263235, 4),
(7, '2025-04-22-000003', 'App\\Database\\Migrations\\AddShippingStatusToOrders', 'default', 'App', 1745279378, 5),
(8, '2025-04-22-032935', 'App\\Database\\Migrations\\AddFeaturedToItem', 'default', 'App', 1745292614, 6),
(9, '2025-04-25-103800', 'App\\Database\\Migrations\\CreateChatMessages', 'default', 'App', 1745577743, 7),
(10, '2025-04-25-124500', 'App\\Database\\Migrations\\AddReadStatusToMessages', 'default', 'App', 1745578542, 8),
(11, '2025-08-20-114042', 'App\\Database\\Migrations\\CreateUserAddresses', 'default', 'App', 1755690059, 9),
(12, '2025-08-20-134926', 'App\\Database\\Migrations\\CreateShippingConfigTable', 'default', 'App', 1755697887, 10),
(13, '2025-08-20-000002', 'App\\Database\\Migrations\\AddPricesToItemTable', 'default', 'App', 1755838341, 11),
(14, '2025-08-25-000003', 'App\\Database\\Migrations\\CreateReturnsTable', 'default', 'App', 1756106785, 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `order_id` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gross_amount` decimal(10,2) NOT NULL,
  `shipping_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `courier` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `payment_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `shipping_status` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `transaction_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_id`, `gross_amount`, `shipping_address`, `courier`, `shipping_cost`, `payment_type`, `transaction_status`, `shipping_status`, `transaction_time`, `created_at`, `updated_at`) VALUES
(1, 11, 'ORDER-1745263637-11', 1292000.00, '123', 'jne', 20000.00, 'qris', 'settlement', 'processing', NULL, '2025-04-21 19:27:17', '2025-04-22 00:14:22'),
(2, 11, 'ORDER-1745263768-11', 59000.00, 'jalan saudara', 'tiki', 18000.00, 'qris', 'settlement', 'shipped', NULL, '2025-04-21 19:29:28', '2025-04-22 00:14:13'),
(3, 12, 'ORDER-1745264324-12', 140000.00, 'jalan margonda rt 04 rw 10 no 11a sukatani', 'jne', 20000.00, 'qris', 'settlement', 'shipped', NULL, '2025-04-21 19:38:44', '2025-04-22 02:18:51'),
(4, 3, 'ORDER-1745290739-3', 56900.00, 'as', 'jne', 20000.00, NULL, 'pending', 'pending', NULL, '2025-04-22 02:58:59', '2025-04-22 02:58:59'),
(5, 11, 'ORDER-1746170829-11', 365000.00, '123', 'jne', 20000.00, 'qris', 'expire', 'pending', NULL, '2025-05-02 07:27:09', '2025-07-25 17:42:05'),
(6, 11, 'ORDER-1746180241-11', 35800.00, '123', 'tiki', 18000.00, 'qris', 'settlement', 'pending', NULL, '2025-05-02 10:04:01', '2025-07-25 17:42:04'),
(7, 11, 'ORDER-1746613804-11', 32600.00, '123', 'jne', 20000.00, NULL, 'pending', 'pending', NULL, '2025-05-07 10:30:04', '2025-05-07 10:30:04'),
(8, 3, 'ORDER-1750090186-3', 73000.00, '123', 'jne', 20000.00, NULL, 'pending', 'pending', NULL, '2025-06-16 16:09:46', '2025-06-16 16:09:46'),
(9, 11, 'ORDER-1753454470-11', 54000.00, 'jalan saudara', 'jne', 20000.00, NULL, 'pending', 'pending', NULL, '2025-07-25 14:41:10', '2025-07-25 14:41:10'),
(10, 11, 'ORDER-1753527333-11', 42400.00, '123', 'tiki', 18000.00, 'qris', 'settlement', 'pending', NULL, '2025-07-26 10:55:33', '2025-07-26 11:20:58'),
(11, 3, 'ORDER-1755579372-3', 23000.00, '12', 'jne', 20000.00, 'qris', 'settlement', 'pending', NULL, '2025-08-19 04:56:12', '2025-08-22 05:07:16'),
(12, 3, 'ORDER-1755598968-3', 23000.00, '1', 'jne', 20000.00, 'qris', 'settlement', 'pending', NULL, '2025-08-19 10:22:48', '2025-08-22 05:07:15'),
(13, 3, 'ORDER-1755599303-3', 23000.00, '12', 'jne', 20000.00, 'qris', 'settlement', 'pending', NULL, '2025-08-19 10:28:23', '2025-08-22 05:07:15'),
(14, 3, 'ORDER-1755599397-3', 23000.00, '12', 'jne', 20000.00, 'qris', 'settlement', 'pending', NULL, '2025-08-19 10:29:57', '2025-08-22 05:07:14'),
(15, 3, 'ORDER-1755599747-3', 23000.00, '123', 'jne', 20000.00, 'qris', 'settlement', 'pending', NULL, '2025-08-19 10:35:47', '2025-08-22 05:07:14'),
(16, 3, 'ORDER-1755599864-3', 23000.00, '123', 'jne', 20000.00, 'qris', 'settlement', 'pending', NULL, '2025-08-19 10:37:44', '2025-08-22 05:07:13'),
(18, 11, 'ORDER-1755704237-11', 28000.00, 'jalaan jati indah bintaro', '', 25000.00, NULL, 'pending', 'pending', NULL, '2025-08-20 15:37:17', '2025-08-20 15:37:17'),
(19, 3, 'ORDER-1755848809-3', 28000.00, 'jalan johari raya no 11 a', '', 25000.00, NULL, 'pending', 'pending', NULL, '2025-08-22 07:46:49', '2025-08-22 07:46:49'),
(20, 3, 'ORDER-1755848958-3', 28000.00, 'jalan johari raya no 11 a', '', 25000.00, NULL, 'pending', 'pending', NULL, '2025-08-22 07:49:18', '2025-08-22 07:49:18'),
(21, 3, 'ORDER-1759923562-3', 31000.00, 'jalan johari raya no 11 a', '', 25000.00, 'qris', 'expire', 'pending', NULL, '2025-10-08 11:39:22', '2025-10-10 08:57:38'),
(22, 3, 'ORDER-1759923676-3', 31000.00, 'jalan johari raya no 11 a', '', 25000.00, 'bank_transfer', 'settlement', 'pending', NULL, '2025-10-08 11:41:16', '2025-10-10 08:57:37'),
(23, 3, 'ORDER-1760086930-3', 28000.00, 'jalan johari raya no 11 a', '', 25000.00, 'bank_transfer', 'settlement', 'pending', NULL, '2025-10-10 09:02:10', '2025-10-10 09:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 37, 6, 70000.00, '2025-04-21 19:27:17', '2025-04-21 19:27:17'),
(2, 1, 36, 11, 12000.00, '2025-04-21 19:27:17', '2025-04-21 19:27:17'),
(3, 1, 35, 6, 120000.00, '2025-04-21 19:27:17', '2025-04-21 19:27:17'),
(4, 2, 38, 1, 41000.00, '2025-04-21 19:29:28', '2025-04-21 19:29:28'),
(5, 3, 35, 1, 120000.00, '2025-04-21 19:38:44', '2025-04-21 19:38:44'),
(6, 4, 38, 1, 41000.00, '2025-04-22 02:58:59', '2025-04-22 02:58:59'),
(7, 5, 37, 2, 70000.00, '2025-05-02 07:27:10', '2025-05-02 07:27:10'),
(8, 5, 38, 5, 41000.00, '2025-05-02 07:27:10', '2025-05-02 07:27:10'),
(9, 6, 44, 1, 3000.00, '2025-05-02 10:04:01', '2025-05-02 10:04:01'),
(10, 6, 43, 1, 3000.00, '2025-05-02 10:04:01', '2025-05-02 10:04:01'),
(11, 6, 42, 1, 11800.00, '2025-05-02 10:04:01', '2025-05-02 10:04:01'),
(12, 7, 36, 1, 12000.00, '2025-05-07 10:30:04', '2025-05-07 10:30:04'),
(13, 7, 44, 1, 3000.00, '2025-05-07 10:30:04', '2025-05-07 10:30:04'),
(14, 8, 38, 1, 41000.00, '2025-06-16 16:09:46', '2025-06-16 16:09:46'),
(15, 8, 36, 1, 12000.00, '2025-06-16 16:09:46', '2025-06-16 16:09:46'),
(16, 9, 44, 5, 3000.00, '2025-07-25 14:41:10', '2025-07-25 14:41:10'),
(17, 9, 41, 1, 7000.00, '2025-07-25 14:41:10', '2025-07-25 14:41:10'),
(18, 9, 36, 1, 12000.00, '2025-07-25 14:41:10', '2025-07-25 14:41:10'),
(19, 10, 42, 1, 11800.00, '2025-07-26 10:55:33', '2025-07-26 10:55:33'),
(20, 10, 44, 1, 3000.00, '2025-07-26 10:55:33', '2025-07-26 10:55:33'),
(21, 10, 36, 1, 12000.00, '2025-07-26 10:55:33', '2025-07-26 10:55:33'),
(22, 11, 44, 1, 3000.00, '2025-08-19 04:56:13', '2025-08-19 04:56:13'),
(23, 12, 44, 1, 3000.00, '2025-08-19 10:22:48', '2025-08-19 10:22:48'),
(24, 13, 44, 1, 3000.00, '2025-08-19 10:28:23', '2025-08-19 10:28:23'),
(25, 14, 44, 1, 3000.00, '2025-08-19 10:29:57', '2025-08-19 10:29:57'),
(26, 15, 44, 1, 3000.00, '2025-08-19 10:35:47', '2025-08-19 10:35:47'),
(27, 16, 44, 1, 3000.00, '2025-08-19 10:37:44', '2025-08-19 10:37:44'),
(32, 18, 44, 1, 3000.00, '2025-08-20 15:37:17', '2025-08-20 15:37:17'),
(33, 20, 44, 1, 3000.00, '2025-08-22 07:49:18', '2025-08-22 07:49:18'),
(34, 21, 44, 2, 3000.00, '2025-10-08 11:39:22', '2025-10-08 11:39:22'),
(35, 22, 44, 2, 3000.00, '2025-10-08 11:41:16', '2025-10-08 11:41:16'),
(36, 23, 44, 1, 3000.00, '2025-10-10 09:02:11', '2025-10-10 09:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` int UNSIGNED NOT NULL,
  `id_item` int UNSIGNED NOT NULL,
  `discount_percentage` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`id`, `id_item`, `discount_percentage`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 38, 10, '2025-04-22', '2025-08-20', 'active', '2025-04-22 02:26:49', '2025-07-27 13:06:25'),
(3, 37, 5, '2025-07-20', '2025-08-10', 'active', '2025-04-22 03:19:15', '2025-07-27 13:04:54'),
(7, 36, 20, '2025-07-26', '2025-08-10', 'active', '2025-07-25 18:09:37', '2025-07-27 13:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `return_type` enum('replace','refund') COLLATE utf8mb4_general_ci NOT NULL,
  `reason` text COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('pending','approved','rejected','completed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `order_id`, `user_id`, `return_type`, `reason`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 11, 'replace', 'barang rusak', '1756107539_98409dd1cb9122d252bb.png', 'rejected', '2025-08-25 07:38:59', '2025-08-25 07:38:59'),
(2, 20, 3, 'replace', 'barang rusak', '1759920428_3fd27f23ff99677b1d80.jpg', 'approved', '2025-10-08 10:47:09', '2025-10-08 10:47:09'),
(3, 21, 3, 'refund', '123', '1760085090_0f2b75cf5ffadf1248b6.png', 'approved', '2025-10-10 08:31:30', '2025-10-10 08:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_config`
--

CREATE TABLE `shipping_config` (
  `id` int UNSIGNED NOT NULL,
  `price_per_km` int NOT NULL DEFAULT '5000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int NOT NULL,
  `kode_type` varchar(10) NOT NULL,
  `nama_type` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `kode_type`, `nama_type`, `img`) VALUES
(7, 'dg', 'Daging dan ayam', 'daging.jpg'),
(8, 'sy', 'Sayur-mayur', 'sayur.jpeg'),
(9, 'buh', 'Buah-buahan', 'category-thumb-1.jpg'),
(10, 'ikn', 'Ikan dan makanan laut', 'seafood.jpg'),
(12, 'smb', 'sembako', '1745252284_558fad22dae7f54b09fd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `role`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', NULL, '', 'admin123', '', NULL, NULL, NULL, '1', NULL, 1, 1, NULL, NULL, NULL),
(2, 'trimuryanto78@gmail.com', 'Admin123', NULL, '', '$2y$10$yD7x5MxpaI.V7gFSazKOxeN6sEpsJB4fcYKt1mkoB1rrYmXfqVCCO', NULL, NULL, NULL, 'f534909c3c4413e2530956a05aa4e129', NULL, NULL, 1, 0, '2025-02-06 16:29:40', '2025-02-09 06:20:21', NULL),
(3, 'admin@admin.com', 'mury', NULL, 'admin', '$2y$10$SMRvHEZ3NOi.Hi/cuIkXAukHcLeCRW/OjpFW4TS96iiVbsOrGrkbC', NULL, NULL, NULL, '435b263f2b96a9285f82709e0a4e7b2d', '1', NULL, 1, 0, '2025-04-02 08:05:53', '2025-10-10 07:50:57', NULL),
(11, 'mikusune123@gmail.com', 'mikusune123', 'trimuryanto', '', '$2y$10$0uon4U23zIs6/AMa.QBtuOsaInr.F6CO01abu1UHRrW0z4L3lY1ia', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-04-18 01:05:25', '2025-08-25 07:38:34', NULL),
(12, 'trimuryanto895@gmail.com', 'customer1', NULL, '', '$2y$10$wjmj2obzHoI7sDrAeIcG0.4acKufofWHxRAC1QABD90S.aujROcU.', '4836614a99fa607b03019ba56770d716', NULL, '2025-04-22 01:59:53', NULL, NULL, NULL, 1, 0, '2025-04-21 19:36:52', '2025-04-22 00:59:53', NULL),
(14, 'muryxmiku@gmail.com', 'raihan123', 'Raihan Dika', '', '$2y$10$JDdbbOI9or8DSg.Ja80SNe7ER.c7NrRq8aUgeJYxzBXd3BVL7ln76', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-04-22 01:45:56', '2025-04-22 01:46:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `longitude` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 3, 'jalan johari raya no 11 a', '-6.255471570692471', '106.77617669105531', '2025-08-20 11:44:49', '2025-08-20 11:44:49'),
(2, 3, 'jalan keamng', '-6.249167', '106.791778', '2025-08-20 12:21:43', '2025-08-20 12:21:43'),
(3, 3, 'jalan cisalak depok', '-6.380129939612401', '106.86573028564455', '2025-08-20 15:16:11', '2025-08-20 15:16:11'),
(4, 11, 'jalan harjamukti depok', '-6.378423954822116', '106.88701629638673', '2025-08-20 15:17:57', '2025-08-20 15:17:57'),
(5, 11, 'jalaan jati indah bintaro', '-6.260078811329877', '106.77417039871217', '2025-08-20 15:18:44', '2025-08-20 15:18:44'),
(6, 11, 'jalan ', '-6.245152457501045', '106.80266618728639', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_id_item_foreign` (`id_item`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promos_id_item_foreign` (`id_item`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returns_order_id_foreign` (`order_id`),
  ADD KEY `returns_user_id_foreign` (`user_id`);

--
-- Indexes for table `shipping_config`
--
ALTER TABLE `shipping_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_config`
--
ALTER TABLE `shipping_config`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promos`
--
ALTER TABLE `promos`
  ADD CONSTRAINT `promos_id_item_foreign` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `returns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
