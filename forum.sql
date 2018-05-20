-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2018 at 09:10 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `user_id` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `msg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`user_id`, `date_time`, `msg`, `msg_id`) VALUES
('r.m', '2018-05-20 11:20:28', 'First message  by an admin', 21),
('r.m', '2018-05-20 11:34:49', 'Testing of posting and deleting messages is done', 23),
('mansi.d', '2018-05-20 12:00:05', 'Hello, I''m new here.', 27),
('kiara.m', '2018-05-20 12:02:41', 'Thank you for unblocking me', 28);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `role` varchar(7) NOT NULL,
  `activity_status` varchar(7) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `mob_no` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `role`, `activity_status`, `pwd`, `address`, `age`, `mob_no`) VALUES
('d.m', 'Deeku', 'user', 'blocked', '123654', '', 0, 0),
('kiara.m', 'Kiara', 'manager', 'active', '123', '', 5, 9999999999),
('mansi.d', 'Mansi', 'user', 'active', '123', 'dom', 21, 9123456789),
('p.m', 'peenu', 'user', 'blocked', '123', '', 0, 0),
('r.m', 'Rushabh', 'admin', 'active', '1234', 'Navi Mumbai', 21, 8888888818);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
