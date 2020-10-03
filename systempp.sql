-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 07:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `systempp`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_script`
--

CREATE TABLE `answer_script` (
  `answer_id` int(11) NOT NULL,
  `answer_script` varchar(1000) NOT NULL,
  `no_of_complaints` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `available_day`
--

CREATE TABLE `available_day` (
  `user_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `discussion_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `user_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `reaction` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `interest_list`
--

CREATE TABLE `interest_list` (
  `user_id` int(11) NOT NULL,
  `subject_code` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `designation` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `tag` varchar(50) NOT NULL,
  `subject_code` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `meeting_id` int(11) NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` time NOT NULL,
  `student_user_id` int(11) NOT NULL,
  `lecturer_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paper_preparation`
--

CREATE TABLE `paper_preparation` (
  `user_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `past_paper`
--

CREATE TABLE `past_paper` (
  `paper_id` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `year_of_study` char(1) NOT NULL,
  `past_paper` varchar(1000) NOT NULL,
  `semester` char(1) NOT NULL,
  `no_of_complaints` int(11) NOT NULL,
  `uploaded_date` date NOT NULL,
  `subject_code` char(7) NOT NULL,
  `part` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `level1` char(3) NOT NULL,
  `level2` char(3) NOT NULL,
  `level3` char(3) NOT NULL,
  `level4` char(3) NOT NULL,
  `content` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_belongs_to_lesson`
--

CREATE TABLE `question_belongs_to_lesson` (
  `tag` varchar(50) NOT NULL,
  `paper_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registred_user`
--

CREATE TABLE `registred_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_flag` char(1) NOT NULL,
  `recieved_time_notification` date NOT NULL,
  `block_notifcatio_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `type` char(1) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discussion_id` int(11) NOT NULL,
  `parent_resource_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stduent`
--

CREATE TABLE `stduent` (
  `user_id` int(11) NOT NULL,
  `index_number` char(8) NOT NULL,
  `year` char(4) NOT NULL,
  `course` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_code` char(7) NOT NULL,
  `academic_year` int(4) NOT NULL,
  `subject_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_script`
--
ALTER TABLE `answer_script`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `paper_id` (`paper_id`);

--
-- Indexes for table `available_day`
--
ALTER TABLE `available_day`
  ADD PRIMARY KEY (`user_id`,`day`) USING BTREE;

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`),
  ADD KEY `paper_id` (`paper_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`user_id`,`resource_id`) USING BTREE,
  ADD KEY `resource_id` (`resource_id`);

--
-- Indexes for table `interest_list`
--
ALTER TABLE `interest_list`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`tag`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`meeting_id`),
  ADD KEY `student_user_id` (`student_user_id`),
  ADD KEY `lecturer_user_id` (`lecturer_user_id`);

--
-- Indexes for table `paper_preparation`
--
ALTER TABLE `paper_preparation`
  ADD PRIMARY KEY (`user_id`,`paper_id`) USING BTREE,
  ADD KEY `paper_id` (`paper_id`);

--
-- Indexes for table `past_paper`
--
ALTER TABLE `past_paper`
  ADD PRIMARY KEY (`paper_id`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`,`paper_id`) USING BTREE,
  ADD KEY `paper_id` (`paper_id`);

--
-- Indexes for table `question_belongs_to_lesson`
--
ALTER TABLE `question_belongs_to_lesson`
  ADD PRIMARY KEY (`tag`,`question_id`,`paper_id`) USING BTREE,
  ADD KEY `question_id` (`question_id`),
  ADD KEY `paper_id` (`paper_id`);

--
-- Indexes for table `registred_user`
--
ALTER TABLE `registred_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `discussion_id` (`discussion_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `resources_ibfk_3` (`parent_resource_id`);

--
-- Indexes for table `stduent`
--
ALTER TABLE `stduent`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `index_number` (`index_number`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_script`
--
ALTER TABLE `answer_script`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `discussion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `past_paper`
--
ALTER TABLE `past_paper`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registred_user`
--
ALTER TABLE `registred_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer_script`
--
ALTER TABLE `answer_script`
  ADD CONSTRAINT `answer_script_ibfk_1` FOREIGN KEY (`paper_id`) REFERENCES `past_paper` (`paper_id`);

--
-- Constraints for table `available_day`
--
ALTER TABLE `available_day`
  ADD CONSTRAINT `available_day_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lecturer` (`user_id`);

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`paper_id`) REFERENCES `question` (`paper_id`),
  ADD CONSTRAINT `discussion_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registred_user` (`user_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`resource_id`);

--
-- Constraints for table `interest_list`
--
ALTER TABLE `interest_list`
  ADD CONSTRAINT `interest_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registred_user` (`user_id`),
  ADD CONSTRAINT `interest_list_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registred_user` (`user_id`);

--
-- Constraints for table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`);

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`student_user_id`) REFERENCES `stduent` (`user_id`),
  ADD CONSTRAINT `meeting_ibfk_2` FOREIGN KEY (`lecturer_user_id`) REFERENCES `lecturer` (`user_id`);

--
-- Constraints for table `paper_preparation`
--
ALTER TABLE `paper_preparation`
  ADD CONSTRAINT `paper_preparation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `lecturer` (`user_id`),
  ADD CONSTRAINT `paper_preparation_ibfk_2` FOREIGN KEY (`paper_id`) REFERENCES `past_paper` (`paper_id`);

--
-- Constraints for table `past_paper`
--
ALTER TABLE `past_paper`
  ADD CONSTRAINT `past_paper_ibfk_1` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`paper_id`) REFERENCES `past_paper` (`paper_id`);

--
-- Constraints for table `question_belongs_to_lesson`
--
ALTER TABLE `question_belongs_to_lesson`
  ADD CONSTRAINT `question_belongs_to_lesson_ibfk_1` FOREIGN KEY (`tag`) REFERENCES `lesson` (`tag`),
  ADD CONSTRAINT `question_belongs_to_lesson_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`),
  ADD CONSTRAINT `question_belongs_to_lesson_ibfk_3` FOREIGN KEY (`paper_id`) REFERENCES `question` (`paper_id`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `discussion` (`discussion_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `registred_user` (`user_id`),
  ADD CONSTRAINT `resources_ibfk_3` FOREIGN KEY (`parent_resource_id`) REFERENCES `resources` (`resource_id`);

--
-- Constraints for table `stduent`
--
ALTER TABLE `stduent`
  ADD CONSTRAINT `stduent_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registred_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
