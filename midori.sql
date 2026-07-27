-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2026 at 11:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midori`
--

-- --------------------------------------------------------

--
-- Table structure for table `senser-logs`
--

CREATE TABLE `senser-logs` (
  `logsID` int(11) NOT NULL,
  `maisture` int(3) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wetering_history`
--

CREATE TABLE `wetering_history` (
  `historyID` int(11) NOT NULL,
  `water_amount_ml` int(5) NOT NULL,
  `duration_seconds` int(5) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `trigger_source` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `senser-logs`
--
ALTER TABLE `senser-logs`
  ADD PRIMARY KEY (`logsID`);

--
-- Indexes for table `wetering_history`
--
ALTER TABLE `wetering_history`
  ADD PRIMARY KEY (`historyID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `senser-logs`
--
ALTER TABLE `senser-logs`
  MODIFY `logsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wetering_history`
--
ALTER TABLE `wetering_history`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
