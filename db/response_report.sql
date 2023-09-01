-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 09:55 AM
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
-- Database: `response_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `fixedinformation`
--

CREATE TABLE `fixedinformation` (
  `id` int(11) NOT NULL,
  `driver` longtext NOT NULL,
  `members` longtext NOT NULL,
  `dispatch` longtext NOT NULL,
  `preparedBy` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fixedinformation`
--

INSERT INTO `fixedinformation` (`id`, `driver`, `members`, `dispatch`, `preparedBy`) VALUES
(1, 'Jaylord Briton1', 'Teng Bagsit/Joseph Calaluan', 'Cecilio Dagus', 'Cecilio Dagus');

-- --------------------------------------------------------

--
-- Table structure for table `patientinformation`
--

CREATE TABLE `patientinformation` (
  `id` int(11) NOT NULL,
  `reportId` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `address` longtext NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(125) NOT NULL,
  `InjuryCondition` longtext NOT NULL,
  `actionTaken` longtext NOT NULL,
  `responder` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientinformation`
--

INSERT INTO `patientinformation` (`id`, `reportId`, `name`, `address`, `age`, `gender`, `InjuryCondition`, `actionTaken`, `responder`) VALUES
(1, 17, 'Jamaica Rose', 'Calicanto Batangas City', 18, 'Female', 'try', 'try', '1'),
(2, 18, 'rico littawa', 'Calicanto Batangas City', 21, 'Female', 'try', 'try', '2');

-- --------------------------------------------------------

--
-- Table structure for table `reference`
--

CREATE TABLE `reference` (
  `referenceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reference`
--

INSERT INTO `reference` (`referenceId`) VALUES
(20);

-- --------------------------------------------------------

--
-- Table structure for table `reportinformation`
--

CREATE TABLE `reportinformation` (
  `id` int(11) NOT NULL,
  `referenceId` int(11) NOT NULL,
  `typeOfEmergency` varchar(125) NOT NULL,
  `dateTaken` date NOT NULL,
  `timeTaken` time NOT NULL,
  `typeOfIncident` longtext NOT NULL,
  `location` varchar(125) NOT NULL,
  `nameOfCaller` longtext NOT NULL,
  `noOfPersonsInvolved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportinformation`
--

INSERT INTO `reportinformation` (`id`, `referenceId`, `typeOfEmergency`, `dateTaken`, `timeTaken`, `typeOfIncident`, `location`, `nameOfCaller`, `noOfPersonsInvolved`) VALUES
(1, 17, 'medical', '2023-08-31', '10:44:00', 'Medical Emergency', 'Near Police outpost, Brgy. Calicanto, Batangas City', 'Joshua Ocampo', 1),
(2, 18, 'Trauma', '2023-08-31', '14:29:00', 'Medical Emergency', 'Near Police outpost, Brgy. Calicanto, Batangas City', 'Joshua Ocampo', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fixedinformation`
--
ALTER TABLE `fixedinformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patientinformation`
--
ALTER TABLE `patientinformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reportinformation`
--
ALTER TABLE `reportinformation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fixedinformation`
--
ALTER TABLE `fixedinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patientinformation`
--
ALTER TABLE `patientinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reportinformation`
--
ALTER TABLE `reportinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
