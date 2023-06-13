-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2023 at 01:49 PM
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
-- Database: `gutierre_sdev328`
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
(1, 'Algorithms', 2, 'Robert Sedgewick and Kevin Wayne', '', 'This textbook surveys the most important algorithms and data structures in use today. Each algorithm is addressed by examining its impact on applications to science, engineering, and industry. The textbook is organized into six chapters:\r\nChapter 1: Fundamentals introduces a scientific and engineering basis for comparing algorithms and making predictions. It also includes our programming model.\r\nChapter 2: Sorting considers several classic sorting algorithms, including insertion sort, mergesort, and quicksort. It also features a binary heap implementation of a priority queue.\r\nChapter 3: Searching describes several classic symbol-table implementations, including binary search trees, redâ€“black trees, and hash tables.\r\nChapter 4: Graphs surveys the most important graph-processing problems, including depth-first search, breadth-first search, minimum spanning trees, and shortest paths.\r\nChapter 5: Strings investigates specialized algorithms for string processing, including radix sorting, substring search, tries, regular expressions, and data compression.\r\nChapter 6: Context highlights connections to systems programming, scientific computing, commercial applications, operations research, and intractability.', 'Software Development', 'images/default_book.jpg', 'default_book.jpg', 30.00, 1, '12:08:32'),
(2, 'PHP and MySQL for Dynamic Web Sites', 2, 'Larry Ullman', '', 'Learn PHP and MySQL programmingâ€” the quick and easy way! Easy visual approach uses demonstrations and real-world examples to guide you step by step through advanced techniques for dynamic Web development using PHP and MySQL.', 'Software Development', 'uploads/648895458c191php-mysql.jpg', '648895458c191php-mysql.jpg', 15.00, 1, '12:11:49'),
(3, 'Intro to Python for Computer Science and Data Science', 2, 'Paul Deitel and Harvey M. Deitel', '', 'Introduction to Python for Computer Science and Data Science takes a unique, modular approach to teaching and learning introductory Python programming that is relevant for both computer science and data science audiences. The Deitels cover the most current topics and applications to prepare you for your career. Jupyter Notebooks supplements provide opportunities to test your programming skills. Fully implemented case studies in artificial intelligence technologies and big data let you apply your knowledge to interesting projects in the business, industry, government and academia sectors. Hundreds of hands-on examples, exercises and projects offer a challenging and entertaining introduction to Python and data science.', 'Software Development', 'uploads/648896ec0c9a0intro-to-python.jpg', '648896ec0c9a0intro-to-python.jpg', 50.00, 1, '12:18:52'),
(4, 'C# & C++: 5 Books in 1 - The #1 Coding Course from Beginner to Advanced', 2, 'Mark Reed', '', 'Learn the basic functions of C# and C++ Programming and progress on to advanced levels. Immerse yourself in the wealth of notions, exercises and practical examples made easily digestible for effortless learning and prompt gratification.', 'Software Development', 'uploads/6488987c1eb35c_and_c-plus-plus.jpg', '6488987c1eb35c_and_c-plus-plus.jpg', 15.00, 1, '12:25:32'),
(5, 'Labore qui assumenda', 6, 'Eligendi cum mollit ', NULL, 'Aliquam quos velit s', 'Alias vel iure sunt ', 'uploads/648525203221961mIq2iJUXL.jpg', '648525203221961mIq2iJUXL.jpg', 585.00, 1, '21:36:32'),
(6, 'Cupidatat illo labor', 6, 'Mollitia facere fugi', NULL, 'Quibusdam laboriosam', 'Vero rerum officia o', 'uploads/64852530863f181Gt2O4FvTL.jpg', '64852530863f181Gt2O4FvTL.jpg', 679.00, 1, '21:36:48'),
(7, 'Et mollit aut minim ', 6, 'Dolore alias aliquip', NULL, 'Rerum error omnis se', 'Quam quasi iure cons', 'uploads/648525472358b91Ss-Th23nL.jpg', '648525472358b91Ss-Th23nL.jpg', 995.00, 1, '21:37:11'),
(8, 'In voluptates illo v', 6, 'In dolores et nulla ', NULL, 'Ut corporis fugiat a', 'Maxime ipsa volupta', 'uploads/64852556d8cce71oZ45OrLjL.jpg', '64852556d8cce71oZ45OrLjL.jpg', 460.00, 1, '21:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

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
(1, 'Anthony', 'Gutierrez', '1234567890', '', 'gutierrez.anthony@student.greenriver.edu', 1, '$2y$10$boGBB.E4M.YCHn6Y8SWN/e9648FsUSELUEUCjSEesFwBhozFDZL1e', 'de11eeea-09bf-11ee-90fe-f23c91a78bbf', NULL, 0),
(2, 'Anthony', 'Gutierrez', '1234567890', '1234 Lane, Auburn, WA, 98001', 'gutierrezanthony715@gmail.com', 0, '$2y$10$83aknNASEMjI34jXn5ILLuDgJGhYPYZ4PoFk550VIK4Ml/ltP.1Qq', '1dda9ce6-0a04-11ee-90fe-f23c91a78bbf', NULL, 0);

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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
