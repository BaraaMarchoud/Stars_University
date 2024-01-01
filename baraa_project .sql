-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 03:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baraa_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(76152249, 'Baraa', 'baraa.marchoudd@gmail.com', '$2y$10$jOaan0kADzdJ3rjkPtJa3O28IhqssT4/M7WBikN4taoWSZcZzwwNy');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `credit_hour` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `teacher_id`, `description`, `credit_hour`) VALUES
('CSCI205', 'Computer Science Overview', 72130402, 'This course must be taken by every computer scientest, it gives an overviw about the computer Science major', 3),
('CSCI250', 'Inroduction to programming', 72130400, 'This course gives an overview of operating system functions, goals, and key components. Discussion of the role of operating systems in managing hardware resources, providing an interface between users and the system, and facilitating process execution.', 3),
('CSCI278', 'Data Structures and Algorithms', 72130401, 'A data structures course is typically a fundamental course offered in computer science or related disciplines. It focuses on teaching students about various techniques and tools used to organize and manipulate data efficiently. The course covers a wide range of data structures, algorithms, and their associated operations and applications.', 3),
('CSCI300', 'Intermediate Programming with Objects', 72130401, 'This course helps Students gain a deeper understanding of object-oriented programming principles, such as encapsulation, inheritance, and polymorphism. They learn how to model real-world entities as objects and how to interact with these objects using methods and attributes.', 3),
('CSCI335', 'Database Systems', 72130399, 'This course gives an overview of the role and importance of databases in modern applications', 3),
('CSCI345', 'Digital Logic', 72130402, 'This course typically covers the fundamental principles and concepts of digital circuits and systems. It forms the basis for understanding the design and operation of digital electronic devices, such as computers, microprocessors, and digital communication systems.', 3),
('CSCI390', 'Web Programming', 72130399, 'This course opens web development doors for you, you start using html, css, and javascript here.', 3),
('CSCI392', 'Computer Networks', 72130406, 'A computer networks course is designed to provide students with a comprehensive understanding of the principles, protocols, and technologies used in computer networks. It explores the field of networking, which involves the interconnection of computers and other devices to facilitate communication and data sharing.', 3),
('CSCI426', 'Operating System', 72130399, 'This course gives an overview of operating system functions, goals, and key components. Discussion of the role of operating systems in managing hardware resources, providing an interface between users and the system, and facilitating process execution.', 3),
('CSCI475', 'Artificial Intelligence', 72130404, 'An artificial intelligence (AI) course is designed to provide students with a comprehensive understanding of the theories, algorithms, and applications of artificial intelligence. It explores the field of AI, which focuses on creating intelligent machines that can perform tasks that typically require human intelligence.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments_courses`
--

CREATE TABLE `enrollments_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments_courses`
--

INSERT INTO `enrollments_courses` (`id`, `student_id`, `course_id`) VALUES
(132, 52130230, 'CSCI205'),
(137, 52130001, 'CSCI205'),
(127, 52130367, 'CSCI250'),
(131, 52130230, 'CSCI250'),
(141, 52130367, 'CSCI278'),
(139, 52130001, 'CSCI300'),
(128, 52130367, 'CSCI335'),
(133, 52130230, 'CSCI335'),
(138, 52130001, 'CSCI335'),
(134, 52130230, 'CSCI345'),
(146, 52130367, 'CSCI345'),
(124, 52130164, 'CSCI390'),
(135, 52130230, 'CSCI390'),
(142, 52130367, 'CSCI392');

-- --------------------------------------------------------

--
-- Table structure for table `liked_courses`
--

CREATE TABLE `liked_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `liked_courses`
--

INSERT INTO `liked_courses` (`id`, `student_id`, `course_id`) VALUES
(29, 52130367, 'CSCI205'),
(37, 52130001, 'CSCI205'),
(34, 52130001, 'CSCI250'),
(43, 52130367, 'CSCI250'),
(44, 52130367, 'CSCI278'),
(16, 52130230, 'CSCI300'),
(32, 52130367, 'CSCI300'),
(36, 52130001, 'CSCI345'),
(40, 52130367, 'CSCI345'),
(17, 52130230, 'CSCI390'),
(33, 52130367, 'CSCI390'),
(35, 52130001, 'CSCI390');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `major` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `major`, `email`, `Password`) VALUES
(32031157, 'Sara Ghazal', 'IT', '32031157@students.liu.edu.lb', '$2y$10$6KpQ/Js4aWwteygT8OoVgObRRd5jW53tuTByIhG04CDkf5eHFFBdq'),
(52130000, 'Samar Al-Miari', 'Graphic Design', '52130000@students.liu.edu.lb', '$2y$10$81n6K0whvTmL8dOGzmUhMeZJct6WK5/xBZVCVSu1kXpF//s/jtY2i'),
(52130001, 'Ahmad Marchoudd', 'Chemistry', '52130001@students.liu.edu.lb', '$2y$10$sQKZ0E.Mstr0oMR7KR28E.9BctMab0AuWpc.//QES8umGtJ6fExEW'),
(52130002, 'Raghad AbuEid', 'Computer Science', '52130002@students.liu.edu.lb', '$2y$10$SQaRqPnmSH/SY8YASu8SSOCOvIGYBEh7MU/d2bSloq1xFzvNBt/oq'),
(52130007, 'Mohammad Nejim', 'Computer Science', '52130007@students.liu.edu.lb', '$2y$10$bv/OUX4Avfhw2yH0ics39eO9x2KfsC/Xr.emlG9Ep0Wid3GMOayti'),
(52130008, 'Ahmad Abdullatif', 'Computer Science', '5213008@students.liu.edu.lb', '$2y$10$cmSwSNIFc5tNbDJ3YREvReEfLaJr6hITuHDCB6tH2Tfwu5p6TRRkG'),
(52130164, 'Alaa Rabie', 'Computer Science', '52130164@students.liu.edu.lb', '$2y$10$qAb0NfG2gnAi8SzASeWpIOkxsGw2QBVPIN2vdykBOTfjIKL42MiHi'),
(52130230, 'Mohammad Saadi', 'Computer Science', '52130230@students.liu.edu.lb', '$2y$10$xCLpw831q/zm0eIy4LVz6elaotvLG1WclJO/ZCZbra0p3o1yQhP4O'),
(52130233, 'Mohammad El-Saadi', 'IT', '52130233@students.lie.edu.lb', '$2y$10$O24xEfXXYWbbC7XgyDGFmuFLxzj5JhCdp8cKEprf3UXmb45Tp4sw.'),
(52130234, 'Hadi Fayez', 'Computer Science	', '52130234@students.liu.edu.lb', '$2y$10$7KZSbi8LEyPIoIMg06.Ct.sLQc9p8w3rGuv57.FoSAEhedgRx0cKq'),
(52130329, 'Maria Khawaled', 'Computer Science', '52130329@students.liu.edu.lb', '$2y$10$t2ejm9hxMNk2w5z5KHI5luGXez4/fIjP14Y7V90tF4FrUGWuAE7GS'),
(52130367, 'Baraa Marchoudd', 'Computer Science', '52130367@students.liu.edu.lb', '$2y$10$1Ed22a8F6HyWf3r/IU4BXO707BZooVzzV/E1E/WylFAg3KnQX09q2');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `profession` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `experience year` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `profession`, `email`, `password`, `experience year`) VALUES
(72130399, 'Mahmoud Samadd', 'DataBase', '72130399@liu.edu.lb', '$2y$10$Cry7Rs6nsLuUGRr8ToPgrOb9PfQxUwQmg1d9ms8LCSTjfN/r0z5Ym', 10),
(72130400, 'Yousuf Traboulsi', 'web development', '72130400@liu.edu.lb', '$2y$10$qEnq5d5UXgdWmTgG/itdIeUsR/O73e1OA7pfQwIxsdd1OgADlpMbK', 5),
(72130401, 'Mirna Moukhtar', 'Java', '72130401@liu.edu.lb', '$2y$10$C/UzuNJX8NbOpROhQuMJ0uQ2xZc/LZ8Ihko8qsw/4gJGTf1YuTo5G', 7),
(72130402, 'Haissam Kharbouty', 'Computer Science', '72130402@liu.edu.lb', '$2y$10$Y0V/l2UaP1YF2Si9rlG6QeQpUiD.p0u6eAz6jzTuXUYQSXqQ/cLBa', 5),
(72130403, 'Ihab Agha', 'Networking', '72130403@liu.edu.lb', '$2y$10$H79JrUaA5SjykeaUBt1yBOmciuLII/meKnENpeEi1v1rpatscRV2a', 7),
(72130404, 'Abdulrahman Al-Sayyed', 'Artificial Intelligence', '72130404@liu.edu.lb', '$2y$10$qXJGLsJUubU.43V8iDo9Reb1Osg9hhUyC8nhcbUQlN9pgHUtIisvW', 7),
(72130406, 'Samir Masri', 'Networking', '72130406@liu.edu.lb', '$2y$10$7pg5tKy5U28VnOpnFMxoVuMDKDHpetY/98Cel69SpHLi2Js0IiLlW', 15);

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `course_id` varchar(30) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `pdf` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_files`
--

INSERT INTO `uploaded_files` (`course_id`, `teacher_id`, `pdf`) VALUES
('CSCI278', 72130401, 'Assignment 5.pdf'),
('CSCI335', 72130399, 'Ass.docx'),
('CSCI335', 72130399, 'Assignment.docx'),
('CSCI335', 72130399, 'Doc2.docx'),
('CSCI335', 72130399, 'Sample Test.pdf'),
('CSCI392', 72130406, 'CSCI392 Sample Final Exam+solution.pdf'),
('CSCI392', 72130406, 'Fall-CSCI392-Final2020.docx'),
('CSCI392', 72130406, 'Spring-CSCI392-Final2020.pdf'),
('CSCI475', 72130404, 'Spring-CSCI475-Midterm2022 (1).pdf'),
('CSCI475', 72130404, 'Spring-CSCI475-Summer2022.docx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `enrollments_courses`
--
ALTER TABLE `enrollments_courses`
  ADD PRIMARY KEY (`id`,`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `liked_courses`
--
ALTER TABLE `liked_courses`
  ADD PRIMARY KEY (`id`,`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`course_id`,`teacher_id`,`pdf`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrollments_courses`
--
ALTER TABLE `enrollments_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `liked_courses`
--
ALTER TABLE `liked_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72130407;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollments_courses`
--
ALTER TABLE `enrollments_courses`
  ADD CONSTRAINT `enrollments_courses_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_courses_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `liked_courses`
--
ALTER TABLE `liked_courses`
  ADD CONSTRAINT `liked_courses_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liked_courses_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD CONSTRAINT `uploaded_files_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uploaded_files_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
