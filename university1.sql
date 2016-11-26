-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2016 at 06:41 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--
CREATE DATABASE IF NOT EXISTS `university` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `university`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `entry` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user`, `name`, `comment`, `created_date`, `entry`) VALUES
(2, 2, 'Comment 1', 'Comment 1', '2016-11-21 22:23:55', 34),
(3, 2, 'Comment 2', 'Comment 2', '2016-11-21 23:30:29', 34);

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

DROP TABLE IF EXISTS `entry`;
CREATE TABLE `entry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `faculty` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `student` int(11) DEFAULT NULL,
  `reviewer` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `name`, `description`, `faculty`, `created_date`, `student`, `reviewer`, `status`, `img`, `content`, `file`) VALUES
(34, 'vávas', '<p>vsavas</p>', 6, '2016-11-20 20:36:14', 16, NULL, 'approved', 'http://localhost/ewsd2016/assets/entry/d53452d21656fc905c91b2f6469d4c60.jpg', '<p>vsavsa</p>', 7),
(35, 'sấccas', '<p>vsavsavas</p>', 6, '2016-11-20 20:55:26', 16, NULL, 'approved', 'http://localhost/ewsd2016/assets/entry/0e177ab554f84587a43853379c044b1d.jpg', '<p>vsavasvsa</p>', 8),
(36, 'vavsa', '<p>&aacute;vasvas</p>', 6, '2016-11-20 20:57:43', 16, 2, 'is_reviewed', 'http://localhost/ewsd2016/assets/entry/5acd5a96f1fcebd0ff03a33e12229926.jpg', '<p>vsavsavsa</p>', 9);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `mkt_coor` int(11) DEFAULT NULL,
  `year` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `code`, `name`, `description`, `created_date`, `mkt_coor`, `year`) VALUES
(6, 'ewsd-2016', 'ewsd', 'Enterprise Web Software Development', '2016-11-06 15:12:12', 2, '2016'),
(10, 'id-2016', 'id', 'Interaction Design', '2016-11-08 21:51:34', 3, '2016');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `name` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oldname` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `name`, `description`, `size`, `path`, `type`, `ext`, `oldname`, `created_date`) VALUES
(7, 'abc4dc96516f8a262ec937a4e7362bd1.docx', 'abc4dc96516f8a262ec937a4e7362bd1.docx', '2036550', 'http://localhost/ewsd2016/assets/entry/abc4dc96516f8a262ec937a4e7362bd1.docx', 'entry', 'docx', 'admddocument.docx', '0000-00-00 00:00:00'),
(8, '638a7a6034a1b4349742112724d70017.docx', '638a7a6034a1b4349742112724d70017.docx', '2036550', 'http://localhost/ewsd2016/assets/entry/638a7a6034a1b4349742112724d70017.docx', 'entry', 'docx', 'admddocument.docx', '0000-00-00 00:00:00'),
(9, 'ddedc2318b28b29b0b48a107e45f6125.docx', '638a7a6034a1b4349742112724d70017.docx', '2036550', 'http://localhost/ewsd2016/assets/entry/ddedc2318b28b29b0b48a107e45f6125.docx', 'entry', 'docx', 'admddocument.docx', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(3000) COLLATE utf8_unicode_ci NOT NULL,
  `entry` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `code`, `name`, `description`, `created_date`) VALUES
(1, 'admin', 'Admin', 'Admin', '2016-10-29 22:11:56'),
(2, 'student', 'Student', 'Student', '2016-10-29 22:11:56'),
(3, 'mkmng', 'Marketing Manager', 'Marketing Manager', '2016-10-29 22:11:56'),
(4, 'mkcoor', 'Marketing Coordinator', 'Marketing Coordinator', '2016-10-29 22:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `faculty` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `birth_date`, `email`, `role`, `faculty`, `created_date`, `avatar`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'AlexIch', '2016-01-01 00:00:00', 'icoding.active@gmail.com', 1, NULL, '2016-01-01 00:00:00', 'http://ewsd.dev/ewsd2016/assets/uploads/58255ef7c0e05.jpg'),
(2, 'huuthien', 'e10adc3949ba59abbe56e057f20f883e', 'Dang Huu Thien', '2016-11-06 00:00:00', 'icoding.active1@gmail.com', 4, NULL, NULL, 'http://ewsd.dev/ewsd2016/assets/uploads/581f41e462f39.png'),
(3, 'tinhlagi', 'e10adc3949ba59abbe56e057f20f883e', 'Tinh La Gi', '1984-09-12 00:00:00', 'tinhlagi@gmail.com', 4, NULL, '2016-11-08 21:49:57', 'http://ewsd.dev/ewsd2016/assets/uploads/5821e6152df89.jpg'),
(15, 'student1', '827ccb0eea8a706c4c34a16891f84e7b', 'Tu Phan', NULL, 'student1@gmail.com', 2, 6, '2016-11-19 11:48:20', 'http://localhost/ewsd2016/assets/images/default.png'),
(16, 'student2', '827ccb0eea8a706c4c34a16891f84e7b', 'So Tu Den 2', NULL, 'student2@gmail.com', 2, 6, '2016-11-19 16:55:37', 'http://localhost/ewsd2016/assets/images/default.png'),
(17, 'student3', '827ccb0eea8a706c4c34a16891f84e7b', 'So Tu Dan', NULL, 'student3@gmail.com', 2, 10, '2016-11-22 00:19:08', 'http://localhost/ewsd2016/assets/uploads/58332c8ce91a3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cm_review_idx` (`user`),
  ADD KEY `fk_cm_entry_idx` (`entry`);

--
-- Indexes for table `entry`
--
ALTER TABLE `entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_entry_faculty_idx` (`faculty`),
  ADD KEY `fk_entry_student_idx` (`student`),
  ADD KEY `fk_entry_student_idx1` (`reviewer`),
  ADD KEY `fk_entry_file` (`file`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faculty_cord_idx` (`mkt_coor`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role_idx` (`role`),
  ADD KEY `fk_user_faculty_idx` (`faculty`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `entry`
--
ALTER TABLE `entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_cm_entry` FOREIGN KEY (`entry`) REFERENCES `entry` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cm_review` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `entry`
--
ALTER TABLE `entry`
  ADD CONSTRAINT `fk_entry_faculty` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entry_file` FOREIGN KEY (`file`) REFERENCES `file` (`id`),
  ADD CONSTRAINT `fk_entry_reviewer` FOREIGN KEY (`reviewer`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entry_student` FOREIGN KEY (`student`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `fk_faculty_cord` FOREIGN KEY (`mkt_coor`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_faculty` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
