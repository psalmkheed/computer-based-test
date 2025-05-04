-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 05:43 PM
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
-- Database: `cbt_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff_registration`
--

CREATE TABLE `staff_registration` (
  `Id` int(255) NOT NULL,
  `Staff_id` varchar(24) NOT NULL,
  `Staff_name` varchar(256) NOT NULL,
  `Staff_email` varchar(100) NOT NULL,
  `Staff_phone` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_registration`
--

INSERT INTO `staff_registration` (`Id`, `Staff_id`, `Staff_name`, `Staff_email`, `Staff_phone`) VALUES
(1, '1', 'Babatunde Oluwasegun', 'psalmkheed@gmail.com', '08078097874'),
(2, '0', 'Babatunde Oluwasegun', 'psalmkheed@gmail.com', '08078097874'),
(3, 'DS/25/001', 'Babatunde Oluwasegun', 'psalmkheed@gmail.com', '08078097874'),
(4, 'DS/25/002', 'Babatunde Oluwasegun', 'psalmkheed@gmail.com', '08078097874');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff_registration`
--
ALTER TABLE `staff_registration`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff_registration`
--
ALTER TABLE `staff_registration`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
