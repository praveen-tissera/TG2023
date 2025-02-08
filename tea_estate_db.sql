-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2025 at 08:44 PM
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
-- Database: `tea_estate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `worker_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`worker_id`, `date`, `status`) VALUES
(1, '2024-08-10', 1),
(1, '2024-08-13', 0),
(1, '2024-08-15', 1),
(1, '2024-08-27', 1),
(1, '2024-08-28', 0),
(2, '2024-08-10', 1),
(2, '2024-08-13', 0),
(2, '2024-08-15', 1),
(2, '2024-08-27', 0),
(2, '2024-08-28', 1),
(3, '2024-08-10', 0),
(3, '2024-08-13', 0),
(3, '2024-08-15', 1),
(3, '2024-08-27', 1),
(3, '2024-08-28', 0),
(6, '2024-08-13', 0),
(6, '2024-08-15', 1),
(6, '2024-08-27', 0),
(6, '2024-08-28', 1),
(7, '2024-08-15', 1),
(7, '2024-08-27', 1),
(7, '2024-08-28', 0),
(9, '2024-08-27', 0),
(9, '2024-08-28', 1),
(10, '2024-08-27', 1),
(10, '2024-08-28', 0),
(12, '2024-08-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chemical_in_tbl`
--

CREATE TABLE `chemical_in_tbl` (
  `chem_id` int(15) NOT NULL,
  `date` date NOT NULL,
  `amount` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `supplier` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemical_in_tbl`
--

INSERT INTO `chemical_in_tbl` (`chem_id`, `date`, `amount`, `cost`, `supplier`) VALUES
(1, '2024-01-07', 40, 7000, 1),
(1, '2024-01-07', 20, 500, 1),
(1, '2024-01-07', 20, 500, 1),
(1, '2024-01-13', 20, 500, 2),
(1, '2024-01-13', 40, 7000, 1),
(1, '2024-01-14', 20, 500, 1),
(1, '2024-08-13', 2000, 500, 2),
(1, '2024-08-13', 2000, 500, 1),
(1, '2024-08-15', 2000, 500, 1),
(5, '2024-08-28', 100, 6000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chemical_out_tbl`
--

CREATE TABLE `chemical_out_tbl` (
  `chem_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemical_out_tbl`
--

INSERT INTO `chemical_out_tbl` (`chem_id`, `supp_id`, `date`, `amount`) VALUES
(1, 0, '2024-01-07', 20),
(1, 0, '2024-01-14', 20),
(1, 2, '2024-08-13', 200),
(1, 1, '2024-08-13', 500),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-13', 200),
(1, 1, '2024-08-15', 200),
(5, 1, '2024-08-28', 50);

-- --------------------------------------------------------

--
-- Table structure for table `chemical_tbl`
--

CREATE TABLE `chemical_tbl` (
  `chem_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` enum('weedicide','pesticide','fertilizer') NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chemical_tbl`
--

INSERT INTO `chemical_tbl` (`chem_id`, `name`, `type`, `description`, `status`) VALUES
(1, 'Sodium Hydroxide', 'pesticide', 'Sodium Hydroxide is used to kill cockroaches', 1),
(2, 'Carbophosphate', 'fertilizer', 'Cabophosphate is used as fertilizer in tea plants', 1),
(3, 'Nitrogen tetroxide', 'fertilizer', 'Nitrogentetroxide is used to increase the nitrogen content of the soil', 1),
(4, 'Triethylbutane', 'weedicide', 'Triethylbutane is used to kill common weeds', 1),
(5, 'Urea', 'fertilizer', 'Urea is used to increase the growth of green leaves', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chem_supplier_tbl`
--

CREATE TABLE `chem_supplier_tbl` (
  `chem_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chem_supplier_tbl`
--

INSERT INTO `chem_supplier_tbl` (`chem_id`, `supplier_id`) VALUES
(1, 1),
(1, 2),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `current_chemical_tbl`
--

CREATE TABLE `current_chemical_tbl` (
  `chem_id` int(11) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `amount` int(10) NOT NULL,
  `cost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_chemical_tbl`
--

INSERT INTO `current_chemical_tbl` (`chem_id`, `supp_id`, `amount`, `cost`) VALUES
(1, 1, 3400, 500),
(1, 2, 4000, 500),
(5, 1, 50, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `current_finance_tbl`
--

CREATE TABLE `current_finance_tbl` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_finance_tbl`
--

INSERT INTO `current_finance_tbl` (`id`, `type`, `amount`) VALUES
(1, 'bank', 1053760),
(2, 'cash', 1017800);

-- --------------------------------------------------------

--
-- Table structure for table `estate_status_tbl`
--

CREATE TABLE `estate_status_tbl` (
  `date` date NOT NULL,
  `id` enum('1','2','3','4','5') NOT NULL,
  `status` enum('fertilizer','pesticide','weedicide','harvest','weeding','prune','maintenance') NOT NULL,
  `colour` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estate_status_tbl`
--

INSERT INTO `estate_status_tbl` (`date`, `id`, `status`, `colour`) VALUES
('2024-06-01', '4', 'harvest', 'bg-primary'),
('2024-06-05', '3', 'weedicide', 'bg-primary'),
('2024-08-10', '3', 'maintenance', 'bg-primary'),
('2024-08-10', '4', 'weedicide', 'bg-danger'),
('2024-08-15', '1', 'fertilizer', 'table-success'),
('2024-08-15', '2', 'weedicide', 'bg-danger'),
('2024-08-15', '5', 'maintenance', 'bg-warning'),
('2024-08-25', '3', 'weedicide', 'bg-danger'),
('2024-08-27', '1', 'maintenance', 'bg-primary'),
('2024-08-27', '2', 'prune', 'bg-info'),
('2024-08-27', '3', 'weeding', 'bg-warning'),
('2024-08-27', '4', 'harvest', 'bg-success'),
('2024-08-27', '5', 'weedicide', 'bg-danger'),
('2024-08-28', '4', 'harvest', 'bg-success');

-- --------------------------------------------------------

--
-- Table structure for table `expense_tbl`
--

CREATE TABLE `expense_tbl` (
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `type_ID` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_tbl`
--

INSERT INTO `expense_tbl` (`date`, `amount`, `type_ID`, `source`, `comments`, `image`) VALUES
('2024-08-13', 2000, 3, 1, 'IT', '1723569788abc.png'),
('2024-08-15', 2000, 3, 1, 'Test for ODR', '1723706477Screenshot2023-05-28145951.png'),
('2024-08-28', 2000, 5, 1, 'The electricity bill for this month', '1724852741TeaEstateHill.png');

-- --------------------------------------------------------

--
-- Table structure for table `expense_types_tbl`
--

CREATE TABLE `expense_types_tbl` (
  `type_ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_types_tbl`
--

INSERT INTO `expense_types_tbl` (`type_ID`, `name`, `description`, `status`) VALUES
(1, 'Other', 'Expenses that do not belong to other categories', 1),
(3, 'Weekly Wages', 'Weekly wages are paid to the temporary employees who work on the estate', 1),
(4, 'Water Bill', 'The cost of water', 1),
(5, 'Electricity Bill', 'The expenses as a result of electricity use on the estate', 1);

-- --------------------------------------------------------

--
-- Table structure for table `income_tbl`
--

CREATE TABLE `income_tbl` (
  `date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income_tbl`
--

INSERT INTO `income_tbl` (`date`, `amount`, `type_id`, `source`, `comments`, `image`) VALUES
('2024-08-13', 2000, 1, 2, 'IT', '1723569802test4.png'),
('2024-08-15', 2000, 1, 1, 'Validation Test', '1723693935Screenshot2023-07-16145104.png'),
('2024-08-15', 2000, 1, 2, 'Test for ODR', '1723706505Screenshot2023-09-24124147.png'),
('2024-08-28', 50000, 5, 1, 'Tea sold to the Dancil Tea Factory for the past month', '1724851176TeaEstate.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `income_types_tbl`
--

CREATE TABLE `income_types_tbl` (
  `type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income_types_tbl`
--

INSERT INTO `income_types_tbl` (`type_id`, `name`, `description`, `status`) VALUES
(1, 'Harangala', 'Cheques from Harangala', 1),
(3, 'Owner', 'Owners may sometimes inject financial resources into the estate', 1),
(4, 'Thea Shakthi', 'Cheques from the Thea Shakthi Tea Factory', 1),
(5, 'Dancil Tea Factory', 'Income by selling tea to the Dancil Tea Factory', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_tbl`
--

CREATE TABLE `supplier_tbl` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_tbl`
--

INSERT INTO `supplier_tbl` (`supplier_id`, `name`, `address`, `status`) VALUES
(1, 'One Chemical', 'One Trade Center,\r\nColombo 2,\r\nColombo', 1),
(2, 'Fertilizer Industries', '311/11,\r\nGinigathhena Road,\r\nNawalapitiya', 1),
(4, 'Fast Grow', '663,\r\nGrover Lane,\r\nKandy', 0),
(5, 'Mother Earth Suppliers', 'No. 30, \r\nBandaranayake Mawatha,\r\nMaharagama.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `role` enum('admin','owner','manager') NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `name`, `email`, `password`, `address`, `role`, `created_date`) VALUES
(1, 'Ravija Amarasinghe', 'ravijaamarasinghe@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '211/3A, Kuddamaduwa, Sidamulla', 'admin', '2023-12-01'),
(2, 'Kumara Ranasinghe', 'ranasinghe@outlook.com', 'ee48483c01fa3e960ad3acfce6f9fa55b092e687', '112,222,\r\nKandy Road,\r\nKandy', 'manager', '2023-12-14'),
(3, 'Coronis Jagannath Oppenheimer', 'c.oppenheimer@gmail.com', 'c901d12c287f97e58e725c3ff09ee1479365e0bf', '422/63,\r\n21st Lane,\r\nCarson City,\r\nNV', 'owner', '2024-08-27'),
(4, 'Nail Sandhya Shaw', 'Nail Sandhya Shaw@nailsandhyashaw.com', 'd8a7ca97aa7117e6b4752c14e5c5fc056b549477', '182/3,\r\nMaawill Place,\r\nWellmilla,\r\nBandaragama.', 'manager', '2024-08-27'),
(5, 'Laverna Themistokles Armati', 'LavernaThemistoklesArmati@outlook.com', 'b108f535dbbe352ab847d80dd99893d8cbe77028', '134 Kumaran Ratnam Road, \r\n02 Colombo,\r\nColombo.', 'owner', '2024-08-27'),
(6, 'Jack Willoughby ', 'jackwilloughby@outlook.com', '2b12e1a2252d642c09f640b63ed35dcc5690464a', '43 Castle Street, \r\nColombo 08,\r\nColombo.', 'owner', '2024-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `weather_tbl`
--

CREATE TABLE `weather_tbl` (
  `date` date NOT NULL,
  `relative_humidity` double NOT NULL,
  `max_temp` double NOT NULL,
  `min_temp` double NOT NULL,
  `daylight_duration` double NOT NULL,
  `rain_sum` double NOT NULL,
  `max_wind_speed` double NOT NULL,
  `wind_direction` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weather_tbl`
--

INSERT INTO `weather_tbl` (`date`, `relative_humidity`, `max_temp`, `min_temp`, `daylight_duration`, `rain_sum`, `max_wind_speed`, `wind_direction`) VALUES
('2024-05-08', 64, 27.1, 18.6, 42511.42, 0, 10.9, 32),
('2024-05-10', 83, 30.7, 19.1, 44095.66, 0, 10.7, 336),
('2024-05-17', 94, 27.3, 21.9, 44823.66, 0, 10.5, 221),
('2024-05-22', 90, 25, 23.1, 44896.16, 0, 23.4, 227),
('2024-06-11', 55, 28.3, 15.8, 42767.4, 0, 12.4, 47),
('2024-06-17', 55, 30.6, 18.7, 42891.38, 0, 11.2, 42),
('2024-07-26', 60, 29.6, 18.5, 43751.85, 0, 11.9, 253),
('2024-08-10', 90, 26.4, 22.2, 44543.82, 0, 12.4, 218),
('2024-08-15', 72, 27.5, 21.6, 44444.16, 0, 14, 219),
('2025-01-20', 74, 25.6, 19.5, 42400.41, 0, 8.2, 28);

-- --------------------------------------------------------

--
-- Table structure for table `worker_tbl`
--

CREATE TABLE `worker_tbl` (
  `worker_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `emp_status` enum('permanent','temporary') NOT NULL,
  `wage` int(10) NOT NULL,
  `EPF` int(10) DEFAULT NULL,
  `EPF_no` int(10) DEFAULT NULL,
  `ETF` int(10) DEFAULT NULL,
  `ETF_no` int(10) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `education` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker_tbl`
--

INSERT INTO `worker_tbl` (`worker_id`, `name`, `dob`, `emp_status`, `wage`, `EPF`, `EPF_no`, `ETF`, `ETF_no`, `gender`, `education`, `address`, `active`) VALUES
(1, 'Ran Kirchov', '2019-06-15', 'permanent', 3000, 100, 91091494, 200, 333, 'Male', 'Diploma', '222,3B, Horana Road, Horana', 1),
(2, 'Rani Kustan', '2000-05-10', 'temporary', 2000, 50, 333333, 55, 777777, 'Female', 'High School', '11,34B, Kandy Road, Nawalapitiya', 1),
(3, 'Ron Gamage', '2000-06-04', 'temporary', 3400, 30, 29292922, 3030, 444, 'Male', 'Degree', '311,3A,\r\nHogwarts', 1),
(6, 'Issac Clair', '2067-02-05', 'temporary', 3400, NULL, NULL, NULL, NULL, 'Male', 'Diploma', 'N/A', 1),
(7, 'Issac James', '2024-08-01', 'temporary', 2000, NULL, NULL, NULL, NULL, 'Male', 'NA', 'NA', 1),
(8, 'Ravija Geethika Amarasinghe', '2024-09-01', 'temporary', 20, NULL, NULL, NULL, NULL, 'Male', 'Highest', '211/2A\r\nKuddamaduwa, Siddamulla', 0),
(9, 'Sumaiya Manish D\'Cruze', '1990-11-15', 'temporary', 3200, NULL, NULL, NULL, NULL, 'Female', 'A/L Passed', '353 Kollupitiya Road,\r\nNawalapitiya', 1),
(10, 'Firoz Zuhra Tamboli', '1980-07-15', 'permanent', 4000, 200, 2147483647, 300, 2147483647, 'Male', 'O/L Passed', ' No. 1080/1N, \r\nDarmasoka Mawatha,\r\nGinigathhena.', 1),
(12, 'Ravi Kularathna', '1995-07-12', 'permanent', 3500, 210, 2147483647, 310, 369651298, 'Male', 'GCE O/L Passe', '92/33, \r\nTalapathpitiya Road,\r\nNawalapitiya', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`worker_id`,`date`);

--
-- Indexes for table `chemical_tbl`
--
ALTER TABLE `chemical_tbl`
  ADD PRIMARY KEY (`chem_id`);

--
-- Indexes for table `chem_supplier_tbl`
--
ALTER TABLE `chem_supplier_tbl`
  ADD PRIMARY KEY (`chem_id`,`supplier_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `current_chemical_tbl`
--
ALTER TABLE `current_chemical_tbl`
  ADD PRIMARY KEY (`chem_id`,`supp_id`);

--
-- Indexes for table `current_finance_tbl`
--
ALTER TABLE `current_finance_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estate_status_tbl`
--
ALTER TABLE `estate_status_tbl`
  ADD PRIMARY KEY (`date`,`id`);

--
-- Indexes for table `expense_types_tbl`
--
ALTER TABLE `expense_types_tbl`
  ADD PRIMARY KEY (`type_ID`);

--
-- Indexes for table `income_types_tbl`
--
ALTER TABLE `income_types_tbl`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `supplier_tbl`
--
ALTER TABLE `supplier_tbl`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weather_tbl`
--
ALTER TABLE `weather_tbl`
  ADD PRIMARY KEY (`date`);

--
-- Indexes for table `worker_tbl`
--
ALTER TABLE `worker_tbl`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chemical_tbl`
--
ALTER TABLE `chemical_tbl`
  MODIFY `chem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `current_finance_tbl`
--
ALTER TABLE `current_finance_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_types_tbl`
--
ALTER TABLE `expense_types_tbl`
  MODIFY `type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `income_types_tbl`
--
ALTER TABLE `income_types_tbl`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier_tbl`
--
ALTER TABLE `supplier_tbl`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `worker_tbl`
--
ALTER TABLE `worker_tbl`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD CONSTRAINT `attendance_tbl_ibfk_1` FOREIGN KEY (`worker_id`) REFERENCES `worker_tbl` (`worker_id`);

--
-- Constraints for table `chem_supplier_tbl`
--
ALTER TABLE `chem_supplier_tbl`
  ADD CONSTRAINT `chem_supplier_tbl_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_tbl` (`supplier_id`),
  ADD CONSTRAINT `chem_supplier_tbl_ibfk_2` FOREIGN KEY (`chem_id`) REFERENCES `chemical_tbl` (`chem_id`);

--
-- Constraints for table `current_chemical_tbl`
--
ALTER TABLE `current_chemical_tbl`
  ADD CONSTRAINT `current_chemical_tbl_ibfk_1` FOREIGN KEY (`chem_id`) REFERENCES `chemical_tbl` (`chem_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
