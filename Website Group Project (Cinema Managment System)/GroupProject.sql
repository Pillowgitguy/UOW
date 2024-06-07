-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 07:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `cinema`
--

CREATE TABLE `cinema` (
  `cinemaName` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cinema`
--

INSERT INTO `cinema` (`cinemaName`, `location`, `description`, `username`) VALUES
('GV', 'bedokmall', 'lvl 5', 'mg1');

-- --------------------------------------------------------

--
-- Table structure for table `foodanddrink`
--

CREATE TABLE `foodanddrink` (
  `itemName` varchar(100) NOT NULL,
  `itemPrice` int(11) NOT NULL,
  `suspend` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodanddrink`
--

INSERT INTO `foodanddrink` (`itemName`, `itemPrice`, `suspend`) VALUES
('Bottled Water - Large', 3, 'N'),
('Bottled Water - Medium', 5, 'N'),
('Bottled Water - Small', 2, 'N'),
('Candy Bar - Large', 6, 'N'),
('Candy Bar - Medium', 5, 'N'),
('Candy Bar - Small', 4, 'N'),
('Cheeseburger - Large', 8, 'N'),
('Cheeseburger - Medium', 7, 'N'),
('Cheeseburger - Small', 6, 'N'),
('Chicken Tenders - Large', 9, 'N'),
('Chicken Tenders - Medium', 8, 'N'),
('Chicken Tenders - Small', 7, 'N'),
('Cold Dog - Large', 6, 'N'),
('Cold Dog - Medium', 5, 'N'),
('Cold Dog - Small', 4, 'N'),
('Cotton Candy - Large', 6, 'N'),
('Cotton Candy - Medium', 5, 'N'),
('Cotton Candy - Small', 4, 'N'),
('Dirt - Large', 6, 'N'),
('Dirt - Medium', 5, 'N'),
('Dirt - Small', 4, 'N'),
('Drain water - Large', 7, 'N'),
('Drain water - Medium', 6, 'N'),
('Drain water - Small', 5, 'N'),
('Flying Duck - Large', 9, 'N'),
('Flying Duck - Medium', 8, 'N'),
('Flying Duck - Small', 7, 'N'),
('French Fries - Large', 6, 'N'),
('French Fries - Medium', 5, 'N'),
('French Fries - Small', 4, 'N'),
('Fried Chicken - Even Larger', 20, 'N'),
('Fried Chicken - Large', 15, 'N'),
('Fried Chicken - Medium', 10, 'N'),
('Fried Chicken - Small', 5, 'N'),
('Hot Dog - Large', 6, 'N'),
('Hot Dog - Medium', 5, 'N'),
('Hot Dog - Small', 4, 'N'),
('Ice Cream - Large', 7, 'N'),
('Ice Cream - Medium', 6, 'N'),
('Ice Cream - Small', 5, 'N'),
('Indian Cuisine - Large', 8, 'N'),
('Indian Cuisine - Medium', 7, 'N'),
('Indian Cuisine - Small', 6, 'N'),
('Jail food - Large', 5, 'N'),
('Jail food - Medium', 4, 'N'),
('Jail food - Small', 3, 'N'),
('Jumbo Set A - Popcorn & Drink', 25, 'N'),
('Jumbo Set B - Hotdog Bun & Drink', 20, 'N'),
('Korean Food - Kid Portion', 10, 'N'),
('Korean Food - Large', 15, 'N'),
('Korean Food - Medium', 5, 'N'),
('Korean Food - Small', 10, 'N'),
('Nachos - Large', 8, 'N'),
('Nachos - Medium', 7, 'N'),
('Nachos - Small', 6, 'N'),
('Noodle - Large', 6, 'N'),
('Noodle - Medium', 5, 'N'),
('Noodle - Small', 4, 'N'),
('Not Food - Large', 8, 'N'),
('Not Food - Medium', 7, 'N'),
('Not Food - Small', 6, 'N'),
('Nothing - Large', 8, 'N'),
('Nothing - Medium', 7, 'N'),
('Nothing - Small', 6, 'N'),
('Onion Rings - Large', 6, 'N'),
('Onion Rings - Medium', 5, 'N'),
('Onion Rings - Small', 4, 'N'),
('Peanuts - Large', 5, 'N'),
('Peanuts - Medium', 4, 'N'),
('Peanuts - Small', 3, 'N'),
('Pizza - Large', 8, 'N'),
('Pizza - Medium', 7, 'N'),
('Pizza - Small', 6, 'N'),
('Popcorn - Large', 7, 'N'),
('Soda - Large', 5, 'N'),
('Soda - Medium', 4, 'N'),
('Soda - Small', 3, 'N'),
('Soft Pretzel - Large', 5, 'N'),
('Soft Pretzel - Medium', 4, 'N'),
('Soft Pretzel - Small', 3, 'N'),
('Some Food - Large', 6, 'N'),
('Some Food - Medium', 5, 'N'),
('Some Food - Small', 4, 'N'),
('Things - Large', 6, 'N'),
('Things - Medium', 5, 'N'),
('Things - Small', 4, 'N'),
('Unpoped Corn - Large', 5, 'N'),
('Unpoped Corn - Medium', 4, 'N'),
('Unpoped Corn - Small', 3, 'N'),
('Unpoped Corn - Very Large', 7, 'N'),
('Value Set A - Popcorn & Drink', 10, 'N'),
('Value Set B - Hotdog Bun & Drink', 5, 'N'),
('Value Set C - Nacho Chips & Drink', 15, 'N'),
('VERY BIG Set A - Popcorn & Drink', 25, 'N'),
('VERY BIG Set B - Hotdog Bun & Drink', 20, 'N'),
('Western Food - Jumbo', 5, 'N'),
('Western Food - Large', 5, 'N'),
('Western Food - Medium', 4, 'N'),
('Western Food - Small', 3, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `foodanddrinkstransactions`
--

CREATE TABLE `foodanddrinkstransactions` (
  `foodDrinkId` int(11) NOT NULL,
  `itemName` varchar(100) DEFAULT NULL,
  `itemPrice` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `purchaseTime` datetime NOT NULL DEFAULT current_timestamp(),
  `cinemaName` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodanddrinkstransactions`
--

INSERT INTO `foodanddrinkstransactions` (`foodDrinkId`, `itemName`, `itemPrice`, `quantity`, `username`, `purchaseTime`, `cinemaName`) VALUES
(1, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-01 09:19:43', 'GV'),
(2, 'Value Set B - Hotdog Bun & Drink', 5, 2, 'cx2', '2023-05-01 16:19:43', 'GV'),
(3, 'Value Set C - Nacho Chips & Drink', 15, 5, 'sarahlim', '2023-05-01 09:35:29', 'GV'),
(4, 'Bottled Water - Medium', 5, 1, 'sarahlim', '2023-05-01 17:19:43', 'GV'),
(5, 'Bottled Water - Medium', 5, 1, 'sarahlim', '2023-05-02 17:19:43', 'GV'),
(6, 'Value Set C - Nacho Chips & Drink', 15, 2, 'stevenlim', '2023-05-02 17:19:43', 'GV'),
(7, 'Bottled Water - Large', 3, 1, 'cx3', '2023-05-02 17:19:43', 'GV'),
(8, 'Bottled Water - Large', 3, 1, 'cx3', '2023-05-02 17:19:43', 'GV'),
(9, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-02 17:19:43', 'GV'),
(10, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'stevenlim', '2023-05-02 17:19:43', 'GV'),
(11, 'Chicken Tenders - Small', 7, 1, 'cx1', '2023-05-03 09:19:43', 'GV'),
(12, 'Value Set B - Hotdog Bun & Drink', 5, 2, 'stevenlim', '2023-05-03 16:19:43', 'GV'),
(13, 'Value Set C - Nacho Chips & Drink', 15, 5, 'stevenlim', '2023-05-03 09:35:29', 'GV'),
(14, 'Chicken Tenders - Small', 7, 1, 'sarahlim', '2023-05-04 17:19:43', 'GV'),
(15, 'Value Set C - Nacho Chips & Drink', 15, 1, 'cx1', '2023-05-04 17:19:43', 'GV'),
(16, 'Value Set C - Nacho Chips & Drink', 15, 2, 'stevenlim', '2023-05-04 17:19:43', 'GV'),
(17, 'Chicken Tenders - Small', 7, 1, 'stevenlim', '2023-05-04 17:19:43', 'GV'),
(18, 'Value Set A - Popcorn & Drink', 10, 1, 'stevenlim', '2023-05-05 17:19:43', 'GV'),
(19, 'Chicken Tenders - Small', 7, 1, 'sarahlim', '2023-05-05 17:19:43', 'GV'),
(20, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'cx4', '2023-05-05 17:19:43', 'GV'),
(21, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'stevenlim', '2023-05-05 09:19:43', 'GV'),
(22, 'Value Set B - Hotdog Bun & Drink', 5, 2, 'cx2', '2023-05-06 16:19:43', 'GV'),
(23, 'Value Set C - Nacho Chips & Drink', 15, 5, 'sarahlim', '2023-05-06 09:35:29', 'GV'),
(24, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'stevenlim', '2023-05-07 17:19:43', 'GV'),
(25, 'Value Set C - Nacho Chips & Drink', 15, 1, 'sarahlim', '2023-05-07 17:19:43', 'GV'),
(26, 'French Fries - Large', 6, 2, 'cx4', '2023-05-07 17:19:43', 'GV'),
(27, 'Value Set A - Popcorn & Drink', 10, 1, 'wendychua', '2023-05-07 17:19:43', 'GV'),
(28, 'French Fries - Large', 6, 1, 'cx3', '2023-05-07 17:19:43', 'GV'),
(29, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-07 17:19:43', 'GV'),
(30, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'stevenlim', '2023-05-07 17:19:43', 'GV'),
(31, 'Value Set A - Popcorn & Drink', 10, 1, 'sarahlim', '2023-05-08 09:19:43', 'GV'),
(32, 'French Fries - Large', 6, 2, 'stevenlim', '2023-05-09 16:19:43', 'GV'),
(33, 'Value Set C - Nacho Chips & Drink', 15, 5, 'sarahlim', '2023-05-09 09:35:29', 'GV'),
(34, 'Onion Rings - Large', 6, 1, 'cx1', '2023-05-09 17:19:43', 'GV'),
(35, 'Value Set C - Nacho Chips & Drink', 15, 1, 'wendychua', '2023-05-09 17:19:43', 'GV'),
(36, 'French Fries - Large', 6, 2, 'cx4', '2023-05-09 17:19:43', 'GV'),
(37, 'Value Set A - Popcorn & Drink', 10, 1, 'wendychua', '2023-05-10 17:19:43', 'GV'),
(38, 'Pizza - Large', 8, 1, 'stevenlim', '2023-05-10 17:19:43', 'GV'),
(39, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-11 17:19:43', 'GV'),
(40, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'cx4', '2023-05-11 17:19:43', 'GV'),
(41, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-12 09:19:43', 'GV'),
(42, 'Value Set B - Hotdog Bun & Drink', 5, 2, 'sarahlim', '2023-05-12 16:19:43', 'GV'),
(43, 'Onion Rings - Large', 6, 5, 'stevenlim', '2023-05-12 09:35:29', 'GV'),
(44, 'Value Set C - Nacho Chips & Drink', 15, 1, 'sarahlim', '2023-05-13 17:19:43', 'GV'),
(45, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'wendychua', '2023-05-13 17:19:43', 'GV'),
(46, 'Jumbo Set B - Hotdog Bun & Drink', 20, 2, 'sarahlim', '2023-05-13 17:19:43', 'GV'),
(47, 'French Fries - Large', 6, 1, 'stevenlim', '2023-05-13 17:19:43', 'GV'),
(48, 'Value Set A - Popcorn & Drink', 10, 1, 'cx3', '2023-05-13 17:19:43', 'GV'),
(49, 'Pizza - Large', 8, 1, 'cx1', '2023-05-13 17:19:43', 'GV'),
(50, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'sarahlim', '2023-05-13 17:19:43', 'GV'),
(51, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-14 09:19:43', 'GV'),
(52, 'Value Set B - Hotdog Bun & Drink', 5, 2, 'cx2', '2023-05-14 16:19:43', 'GV'),
(53, 'French Fries - Large', 6, 5, 'cx2', '2023-05-14 09:35:29', 'GV'),
(54, 'Value Set C - Nacho Chips & Drink', 15, 1, 'stevenlim', '2023-05-15 17:19:43', 'GV'),
(55, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'cx1', '2023-05-15 17:19:43', 'GV'),
(56, 'Value Set C - Nacho Chips & Drink', 15, 2, 'stevenlim', '2023-05-15 17:19:43', 'GV'),
(57, 'Pizza - Large', 8, 1, 'cx3', '2023-05-15 17:19:43', 'GV'),
(58, 'Value Set A - Popcorn & Drink', 10, 1, 'cx3', '2023-05-15 17:19:43', 'GV'),
(59, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-15 17:19:43', 'GV'),
(60, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'sarahlim', '2023-05-15 17:19:43', 'GV'),
(61, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-16 09:19:43', 'GV'),
(62, 'French Fries - Large', 6, 2, 'cx2', '2023-05-16 16:19:43', 'GV'),
(63, 'Jumbo Set B - Hotdog Bun & Drink', 20, 5, 'wendychua', '2023-05-16 09:35:29', 'GV'),
(64, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'cx1', '2023-05-17 17:19:43', 'GV'),
(65, 'Onion Rings - Large', 6, 1, 'sarahlim', '2023-05-17 17:19:43', 'GV'),
(66, 'Value Set C - Nacho Chips & Drink', 15, 2, 'wendychua', '2023-05-17 17:19:43', 'GV'),
(67, 'Pizza - Large', 8, 1, 'sarahlim', '2023-05-17 17:19:43', 'GV'),
(68, 'French Fries - Large', 6, 1, 'cx3', '2023-05-17 17:19:43', 'GV'),
(69, 'Value Set A - Popcorn & Drink', 10, 1, 'stevenlim', '2023-05-17 17:19:43', 'GV'),
(70, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'cx4', '2023-05-17 17:19:43', 'GV'),
(71, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'wendychua', '2023-05-17 09:19:43', 'GV'),
(72, 'French Fries - Large', 6, 2, 'cx2', '2023-05-17 16:19:43', 'GV'),
(73, 'Value Set C - Nacho Chips & Drink', 15, 5, 'cx2', '2023-05-17 09:35:29', 'GV'),
(74, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'sarahlim', '2023-05-17 17:19:43', 'GV'),
(75, 'Value Set C - Nacho Chips & Drink', 15, 1, 'cx1', '2023-05-17 17:19:43', 'GV'),
(76, 'Jumbo Set B - Hotdog Bun & Drink', 20, 2, 'wendychua', '2023-05-17 17:19:43', 'GV'),
(77, 'Value Set A - Popcorn & Drink', 10, 1, 'cx3', '2023-05-01 17:19:43', 'GV'),
(78, 'French Fries - Large', 6, 1, 'sarahlim', '2023-05-18 17:19:43', 'GV'),
(79, 'Value Set A - Popcorn & Drink', 10, 1, 'wendychua', '2023-05-18 17:19:43', 'GV'),
(80, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'cx4', '2023-05-18 17:19:43', 'GV'),
(81, 'Value Set A - Popcorn & Drink', 10, 1, 'cx1', '2023-05-18 09:19:43', 'GV'),
(82, 'French Fries - Large', 6, 2, 'cx2', '2023-05-18 16:19:43', 'GV'),
(83, 'Jumbo Set B - Hotdog Bun & Drink', 20, 5, 'cx2', '2023-05-18 09:35:29', 'GV'),
(84, 'Value Set C - Nacho Chips & Drink', 15, 1, 'wendychua', '2023-05-18 17:19:43', 'GV'),
(85, 'Jumbo Set B - Hotdog Bun & Drink', 20, 1, 'stevenlim', '2023-05-18 17:19:43', 'GV'),
(86, 'French Fries - Large', 6, 2, 'cx4', '2023-05-19 17:19:43', 'GV'),
(87, 'French Fries - Large', 6, 1, 'cx3', '2023-05-19 17:19:43', 'GV'),
(88, 'Value Set A - Popcorn & Drink', 10, 1, 'cx3', '2023-05-19 17:19:43', 'GV'),
(89, 'Value Set A - Popcorn & Drink', 10, 1, 'wendychua', '2023-05-19 17:19:43', 'GV'),
(90, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'cx4', '2023-05-19 17:19:43', 'GV'),
(91, 'French Fries - Large', 6, 1, 'cx1', '2023-05-20 09:19:43', 'GV'),
(92, 'French Fries - Large', 6, 2, 'wendychua', '2023-05-20 16:19:43', 'GV'),
(93, 'Jumbo Set B - Hotdog Bun & Drink', 20, 5, 'sarahlim', '2023-05-21 09:35:29', 'GV'),
(94, 'Onion Rings - Large', 6, 1, 'cx1', '2023-05-21 17:19:43', 'GV'),
(95, 'Value Set C - Nacho Chips & Drink', 15, 1, 'davidsim', '2023-05-22 17:19:43', 'GV'),
(96, 'Jumbo Set B - Hotdog Bun & Drink', 20, 2, 'sarahlim', '2023-05-22 17:19:43', 'GV'),
(97, 'Value Set A - Popcorn & Drink', 10, 1, 'cx3', '2023-05-23 17:19:43', 'GV'),
(98, 'Value Set A - Popcorn & Drink', 10, 1, 'stevenlim', '2023-05-23 17:19:43', 'GV'),
(99, 'Value Set A - Popcorn & Drink', 10, 1, 'sarahlim', '2023-05-23 17:19:43', 'GV'),
(100, 'Value Set B - Hotdog Bun & Drink', 5, 3, 'cx4', '2023-05-23 17:19:43', 'GV');

-- --------------------------------------------------------

--
-- Table structure for table `moviehall`
--

CREATE TABLE `moviehall` (
  `hallNo` int(11) NOT NULL,
  `cinemaName` varchar(100) NOT NULL,
  `suspend` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moviehall`
--

INSERT INTO `moviehall` (`hallNo`, `cinemaName`, `suspend`) VALUES
(1, 'GV', 'N'),
(2, 'GV', 'N'),
(3, 'GV', 'N'),
(4, 'GV', 'N'),
(5, 'GV', 'N'),
(6, 'GV', 'N'),
(8, 'GV', 'N'),
(9, 'GV', 'N'),
(10, 'GV', 'N'),
(11, 'GV', 'N'),
(12, 'GV', 'N'),
(13, 'GV', 'N'),
(14, 'GV', 'N'),
(15, 'GV', 'N'),
(16, 'GV', 'N'),
(17, 'GV', 'N'),
(18, 'GV', 'N'),
(19, 'GV', 'N'),
(20, 'GV', 'N'),
(21, 'GV', 'N'),
(22, 'GV', 'N'),
(23, 'GV', 'N'),
(24, 'GV', 'N'),
(25, 'GV', 'N'),
(26, 'GV', 'N'),
(27, 'GV', 'N'),
(28, 'GV', 'N'),
(29, 'GV', 'N'),
(30, 'GV', 'N'),
(31, 'GV', 'N'),
(32, 'GV', 'N'),
(33, 'GV', 'N'),
(34, 'GV', 'N'),
(35, 'GV', 'N'),
(36, 'GV', 'N'),
(37, 'GV', 'N'),
(38, 'GV', 'N'),
(39, 'GV', 'N'),
(40, 'GV', 'N'),
(41, 'GV', 'N'),
(42, 'GV', 'N'),
(43, 'GV', 'N'),
(44, 'GV', 'N'),
(45, 'GV', 'N'),
(46, 'GV', 'N'),
(47, 'GV', 'N'),
(48, 'GV', 'N'),
(49, 'GV', 'N'),
(50, 'GV', 'N'),
(51, 'GV', 'N'),
(52, 'GV', 'N'),
(53, 'GV', 'N'),
(54, 'GV', 'N'),
(55, 'GV', 'N'),
(56, 'GV', 'N'),
(57, 'GV', 'N'),
(58, 'GV', 'N'),
(59, 'GV', 'N'),
(60, 'GV', 'N'),
(61, 'GV', 'N'),
(62, 'GV', 'N'),
(63, 'GV', 'N'),
(64, 'GV', 'N'),
(65, 'GV', 'N'),
(66, 'GV', 'N'),
(67, 'GV', 'N'),
(68, 'GV', 'N'),
(69, 'GV', 'N'),
(70, 'GV', 'N'),
(71, 'GV', 'N'),
(72, 'GV', 'N'),
(73, 'GV', 'N'),
(74, 'GV', 'N'),
(75, 'GV', 'N'),
(76, 'GV', 'N'),
(77, 'GV', 'N'),
(78, 'GV', 'N'),
(79, 'GV', 'N'),
(80, 'GV', 'N'),
(81, 'GV', 'N'),
(82, 'GV', 'N'),
(83, 'GV', 'N'),
(84, 'GV', 'N'),
(85, 'GV', 'N'),
(86, 'GV', 'N'),
(87, 'GV', 'N'),
(88, 'GV', 'N'),
(89, 'GV', 'N'),
(90, 'GV', 'N'),
(91, 'GV', 'N'),
(92, 'GV', 'N'),
(93, 'GV', 'N'),
(94, 'GV', 'N'),
(95, 'GV', 'N'),
(96, 'GV', 'N'),
(97, 'GV', 'N'),
(98, 'GV', 'N'),
(99, 'GV', 'N'),
(100, 'GV', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `moviesession`
--

CREATE TABLE `moviesession` (
  `movieName` varchar(100) NOT NULL,
  `screeningDateTime` datetime NOT NULL,
  `movieDescription` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `hallNo` int(11) NOT NULL,
  `suspend` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moviesession`
--

INSERT INTO `moviesession` (`movieName`, `screeningDateTime`, `movieDescription`, `duration`, `hallNo`, `suspend`) VALUES
('A bear ate me', '2023-05-26 15:45:00', 'Must be hungry', 90, 1, 'N'),
('A bearded Man', '2023-05-25 07:00:00', 'A mysterious man, maybe a te', 120, 2, 'N'),
('A group of Bearded Man', '2023-05-25 13:30:00', 'More man', 143, 3, 'N'),
('A new world', '2023-05-28 17:45:00', 'I am not sure what happen to the old one', 90, 1, 'N'),
('A Pulp Fiction', '2023-05-17 14:00:00', 'The lives of two mob hitmen, a box wife', 154, 2, 'N'),
('A Walk In Jurassic', '2023-05-19 21:30:00', 'During a preview tour', 127, 1, 'N'),
('After Hours', '2023-06-03 12:45:00', 'tale of a data programmer lost in downtown New York', 120, 4, 'N'),
('Aguirre, Wrath of God', '2023-06-03 16:45:00', 'Wild-eyed Klaus Kinski is a 16th-century explorer', 90, 3, 'N'),
('Ah Beng gone to jail', '2023-06-02 12:45:00', 'Life of an ah beng thats not nice', 90, 2, 'N'),
('Ah ma and friends', '2023-06-01 16:45:00', 'Shows that Ah Ma has friends', 90, 1, 'N'),
('Airplane!', '2023-06-04 12:45:00', 'comic philosophy is simple: let there be yuks', 90, 2, 'N'),
('Akira', '2023-06-04 16:45:00', 'Japanese animes unarguable classic', 90, 1, 'N'),
('Alexander Nevsky', '2023-06-05 12:45:00', 'a battle on the ice and some rousing Prokofiev music', 90, 1, 'N'),
('Alfie', '2023-06-05 12:45:00', 'Often misappropriated as some kind of Loaded readers hymn-sheet', 120, 2, 'N'),
('All About My Mother', '2023-06-06 12:45:00', 'This story of grieving mother Cecilia Roth finding a new life', 60, 3, 'N'),
('All That Heaven Allows', '2023-06-05 16:45:00', 'A textbook lesson in saying two (or more) things at once', 90, 4, 'N'),
('All the Presidents Men', '2023-06-06 16:45:00', 'The ink on Nixons resignation letter was barely dry', 120, 4, 'N'),
('American Dream', '2023-06-01 12:45:00', 'they have great dreams', 120, 2, 'N'),
('American: Gone', '2023-06-03 12:45:00', 'Also another continued story of American Dream', 143, 3, 'N'),
('American: Prelude', '2023-06-01 16:45:00', 'Continued story of American Dream', 127, 1, 'N'),
('An Actors Revenge', '2023-06-02 16:45:00', 'stylized potboiler that took its cues from traditional Kabuki theatre', 90, 1, 'N'),
('An American in Paris', '2023-06-07 09:45:00', 'Not something you want to do', 90, 1, 'N'),
('Annie Hall', '2023-06-07 12:45:00', 'Her hall', 90, 3, 'N'),
('Another man', '2023-05-25 10:30:00', 'a friend of the first man', 127, 1, 'N'),
('Apocalypse Now', '2023-06-07 16:45:00', 'In its brilliant first hour, the movie delivers both the spectacular thrills', 90, 2, 'N'),
('Around the World in 80 Days', '2023-06-08 08:45:00', 'Based on a true story', 90, 1, 'N'),
('Arsenic and Old Lace', '2023-06-08 12:45:00', 'Cary Grant was rarely better than in this uproarious black comedy', 90, 3, 'N'),
('Assault On Precinct 13', '2023-06-09 12:45:00', 'BONG BONG BONG BONG', 120, 2, 'N'),
('Atanarjuat: Fast Runner', '2023-06-14 09:45:00', 'Arctic Circle, is based on an ancient yarn with excitements', 90, 1, 'N'),
('Atlantic City', '2023-06-14 12:45:00', 'Would-be croupier Susan Sarandon and two-bit gangster', 90, 3, 'N'),
('Au Hasard Balthasar', '2023-06-15 16:45:00', ' Jean-Luc Godard certainly thought so, saying of Bressons film', 90, 2, 'N'),
('Au Revoir les Enfants', '2023-06-15 08:45:00', 'A tender, compelling tear-jerker about a Jewish boy hidden from the Nazis', 90, 1, 'N'),
('Audition', '2023-06-15 12:45:00', 'The kinkiest, creepiest, most pungently', 90, 3, 'N'),
('Austin Powers', '2023-06-16 16:45:00', 'As the 1990s found time to recycle every single decade in one', 90, 3, 'N'),
('Avengers', '2023-05-18 14:30:00', 'A group of superheroes must destroy Earth', 143, 3, 'N'),
('Back To School', '2023-05-01 17:45:00', 'MacSpicy, a 17-year-old high school student', 90, 1, 'N'),
('Back to the Future', '2023-06-10 16:45:00', ' A time travel tale that heaps paradoxes and conundrums', 90, 4, 'N'),
('Batman', '2023-06-10 12:45:00', 'An astonishingly successful high-gothic reinvention', 60, 3, 'N'),
('Batman 23', '2023-06-10 16:45:00', 'became a bat', 120, 4, 'N'),
('Battleship Potemkin', '2023-06-11 09:45:00', 'Battleship Potemkin made it swing the other way', 90, 1, 'N'),
('Beau Travail', '2023-06-11 12:45:00', 'the rivalry between a Foreign Legion recruit and his jealous superior', 90, 3, 'N'),
('Becoming a Parent', '2023-05-29 08:45:00', 'stress spell backward is stress', 90, 2, 'N'),
('Becoming a Student', '2023-05-27 09:45:00', 'stress', 120, 4, 'N'),
('Becoming a Teacher', '2023-05-28 10:45:00', 'also stress', 90, 3, 'N'),
('Becoming a Terrorist', '2023-05-27 14:45:00', 'why even', 90, 1, 'N'),
('Before Sunrise', '2023-06-12 16:45:00', 'Two beautiful meet on a Eurorail train and walk around Vienna', 90, 2, 'N'),
('Being John Malkovich', '2023-06-12 08:45:00', ' one of the greatest American films of the 90s', 90, 1, 'N'),
('Beverly Hills Cop', '2023-06-12 12:45:00', 'The Bruckheimer-Simpson axis of evil in full effect', 90, 3, 'N'),
('Bicycle Thieves', '2023-06-13 12:45:00', 'How to steal bicycle', 120, 2, 'N'),
('Big Wednesday', '2023-06-13 16:45:00', 'The unexpectedly sentimental side of writer-director ', 90, 4, 'N'),
('Bill & Teds', '2023-06-13 12:45:00', 'Alex Winter travel back in time for some field research', 60, 3, 'N'),
('Bingo', '2023-05-26 08:45:00', 'A game of bingo', 90, 1, 'N'),
('Black Panther w/o Panther', '2023-05-17 10:45:00', 'Live without Panther', 90, 2, 'N'),
('Blackboard Jungle', '2023-06-14 16:45:00', 'Lurid high-school drama that introduced Hollywood to rock n roll', 120, 4, 'N'),
('Bongo Cat Story', '2023-05-30 08:45:00', 'BONG BONG BONG BONG', 120, 2, 'N'),
('Bongo Cat Story 2', '2023-05-30 10:45:00', 'Watch him play music', 90, 4, 'N'),
('Bongo Cat Story 3', '2023-05-30 18:45:00', 'Watch him play with kids', 60, 3, 'N'),
('Bongo Cat Story 4', '2023-06-01 08:45:00', 'Bongo play with my feelings', 120, 4, 'N'),
('Bongo Cat Story 5', '2023-06-02 09:45:00', 'Blesses of the Bongo', 90, 1, 'N'),
('Bongo Cat Story 6', '2023-06-03 07:45:00', 'i like cats', 90, 3, 'N'),
('Bongo Cat Story 7', '2023-06-04 09:45:00', 'How did I became Bongo cat', 90, 2, 'N'),
('Bongo Cat Story 8', '2023-06-05 08:45:00', 'Based on a true story', 90, 1, 'N'),
('Bongo Cat Story 9', '2023-06-06 08:45:00', 'Goodbye Bongo. gg', 90, 3, 'N'),
('Broke And Bobo', '2023-05-05 08:45:00', 'MacBoBO, a bobo that is always bobo', 90, 1, 'N'),
('Broke And Furious', '2023-05-04 09:45:00', 'MacNugget, a nugget that is always furious', 120, 4, 'N'),
('Broken Bowl', '2023-05-03 10:45:00', 'MacFish, a fish that exist in fast food', 90, 3, 'N'),
('Broken Childhood', '2023-05-02 17:45:00', 'MacChicken, a 5-year-old high school student', 90, 2, 'N'),
('Cabaret', '2023-06-05 12:45:00', 'Life is one big, perverse party ', 120, 2, 'N'),
('Capturing the Friedmans', '2023-06-05 16:45:00', 'persecution of a suburban family for unsubstantiated crime', 90, 4, 'N'),
('Caravaggio', '2023-06-06 12:45:00', 'WJarman brings all the irreverent force of his punk poetry', 60, 3, 'N'),
('Carry On Cleo', '2023-06-06 16:45:00', 'one of their more focused efforts, starring Jim Dale and Kenneth Conno', 120, 4, 'N'),
('Casablanca', '2023-06-07 09:45:00', 'Ricks Cafe is in Burbank, not north Africa, and Paul Henreid got his scar in make-up', 90, 1, 'N'),
('Casino', '2023-06-07 12:45:00', ' illustrating the workings of organized crime in Las Vegas', 90, 3, 'N'),
('Cat On a Hot Tin Roof', '2023-06-07 16:45:00', 'hrs were rarely better served than this luminous melodrama', 90, 2, 'N'),
('Céline and Julie', '2023-06-08 08:45:00', 'CTwo eccentric women run amok in Parisasino', 90, 1, 'N'),
('Central Station', '2023-06-08 12:45:00', 'kicked Latin Americas cinematic renaissance', 90, 3, 'N'),
('Chariots of Fire', '2023-06-05 12:45:00', 'Iconic running scenes accompanied by Vangelis score', 120, 2, 'N'),
('Chicken And Bobo', '2023-05-06 08:45:00', 'MacBoBO, a bobo that made friend with chicken', 90, 1, 'N'),
('Chicken And Friends', '2023-05-09 17:45:00', 'Join chichen and friend as the fight against the dark lord', 90, 1, 'N'),
('Chicken Run', '2023-06-05 16:45:00', 'Chicken can run', 90, 4, 'N'),
('Chinatown', '2023-06-06 12:45:00', 'Probably not from Singapore', 60, 3, 'N'),
('Chungking Express', '2023-06-06 16:45:00', 'love, longing, loneliness, time.', 120, 4, 'N'),
('Cinema Paradiso', '2023-06-07 09:45:00', 'is unabashedly sentimental, but its a touching homage to the magic of movies.', 90, 1, 'N'),
('Citizen Kane', '2023-06-07 12:45:00', 'But the voting is right.', 90, 3, 'N'),
('City of God', '2023-06-08 08:45:00', 'Dont believe them', 90, 1, 'N'),
('Clerks', '2023-06-07 16:45:00', 'it transcends its shortcomings through the inventiveness', 90, 2, 'N'),
('Close Encounters', '2023-06-08 12:45:00', 'visions and sounds he doesnt understand.', 90, 3, 'N'),
('Clueless', '2023-06-08 12:45:00', 'same', 90, 3, 'N'),
('Dark Lord And Friends', '2023-05-10 17:45:00', 'Dark loard made friend with chicken and others', 120, 2, 'N'),
('I can be ninja', '2023-05-26 11:45:00', 'Live without regret', 90, 2, 'N'),
('If I Can', '2023-05-15 10:45:00', 'Catch me if you can ', 90, 4, 'N'),
('If I Die', '2023-05-17 18:45:00', 'Story of the Life we left behind', 60, 3, 'N'),
('John The 1st', '2023-05-22 11:45:00', 'Story of John the 1st', 120, 4, 'N'),
('John The 2nd', '2023-05-23 10:45:00', 'Story of John the 2nd', 90, 1, 'N'),
('Seven Deadly chicken', '2023-05-11 10:45:00', '7Deadly Sins how about,7 Deadly chicken', 90, 3, 'N'),
('Weathering With John', '2023-05-24 08:45:00', 'Story set during a period of exceptionally rainy weather', 90, 2, 'N'),
('When The Star Alig', '2023-05-16 11:45:00', 'Based on a true story, star do Alig ', 90, 1, 'N'),
('Will Smith PoPo', '2023-05-24 08:45:00', 'Spin off of a chinese movie', 90, 3, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `seatNo` varchar(20) NOT NULL,
  `hallNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`seatNo`, `hallNo`) VALUES
('A1', 1),
('A1', 2),
('A1', 3),
('A1', 4),
('A1', 5),
('A1', 6),
('A1', 8),
('A1', 9),
('A1', 10),
('A1', 11),
('A1', 12),
('A1', 13),
('A1', 14),
('A1', 15),
('A1', 16),
('A1', 17),
('A1', 18),
('A1', 19),
('A1', 20),
('A1', 21),
('A1', 22),
('A1', 23),
('A1', 24),
('A1', 25),
('A1', 26),
('A1', 27),
('A1', 28),
('A1', 29),
('A1', 30),
('A1', 31),
('A1', 32),
('A1', 33),
('A1', 34),
('A1', 35),
('A1', 36),
('A1', 37),
('A1', 38),
('A1', 39),
('A1', 40),
('A1', 41),
('A1', 42),
('A1', 43),
('A1', 44),
('A1', 45),
('A1', 46),
('A1', 47),
('A1', 48),
('A1', 49),
('A1', 50),
('A1', 51),
('A1', 52),
('A1', 53),
('A1', 54),
('A1', 55),
('A1', 56),
('A1', 57),
('A1', 58),
('A1', 59),
('A1', 60),
('A1', 61),
('A1', 62),
('A1', 63),
('A1', 64),
('A1', 65),
('A1', 66),
('A1', 67),
('A1', 68),
('A1', 69),
('A1', 70),
('A1', 71),
('A1', 72),
('A1', 73),
('A1', 74),
('A1', 75),
('A1', 76),
('A1', 77),
('A1', 78),
('A1', 79),
('A1', 80),
('A1', 81),
('A1', 82),
('A1', 83),
('A1', 84),
('A1', 85),
('A1', 86),
('A1', 87),
('A1', 88),
('A1', 89),
('A1', 90),
('A1', 91),
('A1', 92),
('A1', 93),
('A1', 94),
('A1', 95),
('A1', 96),
('A1', 97),
('A1', 98),
('A1', 99),
('A1', 100),
('A2', 1),
('A2', 2),
('A2', 3),
('A2', 4),
('A2', 5),
('A2', 6),
('A2', 8),
('A2', 9),
('A2', 10),
('A2', 11),
('A2', 12),
('A2', 13),
('A2', 14),
('A2', 15),
('A2', 16),
('A2', 17),
('A2', 18),
('A2', 19),
('A2', 20),
('A2', 21),
('A2', 22),
('A2', 23),
('A2', 24),
('A2', 25),
('A2', 26),
('A2', 27),
('A2', 28),
('A2', 29),
('A2', 30),
('A2', 31),
('A2', 32),
('A2', 33),
('A2', 34),
('A2', 35),
('A2', 36),
('A2', 37),
('A2', 38),
('A2', 39),
('A2', 40),
('A2', 41),
('A2', 42),
('A2', 43),
('A2', 44),
('A2', 45),
('A2', 46),
('A2', 47),
('A2', 48),
('A2', 49),
('A2', 50),
('A2', 51),
('A2', 52),
('A2', 53),
('A2', 54),
('A2', 55),
('A2', 56),
('A2', 57),
('A2', 58),
('A2', 59),
('A2', 60),
('A2', 61),
('A2', 62),
('A2', 63),
('A2', 64),
('A2', 65),
('A2', 66),
('A2', 67),
('A2', 68),
('A2', 69),
('A2', 70),
('A2', 71),
('A2', 72),
('A2', 73),
('A2', 74),
('A2', 75),
('A2', 76),
('A2', 77),
('A2', 78),
('A2', 79),
('A2', 80),
('A2', 81),
('A2', 82),
('A2', 83),
('A2', 84),
('A2', 85),
('A2', 86),
('A2', 87),
('A2', 88),
('A2', 89),
('A2', 90),
('A2', 91),
('A2', 92),
('A2', 93),
('A2', 94),
('A2', 95),
('A2', 96),
('A2', 97),
('A2', 98),
('A2', 99),
('A2', 100),
('A3', 1),
('A3', 2),
('A3', 3),
('A3', 4),
('A3', 5),
('A3', 6),
('A3', 8),
('A3', 9),
('A3', 10),
('A3', 11),
('A3', 12),
('A3', 13),
('A3', 14),
('A3', 15),
('A3', 16),
('A3', 17),
('A3', 18),
('A3', 19),
('A3', 20),
('A3', 21),
('A3', 22),
('A3', 23),
('A3', 24),
('A3', 25),
('A3', 26),
('A3', 27),
('A3', 28),
('A3', 29),
('A3', 30),
('A3', 31),
('A3', 32),
('A3', 33),
('A3', 34),
('A3', 35),
('A3', 36),
('A3', 37),
('A3', 38),
('A3', 39),
('A3', 40),
('A3', 41),
('A3', 42),
('A3', 43),
('A3', 44),
('A3', 45),
('A3', 46),
('A3', 47),
('A3', 48),
('A3', 49),
('A3', 50),
('A3', 51),
('A3', 52),
('A3', 53),
('A3', 54),
('A3', 55),
('A3', 56),
('A3', 57),
('A3', 58),
('A3', 59),
('A3', 60),
('A3', 61),
('A3', 62),
('A3', 63),
('A3', 64),
('A3', 65),
('A3', 66),
('A3', 67),
('A3', 68),
('A3', 69),
('A3', 70),
('A3', 71),
('A3', 72),
('A3', 73),
('A3', 74),
('A3', 75),
('A3', 76),
('A3', 77),
('A3', 78),
('A3', 79),
('A3', 80),
('A3', 81),
('A3', 82),
('A3', 83),
('A3', 84),
('A3', 85),
('A3', 86),
('A3', 87),
('A3', 88),
('A3', 89),
('A3', 90),
('A3', 91),
('A3', 92),
('A3', 93),
('A3', 94),
('A3', 95),
('A3', 96),
('A3', 97),
('A3', 98),
('A3', 99),
('A3', 100),
('B1', 1),
('B1', 2),
('B1', 3),
('B1', 4),
('B1', 5),
('B1', 6),
('B1', 8),
('B1', 9),
('B1', 10),
('B1', 11),
('B1', 12),
('B1', 13),
('B1', 14),
('B1', 15),
('B1', 16),
('B1', 17),
('B1', 18),
('B1', 19),
('B1', 20),
('B1', 21),
('B1', 22),
('B1', 23),
('B1', 24),
('B1', 25),
('B1', 26),
('B1', 27),
('B1', 28),
('B1', 29),
('B1', 30),
('B1', 31),
('B1', 32),
('B1', 33),
('B1', 34),
('B1', 35),
('B1', 36),
('B1', 37),
('B1', 38),
('B1', 39),
('B1', 40),
('B1', 41),
('B1', 42),
('B1', 43),
('B1', 44),
('B1', 45),
('B1', 46),
('B1', 47),
('B1', 48),
('B1', 49),
('B1', 50),
('B1', 51),
('B1', 52),
('B1', 53),
('B1', 54),
('B1', 55),
('B1', 56),
('B1', 57),
('B1', 58),
('B1', 59),
('B1', 60),
('B1', 61),
('B1', 62),
('B1', 63),
('B1', 64),
('B1', 65),
('B1', 66),
('B1', 67),
('B1', 68),
('B1', 69),
('B1', 70),
('B1', 71),
('B1', 72),
('B1', 73),
('B1', 74),
('B1', 75),
('B1', 76),
('B1', 77),
('B1', 78),
('B1', 79),
('B1', 80),
('B1', 81),
('B1', 82),
('B1', 83),
('B1', 84),
('B1', 85),
('B1', 86),
('B1', 87),
('B1', 88),
('B1', 89),
('B1', 90),
('B1', 91),
('B1', 92),
('B1', 93),
('B1', 94),
('B1', 95),
('B1', 96),
('B1', 97),
('B1', 98),
('B1', 99),
('B1', 100),
('B2', 1),
('B2', 2),
('B2', 3),
('B2', 4),
('B2', 5),
('B2', 6),
('B2', 8),
('B2', 9),
('B2', 10),
('B2', 11),
('B2', 12),
('B2', 13),
('B2', 14),
('B2', 15),
('B2', 16),
('B2', 17),
('B2', 18),
('B2', 19),
('B2', 20),
('B2', 21),
('B2', 22),
('B2', 23),
('B2', 24),
('B2', 25),
('B2', 26),
('B2', 27),
('B2', 28),
('B2', 29),
('B2', 30),
('B2', 31),
('B2', 32),
('B2', 33),
('B2', 34),
('B2', 35),
('B2', 36),
('B2', 37),
('B2', 38),
('B2', 39),
('B2', 40),
('B2', 41),
('B2', 42),
('B2', 43),
('B2', 44),
('B2', 45),
('B2', 46),
('B2', 47),
('B2', 48),
('B2', 49),
('B2', 50),
('B2', 51),
('B2', 52),
('B2', 53),
('B2', 54),
('B2', 55),
('B2', 56),
('B2', 57),
('B2', 58),
('B2', 59),
('B2', 60),
('B2', 61),
('B2', 62),
('B2', 63),
('B2', 64),
('B2', 65),
('B2', 66),
('B2', 67),
('B2', 68),
('B2', 69),
('B2', 70),
('B2', 71),
('B2', 72),
('B2', 73),
('B2', 74),
('B2', 75),
('B2', 76),
('B2', 77),
('B2', 78),
('B2', 79),
('B2', 80),
('B2', 81),
('B2', 82),
('B2', 83),
('B2', 84),
('B2', 85),
('B2', 86),
('B2', 87),
('B2', 88),
('B2', 89),
('B2', 90),
('B2', 91),
('B2', 92),
('B2', 93),
('B2', 94),
('B2', 95),
('B2', 96),
('B2', 97),
('B2', 98),
('B2', 99),
('B2', 100),
('B3', 1),
('B3', 2),
('B3', 3),
('B3', 4),
('B3', 5),
('B3', 6),
('B3', 8),
('B3', 9),
('B3', 10),
('B3', 11),
('B3', 12),
('B3', 13),
('B3', 14),
('B3', 15),
('B3', 16),
('B3', 17),
('B3', 18),
('B3', 19),
('B3', 20),
('B3', 21),
('B3', 22),
('B3', 23),
('B3', 24),
('B3', 25),
('B3', 26),
('B3', 27),
('B3', 28),
('B3', 29),
('B3', 30),
('B3', 31),
('B3', 32),
('B3', 33),
('B3', 34),
('B3', 35),
('B3', 36),
('B3', 37),
('B3', 38),
('B3', 39),
('B3', 40),
('B3', 41),
('B3', 42),
('B3', 43),
('B3', 44),
('B3', 45),
('B3', 46),
('B3', 47),
('B3', 48),
('B3', 49),
('B3', 50),
('B3', 51),
('B3', 52),
('B3', 53),
('B3', 54),
('B3', 55),
('B3', 56),
('B3', 57),
('B3', 58),
('B3', 59),
('B3', 60),
('B3', 61),
('B3', 62),
('B3', 63),
('B3', 64),
('B3', 65),
('B3', 66),
('B3', 67),
('B3', 68),
('B3', 69),
('B3', 70),
('B3', 71),
('B3', 72),
('B3', 73),
('B3', 74),
('B3', 75),
('B3', 76),
('B3', 77),
('B3', 78),
('B3', 79),
('B3', 80),
('B3', 81),
('B3', 82),
('B3', 83),
('B3', 84),
('B3', 85),
('B3', 86),
('B3', 87),
('B3', 88),
('B3', 89),
('B3', 90),
('B3', 91),
('B3', 92),
('B3', 93),
('B3', 94),
('B3', 95),
('B3', 96),
('B3', 97),
('B3', 98),
('B3', 99),
('B3', 100);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketNo` int(11) NOT NULL,
  `ticketPrice` double NOT NULL,
  `ticketType` varchar(100) NOT NULL,
  `movieName` varchar(100) NOT NULL,
  `screeningDateTime` datetime NOT NULL,
  `seatNo` varchar(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `hallNo` int(11) DEFAULT NULL,
  `timePurchased` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketNo`, `ticketPrice`, `ticketType`, `movieName`, `screeningDateTime`, `seatNo`, `username`, `hallNo`, `timePurchased`) VALUES
(1, 8, 'child', 'Back To School', '2023-05-01 17:45:00', 'A1', 'cx1', 1, '2023-05-01 00:30:00'),
(2, 8, 'child', 'Back To School', '2023-05-01 17:45:00', 'A2', 'jasontan', 1, '2023-05-01 01:30:00'),
(3, 10, 'student', 'Back To School', '2023-05-01 17:45:00', 'A3', 'davidsim', 1, '2023-05-01 02:30:00'),
(4, 10, 'student', 'Back To School', '2023-05-01 17:45:00', 'B1', 'cx2', 1, '2023-05-01 03:30:00'),
(5, 15, 'adult', 'Back To School', '2023-05-01 17:45:00', 'B2', 'emilytan', 1, '2023-05-01 04:30:00'),
(6, 15, 'adult', 'Back To School', '2023-05-01 17:45:00', 'B3', 'cx3', 1, '2023-05-01 05:30:00'),
(7, 8, 'child', 'Broken Childhood', '2023-05-02 17:45:00', 'A1', 'cx1', 2, '2023-05-05 00:30:00'),
(10, 10, 'student', 'Broken Childhood', '2023-05-02 17:45:00', 'B1', 'prata', 2, '2023-05-05 03:30:00'),
(11, 15, 'adult', 'Broken Childhood', '2023-05-02 17:45:00', 'B2', 'cx3', 2, '2023-05-05 03:04:00'),
(12, 15, 'adult', 'Broken Childhood', '2023-05-02 17:45:00', 'B3', 'karenkoh', 2, '2023-05-05 04:05:00'),
(13, 8, 'child', 'Broken Bowl', '2023-05-03 10:45:00', 'A1', 'alexlee', 3, '2023-05-03 00:30:00'),
(14, 8, 'child', 'Broken Bowl', '2023-05-03 10:45:00', 'A2', 'cx1', 3, '2023-05-03 01:30:00'),
(15, 10, 'student', 'Broken Bowl', '2023-05-03 10:45:00', 'A3', 'davidsim', 3, '2023-05-03 02:30:00'),
(16, 10, 'student', 'Broken Bowl', '2023-05-03 10:45:00', 'B1', 'prata', 3, '2023-05-03 03:30:00'),
(17, 15, 'adult', 'Broken Bowl', '2023-05-03 10:45:00', 'B2', 'michaelteo', 3, '2023-05-03 03:04:00'),
(18, 15, 'adult', 'Broken Bowl', '2023-05-03 10:45:00', 'B3', 'jasontan', 3, '2023-05-03 04:05:00'),
(19, 8, 'child', 'Broke And Furious', '2023-05-04 09:45:00', 'A1', 'emilytan', 4, '2023-05-04 00:30:00'),
(20, 8, 'child', 'Broke And Furious', '2023-05-04 09:45:00', 'A2', 'cx1', 4, '2023-05-04 01:30:00'),
(21, 10, 'student', 'Broke And Furious', '2023-05-04 09:45:00', 'A3', 'michaelteo', 4, '2023-05-04 02:30:00'),
(22, 10, 'student', 'Broke And Furious', '2023-05-04 09:45:00', 'B1', 'johnsmith', 4, '2023-05-04 03:30:00'),
(23, 15, 'adult', 'Broke And Furious', '2023-05-04 09:45:00', 'B2', 'keithng', 4, '2023-05-04 03:04:00'),
(24, 15, 'adult', 'Broke And Furious', '2023-05-04 09:45:00', 'B3', 'jasontan', 4, '2023-05-04 04:05:00'),
(25, 8, 'child', 'Broke And Bobo', '2023-05-05 08:45:00', 'A1', 'cx1', 1, '2023-05-05 00:30:00'),
(26, 8, 'child', 'Broke And Bobo', '2023-05-05 08:45:00', 'A2', 'davidsim', 1, '2023-05-05 01:30:00'),
(30, 15, 'adult', 'Broke And Bobo', '2023-05-05 08:45:00', 'B3', 'keithng', 1, '2023-05-05 04:05:00'),
(31, 8, 'child', 'Chicken And Bobo', '2023-05-06 08:45:00', 'A1', 'cx1', 1, '2023-05-06 00:30:00'),
(32, 8, 'child', 'Chicken And Bobo', '2023-05-06 08:45:00', 'A2', 'davidsim', 1, '2023-05-06 01:30:00'),
(33, 10, 'student', 'Chicken And Bobo', '2023-05-06 08:45:00', 'A3', 'jasontan', 1, '2023-05-06 02:30:00'),
(34, 10, 'student', 'Chicken And Bobo', '2023-05-06 08:45:00', 'B1', 'johnsmith', 1, '2023-05-06 03:30:00'),
(35, 15, 'adult', 'Chicken And Bobo', '2023-05-06 08:45:00', 'B2', 'cx3', 1, '2023-05-06 03:05:00'),
(36, 15, 'adult', 'Chicken And Bobo', '2023-05-06 08:45:00', 'B3', 'keithng', 1, '2023-05-06 04:05:00'),
(37, 8, 'child', 'Chicken And Friends', '2023-05-09 17:45:00', 'A1', 'louisfoo', 1, '2023-05-09 00:30:00'),
(38, 8, 'child', 'Chicken And Friends', '2023-05-09 17:45:00', 'A2', 'jennylow', 1, '2023-05-09 01:30:00'),
(39, 10, 'student', 'Chicken And Friends', '2023-05-09 17:45:00', 'A3', 'davidsim', 1, '2023-05-09 02:30:00'),
(40, 10, 'student', 'Chicken And Friends', '2023-05-09 17:45:00', 'B1', 'cx4', 1, '2023-05-09 03:30:00'),
(41, 15, 'adult', 'Chicken And Friends', '2023-05-09 17:45:00', 'B2', 'cx3', 1, '2023-05-09 03:05:00'),
(42, 15, 'adult', 'Chicken And Friends', '2023-05-09 17:45:00', 'B3', 'alantoh', 1, '2023-05-09 04:05:00'),
(43, 8, 'child', 'Dark Lord And Friends', '2023-05-10 17:45:00', 'A1', 'brandonng', 2, '2023-05-10 00:30:00'),
(44, 8, 'child', 'Dark Lord And Friends', '2023-05-10 17:45:00', 'A2', 'keithng', 2, '2023-05-10 01:30:00'),
(45, 10, 'student', 'Dark Lord And Friends', '2023-05-10 17:45:00', 'A3', 'cx1', 2, '2023-05-10 02:30:00'),
(46, 10, 'student', 'Dark Lord And Friends', '2023-05-10 17:45:00', 'B1', 'alantoh', 2, '2023-05-10 03:30:00'),
(47, 15, 'adult', 'Dark Lord And Friends', '2023-05-10 17:45:00', 'B2', 'janedoe', 2, '2023-05-10 03:05:00'),
(48, 15, 'adult', 'Dark Lord And Friends', '2023-05-10 17:45:00', 'B3', 'johnsmith', 2, '2023-05-10 04:05:00'),
(49, 8, 'child', 'Seven Deadly chicken', '2023-05-11 10:45:00', 'A1', 'davidsim', 3, '2023-05-11 00:30:00'),
(54, 15, 'adult', 'Seven Deadly chicken', '2023-05-11 10:45:00', 'B3', 'cx2', 3, '2023-05-11 04:05:00'),
(55, 8, 'child', 'If I Can', '2023-05-15 10:45:00', 'A1', 'cx4', 4, '2023-05-15 00:30:00'),
(56, 8, 'child', 'If I Can', '2023-05-15 10:45:00', 'A2', 'karenkoh', 4, '2023-05-15 01:30:00'),
(57, 10, 'student', 'If I Can', '2023-05-15 10:45:00', 'A3', 'jasontan', 4, '2023-05-15 02:30:00'),
(60, 15, 'adult', 'If I Can', '2023-05-15 10:45:00', 'B3', 'cx2', 4, '2023-05-15 04:05:00'),
(61, 8, 'child', 'When The Star Alig', '2023-05-16 11:45:00', 'A1', 'alantoh', 1, '2023-05-16 00:30:00'),
(62, 8, 'child', 'When The Star Alig', '2023-05-16 11:45:00', 'A2', 'danielgan', 1, '2023-05-16 01:30:00'),
(63, 10, 'student', 'When The Star Alig', '2023-05-16 11:45:00', 'A3', 'emilytan', 1, '2023-05-16 02:30:00'),
(64, 10, 'student', 'When The Star Alig', '2023-05-16 11:45:00', 'B1', 'davidsim', 1, '2023-05-16 03:30:00'),
(65, 15, 'adult', 'When The Star Alig', '2023-05-16 11:45:00', 'B2', 'jasontan', 1, '2023-05-16 03:05:00'),
(66, 15, 'adult', 'When The Star Alig', '2023-05-16 11:45:00', 'B3', 'michaelteo', 1, '2023-05-16 04:05:00'),
(67, 8, 'child', 'Black Panther w/o Panther', '2023-05-17 10:45:00', 'A1', 'cx2', 2, '2023-05-17 00:30:00'),
(68, 8, 'child', 'Black Panther w/o Panther', '2023-05-17 10:45:00', 'A2', 'janedoe', 2, '2023-05-17 01:30:00'),
(69, 10, 'student', 'Black Panther w/o Panther', '2023-05-17 10:45:00', 'A3', 'johnsmith', 2, '2023-05-17 02:30:00'),
(70, 10, 'student', 'Black Panther w/o Panther', '2023-05-17 10:45:00', 'B1', 'brandonng', 2, '2023-05-17 03:30:00'),
(71, 15, 'adult', 'Black Panther w/o Panther', '2023-05-17 10:45:00', 'B2', 'cx3', 2, '2023-05-17 03:05:00'),
(72, 15, 'adult', 'Black Panther w/o Panther', '2023-05-17 10:45:00', 'B3', 'michaelteo', 2, '2023-05-17 04:05:00'),
(73, 8, 'child', 'If I Die', '2023-05-17 18:45:00', 'A1', 'emilytan', 3, '2023-05-17 00:30:00'),
(74, 8, 'child', 'If I Die', '2023-05-17 18:45:00', 'A2', 'danielgan', 3, '2023-05-17 01:30:00'),
(75, 10, 'student', 'If I Die', '2023-05-17 18:45:00', 'A3', 'alexlee', 3, '2023-05-17 02:30:00'),
(76, 10, 'student', 'If I Die', '2023-05-17 18:45:00', 'B1', 'louisfoo', 3, '2023-05-17 03:30:00'),
(77, 15, 'adult', 'If I Die', '2023-05-17 18:45:00', 'B2', 'alantoh', 3, '2023-05-17 03:05:00'),
(78, 15, 'adult', 'If I Die', '2023-05-17 18:45:00', 'B3', 'cx4', 3, '2023-05-17 04:05:00'),
(79, 8, 'child', 'John The 1st', '2023-05-22 11:45:00', 'A1', 'cx1', 4, '2023-05-22 00:30:00'),
(80, 8, 'child', 'John The 1st', '2023-05-22 11:45:00', 'A2', 'davidsim', 4, '2023-05-22 01:30:00'),
(81, 10, 'student', 'John The 1st', '2023-05-22 11:45:00', 'A3', 'prata', 4, '2023-05-22 02:30:00'),
(82, 10, 'student', 'John The 1st', '2023-05-22 11:45:00', 'B1', 'keithng', 4, '2023-05-22 03:30:00'),
(83, 15, 'adult', 'John The 1st', '2023-05-22 11:45:00', 'B2', 'keithng', 4, '2023-05-22 03:05:00'),
(84, 15, 'adult', 'John The 1st', '2023-05-22 11:45:00', 'B3', 'cx2', 4, '2023-05-22 04:05:00'),
(85, 8, 'child', 'John The 2nd', '2023-05-23 10:45:00', 'A1', 'sarahlim', 1, '2023-05-22 00:30:00'),
(86, 8, 'child', 'John The 2nd', '2023-05-23 10:45:00', 'A2', 'stevenlim', 1, '2023-05-23 01:30:00'),
(87, 10, 'student', 'John The 2nd', '2023-05-23 10:45:00', 'A3', 'vickyloh', 1, '2023-05-23 02:30:00'),
(88, 10, 'student', 'John The 2nd', '2023-05-23 10:45:00', 'B1', 'wendychua', 1, '2023-05-23 03:30:00'),
(89, 15, 'adult', 'John The 2nd', '2023-05-23 10:45:00', 'B2', 'brandonng', 1, '2023-05-23 03:05:00'),
(90, 15, 'adult', 'John The 2nd', '2023-05-23 10:45:00', 'B3', 'jasontan ', 1, '2023-05-23 04:05:00'),
(91, 8, 'child', 'Weathering With John', '2023-05-24 08:45:00', 'A1', 'jennylow', 2, '2023-05-24 00:30:00'),
(92, 8, 'child', 'Weathering With John', '2023-05-24 08:45:00', 'A2', 'michaelteo', 2, '2023-05-24 01:30:00'),
(93, 10, 'student', 'Weathering With John', '2023-05-24 08:45:00', 'A3', 'prata', 2, '2023-05-24 02:30:00'),
(94, 10, 'student', 'Weathering With John', '2023-05-24 08:45:00', 'B1', 'wendychua', 2, '2023-05-24 03:30:00'),
(95, 15, 'adult', 'Weathering With John', '2023-05-24 08:45:00', 'B2', 'davidsim', 2, '2023-05-24 03:05:00'),
(96, 15, 'adult', 'Weathering With John', '2023-05-24 08:45:00', 'B3', 'alantoh ', 2, '2023-05-24 04:05:00'),
(97, 8, 'child', 'Will Smith PoPo', '2023-05-24 08:45:00', 'A1', 'alantoh', 3, '2023-05-24 01:30:00'),
(98, 8, 'child', 'Will Smith PoPo', '2023-05-24 08:45:00', 'A2', 'danielgan', 3, '2023-05-24 02:30:00'),
(99, 10, 'student', 'Will Smith PoPo', '2023-05-24 08:45:00', 'A3', 'jasontan', 3, '2023-05-24 03:30:00'),
(100, 10, 'student', 'Will Smith PoPo', '2023-05-24 08:45:00', 'B1', 'johnsmith', 3, '2023-05-24 04:30:00'),
(101, 15, 'adult', 'Will Smith PoPo', '2023-05-24 08:45:00', 'B2', 'emilytan', 3, '2023-05-24 05:05:00'),
(102, 15, 'adult', 'Will Smith PoPo', '2023-05-24 08:45:00', 'B3', 'alexlee ', 3, '2023-05-24 06:05:00'),
(103, 8, 'child', 'A bear ate me', '2023-05-26 15:45:00', 'A2', 'cx1', 1, '2023-05-15 17:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `tickettype`
--

CREATE TABLE `tickettype` (
  `ticketType` varchar(100) NOT NULL,
  `ticketPrice` double NOT NULL,
  `suspend` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickettype`
--

INSERT INTO `tickettype` (`ticketType`, `ticketPrice`, `suspend`) VALUES
('adult', 15, 'N'),
('child', 8, 'N'),
('newtickettype', 10, 'N'),
('student', 10, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `suspend` varchar(3) DEFAULT NULL,
  `profileName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`username`, `password`, `fullName`, `email`, `phoneNumber`, `suspend`, `profileName`) VALUES
('admin1', '123', 'admin1', 'admin1@gmail.com', '12345678', 'N', 'userAdmin'),
('alantoh', '123', 'Alan Toh', 'alantoh@example.com', '91234576', 'Y', 'customer'),
('alexlee', '123', 'Alex Lee', 'alexlee@example.com', '91234569', 'Y', 'customer'),
('asd', 'asd', 'asd', 'asd@gmail.com', '23456789', 'N', 'customer'),
('brandonng', '123', 'Brandon Ng', 'brandonng@example.com', '91234579', 'Y', 'customer'),
('cx1', '123', 'cx1', 'cx1@gmail.com', '12345678', 'N', 'customer'),
('cx2', '123', 'cx2', 'cx2@gmail.com', '12345678', 'N', 'customer'),
('cx3', '123', 'cx3', 'cx3@gmail.com', '12345678', 'N', 'customer'),
('cx4', '123', 'cx4', 'cx4@gmail.com', '12345678', 'N', 'customer'),
('danielgan', '123', 'Daniel Gan', 'danielgan@example.com', '91234581', 'N', 'customer'),
('davidsim', '123', 'David Sim', 'davidsim@example.com', '91234574', 'N', 'customer'),
('emilytan', '123', 'Emily Tan', 'emilytan@example.com', '91234570', 'N', 'customer'),
('janedoe', '123', 'Jane Doe', 'janedoe@example.com', '91234568', 'N', 'customer'),
('jasontan', '123', 'Jason Tan', 'jasontan@example.com', '91234572', 'N', 'customer'),
('jennylow', '123', 'Jenny Low', 'jennylow@example.com', '91234575', 'N', 'customer'),
('johnsmith', '123', 'John Smith', 'johnsmith@example.com', '91234567', 'N', 'customer'),
('karenkoh', '123', 'Karen Koh', 'karenkoh@example.com', '91234578', 'N', 'customer'),
('keithng', '123', 'Keith Ng', 'keithng@example.com', '91234583', 'N', 'customer'),
('louisfoo', '123', 'Louis Foo', 'louisfoo@example.com', '91234580', 'N', 'customer'),
('mg1', '123', 'mg1', 'mg1@gmail.com', '12345678', 'N', 'cinemaManager'),
('mg10', '123', 'Lisa Tan', 'lisatan10@example.com', '91234567', 'N', 'cinemaManager'),
('mg100', '123', 'Gabriel Goh', 'gabrielgoh100@example.com', '92345678', 'N', 'cinemaManager'),
('mg11', '123', 'William Lim', 'williamlim11@example.com', '92345678', 'N', 'cinemaManager'),
('mg12', '123', 'Elaine Lee', 'elainelee12@example.com', '93456789', 'N', 'cinemaManager'),
('mg13', '123', 'Benjamin Tan', 'benjamintan13@example.com', '94567890', 'N', 'cinemaManager'),
('mg14', '123', 'Melissa Koh', 'melissakoh14@example.com', '95678901', 'N', 'cinemaManager'),
('mg15', '123', 'Kevin Lee', 'kevinlee15@example.com', '96789012', 'N', 'cinemaManager'),
('mg16', '123', 'Grace Tan', 'gracetan16@example.com', '97890123', 'N', 'cinemaManager'),
('mg17', '123', 'Andrew Lim', 'andrewlim17@example.com', '98901234', 'N', 'cinemaManager'),
('mg18', '123', 'Shirley Chia', 'shirleychia18@example.com', '90012345', 'N', 'cinemaManager'),
('mg19', '123', 'George Lee', 'georgelee19@example.com', '91234567', 'N', 'cinemaManager'),
('mg2', '123', 'Jane Doe', 'janedoe2@example.com', '92345678', 'N', 'cinemaManager'),
('mg20', '123', 'Kelly Goh', 'kellygoh20@example.com', '92345678', 'N', 'cinemaManager'),
('mg21', '123', 'Rachel Tan', 'racheltan21@example.com', '93456789', 'N', 'cinemaManager'),
('mg22', '123', 'Steven Ng', 'stevenng22@example.com', '94567890', 'N', 'cinemaManager'),
('mg23', '123', 'Wendy Lim', 'wendylim23@example.com', '95678901', 'N', 'cinemaManager'),
('mg24', '123', 'Chris Lee', 'chrislee24@example.com', '96789012', 'N', 'cinemaManager'),
('mg25', '123', 'Annabelle Tan', 'annabelletan25@example.com', '97890123', 'N', 'cinemaManager'),
('mg26', '123', 'Matthew Goh', 'matthewgoh26@example.com', '98901234', 'N', 'cinemaManager'),
('mg27', '123', 'Evelyn Koh', 'evelynkoh27@example.com', '90012345', 'N', 'cinemaManager'),
('mg28', '123', 'Alan Lim', 'alanlim28@example.com', '91234567', 'N', 'cinemaManager'),
('mg29', '123', 'Fiona Lee', 'fionalee29@example.com', '92345678', 'N', 'cinemaManager'),
('mg3', '123', 'David Lee', 'davidlee3@example.com', '93456789', 'N', 'cinemaManager'),
('mg30', '123', 'Jason Tan', 'jasontan30@example.com', '93456789', 'N', 'cinemaManager'),
('mg31', '123', 'Vanessa Ng', 'vanessang31@example.com', '94567890', 'N', 'cinemaManager'),
('mg32', '123', 'Robert Koh', 'robertkoh32@example.com', '95678901', 'N', 'cinemaManager'),
('mg33', '123', 'Samantha Lim', 'samanthalim33@example.com', '96789012', 'N', 'cinemaManager'),
('mg34', '123', 'Gary Tan', 'garytan34@example.com', '97890123', 'N', 'cinemaManager'),
('mg35', '123', 'Karen Goh', 'karengoh35@example.com', '98901234', 'N', 'cinemaManager'),
('mg36', '123', 'Patrick Lee', 'patricklee36@example.com', '90012345', 'N', 'cinemaManager'),
('mg37', '123', 'Esther Tan', 'esthertan37@example.com', '91234567', 'N', 'cinemaManager'),
('mg38', '123', 'Timothy Ng', 'timothyng38@example.com', '92345678', 'N', 'cinemaManager'),
('mg39', '123', 'Linda Koh', 'lindakoh39@example.com', '93456789', 'N', 'cinemaManager'),
('mg4', '123', 'Emily Chen', 'emilychen4@example.com', '94567890', 'N', 'cinemaManager'),
('mg40', '123', 'Alex Lim', 'alexlim40@example.com', '94567890', 'N', 'cinemaManager'),
('mg41', '123', 'Olivia Tan', 'oliviatan41@example.com', '95678901', 'N', 'cinemaManager'),
('mg42', '123', 'Jonathan Goh', 'jonathangoh42@example.com', '96789012', 'N', 'cinemaManager'),
('mg43', '123', 'Cindy Lee', 'cindylee43@example.com', '97890123', 'N', 'cinemaManager'),
('mg44', '123', 'Marcus Ng', 'marcusng44@example.com', '98901234', 'N', 'cinemaManager'),
('mg45', '123', 'Angela Koh', 'angelakoh45@example.com', '90012345', 'N', 'cinemaManager'),
('mg46', '123', 'Nicholas Lim', 'nicholaslim46@example.com', '91234567', 'N', 'cinemaManager'),
('mg47', '123', 'Grace Tan', 'gracetan47@example.com', '92345678', 'N', 'cinemaManager'),
('mg48', '123', 'Samuel Goh', 'samuelgoh48@example.com', '93456789', 'N', 'cinemaManager'),
('mg49', '123', 'Mandy Lee', 'mandylee49@example.com', '94567890', 'N', 'cinemaManager'),
('mg5', '123', 'Michael Tan', 'michaeltan5@example.com', '95678901', 'N', 'cinemaManager'),
('mg50', '123', 'Derrick Ng', 'derrickng50@example.com', '95678901', 'N', 'cinemaManager'),
('mg51', '123', 'Vanessa Tan', 'vanessatan51@example.com', '96789012', 'N', 'cinemaManager'),
('mg52', '123', 'Eugene Goh', 'eugenegoh52@example.com', '97890123', 'N', 'cinemaManager'),
('mg53', '123', 'Jasmine Lim', 'jasminelim53@example.com', '98901234', 'N', 'cinemaManager'),
('mg54', '123', 'Benjamin Koh', 'benjaminkoh54@example.com', '90012345', 'N', 'cinemaManager'),
('mg55', '123', 'Serene Lee', 'serenelee55@example.com', '91234567', 'N', 'cinemaManager'),
('mg56', '123', 'Vincent Tan', 'vincenttan56@example.com', '92345678', 'N', 'cinemaManager'),
('mg57', '123', 'Jenny Goh', 'jennygoh57@example.com', '93456789', 'N', 'cinemaManager'),
('mg58', '123', 'Leonard Ng', 'leonardng58@example.com', '94567890', 'N', 'cinemaManager'),
('mg59', '123', 'Valerie Koh', 'valeriekoh59@example.com', '95678901', 'N', 'cinemaManager'),
('mg6', '123', 'Sarah Lim', 'sarahlim6@example.com', '96789012', 'N', 'cinemaManager'),
('mg60', '123', 'Nicholas Lim', 'nicholaslim60@example.com', '96789012', 'N', 'cinemaManager'),
('mg61', '123', 'Kathy Tan', 'kathytan61@example.com', '97890123', 'N', 'cinemaManager'),
('mg62', '123', 'Stanley Goh', 'stanleygoh62@example.com', '98901234', 'N', 'cinemaManager'),
('mg63', '123', 'Joanna Lee', 'joannalee63@example.com', '90012345', 'N', 'cinemaManager'),
('mg64', '123', 'David Ng', 'davidng64@example.com', '91234567', 'N', 'cinemaManager'),
('mg65', '123', 'Hazel Tan', 'hazeltan65@example.com', '92345678', 'N', 'cinemaManager'),
('mg66', '123', 'Raymond Goh', 'raymondgoh66@example.com', '93456789', 'N', 'cinemaManager'),
('mg67', '123', 'Catherine Lim', 'catherinelim67@example.com', '94567890', 'N', 'cinemaManager'),
('mg69', '123', 'Grace Lee', 'gracelee69@example.com', '96789012', 'N', 'cinemaManager'),
('mg7', '123', 'Peter Ng', 'peterng7@example.com', '97890123', 'N', 'cinemaManager'),
('mg70', '123', 'Samuel Tan', 'samueltan70@example.com', '97890123', 'N', 'cinemaManager'),
('mg71', '123', 'Mandy Goh', 'mandygoh71@example.com', '98901234', 'N', 'cinemaManager'),
('mg72', '123', 'Derrick Lim', 'derricklim72@example.com', '90012345', 'N', 'cinemaManager'),
('mg73', '123', 'Vanessa Koh', 'vanessakoh73@example.com', '91234567', 'N', 'cinemaManager'),
('mg74', '123', 'Eugene Lee', 'eugenelee74@example.com', '92345678', 'N', 'cinemaManager'),
('mg75', '123', 'Jasmine Tan', 'jasminetan75@example.com', '93456789', 'N', 'cinemaManager'),
('mg76', '123', 'Benjamin Goh', 'benjamingoh76@example.com', '94567890', 'N', 'cinemaManager'),
('mg77', '123', 'Serene Ng', 'sereneng77@example.com', '95678901', 'N', 'cinemaManager'),
('mg78', '123', 'Vincent Koh', 'vincentkoh78@example.com', '96789012', 'N', 'cinemaManager'),
('mg79', '123', 'Jenny Lim', 'jennylim79@example.com', '97890123', 'N', 'cinemaManager'),
('mg8', '123', 'Catherine Koh', 'catherinekoh8@example.com', '98901234', 'N', 'cinemaManager'),
('mg80', '123', 'Leonard Tan', 'leonardtan80@example.com', '98901234', 'N', 'cinemaManager'),
('mg81', '123', 'Valerie Goh', 'valeriegoh81@example.com', '90012345', 'N', 'cinemaManager'),
('mg82', '123', 'Nicholas Lee', 'nicholaslee82@example.com', '91234567', 'N', 'cinemaManager'),
('mg83', '123', 'Kathy Tan', 'kathytan83@example.com', '92345678', 'N', 'cinemaManager'),
('mg84', '123', 'Stanley Goh', 'stanleygoh84@example.com', '93456789', 'N', 'cinemaManager'),
('mg85', '123', 'Joanna Lim', 'joannalim85@example.com', '94567890', 'N', 'cinemaManager'),
('mg86', '123', 'David Ng', 'davidng86@example.com', '95678901', 'N', 'cinemaManager'),
('mg87', '123', 'Hazel Tan', 'hazeltan87@example.com', '96789012', 'N', 'cinemaManager'),
('mg88', '123', 'Raymond Goh', 'raymondgoh88@example.com', '97890123', 'N', 'cinemaManager'),
('mg89', '123', 'Catherine Lee', 'catherinelee89@example.com', '98901234', 'N', 'cinemaManager'),
('mg9', '123', 'Daniel Goh', 'danielgoh9@example.com', '90012345', 'N', 'cinemaManager'),
('mg90', '123', 'Andrew Tan', 'andrewtan90@example.com', '90012345', 'N', 'cinemaManager'),
('mg91', '123', 'Grace Goh', 'gracegoh91@example.com', '92345678', 'N', 'cinemaManager'),
('mg92', '123', 'Steven Lim', 'stevenlim92@example.com', '93456789', 'N', 'cinemaManager'),
('mg93', '123', 'Cheryl Tan', 'cheryltan93@example.com', '94567890', 'N', 'cinemaManager'),
('mg94', '123', 'Kenneth Goh', 'kennethgoh94@example.com', '95678901', 'N', 'cinemaManager'),
('mg95', '123', 'Janet Lee', 'janetlee95@example.com', '96789012', 'N', 'cinemaManager'),
('mg96', '123', 'Darius Tan', 'dariustan96@example.com', '97890123', 'N', 'cinemaManager'),
('mg97', '123', 'Samantha Goh', 'samanthagoh97@example.com', '98901234', 'N', 'cinemaManager'),
('mg98', '123', 'Winston Lim', 'winstonlim98@example.com', '90012345', 'N', 'cinemaManager'),
('mg99', '123', 'Sally Tan', 'sallytan99@example.com', '91234567', 'N', 'cinemaManager'),
('michaelteo', '123', 'Michael Teo', 'michaelteo@example.com', '91234585', 'N', 'customer'),
('owner1', '123', 'ow1', 'ow1@gmail.com', '12345678', 'N', 'cinemaOwner'),
('prata', '123', 'Md Parta', 'prata@example.com', '91234234', 'N', 'customer'),
('sarahlim', '123', 'Sarah Lim', 'sarahlim@example.com', '91234577', 'N', 'customer'),
('stevenlim', '123', 'Steven Lim', 'stevenlim@example.com', '91254571', 'N', 'customer'),
('vickyloh', '123', 'Vicky Loh', 'vickyloh@example.com', '91234584', 'N', 'customer'),
('wendychua', '123', 'Wendy Chua', 'wendychua@example.com', '91234573', 'N', 'customer'),
('wendyzhang', '123', 'Wendy Zhang', 'wendyzhang@example.com', '91234582', 'N', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `profileName` varchar(100) NOT NULL,
  `profileDescription` varchar(100) DEFAULT NULL,
  `suspend` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`profileName`, `profileDescription`, `suspend`) VALUES
('cinemaManager', 'I should be able to create, retrieve, update,suspend,search', 'N'),
('cinemaOwner', 'I should be able to generate report', 'N'),
('customer', 'I should be able to create, retrieve, update, search', 'N'),
('userAdmin', 'I should be able to create, retrieve, update,suspend, search', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`cinemaName`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `foodanddrink`
--
ALTER TABLE `foodanddrink`
  ADD PRIMARY KEY (`itemName`,`itemPrice`);

--
-- Indexes for table `foodanddrinkstransactions`
--
ALTER TABLE `foodanddrinkstransactions`
  ADD PRIMARY KEY (`foodDrinkId`),
  ADD KEY `username` (`username`),
  ADD KEY `itemName` (`itemName`,`itemPrice`),
  ADD KEY `cinemaName` (`cinemaName`);

--
-- Indexes for table `moviehall`
--
ALTER TABLE `moviehall`
  ADD PRIMARY KEY (`hallNo`,`cinemaName`),
  ADD KEY `cinemaName` (`cinemaName`);

--
-- Indexes for table `moviesession`
--
ALTER TABLE `moviesession`
  ADD PRIMARY KEY (`movieName`,`screeningDateTime`),
  ADD KEY `hallNo` (`hallNo`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`seatNo`,`hallNo`),
  ADD KEY `hallNo` (`hallNo`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketNo`),
  ADD KEY `movieName` (`movieName`,`screeningDateTime`),
  ADD KEY `seatNo` (`seatNo`),
  ADD KEY `username` (`username`),
  ADD KEY `ticketType` (`ticketType`,`ticketPrice`),
  ADD KEY `hallNo` (`hallNo`);

--
-- Indexes for table `tickettype`
--
ALTER TABLE `tickettype`
  ADD PRIMARY KEY (`ticketType`,`ticketPrice`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`username`),
  ADD KEY `profileName` (`profileName`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`profileName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foodanddrinkstransactions`
--
ALTER TABLE `foodanddrinkstransactions`
  MODIFY `foodDrinkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cinema`
--
ALTER TABLE `cinema`
  ADD CONSTRAINT `cinema_ibfk_1` FOREIGN KEY (`username`) REFERENCES `useraccount` (`username`);

--
-- Constraints for table `foodanddrinkstransactions`
--
ALTER TABLE `foodanddrinkstransactions`
  ADD CONSTRAINT `foodanddrinkstransactions_ibfk_1` FOREIGN KEY (`username`) REFERENCES `useraccount` (`username`),
  ADD CONSTRAINT `foodanddrinkstransactions_ibfk_2` FOREIGN KEY (`itemName`,`itemPrice`) REFERENCES `foodanddrink` (`itemName`, `itemPrice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foodanddrinkstransactions_ibfk_3` FOREIGN KEY (`cinemaName`) REFERENCES `cinema` (`cinemaName`);

--
-- Constraints for table `moviehall`
--
ALTER TABLE `moviehall`
  ADD CONSTRAINT `moviehall_ibfk_1` FOREIGN KEY (`cinemaName`) REFERENCES `cinema` (`cinemaName`);

--
-- Constraints for table `moviesession`
--
ALTER TABLE `moviesession`
  ADD CONSTRAINT `moviesession_ibfk_1` FOREIGN KEY (`hallNo`) REFERENCES `moviehall` (`hallNo`);

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`hallNo`) REFERENCES `moviehall` (`hallNo`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`movieName`,`screeningDateTime`) REFERENCES `moviesession` (`movieName`, `screeningDateTime`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`seatNo`) REFERENCES `seat` (`seatNo`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`username`) REFERENCES `useraccount` (`username`),
  ADD CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`ticketType`,`ticketPrice`) REFERENCES `tickettype` (`ticketType`, `ticketPrice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_5` FOREIGN KEY (`hallNo`) REFERENCES `moviehall` (`hallNo`);

--
-- Constraints for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD CONSTRAINT `useraccount_ibfk_1` FOREIGN KEY (`profileName`) REFERENCES `userprofile` (`profileName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
