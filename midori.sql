-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2026 at 05:01 PM
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
  `moisture` int(3) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `senser-logs`
--

INSERT INTO `senser-logs` (`logsID`, `moisture`, `status`, `created_at`) VALUES
(1, 25, 'Dry - Need Water', '2026-07-27 01:00:00'),
(2, 45, 'Optimal', '2026-07-27 01:05:00'),
(3, 70, 'Moist', '2026-07-27 02:00:00'),
(4, 20, 'Dry - Need Water', '2026-07-27 05:00:00'),
(5, 65, 'Optimal', '2026-07-27 05:05:00');

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
  MODIFY `logsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wetering_history`
--
ALTER TABLE `wetering_history`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
