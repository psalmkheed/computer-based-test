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
-- Table structure for table `add_exam`
--

CREATE TABLE `add_exam` (
  `Exam_id` int(8) NOT NULL,
  `Exam_name` varchar(256) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Date_published` date DEFAULT NULL,
  `Time_published` time NOT NULL DEFAULT '10:00:00',
  `Exam_duration` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_exam`
--

INSERT INTO `add_exam` (`Exam_id`, `Exam_name`, `Subject`, `Date_published`, `Time_published`, `Exam_duration`) VALUES
(1, ' Biology Exam', 'Biology', '2025-05-23', '12:30:00', 60),
(2, 'Economics Exam', 'Economics', '2025-05-05', '12:48:00', 60),
(13, 'Mahematics Exam', 'Mathematics', '2025-05-10', '13:00:00', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_exam`
--
ALTER TABLE `add_exam`
  ADD PRIMARY KEY (`Exam_id`),
  ADD UNIQUE KEY `Exam_id` (`Exam_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_exam`
--
ALTER TABLE `add_exam`
  MODIFY `Exam_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
