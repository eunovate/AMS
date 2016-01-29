-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2016 at 11:30 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`attendance_id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `schedule_id` int(5) NOT NULL,
  `present_flag` tinyint(1) NOT NULL DEFAULT '0',
  `comment` varchar(300) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `schedule_id`, `present_flag`, `comment`) VALUES
(1, 4, 2, 0, ' '),
(3, 1, 1, 1, ' '),
(9, 5, 2, 0, ' '),
(10, 4, 1, 0, ' '),
(22, 3, 1, 0, ' '),
(24, 2, 1, 1, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `behaviour`
--

CREATE TABLE IF NOT EXISTS `behaviour` (
`behaviour_id` int(5) NOT NULL,
  `description` varchar(300) NOT NULL,
  `active_flag` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `behaviour`
--

INSERT INTO `behaviour` (`behaviour_id`, `description`, `active_flag`) VALUES
(1, 'home work', 1),
(2, 'test pass', 1),
(3, 'good teaching', 1),
(4, 'regular attendence', 1),
(5, 'good listen', 1);

-- --------------------------------------------------------

--
-- Table structure for table `behaviour_record`
--

CREATE TABLE IF NOT EXISTS `behaviour_record` (
  `attendance_id` int(5) NOT NULL,
  `behaviour_id` int(5) NOT NULL,
  `rating` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `behaviour_record`
--

INSERT INTO `behaviour_record` (`attendance_id`, `behaviour_id`, `rating`) VALUES
(1, 1, '4'),
(1, 2, '4'),
(1, 3, '4'),
(1, 4, '4'),
(1, 5, '4'),
(3, 1, '5'),
(3, 2, '5'),
(3, 3, '5'),
(3, 4, '5'),
(3, 5, '5'),
(6, 1, '4'),
(6, 2, '4'),
(6, 3, '4'),
(6, 4, '4'),
(6, 5, '4'),
(8, 1, '3'),
(8, 2, '3'),
(8, 3, '3'),
(8, 4, '3'),
(8, 5, '3'),
(9, 1, '3'),
(9, 2, '3'),
(9, 3, '3'),
(9, 4, '3'),
(9, 5, '5'),
(10, 1, '4'),
(10, 2, '3'),
(10, 3, '4'),
(10, 4, '5'),
(10, 5, '5'),
(20, 1, '4'),
(20, 2, '4'),
(20, 3, '4'),
(20, 4, '4'),
(20, 5, '4'),
(22, 1, '5'),
(22, 2, '5'),
(22, 3, '5'),
(22, 4, '5'),
(22, 5, '5'),
(23, 1, '3'),
(23, 2, '4'),
(23, 3, '4'),
(23, 4, '1'),
(23, 5, '1'),
(24, 1, '1'),
(24, 2, '1'),
(24, 3, '1'),
(24, 4, '1'),
(24, 5, '1'),
(26, 1, '4'),
(26, 2, '4'),
(26, 3, '4'),
(26, 4, '4'),
(26, 5, '4');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`class_id` int(5) NOT NULL,
  `vehicle_id` int(5) NOT NULL,
  `class_name` varchar(300) NOT NULL,
  `user_id` int(5) NOT NULL,
  `location_id` int(5) NOT NULL,
  `active_flag` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `vehicle_id`, `class_name`, `user_id`, `location_id`, `active_flag`) VALUES
(1, 1, 'test class name', 1, 1, 1),
(2, 2, 'class 1', 1, 2, 1),
(3, 2, 'test class 3', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
`course_id` int(5) NOT NULL,
  `description` varchar(130) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `description`) VALUES
(1, 'testtt'),
(2, 'new test'),
(3, 'new course 1'),
(4, 'new course 2');

-- --------------------------------------------------------

--
-- Table structure for table `course_class`
--

CREATE TABLE IF NOT EXISTS `course_class` (
  `class_id` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `active_flag` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_class`
--

INSERT INTO `course_class` (`class_id`, `course_id`, `active_flag`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 3, 0),
(2, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`grade_id` int(5) NOT NULL,
  `class_id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `description` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
`lesson_id` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`lesson_id`, `course_id`, `description`) VALUES
(1, 1, 'test lesson'),
(2, 2, 'new lesson 1'),
(3, 2, 'new lesson 2'),
(4, 3, 'new les 1'),
(5, 3, 'new les 23');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
`location_id` int(11) NOT NULL,
  `location_desc` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_desc`) VALUES
(1, 'test location'),
(2, 'loc 2'),
(13, '36 street'),
(14, '40 street'),
(15, '50 street');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
`noti_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `noti_description` varchar(300) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_user_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`noti_id`, `user_id`, `noti_description`, `seen`, `created_user_id`, `created_date`) VALUES
(1, 1, 'test notification', 1, 1, '2016-01-25 23:38:17'),
(2, 1, 'noti 2', 1, 1, '2016-01-26 22:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`role_id` int(5) NOT NULL,
  `description` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `description`) VALUES
(1, 'Admin'),
(2, 'Coordinator'),
(3, 'Head Teacher'),
(4, 'Teacher'),
(5, 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
`schedule_id` int(5) NOT NULL,
  `class_id` int(5) NOT NULL,
  `lesson_id` int(5) NOT NULL,
  `head_teacher_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vehicle_id` int(5) NOT NULL,
  `contact_address` varchar(200) NOT NULL,
  `contact_phone` varchar(60) NOT NULL,
  `created_user_id` int(5) NOT NULL,
  `active_flag` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `class_id`, `lesson_id`, `head_teacher_id`, `driver_id`, `schedule_date`, `start_time`, `end_time`, `vehicle_id`, `contact_address`, `contact_phone`, `created_user_id`, `active_flag`) VALUES
(1, 1, 1, 4, 2, '2016-02-06', '2016-02-06 04:14:00', '2016-02-06 07:14:00', 1, 'test add', '4245421', 1, 1),
(2, 1, 3, 3, 2, '2016-01-06', '2016-01-06 06:03:00', '2016-01-06 08:03:00', 1, 'new addd', '5242142122', 1, 1),
(3, 1, 1, 0, 2, '2016-02-06', '2016-02-06 04:10:00', '2016-02-06 07:10:00', 1, 'test add', '652462', 1, 1),
(4, 1, 1, 4, 2, '2016-01-17', '2016-01-17 07:02:00', '2016-01-17 08:02:00', 2, '', '', 1, 1),
(5, 2, 5, 3, 2, '2016-01-18', '2016-01-18 03:53:00', '2016-01-18 04:53:00', 1, '', '', 1, 1),
(6, 2, 5, 0, 2, '2016-01-18', '2016-01-18 05:54:00', '2016-01-18 07:54:00', 1, '', '', 1, 1),
(7, 2, 5, 0, 2, '2016-01-19', '2016-01-19 04:00:00', '2016-01-19 05:00:00', 1, '', '', 1, 1),
(8, 2, 5, 0, 2, '2016-01-21', '2016-01-21 04:04:00', '2016-01-21 05:04:00', 1, '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_person`
--

CREATE TABLE IF NOT EXISTS `schedule_person` (
  `schedule_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_person`
--

INSERT INTO `schedule_person` (`schedule_id`, `user_id`, `role_id`) VALUES
(1, 3, 0),
(4, 3, 0),
(5, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
`session` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `note` varchar(20) NOT NULL,
  `active` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session`, `userid`, `session_id`, `login_time`, `logout_time`, `note`, `active`) VALUES
(1, 1, 'e1a2457f3181238972049c11c6e59fc4491a5842', '2015-12-31 22:57:26', '2015-12-31 22:57:45', 'user_logout', 0),
(2, 1, 'e1a2457f3181238972049c11c6e59fc4491a5842', '2015-12-31 22:57:55', '2016-01-01 04:19:47', 'user_logout', 0),
(3, 1, '69390b621e33b023389490c028e7fe585434eed5', '2016-01-01 04:19:55', '2016-01-15 03:41:03', 'user_logout', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`student_id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `date_of_birth` date NOT NULL,
  `father_name` varchar(20) NOT NULL,
  `father_nrc_no` varchar(20) NOT NULL,
  `mother_name` varchar(20) NOT NULL,
  `mother_nrc_no` varchar(20) NOT NULL,
  `remark` varchar(32) NOT NULL,
  `nrc_no` varchar(25) NOT NULL,
  `alias` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `nationality` varchar(80) NOT NULL,
  `parent_job` varchar(300) NOT NULL,
  `parent_address` varchar(300) NOT NULL,
  `sibling_total` varchar(20) NOT NULL,
  `education_background` varchar(300) NOT NULL,
  `hobbies` varchar(300) NOT NULL,
  `current_job` varchar(200) NOT NULL,
  `post_job` varchar(200) NOT NULL,
  `is_active` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `address`, `contact`, `location`, `gender`, `date_of_birth`, `father_name`, `father_nrc_no`, `mother_name`, `mother_nrc_no`, `remark`, `nrc_no`, `alias`, `age`, `nationality`, `parent_job`, `parent_address`, `sibling_total`, `education_background`, `hobbies`, `current_job`, `post_job`, `is_active`) VALUES
(1, 'test name', 'no.3', '12321312', 'yangon', '2', '2009-03-11', '', '', '', '', '', '12/test', '', '', '', '', '', '', '', '', '', '', 1),
(2, 'mgmg', 'no.4', '4565463', 'yangon', '1', '2004-08-28', 'umg', '12/ta(na)345345', 'dmya', '12/ta(na)067434', '', '12/ta(na)324234', '', '', '', '', '', '', '', '', '', '', 1),
(3, 'mgkyaw', 'no.5', '52323', 'yangon', '1', '1997-08-22', 'ukyaw', '13/ma(na)523423', 'dhla', '13/ma(na)214234', 'test remark', '13/ma(na)324234', 'kokyaw', '', '', '', '', '', '', '', '', '', 1),
(4, 'test name', 'test add', 'test c', 'test l', '1', '2010-02-13', 'u ba', 'fa nrc', 'd mya', 'm nrc', '', 'test nrc', 'test alias', '22', 'mm', 'pj', 'pa add', '3', 'test edback', 'test h', 'test cj', 'test poj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE IF NOT EXISTS `student_class` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `active_flag` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`class_id`, `student_id`, `active_flag`) VALUES
(1, 2, 1),
(1, 3, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(5) NOT NULL,
  `user_gp_id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `nrc_no` varchar(25) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `is_active` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_gp_id`, `name`, `user_name`, `password`, `email`, `phone`, `address`, `nrc_no`, `gender`, `is_active`) VALUES
(1, 1, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 'admin@gmail.com', '', '', '', '', 1),
(2, 3, 'mgmg', 'mgmg', '202cb962ac59075b964b07152d234b70', '', '', 'no.34', '12/ta(na)23423423', '1', 1),
(3, 2, 'ma hla', 'mahla', '202cb962ac59075b964b07152d234b70', '', '435347823', 'test address', '12/ma(ta)45647754', '2', 1),
(4, 2, 'u kyaw', 'ukyaw', '202cb962ac59075b964b07152d234b70', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
`user_gp_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `group_name` varchar(40) NOT NULL,
  `accesscontrol` varchar(200) NOT NULL,
  `active_flag` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_gp_id`, `role_id`, `group_name`, `accesscontrol`, `active_flag`) VALUES
(1, 1, 'Admin', 'CUSTOMER_3,CAR_3', 1),
(2, 4, 'Teacher', 'CUSTOMER_1,CAR_1', 1),
(3, 5, 'Driver', 'CUSTOMER_0,CAR_0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
`vehicle_id` int(5) NOT NULL,
  `v_no` varchar(40) NOT NULL,
  `v_brand` varchar(80) NOT NULL,
  `v_model` varchar(80) NOT NULL,
  `v_chassic` varchar(80) NOT NULL,
  `v_engine` varchar(80) NOT NULL,
  `v_color` varchar(80) NOT NULL,
  `licence_expired_date` date NOT NULL,
  `bought_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `v_no`, `v_brand`, `v_model`, `v_chassic`, `v_engine`, `v_color`, `licence_expired_date`, `bought_date`) VALUES
(1, '4C/1234', '', '', '', '', '', '2018-02-01', '2016-01-01'),
(2, '1B/2222', 'Suzuki', '2011', '12321', '321313', 'white', '2017-11-29', '2016-01-12'),
(3, '1111', 'suziki', '2005', '23423', '2222', 'white', '0000-00-00', '2014-01-23'),
(4, '3A/12433', 'Hundaa', '20133', '123122', '33211', 'greyy', '2017-11-20', '2016-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_maintenance`
--

CREATE TABLE IF NOT EXISTS `vehicle_maintenance` (
`record_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `oil` tinyint(1) NOT NULL,
  `coolant` tinyint(1) NOT NULL,
  `air` tinyint(1) NOT NULL,
  `comment` varchar(512) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_maintenance`
--

INSERT INTO `vehicle_maintenance` (`record_id`, `vehicle_id`, `oil`, `coolant`, `air`, `comment`, `created_time`, `user_id`) VALUES
(1, 2, 1, 1, 1, 'test', '2016-01-15 03:12:42', 1),
(2, 2, 0, 1, 0, 'new maintenamce', '2016-01-15 04:06:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_usage`
--

CREATE TABLE IF NOT EXISTS `vehicle_usage` (
`vehicle_usage_id` int(11) NOT NULL,
  `vehicle_id` int(5) NOT NULL,
  `start_odometer` int(11) NOT NULL,
  `started_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_odometer` int(11) NOT NULL,
  `ended_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_usage`
--

INSERT INTO `vehicle_usage` (`vehicle_usage_id`, `vehicle_id`, `start_odometer`, `started_time`, `end_odometer`, `ended_time`, `user_id`) VALUES
(1, 2, 2000, '2016-01-18 04:56:44', 210, '2016-01-22 04:00:52', 1),
(2, 1, 10, '2016-01-18 03:54:04', 16, '2016-01-19 08:14:48', 1),
(3, 1, 20, '2016-01-18 09:25:49', 0, '0000-00-00 00:00:00', 1),
(4, 1, 10, '2016-01-18 09:27:21', 24, '2016-01-18 09:27:21', 1),
(7, 1, 40, '2016-01-19 07:32:39', 0, '0000-00-00 00:00:00', 1),
(8, 1, 30, '2016-01-19 07:49:12', 0, '0000-00-00 00:00:00', 1),
(9, 1, 61, '2016-01-19 07:54:30', 65, '2016-01-19 08:19:34', 1),
(10, 1, 67, '2016-01-19 08:25:43', 70, '2016-01-19 08:28:10', 1),
(11, 1, 72, '2016-01-20 03:49:18', 77, '2016-01-20 04:11:53', 1),
(16, 1, 83, '2016-01-20 05:24:11', 0, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_usage_line`
--

CREATE TABLE IF NOT EXISTS `vehicle_usage_line` (
  `vehicle_usage_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gps_location` varchar(250) NOT NULL,
  `active_flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_usage_line`
--

INSERT INTO `vehicle_usage_line` (`vehicle_usage_id`, `location_id`, `added_time`, `gps_location`, `active_flag`) VALUES
(2, 13, '2016-01-18 03:54:04', '', 1),
(4, 13, '2016-01-18 09:27:21', '', 1),
(4, 15, '2016-01-19 07:41:48', '', 1),
(4, 14, '2016-01-19 07:44:49', '', 1),
(8, 1, '2016-01-19 07:49:19', '', 0),
(9, 1, '2016-01-19 07:54:35', '', 1),
(7, 13, '2016-01-19 07:55:34', '', 1),
(8, 13, '2016-01-19 07:56:53', '', 1),
(9, 13, '2016-01-19 07:57:37', '', 1),
(3, 15, '2016-01-19 07:59:50', '', 1),
(3, 1, '2016-01-19 08:01:43', '', 1),
(3, 14, '2016-01-19 08:01:48', '', 1),
(10, 14, '2016-01-19 08:27:16', '', 1),
(10, 15, '2016-01-19 08:27:57', '', 0),
(11, 1, '2016-01-20 03:49:23', '', 0),
(11, 13, '2016-01-20 03:49:27', '', 1),
(11, 15, '2016-01-20 03:49:57', '', 1),
(12, 14, '2016-01-20 04:12:06', '', 1),
(12, 15, '2016-01-20 04:12:16', '', 1),
(16, 1, '2016-01-20 06:43:07', '', 1),
(16, 15, '2016-01-20 06:43:20', '', 0),
(16, 15, '2016-01-20 06:43:29', '', 0),
(16, 13, '2016-01-20 06:45:34', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `behaviour`
--
ALTER TABLE `behaviour`
 ADD PRIMARY KEY (`behaviour_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_class`
--
ALTER TABLE `course_class`
 ADD PRIMARY KEY (`class_id`,`course_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
 ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
 ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
 ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `schedule_person`
--
ALTER TABLE `schedule_person`
 ADD PRIMARY KEY (`schedule_id`,`user_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
 ADD PRIMARY KEY (`session`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
 ADD PRIMARY KEY (`class_id`,`student_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
 ADD PRIMARY KEY (`user_gp_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
 ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_maintenance`
--
ALTER TABLE `vehicle_maintenance`
 ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `vehicle_usage`
--
ALTER TABLE `vehicle_usage`
 ADD PRIMARY KEY (`vehicle_usage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `attendance_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `behaviour`
--
ALTER TABLE `behaviour`
MODIFY `behaviour_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `class_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
MODIFY `course_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `grade_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
MODIFY `lesson_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
MODIFY `noti_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `role_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
MODIFY `schedule_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
MODIFY `session` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `student_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
MODIFY `user_gp_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
MODIFY `vehicle_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vehicle_maintenance`
--
ALTER TABLE `vehicle_maintenance`
MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vehicle_usage`
--
ALTER TABLE `vehicle_usage`
MODIFY `vehicle_usage_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
