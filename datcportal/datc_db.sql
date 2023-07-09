-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2022 at 06:44 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch_table`
--

CREATE TABLE `batch_table` (
  `batch_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `batch_number` char(255) NOT NULL,
  `create_date` date NOT NULL,
  `commence_date` date NOT NULL,
  `tentitive_close_date` date NOT NULL,
  `close_date` date DEFAULT NULL,
  `discription` varchar(255) NOT NULL,
  `state` enum('active','complete','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch_table`
--

INSERT INTO `batch_table` (`batch_id`, `course_id`, `staff_id`, `batch_number`, `create_date`, `commence_date`, `tentitive_close_date`, `close_date`, `discription`, `state`) VALUES
(1, 1, 1, '1', '2020-08-08', '2021-08-07', '0000-00-00', '2021-01-03', 'class time : Saturday 9.00 am to 3.00 pm', 'active'),
(2, 1, 1, '2', '2020-08-09', '2021-08-08', '0000-00-00', '2021-01-03', 'class time : Sunday 9.00 am to 3.00 pm', 'active'),
(3, 2, 1, '1', '2020-08-16', '2022-07-25', '0000-00-00', '2022-11-30', 'class time : Monday 9.00 am to 3.00 pm', 'active'),
(4, 3, 1, '1', '2020-08-08', '2021-08-07', '2021-11-19', '2021-01-03', 'class time : Saturday 9.00 am to 3.00 pm', 'complete'),
(5, 2, 2, '2', '2020-11-26', '2020-11-26', '2021-01-27', NULL, 'test', 'active'),
(9, 8, 2, 'Grade 6 ICT Rasani', '2022-06-11', '2022-01-01', '2022-12-31', NULL, 'ICT Classes', 'active'),
(10, 8, 2, 'Grade 6 Sinhala Kalum', '2022-06-11', '2022-01-01', '2022-12-31', NULL, 'Sinhala Classes', 'active'),
(11, 8, 2, 'Grade 6 - English Chaml', '2022-06-11', '2022-01-01', '2022-12-31', NULL, 'English', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(26, 1610731758, '::1', 'xR7xrUPY'),
(27, 1610731764, '::1', 'l19H9g1s'),
(28, 1610731825, '::1', 'yogZSRxo'),
(29, 1610731831, '::1', 'fPDQFU60'),
(30, 1610731857, '::1', 'zBxRvOHc'),
(31, 1610731884, '::1', 'Me5QLZAT'),
(32, 1610731926, '::1', 'INdqthfm'),
(33, 1611905996, '::1', 'YA7WR0Gf'),
(34, 1611906002, '::1', 'vODaXOjI'),
(35, 1611906010, '::1', 'RsHWpe3y'),
(36, 1611987321, '::1', 'zZVcX0ws'),
(37, 1611987328, '::1', 'mbAEDzmK'),
(38, 1611987702, '::1', 'KxZuqMyB'),
(39, 1612104389, '::1', 'u92wMtzi'),
(40, 1613236405, '::1', 'SlFba75N'),
(41, 1613236430, '::1', 'S7JoK0ss'),
(42, 1613237473, '::1', 'aXx3Flnl'),
(43, 1613237736, '::1', 'D8xyLwak'),
(44, 1613237800, '::1', 'RJAFn4R1'),
(45, 1613237831, '::1', '1KikjlFa'),
(46, 1613237919, '::1', '9EW3icm0'),
(47, 1613237986, '::1', 'wF38UUC5'),
(48, 1613237990, '::1', 'eZ0n5mVJ'),
(49, 1613238046, '::1', 'vAS9IYx9'),
(50, 1613238055, '::1', 'rWtVReg7'),
(51, 1613238190, '::1', 'yiAXxciJ'),
(52, 1613238199, '::1', 'ChBxl1PD'),
(53, 1613238406, '::1', 'DHFPn9S0'),
(54, 1613238747, '::1', 'fKDoefv4'),
(55, 1613238750, '::1', 'xbmzSLvE'),
(56, 1613238791, '::1', 'qGUsVcMT'),
(57, 1613238803, '::1', 'MzAKr7e6'),
(58, 1613239401, '::1', 'DK5kjkon'),
(59, 1613494457, '::1', 'wNSZwJV2'),
(60, 1613877319, '::1', 'cBdK8jqB'),
(61, 1613877355, '::1', 'i7R5PvrI'),
(62, 1613877589, '::1', '4oEfN79f'),
(63, 1613877668, '::1', 'P5abV6K5'),
(64, 1613918661, '::1', 'NvYCyGJN'),
(65, 1614436404, '::1', 'fvFaCu8H'),
(66, 1649838772, '::1', 'luWEMVH5'),
(67, 1651368748, '::1', 'I5dTPTLm'),
(68, 1651387559, '::1', 'ja9zDLdP'),
(69, 1651388866, '::1', '6vt9b9Zm');

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text NOT NULL,
  `course_fee` text NOT NULL,
  `state` enum('active','inactive','delete') NOT NULL,
  `staff_id` int(11) NOT NULL,
  `course_type` enum('diploma','threedays','oneday') NOT NULL,
  `submit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`course_id`, `course_name`, `course_description`, `course_fee`, `state`, `staff_id`, `course_type`, `submit_date`) VALUES
(1, 'Diploma of Web Development', 'This qualification reflects the role of personnel working on farms, stations and related rural businesses involved in administering and managing those businesses. Industry expects individuals with this qualification to take personal responsibility and exercise autonomy in undertaking complex work. They must analyze information and exercise judgment to complete a range of advanced skilled activities.', '30000.00', 'active', 2, 'diploma', '2020-01-01'),
(2, 'Diploma in Software Engineering', 'The Diploma of Horticulture reflects the role of those who manage amenity horticultural enterprises where a range of skills and knowledge across the breadth of the industry is required or personnel working in horticulture at a level requiring higher technical skills.', '25000.00', 'active', 2, 'diploma', '2020-01-02'),
(3, 'One Day Training', 'The Diploma of Horticulture reflects the role of those who manage amenity horticultural enterprises where a range of skills and knowledge across the breadth of the industry is required or personnel working in horticulture at a level requiring higher technical skills.', '25000.00', 'active', 2, 'oneday', '2020-01-02'),
(8, 'Grade 6', 'grade 6', '1000', 'active', 2, 'oneday', '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `payment_receive_table`
--

CREATE TABLE `payment_receive_table` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `receipt_number` varchar(14) NOT NULL,
  `paid_amount` float NOT NULL,
  `paid_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_receive_table`
--

INSERT INTO `payment_receive_table` (`id`, `payment_id`, `receipt_number`, `paid_amount`, `paid_date`, `staff_id`, `add_date`) VALUES
(1, 27, '20201119154516', 15000, '2020-11-19', 2, '2020-11-19'),
(2, 46, '20201121045937', 15000, '2020-11-21', 2, '2020-11-21'),
(3, 48, '20201124123716', 25000, '2020-11-24', 2, '2020-11-24'),
(4, 47, '20201124181924', 15000, '2020-11-24', 2, '2020-11-24'),
(5, 50, '20210113072936', 30000, '2021-01-13', 2, '2021-01-13'),
(6, 51, '20210129044440', 15000, '2021-01-29', 2, '2021-01-29'),
(7, 53, '20210129050927', 30000, '2021-01-29', 2, '2021-01-29'),
(8, 54, '20210131155728', 30000, '2021-01-31', 2, '2021-01-31'),
(9, 55, '20210131155917', 15000, '2021-01-31', 2, '2021-01-31'),
(10, 57, '20210131160443', 25000, '2021-01-31', 2, '2021-01-31'),
(11, 28, '20210216180839', 15000, '2021-02-16', 2, '2021-02-16'),
(12, 58, '20210216181759', 25000, '2021-02-16', 2, '2021-02-16'),
(13, 59, '20220501111658', 30000, '2022-05-01', 2, '2022-05-01'),
(14, 60, '20220611064506', 1000, '2022-06-11', 2, '2022-06-11'),
(15, 61, '20220611064506', 1000, '2022-06-11', 2, '2022-06-11'),
(16, 62, '20220616064506', 1000, '2022-06-16', 2, '2022-06-16'),
(17, 63, '20220616064506', 1000, '2022-06-16', 2, '2022-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedule_table`
--

CREATE TABLE `payment_schedule_table` (
  `payment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `payment_status` enum('full','1st installment','2nd installment') NOT NULL,
  `amount` float NOT NULL,
  `payment_due_date` date DEFAULT NULL,
  `pay_month` varchar(255) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_schedule_table`
--

INSERT INTO `payment_schedule_table` (`payment_id`, `student_id`, `batch_id`, `payment_status`, `amount`, `payment_due_date`, `pay_month`, `added_date`) VALUES
(27, 17, 2, '1st installment', 15000, NULL, '', '2020-11-19'),
(28, 17, 2, '2nd installment', 15000, '2022-02-08', '', '2020-11-19'),
(46, 37, 2, '1st installment', 15000, NULL, '', '2020-11-21'),
(47, 37, 2, '2nd installment', 15000, '2022-02-08', '', '2020-11-21'),
(48, 38, 4, 'full', 25000, NULL, '', '2020-11-24'),
(50, 1, 1, 'full', 30000, NULL, '', '2021-01-13'),
(51, 18, 1, '1st installment', 15000, NULL, '', '2021-01-29'),
(52, 18, 1, '2nd installment', 15000, '2021-01-27', '', '2021-01-29'),
(53, 40, 1, 'full', 30000, NULL, '', '2021-01-29'),
(54, 41, 1, 'full', 30000, NULL, '', '2021-01-31'),
(55, 42, 1, '1st installment', 15000, NULL, '', '2021-01-31'),
(56, 42, 1, '2nd installment', 15000, '2022-02-07', '', '2021-01-31'),
(57, 42, 3, 'full', 25000, NULL, '', '2021-01-31'),
(58, 41, 4, 'full', 25000, NULL, '', '2021-02-16'),
(59, 45, 1, 'full', 30000, NULL, '', '2022-05-01'),
(60, 46, 9, 'full', 1000, NULL, 'January', '2022-06-11'),
(61, 46, 11, 'full', 1000, NULL, 'January', '2022-06-11'),
(62, 46, 9, 'full', 1000, NULL, 'February', '2022-06-16'),
(63, 46, 11, 'full', 1000, NULL, 'February', '2022-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `staff_table`
--

CREATE TABLE `staff_table` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role_type` enum('admin','coordinator') NOT NULL,
  `password` varchar(40) NOT NULL,
  `state` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_table`
--

INSERT INTO `staff_table` (`staff_id`, `staff_name`, `email`, `role_type`, `password`, `state`) VALUES
(1, 'chathuri', 'chathuri@gmail.com', 'coordinator', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active'),
(2, 'admin', 'admin@gmail.com', 'admin', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active'),
(3, 'online stafff', 'online@datc.com', 'coordinator', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active'),
(4, 'lasitha samarasinhe', 'lasitha@datc.lk', 'coordinator', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_table`
--

CREATE TABLE `student_attendance_table` (
  `student_attent_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `attend_date` date NOT NULL,
  `added_date` date NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_attendance_table`
--

INSERT INTO `student_attendance_table` (`student_attent_id`, `student_id`, `batch_id`, `status`, `attend_date`, `added_date`, `staff_id`) VALUES
(94, 17, 2, '1', '2020-11-22', '2020-11-28', 2),
(95, 37, 2, '1', '2020-11-22', '2020-11-28', 2),
(96, 17, 2, '0', '2021-01-03', '2021-01-09', 2),
(97, 17, 2, '1', '2021-01-04', '2021-01-09', 2),
(98, 17, 2, '1', '2021-01-05', '2021-01-09', 2),
(99, 17, 2, '1', '2021-01-06', '2021-01-09', 2),
(100, 17, 2, '1', '2021-01-07', '2021-01-09', 2),
(101, 17, 2, '1', '2021-01-08', '2021-01-09', 2),
(102, 17, 2, '1', '2021-01-09', '2021-01-09', 2),
(103, 37, 2, '0', '2021-01-03', '2021-01-09', 2),
(104, 37, 2, '1', '2021-01-04', '2021-01-09', 2),
(105, 37, 2, '1', '2021-01-05', '2021-01-09', 2),
(106, 37, 2, '1', '2021-01-06', '2021-01-09', 2),
(107, 37, 2, '1', '2021-01-07', '2021-01-09', 2),
(108, 37, 2, '1', '2021-01-08', '2021-01-09', 2),
(109, 37, 2, '1', '2021-01-09', '2021-01-09', 2),
(110, 17, 2, '1', '2021-01-10', '2021-01-11', 2),
(111, 17, 2, '0', '2021-01-11', '2021-01-11', 2),
(112, 17, 2, '1', '2021-01-12', '2021-01-11', 2),
(113, 17, 2, '1', '2021-01-14', '2021-01-11', 2),
(114, 17, 2, '0', '2021-01-15', '2021-01-11', 2),
(115, 17, 2, '0', '2021-01-16', '2021-01-11', 2),
(116, 37, 2, '0', '2021-01-10', '2021-01-11', 2),
(117, 37, 2, '1', '2021-01-11', '2021-01-11', 2),
(118, 37, 2, '1', '2021-01-12', '2021-01-11', 2),
(119, 37, 2, '0', '2021-01-14', '2021-01-11', 2),
(120, 37, 2, '0', '2021-01-16', '2021-01-11', 2),
(121, 37, 2, '1', '2021-01-15', '2021-01-11', 2),
(122, 17, 2, '1', '2021-01-31', '2021-01-31', 2),
(123, 17, 2, '0', '2021-02-01', '2021-01-31', 2),
(124, 17, 2, '0', '2021-02-03', '2021-01-31', 2),
(125, 17, 2, '1', '2021-02-05', '2021-01-31', 2),
(126, 37, 2, '1', '2021-01-31', '2021-01-31', 2),
(127, 37, 2, '1', '2021-02-01', '2021-01-31', 2),
(128, 37, 2, '1', '2021-02-03', '2021-01-31', 2),
(129, 37, 2, '1', '2021-02-05', '2021-01-31', 2),
(130, 42, 3, '0', '2021-02-07', '2021-02-13', 2),
(131, 42, 3, '1', '2021-02-08', '2021-02-13', 2),
(132, 42, 3, '1', '2021-02-09', '2021-02-13', 2),
(133, 42, 3, '1', '2021-02-10', '2021-02-13', 2),
(134, 42, 3, '1', '2021-02-11', '2021-02-13', 2),
(135, 42, 3, '0', '2021-02-12', '2021-02-13', 2),
(136, 42, 3, '1', '2021-02-13', '2021-02-13', 2),
(137, 17, 2, '0', '2021-02-21', '2021-02-21', 2),
(138, 17, 2, '0', '2021-02-22', '2021-02-21', 2),
(139, 17, 2, '1', '2021-02-23', '2021-02-21', 2),
(140, 17, 1, '1', '2021-02-21', '2021-02-25', 2),
(141, 17, 1, '1', '2021-02-22', '2021-02-25', 2),
(142, 17, 1, '1', '2021-02-23', '2021-02-25', 2),
(143, 17, 1, '0', '2021-02-24', '2021-02-25', 2),
(144, 17, 1, '0', '2021-02-25', '2021-02-25', 2),
(145, 17, 1, '1', '2021-02-26', '2021-02-25', 2),
(146, 17, 1, '0', '2021-02-27', '2021-02-25', 2),
(147, 1, 1, '1', '2021-02-21', '2021-02-25', 2),
(148, 1, 1, '1', '2021-02-22', '2021-02-25', 2),
(149, 1, 1, '1', '2021-02-23', '2021-02-25', 2),
(150, 1, 1, '0', '2021-02-24', '2021-02-25', 2),
(151, 1, 1, '0', '2021-02-25', '2021-02-25', 2),
(152, 1, 1, '0', '2021-02-26', '2021-02-25', 2),
(153, 1, 1, '0', '2021-02-27', '2021-02-25', 2),
(154, 42, 3, '0', '2021-02-21', '2021-02-25', 2),
(155, 42, 3, '1', '2021-02-22', '2021-02-25', 2),
(156, 42, 3, '0', '2021-02-23', '2021-02-25', 2),
(157, 42, 3, '1', '2021-02-24', '2021-02-25', 2),
(158, 42, 3, '0', '2021-02-25', '2021-02-25', 2),
(159, 42, 3, '1', '2021-02-26', '2021-02-25', 2),
(160, 42, 3, '1', '2021-02-27', '2021-02-25', 2),
(161, 44, 1, '1', '2021-02-27', '2021-02-25', 2),
(162, 18, 1, '1', '2021-02-23', '2021-02-26', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_batch_map_table`
--

CREATE TABLE `student_batch_map_table` (
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `state` enum('active','deactivate','suspend','pending') NOT NULL,
  `certificate_no` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_batch_map_table`
--

INSERT INTO `student_batch_map_table` (`student_id`, `batch_id`, `staff_id`, `added_date`, `state`, `certificate_no`) VALUES
(17, 2, 3, '2020-08-05', 'active', NULL),
(17, 1, 3, '2020-08-05', 'active', '22222222'),
(1, 1, 3, '2020-08-06', 'active', '666'),
(18, 1, 3, '2020-08-10', 'active', NULL),
(37, 2, 2, '2020-11-21', 'active', NULL),
(38, 4, 2, '2020-11-24', 'active', '22222221'),
(40, 1, 3, '2021-01-29', 'active', NULL),
(41, 1, 3, '2021-01-31', 'active', NULL),
(42, 1, 3, '2021-01-31', 'suspend', NULL),
(42, 3, 2, '2021-01-31', 'active', NULL),
(43, 1, 3, '2021-01-31', 'pending', NULL),
(44, 1, 3, '2021-01-31', 'active', NULL),
(41, 4, 2, '2021-02-16', 'active', '4444444411'),
(45, 1, 2, '2022-05-01', 'active', NULL),
(46, 9, 2, '2022-06-11', 'active', NULL),
(46, 11, 2, '2022-06-11', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_mark_table`
--

CREATE TABLE `student_mark_table` (
  `student_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `state` enum('pass','fail','absent') NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_mark_table`
--

INSERT INTO `student_mark_table` (`student_id`, `batch_id`, `mark`, `state`, `subject_id`) VALUES
(17, 1, 60, 'pass', 1),
(17, 1, 72, 'pass', 2),
(17, 1, 40, 'fail', 3),
(17, 1, 70, 'pass', 4),
(42, 3, 81, 'pass', 7),
(38, 4, 66, 'pass', 9),
(17, 2, 79, 'pass', 2),
(42, 3, 55, 'pass', 10),
(17, 2, 80, 'pass', 3),
(17, 2, 70, 'pass', 4),
(17, 2, 33, 'fail', 5),
(17, 2, 0, 'absent', 6),
(17, 1, 55, 'pass', 5),
(17, 1, 55, 'pass', 6),
(41, 4, 77, 'pass', 9),
(1, 1, 60, 'pass', 2),
(1, 1, 70, 'pass', 3),
(1, 1, 55, 'pass', 4),
(1, 1, 0, 'absent', 5),
(1, 1, 33, 'fail', 6),
(18, 1, 17, 'fail', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `state` enum('active','pending','inactive') NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`student_id`, `first_name`, `last_name`, `birth_date`, `email`, `telephone`, `password`, `staff_id`, `state`, `register_date`) VALUES
(1, 'chinthan', 'pereraa', '1998-06-04', 'chinthan@gmail.com', '+94764354111', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 1, 'active', '2020-08-01'),
(17, 'praveen', 'tissera', '1985-08-03', 'praveen@gmail.com', '+94764354111', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'active', '2020-08-03'),
(18, 'lalitha', 'caldera', '2002-02-04', 'lalitha@gmail.com', '0712345644', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'active', '2020-08-10'),
(37, 'roshi', 'fernando', '2013-12-31', 'roshi@gmail.com', '+94764354111', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 2, 'active', '2020-11-21'),
(38, 'sampa', 'withanachchi', '2005-10-24', 'samparasanie@gmail.com', '12345678', 'd85c89bf4e2cf42fe4cb367394aa81e7479ec41c', 2, 'active', '2020-11-24'),
(39, '', '', '0000-00-00', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, 'active', '2020-11-28'),
(40, 'kavi', 'perera', '2000-01-01', 'kavi@gmail.com', '12345678', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'active', '2021-01-29'),
(41, 'kasun', 'manchanayaka', '2011-05-09', 'kasun@gmail.com', '12345678', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'active', '2021-01-31'),
(42, 'achala', 'upuldeniya', '2012-06-05', 'achala@gamail.com', '12345678', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'active', '2021-01-31'),
(43, 'asdfsa', 'sadfasdf', '2021-01-31', 'adsadfsadfasdfmin@gmail.com', '12332232', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'pending', '2021-01-31'),
(44, 'kasun', 'chamera', '2021-01-05', 'kasunchamera@gmail.com', '12345678', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 3, 'active', '2021-01-31'),
(45, 'kalpani', 'perera', '1994-02-24', 'kalpaniee@gmail.com', '333333333333', '4a7dc2d1bb3720cf793b8b0fa5dfb607575553dd', 2, 'active', '2022-05-01'),
(46, 'aaaaaa', 'dddddddddd', '2022-06-07', 'kumaraaaaaaa@gmail.com', '22222222222222', '7ec8aa461c2c28be905e1dfb0be256a971aa6108', 2, 'active', '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `subject_table`
--

CREATE TABLE `subject_table` (
  `subject_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `state` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_table`
--

INSERT INTO `subject_table` (`subject_id`, `course_id`, `subject_name`, `state`) VALUES
(1, 1, 'sample subject A', 'inactive'),
(2, 1, 'sample subject B', 'active'),
(3, 1, 'test title', 'active'),
(4, 1, 'test2', 'active'),
(5, 1, 'test3', 'active'),
(6, 1, 'test4', 'active'),
(7, 2, 'subject one', 'active'),
(8, 3, 'a', 'inactive'),
(9, 3, 'b', 'active'),
(10, 2, 'subject two', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_attendance_table`
--

CREATE TABLE `trainer_attendance_table` (
  `trainer_attend_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `attend_date` date NOT NULL,
  `added_date` date NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer_attendance_table`
--

INSERT INTO `trainer_attendance_table` (`trainer_attend_id`, `trainer_id`, `batch_id`, `status`, `attend_date`, `added_date`, `staff_id`) VALUES
(1, 2, 3, '1', '2021-02-21', '2021-02-25', 2),
(2, 2, 3, '1', '2021-02-22', '2021-02-25', 2),
(3, 2, 3, '1', '2021-02-23', '2021-02-25', 2),
(4, 2, 3, '1', '2021-02-24', '2021-02-25', 2),
(5, 2, 3, '1', '2021-02-25', '2021-02-25', 2),
(6, 2, 3, '1', '2021-02-26', '2021-02-25', 2),
(7, 2, 3, '0', '2021-02-27', '2021-02-25', 2),
(8, 2, 1, '1', '2021-02-21', '2021-02-25', 2),
(9, 2, 1, '1', '2021-02-22', '2021-02-25', 2),
(10, 2, 1, '0', '2021-02-23', '2021-02-25', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trainer_batch_map_table`
--

CREATE TABLE `trainer_batch_map_table` (
  `trainer_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `state` enum('active','deactivate') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer_batch_map_table`
--

INSERT INTO `trainer_batch_map_table` (`trainer_id`, `batch_id`, `staff_id`, `added_date`, `state`) VALUES
(1, 2, 2, '2020-11-25', 'deactivate'),
(2, 3, 2, '2020-12-30', 'active'),
(2, 1, 2, '2021-02-18', 'deactivate'),
(2, 1, 2, '2021-02-18', 'active'),
(1, 5, 2, '2021-02-18', 'active'),
(2, 5, 2, '2021-02-18', 'deactivate'),
(2, 1, 1, '2021-02-24', 'deactivate');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_table`
--

CREATE TABLE `trainer_table` (
  `trainer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `state` enum('active','inactive') NOT NULL,
  `register_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trainer_table`
--

INSERT INTO `trainer_table` (`trainer_id`, `first_name`, `last_name`, `birth_date`, `email`, `password`, `state`, `register_date`) VALUES
(1, 'traineraa', 'trainerb', '1987-08-26', 'trainer@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active', '2020-08-01'),
(2, 'praveen', 'tissera', '1981-11-30', 'praveen@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active', '2020-11-24'),
(3, 'Dammika', 'Bandara', '1980-01-15', 'dammika@hotmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active', '2021-02-24'),
(4, 'yonali', 'perera', '2019-06-02', 'yonali@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'active', '2021-02-25'),
(5, 'nuwan', 'kumara', '1995-02-03', 'kuma123@gmail.com', 'd194e9be0e48215e8407b159b0a67c68b36ee4ca', 'active', '2022-05-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch_table`
--
ALTER TABLE `batch_table`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `payment_receive_table`
--
ALTER TABLE `payment_receive_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `payment_schedule_table`
--
ALTER TABLE `payment_schedule_table`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_status` (`payment_status`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `staff_table`
--
ALTER TABLE `staff_table`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `student_attendance_table`
--
ALTER TABLE `student_attendance_table`
  ADD PRIMARY KEY (`student_attent_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `batch_id` (`batch_id`);

--
-- Indexes for table `student_batch_map_table`
--
ALTER TABLE `student_batch_map_table`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `student_batch_map_table_ibfk_3` (`student_id`);

--
-- Indexes for table `student_mark_table`
--
ALTER TABLE `student_mark_table`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `trainer_attendance_table`
--
ALTER TABLE `trainer_attendance_table`
  ADD PRIMARY KEY (`trainer_attend_id`),
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_batch_map_table`
--
ALTER TABLE `trainer_batch_map_table`
  ADD KEY `batch_id` (`batch_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `trainer_table`
--
ALTER TABLE `trainer_table`
  ADD PRIMARY KEY (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch_table`
--
ALTER TABLE `batch_table`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `course_table`
--
ALTER TABLE `course_table`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_receive_table`
--
ALTER TABLE `payment_receive_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment_schedule_table`
--
ALTER TABLE `payment_schedule_table`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `staff_table`
--
ALTER TABLE `staff_table`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_attendance_table`
--
ALTER TABLE `student_attendance_table`
  MODIFY `student_attent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `subject_table`
--
ALTER TABLE `subject_table`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainer_attendance_table`
--
ALTER TABLE `trainer_attendance_table`
  MODIFY `trainer_attend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainer_table`
--
ALTER TABLE `trainer_table`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch_table`
--
ALTER TABLE `batch_table`
  ADD CONSTRAINT `batch_table_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_table` (`course_id`),
  ADD CONSTRAINT `batch_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `course_table`
--
ALTER TABLE `course_table`
  ADD CONSTRAINT `course_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `payment_receive_table`
--
ALTER TABLE `payment_receive_table`
  ADD CONSTRAINT `payment_receive_table_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payment_schedule_table` (`payment_id`),
  ADD CONSTRAINT `payment_receive_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `payment_schedule_table`
--
ALTER TABLE `payment_schedule_table`
  ADD CONSTRAINT `payment_schedule_table_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`),
  ADD CONSTRAINT `payment_schedule_table_ibfk_2` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`);

--
-- Constraints for table `student_attendance_table`
--
ALTER TABLE `student_attendance_table`
  ADD CONSTRAINT `student_attendance_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `student_attendance_table_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`),
  ADD CONSTRAINT `student_attendance_table_ibfk_3` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`);

--
-- Constraints for table `student_batch_map_table`
--
ALTER TABLE `student_batch_map_table`
  ADD CONSTRAINT `student_batch_map_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `student_batch_map_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `student_batch_map_table_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`);

--
-- Constraints for table `student_mark_table`
--
ALTER TABLE `student_mark_table`
  ADD CONSTRAINT `student_mark_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `student_mark_table_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_table` (`student_id`),
  ADD CONSTRAINT `student_mark_table_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject_table` (`subject_id`);

--
-- Constraints for table `student_table`
--
ALTER TABLE `student_table`
  ADD CONSTRAINT `student_table_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`);

--
-- Constraints for table `subject_table`
--
ALTER TABLE `subject_table`
  ADD CONSTRAINT `subject_table_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_table` (`course_id`);

--
-- Constraints for table `trainer_attendance_table`
--
ALTER TABLE `trainer_attendance_table`
  ADD CONSTRAINT `trainer_attendance_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `trainer_attendance_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `trainer_attendance_table_ibfk_3` FOREIGN KEY (`trainer_id`) REFERENCES `trainer_table` (`trainer_id`);

--
-- Constraints for table `trainer_batch_map_table`
--
ALTER TABLE `trainer_batch_map_table`
  ADD CONSTRAINT `trainer_batch_map_table_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batch_table` (`batch_id`),
  ADD CONSTRAINT `trainer_batch_map_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff_table` (`staff_id`),
  ADD CONSTRAINT `trainer_batch_map_table_ibfk_3` FOREIGN KEY (`trainer_id`) REFERENCES `trainer_table` (`trainer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
