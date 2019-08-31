-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 03, 2019 at 10:36 PM
-- Server version: 10.2.12-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5111060_social`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `u_id1` int(11) NOT NULL,
  `u_id2` int(11) NOT NULL,
  `chat_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `u_id1`, `u_id2`, `chat_datetime`) VALUES
(1, 14, 16, '2018-03-16 14:22:33'),
(2, 14, 17, '2018-03-16 14:28:56'),
(3, 16, 17, '2018-03-17 08:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `com_id` int(11) NOT NULL,
  `com_text` varchar(250) NOT NULL,
  `com_datetime` datetime NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `comment` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `f_id` int(11) NOT NULL,
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`f_id`, `user_id1`, `user_id2`, `role`) VALUES
(37, 14, 16, 1),
(39, 17, 16, 1),
(40, 14, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imgpost`
--

CREATE TABLE `imgpost` (
  `imgpost_id` int(11) NOT NULL,
  `imgpost` text NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `l_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `like_role` tinyint(1) NOT NULL,
  `like_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`l_id`, `u_id`, `p_id`, `like_role`, `like_datetime`) VALUES
(28, 14, 0, 0, '2018-02-24 15:50:02'),
(31, 14, 0, 0, '2018-03-17 15:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `msg_id` int(11) NOT NULL,
  `msg_text` text NOT NULL,
  `msg_datetime` datetime NOT NULL,
  `u_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`msg_id`, `msg_text`, `msg_datetime`, `u_id`, `chat_id`, `role`) VALUES
(54, 'hi', '2018-03-17 11:39:08', 14, 1, 1),
(55, 'hi', '2018-03-17 15:16:56', 16, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL,
  `p_text` varchar(250) NOT NULL,
  `p_datetime` datetime NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_password` char(32) NOT NULL,
  `u_f_name` varchar(20) NOT NULL,
  `u_s_name` varchar(20) NOT NULL,
  `u_city` varchar(20) NOT NULL,
  `u_country` varchar(20) NOT NULL,
  `u_gender` varchar(15) NOT NULL,
  `u_username` varchar(30) NOT NULL,
  `u_img_profile` text NOT NULL,
  `u_img_cover` text NOT NULL,
  `u_bio` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_email`, `u_password`, `u_f_name`, `u_s_name`, `u_city`, `u_country`, `u_gender`, `u_username`, `u_img_profile`, `u_img_cover`, `u_bio`) VALUES
(14, 'red.devile2011@gmail.com', 'a9eea5ad37d2c7f39030068c2489aa9c', 'mohamed', 'khairy', 'damanhour', 'مصر', 'Male', '@mo7md', '1521280388761m.jpg', '1521280409800Capture.JPG', 'قد لا أكون الأجمل ... وقد لا أكون الأروع ... وقد لا أكون الأذكى ... وقد لا أكون الأبرع...\r\nولكنني اذا جائني المهموم اسمع ... واذا ناداني صديق لحاجه أنفع ...\r\nوحتى اذا حصدت شوكا فسأظل للورد ازرع ... واذا كان الكون واسعا فقلبي احن واوسع'),
(16, 'ahmed@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Ahmed', 'khairy', 'damanhour', 'مصر', 'Male', '@ahmed', '15188732095801558463_813123375379837_949555543_n - Copy.jpg', '1521280589913sasa.JPG', 'yarb'),
(17, 'mahmoud@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'mahmoud', 'khairy', 'damanhour', 'مصر', 'Male', '@mahmoud', '151918404720128059219_1395545710545249_7351575861131747723_n.jpg', '15191840477981609674_1414675445440056_1269438236_n.jpg', 'لا اله الا الله'),
(18, 'shimoo1281@gmail.com', 'c822c1b63853ed273b89687ac505f9fa', 'فيزة احمد Ali', ' .', 'mansoura', 'egypt', '', '@فيزة احمد Ali', 'face.jpg', '15213645425441800269_614525635279428_1877663531_n.jpg', ''),
(20, '', 'b73c2d22763d1ce2143a3755c1d0ad3a', 'Mo7md_5airy', '', 'Damanhour', '', '', '@Mo7md_5airy', 'face.jpg', 'background.jpg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `imgpost`
--
ALTER TABLE `imgpost`
  ADD PRIMARY KEY (`imgpost_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `imgpost`
--
ALTER TABLE `imgpost`
  MODIFY `imgpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
