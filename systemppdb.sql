-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2020 at 07:16 PM
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
-- Database: `systemppdb`
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

--
-- Dumping data for table `answer_script`
--

INSERT INTO `answer_script` (`answer_id`, `answer_script`, `no_of_complaints`, `paper_id`) VALUES
(1, 'answerscripts/SCS2203_2019_F ANS (1).pdf', 0, 41),
(2, 'answerscripts/SCS2204_2019_F ANS.pdf', 0, 2),
(3, 'answerscripts/SCS2205_2019_F ANS.pdf', 0, 3),
(4, 'answerscripts/SCS 2206 ANS.pdf', 0, 20);

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
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_code` char(4) CHARACTER SET utf8mb4 NOT NULL,
  `course_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `introduced_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `course_name`, `introduced_year`) VALUES
('CS', 'Computer Science', 2002),
('IS', 'Information Systems', 2002);

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
-- Table structure for table `examination_details`
--

CREATE TABLE `examination_details` (
  `subject_code` char(7) CHARACTER SET utf8mb4 NOT NULL,
  `year` int(4) NOT NULL,
  `examination_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `interest_list`
--

INSERT INTO `interest_list` (`user_id`, `subject_code`) VALUES
(46, 'SCS1208'),
(46, 'SCS1209'),
(46, 'SCS1210'),
(31, 'SCS1213'),
(31, 'SCS1214'),
(31, 'SCS1208'),
(31, 'SCS1209'),
(31, 'SCS1210'),
(31, 'SCS1211'),
(31, 'SCS1212'),
(31, 'SCS2208'),
(31, 'SCS2201'),
(31, 'SCS2202'),
(42, 'SCS1208'),
(42, 'SCS1209'),
(42, 'SCS1210'),
(42, 'SCS1211');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `designation` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`designation`, `user_id`) VALUES
('lecturer', 37),
('lecturer', 42),
('instructor', 44);

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `tag` varchar(50) NOT NULL,
  `subject_code` char(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`tag`, `subject_code`) VALUES
('Graph Algorithm', 'SCS1208'),
('Red Black Tree', 'SCS1208'),
('Dynamic Programming', 'SCS2201'),
('String Matching Algorithm', 'SCS2201');

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
  `subject_code` char(7) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `part` char(1) NOT NULL,
  `past_paper` varchar(1000) NOT NULL,
  `uploaded_date` date NOT NULL,
  `no_of_complaints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `past_paper`
--

INSERT INTO `past_paper` (`paper_id`, `subject_code`, `year`, `part`, `past_paper`, `uploaded_date`, `no_of_complaints`) VALUES
(2, 'SCS2204', 2019, 'F', 'SCS2204_2019_F.pdf\r\n', '2020-11-01', 0),
(3, 'SCS2205', 2019, 'F', 'SCS2205_2019_F.pdf', '2020-10-06', 0),
(20, 'SCS2206', 2019, 'F', 'SCS 2206.pdf', '2020-11-12', 0),
(29, 'SCS2207', 2019, 'F', 'SCS 2207.pdf', '2020-11-12', 0),
(39, 'SCS2208', 2019, 'F', 'SCS 2208.pdf', '2020-11-12', 0),
(41, 'SCS2203', 2019, 'F', 'SCS 2203.pdf', '2020-11-12', 0);

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
  `block_notifcatio_flag` tinyint(1) NOT NULL,
  `activeStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registred_user`
--

INSERT INTO `registred_user` (`user_id`, `email`, `user_name`, `password`, `first_name`, `middle_name`, `last_name`, `user_flag`, `recieved_time_notification`, `block_notifcatio_flag`, `activeStatus`) VALUES
(27, 'j.stu@gmail.com', 'janadhi', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '', 'S', '0000-00-00', 0, 1),
(28, 'franky_lec@gmail.com', 'Frank', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '', 'L', '0000-00-00', 0, 1),
(29, '2018cs006@stu.ucsc.cmb.ac.lk', 'shaki', 'e2d77ea3f7a5e746b22b5d941ae979351eaeca30', '', '', '', 'S', '0000-00-00', 0, 1),
(30, 'exam@ucsc.cmb.ac.lk', 'examDep', 'effe797975572eab740a04f8fa6c3802bc568f77', '', '', '', 'E', '0000-00-00', 0, 1),
(31, '2018cs152@stu.ucsc.cmb.ac.lk', 'Chamodhi', '8cb2237d0679ca88db6464eac60da96345513964', '', '', '', 'S', '0000-00-00', 0, 1),
(34, '2018cs123@stu.ucsc.cmb.ac.lk', 'Dewwandi', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', '', 'S', '0000-00-00', 0, 1),
(35, '2018cs456@stu.ucsc.cmb.ac.lk', 'Satharasinghe', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', '', 'S', '0000-00-00', 0, 0),
(36, '2018cs888@stu.ucsc.cmb.ac.lk', 'Uzumaki', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', 'S', '0000-00-00', 0, 1),
(37, '2018cs152@lec.ucsc.cmb.ac.lk', 'Haruno', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', '', 'L', '0000-00-00', 0, 1),
(42, '2018cs148@lec.ucsc.cmb.ac.lk', 'kakashi', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', 'E', '0000-00-00', 0, 1),
(44, '2018cs487@lec.ucsc.cmb.ac.lk', 'gaara', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', 'I', '0000-00-00', 0, 1),
(45, '', 'Luff', '8cb2237d0679ca88db6464eac60da96345513964', '', '', '', 'S', '0000-00-00', 0, 1),
(46, '2018cs369@stu.ucsc.cmb.ac.lk', 'Luffy', '011c945f30ce2cbafc452f39840f025693339c42', '', '', '', 'A', '0000-00-00', 0, 1);

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
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` int(11) NOT NULL,
  `index_number` char(8) NOT NULL,
  `year` char(4) NOT NULL,
  `course` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `index_number`, `year`, `course`) VALUES
(31, '18001111', 'saab', ''),
(36, '18008888', 'saab', ''),
(45, '', '2020', ''),
(46, '18001369', '2019', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_code` char(7) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `introduced_year` int(4) NOT NULL,
  `removed_year` int(4) NOT NULL,
  `year_of_study` char(1) NOT NULL,
  `semester` char(4) NOT NULL,
  `course_code` char(4) NOT NULL,
  `active_flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_code`, `subject_name`, `introduced_year`, `removed_year`, `year_of_study`, `semester`, `course_code`, `active_flag`) VALUES
('SCS1208', 'Data Structures and Algorithms - II', 2010, 0, '1', '2', 'CS', 1),
('SCS1209', 'Object Oriented Programming', 2010, 0, '1', '2', 'CS', 1),
('SCS1210', 'Software Engineering - I', 2010, 0, '1', '2', 'CS', 1),
('SCS1211', 'Mathematical Methods - I', 2010, 0, '1', '2', 'CS', 1),
('SCS1212', 'Foundation for Computer Science', 2010, 0, '1', '2', 'CS', 1),
('SCS1213', 'Probability and Satistics', 2010, 0, '1', '2', 'CS', 1),
('SCS1214', 'Operating Systems - I', 2010, 0, '1', '2', 'CS', 1),
('SCS2201', 'Data Structures and Algorithms - III', 2010, 0, '2', '1', 'CS', 1),
('SCS2202', 'Group Project -I', 2010, 0, '2', '1/2', 'CS', 1),
('SCS2203', 'Software Engineering - II', 2010, 0, '2', '1', 'CS', 1),
('SCS2204', 'Functional Programming', 2019, 0, '2', '1', 'CS', 1),
('SCS2205', 'Computer Networks - I', 2010, 0, '2', '1', 'CS', 1),
('SCS2206', 'Mathematical Methods - II', 2012, 0, '2', '1', 'CS', 1),
('SCS2207', 'Programming Language Concepts', 2017, 0, '2', '1', 'CS', 1),
('SCS2208', 'Rapid Application Development', 2017, 0, '2', '1', 'CS', 1);

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
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`discussion_id`),
  ADD KEY `paper_id` (`paper_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `examination_details`
--
ALTER TABLE `examination_details`
  ADD PRIMARY KEY (`year`,`subject_code`) USING BTREE;

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
  ADD UNIQUE KEY `uniquePaper` (`subject_code`,`year`,`part`),
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
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `index_number` (`index_number`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_code`),
  ADD KEY `course_code` (`course_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_script`
--
ALTER TABLE `answer_script`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registred_user`
--
ALTER TABLE `registred_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

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
  ADD CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`student_user_id`) REFERENCES `student` (`user_id`),
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
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registred_user` (`user_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
