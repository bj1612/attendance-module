-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 06:25 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vesit_11_30`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `a_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`c_id`, `c_name`) VALUES
(1, 'MCA1A'),
(2, 'MCA1B');

-- --------------------------------------------------------

--
-- Table structure for table `over_all_attendance`
--

CREATE TABLE `over_all_attendance` (
  `oa_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `total_present` int(11) NOT NULL,
  `out_of_present` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `oa_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stud_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `stud_roll_no` int(11) NOT NULL,
  `stud_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`stud_id`, `c_id`, `stud_roll_no`, `stud_name`) VALUES
(1, 2, 1, 'Akash Manoj Gupta'),
(2, 2, 2, 'Afzal Husain MD Siraj'),
(3, 2, 3, 'Aishwarya Milind Dhuri'),
(4, 2, 4, 'Vishal Singh'),
(5, 2, 5, 'Sai Sunil Kasthoori'),
(6, 2, 6, 'Akashay Vinodkumar Nair'),
(7, 2, 7, 'Anam Mohammad Arif'),
(8, 2, 8, 'Baig Shamshir Humayun Badshah'),
(9, 2, 9, 'Bhavesh Rajendra Mandavkar'),
(10, 2, 10, 'Bilal Rizwan Sunasra'),
(11, 2, 11, 'Brijesh Subas Vishwakarma'),
(12, 2, 12, 'Chandan Ramachhaebar Yadav'),
(13, 2, 13, 'Chetankumar Vijaykumar Gupta'),
(14, 2, 14, 'Divya Deviprasad Pokhriyal'),
(15, 2, 15, 'Dubey Divya Sunil'),
(16, 2, 16, 'Heet Nilesh Chauhan'),
(17, 2, 17, 'Heramb Shankar Patil'),
(18, 2, 18, 'Jha Premkishor Navin'),
(19, 2, 19, 'Jinang Dignesh Vora'),
(20, 2, 20, 'Josy Brijit Jose'),
(21, 2, 21, 'Jyothi Mamidala Satyanarayana'),
(22, 2, 22, 'Kankani Rishabh Omprakash'),
(23, 2, 23, 'Kaushik Ramulu Janmanchi'),
(24, 2, 24, 'Kiran Ghanshyamdas Gurbani'),
(25, 2, 25, 'Maggie Prashant Torne'),
(26, 2, 26, 'Mamta Tretachand Gupta'),
(27, 2, 27, 'Medhank Rajendra Pathare'),
(28, 2, 28, 'Megha Rajan'),
(29, 2, 29, 'Mohammad Nafis Mohammad Rafiq Khan'),
(30, 2, 30, 'Nabil Mohammed Kazi'),
(31, 2, 31, 'Nadar Venkatesh Balamurugan'),
(32, 2, 32, 'Naik Yash Gopal'),
(33, 2, 33, 'Nikhil Tanaji Bhoite'),
(34, 2, 34, 'Nikita Sanjay Wani'),
(35, 2, 35, 'Nupur Balkrishna Parab'),
(36, 2, 36, 'Paramjeet Singh Amrik Singh Nagi'),
(37, 2, 37, 'Patil Manasi Ajit'),
(38, 2, 38, 'Prasad Shailesh Chandrashekhar'),
(39, 2, 39, 'Prathamesh Lavu Varadkar'),
(40, 2, 40, 'Priyesh Rameshchandra Sharma'),
(41, 2, 41, 'Raj Prashant Shetye'),
(42, 2, 42, 'Ritik Anil Verma'),
(43, 2, 43, 'Rohit Pradeepkumar Pandey'),
(44, 2, 44, 'Rohit Rajiv Kumar Yadav'),
(45, 2, 45, 'Ronit Arun Khorjuvekar'),
(46, 2, 46, 'Rushabh Lalitkumar Uchibagle'),
(47, 2, 47, 'Sahil Balu Shete'),
(48, 2, 48, 'Shivam Kumari'),
(49, 2, 49, 'Shraddha Anil Vichare'),
(50, 2, 50, 'Shraddha Rajesh Rai'),
(51, 2, 51, 'Siddhesh Bhagawant Tate'),
(52, 2, 52, 'Siddhesh Sudhir Tambe'),
(53, 2, 53, 'Singh Suraj Subash'),
(54, 2, 54, 'Soham Subodh Morankar'),
(55, 2, 55, 'Solanki Rashi Paras'),
(56, 2, 56, 'Sudhir bijay Nayak'),
(57, 2, 57, 'Sushantkumar Balaso Pawar'),
(58, 2, 58, 'Wagh Atul Pramod'),
(59, 2, 59, 'Yamini Amol Agrawal'),
(60, 2, 60, 'Yash Prakash More');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `s_id` int(11) NOT NULL,
  `s_name` varchar(20) NOT NULL,
  `t_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`s_id`, `s_name`, `t_id`, `c_id`) VALUES
(1, 'DMMM', 2, 2),
(2, 'WAD', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(20) NOT NULL,
  `t_uname` varchar(20) NOT NULL,
  `t_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_name`, `t_uname`, `t_password`) VALUES
(1, 'Monali Rajput', 'monali', 'monali'),
(2, 'Ruchi Rautela', 'ruchi', 'ruchi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `over_all_attendance`
--
ALTER TABLE `over_all_attendance`
  ADD PRIMARY KEY (`oa_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`stud_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `over_all_attendance`
--
ALTER TABLE `over_all_attendance`
  MODIFY `oa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `class` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`s_id`) REFERENCES `subject` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `over_all_attendance`
--
ALTER TABLE `over_all_attendance`
  ADD CONSTRAINT `over_all_attendance_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `over_all_attendance_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `class` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `over_all_attendance_ibfk_3` FOREIGN KEY (`s_id`) REFERENCES `subject` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `over_all_attendance_ibfk_4` FOREIGN KEY (`stud_id`) REFERENCES `student` (`stud_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `class` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `teacher` (`t_id`),
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `class` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
