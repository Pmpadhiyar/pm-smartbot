-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2025 at 04:42 PM
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
-- Database: `pmp_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`, `full_name`, `email`, `created_at`) VALUES
(1, 'admin', 'Admin@81', 'Super Admin', 'admin@example.com', '2025-10-25 02:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `seen` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `mobile`, `subject`, `message`, `seen`, `created_at`) VALUES
(1, 'Ramesh', 'ramesh@example.com', '8121122334', 'Course enquiry', 'Please send course details.', 1, '2025-10-25 02:08:17'),
(2, 'Pravin Padhiyar', 'pmpadhiyar52@gmail.com', '08128676273', 'frffeff', 'deded', 1, '2025-10-26 08:52:07'),
(3, 'Pravin Padhiyar', 'pmpadhiyar52@gmail.com', '08128676273', 'frffeff', 'deded', 1, '2025-10-26 08:52:09'),
(4, 'Pravin Padhiyar', 'pmpadhiyar52@gmail.com', '08128676273', 'swerw4', 'aqwqeqeqwew', 1, '2025-10-26 08:52:40'),
(6, 'Arvindbhai Dineshbhai Padhiyar', 'pmpadhiyar52@gmail.com', '08511761709', 'aaa', 'dd', 1, '2025-10-28 09:32:11'),
(7, 'Drashti', 'dr@gmail.com', '8347108513', 'gvbjhnk', 'wewq', 1, '2025-10-30 07:20:57'),
(8, 'hhh', 'bhwd@gmail.com', '768376e572', 'jhbjshA', 'bjh bh', 1, '2025-10-30 08:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `duration` varchar(80) DEFAULT NULL,
  `fees` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `description`, `duration`, `fees`, `created_at`, `updated_at`) VALUES
(2, 'Frontend Basics (HTML, CSS, JS)', 'frontend-basics', 'HTML, CSS, JavaScript fundamentals', '1.5 months', 8000.00, '2025-10-25 02:08:17', NULL),
(5, 'MERN Stack', 'mern-stack-development', 'The MERN Stack (MongoDB, Express.js, React, Node.js) is one of the most popular full-stack development technologies. In this course, you’ll learn how to build modern, scalable, and dynamic web applications from scratch using JavaScript both on frontend and backend. You’ll also learn REST API, Authentication, MongoDB CRUD, and React integration.', '8 months', 20000.00, '2025-10-25 04:19:36', '2025-10-30 08:07:39'),
(7, 'PHP Full Stack Development', 'php-full-stack-development', 'Learn how to build professional web applications using PHP, MySQL, HTML, CSS, JavaScript, and Bootstrap. This course covers backend and frontend concepts including CRUD operations, login systems, and database management. Ideal for beginners aiming for backend web development jobs.', '6 months', 18000.00, '2025-10-30 08:08:55', NULL),
(8, 'Python with Django Framework', 'python-with-django', 'This course introduces Python programming and Django framework for web development. You’ll learn to create powerful backend systems, handle forms, authentication, REST APIs, and database models efficiently. Perfect for building scalable web apps.', '7 months', 22000.00, '2025-10-30 08:10:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_date` datetime DEFAULT current_timestamp(),
  `payment_method` varchar(80) DEFAULT 'cash',
  `note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `company` varchar(150) NOT NULL,
  `role` varchar(150) DEFAULT NULL,
  `salary` varchar(80) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `student_id`, `company`, `role`, `salary`, `photo`, `joining_date`, `created_at`) VALUES
(3, 3, 'ExelCet', 'Software Engeener', '25000', 'assets/images/1761888374_4753.jpg', NULL, '2025-10-26 03:27:32'),
(6, 8, 'Ziaat', 'Php Developer', '10000', '', NULL, '2025-10-26 03:32:34'),
(7, 7, 'TCS', 'Backend Developer', '12000', 'assets/images/1761890563_9246.jpg', NULL, '2025-10-26 03:33:03'),
(8, 9, 'RMD', 'Backend Developer', '35000', 'assets/images/1761891743_1032.jpg', NULL, '2025-10-31 06:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
  `message` text DEFAULT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `student_id`, `name`, `rating`, `message`, `approved`, `created_at`) VALUES
(1, NULL, 'Bhavesh Patel', 5, 'Great course and support!', 1, '2025-10-25 02:08:17'),
(3, NULL, 'Pravin Padhiyar', 5, 'nice\r\n', 1, '2025-10-26 04:10:19'),
(4, NULL, 'Dipak Purani', 5, 'Good', 1, '2025-10-26 04:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `course_id` int(10) UNSIGNED DEFAULT NULL,
  `paid_fees` decimal(10,2) DEFAULT 0.00,
  `pending_fees` decimal(10,2) DEFAULT 0.00,
  `join_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `photo`, `mobile`, `email`, `course_id`, `paid_fees`, `pending_fees`, `join_date`, `created_at`) VALUES
(3, 'Pravin Padhiyar', 'pravin.jpg', '8128676273', 'pmpadhiyar52@gmail.com', 2, 2000.00, 6000.00, '0000-00-00', '2025-10-25 04:18:57'),
(7, 'Naresh Bajak', 'naresh.jpg', '9313732642', 'Naresh@66gmail.com', 2, 0.00, 8000.00, '2025-10-08', '2025-10-26 03:31:24'),
(8, 'Vishnu Padhiyar', 'vishnu.jpg', '123456987', 'bhavun@gmail.com', 5, 0.00, 20000.00, '0000-00-00', '2025-10-26 03:32:02'),
(9, 'Ashvin Padhiyar', 'ashvin.jpg', '8511429521', 'ashvin@gmail.com', 5, 0.00, 20000.00, NULL, '2025-10-26 08:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `course` varchar(100) NOT NULL,
  `total_fees` decimal(10,2) NOT NULL,
  `paid_fees` decimal(10,2) NOT NULL,
  `pending_fees` decimal(10,2) NOT NULL,
  `admission_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
