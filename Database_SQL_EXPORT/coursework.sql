-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 11:43 PM
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
-- Database: `coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` bigint(20) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`) VALUES
(1, 'Programming Foundations'),
(2, 'Principles of Software Engineering'),
(3, 'Study Skills for University Success'),
(4, 'Academic English for Non-Business'),
(5, 'Networking'),
(6, 'Working in Group'),
(7, 'Vovinam 1'),
(8, 'Systems Development'),
(9, 'Mathematics for Computer Science'),
(10, 'Introduction to Computer Science and its Applications'),
(11, 'Object Oriented Programming'),
(12, 'Principles of Security'),
(13, 'Computer Systems and Internet Technologies'),
(14, 'Vovinam 2'),
(15, 'Vovinam 3'),
(16, 'User Interface Design'),
(17, 'Web Programming 1'),
(18, 'Professional Project Management'),
(19, 'Application Development'),
(20, 'Data and Web Analytics'),
(21, 'Agile Development with SCRUM'),
(22, 'Web Programming 2'),
(23, 'Information Analysis and Visualisation'),
(24, 'Data Structures & Algorithms'),
(25, 'Human Computer Interaction and Design'),
(26, 'Information and Content Management'),
(27, 'Final Year Projects Part 1'),
(28, 'Final Year Projects Part 2'),
(29, 'Requirements Management'),
(30, 'Mobile Application Design And Development'),
(31, 'On the Job Training'),
(32, 'Project');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `post_caption` text DEFAULT NULL,
  `post_created_day` date NOT NULL,
  `post_created_time` time DEFAULT NULL,
  `post_last_modified` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `repost_check` tinyint(1) DEFAULT 0,
  `original_post_id` bigint(20) DEFAULT NULL,
  `repost_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `repost_date` date DEFAULT NULL,
  `repost_time` time DEFAULT NULL,
  `repost_caption` text DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `repost_module_id` bigint(20) NOT NULL,
  `module_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_caption`, `post_created_day`, `post_created_time`, `post_last_modified`, `user_id`, `repost_check`, `original_post_id`, `repost_user_id`, `repost_date`, `repost_time`, `repost_caption`, `img_path`, `repost_module_id`, `module_id`) VALUES
(1, 'Exploring PHP for web development.', '2024-12-01', '09:00:00', '2024-12-01', 1, 0, NULL, NULL, NULL, NULL, NULL, 'post1.png', 0, 1),
(2, 'CSS tricks for better web design.', '2024-12-02', '10:30:00', '2024-12-02', 2, 0, NULL, NULL, NULL, NULL, NULL, 'post2.jpg', 0, 2),
(3, 'Understanding JavaScript events.', '2024-12-03', '11:45:00', '2024-12-03', 3, 0, NULL, NULL, NULL, NULL, NULL, 'post3.png', 0, 3),
(4, 'The importance of database design.', '2024-12-04', '14:15:00', '2024-12-04', 4, 0, NULL, NULL, NULL, NULL, NULL, 'post4.jpg', 0, 4),
(5, 'How to build responsive layouts.', '2024-12-05', '15:00:00', '2024-12-05', 5, 0, NULL, NULL, NULL, NULL, NULL, 'post5.png', 0, 5),
(6, 'Bootstrap tips for quick styling.', '2024-12-06', '09:30:00', '2024-12-06', 6, 0, NULL, NULL, NULL, NULL, NULL, 'post6.jpg', 0, 6),
(7, 'Improving backend performance.', '2024-12-07', '13:00:00', '2024-12-07', 7, 0, NULL, NULL, NULL, NULL, NULL, 'post7.jpg', 0, 7),
(8, 'Differences between SQL and NoSQL.', '2024-12-08', '16:20:00', '2024-12-08', 8, 0, NULL, NULL, NULL, NULL, NULL, 'post8.jpg', 0, 8),
(9, 'Differences between SQL and NoSQL.', '2024-12-08', '16:20:00', '2024-12-08', 8, 1, 8, 1, '2024-12-11', NULL, 'test repost function ', 'post8.jpg', 3, 8),
(10, 'Differences between SQL and NoSQL.', '2024-12-08', '16:20:00', '2024-12-08', 8, 1, 9, 1, '2024-12-11', NULL, 'test repost a repost\r\n', 'post8.jpg', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_tag` varchar(50) NOT NULL,
  `user_dob` date DEFAULT NULL,
  `user_gender` enum('Male','Female','Other') NOT NULL,
  `user_mail` varchar(50) DEFAULT NULL,
  `account_created_day` date NOT NULL,
  `account_last_modified` date DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_tag`, `user_dob`, `user_gender`, `user_mail`, `account_created_day`, `account_last_modified`, `password`, `avatar`) VALUES
(1, 'Admin', 'admin', '1990-01-01', 'Male', 'duongnnhgch230313@fpt.edu.vn', '2024-01-01', '2024-12-10', 'e10adc3949ba59abbe56e057f20f883e', 'pic1.png'),
(2, 'Jane Smith', 'janesmith', '1995-10-20', 'Female', 'janesmith@example.com', '2024-01-02', '2024-01-02', 'e10adc3949ba59abbe56e057f20f883e', 'pic2.png'),
(3, 'Alice Brown', 'alicebrown', '1992-08-12', 'Female', 'alicebrown@example.com', '2024-01-03', '2024-01-03', 'e10adc3949ba59abbe56e057f20f883e', 'pic3.png'),
(4, 'Bob Green', 'bobgreen', '1988-07-01', 'Male', 'bobgreen@example.com', '2024-01-04', '2024-01-04', 'e10adc3949ba59abbe56e057f20f883e', 'pic4.png'),
(5, 'Charlie White', 'charliewhite', '1999-02-28', 'Male', 'charliewhite@example.com', '2024-01-05', '2024-01-05', 'e10adc3949ba59abbe56e057f20f883e', 'pic5.png'),
(6, 'Diana Prince', 'dianaprince', '1991-06-30', 'Female', 'dianaprince@example.com', '2024-01-06', '2024-01-06', 'e10adc3949ba59abbe56e057f20f883e', 'pic6.png'),
(7, 'Eve Black', 'eveblack', '1994-03-14', 'Female', 'eveblack@example.com', '2024-01-07', '2024-01-07', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(8, 'Frank Miller', 'frankmiller', '1985-09-22', 'Male', 'frankmiller@example.com', '2024-01-08', '2024-01-08', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(9, 'Grace Kelly', 'gracekelly', '1997-12-05', 'Female', 'gracekelly@example.com', '2024-01-09', '2024-01-09', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(10, 'Henry Ford', 'henryford', '1980-11-11', 'Male', 'henryford@example.com', '2024-01-10', '2024-01-10', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(11, 'John Doe', 'johndoe', '1990-05-15', 'Male', 'johndoe@example.com', '2024-01-01', '2024-01-01', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(19, 'Hoang Duong', 'HelloDuongNha', '2005-06-13', 'Male', 'hoangzuong9a1306@gmail.com', '2024-12-11', NULL, 'e10adc3949ba59abbe56e057f20f883e', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_repost_user` (`repost_user_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `fk_repost_module_id` (`repost_module_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_user_tag` (`user_tag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_module_id` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`),
  ADD CONSTRAINT `fk_repost_module_id` FOREIGN KEY (`repost_module_id`) REFERENCES `modules` (`module_id`),
  ADD CONSTRAINT `fk_repost_user` FOREIGN KEY (`repost_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
