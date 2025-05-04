-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2025 at 05:42 PM
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
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `Id` int(8) NOT NULL,
  `Photo_Id` blob NOT NULL,
  `Registration_Number` varchar(256) NOT NULL,
  `Surname` varchar(100) NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Other_Name` varchar(100) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `DOB` date NOT NULL,
  `State_of_Origin` varchar(100) NOT NULL,
  `Joined_Date` date NOT NULL,
  `Parent_Full_Name` varchar(256) NOT NULL,
  `Parent_Email` varchar(100) NOT NULL,
  `Parent_Phone` varchar(24) NOT NULL,
  `Parent_Address` varchar(256) NOT NULL,
  `Current_Class` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`Id`, `Photo_Id`, `Registration_Number`, `Surname`, `First_Name`, `Other_Name`, `Gender`, `DOB`, `State_of_Origin`, `Joined_Date`, `Parent_Full_Name`, `Parent_Email`, `Parent_Phone`, `Parent_Address`, `Current_Class`) VALUES
(1, 0x313734363131333632385f7061747465726e2e706e67, 'DC/JS/25/01', 'Babatunde', 'Oluwasegun', 'Samuel', 'Male', '2025-03-07', 'Ogun', '2025-05-16', 'Mr &amp; Mrs Babatunde', 'psalmkheed123@gmail.com', '08078097874', 'Idimu, Lagos', 'SS1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `Id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
