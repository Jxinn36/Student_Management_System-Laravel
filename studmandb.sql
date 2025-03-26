-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 07:42 AM
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
-- Database: `studmandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` varchar(255) NOT NULL,
  `lecID` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `creditHours` int(11) NOT NULL,
  `paperType` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `lecID`, `courseName`, `creditHours`, `paperType`, `created_at`, `updated_at`) VALUES
('BA1123', '006325', 'Intoduction to Business', 3, 0, NULL, NULL),
('BA2143', '006325', 'Business Administration', 3, 0, NULL, NULL),
('BA6847', '005698', 'Programming C', 4, 0, NULL, NULL),
('CS1013', '005698', 'Introduction to Programming', 3, 0, NULL, NULL),
('MA1013', '006325', 'Introduction to Marketing', 4, 0, NULL, NULL),
('MM1034', '005698', 'Probability and Statistics', 4, 1, NULL, NULL),
('MPU1203', '005698', 'Pendidikan Moral', 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courseID` varchar(255) NOT NULL,
  `studID` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_student`
--

INSERT INTO `course_student` (`id`, `courseID`, `studID`, `created_at`, `updated_at`) VALUES
(19, 'BA6847', '2208275', NULL, NULL),
(20, 'BA6847', '2208564', NULL, NULL),
(21, 'BA6847', '2209824', NULL, NULL),
(22, 'CS1013', '2208275', NULL, NULL),
(23, 'CS1013', '2208564', NULL, NULL),
(24, 'BA1123', '3305682', NULL, NULL),
(25, 'BA1123', '3309824', NULL, NULL),
(33, 'BA6847', '2245872', NULL, NULL),
(37, 'CS1013', '2245872', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `studID` varchar(255) NOT NULL,
  `courseID` varchar(255) NOT NULL,
  `marks` decimal(5,2) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `avgStud` decimal(5,2) DEFAULT NULL,
  `avgSub` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `studID`, `courseID`, `marks`, `grade`, `avgStud`, `avgSub`, `created_at`, `updated_at`) VALUES
(3, '2208564', 'BA6847', 70.00, 'B+', 0.00, 67.33, '2025-03-24 22:00:54', '2025-03-25 17:16:25'),
(4, '2208564', 'CS1013', 30.00, 'F', 0.00, 46.25, '2025-03-24 22:09:04', '2025-03-25 18:15:32'),
(5, '2245872', 'BA6847', 90.00, 'A', 82.50, 67.33, '2025-03-24 23:25:19', '2025-03-25 18:15:32'),
(6, '2258974', 'CS1013', 20.00, 'F', 0.00, 46.25, '2025-03-24 23:28:28', '2025-03-25 18:15:32'),
(7, '2208275', 'BA6847', 42.00, 'F', 51.00, 67.33, '2025-03-25 00:38:12', '2025-03-25 18:03:52'),
(8, '2208275', 'CS1013', 60.00, 'B-', 51.00, 46.25, '2025-03-25 17:16:39', '2025-03-25 18:15:32'),
(9, '2245872', 'CS1013', 75.00, 'A-', 82.50, 46.25, '2025-03-25 18:15:32', '2025-03-25 18:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecID` varchar(255) NOT NULL,
  `lecName` varchar(100) NOT NULL,
  `lecEmail` varchar(255) NOT NULL,
  `lecCampus` varchar(255) NOT NULL,
  `lecFaculty` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecID`, `lecName`, `lecEmail`, `lecCampus`, `lecFaculty`, `password`, `created_at`, `updated_at`) VALUES
('005698', 'Dr. Lim Ling Lin', 'lim@gmail.com', 'Kuala Lumpur Campus', 'Faculty of Computer Science', '$2y$12$TrXcyLjFyicFOam9hi9PNO/xViwVV5EdmfWmcgxi84pqZinw4IpHm', NULL, '2025-03-25 22:35:52'),
('006325', 'Prof. Tan Mei Mei', 'tan@example.com', 'Malacca Campus', 'Faculty of Business', '$2y$12$5njN6ocw01xEdTMyDkvpGO7V7Il3n24rQ.gwQVQiXFPF8JQPsgKpW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2025_03_23_065018_create_students_table', 1),
(8, '2025_03_24_040205_create_lecturers_table', 2),
(9, '2025_03_23_065020_create_exam_table', 3),
(10, '2025_03_24_043633_create_course_student_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studID` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `programme` varchar(255) NOT NULL,
  `year` int(5) NOT NULL,
  `sem` int(5) NOT NULL,
  `group` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studID`, `email`, `name`, `faculty`, `programme`, `year`, `sem`, `group`, `created_at`, `updated_at`) VALUES
('2208275', 'kk@example.com', 'King Kim Loong', 'Faculty of Computer Science', 'Information Technology (DFT)', 2, 2, 2, '2025-03-24 19:37:44', '2025-03-24 19:37:44'),
('2208564', 'chris@example.com', 'Chris Tan', 'Faculty of Computer Science', 'Information Security (RIS)', 2, 2, 1, '2025-03-24 19:37:44', '2025-03-24 19:37:44'),
('2209824', 'jx@example.com', 'Lee Jia Xin', 'Faculty of Computer Science', 'Computer Science (DSC)', 1, 1, 5, '2025-03-24 19:37:44', '2025-03-24 19:37:44'),
('2245872', 'kz@example.com', 'Tan Kai Tze', 'Faculty of Computer Science', 'Information Security (RIS)', 2, 2, 1, NULL, NULL),
('2258974', 'joanne@example.com', 'Joanne', 'Faculty of Computer Science', 'Information Security (RIS)', 2, 2, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3305682', 'Mliss@example.com', 'Melissa', 'Faculty of Engineering', 'Mechanical Engineering (RME)', 1, 3, 2, '2025-03-24 19:37:44', '2025-03-24 19:37:44'),
('3309824', 'janesmith@example.com', 'Jane Smith', 'Faculty of Business', 'Business Administration (RBA)', 1, 1, 1, '2025-03-24 19:37:44', '2025-03-24 19:37:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_student_courseid_foreign` (`courseID`),
  ADD KEY `course_student_studid_foreign` (`studID`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_studid_foreign` (`studID`),
  ADD KEY `exam_courseid_foreign` (`courseID`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecID`),
  ADD UNIQUE KEY `lecturers_lecemail_unique` (`lecEmail`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studID`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_student`
--
ALTER TABLE `course_student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_courseid_foreign` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_student_studid_foreign` FOREIGN KEY (`studID`) REFERENCES `students` (`studID`) ON DELETE CASCADE;

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_courseid_foreign` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE,
  ADD CONSTRAINT `exam_studid_foreign` FOREIGN KEY (`studID`) REFERENCES `students` (`studID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
