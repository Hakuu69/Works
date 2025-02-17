-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 08:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

-- Create the 'works' database if it doesn't exist
CREATE DATABASE IF NOT EXISTS works;

-- Select the 'works' database
USE works;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: 'works`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` char(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `profimg` varchar(500) NOT NULL,
  `id1` varchar(500) NOT NULL,
  `id2` varchar(500) NOT NULL,
  `resume` varchar(500) NOT NULL,
  `specialty` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `birthday`, `email`, `contact`, `password`, `role`, `profimg`, `id1`, `id2`, `resume`, `specialty`) VALUES
(0, 'Patrick', 'Ocampo', 'Mallari', '1997-03-27', 'patrick@gmail.com', '09123456789', 'bossrome', 'admin', '../uploads/sample.png', '../uploads/sample.png', '../uploads/sample.png', '../uploads/sample.png', 'test'),
(1, 'Charls', 'Marcelo', 'Caliboso', '2002-05-08', 'employer@gmail.com', '09394309127', 'employer', 'employer', '../uploads/sample.png', '../uploads/sample.png', '../uploads/sample.png', '../uploads/sample.png', 'test'),
(2, 'Dave', 'Nino', 'Larracas', '2023-11-03', 'worker@gmail.com', '09123456789', 'worker', 'worker', '../uploads/sample.png', '../uploads/sample.png', '../uploads/sample.png', '../uploads/sample.png', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;