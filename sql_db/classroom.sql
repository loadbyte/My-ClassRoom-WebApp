-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2017 at 10:41 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `as_id` bigint(20) UNSIGNED NOT NULL,
  `as_name` varchar(5000) NOT NULL,
  `as_desc` varchar(5000) NOT NULL,
  `as_dead` varchar(50) NOT NULL,
  `as_c_id` bigint(20) NOT NULL,
  `as_u_id` bigint(20) NOT NULL,
  `as_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `assign_submission`
--

CREATE TABLE `assign_submission` (
  `ab_id` bigint(20) UNSIGNED NOT NULL,
  `ab_u_id` bigint(20) NOT NULL,
  `ab_as_id` bigint(20) NOT NULL,
  `ab_sub_url` varchar(5000) NOT NULL,
  `ab_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `captcha_img`
--

CREATE TABLE `captcha_img` (
  `cp_id` bigint(20) UNSIGNED NOT NULL,
  `cp_m_id` bigint(20) NOT NULL,
  `cp_pos_id` bigint(20) NOT NULL,
  `cp_img_mine` varchar(100) NOT NULL,
  `cp_img_uniq_id` varchar(100) NOT NULL,
  `cp_known` int(11) NOT NULL DEFAULT '0',
  `cp_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `contribution`
--

CREATE TABLE `contribution` (
  `cn_id` bigint(20) UNSIGNED NOT NULL,
  `cn_u_id` bigint(20) NOT NULL,
  `cn_as_id` bigint(20) NOT NULL,
  `cn_desc` varchar(5000) NOT NULL,
  `cn_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `c_id` bigint(20) UNSIGNED NOT NULL,
  `c_title` varchar(1000) NOT NULL,
  `c_desc` varchar(5000) NOT NULL,
  `c_u_id` bigint(20) NOT NULL,
  `c_from` varchar(255) NOT NULL,
  `c_to` varchar(255) NOT NULL,
  `c_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_id`, `c_title`, `c_desc`, `c_u_id`, `c_from`, `c_to`, `c_ts`) VALUES
(1, 'CS1: test course', 'test course description', 1, '01/August/2017 12:08:09', '01/December/2017 12:12:09', '2017-08-05 11:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled`
--

CREATE TABLE `course_enrolled` (
  `ce_id` bigint(20) UNSIGNED NOT NULL,
  `ce_u_id` bigint(20) NOT NULL,
  `ce_c_id` bigint(20) NOT NULL,
  `ce_enrolled_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `course_enrolled` (`ce_id`, `ce_u_id`, `ce_c_id`, `ce_enrolled_ts`) VALUES
(1, 1, 1, '2017-08-05 11:56:32');
-- --------------------------------------------------------

--
-- Table structure for table `cp_img_tag`
--

CREATE TABLE `cp_img_tag` (
  `cpt_id` bigint(20) UNSIGNED NOT NULL,
  `cpt_cp_id` bigint(20) NOT NULL,
  `cpt_positive` int(11) NOT NULL DEFAULT '0',
  `cpt_ic_id` bigint(20) NOT NULL,
  `cpt_u_id` bigint(20) NOT NULL,
  `cpt_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `days_food`
--

CREATE TABLE `days_food` (
  `df_id` bigint(20) UNSIGNED NOT NULL,
  `df_mdf_id` bigint(20) NOT NULL,
  `df_ic_id` bigint(20) NOT NULL,
  `df_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Day_time`
--

CREATE TABLE `Day_time` (
  `dt_id` bigint(20) UNSIGNED NOT NULL,
  `dt_day_time` varchar(50) NOT NULL,
  `dt_mfd_id` bigint(20) NOT NULL,
  `dt_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Day_time`
--

INSERT INTO `Day_time` (`dt_id`, `dt_day_time`, `dt_mfd_id`, `dt_ts`) VALUES
(1, 'Monday Morning', 1, '2017-07-28 11:42:44'),
(2, 'Monday Noon', 1, '2017-07-28 11:42:48'),
(3, 'Monday Night', 1, '2017-07-28 11:42:51'),
(4, 'Tuesday Morning', 1, '2017-07-28 11:42:53'),
(5, 'Tuesday Noon', 1, '2017-07-28 11:42:56'),
(11, 'Tuesday Night', 1, '2017-07-28 11:40:42'),
(12, 'Wednesday Morning', 1, '2017-07-28 11:40:42'),
(13, 'Wednesday Noon', 1, '2017-07-28 11:40:42'),
(14, 'Wednesday Night', 1, '2017-07-28 11:40:42'),
(15, 'Thursday Morning', 1, '2017-07-28 11:40:42'),
(16, 'Thursday Noon', 1, '2017-07-28 11:40:42'),
(17, 'Thursday Night', 1, '2017-07-28 11:40:42'),
(18, 'Friday Morning', 1, '2017-07-28 11:41:10'),
(19, 'Friday Noon', 1, '2017-07-28 11:41:10'),
(20, 'Friday Night', 1, '2017-07-28 11:41:10'),
(21, 'Saturday Morning', 1, '2017-07-28 11:41:10'),
(22, 'Saturday Noon', 1, '2017-07-28 11:41:10'),
(23, 'Saturday Night', 1, '2017-07-28 11:41:10'),
(24, 'Sunday Morning', 1, '2017-07-28 11:41:32'),
(25, 'Sunday Noon', 1, '2017-07-28 11:41:32'),
(26, 'Sunday Night', 1, '2017-07-28 11:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `g_id` bigint(20) UNSIGNED NOT NULL,
  `g_name` varchar(500) NOT NULL,
  `g_u_id` bigint(20) NOT NULL,
  `g_c_id` bigint(20) NOT NULL,
  `g_status` int(11) NOT NULL DEFAULT '0',
  `g_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`g_id`, `g_name`, `g_u_id`, `g_c_id`, `g_status`, `g_ts`) VALUES
(1, 'mvk', 1, 4, 1, '2017-08-02 18:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `img_category`
--

CREATE TABLE `img_category` (
  `ic_id` bigint(20) UNSIGNED NOT NULL,
  `ic_name` varchar(1000) NOT NULL,
  `ic_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `img_category`
--

INSERT INTO `img_category` (`ic_id`, `ic_name`, `ic_ts`) VALUES
(1, 'Rice', '2017-07-28 10:06:37'),
(2, 'Roti', '2017-07-28 10:06:37'),
(3, 'Empty Plate', '2017-08-05 12:08:45'),
(4, 'Dal', '2017-07-28 10:07:06'),
(5, 'Used Plate', '2017-07-30 13:15:47'),
(6, 'sabzi', '2017-07-30 14:21:44'),
(7, 'onion', '2017-08-05 12:07:00'),
(8, 'cucumber', '2017-08-05 12:07:00'),
(9, 'Middle Empty Plate', '2017-08-05 12:09:50'),
(10, 'Middle Used Plate', '2017-08-05 12:09:50'),
(11, 'Aloo', '2017-08-05 12:15:33'),
(13, 'Rice Remain', '2017-08-05 12:16:32'),
(14, 'Dal Remain', '2017-08-05 12:16:32'),
(15, 'poori', '2017-08-05 12:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `mess_before_after`
--

CREATE TABLE `mess_before_after` (
  `mba_id` bigint(20) UNSIGNED NOT NULL,
  `mba_b_m_id` bigint(20) NOT NULL,
  `mba_a_m_id` bigint(20) NOT NULL,
  `mba_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `mess_food_day_menu`
--

CREATE TABLE `mess_food_day_menu` (
  `mfd_id` bigint(20) UNSIGNED NOT NULL,
  `mfd_name` varchar(1000) NOT NULL,
  `mfd_from` varchar(100) NOT NULL,
  `mfd_to` varchar(100) NOT NULL,
  `mfd_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mess_food_day_menu`
--

INSERT INTO `mess_food_day_menu` (`mfd_id`, `mfd_name`, `mfd_from`, `mfd_to`, `mfd_ts`) VALUES
(1, 'Test Dihing Mess', 'jul', 'dec', '2017-08-05 18:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `mess_images`
--

CREATE TABLE `mess_images` (
  `m_img_id` bigint(20) UNSIGNED NOT NULL,
  `m_u_id` bigint(20) NOT NULL,
  `m_mfd_id` bigint(20) NOT NULL,
  `m_uniq_id` varchar(100) NOT NULL,
  `m_dt_id` bigint(20) NOT NULL,
  `m_img_mine` varchar(50) NOT NULL,
  `m_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studcontrib`
--

CREATE TABLE `studcontrib` (
  `st_id` bigint(20) UNSIGNED NOT NULL,
  `st_as_id` bigint(20) NOT NULL,
  `st_ta_u_id` bigint(20) NOT NULL,
  `st_u_id` bigint(20) NOT NULL,
  `st_desc` varchar(5000) NOT NULL,
  `st_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testtable`
--

CREATE TABLE `testtable` (
  `test` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `tk_id` bigint(20) UNSIGNED NOT NULL,
  `tk_token` varchar(1000) NOT NULL,
  `tk_email` varchar(1000) NOT NULL,
  `tk_used` int(11) NOT NULL DEFAULT '0',
  `tk_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` bigint(20) UNSIGNED NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `u_roll_num` int(11) NOT NULL DEFAULT '0',
  `u_role` int(11) NOT NULL DEFAULT '1',
  `u_default_c_id` bigint(20) NOT NULL DEFAULT '0',
  `u_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_pass`, `u_roll_num`, `u_role`, `u_default_c_id`, `u_ts`) VALUES
(1, 'admin', 'admin@myclassroom.in', 'dd14b9cc821618050366fb5ee5a55e82', 164101027, 2, 1, '2017-08-05 18:44:13');


-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `ug_id` bigint(20) UNSIGNED NOT NULL,
  `ug_u_id` bigint(20) NOT NULL,
  `ug_g_id` bigint(20) NOT NULL,
  `ug_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `verified_classified_images`
--

CREATE TABLE `verified_classified_images` (
  `cl_id` bigint(20) UNSIGNED NOT NULL,
  `cl_cp_id` bigint(20) NOT NULL,
  `cl_ic_id` bigint(20) NOT NULL,
  `cl_view_cnt` int(11) NOT NULL DEFAULT '0',
  `cl_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD UNIQUE KEY `as_id` (`as_id`);

--
-- Indexes for table `assign_submission`
--
ALTER TABLE `assign_submission`
  ADD UNIQUE KEY `ab_id` (`ab_id`);

--
-- Indexes for table `captcha_img`
--
ALTER TABLE `captcha_img`
  ADD UNIQUE KEY `cp_id` (`cp_id`);

--
-- Indexes for table `contribution`
--
ALTER TABLE `contribution`
  ADD UNIQUE KEY `cn_id` (`cn_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD UNIQUE KEY `c_id` (`c_id`);

--
-- Indexes for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  ADD UNIQUE KEY `ce_id` (`ce_id`);

--
-- Indexes for table `cp_img_tag`
--
ALTER TABLE `cp_img_tag`
  ADD UNIQUE KEY `cpt_id` (`cpt_id`);

--
-- Indexes for table `days_food`
--
ALTER TABLE `days_food`
  ADD UNIQUE KEY `mf_id` (`df_id`);

--
-- Indexes for table `Day_time`
--
ALTER TABLE `Day_time`
  ADD UNIQUE KEY `dt_id` (`dt_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD UNIQUE KEY `g_id` (`g_id`);

--
-- Indexes for table `img_category`
--
ALTER TABLE `img_category`
  ADD UNIQUE KEY `ic_id` (`ic_id`);

--
-- Indexes for table `mess_before_after`
--
ALTER TABLE `mess_before_after`
  ADD UNIQUE KEY `mba_id` (`mba_id`);

--
-- Indexes for table `mess_food_day_menu`
--
ALTER TABLE `mess_food_day_menu`
  ADD UNIQUE KEY `mfd_id` (`mfd_id`);

--
-- Indexes for table `mess_images`
--
ALTER TABLE `mess_images`
  ADD UNIQUE KEY `m_img_id` (`m_img_id`);

--
-- Indexes for table `studcontrib`
--
ALTER TABLE `studcontrib`
  ADD UNIQUE KEY `st_id` (`st_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD UNIQUE KEY `tk_id` (`tk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD UNIQUE KEY `ug_id` (`ug_id`);

--
-- Indexes for table `verified_classified_images`
--
ALTER TABLE `verified_classified_images`
  ADD UNIQUE KEY `cl_id` (`cl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `as_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `assign_submission`
--
ALTER TABLE `assign_submission`
  MODIFY `ab_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `captcha_img`
--
ALTER TABLE `captcha_img`
  MODIFY `cp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1367;
--
-- AUTO_INCREMENT for table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `cn_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `c_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `course_enrolled`
--
ALTER TABLE `course_enrolled`
  MODIFY `ce_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `cp_img_tag`
--
ALTER TABLE `cp_img_tag`
  MODIFY `cpt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `days_food`
--
ALTER TABLE `days_food`
  MODIFY `df_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Day_time`
--
ALTER TABLE `Day_time`
  MODIFY `dt_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `g_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `img_category`
--
ALTER TABLE `img_category`
  MODIFY `ic_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `mess_before_after`
--
ALTER TABLE `mess_before_after`
  MODIFY `mba_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mess_food_day_menu`
--
ALTER TABLE `mess_food_day_menu`
  MODIFY `mfd_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mess_images`
--
ALTER TABLE `mess_images`
  MODIFY `m_img_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `studcontrib`
--
ALTER TABLE `studcontrib`
  MODIFY `st_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `tk_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `ug_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `verified_classified_images`
--
ALTER TABLE `verified_classified_images`
  MODIFY `cl_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
