-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 05:18 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogging`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(10) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`id`, `user_name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(10) NOT NULL,
  `fk_post_id` int(10) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `fk_user_id` varchar(30) COLLATE utf8_bin NOT NULL,
  `commented_date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_comment`
--

INSERT INTO `blog_comment` (`id`, `fk_post_id`, `comment`, `fk_user_id`, `commented_date_time`) VALUES
(1, 1, 'wow, beautiful..', '1', '2021-07-19 17:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(10) NOT NULL,
  `blog_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `blog_desc` text COLLATE utf8_bin NOT NULL,
  `blog_photo` varchar(10) COLLATE utf8_bin NOT NULL,
  `blog_category` varchar(30) COLLATE utf8_bin NOT NULL,
  `blog_status` char(1) COLLATE utf8_bin NOT NULL,
  `created_date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `blog_title`, `blog_desc`, `blog_photo`, `blog_category`, `blog_status`, `created_date_time`) VALUES
(1, 'The art of capturing landscape', '“When words become unclear, I shall focus with photographs. When images become inadequate, I shall be content with silence.”', '522.jpg', 'Landscape', 'P', '2021-07-18 21:33:45'),
(3, 'In to the Wild', '“To photograph is to hold one’s breath, when all faculties converge to capture fleeting reality. It’s at that precise moment that mastering an image becomes a great physical and intellectual joy.”', '187.jpg', 'Wildlife', 'P', '2021-07-23 12:56:57'),
(4, 'Express yourself with images', '\"There is a creative fraction of a second when you are taking a picture. Your eye must see a composition or an expression that life itself offers you, and you must know with intuition when to click the camera. That is the moment the photographer is creative. Oop! The Moment! Once you miss it, it is gone forever.\"', '168.jpg', 'Street', 'P', '2021-07-23 13:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `id` int(10) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_post_id` int(11) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`id`, `fk_user_id`, `fk_post_id`, `rating_action`) VALUES
(1, 1, 1, 'Like'),
(2, 1, 3, 'Like');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(10) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `user_pass` varchar(30) COLLATE utf8_bin NOT NULL,
  `created_date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `user_pass`, `created_date_time`) VALUES
(1, 'kushal321@.com', '321', '2021-07-20 15:28:36'),
(2, 'ani111@.com', '111', '2021-07-20 18:31:25'),
(3, 'abhijit12@.com', '12', '2021-07-22 14:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_massage`
--

CREATE TABLE `user_massage` (
  `id` int(10) NOT NULL,
  `fk_user_id` int(10) NOT NULL,
  `user_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `user_email` varchar(30) COLLATE utf8_bin NOT NULL,
  `user_massage` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_massage`
--

INSERT INTO `user_massage` (`id`, `fk_user_id`, `user_name`, `user_email`, `user_massage`) VALUES
(1, 1, 'Akash Roy', 'akash99@gmail.com', 'hi, i am akash');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_rating_info` (`fk_user_id`,`fk_post_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_massage`
--
ALTER TABLE `user_massage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating_info`
--
ALTER TABLE `rating_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_massage`
--
ALTER TABLE `user_massage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
