-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2023 at 12:17 AM
-- Server version: 10.2.44-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mehdigre_bookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

DROP TABLE IF EXISTS `Book`;
CREATE TABLE `Book` (
  `book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `owner` int(11) NOT NULL,
  `authors` varchar(200) NOT NULL,
  `edition` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `photoPath` varchar(200) DEFAULT NULL,
  `photo_name` varchar(200) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT 0,
  `post_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`book_id`, `title`, `owner`, `authors`, `edition`, `description`, `subject`, `photoPath`, `photo_name`, `price`, `isApproved`, `post_time`) VALUES
(2, 'Labore qui assumenda', 6, 'Eligendi cum mollit ', NULL, 'Aliquam quos velit s', 'Alias vel iure sunt ', 'uploads/648525203221961mIq2iJUXL.jpg', '648525203221961mIq2iJUXL.jpg', 585.00, 0, '21:36:32'),
(3, 'Cupidatat illo labor', 6, 'Mollitia facere fugi', NULL, 'Quibusdam laboriosam', 'Vero rerum officia o', 'uploads/64852530863f181Gt2O4FvTL.jpg', '64852530863f181Gt2O4FvTL.jpg', 679.00, 0, '21:36:48'),
(4, 'Et mollit aut minim ', 6, 'Dolore alias aliquip', NULL, 'Rerum error omnis se', 'Quam quasi iure cons', 'uploads/648525472358b91Ss-Th23nL.jpg', '648525472358b91Ss-Th23nL.jpg', 995.00, 0, '21:37:11'),
(5, 'In voluptates illo v', 6, 'In dolores et nulla ', NULL, 'Ut corporis fugiat a', 'Maxime ipsa volupta', 'uploads/64852556d8cce71oZ45OrLjL.jpg', '64852556d8cce71oZ45OrLjL.jpg', 460.00, 0, '21:37:26'),
(6, 'Quo duis ex accusant', 6, 'Do repudiandae deser', '', 'Vel eiusmod velit q', 'Itaque quia laboris ', 'uploads/64852fda939a8Reducing flamma 0.png', '64852fda939a8Reducing flamma 0.png', 100.00, 0, '22:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

DROP TABLE IF EXISTS `Person`;
CREATE TABLE `Person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `uuid` varchar(50) DEFAULT NULL,
  `password_timestamp` time DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`person_id`, `first_name`, `last_name`, `phone`, `address`, `email`, `is_admin`, `password`, `uuid`, `password_timestamp`, `is_active`) VALUES
(6, 'Mehdi', 'Jokar', '2065656710', '608 39Th Ave SW, Apt D20', 'jokar.mehdi2@gmail.com', 1, '$2y$10$rX1A1kT3ipm744HuqPiDDu5G78gRFSNrAO8mCDRUcSIIbO.OpNtS6', 'cf9f4b66-0753-11ee-90fe-f23c91a78bbf', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Book`
--
ALTER TABLE `Book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
