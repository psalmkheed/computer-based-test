-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 10:51 PM
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
  `Class` varchar(8) NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Date_published` date DEFAULT NULL,
  `Time_published` time NOT NULL DEFAULT '10:00:00',
  `Exam_duration` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_exam`
--

INSERT INTO `add_exam` (`Exam_id`, `Class`, `Subject`, `Date_published`, `Time_published`, `Exam_duration`) VALUES
(1, '', 'Biology', '2025-05-23', '12:30:00', 60),
(2, '', 'Economics', '2025-05-05', '12:48:00', 60),
(13, '', 'Mathematics', '2025-05-10', '13:00:00', 50),
(14, '', 'Geography', '2025-05-02', '11:31:00', 80),
(15, '', 'English Language', '2025-05-02', '09:50:00', 65),
(16, '', 'Physics', '2025-05-01', '10:12:00', 50),
(17, '', 'Chemistry', '2025-05-03', '13:06:00', 60),
(18, 'SS2', 'Agric', '2025-05-30', '13:12:00', 25),
(21, 'SS3', 'CRS', '2025-05-17', '09:34:00', 58),
(22, 'JSS1', 'RNV', '2025-05-17', '12:54:00', 20),
(23, 'JSS1', 'NVE', '2025-05-10', '13:07:00', 500);

-- --------------------------------------------------------

--
-- Table structure for table `add_questions`
--

CREATE TABLE `add_questions` (
  `id` int(255) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `question_text` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_questions`
--

INSERT INTO `add_questions` (`id`, `subject`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 'Biology', 'i', 'a', 's', 's', 'a', 'A'),
(2, 'Biology', 'What is a Noun?', 'A name of Person', 'A name of this', 'A name of Iron', 'A something', 'A'),
(3, 'Economics', 'What is Economics?', 'Economics is the study of how individuals, businesses, and governments make choices when faced with scarcity, or limited resources, to satisfy their needs and wants', 'Economics explores how individuals, businesses, and governments decide what to produce, how to produce it, and for whom.', 'Economics examines the processes of creating goods and services, allocating them to different individuals or groups, and how people ultimately use those goods and services.', 'Microeconomics focuses on individual decisions of consumers and firms, while macroeconomics analyzes the overall economy of a nation', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `teacher_name`, `category`, `session`) VALUES
(6, 'SS 1', 'Babatunde Oluwasegun', 'General', '2024/2025'),
(7, 'SS 2', 'Babatunde Oluwasegun', 'General', '2024/2025'),
(8, 'SS 3', 'Balogun Blacco', 'General', '2024/2025'),
(9, 'JSS 1', 'Babatunde Oluwasegun', 'General', '2024/2025'),
(10, 'JSS 2', 'Balogun Blacco', 'General', '2024/2025'),
(11, 'JSS 3', 'Babatunde Oluwasegun', 'General', '2024/2025');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `num_questions` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `exam_id`, `subject`, `num_questions`, `duration`, `expiry_date`) VALUES
(1, 'exam_6821061a94226', 'Grammar', 2, 20, '2025-05-16'),
(2, 'exam_6821093b39769', 'Economics', 2, 2, '2025-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(50) DEFAULT NULL,
  `question_number` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `exam_id`, `question_number`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 'exam_6821061a94226', 1, 'What is a Noun?', 'A name of person', 'A name of Animal', 'A name of thing', 'All of the above', 'd'),
(2, 'exam_6821061a94226', 2, 'What is a verb?', 'An action word', 'A doing word', 'A pronoun', 'A & B', 'd'),
(3, 'exam_6821093b39769', 1, 'What is Economics?', 'A name of person', 'A name of Animal', 'A name of thing', 'All of the above', 'd'),
(4, 'exam_6821093b39769', 2, 'What is marginal Cost?', 'An action word', 'A doing word', 'A pronoun', 'A & B', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `exam_id` varchar(50) DEFAULT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `taken_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `exam_id`, `student_id`, `score`, `total`, `taken_at`) VALUES
(1, 'exam_6821061a94226', 'student1', 0, 2, '2025-05-11 20:38:40'),
(2, 'exam_6821061a94226', 'student1', 1, 2, '2025-05-11 20:39:30'),
(3, 'exam_6821093b39769', 'student1', 2, 2, '2025-05-11 20:44:04'),
(4, 'exam_6821093b39769', 'student1', 2, 2, '2025-05-11 20:49:17'),
(5, 'exam_6821061a94226', 'student1', 1, 2, '2025-05-11 20:49:41');

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
(4, 'DS/25/002', 'Babatunde Oluwasegun', 'psalmkheed@gmail.com', '08078097874'),
(5, 'DS/25/003', 'Balogun Blacco', 'psalmkheed123@gmail.com', '08078097874');

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
  `Current_Class` varchar(24) NOT NULL,
  `Session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`Id`, `Photo_Id`, `Registration_Number`, `Surname`, `First_Name`, `Other_Name`, `Gender`, `DOB`, `State_of_Origin`, `Joined_Date`, `Parent_Full_Name`, `Parent_Email`, `Parent_Phone`, `Parent_Address`, `Current_Class`, `Session`) VALUES
(1, 0x313734363131333632385f7061747465726e2e706e67, 'DC/JS/25/01', 'Babatunde', 'Oluwasegun', 'Samuel', 'Male', '2025-03-07', 'Ogun', '2025-05-16', 'Mr &amp; Mrs Babatunde', 'psalmkheed123@gmail.com', '08078097874', 'Idimu, Lagos', 'SS1', '2024/2025'),
(5, 0x313734363639303334385f49736161632e6a7067, 'DSS/25/001', 'Nzubike', 'Isaac', 'John', 'Male', '2010-10-14', 'Anambra', '2025-01-06', 'Mr &amp; Mrs Nzubike', 'idowu@dowog.com', '08033356914', 'Igando, Lagos', 'SS1', '2024/2025');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `class`, `category`) VALUES
(1, 'Biology', 'SS 1', 'Science'),
(2, 'Economics', 'SS 2', 'General'),
(3, 'Mathematics', 'SS 1', 'General'),
(4, 'Further Maths', 'SS 2', 'Science'),
(5, 'Commerce', 'SS 1', 'Commercial'),
(6, 'English', 'SS 3', 'General'),
(7, 'CHEM/BUS/LIT', 'SS 1', 'General'),
(8, 'AGRICULTURAL SCIENCE', 'SS 1', 'General'),
(9, 'TECHNICAL DRAWING', 'SS 1', 'General'),
(10, 'TECHNICAL DRAWING', 'SS 2', 'General'),
(11, 'CHEMISTRY', 'SS 1', 'Science'),
(12, 'CHEMISTRY', 'SS 2', 'Science'),
(13, 'CHEMISTRY', 'SS 3', 'Science'),
(14, 'LITERATURE-IN-ENGLISH', 'SS 1', 'Art'),
(15, 'LITERATURE-IN-ENGLISH', 'SS 2', 'Art'),
(16, 'LITERATURE-IN-ENGLISH', 'SS 3', 'Art'),
(17, 'Biology', 'SS 2', 'Science'),
(18, 'Biology', 'SS 3', 'Science'),
(19, 'Economics', 'SS 1', 'General'),
(20, 'Economics', 'SS 3', 'General'),
(21, 'Mathematics', 'SS 2', 'General'),
(22, 'Mathematics', 'SS 3', 'General'),
(23, 'Further Maths', 'SS 1', 'Science'),
(24, 'Further Maths', 'SS 3', 'Science'),
(25, 'Commerce', 'SS 2', 'Commercial'),
(26, 'Commerce', 'SS 3', 'Commercial'),
(27, 'English', 'SS 2', 'General'),
(28, 'English', 'SS 1', 'General'),
(29, 'NVE', 'JSS 1', 'General'),
(30, 'NVE', 'JSS 2', 'General'),
(31, 'NVE', 'JSS 3', 'General'),
(32, 'AGRICULTURAL SCIENCE', 'SS 2', 'Science'),
(33, 'AGRICULTURAL SCIENCE', 'SS 3', 'Science'),
(34, 'TECHNICAL DRAWING', 'SS 3', 'General'),
(35, 'FOODS &amp; NUTRITION', 'SS 1', 'General'),
(36, 'FOODS &amp; NUTRITION', 'SS 2', 'General'),
(37, 'FOODS &amp; NUTRITION', 'SS 3', 'General'),
(38, 'CRS', 'JSS 1', 'General'),
(39, 'CRS', 'JSS 2', 'General'),
(40, 'CRS', 'JSS 3', 'General'),
(41, 'GOVERNMENT', 'SS 1', 'General'),
(42, 'GOVERNMENT', 'SS 2', 'General'),
(43, 'GOVERNMENT', 'SS 3', 'General'),
(44, 'GEOGRAPHY', 'SS 1', 'Science'),
(45, 'GEOGRAPHY', 'SS 2', 'Science'),
(46, 'GEOGRAPHY', 'SS 3', 'Science'),
(47, 'PHY/ACCT/CRS', 'SS 1', 'General'),
(48, 'PHY/ACCT/CRS', 'SS 2', 'General'),
(49, 'PHY/ACCT/CRS', 'SS 3', 'General'),
(50, 'Catering Craft', 'SS 1', 'General'),
(51, 'Catering Craft', 'SS 2', 'General'),
(52, 'Catering Craft', 'SS 3', 'General'),
(53, 'RNV', 'JSS 1', 'General'),
(54, 'RNV', 'JSS 2', 'General'),
(55, 'RNV', 'JSS 3', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

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
-- Indexes for table `add_questions`
--
ALTER TABLE `add_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_registration`
--
ALTER TABLE `staff_registration`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
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
-- AUTO_INCREMENT for table `add_exam`
--
ALTER TABLE `add_exam`
  MODIFY `Exam_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `add_questions`
--
ALTER TABLE `add_questions`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `staff_registration`
--
ALTER TABLE `staff_registration`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `Id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
