-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 03:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_db`
--
CREATE DATABASE perpustakaan_db;
USE perpustakaan_db;
-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(50) NOT NULL,
  `book_copies` int(11) NOT NULL,
  `publisher_name` varchar(100) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `copyright_year` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_title`, `category`, `author`, `book_copies`, `publisher_name`, `isbn`, `copyright_year`, `status`) VALUES
(1, 'Database dan ERD', 'Teknologi', 'Fajar Agung', 4, 'Unpam Press', '1232123432123', 2021, '1'),
(2, 'Matematika Diskrit', 'Pendidikan', 'Saptono', 2, 'Erlangga', '1234243463455', 2021, '0'),
(3, 'Database Relational', 'Teknologi', 'Fajar Agung', 4, 'Unpam Press', '1232123432123', 2022, '1'),
(4, 'Logika Matematika', 'Pendidikan', 'Saptono', 2, 'Erlangga', '1234243463455', 2021, '1'),
(5, 'Database Fundamental', 'Teknologi', 'Fajar Agung', 4, 'Unpam Press', '1232123456454', 2024, '1'),
(6, 'Database Intermediate', 'Teknologi', 'Fajar Agung', 4, 'Unpam Press', '1232178978895', 2021, '1');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_borrow` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `member_id`, `date_borrow`, `due_date`, `status`) VALUES
(2, 5, '2025-06-20', '2025-06-27', 1),
(3, 6, '2025-06-20', '2025-06-27', 1),
(4, 6, '2025-06-20', '2025-06-27', 1),
(9, 9, '2025-06-25', '2025-07-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrowdetails`
--

CREATE TABLE `borrowdetails` (
  `borrow_details_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `borrow_status` int(11) DEFAULT 1,
  `date_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowdetails`
--

INSERT INTO `borrowdetails` (`borrow_details_id`, `book_id`, `borrow_id`, `borrow_status`, `date_return`) VALUES
(5, 5, 2, 1, '2025-06-20'),
(6, 3, 2, 1, '2025-06-20'),
(7, 4, 2, 1, '2025-06-20'),
(9, 5, 3, 1, '2025-06-20'),
(10, 6, 3, 1, '2025-06-20'),
(11, 2, 3, 1, '2025-06-20'),
(12, 1, 4, 1, '2025-06-20'),
(13, 3, 4, 1, '2025-06-20'),
(19, 2, 9, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `firstname`, `lastname`, `email`, `gender`, `address`, `contact`, `type`, `status`) VALUES
(5, 'Sarah', 'Azhari', 'sarah@gmail.co', 'P', 'depok', '09821392', 'Siswa', 1),
(6, 'Valentino', 'Ronald', 'Ronald@gmail.com', 'L', 'Depok', '09821392', 'Siswa', 1),
(8, 'adrian', 'yudha', 'aaa@gmail.com', 'L', 'waaw', '0878', 'Guru', 1),
(9, 'egi', 'sapputra', 'egi@gmail.cpm', 'L', 'asd', '0889999', 'Guru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`) VALUES
(1, 'admin', '$2y$10$LF.OSu192DukatY/Fm755ek2YZaoOiTn/b9E5iODMG4OAx5ZRSGoy', 'super', 'admin'),
(2, 'adrian', '$2y$10$Bi2U7OtF4ChT2yinMSBRtuVXJoLaSAoIo8hQa3zaJ.y4j/kiXzXRm', 'adrian', 'yudhaswara'),
(3, 'adrian123', '$2y$10$rFKBHSElAy7VmhLC4xEEXuN54nmX4Lwb3RxA9KWJ0miA0eo32kGw2', 'adrian', 'yudhaswara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `idx_member_id` (`member_id`);

--
-- Indexes for table `borrowdetails`
--
ALTER TABLE `borrowdetails`
  ADD PRIMARY KEY (`borrow_details_id`),
  ADD KEY `idx_book_id` (`book_id`),
  ADD KEY `idx_borrow_id` (`borrow_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `uk_email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uk_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `borrowdetails`
--
ALTER TABLE `borrowdetails`
  MODIFY `borrow_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `fk_borrow_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrowdetails`
--
ALTER TABLE `borrowdetails`
  ADD CONSTRAINT `fk_borrowdetails_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`),
  ADD CONSTRAINT `fk_borrowdetails_borrow` FOREIGN KEY (`borrow_id`) REFERENCES `borrow` (`borrow_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
