-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 09:06 AM
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
-- Database: `eduflex2`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `absence_id` int(11) NOT NULL,
  `student_id` varchar(10) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('general','academic','event','emergency','sports') NOT NULL,
  `content` text NOT NULL,
  `target_audience` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `totalViews` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `type`, `content`, `target_audience`, `date`, `time`, `created_at`, `updated_at`, `created_by`, `totalViews`) VALUES
(4, 'Exam Schedule', 'event', 'exaaaam', 'students,non-academic staff', '2025-04-24', '23:10:00', '2025-04-21 17:37:47', '2025-04-21 17:37:47', 5, 0),
(7, 'Sports Day', 'sports', 'Annual sports day event.', 'students,teachers,vice-principals', '2025-05-10', '00:00:00', '2025-04-21 18:31:32', '2025-04-24 06:43:21', 5, 0),
(8, 'Fire Drill', 'emergency', 'Fire drill will be conducted tomorrow.', 'teachers', '2025-05-02', '07:00:00', '2025-04-21 18:31:32', '2025-04-22 04:46:03', 5, 0),
(9, 'Staff Meeting', 'general', 'Monthly staff meeting in the conference hall.', 'teachers,non-academic staff,vice-principals', '2025-05-03', '15:00:00', '2025-04-21 18:31:32', '2025-04-22 04:46:18', 5, 0),
(10, 'PTA Meeting', 'event', 'PTA meeting with parents.', 'teachers,parents,vice-principals', '2025-05-04', '10:30:00', '2025-04-21 18:31:32', '2025-04-22 04:46:28', 5, 0),
(11, 'Library Week', 'academic', 'Library week celebration with various activities.', 'students', '2025-05-08', '09:30:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(12, 'Blood Donation Camp', 'event', 'Join the blood donation drive.', 'students,teachers,parents,non-academic staff', '2025-05-11', '12:00:00', '2025-04-21 18:31:32', '2025-04-22 04:46:40', 5, 0),
(13, 'Power Outage', 'emergency', 'Power cut scheduled during lunch.', 'non-academic staff', '2025-05-29', '22:00:00', '2025-04-21 18:31:32', '2025-04-21 19:23:25', 5, 0),
(14, 'Field Trip', 'event', 'Grade 10 field trip to the museum.', 'students,teachers', '2025-05-07', '07:30:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(15, 'Lab Renovation', 'general', 'Science lab will be under renovation.', 'teachers', '2025-05-05', '14:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(16, 'Exam Results', 'academic', 'Mid-term exam results released.', 'students,parents', '2025-05-12', '16:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(17, 'Cricket Tournament', 'sports', 'Inter-school cricket tournament.', 'students', '2025-05-13', '08:30:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(18, 'Health Checkup', 'event', 'Health checkup for all students.', 'students', '2025-05-14', '10:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(19, 'Cyclone Alert', 'emergency', 'Stay indoors during the cyclone warning.', 'students,teachers,parents,non-academic staff,vice-principals', '2025-05-15', '18:00:00', '2025-04-21 18:31:32', '2025-04-22 03:51:43', 5, 0),
(20, 'Cultural Day', 'event', 'Cultural day celebration with performances.', 'students,teachers', '2025-05-16', '10:45:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(21, 'New Admission', 'general', 'Admissions open for academic year 2025.', 'parents', '2025-05-17', '09:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(22, 'Guest Lecture', 'academic', 'Lecture on AI and robotics.', 'students', '2025-05-18', '11:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(23, 'Football Match', 'sports', 'Friendly football match with another school.', 'students', '2025-05-19', '15:30:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(24, 'Water Supply Issue', 'emergency', 'Limited water supply today.', 'non-academic staff', '2025-05-20', '07:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(25, 'Art Exhibition', 'event', 'Art exhibition in the main hall.', 'students,teachers', '2025-05-21', '14:00:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(26, 'Science Fair', 'academic', 'Annual science fair.', 'students', '2025-05-22', '09:45:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(27, 'Disaster Drill', 'emergency', 'Earthquake preparedness drill.', 'students,teachers', '2025-05-23', '13:15:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(28, 'Yoga Workshop', 'event', 'Morning yoga session for wellness.', 'teachers,non-academic staff', '2025-05-24', '06:30:00', '2025-04-21 18:31:32', '2025-04-21 18:31:32', 5, 0),
(29, 'Last Working Day', 'general', 'Last working day before vacation.', 'students,teachers,parents,non-academic staff,vice-principals', '2025-05-25', '14:00:00', '2025-04-21 18:31:32', '2025-04-22 03:51:08', 5, 0),
(30, 'announcement 01', 'emergency', 'Meeting at 4010', 'students,teachers,parents,non-academic staff', '2025-04-25', '00:23:00', '2025-04-22 03:53:31', '2025-04-24 06:43:08', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `backupusers`
--

CREATE TABLE `backupusers` (
  `backup_id` int(11) NOT NULL,
  `regNo` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobileNo` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `nameWithInitial` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `backupusers`
--

INSERT INTO `backupusers` (`backup_id`, `regNo`, `email`, `mobileNo`, `address`, `fullName`, `nameWithInitial`, `password`, `dob`, `gender`, `religion`, `role`, `deleted_at`) VALUES
(1, '62', 'dilsha@gmail.com', '0749835201', '4/50 Dilsh,\r\nGalle', 'Gamage Dilsha Hansani', 'Hansani G.D', '$2y$10$C9xizToM0FHh5smU95LL..nxyOt4B4PLnGvmXDMpblCUxO8.6ZPxu', '2000-08-15', 'Female', 'buddihsm', 'teacher', '2025-04-26 08:48:01'),
(2, '63', '', '', '', '', '', '$2y$10$1LNnLRhFKuuBYu13qM8MD.K8uEFxeLfOgQKItqH7eHpWp2SUYLNMq', '0000-00-00', '', '', '', '2025-04-26 11:44:33'),
(3, '64', '', '', '', '', '', '$2y$10$f330IGCpvinOnE6YquJose0vYFL0YADnp7GDyyssTvW.COJt86myq', '0000-00-00', '', '', '', '2025-04-26 11:58:08'),
(4, '56', 'saduuish@gmail.com', '0771120000', '400/D Saman,\r\nKatuwana.', 'Wasanta Kasun Yapa', 'Yapa W.Kscc', '$2y$10$oVInNjzicsNOAHVPx3YKfOQbjQj3Mzie22PPO/2z46EAyd.57ueMq', '2025-04-17', 'Male', 'serser', 'student', '2025-04-26 21:20:51'),
(5, '55', 'yapask345@gmail.com', '0711777118', '70/K Main road\r\nColombo.', 'Sunil kumara Yapa', 'Yapa S.Ktt', '$2y$10$xHufL2qYUI2DQdsUePcYkeZPD3TWw8q05fi/a.BrYz/shivLMGOZi', '1980-05-11', 'Female', 'buddihsm', 'parent', '2025-04-26 21:41:01'),
(6, '201', 'asd@gmail.com', '0782485041', 'Dsf\r\ndb', 'agag Zdjk', 'zddd .kh', '$2y$10$OkbJ3snA8mGl2NuyGMjmX.1cwuhLL0Xnrg4a7Gv/1HaBhDjqASF3a', '2025-04-21', 'Male', 'Buddhism', 'teacher', '2025-04-27 14:11:51'),
(7, '201', 'asd@gmail.com', '0782485041', 'Dsf\r\ndb', 'agag Zdjk', 'zddd .kh', '$2y$10$OkbJ3snA8mGl2NuyGMjmX.1cwuhLL0Xnrg4a7Gv/1HaBhDjqASF3a', '2025-04-21', 'Male', 'Buddhism', 'teacher', '2025-04-27 15:10:09'),
(8, '201', 'asd@gmail.com', '0782485041', 'Dsf\r\ndb', 'agag Zdjk', 'zddd .kh', '$2y$10$OkbJ3snA8mGl2NuyGMjmX.1cwuhLL0Xnrg4a7Gv/1HaBhDjqASF3a', '2025-04-21', 'Male', 'Buddhism', 'teacher', '2025-04-27 15:10:17'),
(9, '201', 'asd@gmail.com', '0782485041', 'Dsf\r\ndb', 'agag Zdjk', 'zddd .kh', '$2y$10$OkbJ3snA8mGl2NuyGMjmX.1cwuhLL0Xnrg4a7Gv/1HaBhDjqASF3a', '2025-04-21', 'Male', 'Buddhism', 'teacher', '2025-04-27 15:14:00'),
(10, '201', 'asd@gmail.com', '0782485041', 'Dsf\r\ndb', 'agag Zdjk', 'zddd .kh', '$2y$10$OkbJ3snA8mGl2NuyGMjmX.1cwuhLL0Xnrg4a7Gv/1HaBhDjqASF3a', '2025-04-21', 'Male', 'Buddhism', 'teacher', '2025-04-27 15:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `character_allocated_time`
--

CREATE TABLE `character_allocated_time` (
  `allocated_id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `certificate_id` varchar(50) NOT NULL,
  `time_slot` enum('8:00 AM - 9:00 AM','9:00 AM - 10:00 AM','10:00 AM - 11:00 AM','11:00 AM - 12:00 PM') NOT NULL,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `character_certificates`
--

CREATE TABLE `character_certificates` (
  `certificate_id` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `slip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classId` int(11) NOT NULL,
  `className` varchar(50) NOT NULL,
  `academicYear` varchar(20) NOT NULL DEFAULT '2024-2025'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classId`, `className`, `academicYear`) VALUES
(1, 'Grade 6-A', '2024-2025'),
(2, 'Grade 6-B', '2024-2025'),
(3, 'Grade 6-C', '2024-2025'),
(4, 'Grade 6-D', '2024-2025'),
(5, 'Grade 6-E', '2024-2025'),
(6, 'Grade 7-A', '2024-2025'),
(7, 'Grade 7-B', '2024-2025'),
(8, 'Grade 7-C', '2024-2025'),
(9, 'Grade 7-D', '2024-2025'),
(10, 'Grade 7-E', '2024-2025'),
(11, 'Grade 8-A', '2024-2025'),
(12, 'Grade 8-B', '2024-2025'),
(13, 'Grade 8-C', '2024-2025'),
(14, 'Grade 8-D', '2024-2025'),
(15, 'Grade 8-E', '2024-2025'),
(16, 'Grade 9-A', '2024-2025'),
(17, 'Grade 9-B', '2024-2025'),
(18, 'Grade 9-C', '2024-2025'),
(19, 'Grade 9-D', '2024-2025'),
(20, 'Grade 9-E', '2024-2025'),
(21, 'Grade 10-A', '2024-2025'),
(22, 'Grade 10-B', '2024-2025'),
(23, 'Grade 10-C', '2024-2025'),
(24, 'Grade 10-D', '2024-2025'),
(25, 'Grade 10-E', '2024-2025'),
(26, 'Grade 11-A', '2024-2025'),
(27, 'Grade 11-B', '2024-2025'),
(28, 'Grade 11-C', '2024-2025'),
(29, 'Grade 11-D', '2024-2025'),
(30, 'Grade 11-E', '2024-2025');

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher`
--

CREATE TABLE `class_teacher` (
  `classId` int(11) NOT NULL,
  `teacher_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_teacher`
--

INSERT INTO `class_teacher` (`classId`, `teacher_id`) VALUES
(26, 'T003'),
(27, 'T004'),
(16, 'T005'),
(17, 'T006'),
(2, 'T008'),
(3, 'T009'),
(4, 'T010'),
(5, 'T011'),
(6, 'T012'),
(7, 'T013'),
(8, 'T014'),
(9, 'T015'),
(10, 'T016'),
(11, 'T017'),
(12, 'T018'),
(13, 'T019'),
(14, 'T020'),
(15, 'T021'),
(18, 'T022'),
(19, 'T023'),
(20, 'T024'),
(23, 'T025'),
(24, 'T026'),
(25, 'T027'),
(28, 'T028'),
(29, 'T029'),
(30, 'T030'),
(1, 'T031');

-- --------------------------------------------------------

--
-- Table structure for table `class_teacher_backup`
--

CREATE TABLE `class_teacher_backup` (
  `classId` int(11) NOT NULL,
  `teacher_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_teacher_backup`
--

INSERT INTO `class_teacher_backup` (`classId`, `teacher_id`) VALUES
(1, 'T007'),
(2, 'T008'),
(3, 'T009'),
(4, 'T010'),
(5, 'T011'),
(6, 'T012'),
(7, 'T013'),
(8, 'T014'),
(9, 'T015'),
(10, 'T016'),
(11, 'T017'),
(12, 'T018'),
(13, 'T019'),
(14, 'T020'),
(15, 'T021'),
(16, 'T005'),
(17, 'T006'),
(18, 'T022'),
(19, 'T023'),
(20, 'T024'),
(21, 'T001'),
(22, 'T002'),
(23, 'T025'),
(24, 'T026'),
(25, 'T027'),
(26, 'T003'),
(27, 'T004'),
(28, 'T028'),
(29, 'T029'),
(30, 'T030');

-- --------------------------------------------------------

--
-- Table structure for table `current_activity`
--

CREATE TABLE `current_activity` (
  `activity_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `period` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `class` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `additional_note` text DEFAULT NULL,
  `village` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_activity`
--

INSERT INTO `current_activity` (`activity_id`, `teacher_id`, `date`, `period`, `subject`, `class`, `description`, `additional_note`, `village`) VALUES
(7, 2, '2025-04-25', '1', 'History', '4', 'gdzgdfzghdt', '', ''),
(8, 2, '2025-04-25', '2', 'History', '2', 'mhgj', '', 'jffuy'),
(9, 2, '2025-04-25', '3', 'History', '4', 'drar', '', 'esteyatyate');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `EventStartDateTime` datetime NOT NULL,
  `EventType` enum('sports','academic','cultural','exhibition') NOT NULL,
  `Venue` varchar(255) NOT NULL,
  `TargetAudienceStudents` tinyint(1) NOT NULL DEFAULT 0,
  `TargetAudienceTeachers` tinyint(1) NOT NULL DEFAULT 0,
  `TargetAudienceParents` tinyint(1) NOT NULL DEFAULT 0,
  `TargetAudienceNonAcademicStaff` tinyint(1) NOT NULL DEFAULT 0,
  `Description` text DEFAULT NULL,
  `EventCoordinators` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `EventStartDateTime`, `EventType`, `Venue`, `TargetAudienceStudents`, `TargetAudienceTeachers`, `TargetAudienceParents`, `TargetAudienceNonAcademicStaff`, `Description`, `EventCoordinators`) VALUES
(1, 'rgt', '2025-04-30 11:57:00', 'academic', 'tr', 0, 0, 1, 0, 'tt', 't'),
(2, 'c', '2025-05-01 11:58:00', 'exhibition', 'c', 0, 0, 1, 0, 'ds', 's'),
(3, 'c', '2025-05-01 11:58:00', 'exhibition', 'c', 0, 0, 1, 0, 'ds', 's');

-- --------------------------------------------------------

--
-- Table structure for table `facility_charges`
--

CREATE TABLE `facility_charges` (
  `payment_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `year_of_payment` year(4) NOT NULL,
  `payment_slip` varchar(255) DEFAULT NULL,
  `status` enum('successful','unsuccessful','not status') NOT NULL DEFAULT 'not status'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility_charges`
--

INSERT INTO `facility_charges` (`payment_id`, `full_name`, `student_id`, `year_of_payment`, `payment_slip`, `status`) VALUES
(46415388, 'W.Dilan', 'S0001', '2024', '680f06fed60ea_473108968_584553114333887_3831038171100151756_n.jpg', 'not status'),
(2147483647, 'Amali', 'S0002', '2025', '680f07540a30c_56.jpg', 'not status');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `recipient` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parentRegNo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaving_allocated_time`
--

CREATE TABLE `leaving_allocated_time` (
  `allocated_id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `certificate_id` int(11) NOT NULL,
  `time_slot` enum('8:00 AM - 9:00 AM','9:00 AM - 10:00 AM','10:00 AM - 11:00 AM','11:00 AM - 12:00 PM') NOT NULL,
  `day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaving_certificates`
--

CREATE TABLE `leaving_certificates` (
  `certificate_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Admission_date` date DEFAULT NULL,
  `Reason` varchar(255) DEFAULT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `classId` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `marks` decimal(5,2) NOT NULL CHECK (`marks` >= 0 and `marks` <= 100),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_id`, `classId`, `subject_id`, `term`, `marks`, `created_at`, `year`) VALUES
(32, 'S0060', 1, 1, 1, 23.00, '2025-04-28 02:35:40', 2025),
(33, 'S0060', 1, 2, 1, 45.00, '2025-04-28 02:35:40', 2025),
(34, 'S0060', 1, 3, 1, 56.00, '2025-04-28 02:35:40', 2025),
(35, 'S0060', 1, 4, 1, 78.00, '2025-04-28 02:35:40', 2025),
(36, 'S0060', 1, 10, 1, 89.00, '2025-04-28 02:35:40', 2025),
(37, 'S0060', 1, 5, 1, 88.00, '2025-04-28 02:35:40', 2025),
(38, 'S0060', 1, 9, 1, 55.00, '2025-04-28 02:35:40', 2025),
(39, 'S0060', 1, 6, 1, 44.00, '2025-04-28 02:35:40', 2025),
(40, 'S0060', 1, 7, 1, 78.00, '2025-04-28 02:35:40', 2025),
(41, 'S0060', 1, 8, 1, 77.00, '2025-04-28 02:35:40', 2025),
(42, 'S0055', 1, 1, 1, 45.00, '2025-04-28 02:35:40', 2025),
(43, 'S0055', 1, 2, 1, 78.00, '2025-04-28 02:35:40', 2025),
(44, 'S0055', 1, 3, 1, 90.00, '2025-04-28 02:35:40', 2025),
(45, 'S0055', 1, 4, 1, 55.00, '2025-04-28 02:35:40', 2025),
(46, 'S0055', 1, 10, 1, 44.00, '2025-04-28 02:35:40', 2025),
(47, 'S0055', 1, 5, 1, 33.00, '2025-04-28 02:35:40', 2025),
(48, 'S0055', 1, 9, 1, 67.00, '2025-04-28 02:35:40', 2025),
(49, 'S0055', 1, 6, 1, 78.00, '2025-04-28 02:35:40', 2025),
(50, 'S0055', 1, 7, 1, 88.00, '2025-04-28 02:35:40', 2025),
(51, 'S0055', 1, 8, 1, 45.00, '2025-04-28 02:35:40', 2025),
(52, 'S0054', 1, 1, 1, 45.00, '2025-04-28 02:35:40', 2025),
(53, 'S0054', 1, 2, 1, 67.00, '2025-04-28 02:35:40', 2025),
(54, 'S0054', 1, 3, 1, 78.00, '2025-04-28 02:35:40', 2025),
(55, 'S0054', 1, 4, 1, 89.00, '2025-04-28 02:35:40', 2025),
(56, 'S0054', 1, 10, 1, 66.00, '2025-04-28 02:35:40', 2025),
(57, 'S0054', 1, 5, 1, 77.00, '2025-04-28 02:35:40', 2025),
(58, 'S0054', 1, 9, 1, 77.00, '2025-04-28 02:35:40', 2025),
(59, 'S0054', 1, 6, 1, 88.00, '2025-04-28 02:35:40', 2025),
(60, 'S0054', 1, 7, 1, 56.00, '2025-04-28 02:35:40', 2025),
(61, 'S0054', 1, 8, 1, 98.00, '2025-04-28 02:35:40', 2025),
(62, 'S0053', 1, 1, 1, 55.00, '2025-04-28 02:35:40', 2025),
(63, 'S0053', 1, 2, 1, 67.00, '2025-04-28 02:35:40', 2025),
(64, 'S0053', 1, 3, 1, 78.00, '2025-04-28 02:35:40', 2025),
(65, 'S0053', 1, 4, 1, 89.00, '2025-04-28 02:35:40', 2025),
(66, 'S0053', 1, 10, 1, 67.00, '2025-04-28 02:35:40', 2025),
(67, 'S0053', 1, 5, 1, 67.00, '2025-04-28 02:35:40', 2025),
(68, 'S0053', 1, 9, 1, 78.00, '2025-04-28 02:35:40', 2025),
(69, 'S0053', 1, 6, 1, 56.00, '2025-04-28 02:35:40', 2025),
(70, 'S0053', 1, 7, 1, 78.00, '2025-04-28 02:35:40', 2025),
(71, 'S0053', 1, 8, 1, 78.00, '2025-04-28 02:35:40', 2025),
(72, 'S0052', 1, 1, 1, 89.00, '2025-04-28 02:35:40', 2025),
(73, 'S0052', 1, 2, 1, 56.00, '2025-04-28 02:35:40', 2025),
(74, 'S0052', 1, 3, 1, 68.00, '2025-04-28 02:35:40', 2025),
(75, 'S0052', 1, 4, 1, 88.00, '2025-04-28 02:35:40', 2025),
(76, 'S0052', 1, 10, 1, 55.00, '2025-04-28 02:35:40', 2025),
(77, 'S0052', 1, 5, 1, 77.00, '2025-04-28 02:35:40', 2025),
(78, 'S0052', 1, 9, 1, 77.00, '2025-04-28 02:35:40', 2025),
(79, 'S0052', 1, 6, 1, 44.00, '2025-04-28 02:35:40', 2025),
(80, 'S0052', 1, 7, 1, 77.00, '2025-04-28 02:35:40', 2025),
(81, 'S0052', 1, 8, 1, 99.00, '2025-04-28 02:35:40', 2025),
(82, 'S0027', 1, 1, 1, 100.00, '2025-04-28 02:35:40', 2025),
(83, 'S0027', 1, 2, 1, 56.00, '2025-04-28 02:35:40', 2025),
(84, 'S0027', 1, 3, 1, 88.00, '2025-04-28 02:35:40', 2025),
(85, 'S0027', 1, 4, 1, 77.00, '2025-04-28 02:35:40', 2025),
(86, 'S0027', 1, 10, 1, 98.00, '2025-04-28 02:35:40', 2025),
(87, 'S0027', 1, 5, 1, 67.00, '2025-04-28 02:35:40', 2025),
(88, 'S0027', 1, 9, 1, 88.00, '2025-04-28 02:35:40', 2025),
(89, 'S0027', 1, 6, 1, 88.00, '2025-04-28 02:35:40', 2025),
(90, 'S0027', 1, 7, 1, 89.00, '2025-04-28 02:35:40', 2025),
(91, 'S0027', 1, 8, 1, 55.00, '2025-04-28 02:35:40', 2025),
(92, 'S0002', 1, 1, 1, 56.00, '2025-04-28 02:35:40', 2025),
(93, 'S0002', 1, 2, 1, 88.00, '2025-04-28 02:35:40', 2025),
(94, 'S0002', 1, 3, 1, 89.00, '2025-04-28 02:35:40', 2025),
(95, 'S0002', 1, 4, 1, 77.00, '2025-04-28 02:35:40', 2025),
(96, 'S0002', 1, 10, 1, 88.00, '2025-04-28 02:35:40', 2025),
(97, 'S0002', 1, 5, 1, 99.00, '2025-04-28 02:35:40', 2025),
(98, 'S0002', 1, 9, 1, 66.00, '2025-04-28 02:35:41', 2025),
(99, 'S0002', 1, 6, 1, 77.00, '2025-04-28 02:35:41', 2025),
(100, 'S0002', 1, 7, 1, 77.00, '2025-04-28 02:35:41', 2025),
(101, 'S0002', 1, 8, 1, 77.00, '2025-04-28 02:35:41', 2025),
(102, 'S0001', 1, 1, 1, 55.00, '2025-04-28 02:35:41', 2025),
(103, 'S0001', 1, 2, 1, 77.00, '2025-04-28 02:35:41', 2025),
(104, 'S0001', 1, 3, 1, 78.00, '2025-04-28 02:35:41', 2025),
(105, 'S0001', 1, 4, 1, 67.00, '2025-04-28 02:35:41', 2025),
(106, 'S0001', 1, 10, 1, 78.00, '2025-04-28 02:35:41', 2025),
(107, 'S0001', 1, 5, 1, 87.00, '2025-04-28 02:35:41', 2025),
(108, 'S0001', 1, 9, 1, 97.00, '2025-04-28 02:35:41', 2025),
(109, 'S0001', 1, 6, 1, 98.00, '2025-04-28 02:35:41', 2025),
(110, 'S0001', 1, 7, 1, 97.00, '2025-04-28 02:35:41', 2025),
(111, 'S0001', 1, 8, 1, 79.00, '2025-04-28 02:35:41', 2025);

-- --------------------------------------------------------

--
-- Table structure for table `nonacademicstaff`
--

CREATE TABLE `nonacademicstaff` (
  `staffId` int(11) NOT NULL,
  `regNo` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `hireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nonacademicstaff`
--

INSERT INTO `nonacademicstaff` (`staffId`, `regNo`, `position`, `hireDate`) VALUES
(4, 6, 'Office Assistant', '2015-06-15'),
(5, 11, 'Librarian', '2018-09-10'),
(6, 12, 'IT Support', '2020-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `regNo` int(11) NOT NULL,
  `occupation` varchar(100) NOT NULL DEFAULT 'Not Specified',
  `relationship` enum('Father','Mother','Guardian') NOT NULL DEFAULT 'Guardian',
  `NIC` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`regNo`, `occupation`, `relationship`, `NIC`) VALUES
(114, 'Engineer', 'Father', NULL),
(115, 'Teacher', 'Mother', NULL),
(116, 'Businessman', 'Father', NULL),
(117, 'Accountant', 'Mother', NULL),
(118, 'Doctor', 'Father', NULL),
(119, 'Nurse', 'Mother', NULL),
(120, 'Lawyer', 'Father', NULL),
(121, 'Clerk', 'Mother', NULL),
(122, 'Manager', 'Father', NULL),
(123, 'Shop Owner', 'Mother', NULL),
(124, 'Mechanic', 'Father', NULL),
(125, 'Librarian', 'Mother', NULL),
(126, 'Farmer', 'Father', NULL),
(127, 'Receptionist', 'Mother', NULL),
(128, 'Architect', 'Father', NULL),
(129, 'Bank Officer', 'Mother', NULL),
(130, 'Driver', 'Father', NULL),
(131, 'Tailor', 'Mother', NULL),
(132, 'Salesman', 'Father', NULL),
(133, 'Consultant', 'Mother', NULL),
(134, 'Civil Servant', 'Father', NULL),
(135, 'Graphic Designer', 'Mother', NULL),
(136, 'Pharmacist', 'Father', NULL),
(137, 'Marketing Manager', 'Mother', NULL),
(138, 'Technician', 'Father', NULL),
(139, 'Secretary', 'Mother', NULL),
(140, 'Contractor', 'Father', NULL),
(141, 'HR Officer', 'Mother', NULL),
(142, 'Electrician', 'Father', NULL),
(143, 'Counsellor', 'Mother', NULL),
(144, 'Software Engineer', 'Father', NULL),
(145, 'Beautician', 'Mother', NULL),
(146, 'Surveyor', 'Father', NULL),
(147, 'Event Planner', 'Mother', NULL),
(148, 'Carpenter', 'Father', NULL),
(149, 'Jeweller', 'Mother', NULL),
(150, 'Fisherman', 'Father', NULL),
(151, 'Baker', 'Mother', NULL),
(152, 'Security Officer', 'Father', NULL),
(153, 'Insurance Agent', 'Mother', NULL),
(154, 'Plantation Manager', 'Father', NULL),
(155, 'Travel Agent', 'Mother', NULL),
(156, 'Mason', 'Father', NULL),
(157, 'Florist', 'Mother', NULL),
(158, 'Auditor', 'Father', NULL),
(159, 'Caterer', 'Mother', NULL),
(160, 'Photographer', 'Father', NULL),
(161, 'Social Worker', 'Mother', NULL),
(162, 'Retailer', 'Father', NULL),
(163, 'Dietitian', 'Mother', NULL),
(164, 'Agriculturist', 'Father', NULL),
(165, 'Lecturer', 'Mother', NULL),
(166, 'Logistics Manager', 'Father', NULL),
(167, 'Translator', 'Mother', NULL),
(168, 'Data Analyst', 'Mother', NULL),
(169, 'Hotel Manager', 'Father', NULL),
(170, 'Fashion Designer', 'Mother', NULL),
(171, 'Plumber', 'Father', NULL),
(172, 'Editor', 'Mother', NULL),
(173, 'Therapist', 'Mother', NULL),
(175, 'Engineer', 'Mother', NULL),
(177, 'Doctor', 'Father', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parent_students`
--

CREATE TABLE `parent_students` (
  `parentRegNo` int(11) NOT NULL,
  `studentRegNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent_students`
--

INSERT INTO `parent_students` (`parentRegNo`, `studentRegNo`) VALUES
(114, 54),
(114, 178);

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `periodId` int(11) NOT NULL,
  `periodName` varchar(20) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`periodId`, `periodName`, `startTime`, `endTime`) VALUES
(1, 'Period 1', '08:00:00', '08:40:00'),
(2, 'Period 2', '08:40:00', '09:10:00'),
(3, 'Period 3', '09:10:00', '09:50:00'),
(4, 'Period 4', '09:50:00', '10:30:00'),
(5, 'Period 5', '11:00:00', '11:40:00'),
(6, 'Period 6', '11:40:00', '12:10:00'),
(7, 'Period 7', '12:10:00', '12:50:00'),
(8, 'Period 8', '12:50:00', '13:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `principals`
--

CREATE TABLE `principals` (
  `principalId` int(11) NOT NULL,
  `regNo` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `hireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(10) NOT NULL,
  `regNo` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `classId` int(11) NOT NULL,
  `guardianRegNo` int(11) DEFAULT NULL,
  `dateOfAdmission` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `regNo`, `firstName`, `lastName`, `classId`, `guardianRegNo`, `dateOfAdmission`) VALUES
('S0001', 54, 'Dilan', 'Wijesekera', 1, 114, '2025-04-11'),
('S0002', 55, 'Amaya', 'Senarath', 1, 115, '2025-04-11'),
('S0003', 56, 'Tharindu', 'Gamage', 2, 116, '2025-04-11'),
('S0004', 57, 'Nethmi', 'Rathnayake', 2, 117, '2025-04-11'),
('S0005', 58, 'Sajith', 'Mendis', 3, 118, '2025-04-11'),
('S0006', 84, 'Keshan', 'Siriwardena', 3, 119, '2025-04-11'),
('S0007', 90, 'Amal', 'Wickramasinghe', 4, 120, '2025-04-11'),
('S0008', 91, 'Nayana', 'Ekanayaka', 4, 121, '2025-04-11'),
('S0009', 92, 'Sithum', 'Kalubowila', 5, 122, '2025-04-11'),
('S0010', 93, 'Dinithi', 'Senadheera', 5, 123, '2025-04-11'),
('S0011', 59, 'Kavisha', 'Hettiarachchi', 6, 124, '2025-04-11'),
('S0012', 60, 'Yasith', 'Kodagoda', 6, 125, '2025-04-11'),
('S0013', 61, 'Sanduni', 'Lakmal', 7, 126, '2025-04-11'),
('S0014', 62, 'Nipun', 'Edirisinghe', 7, 127, '2025-04-11'),
('S0015', 63, 'Ishara', 'Munasinghe', 8, 128, '2025-04-11'),
('S0016', 85, 'Tharini', 'Gunasekara', 8, 129, '2025-04-11'),
('S0017', 94, 'Isuru', 'Bandaranayake', 9, 130, '2025-04-11'),
('S0018', 95, 'Sachika', 'Dewapriya', 9, 131, '2025-04-11'),
('S0019', 96, 'Tharusha', 'Jayakody', 10, 132, '2025-04-11'),
('S0020', 97, 'Hasini', 'Mahawela', 10, 133, '2025-04-11'),
('S0021', 64, 'Vishal', 'De Alwis', 11, 134, '2025-04-11'),
('S0022', 65, 'Thilanka', 'Kumara', 11, 135, '2025-04-11'),
('S0023', 66, 'Randima', 'Salgado', 12, 136, '2025-04-11'),
('S0024', 67, 'Kasun', 'Wickramaratne', 12, 137, '2025-04-11'),
('S0025', 68, 'Navod', 'Karunaratne', 13, 138, '2025-04-11'),
('S0026', 86, 'Vidura', 'Liyanage', 13, 139, '2025-04-11'),
('S0027', 98, 'Ravindu', 'Kotagama', 14, 140, '2025-04-11'),
('S0028', 99, 'Menuka', 'Wijesooriya', 14, 141, '2025-04-11'),
('S0029', 100, 'Dulanja', 'Samarajeewa', 15, 142, '2025-04-11'),
('S0030', 101, 'Ashinsana', 'Mudannayake', 15, 143, '2025-04-11'),
('S0031', 69, 'Anuki', 'Peiris', 16, 144, '2025-04-11'),
('S0032', 70, 'Dinuka', 'Sooriyarachchi', 16, 145, '2025-04-11'),
('S0033', 71, 'Malithi', 'Wijemanne', 17, 146, '2025-04-11'),
('S0034', 72, 'Ruvin', 'Athukorala', 17, 147, '2025-04-11'),
('S0035', 73, 'Sachini', 'Madushanka', 18, 148, '2025-04-11'),
('S0036', 87, 'Sanuja', 'Kodithuwakku', 18, 149, '2025-04-11'),
('S0037', 102, 'Yasiru', 'Gunathilaka', 19, 150, '2025-04-11'),
('S0038', 103, 'Nipuni', 'Abeykoon', 19, 151, '2025-04-11'),
('S0039', 104, 'Sankha', 'Rupasinghe', 20, 152, '2025-04-11'),
('S0040', 105, 'Thiloka', 'Wijethunga', 20, 153, '2025-04-11'),
('S0041', 74, 'Lahiru', 'Gunarathna', 21, 154, '2025-04-11'),
('S0042', 75, 'Oshadi', 'Wimalaratne', 21, 155, '2025-04-11'),
('S0043', 76, 'Danushka', 'Jayatissa', 22, 156, '2025-04-11'),
('S0044', 77, 'Vindya', 'Samarakoon', 22, 157, '2025-04-11'),
('S0045', 78, 'Tharaka', 'Lakshitha', 23, 158, '2025-04-11'),
('S0046', 88, 'Dimuthu', 'Ranasinghe', 23, 159, '2025-04-11'),
('S0047', 106, 'Dinal', 'Amarakoon', 24, 160, '2025-04-11'),
('S0048', 107, 'Kumudu', 'Wimalasena', 24, 161, '2025-04-11'),
('S0049', 108, 'Navindu', 'Desilva', 25, 162, '2025-04-11'),
('S0050', 109, 'Rashmi', 'Wijegunawardana', 25, 163, '2025-04-11'),
('S0051', 79, 'Nethushi', 'Wijesundara', 26, 164, '2025-04-11'),
('S0052', 80, 'Sankalpa', 'Herath', 26, 165, '2025-04-11'),
('S0053', 81, 'Dewmini', 'Bandara', 27, 166, '2025-04-11'),
('S0054', 82, 'Pramith', 'Vithanage', 27, 167, '2025-04-11'),
('S0055', 83, 'Chalani', 'Kulatunga', 28, 168, '2025-04-11'),
('S0056', 89, 'Yashodha', 'Weerasekara', 28, 169, '2025-04-11'),
('S0057', 110, 'Mihiru', 'Koswatta', 29, 170, '2025-04-11'),
('S0058', 111, 'Anura', 'Seneviratne', 29, 171, '2025-04-11'),
('S0059', 112, 'Chamath', 'Guruge', 30, 172, '2025-04-11'),
('S0060', 174, '', '', 1, 175, '2025-04-26'),
('S0061', 176, '', '', 2, 177, '2025-04-26'),
('S0062', 178, '', '', 3, 114, '2025-04-26');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `before_insert_student` BEFORE INSERT ON `students` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    SET next_id = (
        SELECT COALESCE(MAX(CAST(SUBSTRING(student_id, 2) AS UNSIGNED)), 0) + 1 
        FROM students
    );
    SET NEW.student_id = CONCAT('S', LPAD(next_id, 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `date`, `student_id`, `name`, `class`, `status`) VALUES
(5, '2024-12-21', 'S0001', 'John Doe', 'Grade 6-A', 'Present'),
(6, '2024-12-23', 'S0001', 'Jane Smith', 'Grade 6-A', 'Absent'),
(7, '2025-03-04', 'S0001', 'Michael Johnson', 'Grade 6-A', 'Present'),
(8, '2025-04-10', 'S0001', 'Emily Davis', 'Grade 6-A', 'Absent'),
(10, '2025-03-03', 'S0001', 'Jane Smith', 'Grade 6-A', 'Absent'),
(11, '2025-04-16', 'S0002', 'Michael Johnson', 'Grade 6-A', 'Present'),
(12, '2025-03-12', 'S0002', 'Emily Davis', 'Grade 6-A', 'Absent'),
(13, '2024-12-24', 'S0001', 'John Doe', 'Grade 7-A', 'Present'),
(14, '2025-04-15', 'S0002', 'Jane Smith', 'Grade 7-A', 'Absent'),
(15, '2025-03-19', 'S0002', 'Michael Johnson', 'Grade 7-A', 'Present'),
(16, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-A', 'Present'),
(17, '2024-12-24', 'S001', 'John Doe', 'Grade 7-A', 'Present'),
(18, '2024-12-24', 'S002', 'Jane Smith', 'Grade 7-A', 'Absent'),
(19, '2024-12-24', 'S003', 'Michael Johnson', 'Grade 7-A', 'Present'),
(20, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-A', 'Present'),
(21, '2025-04-23', 'S0001', 'John Doe', 'Grade 7-A', 'Present'),
(22, '2024-12-24', 'S002', 'Jane Smith', 'Grade 7-A', 'Absent'),
(23, '2024-12-24', 'S003', 'Michael Johnson', 'Grade 7-A', 'Present'),
(24, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-A', 'Present'),
(25, '2024-12-24', 'S001', 'John Doe', 'Grade 7-A', 'Present'),
(26, '2024-12-24', 'S002', 'Jane Smith', 'Grade 7-A', 'Absent'),
(27, '2024-12-24', 'S003', 'Michael Johnson', 'Grade 7-A', 'Present'),
(28, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-A', 'Present'),
(29, '2024-12-24', 'S001', 'John Doe', 'Grade 7-A', 'Present'),
(30, '2024-12-24', 'S002', 'Jane Smith', 'Grade 7-A', 'Present'),
(31, '2024-12-24', 'S003', 'Michael Johnson', 'Grade 7-A', 'Present'),
(32, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-A', 'Present'),
(33, '2024-12-24', 'S001', 'John Doe', 'Grade 7-B', 'Present'),
(34, '2024-12-24', 'S002', 'Jane Smith', 'Grade 7-B', 'Present'),
(35, '2024-12-24', 'S003', 'Michael Johnson', 'Grade 7-B', 'Present'),
(36, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-B', 'Present'),
(37, '2024-12-24', 'S001', 'John Doe', 'Grade 7-B', 'Present'),
(38, '2024-12-24', 'S002', 'Jane Smith', 'Grade 7-B', 'Present'),
(39, '2024-12-24', 'S003', 'Michael Johnson', 'Grade 7-B', 'Present'),
(40, '2024-12-24', 'S004', 'Emily Davis', 'Grade 7-B', 'Present'),
(41, '2024-12-25', 'S001', 'John Doe', 'Grade 7-B', 'Present'),
(42, '2024-12-25', 'S002', 'Jane Smith', 'Grade 7-B', 'Present'),
(43, '2024-12-25', 'S003', 'Michael Johnson', 'Grade 7-B', 'Absent'),
(44, '2024-12-25', 'S004', 'Emily Davis', 'Grade 7-B', 'Present'),
(45, '2024-12-25', 'S001', 'John Doe', 'Grade 7-B', 'Present'),
(46, '2024-12-25', 'S002', 'Jane Smith', 'Grade 7-B', 'Present'),
(47, '2024-12-25', 'S003', 'Michael Johnson', 'Grade 7-B', 'Absent'),
(48, '2024-12-25', 'S004', 'Emily Davis', 'Grade 7-B', 'Present'),
(49, '2024-12-27', 'S001', 'John Doe', 'Grade 7-B', 'Present'),
(50, '2024-12-27', 'S002', 'Jane Smith', 'Grade 7-B', 'Present'),
(51, '2024-12-27', 'S003', 'Michael Johnson', 'Grade 7-B', 'Absent'),
(52, '2024-12-27', 'S004', 'Emily Davis', 'Grade 7-B', 'Present'),
(53, '2025-01-16', 'S001', 'John Doe', 'Grade 6-A', 'Present'),
(54, '2025-01-16', 'S002', 'Jane Smith', 'Grade 6-A', 'Absent'),
(55, '2025-01-16', 'S003', 'Michael Johnson', 'Grade 6-A', 'Present'),
(56, '2025-01-16', 'S004', 'Emily Davis', 'Grade 6-A', 'Present'),
(57, '2025-02-12', 'S001', 'John Doe', 'Grade 6-B', 'Present'),
(58, '2025-02-12', 'S002', 'Jane Smith', 'Grade 6-B', 'Present'),
(59, '2025-02-12', 'S003', 'Michael Johnson', 'Grade 6-B', 'Absent'),
(60, '2025-02-12', 'S004', 'Emily Davis', 'Grade 6-B', 'Present'),
(61, '2025-02-12', 'S0001', 'John Doe', 'Grade 6-A', 'Present'),
(62, '2025-02-12', 'S002', 'Jane Smith', 'Grade 6-A', 'Absent'),
(63, '2025-02-12', 'S003', 'Michael Johnson', 'Grade 6-A', 'Present'),
(64, '2025-02-12', 'S004', 'Emily Davis', 'Grade 6-A', 'Absent'),
(65, '2025-02-28', 'S001', 'John Doe', 'Grade 6-A', 'Present'),
(66, '2025-02-28', 'S002', 'Jane Smith', 'Grade 6-A', 'Present'),
(67, '2025-02-28', 'S003', 'Michael Johnson', 'Grade 6-A', 'Present'),
(68, '2025-02-28', 'S004', 'Emily Davis', 'Grade 6-A', 'Present'),
(69, '2025-04-06', 'S001', 'John Doe', 'Grade 6-A', 'Present'),
(70, '2025-04-06', 'S002', 'Jane Smith', 'Grade 6-A', 'Present'),
(71, '2025-04-06', 'S003', 'Michael Johnson', 'Grade 6-A', 'Absent'),
(72, '2025-04-06', 'S004', 'Emily Davis', 'Grade 6-A', 'Present'),
(73, '2025-04-07', 'S003', NULL, '2', 'present'),
(74, '2025-04-07', 'S002', NULL, '1', 'present'),
(75, '2025-04-07', 'S001', NULL, '1', 'absent'),
(76, '2025-04-07', 'Bob', NULL, '1', 'Bob'),
(77, '2025-04-07', 'S002', NULL, '1', 'present'),
(78, '2025-04-07', 'Alice', NULL, '1', 'Alice'),
(79, '2025-04-07', 'S0001', NULL, '1', 'absent'),
(80, '2025-04-07', 'Bob', NULL, '1', 'Bob'),
(81, '2025-04-07', 'S002', NULL, '1', 'present'),
(82, '2025-04-07', 'Alice', NULL, '1', 'Alice'),
(83, '2025-04-07', 'S001', NULL, '1', 'absent'),
(84, '2025-04-07', 'S002', NULL, '1', 'absent'),
(85, '2025-04-07', 'S001', NULL, '1', 'absent'),
(86, '2025-04-07', 'S002', NULL, '1', 'absent'),
(87, '2025-04-07', 'S001', NULL, '1', 'absent'),
(88, '2025-04-07', 'S002', NULL, '1', 'absent'),
(89, '2025-04-07', 'S001', NULL, '1', 'absent'),
(90, '2025-04-07', 'S002', NULL, '1', 'absent'),
(91, '2025-04-07', 'S001', NULL, '1', 'absent'),
(92, '2025-04-07', 'S002', 'Bob', '1', 'absent'),
(93, '2025-04-07', 'S001', 'Alice', '1', 'absent'),
(94, '2025-04-07', 'S002', 'Bob', '1', 'absent'),
(95, '2025-04-07', 'S001', 'Alice', '1', 'present'),
(96, '2025-04-07', 'S002', 'Bob', '1', 'present'),
(97, '2025-04-07', 'S001', 'Alice', '1', 'absent'),
(98, '2025-04-08', 'S002', 'Bob', '1', 'present'),
(99, '2025-04-08', 'S001', 'Alice', '1', 'present'),
(100, '2025-04-08', 'S002', 'Bob', '1', 'present'),
(101, '2025-04-08', 'S0001', 'Alice', '1', 'present'),
(102, '2025-04-09', 'S0002', 'Bob', '1', 'present'),
(103, '2025-04-09', 'S001', 'Alice', '1', 'absent'),
(104, '2025-04-09', 'S002', 'Bob', '1', 'present'),
(105, '2025-03-09', 'S0001', 'Alice', '1', 'present'),
(106, '2025-04-10', 'S002', 'Bob', '1', 'present'),
(107, '2025-03-10', 'S0001', 'Alice', '1', 'present'),
(108, '2025-04-10', 'S002', 'Bob', '1', 'present'),
(109, '2025-04-10', 'S001', 'Alice', '1', 'absent'),
(110, '2025-04-10', 'S002', 'Bob', '1', 'present'),
(111, '2025-04-10', 'S001', 'Alice', '1', 'absent'),
(112, '2025-04-10', 'S002', 'Bob', '1', 'present'),
(113, '2025-04-10', 'S001', 'Alice', '1', 'absent'),
(114, '2025-04-13', 'S002', 'Bob', '1', 'present'),
(115, '2025-04-13', 'S001', 'Alice', '1', 'present'),
(116, '2025-04-19', 'S002', '<br />\n<b>Warning</b>:  Undefined property: stdClass::$lastName in <b>C:\\xampp\\htdocs\\EduFlex\\app\\views\\inc\\teacher\\attendance.php</b> on line <b>57</b><br />\nBob ', '1', 'present'),
(117, '2025-04-19', 'S0001', '<br />\r\n<b>Warning</b>:  Undefined property: stdClass::$lastName in <b>C:\\xampp\\htdocs\\EduFlex\\app\\views\\inc\\teacher\\attendance.php</b> on line <b>57</b><br />\r\nAlice ', '1', 'present'),
(118, '2025-04-19', 'S003', 'Charlie ', '2', 'present'),
(119, '2025-04-21', 'S002', 'Bob Marley', '1', 'present'),
(120, '2025-04-21', 'S001', 'Alice Martin', '1', 'absent'),
(121, '2025-04-21', 'S003', 'Charlie Chaplin', '2', 'present'),
(122, '2025-04-22', 'S002', 'Bob Marley', '1', 'present'),
(123, '2025-04-22', 'S001', 'Alice Martin', '1', 'absent'),
(124, '2025-04-23', 'S002', 'Bob Marley', '1', 'present'),
(125, '2025-04-23', 'S0001', 'Alice Martin', '1', 'present'),
(126, '2025-04-24', 'S002', 'Bob Marley', '1', 'present'),
(127, '2025-04-24', 'S0001', 'Alice Martin', '1', 'absent'),
(128, '2025-04-24', 'S004', 'Diana Princes', '3', 'present'),
(129, '2025-04-24', 'S003', 'Charlie Chaplin', '2', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectId` int(11) NOT NULL,
  `subjectName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectId`, `subjectName`) VALUES
(16, 'Art'),
(10, 'Buddhism'),
(11, 'Christianity'),
(8, 'Civic Education'),
(17, 'Dancing'),
(18, 'Drama'),
(15, 'Eastern Music'),
(3, 'English Language'),
(5, 'Geography'),
(9, 'Health & Physical Education'),
(13, 'Hinduism'),
(4, 'History'),
(12, 'Islam'),
(1, 'Mathematics'),
(2, 'Science'),
(6, 'Sinhala Language'),
(7, 'Tamil Language'),
(14, 'Western Music');

-- --------------------------------------------------------

--
-- Table structure for table `subject_class`
--

CREATE TABLE `subject_class` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_class`
--

INSERT INTO `subject_class` (`id`, `class_id`, `subject_id`) VALUES
(4, 1, 1),
(5, 1, 2),
(6, 1, 3),
(7, 1, 4),
(8, 2, 1),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 3, 1),
(13, 3, 2),
(14, 3, 3),
(15, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `teacherattendance`
--

CREATE TABLE `teacherattendance` (
  `attendanceId` int(11) NOT NULL,
  `teacherRegNo` varchar(10) DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent','On Leave') NOT NULL,
  `recordedBy` int(11) NOT NULL,
  `recordedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacherattendance`
--

INSERT INTO `teacherattendance` (`attendanceId`, `teacherRegNo`, `date`, `status`, `recordedBy`, `recordedAt`) VALUES
(9, 'T003', '2025-02-28', 'Present', 6, '2025-02-28 09:17:27'),
(12, 'T003', '2025-02-27', 'Present', 6, '2025-02-28 09:17:27'),
(19, 'T004', '2025-03-01', 'Present', 6, '2025-04-07 09:30:58'),
(20, 'T005', '2025-03-01', 'Present', 6, '2025-04-07 09:30:58'),
(21, 'T006', '2025-03-01', 'Present', 6, '2025-04-07 09:30:58'),
(24, 'T003', '2025-03-01', 'Absent', 6, '2025-04-07 09:30:58'),
(25, 'T007', '2025-03-02', 'Absent', 6, '2025-04-09 21:28:15'),
(26, 'T008', '2025-03-02', 'Absent', 6, '2025-04-09 21:28:15'),
(27, 'T009', '2025-03-02', 'Absent', 6, '2025-04-09 21:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `regNo` int(11) NOT NULL,
  `teacher_id` varchar(10) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `hireDate` date NOT NULL,
  `experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`regNo`, `teacher_id`, `firstName`, `lastName`, `hireDate`, `experience`) VALUES
(10, 'T003', 'Daniel', 'King', '2024-01-01', 1),
(14, 'T004', 'Kevin', 'Taylor', '2024-01-01', 5),
(15, 'T005', 'Nina', 'Thomas', '2024-01-01', 6),
(16, 'T006', 'Samuel', 'Fernando', '2024-01-01', 7),
(17, 'T007', 'Meera', 'Perera', '2024-01-01', 8),
(18, 'T008', 'Ravindu', 'Jayasinghe', '2024-01-01', 9),
(19, 'T009', 'Harsha', 'Abeywardena', '2024-01-01', 10),
(20, 'T010', 'Nadeesha', 'Wijeratne', '2024-01-01', 1),
(21, 'T011', 'Harsha', 'Pathirana', '2024-01-01', 2),
(22, 'T012', 'Thilini', 'Jayalath', '2024-01-01', 3),
(23, 'T013', 'Sanjaya', 'Rajapaksha', '2024-01-01', 4),
(24, 'T014', 'Dinesh', 'Samarasinghe', '2024-01-01', 5),
(25, 'T015', 'Ishara', 'Samarasinghe', '2024-01-01', 6),
(26, 'T016', 'Hashini', 'Jayawardena', '2024-01-01', 7),
(27, 'T017', 'Nadeesha', 'Pathirana', '2024-01-01', 8),
(28, 'T018', 'Pradeep', 'Jayalath', '2024-01-01', 9),
(29, 'T019', 'Hashini', 'Dissanayake', '2024-01-01', 10),
(30, 'T020', 'Kavindi', 'Nanayakkara', '2024-01-01', 1),
(31, 'T021', 'Malsha', 'Dissanayake', '2024-01-01', 2),
(32, 'T022', 'Isuru', 'Perera', '2024-01-01', 3),
(33, 'T023', 'Chamara', 'Dias', '2024-01-01', 4),
(34, 'T024', 'Sanjaya', 'Wijeratne', '2024-01-01', 5),
(35, 'T025', 'Harsha', 'Nanayakkara', '2024-01-01', 6),
(36, 'T026', 'Pavithra', 'Weerasinghe', '2024-01-01', 7),
(37, 'T027', 'Nimal', 'Kariyawasam', '2024-01-01', 8),
(38, 'T028', 'Sameera', 'Fernando', '2024-01-01', 9),
(39, 'T029', 'Nirosha', 'Herath', '2024-01-01', 10),
(40, 'T030', 'Madushanka', 'Kariyawasam', '2024-01-01', 1),
(41, 'T031', 'Harsha', 'Rajapaksha', '2024-01-01', 2),
(42, 'T032', 'Chamari', 'Silva', '2024-01-01', 3),
(2, 'T033', 'Jane', 'Doe', '2024-04-10', 4);

--
-- Triggers `teachers`
--
DELIMITER $$
CREATE TRIGGER `before_insert_teacher` BEFORE INSERT ON `teachers` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    SET next_id = (SELECT COALESCE(MAX(CAST(SUBSTRING(teacher_id, 2) AS UNSIGNED)), 0) + 1 FROM teachers);
    SET NEW.teacher_id = CONCAT('T', LPAD(next_id, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_specializations`
--

CREATE TABLE `teacher_specializations` (
  `regNo` varchar(10) NOT NULL,
  `subjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_specializations`
--

INSERT INTO `teacher_specializations` (`regNo`, `subjectId`) VALUES
('T003', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `teacherRegNo` varchar(10) NOT NULL,
  `subjectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`teacherRegNo`, `subjectId`) VALUES
('T003', 3),
('T003', 5),
('T004', 2),
('T005', 4),
('T006', 1),
('T007', 1),
('T008', 2),
('T009', 3),
('T010', 6),
('T011', 11),
('T012', 4),
('T013', 5),
('T014', 15),
('T015', 8),
('T016', 9),
('T017', 18),
('T018', 16),
('T019', 17),
('T033', 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `timetableId` int(11) NOT NULL,
  `classId` int(11) NOT NULL,
  `subjectId` int(11) NOT NULL,
  `teacherRegNo` varchar(10) DEFAULT NULL,
  `periodId` int(11) NOT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `roomNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`timetableId`, `classId`, `subjectId`, `teacherRegNo`, `periodId`, `day`, `roomNumber`) VALUES
(183, 1, 1, 'T007', 1, 'Monday', 'Room 101'),
(184, 1, 2, 'T008', 2, 'Monday', 'Room 101'),
(185, 1, 3, 'T009', 3, 'Monday', 'Room 101'),
(186, 1, 6, 'T010', 4, 'Monday', 'Room 101'),
(187, 1, 8, 'T015', 5, 'Monday', 'Room 101'),
(188, 1, 11, 'T011', 6, 'Monday', 'Room 101'),
(189, 1, 4, 'T012', 7, 'Monday', 'Room 101'),
(190, 1, 5, 'T013', 8, 'Monday', 'Room 101'),
(191, 1, 6, 'T010', 1, 'Tuesday', 'Room 101'),
(192, 1, 1, 'T007', 2, 'Tuesday', 'Room 101'),
(193, 1, 15, 'T014', 3, 'Tuesday', 'Room 201'),
(194, 1, 8, 'T015', 4, 'Tuesday', 'Room 101'),
(195, 1, 9, 'T016', 5, 'Tuesday', 'Playground'),
(196, 1, 3, 'T009', 6, 'Tuesday', 'Room 101'),
(197, 1, 16, 'T018', 7, 'Tuesday', 'Room 202'),
(198, 1, 2, 'T008', 8, 'Tuesday', 'Room 101'),
(199, 1, 2, 'T008', 1, 'Wednesday', 'Room 101'),
(200, 1, 3, 'T009', 2, 'Wednesday', 'Room 101'),
(201, 1, 1, 'T007', 3, 'Wednesday', 'Room 101'),
(202, 1, 4, 'T012', 4, 'Wednesday', 'Room 101'),
(203, 1, 11, 'T011', 5, 'Wednesday', 'Room 101'),
(204, 1, 18, 'T017', 6, 'Wednesday', 'Room 301'),
(205, 1, 8, 'T015', 7, 'Wednesday', 'Room 101'),
(206, 1, 6, 'T010', 8, 'Wednesday', 'Room 101'),
(207, 1, 1, 'T007', 1, 'Thursday', 'Room 101'),
(208, 1, 6, 'T010', 2, 'Thursday', 'Room 101'),
(209, 1, 5, 'T013', 3, 'Thursday', 'Room 101'),
(210, 1, 3, 'T009', 4, 'Thursday', 'Room 101'),
(211, 1, 17, 'T019', 5, 'Thursday', 'Room 303'),
(212, 1, 2, 'T008', 6, 'Thursday', 'Room 101'),
(213, 1, 9, 'T016', 7, 'Thursday', 'Playground'),
(214, 1, 16, 'T018', 8, 'Thursday', 'Room 202'),
(215, 1, 3, 'T009', 1, 'Friday', 'Room 101'),
(216, 1, 1, 'T007', 2, 'Friday', 'Room 101'),
(217, 1, 2, 'T008', 3, 'Friday', 'Room 101'),
(218, 1, 6, 'T010', 4, 'Friday', 'Room 101'),
(219, 1, 9, 'T016', 5, 'Friday', 'Playground'),
(220, 1, 4, 'T012', 6, 'Friday', 'Room 101'),
(221, 1, 5, 'T013', 7, 'Friday', 'Room 101'),
(222, 1, 11, 'T011', 8, 'Friday', 'Room 101'),
(256, 6, 1, 'T006', 1, 'Monday', 'Room 103'),
(257, 6, 2, 'T004', 2, 'Monday', 'Room 103'),
(258, 6, 3, 'T003', 3, 'Monday', 'Room 103'),
(259, 6, 4, 'T012', 5, 'Monday', 'Room 103'),
(260, 6, 5, 'T013', 6, 'Monday', 'Room 103'),
(261, 6, 9, 'T016', 8, 'Monday', 'Room 103'),
(262, 6, 2, 'T004', 1, 'Tuesday', 'Room 103'),
(263, 6, 1, 'T033', 2, 'Tuesday', 'Room 103'),
(264, 6, 3, 'T003', 4, 'Tuesday', 'Room 103'),
(265, 6, 16, 'T018', 5, 'Tuesday', 'Room 103'),
(266, 6, 17, 'T019', 7, 'Tuesday', 'Room 103'),
(267, 6, 18, 'T017', 8, 'Tuesday', 'Room 103'),
(268, 6, 3, 'T003', 1, 'Wednesday', 'Room 103'),
(269, 6, 1, 'T006', 2, 'Wednesday', 'Room 103'),
(270, 6, 2, 'T004', 3, 'Wednesday', 'Room 103'),
(271, 6, 5, 'T013', 4, 'Wednesday', 'Room 103'),
(272, 6, 4, 'T012', 5, 'Wednesday', 'Room 103'),
(273, 6, 6, 'T010', 6, 'Wednesday', 'Room 103'),
(274, 6, 1, 'T033', 1, 'Thursday', 'Room 103'),
(275, 6, 2, 'T004', 2, 'Thursday', 'Room 103'),
(276, 6, 3, 'T003', 3, 'Thursday', 'Room 103'),
(277, 6, 4, 'T012', 4, 'Thursday', 'Room 103'),
(278, 6, 5, 'T013', 5, 'Thursday', 'Room 103'),
(279, 6, 6, 'T010', 6, 'Thursday', 'Room 103'),
(280, 6, 9, 'T016', 8, 'Thursday', 'Room 103'),
(281, 6, 2, 'T004', 1, 'Friday', 'Room 103'),
(282, 6, 1, 'T006', 2, 'Friday', 'Room 103'),
(283, 6, 3, 'T003', 3, 'Friday', 'Room 103'),
(284, 6, 16, 'T018', 5, 'Friday', 'Room 103'),
(285, 6, 17, 'T019', 7, 'Friday', 'Room 103'),
(286, 6, 18, 'T017', 8, 'Friday', 'Room 103');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `regNo` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileNo` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `religion` varchar(50) NOT NULL,
  `role` enum('admin','teacher','student','principal','vice-principal','non-academic','parent') NOT NULL,
  `must_reset_password` tinyint(1) NOT NULL DEFAULT 0,
  `profile_picture` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `nameWithInitial` varchar(50) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`regNo`, `email`, `mobileNo`, `address`, `username`, `password`, `dob`, `gender`, `religion`, `role`, `must_reset_password`, `profile_picture`, `fullName`, `nameWithInitial`, `reset_token`, `token_expiry`) VALUES
(1, 'john.doe@example.com', '1234567890', '123 Elm St', 'johndoe', '$2y$10$yBDcxXjWajFbl3fDhcv/EOb1iYjOS0ANkcFYsvOxiOmCoDv417hYW', '1990-05-15', 'Male', 'Christianity', 'student', 0, NULL, 'John Kumara Doe', 'J.K.Doe', NULL, NULL),
(2, 'jane.doe@example.com', '0987654321', '456 Oak St', 'janedoe', '$2y$10$VpIHSjRmMWkRkSTY2ArcgOvm8PoQAYAJjOYAKdhl0ap2GdG.zdoLq', '1992-07-20', 'Female', 'Islam', 'teacher', 0, NULL, 'Jane Silva Doe', 'J.S.Doe', NULL, NULL),
(3, 'mike.smith@example.com', '1112223333', '789 Pine St', 'mikesmith', '$2y$10$XUhpcKy50MAeUQUmYf.0xedXC6Yt2yhZiJMaKj.36.uRu/02Fgshq', '1988-03-10', 'Male', 'Hinduism', 'admin', 0, 'public/img/profiles/3.jpg', 'Mike Perera Smith', 'M.P.Smith', NULL, NULL),
(4, 'sara.connor@example.com', '4445556666', '321 Maple St', 'saraconnor', '$2y$10$OkH2Uw4dzKCiatgmnBott.dND7yNCMUKzyiL76sdPU3fiJiy7aL2S', '1995-12-25', 'Female', 'Buddhism', 'principal', 0, 'public/img/profiles/4.jpg', 'Sara Wijesinghe Connor', 'S.W.Connor', NULL, NULL),
(5, 'anna.brown@example.com', '7778889999', '654 Cedar St', 'annabrown', '$2y$10$aJrDjr3W6ap9RdoqJS5A/u8mbt1vy5LArv4NTI0cFnr3iq1hZdnP2', '1991-01-30', 'Female', 'Judaism', 'vice-principal', 0, 'public/img/profiles/5.jpg', 'Anna Fernando Brown', 'A.F.Brown', NULL, NULL),
(6, 'paul.jones@example.com', '1231231234', '987 Birch St', 'pauljones', '$2y$10$oAJSUwv9oFZ8gy9eGzh/nOQkMeFuPuqiYY6ZMGzKyhMv9Ffk9/Bm6', '1985-09-18', 'Male', 'Christianity', 'non-academic', 0, 'public/img/profiles/6.jpg', 'Paul Bandara Jones', 'P.B.Jones', NULL, NULL),
(7, 'emily.davis@example.com', '5675675678', '852 Ash St', 'emilydavis', '$2y$10$gkC76HafSOncOKDEVjec9OwA4u/Bt8ub8Nxpxti8NZAohjAXtB7yu', '1993-04-05', 'Female', 'Christianity', 'parent', 0, NULL, 'Emily Gunawardena Davis', 'E.G.Davis', NULL, NULL),
(8, 'robert.miller@example.com', '6786786789', '741 Spruce St', 'robertmiller', '$2y$10$7lsQnk8XTMcKZOoTLWI.7OuBcabeBAe6PMIx9EaAI.kMP/hFdpWH2', '1990-06-22', 'Male', 'Islam', 'teacher', 0, NULL, 'Robert Rathnayake Miller', 'R.R.Miller', NULL, NULL),
(9, 'laura.moore@example.com', '7897897890', '963 Cypress St', 'lauramoore', '$2y$10$T56rgAOF3ZtGk5B.5KTdP.BjPqd2yaxwR3PIY98Ds0bwgAqtkwtve', '1994-11-12', 'Female', 'Hinduism', 'student', 0, NULL, 'Laura Jayasinghe Moore', 'L.J.Moore', NULL, NULL),
(10, 'daniel.king@example.com', '8908908901', '159 Willow St', 'danielking', '$2y$10$K0LCFWzTTUy5O5aBHOxInOXfLETTXSXOf2mVkeLeDtPKpB.EatZca', '1987-02-14', 'Male', 'Judaism', 'teacher', 0, NULL, 'Daniel Senarathne King', 'D.S.King', NULL, NULL),
(11, 'linda.green@example.com', '9998887776', '753 Chestnut St', 'lindagreen', '$2y$10$FdFibnUwiimd1oLUJvwyk./JPc88TSGFVBrOJ2Fk3QmlvK9RYokKy', '1982-08-21', 'Female', 'Christianity', 'non-academic', 0, NULL, 'Linda Kumara Green', 'L.K.Green', NULL, NULL),
(12, 'steven.white@example.com', '6665554443', '357 Redwood St', 'stevenwhite', '$2y$10$f7v38797QJBybkQ6RKxmgeKdsuooy0zvT8yROvwJf/7fSqegDEToW', '1980-05-10', 'Male', 'Buddhism', 'non-academic', 0, NULL, 'Steven Silva White', 'S.S.White', NULL, NULL),
(13, 'rachel.adams@example.com', '2223334445', '258 Magnolia St', 'racheladams', '$2y$10$/G12csVoUthDiqjXS2AjYe0whskANI47jpU4QOfYQLHcFBVhdo722', '1989-09-30', 'Female', 'Islam', 'non-academic', 0, NULL, 'Rachel Perera Adams', 'R.P.Adams', NULL, NULL),
(14, 'kevin.taylor@example.com', '0711234567', '123 Oak Street, Kandy', 'kevintaylor', '$2y$10$jxngUsfyafIno3uZhaebB.8ZgCnW2YtO.WW8vQ1tGFLd3brT.Hrha', '1985-08-20', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Kevin Fernando Taylor', 'K.F.Taylor', NULL, NULL),
(15, 'nina.thomas@example.com', '0729876543', '456 Pine Avenue, Colombo', 'ninathomas', '$2y$10$h1Aj8B/ZAPUHgSPOAjroie.6JdOZgAZK0nH9YOpi9zF8sEIFdNBJS', '1990-03-14', 'Female', 'Christianity', 'teacher', 0, NULL, 'Nina Wijesinghe Thomas', 'N.W.Thomas', NULL, NULL),
(16, 'samuel.fernando@example.com', '0755432167', '789 Lake Road, Galle', 'samuelfernando', '$2y$10$hvRCaoJun0uedVft/XFqz.KZEy.8nvKw3QcpDRSobHNqdIl6NH.ES', '1982-11-05', 'Male', 'Hinduism', 'teacher', 0, NULL, 'Samuel Bandara Fernando', 'S.B.Fernando', NULL, NULL),
(17, 'meera.perera@example.com', '0776543210', '456 Temple Road, Matara', 'meerap', '$2y$10$.sI7a.M08jWxwvjtIhy0TOwtdUCwRTtFYK38yQUX1CHrr3wTnskWa', '1991-06-12', 'Female', 'Buddhism', 'teacher', 0, NULL, 'Meera Gunawardena Perera', 'M.G.Perera', NULL, NULL),
(18, 'ravindu.jayasinghe@example.com', '0766778546', '194 Random Street, City', 'ravindujayasinghe', '$2b$12$uTvrDs05fD/Rl1VFlE6dkujWq2/iFgxcBffVSW7lGg93OIr0mEkBa', '1974-12-10', 'Male', 'Christianity', 'teacher', 0, 'public/img/profiles/18.jpg', 'Ravindu Rathnayake Jayasinghe', 'R.R.Jayasinghe', NULL, NULL),
(19, 'harsha.abeywardena@example.com', '0798801475', '213 Random Street, City', 'harshaabeywardena', '$2b$12$suagd7DKt3.uOjuy5jc7Ne17KQUu8q1vzCAKogMA9QKqD3E8JVdHS', '1994-08-11', 'Other', 'Hinduism', 'teacher', 0, NULL, 'Harsha Jayasinghe Abeywardena', 'H.J.Abeywardena', NULL, NULL),
(20, 'nadeesha.wijeratne@example.com', '0736558203', '396 Random Street, City', 'nadeeshawijeratne', '$2b$12$2kmkFRmHHZo1B38idJoF0.OIVbzq8ny5GNPOALYxvXaZPTxknHLR2', '1984-03-26', 'Male', 'Hinduism', 'teacher', 0, NULL, 'Nadeesha Senarathne Wijeratne', 'N.S.Wijeratne', NULL, NULL),
(21, 'harsha.pathirana@example.com', '0777904747', '163 Random Street, City', 'harshapathirana', '$2b$12$uZ33f9FLtrnKF.WelF74pefOZBOZ5TCiAgfbEU0fmbpxkm1/JgLju', '1971-06-16', 'Other', 'Islam', 'teacher', 0, NULL, 'Harsha Kumara Pathirana', 'H.K.Pathirana', NULL, NULL),
(22, 'thilini.jayalath@example.com', '0702569131', '5 Random Street, City', 'thilinijayalath', '$2b$12$W4KFlYGMtDvnUT/Rxy1Ire1Lo4P5u9G0JDcUYUNyvHOdhkA5YArOO', '1970-06-02', 'Male', 'Islam', 'teacher', 0, NULL, 'Thilina Jayalath', NULL, 'T.Jayalath', NULL),
(23, 'sanjaya.rajapaksha@example.com', '0743347252', '484 Random Street, City', 'sanjayarajapaksha', '$2b$12$x7yxORH/4.jNddEfvE5ze.JDdaCBw86ApD7SJF8heU4c8lGC/y0hO', '1972-08-16', 'Female', 'Islam', 'teacher', 0, NULL, 'Sanjaya Perera Rajapaksha', 'S.P.Rajapaksha', NULL, NULL),
(24, 'dinesh.samarasinghe@example.com', '0717735313', '37 Random Street, City', 'dineshsamarasinghe', '$2b$12$SnHLbkrbjStF5uRI0OKwG.g.ca7ZJefUxQME6790kXAT4hjTrD./i', '1981-12-13', 'Other', 'Hinduism', 'teacher', 0, NULL, 'Dinesh Fernando Samarasinghe', 'D.F.Samarasinghe', NULL, NULL),
(25, 'ishara.samarasinghe@example.com', '0733447096', '230 Random Street, City', 'isharasamarasinghe', '$2b$12$bubLRlu4ac8bDFipT2O9FOSBMfOsFMfCy2y9nuHJ/gYYBjT/kfWaK', '1970-07-23', 'Female', 'Buddhism', 'teacher', 0, NULL, 'Ishara Wijesinghe Samarasinghe', 'I.W.Samarasinghe', NULL, NULL),
(26, 'hashini.jayawardena@example.com', '0789010382', '155 Random Street, City', 'hashinijayawardena', '$2b$12$8dOGQ/YSkqQYAy6LiM8zDOEpnmiqFbfQVI6NlRcFc3.VEY6zD8zxO', '1975-08-12', 'Female', 'Buddhism', 'teacher', 0, NULL, 'Hashini Bandara Jayawardena', 'H.B.Jayawardena', NULL, NULL),
(27, 'nadeesha.pathirana@example.com', '0714773588', '76 Random Street, City', 'nadeeshapathirana', '$2b$12$G7uIC9rPXfWxgaqrmk7wc..EuZo3.PPYUIHJ7fXRsPXbEdCPjWSFm', '1974-04-12', 'Male', 'Hinduism', 'teacher', 0, NULL, 'Nadeesha Gunawardena Pathirana', 'N.G.Pathirana', NULL, NULL),
(28, 'pradeep.jayalath@example.com', '0717446829', '201 Random Street, City', 'pradeepjayalath', '$2b$12$ts.yVrmuMHQTU.OemxCOFeX.ipZKONIPNZmUzzl7rIG5fbZrmhOf6', '1993-05-04', 'Male', 'Christianity', 'teacher', 0, NULL, 'Pradeep Rathnayake Jayalath', 'P.R.Jayalath', NULL, NULL),
(29, 'hashini.dissanayake@example.com', '0768560406', '335 Random Street, City', 'hashinidissanayake', '$2b$12$ahDWDKwb/iDj1S7Kz1yQ1.5t1nCEpKM1n8zZIKYVJ9u/9MgKC1yky', '1983-02-02', 'Other', 'Christianity', 'teacher', 0, NULL, 'Hashini Jayasinghe Dissanayake', 'H.J.Dissanayake', NULL, NULL),
(30, 'kavindi.nanayakkara@example.com', '0721973632', '338 Random Street, City', 'kavindinanayakkara', '$2b$12$gG5JVUQM0Gngmc6NbIn.fe0ne0ATIaYore6mn69rJBtQ9q63aXeRi', '1995-08-20', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Kavindi Senarathne Nanayakkara', 'K.S.Nanayakkara', NULL, NULL),
(31, 'malsha.dissanayake@example.com', '0737616107', '57 Random Street, City', 'malshadissanayake', '$2b$12$8Rzyu1LyP/mw9V67o1bsWuKcnvkvcCeykMWMLjXDLyIPooWXOXfSe', '1987-07-15', 'Other', 'Hinduism', 'teacher', 0, NULL, 'Malsha Kumara Dissanayake', 'M.K.Dissanayake', NULL, NULL),
(32, 'isuru.perera@example.com', '0736648674', '70 Random Street, City', 'isuruperera', '$2b$12$n6HefRQHP.HrFhBv1vyt3OtU5CSMe0mE.YCxEtomfVirwOmkg4VEq', '1976-10-26', 'Other', 'Buddhism', 'teacher', 0, NULL, 'Isuru Silva Perera', 'I.S.Perera', NULL, NULL),
(33, 'chamara.dias@example.com', '0772610900', '127 Random Street, City', 'chamaradias', '$2b$12$1bcBfar4d8lFuqxBMMEvFecHYHEy7LKntgZ2G8w8xxdgF/PbY9WhO', '1978-03-04', 'Male', 'Islam', 'teacher', 0, NULL, 'Chamara Perera Dias', 'C.P.Dias', NULL, NULL),
(34, 'sanjaya.wijeratne@example.com', '0751826919', '71 Random Street, City', 'sanjayawijeratne', '$2b$12$QEjNbUpXDeLvJtgbRklG.OggISLLznyrpZtd/.Cf4wSppTZ1GT.hK', '1996-12-23', 'Female', 'Hinduism', 'teacher', 0, NULL, 'Sanjaya Fernando Wijeratne', 'S.F.Wijeratne', NULL, NULL),
(35, 'harsha.nanayakkara@example.com', '0736641992', '112 Random Street, City', 'harshananayakkara', '$2b$12$2DRrSPdxMhPCjrHhACaW4OmYq.YUlADGLeJucVLpjWXpO71E19Z7e', '1973-10-01', 'Other', 'Buddhism', 'teacher', 0, NULL, 'Harsha Wijesinghe Nanayakkara', 'H.W.Nanayakkara', NULL, NULL),
(36, 'pavithra.weerasinghe@example.com', '0717584981', '298 Random Street, City', 'pavithraweerasinghe', '$2b$12$TbsEG8YGQs1aWisU/vOe3eIoizZmOiEp579fK9L/bXjbrUWi3qOjC', '1999-04-16', 'Other', 'Christianity', 'teacher', 0, NULL, 'Pavithra Bandara Weerasinghe', 'P.B.Weerasinghe', NULL, NULL),
(37, 'nimal.kariyawasam@example.com', '0764360780', '395 Random Street, City', 'nimalkariyawasam', '$2b$12$M.TLu1VJ0pK5ynGHu6LPA.zWGsYx6s6lr2Jw6ZA8c3aCtYk7MeTE.', '1972-11-23', 'Female', 'Hinduism', 'teacher', 0, NULL, 'Nimal Gunawardena Kariyawasam', 'N.G.Kariyawasam', NULL, NULL),
(38, 'sameera.fernando@example.com', '0718243134', '459 Random Street, City', 'sameerafernando', '$2b$12$jG9Bn83ZVpG3he0bct8UO..6flAdAJmmauhU24Fk81VKHKbFjcoym', '1991-10-22', 'Other', 'Christianity', 'teacher', 0, NULL, 'Sameera Rathnayake Fernando', 'S.R.Fernando', NULL, NULL),
(39, 'nirosha.herath@example.com', '0725461323', '130 Random Street, City', 'niroshaherath', '$2b$12$Aj6wfc50Y3ezQ2gozC8gQutgyZQ4fhvwVcV/lDOVzaKCyEvtUhDkK', '1975-11-21', 'Male', 'Hinduism', 'teacher', 0, NULL, 'Nirosha Jayasinghe Herath', 'N.J.Herath', NULL, NULL),
(40, 'madushanka.kariyawasam@example.com', '0795190287', '204 Random Street, City', 'madushankakariyawasam', '$2b$12$itcpvtWtTqimIIvymrX3EedQnpHWSrieefemHd2AXJnzKkN2pw1qu', '1993-06-26', 'Female', 'Buddhism', 'teacher', 0, NULL, 'Madushanka Senarathne Kariyawasam', 'M.S.Kariyawasam', NULL, NULL),
(41, 'harsha.rajapaksha@example.com', '0713075218', '54 Random Street, City', 'harsharajapaksha', '$2b$12$YQl71zFsBV6uQxhnMTnBvOpYrRmf.uo0Ul7alGERRXcdWTnoqyLcy', '1989-10-09', 'Other', 'Christianity', 'teacher', 0, NULL, 'Harsha Kumara Rajapaksha', 'H.K.Rajapaksha', NULL, NULL),
(42, 'chamari.silva@example.com', '0789784203', '117 Random Street, City', 'chamarisilva', '$2b$12$yH2lwU2EeHBPVpHEFAH2TuALmVTj3Q9AEK169LkW5ISWF8vEwFxTG', '1992-12-13', 'Other', 'Hinduism', 'teacher', 0, NULL, 'Chamari Silva Silva', 'C.S.Silva', NULL, NULL),
(43, 'nimal.rajapaksha@example.com', '0789452312', 'No 10, Galle Road, Colombo', 'nimalrajapaksha', '$2y$10$tCnVC3jo2SANec7ZMRkKUO8mx8EHqOi2kK0L1oGrxDy/yrYvHKIGC', '1980-05-12', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Nimal Perera Rajapaksha', 'N.P.Rajapaksha', NULL, NULL),
(44, 'kamal.perera@example.com', '0778491235', 'No 22, Kandy Road, Kandy', 'kamalperera', '$2y$10$YfwA9NaNNEULOuGHnKL8RupcFeLpHZEeYqCN3Tchp.AtJCgS0eOam', '1975-11-03', 'Male', 'Christianity', 'teacher', 0, NULL, 'Kamal Fernando Perera', 'K.F.Perera', NULL, NULL),
(45, 'sunil.de_silva@example.com', '0782546398', 'No 45, Main Street, Kurunegala', 'sunildesilva', '$2y$10$vLr9mBzvnwYKeMEzAFZ9jOipLSEduJqRDWNYE0fM9EyCnZ0asEFFu', '1969-07-25', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Sunil Wijesinghe De Silva', 'S.W.De Silva', NULL, NULL),
(46, 'anura.jayasinghe@example.com', '0796548231', 'No 77, Temple Road, Gampaha', 'anurajayasinghe', '$2y$10$SZ1UXUSGJfYVcLRrhQnLROvynS5rVSsspMqnN6.Q2M/hX/4Vow3HO', '1988-02-18', 'Male', 'Hinduism', 'teacher', 0, NULL, 'Anura Bandara Jayasinghe', 'A.B.Jayasinghe', NULL, NULL),
(47, 'ruwan.fernando@example.com', '0771234567', 'No 5, Hill Street, Nuwara Eliya', 'ruwanfernando', '$2y$10$ea.dS/42m5oARl0Iji91V.95IuKNvZUCB4sfVOLc/46fyFK1bgNbS', '1990-03-22', 'Male', 'Christianity', 'teacher', 0, NULL, 'Ruwan Gunawardena Fernando', 'R.G.Fernando', NULL, NULL),
(48, 'sarath.ekanayake@example.com', '0745698741', 'No 18, Lake Road, Anuradhapura', 'sarathekanayake', '$2y$10$URrjCcGZPQ2HHhO4MiYs7u3BD2DKQuOmvI2Qw06vA60b/j3DGQvUW', '1972-09-10', 'Male', 'Islam', 'teacher', 0, NULL, 'Sarath Rathnayake Ekanayake', 'S.R.Ekanayake', NULL, NULL),
(49, 'chamara.abeysekera@example.com', '0789632145', 'No 33, Riverside, Matara', 'chamaraabeysekera', '$2y$10$oFrht4yui.VlMWWi.PjkzuPIF96ANE178rDJf2.cl.SwLiL0WdAWW', '1982-06-01', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Chamara Jayasinghe Abeysekera', 'C.J.Abeysekera', NULL, NULL),
(50, 'ajith.weerasinghe@example.com', '0732145698', 'No 90, College Road, Badulla', 'ajithweerasinghe', '$2y$10$WBzHlPYIhrH1QWzzCT6SiOhaf1bfFeEKN3PA3GYuZFcZ15C6U83di', '1995-08-14', 'Male', 'Hinduism', 'teacher', 0, NULL, 'Ajith Senarathne Weerasinghe', 'A.S.Weerasinghe', NULL, NULL),
(51, 'saman.gunawardena@example.com', '0798741236', 'No 60, Station Road, Polonnaruwa', 'samangunawardena', '$2y$10$JUHzWw7zIgquG7967/o8seLClehcYVB.L6y1k4t3e.21kInI5HGSK', '1978-01-29', 'Male', 'Christianity', 'teacher', 0, NULL, 'Saman Kumara Gunawardena', 'S.K.Gunawardena', NULL, NULL),
(52, 'ranjith.wijesinghe@example.com', '0725486391', 'No 25, School Lane, Jaffna', 'ranjithwijesinghe', '$2y$10$OEk36d1O84GBZ1snLpeHuuJSjIHbdByGSKij2szShRnhwTRMTaWbm', '1984-12-05', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Ranjith Silva Wijesinghe', 'R.S.Wijesinghe', NULL, NULL),
(53, 'harsha.dias@example.com', '0778456321', 'No 23, Temple Road, Colombo', 'harshadias', '$2y$10$K0iodg/HwaBw68unI22x6eWiHFGsKGBWFlqRohnqSM6nkF1pAeTz2', '1982-06-15', 'Male', 'Buddhism', 'teacher', 0, NULL, 'Harsha Perera Dias', 'H.P.Dias', NULL, NULL),
(54, 'dilan.wijesekera@example.com', '0712345678', '123 Galle Road, Colombo 03', 'dilanwijesekera', '$2y$10$3yhSbRGbZOCy2hBQzxe2Mu/8S8VWuJ9JxUdy65pmWu/RxHvqvx9Wm', '2014-05-10', 'Male', 'Buddhism', 'student', 0, NULL, 'Dilan Fernando Wijesekera', 'D.F.Wijesekera', NULL, NULL),
(55, 'amaya.senarath@example.com', '0773456789', '45 Temple Road, Kandy', 'amayasenarath', '$2y$10$IMJgUZz9cjLMXUcSPejyjupnMaf7qW5KxN9o44WVQckTVh5ymoTci', '2014-06-15', 'Female', 'Buddhism', 'student', 0, 'public/img/profiles/55.jpg', 'Amaya Wijesinghe Senarath', 'A.W.Senarath', NULL, NULL),
(56, 'tharindu.gamage@example.com', '0764567890', '78 Main Street, Galle', 'tharindugamage', '$2y$10$Qai/W91uCxFcbvNd7E8Zru9VWt3TRzOw1RlPe2FkwzXJT7n8g9geC', '2014-04-20', 'Male', 'Christianity', 'student', 0, NULL, NULL, NULL, NULL, NULL),
(57, 'nethmi.rathnayake@example.com', '0785678901', '12 School Lane, Negombo', 'nethmirathnayake', '$2y$10$xgwWpUvE1lYAkneuKTwiXeZraFPzAb5Fdcozu/DKS2qj/qpKyc/Ha', '2014-07-25', 'Female', 'Buddhism', 'student', 0, NULL, 'Nethmi Bandara Rathnayake', 'N.B.Rathnayake', NULL, NULL),
(58, 'sajith.mendis@example.com', '0706789012', '90 Flower Road, Matara', 'sajithmendis', '$2y$10$QxZcNywOHfH5K9xvC2oNQuD9gJIZn.I1ZJtXvnKulPaYUW2p6zHpm', '2014-03-30', 'Male', 'Hinduism', 'student', 0, NULL, 'Sajith Gunawardena Mendis', 'S.G.Mendis', NULL, NULL),
(59, 'kavisha.hettiarachchi@example.com', '0717890123', '56 Lake Road, Kurunegala', 'kavishahettiarachchi', '$2y$10$anTN7ZrepHvx45zvPcGqpOsSfaWZvcr6LRGLj6uxTcRQujY3mAeze', '2013-08-05', 'Female', 'Buddhism', 'student', 0, NULL, 'Kavisha Rathnayake Hettiarachchi', 'K.R.Hettiarachchi', NULL, NULL),
(60, 'yasith.kodagoda@example.com', '0778901234', '34 Park Lane, Ratnapura', 'yasithkodagoda', '$2y$10$M65F0qrucRXBFsqIF3pN1eIfqH4UdmuA/bqcIwoxYdfGgMfeViCSe', '2013-09-10', 'Male', 'Buddhism', 'student', 0, NULL, 'Yasith Jayasinghe Kodagoda', 'Y.J.Kodagoda', NULL, NULL),
(61, 'sanduni.lakmal@example.com', '0769012345', '89 Beach Road, Jaffna', 'sandunilakmal', '$2y$10$HQxnzVVuo6o7ptN.pUjnFe.d/.VB36bQmYy7Bqc2b01mhHW8uFlp.', '2013-05-15', 'Female', 'Hinduism', 'student', 0, NULL, 'Sanduni Senarathne Lakmal', 'S.S.Lakmal', NULL, NULL),
(62, 'nipun.edirisinghe@example.com', '0780123456', '23 Hill Street, Nuwara Eliya', 'nipunedirisinghe', '$2y$10$mONymATZa0sFN7UzSALqkeHiMDE894GAx8mMuSWyuiCirj18H3c/G', '2013-06-20', 'Male', 'Buddhism', 'student', 0, NULL, 'Nipun Kumara Edirisinghe', 'N.K.Edirisinghe', NULL, NULL),
(63, 'ishara.munasinghe@example.com', '0701234567', '67 Station Road, Anuradhapura', 'isharamunasinghe', '$2y$10$Q/lAVlO0FWzlvnPYcCqxuu926ImexUyGm.1cceWZ37PT8hT2ntBeS', '2013-07-25', 'Female', 'Buddhism', 'student', 0, NULL, 'Ishara Silva Munasinghe', 'I.S.Munasinghe', NULL, NULL),
(64, 'vishal.de_alwis@example.com', '0712345679', '45 Royal Road, Trincomalee', 'vishaldealwis', '$2y$10$xkqSnWFm5F252cMimhnF2.rwM9AuHyH8N1xzkooIKzjCXoZoYMUSu', '2012-04-10', 'Male', 'Christianity', 'student', 0, NULL, 'Vishal Perera De Alwis', 'V.P.De Alwis', NULL, NULL),
(65, 'thilanka.kumara@example.com', '0773456780', '78 Kandy Road, Gampaha', 'thilankakumara', '$2y$10$Un3XdAa7idHeHNdEKWEyU.3Oh6ODaGWjIZRDVDnd9WXLGyPArH8XS', '2012-05-15', 'Female', 'Buddhism', 'student', 0, NULL, 'Thilanka Fernando Kumara', 'T.F.Kumara', NULL, NULL),
(66, 'randima.salgado@example.com', '0764567891', '12 Sea View, Mount Lavinia', 'randimasalgado', '$2y$10$iduEPt436PwWzn/DdfG9F.2xggm0FjvKVKZ0fam0dI7d5N4TBCuoO', '2012-06-20', 'Female', 'Christianity', 'student', 0, NULL, 'Randima Wijesinghe Salgado', 'R.W.Salgado', NULL, NULL),
(67, 'kasun.wickramaratne@example.com', '0785678902', '90 Lotus Road, Batticaloa', 'kasunwickramaratne', '$2y$10$OOXkkaTAaFRBUpBl2pGtf.XRzTWPce32zKd8ZVfLP0wc30xTlootG', '2012-07-25', 'Male', 'Buddhism', 'student', 0, NULL, 'Kasun Bandara Wickramaratne', 'K.B.Wickramaratne', NULL, NULL),
(68, 'navod.karunaratne@example.com', '0706789013', '34 Church Street, Kalutara', 'navodkarunaratne', '$2y$10$.KFQ/FOsIUVFnIPt/qq0Wu2BauSZSp3FoMpfKB9i38.1OuPWT6a0i', '2012-08-30', 'Male', 'Buddhism', 'student', 0, NULL, 'Navod Gunawardena Karunaratne', 'N.G.Karunaratne', NULL, NULL),
(69, 'anuki.peiris@example.com', '0717890124', '56 Garden Road, Badulla', 'anukipeiris', '$2y$10$LDkHanl8Mpoq9TM2x8nMIuximZAyUpzFRxs2YGRQyaG1JdiDr/71u', '2011-03-05', 'Female', 'Buddhism', 'student', 0, NULL, 'Anuki Rathnayake Peiris', 'A.R.Peiris', NULL, NULL),
(70, 'dinuka.sooriyarachchi@example.com', '0778901235', '89 Palm Grove, Puttalam', 'dinukasooriyarachchi', '$2y$10$yvPfDf318/h5HpmHDJ3JO.9.rM6PcwZlZbgnQu/PHhHOoKbtFycdW', '2011-04-10', 'Male', 'Hinduism', 'student', 0, NULL, 'Dinuka Jayasinghe Sooriyarachchi', 'D.J.Sooriyarachchi', NULL, NULL),
(71, 'malithi.wijemanne@example.com', '0769012346', '23 Canal Road, Moratuwa', 'malithiwijemanne', '$2y$10$unW1H5ui3feS0LCGmXuwW.fOu0cC3oCDQcipqt4aBb0pukdNg/ffa', '2011-05-15', 'Female', 'Buddhism', 'student', 0, NULL, 'Malithi Senarathne Wijemanne', 'M.S.Wijemanne', NULL, NULL),
(72, 'ruvin.athukorala@example.com', '0780123457', '67 Orchard Lane, Hambantota', 'ruvinathukorala', '$2y$10$dYwpVS1fr139s9KSSyh17OoUuvyOtvG.NKgjWE5ytzMR8hriQeD5G', '2011-06-20', 'Male', 'Buddhism', 'student', 0, NULL, 'Ruvin Kumara Athukorala', 'R.K.Athukorala', NULL, NULL),
(73, 'sachini.madushanka@example.com', '0701234568', '12 River Road, Polonnaruwa', 'sachinimadushanka', '$2y$10$kLw0EVSpfD3hg4c3AG90/uZLsUVgYSR7XJKSxUH5eFp1t943irO96', '2011-07-25', 'Female', 'Buddhism', 'student', 0, NULL, 'Sachini Silva Madushanka', 'S.S.Madushanka', NULL, NULL),
(74, 'lahiru.gunarathna@example.com', '0712345680', '45 Green Lane, Avissawella', 'lahirugunarathna', '$2y$10$RgZQAT6ADEc.61fbBHFf2OJX2nE/UDZkbprQUfOuacjZvbYyy8Y6y', '2010-08-05', 'Male', 'Buddhism', 'student', 0, NULL, 'Lahiru Perera Gunarathna', 'L.P.Gunarathna', NULL, NULL),
(75, 'oshadi.wimalaratne@example.com', '0773456781', '78 Mango Road, Panadura', 'oshadiwimalaratne', '$2y$10$eacjRlXxNNc7uUlKliMNmOtPNQFVOpBcrfQM5YWhee6xwHqFzd3HS', '2010-09-10', 'Female', 'Buddhism', 'student', 0, NULL, 'Oshadi Fernando Wimalaratne', 'O.F.Wimalaratne', NULL, NULL),
(76, 'danushka.jayatissa@example.com', '0764567892', '90 Coconut Grove, Chilaw', 'danushkajayatissa', '$2y$10$zY97hGyvBSXQyB/tMHpu3uxiUhPJ.gO3MVTmc4VgZNL1IFZNxj0/a', '2010-05-15', 'Male', 'Hinduism', 'student', 0, NULL, 'Danushka Wijesinghe Jayatissa', 'D.W.Jayatissa', NULL, NULL),
(77, 'vindya.samarakoon@example.com', '0785678903', '34 Pine Road, Maharagama', 'vindyasamarakoon', '$2y$10$DSJilYeXhEc7sFC8WWgEY.TigCSd0dDlQKLx00eqmbjMFOpLbHlqe', '2010-06-20', 'Female', 'Buddhism', 'student', 0, NULL, 'Vindya Bandara Samarakoon', 'V.B.Samarakoon', NULL, NULL),
(78, 'tharaka.lakshitha@example.com', '0706789014', '56 Cedar Lane, Homagama', 'tharakalakshitha', '$2y$10$uGG40NpNoXPv6z/LFqUcVuntlwbi3riNIwNFkEkPUXm15wBxW86Ne', '2010-07-25', 'Male', 'Buddhism', 'student', 0, NULL, 'Tharaka Gunawardena Lakshitha', 'T.G.Lakshitha', NULL, NULL),
(79, 'nethushi.wijesundara@example.com', '0717890125', '89 Ocean Drive, Ambalangoda', 'nethushiwijesundara', '$2y$10$3U9uBbbLcw.ShfHZu1dUveHUA9tQkNIxW467a4/ZAaPa7C1NvMmfm', '2009-03-05', 'Female', 'Buddhism', 'student', 0, NULL, 'Nethushi Rathnayake Wijesundara', 'N.R.Wijesundara', NULL, NULL),
(80, 'sankalpa.herath@example.com', '0778901236', '23 Star Road, Kuliyapitiya', 'sankalpaherath', '$2y$10$NAZ1GAkBFWKbq3Ifg0NmMex7iWm0H9MBwisvoW9JwfufphCnC2sEq', '2009-04-10', 'Male', 'Buddhism', 'student', 0, NULL, 'Sankalpa Jayasinghe Herath', 'S.J.Herath', NULL, NULL),
(81, 'dewmini.bandara@example.com', '0769012347', '67 Rose Lane, Horana', 'dewminibandara', '$2y$10$WqdsOHd2BzXRHqPNtTiJmuC2IdgcAiskxsNBURPKsek5mSy08TgAq', '2009-05-15', 'Female', 'Buddhism', 'student', 0, NULL, 'Dewmini Senarathne Bandara', 'D.S.Bandara', NULL, NULL),
(82, 'pramith.vithanage@example.com', '0780123458', '12 Maple Road, Dehiwala', 'pramithvithanage', '$2y$10$uz5Nx6nIwUYcpplaK8BMMOz6OQpswORTLEcW4nAVDYbG/xTbd59.q', '2009-06-20', 'Male', 'Christianity', 'student', 0, NULL, 'Pramith Kumara Vithanage', 'P.K.Vithanage', NULL, NULL),
(83, 'chalani.kulatunga@example.com', '0701234569', '45 Oak Street, Borella', 'chalanikulatunga', '$2y$10$ajLH5w8wHpe/i2tcIOTLveU5ThtHPLNOQfpudg6xBYDi5aNHWFXWS', '2009-07-25', 'Female', 'Buddhism', 'student', 0, NULL, 'Chalani Silva Kulatunga', 'C.S.Kulatunga', NULL, NULL),
(84, 'keshan.siriwardena@example.com', '0712345681', '56 Lotus Lane, Colombo 04', 'keshansiriwardena', '$2y$10$HjVHFQFx/UAdtWoWqBQq2OXG1BjA1FRum7zdQO5ipug0/SuPikAqa', '2014-08-15', 'Male', 'Buddhism', 'student', 0, NULL, 'Keshan Perera Siriwardena', 'K.P.Siriwardena', NULL, NULL),
(85, 'tharini.gunasekara@example.com', '0773456782', '23 Temple Street, Kandy', 'tharinigunasekara', '$2y$10$nAbAOjauNla2vjM2PgzJOumhVGk7VVffNOPLk2kyOZHVoEVLlkd1q', '2013-09-20', 'Female', 'Buddhism', 'student', 0, NULL, 'Tharini Fernando Gunasekara', 'T.F.Gunasekara', NULL, NULL),
(86, 'vidura.liyanage@example.com', '0764567893', '78 Beach Road, Galle', 'viduraliyanage', '$2y$10$rGbjRAbr68yHE2jg6n8aYeaDYCzM.UqX5V6VDemp7vlcbUusmH4.q', '2012-05-25', 'Male', 'Christianity', 'student', 0, NULL, 'Vidura Wijesinghe Liyanage', 'V.W.Liyanage', NULL, NULL),
(87, 'sanuja.kodithuwakku@example.com', '0785678904', '12 Park Road, Negombo', 'sanujakodithuwakku', '$2y$10$rPHpnJFl7q.l.HA0SqyOoe2/HMdCsTTixEXlQPkjTq.8YmvMULDaq', '2011-06-30', 'Female', 'Buddhism', 'student', 0, NULL, 'Sanuja Bandara Kodithuwakku', 'S.B.Kodithuwakku', NULL, NULL),
(88, 'dimuthu.ranasinghe@example.com', '0706789015', '45 Flower Street, Matara', 'dimuthuranasinghe', '$2y$10$MplAIKgrFX08QieVWjMjzuEd6LHj8EbZuzNdEZTS29n0JCthrzvwW', '2010-07-10', 'Male', 'Hinduism', 'student', 0, NULL, 'Dimuthu Gunawardena Ranasinghe', 'D.G.Ranasinghe', NULL, NULL),
(89, 'yashodha.weerasekara@example.com', '0717890126', '89 Lake Road, Kurunegala', 'yashodhaweerasekara', '$2y$10$AYWgUPwp8iu/iRt0lgxXZej1xbx56WU1g8u.Q0f7q9R7u3qkeRpUq', '2009-08-05', 'Female', 'Buddhism', 'student', 0, NULL, 'Yashodha Rathnayake Weerasekara', 'Y.R.Weerasekara', NULL, NULL),
(90, 'amal.wickramasinghe@example.com', '0712345682', '34 Palm Road, Colombo 05', 'amalwickramasinghe', '$2y$10$wz2HvjntLHIITU3tOibBje0ouB7TKrM7/pxjPD9TEZSkM0VYOcta6', '2014-09-10', 'Male', 'Buddhism', 'student', 0, NULL, 'Amal Jayasinghe Wickramasinghe', 'A.J.Wickramasinghe', NULL, NULL),
(91, 'nayana.ekanayaka@example.com', '0773456783', '67 Temple Lane, Kandy', 'nayanaekanayaka', '$2y$10$Um44sBfUTgwyjtnKuwkOxOqrE3PEx2ozp99skxQa.TuuXyunZ5yy.', '2014-10-15', 'Female', 'Buddhism', 'student', 0, NULL, 'Nayana Senarathne Ekanayaka', 'N.S.Ekanayaka', NULL, NULL),
(92, 'sithum.kalubowila@example.com', '0764567894', '89 Sea Road, Galle', 'sithumkalubowila', '$2y$10$66JAqPhTPzQ9GpjeJ6CZDe0184zmNp6F41iFifREQDacoRg085Gei', '2014-11-20', 'Male', 'Christianity', 'student', 0, NULL, 'Sithum Kumara Kalubowila', 'S.K.Kalubowila', NULL, NULL),
(93, 'dinithi.senadheera@example.com', '0785678905', '12 Lake View, Negombo', 'dinithisenadheera', '$2y$10$xsU4YG/k96q.Q.dUaX38w.A7CEnzz0Vqf8AemYtUg/at0kQEfKZAq', '2014-12-25', 'Female', 'Buddhism', 'student', 0, NULL, 'Dinithi Silva Senadheera', 'D.S.Senadheera', NULL, NULL),
(94, 'isuru.bandaranayake@example.com', '0706789016', '45 Station Road, Matara', 'isurubandaranayake', '$2y$10$XV5nzbtiPcm36XJFE5PD3.7X.VMuTvRmvPyXYpk1akJ7f/UQYD/0K', '2013-10-05', 'Male', 'Buddhism', 'student', 0, NULL, 'Isuru Perera Bandaranayake', 'I.P.Bandaranayake', NULL, NULL),
(95, 'sachika.dewapriya@example.com', '0717890127', '78 River Lane, Kurunegala', 'sachikadewapriya', '$2y$10$L.S78LhkZ3/UzpnA6scyr.MbgOlUutPPez0/gIbW5acNuGg0HatCK', '2013-11-10', 'Female', 'Buddhism', 'student', 0, NULL, 'Sachika Fernando Dewapriya', 'S.F.Dewapriya', NULL, NULL),
(96, 'tharusha.jayakody@example.com', '0778901237', '23 Hill Road, Ratnapura', 'tharushajayakody', '$2y$10$DR/5PvMQmKdPvska5ggzKemEAXnYj0Hr.7ZjTgASuEwtp4TOeXlu.', '2013-12-15', 'Male', 'Hinduism', 'student', 0, NULL, 'Tharusha Wijesinghe Jayakody', 'T.W.Jayakody', NULL, NULL),
(97, 'hasini.mahawela@example.com', '0769012348', '56 Beach Street, Jaffna', 'hasinimahawela', '$2y$10$hpgbcD.RHfX77XJFC4ZqKuN4o6CrDVUrNcbKlt0W1HGWgOOB952.i', '2013-08-20', 'Female', 'Hinduism', 'student', 0, NULL, 'Hasini Bandara Mahawela', 'H.B.Mahawela', NULL, NULL),
(98, 'ravindu.kotagama@example.com', '0780123459', '90 Park Lane, Nuwara Eliya', 'ravindukotagama', '$2y$10$drxhQyxSBnAf60NxwRMA/elVbD8Cg0cm7BJxE1CL9NNQS2bv1/oLe', '2012-09-05', 'Male', 'Buddhism', 'student', 0, NULL, 'Ravindu Gunawardena Kotagama', 'R.G.Kotagama', NULL, NULL),
(99, 'menuka.wijesooriya@example.com', '0701234570', '34 Royal Road, Anuradhapura', 'menukawijesooriya', '$2y$10$uILAbEgaiI4E3gfXPRZPMu7yLI9vxDLHR0yQEmT7eV0p0kQo.DO0m', '2012-10-10', 'Female', 'Buddhism', 'student', 0, NULL, 'Menuka Rathnayake Wijesooriya', 'M.R.Wijesooriya', NULL, NULL),
(100, 'dulanja.samarajeewa@example.com', '0712345683', '67 Ocean Drive, Trincomalee', 'dulanjasamarajeewa', '$2y$10$lGYGaHimYSSVXnhrWxCnouR2QJpJ9q/RInpnXtYt9PEzf7mDqbmCS', '2012-11-15', 'Male', 'Christianity', 'student', 0, NULL, 'Dulanja Jayasinghe Samarajeewa', 'D.J.Samarajeewa', NULL, NULL),
(101, 'ashinsana.mudannayake@example.com', '0773456784', '12 Kandy Road, Gampaha', 'ashinsanamudannayake', '$2y$10$xVo1P/maYCxKPq8BASBgHeKAHt0.pM6kvDljA6Ot8Ik.VAIzXCAEC', '2012-12-20', 'Female', 'Buddhism', 'student', 0, NULL, 'Ashinsana Senarathne Mudannayake', 'A.S.Mudannayake', NULL, NULL),
(102, 'yasiru.gunathilaka@example.com', '0764567895', '45 Sea View, Mount Lavinia', 'yasirugunathilaka', '$2y$10$44ZhEC7Nriq.OjG5UAklbuiljGpxpgVLNman9kNW2aIOowBEQUZge', '2011-08-25', 'Male', 'Buddhism', 'student', 0, NULL, 'Yasiru Kumara Gunathilaka', 'Y.K.Gunathilaka', NULL, NULL),
(103, 'nipuni.abeykoon@example.com', '0785678906', '78 Lotus Road, Batticaloa', 'nipuniabeykoon', '$2y$10$1bxohpFMCZkmZZsXzEmPZ.AxsEBC9NLmDB3.YD4edJWhCauH322ii', '2011-09-30', 'Female', 'Hinduism', 'student', 0, NULL, 'Nipuni Silva Abeykoon', 'N.S.Abeykoon', NULL, NULL),
(104, 'sankha.rupasinghe@example.com', '0706789017', '23 Church Street, Kalutara', 'sankharupasinghe', '$2y$10$bYnJu4XTK9UyMsjbp5SPCur5Kp9ej67caFSut9gShoY95mEW0cG.S', '2011-10-05', 'Male', 'Buddhism', 'student', 0, NULL, 'Sankha Perera Rupasinghe', 'S.P.Rupasinghe', NULL, NULL),
(105, 'thiloka.wijethunga@example.com', '0717890128', '56 Garden Road, Badulla', 'thilokawijethunga', '$2y$10$PLQqC08Nx.ksxfRcABT5OOQ6nlDxsi6AoF2PZPWF0pdLDbFaRRug6', '2011-11-10', 'Female', 'Buddhism', 'student', 0, NULL, 'Thiloka Fernando Wijethunga', 'T.F.Wijethunga', NULL, NULL),
(106, 'dinal.amarakoon@example.com', '0778901238', '89 Palm Grove, Puttalam', 'dinalamarakoon', '$2y$10$0eQSE7fcK0B2KwVVoN7iVOPFsi4HYsbiasgqwCaxbTISHXxMBzyW2', '2010-08-15', 'Male', 'Buddhism', 'student', 0, NULL, 'Dinal Wijesinghe Amarakoon', 'D.W.Amarakoon', NULL, NULL),
(107, 'kumudu.wimalasena@example.com', '0769012349', '12 Canal Road, Moratuwa', 'kumuduwimalasena', '$2y$10$vraA.ih4UV4sd.73TstUP.SPT3a9nutMh9wLpwvIkiu9cM0rZP8ZK', '2010-09-20', 'Female', 'Buddhism', 'student', 0, NULL, 'Kumudu Bandara Wimalasena', 'K.B.Wimalasena', NULL, NULL),
(108, 'navindu.desilva@example.com', '0780123460', '67 Orchard Lane, Hambantota', 'navindudesilva', '$2y$10$7ssJR.LFTAT6v.GBka6wH.8no4ZB0B/A5ZzTMuk0GcvpHR0j/RKw6', '2010-10-25', 'Male', 'Christianity', 'student', 0, NULL, 'Navindu Gunawardena Desilva', 'N.G.Desilva', NULL, NULL),
(109, 'rashmi.wijegunawardana@example.com', '0701234571', '34 River Road, Polonnaruwa', 'rashmiwijegunawardana', '$2y$10$xET9DATkwCpi3adSIbQdjOOMfaAC9H9LVLdU7fvt8Hb/.jINEHbhW', '2010-11-30', 'Female', 'Buddhism', 'student', 0, NULL, 'Rashmi Rathnayake Wijegunawardana', 'R.R.Wijegunawardana', NULL, NULL),
(110, 'mihiru.koswatta@example.com', '0712345684', '45 Green Lane, Avissawella', 'mihirukoswatta', '$2y$10$yC.YOiB0n8GszaPknJ7jXeQPunRZURHJWw3t0EH7WFOS/fF8DQwhq', '2009-09-05', 'Male', 'Buddhism', 'student', 0, NULL, 'Mihiru Jayasinghe Koswatta', 'M.J.Koswatta', NULL, NULL),
(111, 'anura.seneviratne@example.com', '0773456785', '78 Mango Road, Panadura', 'anuraseneviratne', '$2y$10$Vvt5AOtbzXvufPQb36LohOiH4MAZm13MU38cWdXsDI1WjyyhQXtii', '2009-10-10', 'Female', 'Buddhism', 'student', 0, NULL, 'Anura Senarathne Seneviratne', 'A.S.Seneviratne', NULL, NULL),
(112, 'chamath.guruge@example.com', '0764567896', '90 Coconut Grove, Chilaw', 'chamathguruge', '$2y$10$SbIrhNZjzsXZ8diDU52P3uoNhsSqkpe.kRB9PMI.FnFmmp3ieGSFW', '2009-11-15', 'Male', 'Hinduism', 'student', 0, NULL, 'Chamath Kumara Guruge', 'C.K.Guruge', NULL, NULL),
(113, 'sandali.yapa@example.com', '0785678907', '12 Pine Road, Maharagama', 'sandaliyapa', '$2y$10$hYmcd60dAZFm.Vx7XavcJOZyGlcDm6FsEexO07liWYUhkqPytCQhS', '2009-12-20', 'Female', 'Buddhism', 'student', 0, NULL, 'Sandali Silva Yapa', 'S.S.Yapa', NULL, NULL),
(114, 'ranjan.kumara@example.com', '0712345685', '123 Galle Road, Colombo 03', 'ranjankumara', '$2y$10$WP1EooayILt4.WgJCWljnemKvENHR6qkAAs3fqoPRDLGmghbk6VZ6', '1980-03-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Ranjan Perera Kumara', 'R.P.Kumara', NULL, NULL),
(115, 'kumari.senarathne@example.com', '0773456786', '45 Temple Road, Kandy', 'kumarisenarathne', '$2y$10$2tOYboYlv/v.9rBhOAUFPuansqcVWzZ35ACq8Y4peLd0xzfToGaGW', '1978-07-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Kumari Fernando Senarathne', 'K.F.Senarathne', NULL, NULL),
(116, 'sunil.gamage@example.com', '0764567897', '78 Main Street, Galle', 'sunilgamage', '$2y$10$QmdPH7aCV7N9/fTnk6g91OeJ5YkHEMV8CYaA869o8H6orHdmLZlA.', '1975-11-10', 'Male', 'Christianity', 'parent', 0, NULL, 'Sunil Wijesinghe Gamage', 'S.W.Gamage', NULL, NULL),
(117, 'nimali.rathnayake@example.com', '0785678908', '12 School Lane, Negombo', 'nimalirathnayake', '$2y$10$d0CGJO4QdzWFLlad4MgQ4uVZlOtn93Ja410hiw2kGLDEwTAXTuWC.', '1982-04-25', 'Female', 'Buddhism', 'parent', 0, NULL, 'Nimali Bandara Rathnayake', 'N.B.Rathnayake', NULL, NULL),
(118, 'saman.mendis@example.com', '0706789018', '90 Flower Road, Matara', 'samanmendis', '$2y$10$OVGpWbEVy/OUnz06wi0x8e6pgMsYlk6MNueA9tQKJhvj9XSfBpDYi', '1977-09-30', 'Male', 'Hinduism', 'parent', 0, NULL, 'Saman Gunawardena Mendis', 'S.G.Mendis', NULL, NULL),
(119, 'priyani.siriwardena@example.com', '0717890129', '56 Lotus Lane, Colombo 04', 'priyanisiriwardena', '$2y$10$edaAcMOE/nQHlw6.SrfjWeRGetIRHuZnE10tJC7youjcHnT/6d7WG', '1985-02-15', 'Female', 'Buddhism', 'parent', 0, NULL, 'Priyani Rathnayake Siriwardena', 'P.R.Siriwardena', NULL, NULL),
(120, 'sujith.wickramasinghe@example.com', '0778901239', '34 Palm Road, Colombo 05', 'sujithwickramasinghe', '$2y$10$6A8ncXAR1mIqQn7yKpyfkuY/JoUjltTxKKGbz07sJVodPAPF5hOR2', '1979-06-20', 'Male', 'Buddhism', 'parent', 0, NULL, 'Sujith Jayasinghe Wickramasinghe', 'S.J.Wickramasinghe', NULL, NULL),
(121, 'chandani.ekanayaka@example.com', '0769012350', '67 Temple Lane, Kandy', 'chandaniekanayaka', '$2y$10$2Tj55RL9yviJpc6DFIS.VuoZvfBt4p5nXGqCju7.h1PLLDmIviUdi', '1983-10-05', 'Female', 'Buddhism', 'parent', 0, NULL, 'Chandani Senarathne Ekanayaka', 'C.S.Ekanayaka', NULL, NULL),
(122, 'lalith.kalubowila@example.com', '0780123461', '89 Sea Road, Galle', 'lalithkalubowila', '$2y$10$84eudXVz/j6uEPXgw5veVegymNXLsG0YShgiNLOHqtAof9cL5lI1G', '1976-01-25', 'Male', 'Christianity', 'parent', 0, NULL, 'Lalith Kumara Kalubowila', 'L.K.Kalubowila', NULL, NULL),
(123, 'seetha.senadheera@example.com', '0701234572', '12 Lake View, Negombo', 'seethasenadheera', '$2y$10$yxR3hQ9PuRlO8aaLQIfrcu9FPVwftFo2kkP2rLvQFh4Xw.ie.rSgO', '1981-05-10', 'Female', 'Buddhism', 'parent', 0, NULL, 'Seetha Silva Senadheera', 'S.S.Senadheera', NULL, NULL),
(124, 'upul.hettiarachchi@example.com', '0712345686', '56 Lake Road, Kurunegala', 'upulhettiarachchi', '$2y$10$ruJT9HqRXFGLrKPo/feBt.WHThpOMFxQQAQYORsQYYdIG/UAzBaeW', '1978-08-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Upul Perera Hettiarachchi', 'U.P.Hettiarachchi', NULL, NULL),
(125, 'renuka.kodagoda@example.com', '0773456787', '34 Park Lane, Ratnapura', 'renukakodagoda', '$2y$10$8oveNK2NmbnIlIDrVEYY/.obCl/Yb1VeM88X2UFgI1xRqsF9cVobe', '1984-12-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Renuka Fernando Kodagoda', 'R.F.Kodagoda', NULL, NULL),
(126, 'nihal.lakmal@example.com', '0764567898', '89 Beach Road, Jaffna', 'nihallakmal', '$2y$10$hCnKbwmQs5n..zaOOHExCu2aci/.34jk3fdE2gUmPDkeFyKUhqbMC', '1975-03-05', 'Male', 'Hinduism', 'parent', 0, NULL, 'Nihal Wijesinghe Lakmal', 'N.W.Lakmal', NULL, NULL),
(127, 'indrani.edirisinghe@example.com', '0785678909', '23 Hill Street, Nuwara Eliya', 'indraniedirisinghe', '$2y$10$VyJO4MGI5Lzhm/uZmWKikenrGXPnJCTnIGbRx/e6Zx1qrDyy8A0i.', '1980-07-25', 'Female', 'Buddhism', 'parent', 0, NULL, 'Indrani Bandara Edirisinghe', 'I.B.Edirisinghe', NULL, NULL),
(128, 'dayan.munasinghe@example.com', '0706789019', '67 Station Road, Anuradhapura', 'dayanmunasinghe', '$2y$10$kll240hv4WMGMPsOsU/jXOdUm8UfmY5v3x.HvVIAauwVGxmrq.zNS', '1977-11-10', 'Male', 'Buddhism', 'parent', 0, NULL, 'Dayan Gunawardena Munasinghe', 'D.G.Munasinghe', NULL, NULL),
(129, 'mangala.gunasekara@example.com', '0717890130', '23 Temple Street, Kandy', 'mangalagunasekara', '$2y$10$fere7rS9HrWAFS6G14uEeuOFUrU24BO/FhQSGmFhnM9GaJeRDVCL.', '1982-02-15', 'Female', 'Buddhism', 'parent', 0, NULL, 'Mangala Rathnayake Gunasekara', 'M.R.Gunasekara', NULL, NULL),
(130, 'asoka.bandaranayake@example.com', '0778901240', '45 Station Road, Matara', 'asokabandaranayake', '$2y$10$gB71ueWrhNGtd4W2DPBQOuMoJMNRmaRuQHwbV/yPfnJrTujtserAq', '1979-06-30', 'Male', 'Buddhism', 'parent', 0, NULL, 'Asoka Jayasinghe Bandaranayake', 'A.J.Bandaranayake', NULL, NULL),
(131, 'kusum.dewapriya@example.com', '0769012351', '78 River Lane, Kurunegala', 'kusumdewapriya', '$2y$10$5ULpG57FEDXSWJ0t4sYStuhhUEy4IvWnnXUrjkkXe042yp8E9qtl2', '1985-09-05', 'Female', 'Buddhism', 'parent', 0, NULL, 'Kusum Senarathne Dewapriya', 'K.S.Dewapriya', NULL, NULL),
(132, 'jagath.jayakody@example.com', '0780123462', '23 Hill Road, Ratnapura', 'jagathjayakody', '$2y$10$hfFXmjMV0UKTq2cj9FW77ex65ps.UdGmfLPtdMYaqnmBQCf5ON7K6', '1976-12-20', 'Male', 'Hinduism', 'parent', 0, NULL, 'Jagath Kumara Jayakody', 'J.K.Jayakody', NULL, NULL),
(133, 'deepthi.mahawela@example.com', '0701234573', '56 Beach Street, Jaffna', 'deepthimahawela', '$2y$10$mBxBrlIDqSWniK9zwU/1nu8GCyz6yj9Nt84BRqC1iHOXm8GtvfozW', '1981-04-10', 'Female', 'Hinduism', 'parent', 0, NULL, 'Deepthi Silva Mahawela', 'D.S.Mahawela', NULL, NULL),
(134, 'rohan.de_alwis@example.com', '0712345687', '45 Royal Road, Trincomalee', 'rohandealwis', '$2y$10$RW2s8eoiHBIh1hWFg5sQqu3g5l00N81yIi72bdXO1HQtZ/DubpBLq', '1978-05-15', 'Male', 'Christianity', 'parent', 0, NULL, 'Rohan Perera De Alwis', 'R.P.De Alwis', NULL, NULL),
(135, 'shyamali.kumara@example.com', '0773456788', '78 Kandy Road, Gampaha', 'shyamalikumara', '$2y$10$sVBYg8/VO0afM1NcSS9Q7.esm9/RPohxAKfN9ffhrnISadV2c3Iey', '1983-08-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Shyamali Fernando Kumara', 'S.F.Kumara', NULL, NULL),
(136, 'ananda.salgado@example.com', '0764567899', '12 Sea View, Mount Lavinia', 'anandasalgado', '$2y$10$251IeG4r6P8VifMpeSz.mOVCDBJe1pFJ1/Fhwrt221lf0tBDB.maK', '1975-01-25', 'Male', 'Christianity', 'parent', 0, NULL, 'Ananda Wijesinghe Salgado', 'A.W.Salgado', NULL, NULL),
(137, 'leela.wickramaratne@example.com', '0785678910', '90 Lotus Road, Batticaloa', 'leelawickramaratne', '$2y$10$R0L495irtOFOEoo1o7eFAe5xEPiTWnROhRBSkcnARCbyP7hYF0eKW', '1980-06-10', 'Female', 'Buddhism', 'parent', 0, NULL, 'Leela Bandara Wickramaratne', 'L.B.Wickramaratne', NULL, NULL),
(138, 'mahesh.karunaratne@example.com', '0706789020', '34 Church Street, Kalutara', 'maheshkarunaratne', '$2y$10$j2TzJH7IVBkdXg.MNjjBWe6bpouBwsTNLOfc0OxpkXLAPizmO4gVG', '1977-10-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Mahesh Gunawardena Karunaratne', 'M.G.Karunaratne', NULL, NULL),
(139, 'sriyani.liyanage@example.com', '0717890131', '78 Beach Road, Galle', 'sriyaniliyanage', '$2y$10$jIbYzlVrbzgGl5nUvjHoZuinNTkRVdKf.3MlMh/bMHm5BcfmoHSPS', '1982-03-20', 'Female', 'Christianity', 'parent', 0, NULL, 'Sriyani Rathnayake Liyanage', 'S.R.Liyanage', NULL, NULL),
(140, 'dammika.kotagama@example.com', '0778901241', '90 Park Lane, Nuwara Eliya', 'dammikakotagama', '$2y$10$nLFy6YnJCSiO.YR4AYKFgOnndkjD7JsWAt/..EwThUznuK8n8AaZi', '1979-07-25', 'Male', 'Buddhism', 'parent', 0, NULL, 'Dammika Jayasinghe Kotagama', 'D.J.Kotagama', NULL, NULL),
(141, 'padmini.wijesooriya@example.com', '0769012352', '34 Royal Road, Anuradhapura', 'padminiwijesooriya', '$2y$10$akOdF/QcylEM3dPm4J23p.PWemt0zn5PDr/Ier.S1j7hfLA9QSfJG', '1984-11-10', 'Female', 'Buddhism', 'parent', 0, NULL, 'Padmini Senarathne Wijesooriya', 'P.S.Wijesooriya', NULL, NULL),
(142, 'chandana.samarajeewa@example.com', '0780123463', '67 Ocean Drive, Trincomalee', 'chandanasamarajeewa', '$2y$10$ERutdMlnl4nfW1DdcpHu3u/baW6UDckxXColvmckcgrNdIKd.Y4SS', '1976-02-15', 'Male', 'Christianity', 'parent', 0, NULL, 'Chandana Kumara Samarajeewa', 'C.K.Samarajeewa', NULL, NULL),
(143, 'nirmala.mudannayake@example.com', '0701234574', '12 Kandy Road, Gampaha', 'nirmalamudannayake', '$2y$10$UtpRgUILdwVB7eMYRoR8turv7mUvZIKpqxb71BzrMdSpBf2bW8aTu', '1981-05-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Nirmala Silva Mudannayake', 'N.S.Mudannayake', NULL, NULL),
(144, 'suresh.peiris@example.com', '0712345688', '56 Garden Road, Badulla', 'sureshpeiris', '$2y$10$17LbQ9ym7IwCQpP652qVmetxJct/lRJMnGqTzUl2caVZhT0Dpk33.', '1978-09-25', 'Male', 'Buddhism', 'parent', 0, NULL, 'Suresh Perera Peiris', 'S.P.Peiris', NULL, NULL),
(145, 'kamala.sooriyarachchi@example.com', '0773456789', '89 Palm Grove, Puttalam', 'kamalasooriyarachchi', '$2y$10$3xJ6qC69/rzihCAr3lSMHuCZUkKnd33Vf7voPM.bX/o1qT1AfO7f6', '1983-01-10', 'Female', 'Hinduism', 'parent', 0, NULL, 'Kamala Fernando Sooriyarachchi', 'K.F.Sooriyarachchi', NULL, NULL),
(146, 'ranjith.wijemanne@example.com', '0764567900', '23 Canal Road, Moratuwa', 'ranjithwijemanne', '$2y$10$m3TCzq9zLKJoWVDWEQBBx.os5eLtm/q1ynOOJ/gBhry197ae5RKb.', '1975-04-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Ranjith Wijesinghe Wijemanne', 'R.W.Wijemanne', NULL, NULL),
(147, 'dilani.athukorala@example.com', '0785678911', '67 Orchard Lane, Hambantota', 'dilaniathukorala', '$2y$10$ZGeR8/pFoACI.OK1JAJkQ.vXh0HoR5h8WEMfYwHQkq93Qb.M2pPI6', '1980-08-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Dilani Bandara Athukorala', 'D.B.Athukorala', NULL, NULL),
(148, 'aruna.madushanka@example.com', '0706789021', '12 River Road, Polonnaruwa', 'arunamadushanka', '$2y$10$TqPb9ASe/kIYPq5m3w8nSuT/ICX8hmVh0/1Cuj4hivIxp6evqZ/fe', '1977-12-25', 'Male', 'Buddhism', 'parent', 0, NULL, 'Aruna Gunawardena Madushanka', 'A.G.Madushanka', NULL, NULL),
(149, 'sumithra.kodithuwakku@example.com', '0717890132', '12 Park Road, Negombo', 'sumithrakodithuwakku', '$2y$10$jraE/hYYtRIMGEbqrlo6O.gHaVyGH7jdu27X9M9hT6LQJIQjSb6Cm', '1982-03-10', 'Female', 'Buddhism', 'parent', 0, NULL, 'Sumithra Rathnayake Kodithuwakku', 'S.R.Kodithuwakku', NULL, NULL),
(150, 'lalith.gunathilaka@example.com', '0778901242', '45 Sea View, Mount Lavinia', 'lalithgunathilaka', '$2y$10$2M.mfnhxMUp2eubqa7RQtewbQIXSaAQmKmkKRsVcDUKDw/aNLzZpa', '1979-06-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Lalith Jayasinghe Gunathilaka', 'L.J.Gunathilaka', NULL, NULL),
(151, 'anoma.abeykoon@example.com', '0769012353', '78 Lotus Road, Batticaloa', 'anomaabeykoon', '$2y$10$ZyMiio6vqbTLR0QJ8pOInOP9aJY53c7H0p9B00gpmQJH99.YjMV6u', '1984-10-20', 'Female', 'Hinduism', 'parent', 0, NULL, 'Anoma Senarathne Abeykoon', 'A.S.Abeykoon', NULL, NULL),
(152, 'bandula.rupasinghe@example.com', '0780123464', '23 Church Street, Kalutara', 'bandularupasinghe', '$2y$10$UTFuWY1.rHh7LjlibynSZe8QHjYkzE32jIw9xl1b8xumXBCstJ8.G', '1976-02-25', 'Male', 'Buddhism', 'parent', 0, NULL, 'Bandula Kumara Rupasinghe', 'B.K.Rupasinghe', NULL, NULL),
(153, 'nilmini.wijethunga@example.com', '0701234575', '56 Garden Road, Badulla', 'nilminiwijethunga', '$2y$10$8ZbHYQLGrteMvTiT3dHSfeTcNSrbBzotsi3A8kTvdKVSPAmesanDe', '1981-05-30', 'Female', 'Buddhism', 'parent', 0, NULL, 'Nilmini Silva Wijethunga', 'N.S.Wijethunga', NULL, NULL),
(154, 'wijaya.gunarathna@example.com', '0712345689', '45 Green Lane, Avissawella', 'wijayagunarathna', '$2y$10$5zoArNhZGOf8duIM5Fra9e07sfXmPWv5xnA.JL9EIivYmhZmSj3dG', '1978-07-05', 'Male', 'Buddhism', 'parent', 0, NULL, 'Wijaya Perera Gunarathna', 'W.P.Gunarathna', NULL, NULL),
(155, 'sunethra.wimalaratne@example.com', '0773456790', '78 Mango Road, Panadura', 'sunethrawimalaratne', '$2y$10$RE1SzXwpF3ugYFd4yK7dTe9FPLO72nLYi/jPrSMWktX2NKtQ93l3O', '1983-11-10', 'Female', 'Buddhism', 'parent', 0, NULL, 'Sunethra Fernando Wimalaratne', 'S.F.Wimalaratne', NULL, NULL),
(156, 'sanjaya.jayatissa@example.com', '0764567901', '90 Coconut Grove, Chilaw', 'sanjayajayatissa', '$2y$10$5ktJHkp8/jyXPOGaebApA.1Sk/GZ5E0zyM3IIgw8jw.Wqk.AcdAvq', '1975-02-15', 'Male', 'Hinduism', 'parent', 0, NULL, 'Sanjaya Wijesinghe Jayatissa', 'S.W.Jayatissa', NULL, NULL),
(157, 'damayanthi.samarakoon@example.com', '0785678912', '34 Pine Road, Maharagama', 'damayanthisamarakoon', '$2y$10$s2Qf.JnPGGaSmr5qHIEtwuKGNrpuci/9o6659vdToDmON9J2RQVs6', '1980-06-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Damayanthi Bandara Samarakoon', 'D.B.Samarakoon', NULL, NULL),
(158, 'prasad.lakshitha@example.com', '0706789022', '56 Cedar Lane, Homagama', 'prasadlakshitha', '$2y$10$e0lJGhjgb018Ts7jBVr9WuleIBPbHufinIzc5GeivYUm6wNl4pST2', '1977-09-25', 'Male', 'Buddhism', 'parent', 0, NULL, 'Prasad Gunawardena Lakshitha', 'P.G.Lakshitha', NULL, NULL),
(159, 'ranjani.ranasinghe@example.com', '0717890133', '45 Flower Street, Matara', 'ranjaniranasinghe', '$2y$10$IQZpyzkjZK84yf0XMdFS2uJRafQyHOvzumgTcd67VbeSi.BnG6R86', '1982-01-10', 'Female', 'Hinduism', 'parent', 0, NULL, 'Ranjani Rathnayake Ranasinghe', 'R.R.Ranasinghe', NULL, NULL),
(160, 'nadeesh.amarakoon@example.com', '0778901243', '89 Palm Grove, Puttalam', 'nadeeshamarakoon', '$2y$10$z/V6hplv7dVbY7HFkGF2JexRHh/wGjBavAPsUIV343pXp846v9UYS', '1979-04-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Nadeesh Jayasinghe Amarakoon', 'N.J.Amarakoon', NULL, NULL),
(161, 'shirani.wimalasena@example.com', '0769012354', '12 Canal Road, Moratuwa', 'shiraniwimalasena', '$2y$10$9vRwM4oHckf3o4FKJBHtoe7rJ5iYivwselWvxWCZR2q8IX7YTayLe', '1984-08-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Shirani Senarathne Wimalasena', 'S.S.Wimalasena', NULL, NULL),
(162, 'sumith.desilva@example.com', '0780123465', '67 Orchard Lane, Hambantota', 'sumithdesilva', '$2y$10$FesybTRv7JIai3FHVlKVhecxfCsZtQjEgL54M20d7KsFmYkLyDcx2', '1976-11-25', 'Male', 'Christianity', 'parent', 0, NULL, 'Sumith Kumara Desilva', 'S.K.Desilva', NULL, NULL),
(163, 'geethika.wijegunawardana@example.com', '0701234576', '34 River Road, Polonnaruwa', 'geethikawijegunawardana', '$2y$10$LNn74e6T88fazaHvQAeVzerws09CPDDLTNXTQFb2nySnwA5.9YFYa', '1981-03-10', 'Female', 'Buddhism', 'parent', 0, NULL, 'Geethika Silva Wijegunawardana', 'G.S.Wijegunawardana', NULL, NULL),
(164, 'lalinda.wijesundara@example.com', '0712345690', '89 Ocean Drive, Ambalangoda', 'lalindawijesundara', '$2y$10$KprYbEHfXvuSBhGBTdL6/OWlTuWIrp8DePpL9/Nl6XyJFNJj4Ysly', '1978-05-15', 'Male', 'Buddhism', 'parent', 0, NULL, 'Lalinda Perera Wijesundara', 'L.P.Wijesundara', NULL, NULL),
(165, 'champa.herath@example.com', '0773456791', '23 Star Road, Kuliyapitiya', 'champaherath', '$2y$10$4f1TJgli4Rm/5xcKAzTAXeFAX1uSVsf2L.ZQ0PZfMd9XDZQ/QyVqC', '1983-09-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Champa Fernando Herath', 'C.F.Herath', NULL, NULL),
(166, 'somasiri.bandara@example.com', '0764567902', '67 Rose Lane, Horana', 'somasiribandara', '$2y$10$qC1CHkqkXou4T5jc30fPC.LJMwfGz7VskEdTQxMhqLiUzNGFaYogy', '1975-01-25', 'Male', 'Buddhism', 'parent', 0, NULL, 'Somasiri Wijesinghe Bandara', 'S.W.Bandara', NULL, NULL),
(167, 'kanthi.vithanage@example.com', '0785678913', '12 Maple Road, Dehiwala', 'kanthivithanage', '$2y$10$VCGrtIL8.zoD3Ev4Gl/che0XUNSaKcpKUSqwyKQPwYG4p2o2EeDLK', '1980-06-10', 'Female', 'Christianity', 'parent', 0, NULL, 'Kanthi Bandara Vithanage', 'K.B.Vithanage', NULL, NULL),
(168, 'sujatha.kulatunga@example.com', '0706789023', '45 Oak Street, Borella', 'sujathakulatunga', '$2y$10$B/zG79eiZ5gY.k6Zr5yhgek9CeN2knX8xhxO4i5/DeauVsDf/II4a', '1977-10-15', 'Female', 'Buddhism', 'parent', 0, NULL, 'Sujatha Gunawardena Kulatunga', 'S.G.Kulatunga', NULL, NULL),
(169, 'sundara.weerasekara@example.com', '0717890134', '45 Flower Street, Matara', 'sundaraweerasekara', '$2y$10$/b7YZ/QIg15kPxpnYHRiVOG9yGN6dCawRq9fVyZSLJzuyB2XVpmCO', '1979-02-20', 'Male', 'Hinduism', 'parent', 0, NULL, 'Sundara Rathnayake Weerasekara', 'S.R.Weerasekara', NULL, NULL),
(170, 'dayani.koswatta@example.com', '0778901244', '45 Green Lane, Avissawella', 'dayanikoswatta', '$2y$10$CNmiG4jGJCWJIYUfYhc1w.FB5dJ6lcPFBd9mRj.KkIKIuJ5Y4q1QW', '1984-04-25', 'Female', 'Buddhism', 'parent', 0, NULL, 'Dayani Jayasinghe Koswatta', 'D.J.Koswatta', NULL, NULL),
(171, 'siripala.seneviratne@example.com', '0769012355', '78 Mango Road, Panadura', 'siripalaseneviratne', '$2y$10$hDu66.EO8pgHH2JsUPNHle6QBYTOREXH6N2UZETEtWRZreToD2ip6', '1976-08-10', 'Male', 'Buddhism', 'parent', 0, NULL, NULL, NULL, NULL, NULL),
(172, 'wijitha.guruge@example.com', '0780123466', '90 Coconut Grove, Chilaw', 'wijithaguruge', '$2y$10$egZlKNKwgkHAbfcoKk3KhOoEO.xsCNy4MJo4FSwDmFqyAXlu9fnDK', '1981-11-15', 'Female', 'Hinduism', 'parent', 0, NULL, 'Wijitha Kumara Guruge', 'W.K.Guruge', NULL, NULL),
(173, 'nandani.yapa@example.com', '0701234577', '12 Pine Road, Maharagama', 'nandaniyapa', '$2y$10$oM/tIF0U0NsiJxq3uEGlN.QkLongtO5anfosLACdFVf4.bR6gv6V6', '1978-03-20', 'Female', 'Buddhism', 'parent', 0, NULL, 'Nandani Silva Yapa', 'N.S.Yapa', NULL, NULL),
(174, 'dinuka.perera@example.com', '0713456789', '123 Galle Rd', NULL, '$2y$10$4fABfuq.Ki7UUUDu.kHa4OCOtoXHo3QonQ7XPa0qQ7aGrZeZOStDa', '2005-05-15', 'Male', 'Buddhism', 'student', 0, NULL, 'Dinuka Perera', 'D. Perera', NULL, NULL),
(175, 'anjali.fernando@example.com', '0724567890', '456 Kandy Rd', NULL, '$2y$10$KRcplIq/LdGII9o5ZHuxcu.PsXdq.HKHyB6aeVnYn04vvNDVDA.WW', '1975-10-20', 'Female', 'Christianity', 'parent', 0, NULL, 'Anjali Fernando', 'A. Fernando', NULL, NULL),
(176, 'tharindu.jayasinghe@example.com', '0734567891', '789 Main St', NULL, '$2y$10$gFg7yD5RX5ClEC.TA8T.C.P0C5uqTZSWzAK5v1M.OFGnwkb52Apdm', '2006-03-10', 'Male', 'Buddhism', 'student', 0, NULL, 'Tharindu Jayasinghe', 'T. Jayasinghe', NULL, NULL),
(177, 'nihal.jayasinghe@example.com', '0745678901', '789 Main St', NULL, '$2y$10$lBTjdDO.hHwtQSgVPK4DJ.gwrxukk2AFu6gsfHoayBm0ZsiaMkQTq', '1970-08-05', 'Male', 'Buddhism', 'parent', 0, NULL, 'Nihal Jayasinghe', 'N. Jayasinghe', NULL, NULL),
(178, 'sanduni.wijesinghe@example.com', '0756789012', '101 Lake Rd', NULL, '$2y$10$RLAcHc0s6nbPWgcS.P4jZu4RNLil7csIKtLBLQpEEJkIGigKghk9O', '2005-11-30', 'Female', 'Christianity', 'student', 0, NULL, 'Sanduni Wijesinghe', 'S. Wijesinghe', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `viceprincipals`
--

CREATE TABLE `viceprincipals` (
  `vicePrincipalId` int(11) NOT NULL,
  `regNo` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `experience` int(11) NOT NULL,
  `hireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`absence_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_createdBy` (`created_by`);

--
-- Indexes for table `backupusers`
--
ALTER TABLE `backupusers`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `character_allocated_time`
--
ALTER TABLE `character_allocated_time`
  ADD PRIMARY KEY (`allocated_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `certificate_id` (`certificate_id`);

--
-- Indexes for table `character_certificates`
--
ALTER TABLE `character_certificates`
  ADD PRIMARY KEY (`certificate_id`),
  ADD KEY `fk_character_certificates_student` (`student_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classId`),
  ADD UNIQUE KEY `className` (`className`);

--
-- Indexes for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD PRIMARY KEY (`classId`),
  ADD KEY `class_teacher_ibfk_2` (`teacher_id`);

--
-- Indexes for table `current_activity`
--
ALTER TABLE `current_activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`);

--
-- Indexes for table `facility_charges`
--
ALTER TABLE `facility_charges`
  ADD PRIMARY KEY (`payment_id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`year_of_payment`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_parentRegNo` (`parentRegNo`);

--
-- Indexes for table `leaving_allocated_time`
--
ALTER TABLE `leaving_allocated_time`
  ADD PRIMARY KEY (`allocated_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `certificate_id` (`certificate_id`);

--
-- Indexes for table `leaving_certificates`
--
ALTER TABLE `leaving_certificates`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `classId` (`classId`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `nonacademicstaff`
--
ALTER TABLE `nonacademicstaff`
  ADD PRIMARY KEY (`staffId`),
  ADD UNIQUE KEY `regNo` (`regNo`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`regNo`);

--
-- Indexes for table `parent_students`
--
ALTER TABLE `parent_students`
  ADD PRIMARY KEY (`parentRegNo`,`studentRegNo`),
  ADD KEY `studentRegNo` (`studentRegNo`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`periodId`),
  ADD UNIQUE KEY `periodName` (`periodName`);

--
-- Indexes for table `principals`
--
ALTER TABLE `principals`
  ADD PRIMARY KEY (`principalId`),
  ADD UNIQUE KEY `regNo` (`regNo`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `regNo` (`regNo`),
  ADD KEY `classId` (`classId`),
  ADD KEY `guardianRegNo` (`guardianRegNo`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectId`),
  ADD UNIQUE KEY `subjectName` (`subjectName`);

--
-- Indexes for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_class_id` (`class_id`),
  ADD KEY `fk_subject_id` (`subject_id`);

--
-- Indexes for table `teacherattendance`
--
ALTER TABLE `teacherattendance`
  ADD PRIMARY KEY (`attendanceId`),
  ADD UNIQUE KEY `teacherRegNo` (`teacherRegNo`,`date`),
  ADD KEY `recordedBy` (`recordedBy`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `regNo` (`regNo`);

--
-- Indexes for table `teacher_specializations`
--
ALTER TABLE `teacher_specializations`
  ADD PRIMARY KEY (`regNo`,`subjectId`),
  ADD KEY `subjectId` (`subjectId`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD PRIMARY KEY (`teacherRegNo`,`subjectId`),
  ADD KEY `subjectId` (`subjectId`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`timetableId`),
  ADD KEY `classId` (`classId`),
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `periodId` (`periodId`),
  ADD KEY `timetables_ibfk_3` (`teacherRegNo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`regNo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `viceprincipals`
--
ALTER TABLE `viceprincipals`
  ADD PRIMARY KEY (`vicePrincipalId`),
  ADD UNIQUE KEY `regNo` (`regNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `absence_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `backupusers`
--
ALTER TABLE `backupusers`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `character_allocated_time`
--
ALTER TABLE `character_allocated_time`
  MODIFY `allocated_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `current_activity`
--
ALTER TABLE `current_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `facility_charges`
--
ALTER TABLE `facility_charges`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaving_allocated_time`
--
ALTER TABLE `leaving_allocated_time`
  MODIFY `allocated_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaving_certificates`
--
ALTER TABLE `leaving_certificates`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `nonacademicstaff`
--
ALTER TABLE `nonacademicstaff`
  MODIFY `staffId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `periodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `principals`
--
ALTER TABLE `principals`
  MODIFY `principalId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `subject_class`
--
ALTER TABLE `subject_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teacherattendance`
--
ALTER TABLE `teacherattendance`
  MODIFY `attendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `timetableId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `regNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `viceprincipals`
--
ALTER TABLE `viceprincipals`
  MODIFY `vicePrincipalId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `fk_createdBy` FOREIGN KEY (`created_by`) REFERENCES `users` (`regNo`);

--
-- Constraints for table `character_certificates`
--
ALTER TABLE `character_certificates`
  ADD CONSTRAINT `fk_character_certificates_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `class_teacher`
--
ALTER TABLE `class_teacher`
  ADD CONSTRAINT `class_teacher_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`),
  ADD CONSTRAINT `class_teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE;

--
-- Constraints for table `facility_charges`
--
ALTER TABLE `facility_charges`
  ADD CONSTRAINT `fk_facility_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `fk_parentRegNo` FOREIGN KEY (`parentRegNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`),
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subjectId`);

--
-- Constraints for table `nonacademicstaff`
--
ALTER TABLE `nonacademicstaff`
  ADD CONSTRAINT `nonacademicstaff_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE;

--
-- Constraints for table `parent_students`
--
ALTER TABLE `parent_students`
  ADD CONSTRAINT `parent_students_ibfk_1` FOREIGN KEY (`parentRegNo`) REFERENCES `parents` (`regNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `parent_students_ibfk_2` FOREIGN KEY (`studentRegNo`) REFERENCES `students` (`regNo`) ON DELETE CASCADE;

--
-- Constraints for table `principals`
--
ALTER TABLE `principals`
  ADD CONSTRAINT `principals_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`guardianRegNo`) REFERENCES `parents` (`regNo`) ON DELETE CASCADE;

--
-- Constraints for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD CONSTRAINT `fk_class_id` FOREIGN KEY (`class_id`) REFERENCES `classes` (`classId`),
  ADD CONSTRAINT `fk_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subjectId`);

--
-- Constraints for table `teacherattendance`
--
ALTER TABLE `teacherattendance`
  ADD CONSTRAINT `teacherattendance_ibfk_1` FOREIGN KEY (`teacherRegNo`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacherattendance_ibfk_2` FOREIGN KEY (`recordedBy`) REFERENCES `nonacademicstaff` (`staffId`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_specializations`
--
ALTER TABLE `teacher_specializations`
  ADD CONSTRAINT `teacher_specializations_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_specializations_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  ADD CONSTRAINT `teacher_subjects_ibfk_1` FOREIGN KEY (`teacherRegNo`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_subjects_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE;

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetables_ibfk_2` FOREIGN KEY (`subjectId`) REFERENCES `subjects` (`subjectId`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetables_ibfk_3` FOREIGN KEY (`teacherRegNo`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `timetables_ibfk_4` FOREIGN KEY (`periodId`) REFERENCES `periods` (`periodId`) ON DELETE CASCADE;

--
-- Constraints for table `viceprincipals`
--
ALTER TABLE `viceprincipals`
  ADD CONSTRAINT `viceprincipals_ibfk_1` FOREIGN KEY (`regNo`) REFERENCES `users` (`regNo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
