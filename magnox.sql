-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 06:14 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magnox`
--

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `user_id`, `name`, `email`, `phone`) VALUES
(1, 5, 'Bappa dey', 'bappa@gmail.com', '9007279095'),
(3, 5, 'sam', 'sam@gmail.com', '9007279095'),
(4, 5, 'Andrew', 'demo@gmail.com', '6295516647'),
(5, 1, 'Andrew', 'bappa@gmail.com', '1234567890'),
(6, 2, 'Andrew1', 'andrew1@gmail.com', '1234567890'),
(7, 6, 'sam', 'demo@gmail.com', '6295516647'),
(8, 9, 'Andrew', 'demo@gmail.com', '1234567891'),
(11, 9, 'sadfhgfhg', 'zzz@gmail.com', '1234567890'),
(15, 1, 'Andrew', 'zzz@gmail.com', '1234567890'),
(16, 1, 'Andrew', 'demo@gmail.com', '1234567890'),
(17, 1, 'Andrew', 'bappa@gmail.com', '1234567891'),
(18, 9, 'Andrew', 'demo@gmail.com', '9007279095'),
(20, 10, 'demonstration todo check', 'tododemon@gmail.com', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `created_at`, `deleted_at`) VALUES
(1, 'Bappa Dey', 'bappa@gmail.com', '1234512345', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 17:51:50', '2021-06-02 17:51:50'),
(2, 'Andrewbappadey', 'andrewbappa@gmail.com', '9007279095', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 18:56:02', '2021-06-02 18:56:02'),
(4, 'bappa_dey 123456', 'bappa_dey@gmail.com', '9890878967', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 20:50:40', '2021-06-02 20:50:40'),
(5, 'asit', 'asit12345@gmail.com', '7687656456', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 20:51:10', '2021-06-02 20:51:10'),
(6, 'qwerty', 'qwerty@gmail.com', '8797685674', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 20:52:06', '2021-06-02 20:52:06'),
(9, 'babu', 'zzz@gmail.com', '1234567891', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-02 22:01:33', '2021-06-02 22:01:33'),
(10, 'demonstration', 'demonstration@gmail.com', '6295516647', 'e10adc3949ba59abbe56e057f20f883e', '2021-06-03 03:59:44', '2021-06-03 03:59:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
