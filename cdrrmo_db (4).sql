-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 07:02 AM
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
-- Database: `cdrrmo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `caller_first_name` varchar(255) DEFAULT NULL,
  `caller_last_name` varchar(255) DEFAULT NULL,
  `caller_address` varchar(255) DEFAULT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `caller_middle_initial` varchar(255) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `specific_location` varchar(255) DEFAULT NULL,
  `incident_type` text DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `vehicle_involved` text DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `individuals_affected` text DEFAULT NULL,
  `number_affected` int(11) DEFAULT NULL,
  `resolution_remarks` text DEFAULT NULL,
  `verification_remarks` text DEFAULT NULL,
  `response` date DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  `departure` time DEFAULT NULL,
  `arrival` time DEFAULT NULL,
  `dept` time DEFAULT NULL,
  `base` time DEFAULT NULL,
  `person` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `first` varchar(255) DEFAULT NULL,
  `fn` varchar(255) DEFAULT NULL,
  `last` varchar(255) DEFAULT NULL,
  `ln` varchar(255) DEFAULT NULL,
  `mi` varchar(255) DEFAULT NULL,
  `middle` varchar(255) DEFAULT NULL,
  `co_number` varchar(11) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `platenumber` varchar(255) DEFAULT NULL,
  `severity` varchar(255) DEFAULT NULL,
  `vehicle` varchar(255) DEFAULT NULL,
  `atd` varchar(255) DEFAULT NULL,
  `closed_by` varchar(255) DEFAULT NULL,
  `Incident_ID` varchar(255) DEFAULT NULL,
  `action_taken` varchar(255) DEFAULT NULL,
  `verified_by` varchar(255) DEFAULT NULL,
  `action_taken_others` varchar(255) DEFAULT NULL,
  `victim_ln` varchar(255) DEFAULT NULL,
  `victim_fn` varchar(255) DEFAULT NULL,
  `victim_mi` varchar(255) DEFAULT NULL,
  `victim_age` int(3) DEFAULT NULL,
  `victim_gender` varchar(255) DEFAULT NULL,
  `victim_address` varchar(255) DEFAULT NULL,
  `victim_status` varchar(255) DEFAULT NULL,
  `victim_item` varchar(255) DEFAULT NULL,
  `fileInput2` varchar(255) DEFAULT NULL,
  `fileInput` varchar(255) DEFAULT NULL,
  `victim_ln2` varchar(255) DEFAULT NULL,
  `victim_fn2` varchar(255) DEFAULT NULL,
  `victim_mi2` varchar(255) DEFAULT NULL,
  `victim_age2` int(255) DEFAULT NULL,
  `victim_gender2` varchar(255) DEFAULT NULL,
  `victim_address2` varchar(255) DEFAULT NULL,
  `victim_status2` varchar(255) DEFAULT NULL,
  `victim_item2` varchar(255) DEFAULT NULL,
  `leader_fullname` varchar(255) DEFAULT NULL,
  `driver_fullname` varchar(255) DEFAULT NULL,
  `nurse_fullname` varchar(255) DEFAULT NULL,
  `emt_fullname` varchar(255) DEFAULT NULL,
  `report_text` varchar(255) DEFAULT NULL,
  `text_action_dispatch` text DEFAULT NULL,
  `text_action_arrive` text DEFAULT NULL,
  `text_victim_details` varchar(255) DEFAULT NULL,
  `victim_details` varchar(255) DEFAULT NULL,
  `prepared_by` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `encoded_by` varchar(255) DEFAULT NULL,
  `encoder_position` varchar(255) DEFAULT NULL,
  `noted_by` varchar(255) DEFAULT NULL,
  `position_noted` varchar(255) DEFAULT NULL,
  `team_departed_scene` varchar(255) DEFAULT NULL,
  `team_arrived_base` varchar(255) DEFAULT NULL,
  `othervictims1` varchar(255) DEFAULT NULL,
  `othervictims2` varchar(255) DEFAULT NULL,
  `other_dispatch` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `status`, `date`, `time`, `source`, `caller_first_name`, `caller_last_name`, `caller_address`, `contact`, `age`, `caller_middle_initial`, `location`, `specific_location`, `incident_type`, `additional_details`, `vehicle_involved`, `vehicle_type`, `individuals_affected`, `number_affected`, `resolution_remarks`, `verification_remarks`, `response`, `level`, `departure`, `arrival`, `dept`, `base`, `person`, `brand`, `first`, `fn`, `last`, `ln`, `mi`, `middle`, `co_number`, `other`, `others`, `platenumber`, `severity`, `vehicle`, `atd`, `closed_by`, `Incident_ID`, `action_taken`, `verified_by`, `action_taken_others`, `victim_ln`, `victim_fn`, `victim_mi`, `victim_age`, `victim_gender`, `victim_address`, `victim_status`, `victim_item`, `fileInput2`, `fileInput`, `victim_ln2`, `victim_fn2`, `victim_mi2`, `victim_age2`, `victim_gender2`, `victim_address2`, `victim_status2`, `victim_item2`, `leader_fullname`, `driver_fullname`, `nurse_fullname`, `emt_fullname`, `report_text`, `text_action_dispatch`, `text_action_arrive`, `text_victim_details`, `victim_details`, `prepared_by`, `position`, `encoded_by`, `encoder_position`, `noted_by`, `position_noted`, `team_departed_scene`, `team_arrived_base`, `othervictims1`, `othervictims2`, `other_dispatch`) VALUES
(1, 'Resolved', '2024-04-02', '15:33:14', 'Phone/Message', 'Juan', 'Dela Cruz', 'San Joaquin', '09133212122', 21, 'M.', 'Barangay III', 'Purok 2', 'Medical, Trauma, Vehicular-accident', 'Ran over', 'Vehicle Involved', '', 'Individuals Affected', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20240402-001', 'Dispatch', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Archived', '2024-04-02', '15:34:25', '', 'Juan', 'Dela Cruz', 'San Joaquin', '23123123121', 21, 'M.', 'San Bartolome', '', 'Medical, Trauma, Pedestrian', 'Ran over', 'Vehicle Involved', 'Jeepney', 'Individuals Affected', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20240402-002', 'Dispatch', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Resolved', '2024-04-02', '15:34:59', '', 'Juan', 'Dela Cruz', 'San Joaquin', '09312313122', 21, 'M.', 'San Isidro Sur', 'Purok 2', 'Medical, Trauma', 'Ran over', 'Vehicle Involved', '', 'Individuals Affected', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20240402-003', 'Dispatch', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Resolved', '2025-01-06', '15:16:22', 'Phone/Message', 'sdf', 'sdf', '', '', NULL, 'sfdsdf', 'Barangay I', '', 'Medical, Trauma', '', 'Vehicle Involved', '', 'Individuals Affected', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250106-004', 'Dispatch', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Resolved', '2025-06-27', '12:34:17', 'Phone/Message', 'Juan', 'Dela Cruz', '', '', NULL, 'M.', 'Barangay II', '', 'Medical, Trauma, Vehicular-accident', '', 'Vehicle Involved', '', 'Individuals Affected', 2, NULL, NULL, '2025-06-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250627-005', 'Dispatch', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Archived', '2025-06-27', '12:36:00', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250627-006', '', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Verified', '2025-06-27', '12:37:52', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250627-007', '', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Verified', '2025-06-27', '12:38:18', '', '', '', '', '', NULL, '', 'Barangay III', '', 'Medical, Trauma, Wound-care', '', 'Vehicle Involved', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250627-008', '', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Archived', '2025-06-27', '12:39:30', 'Facebook', 'Juan', 'Dela Cruz', 'San Joaquin', '09213721323', 25, 'M.', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250627-009', '', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Verified', '2025-06-27', '12:40:29', 'Phone/Message', 'Juan', 'Dela Cruz', 'San Joaquin', '09123145235', 20, 'M.', 'Barangay II', '', 'Medical, Trauma, Vehicular-accident', '', 'Vehicle Involved', 'Bus', 'Individuals Affected', 2, NULL, NULL, '2025-06-27', 'Minor', '12:40:44', '12:40:45', '12:40:46', '12:40:47', 'Garc', 'Toyota', 'Rey', 'Rey', 'Dela Cruz', 'Dela Cruz', 'M.', 'M.', '02131313123', NULL, NULL, 'hss212', 'Transport Patient to', 'Car', 'First aid', NULL, '20250627-010', 'Dispatch', 'Admin, Firstname N.', '', 'Dela Cruz', 'Rey', 'M.', 20, 'Male', 'San Joaquin', 'Injured', 'Bag', '1cardboard-boxes-Quantum-Industrial-Supply-Flint-MI-1000px-1.jpg', '482020478_670320312219305_2000723339597172936_n.jpg', 'Assad', 'Asdwq', 'H', 15, 'Female', 'San Joquin', 'Injured', 'Bag', 'Popo, John', 'Jqr, Ron', 'Reyes, hine', 'Rors,Tim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Kay, Kate'),
(11, 'Verified', '2025-06-27', '12:50:29', '', '', '', '', '', NULL, '', 'San Agustin', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20250627-011', '', 'Admin, Firstname N.', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `usertype` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `birthday`, `usertype`, `status`) VALUES
(6, 'Admin, Firstname N.', 'Admin123@gmail.com', '$2y$10$DVjnLK6PeJT8FSl3zFL0eOuWuGNPXI.tGx29fRrXVygseln3eaCri', '0000-00-00', 'admin', 'enabled'),
(12, 'UserEncoder', 'Encoder123@gmail.com', '$2y$10$U1crKSNGxUXnOjaL5kT1luiMTugmKoaZJHbsRO86HGn6znISRotdS', NULL, 'encoder', 'enable'),
(18, 'Dispatch, Team', 'Dispatch123@gmail.com', '$2y$10$OjeXMWQiifOM/J92GAdCl.b5llrSL0xI.hNv54IduYhFOZttc6MJK', NULL, 'dispatch', 'enable');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
