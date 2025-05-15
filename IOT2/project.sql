-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 07:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `name` varchar(100) NOT NULL,
  `device_number` int(2) NOT NULL,
  `years_of_warranty` int(2) NOT NULL,
  `operating_system` varchar(50) NOT NULL,
  `components` varchar(1000) NOT NULL,
  `lab_number` int(4) NOT NULL,
  `department_Id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`name`, `device_number`, `years_of_warranty`, `operating_system`, `components`, `lab_number`, `department_Id`) VALUES
('Projector', 1, 2, '...', '...', 1001, 2),
('digital circuit trainer', 2, 2, '...', 'OR gates, AND gates, NOR gates, wires, digital circuit trainer', 1002, 7),
('HP computer', 5, 2, 'windows 11', 'mouse, screen, keyboard', 1087, 7),
('HP computer', 9, 2, 'windows 11', 'screen, keyboard, mouse, wires', 1087, 2),
(' HP computer', 10, 2, 'windows 11', 'mouse, screen, keyboard', 1001, 7),
('HP computer', 11, 2, 'windows 11', 'mouse, screen, keyboard', 1087, 7),
('digital circuit trainer', 18, 2, '...', 'OR gates, AND gates, NOR gates, wires, digital circuit trainer', 1002, 7);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_member`
--

CREATE TABLE `faculty_member` (
  `name` varchar(100) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `faculty_member_Id` int(6) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `department_Id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_member`
--

INSERT INTO `faculty_member` (`name`, `username`, `password`, `email`, `faculty_member_Id`, `phone_number`, `gender`, `department_Id`) VALUES
('Ahmed Nasser', 'Ahmed241', '@Ah1000', 'Ahmed@email.com', 240001, '0582345670', 'male', 1),
('Khaled Abdulaziz', 'Khaled242', '@Kh0002', 'Khaled@email.com', 240002, '0552395370', 'male', 3),
('Noura Aziz', 'Noura243', '@_N003', 'Noura@email.com', 240003, '0592399329', 'female', 2),
('Sara Ahmed', 'Sara244', '_@sara', 'Sara@email.com', 240004, '0592399999', 'female', 7),
('Rahaf Rashed', 'Rahaf245', 'Rahaf@99', 'Rahaf@email.com', 240006, '0594439329', 'female', 4),
('Mohammed Ziad', 'MohammedZ1', '@MOH_Ziad7', 'Mohammed@email.com', 240010, '0591396990', 'male', 4),
('Haifa Talal', 'Haifa_T12', '@HAIFA_t2', 'Haifa@email.com', 240017, '0586397973', 'female', 7),
('Muna Ahmed', 'Muna_Ahmed', 'MAhmed12', 'Muna@email.com', 240018, '0516397985', 'female', 8),
('Hesham Saad', 'Hesham_Saad', '_HSH23', 'Hesham@email.com', 240123, '0582445001', 'male', 2),
('Tala Abdulrahman', 'T_Abdulrahman15', 'Tala_89', 'Tala@email.com', 240409, '0582445731', 'female', 15);

-- --------------------------------------------------------

--
-- Table structure for table `it_department`
--

CREATE TABLE `it_department` (
  `name` varchar(100) NOT NULL,
  `department_Id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `it_department`
--

INSERT INTO `it_department` (`name`, `department_Id`) VALUES
('network administration', 1),
('System Administrator', 2),
('Database Administrator', 3),
('IT Security Specialist', 4),
('Software Developer/Engineer', 5),
('Web Developer', 6),
('IT Support Specialist/Help Desk Technician', 7),
('IT Project Manager', 8),
('Cloud Architect/Engineer', 9),
('Business Analyst', 10),
('Data Analyst/Scientist', 11),
('IT Auditor', 12),
('IT Trainer', 13),
('Quality Assurance (QA) Engineer', 14),
('Cybersecurity Analyst', 15);

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `lab_number` int(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  `devices_count` int(2) NOT NULL,
  `temperature` float NOT NULL,
  `faculty_member_Id` int(6) NOT NULL,
  `department_Id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`lab_number`, `type`, `devices_count`, `temperature`, `faculty_member_Id`, `department_Id`) VALUES
(1001, 'Networks Lab', 20, 0, 240001, 7),
(1002, 'Digital logic lab', 18, 0, 240017, 7),
(1086, 'programming lab', 22, 0, 240123, 2),
(1087, 'programming lab', 20, 0, 240123, 2);

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `lab_id` int(11) NOT NULL,
  `lab_type` varchar(255) NOT NULL,
  `num_devices` int(11) NOT NULL,
  `device_info` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `programs` varchar(255) NOT NULL,
  `temperature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`lab_id`, `lab_type`, `num_devices`, `device_info`, `os`, `programs`, `temperature`) VALUES
(1, 'Programming laboratory', 30, 'Device- Dell Desktop Computer', 'Windows 10', 'install visual studio code', 22),
(2, 'Database and Big Data Analysis Laboratory', 27, 'Device- Dell Desktop Computer', 'Windows 10', 'install visual studio code', 21),
(1, 'Programming laboratory', 30, 'Device- Dell Desktop Computer', 'Windows 10', 'install visual studio code', 22),
(2, 'Database and Big Data Analysis Laboratory', 27, 'Device- Dell Desktop Computer', 'Windows 10', 'install visual studio code', 21);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `accesscode` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `accesscode`, `last_login`) VALUES
('mariam', '827ccb0eea8a706c4c34a16891f84e7b', 'd41d8cd98f00b204e9800998ecf8427e', '2024-04-01 22:04:09'),
('mariam', '827ccb0eea8a706c4c34a16891f84e7b', 'd41d8cd98f00b204e9800998ecf8427e', '2024-04-01 22:04:09'),
('admin', 'admin123', '', '2024-04-16 08:10:05'),
('admin', 'admin123', '', '2024-04-16 08:10:05'),
('admin12345', 'admin12345', '', '2024-04-16 08:14:09'),
('user', '12345', '', '2024-04-16 08:14:09'),
('admin', 'admin123', '', '2024-04-16 08:10:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty_member`
--
ALTER TABLE `faculty_member`
  ADD PRIMARY KEY (`faculty_member_Id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_Id` (`department_Id`);

--
-- Indexes for table `it_department`
--
ALTER TABLE `it_department`
  ADD PRIMARY KEY (`department_Id`);

--
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`lab_number`),
  ADD KEY `faculty_member_Id` (`faculty_member_Id`),
  ADD KEY `department_Id` (`department_Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`department_Id`) REFERENCES `it_department` (`department_Id`),
  ADD CONSTRAINT `device_ibfk_2` FOREIGN KEY (`lab_number`) REFERENCES `laboratory` (`lab_number`);

--
-- Constraints for table `faculty_member`
--
ALTER TABLE `faculty_member`
  ADD CONSTRAINT `faculty_member_ibfk_1` FOREIGN KEY (`department_Id`) REFERENCES `it_department` (`department_Id`);

--
-- Constraints for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD CONSTRAINT `laboratory_ibfk_1` FOREIGN KEY (`faculty_member_Id`) REFERENCES `faculty_member` (`faculty_member_Id`),
  ADD CONSTRAINT `laboratory_ibfk_2` FOREIGN KEY (`department_Id`) REFERENCES `it_department` (`department_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
