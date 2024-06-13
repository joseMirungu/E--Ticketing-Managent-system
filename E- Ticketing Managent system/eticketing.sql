-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2023 at 09:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `ComplaintId` int(19) NOT NULL,
  `Location` tinytext NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Priority` varchar(5) NOT NULL,
  `Deadline` datetime NOT NULL,
  `Timestart` datetime NOT NULL,
  ` Complainant_endtime` datetime NOT NULL,
  `Recipient_endtime` text NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Expert_assigned` varchar(20) NOT NULL,
  `desk_assigned` varchar(20) NOT NULL,
  `UserId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`ComplaintId`, `Location`, `Description`, `Priority`, `Deadline`, `Timestart`, ` Complainant_endtime`, `Recipient_endtime`, `Status`, `Department`, `Expert_assigned`, `desk_assigned`, `UserId`) VALUES
(1, 'Moiben', 'Keiziah laptop imespoil', '4', '2023-07-13 10:30:00', '2023-07-11 08:58:14', '0000-00-00 00:00:00', '2023-07-11 10:21:38', 1, 'BTC', '1', '', 0),
(2, 'Kibomet', 'Netowrk is shida', '1', '2023-07-11 23:30:00', '2023-07-11 09:01:00', '0000-00-00 00:00:00', '2023-07-11 10:46:01', 1, 'Transport', '', '', 0),
(3, 'Chakahola', 'kazi fulani hivi', '0', '2023-07-11 03:30:00', '2023-07-11 09:03:02', '0000-00-00 00:00:00', '2023-07-11 10:46:22', 1, '', '', '', 0),
(4, 'Haha', 'example job', '4', '2023-07-11 11:11:00', '2023-07-11 09:31:24', '0000-00-00 00:00:00', '', 0, 'HAahahaa', '', '', 0),
(29, 'Annex', 'kajob hivi', '6', '2023-07-14 13:20:00', '2023-07-14 09:49:23', '0000-00-00 00:00:00', '2023-07-14 12:10:46', 2, 'BTTC', '1', '', 0),
(30, 'Annex', 'stuff fulani', '6', '2023-07-14 13:20:00', '2023-07-14 09:50:12', '0000-00-00 00:00:00', '2023-07-14 11:02:25', 2, 'BTTC', '1', '', 0),
(31, 'Annex', 'Lappi shidaz', '2', '2023-07-17 12:00:00', '2023-07-17 09:26:40', '0000-00-00 00:00:00', '', 0, 'ICT', '', '', 0),
(32, 'Non', 'prrrrrrrrr', '8', '2023-07-17 13:00:00', '2023-07-17 10:41:46', '0000-00-00 00:00:00', '', 0, 'ttYC', '', '', 0),
(33, 'Muthaiga', 'Computer', '10', '2023-07-17 07:08:00', '2023-07-17 11:01:23', '0000-00-00 00:00:00', '2023-07-17 11:16:14', 2, 'X', '1', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(7) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `UserType` varchar(30) NOT NULL DEFAULT 'Client',
  `Email` tinytext NOT NULL,
  `PhoneNo` varchar(11) NOT NULL,
  `Password` varchar(13) NOT NULL,
  `AOS` tinytext DEFAULT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'No',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Name`, `UserType`, `Email`, `PhoneNo`, `Password`, `AOS`, `Status`, `date_created`) VALUES
(1, 'Billy Wanaswa', 'Admin', 'abc@ict.go.ke', '94583034', 'abc', 'Networking', 'Yes', '2023-07-27 06:50:36'),
(4, 'Hellowrorld', 'Service Desk', 'abc@abc.com', '94583496503', 'abc', 'Null', 'Yes', '2023-07-27 06:49:59'),
(5, 'Obed Nyakundi', 'IT Support', 'paulnyaxx@gmail.com', '07978392', 'sisi', NULL, 'Yes', '2023-07-27 06:56:34'),
(6, 'Ruth Gender', 'Client', 'ruth@moict.go.ke', '0789456789', 'abc', NULL, 'No', '2023-07-27 07:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`type`) VALUES
('Admin'),
('IT Support'),
('Service Desk'),
('Client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`ComplaintId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Email` (`Email`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `ComplaintId` int(19) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
