-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 08:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`id`, `title`, `description`, `image`, `created_date`) VALUES
(1, 'test product', 'description one', '1699102673front1.jpeg', '2023-11-04'),
(2, 'apple', 'apple', '1700359838KidsTricycle.jpg', '2023-11-19'),
(3, 'apple abc', 'apple1', '1700360081fruit2.jpg', '2023-11-19'),
(4, 'apple aaaa', 'apple2', '1700360101fruit1.jpg', '2023-11-19'),
(5, 'apple3', 'apple3', '1700360101fruit1.jpg', '2023-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `register_tbl`
--

CREATE TABLE `register_tbl` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` enum('admin','coordinator') NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_tbl`
--

INSERT INTO `register_tbl` (`id`, `name`, `email`, `password`, `address`, `role`, `created_date`) VALUES
(10, 'gayan', 'gayan@gmail.com', '123456', '123 colombo', 'admin', '2023-08-27'),
(12, 'nuwan', 'nuwan@gmail.com', '123456', '123 colombo', 'coordinator', '2023-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `student_marks`
--

CREATE TABLE `student_marks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `math_marks` text NOT NULL,
  `science_marks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_marks`
--

INSERT INTO `student_marks` (`id`, `name`, `math_marks`, `science_marks`) VALUES
(1, 'saman', '50', '80'),
(2, 'nuwan', '77', '59'),
(3, 'saman', '50', '80'),
(4, 'saman', '50', '80'),
(5, 'nuwan', '77', '59'),
(6, 'saman', '50', '80'),
(7, 'saman', '50', '80'),
(8, 'saman', '50', '80'),
(9, 'saman', '50', '80'),
(10, 'nuwan', '77', '59'),
(11, 'saman', '50', '80'),
(12, 'saman', '50', '80');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_tbl`
--
ALTER TABLE `register_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_marks`
--
ALTER TABLE `student_marks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `register_tbl`
--
ALTER TABLE `register_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_marks`
--
ALTER TABLE `student_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
