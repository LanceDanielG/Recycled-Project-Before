-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 05:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `software_engineering`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_entry`
--

CREATE TABLE `calendar_entry` (
  `ID` int(11) NOT NULL,
  `entryOwner` varchar(50) NOT NULL,
  `setDate` varchar(50) NOT NULL,
  `setDesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar_entry`
--

INSERT INTO `calendar_entry` (`ID`, `entryOwner`, `setDate`, `setDesc`) VALUES
(5, 'admin', '2022-05-16', 'test'),
(6, 'admin', '2022-05-17', 'testtest'),
(7, 'admin', '2022-05-17', 'Tambay kila dog'),
(8, 'admin', '2022-05-19', 'tambay kila bog'),
(9, 'ethan', '2022-05-19', 'Hello'),
(10, 'ethan', '2022-05-20', 'testtest');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message` varchar(200) NOT NULL,
  `link` varchar(100) NOT NULL,
  `messageDate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message`, `link`, `messageDate`) VALUES
('Test', 'test-admin', '21-05-2022'),
('another One\r\n', 'test-admin', '21-05-2022'),
('Hello', 'test-admin', '21-05-2022'),
('Panget SI lance', 'admin-test', '21-05-2022'),
('Ampaanget mo', 'admin-test', '23-05-2022'),
('PANGET MO OY', 'test-admin', '23-05-2022'),
('OO ikaw', 'test-admin', '23-05-2022'),
('Hey Can you approve my request for the project. I just really need it for a presentation next week. TIA', 'EthanA-admin', '23-05-2022'),
('Sure, just bring it back after', 'admin-EthanA', '23-05-2022'),
('Can you move the subject sometime next week TIA', 'EthanA-admin', '23-05-2022'),
('Hello?\r\n', 'admin-ethanA', '08-12-2022');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `itemName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` varchar(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`itemName`, `username`, `date`, `status`) VALUES
('Projector', 'zildjian', '08-12-2022', 'REJECT'),
('Projector', 'zildjian', '08-12-2022', 'REJECT'),
('Monitor', 'zildjian', '08-12-2022', 'REJECT'),
('Mouse', 'zildjian', '08-12-2022', 'APPROVE'),
('DVI-D to VGA Adapter', 'zildjian', '08-12-2022', 'APPROVE'),
('VGA', 'zildjian', '08-12-2022', 'REJECT'),
('Keyboard', 'zildjian', '08-12-2022', 'APPROVE'),
('Monitor', 'user', '08-12-2022', 'APPROVE'),
('Keyboard', 'user', '08-12-2022', 'APPROVE'),
('VGA', 'user', '08-12-2022', 'REJECT'),
('Monitor', 'zildjian', '10-12-2022', 'REJECT'),
('Projector', 'zildjian', '10-12-2022', 'REJECT'),
('Monitor', 'zildjian', '11-12-2022', 'PENDING'),
('Mouse', 'zildjian', '11-12-2022', 'PENDING'),
('Monitor', 'admin', '11-12-2022', 'PENDING'),
('Mouse', 'terumy123', '11-12-2022', 'APPROVE'),
('Monitor', 'Leiza123', '11-12-2022', 'APPROVE');

-- --------------------------------------------------------

--
-- Table structure for table `subjectlist`
--

CREATE TABLE `subjectlist` (
  `SubjDesc` varchar(50) NOT NULL,
  `SubCode` varchar(10) NOT NULL,
  `SubUnits` int(11) NOT NULL,
  `SubDate` varchar(50) NOT NULL,
  `SubTime` varchar(20) NOT NULL,
  `studentBody` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjectlist`
--

INSERT INTO `subjectlist` (`SubjDesc`, `SubCode`, `SubUnits`, `SubDate`, `SubTime`, `studentBody`) VALUES
('Business Ethics', 'BE101', 3, '11-12-2022', '13:00', 'BSCS-4A'),
('Capstone 1', 'IS101', 5, '11-12-2022', '13:00', 'BSIS-4A'),
('Programming 1', 'CS101', 5, '02-02-2022', '01:00', 'BSCS-4B');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `todoUser` varchar(20) NOT NULL,
  `todoDesc` varchar(100) NOT NULL,
  `todoStatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`todoUser`, `todoDesc`, `todoStatus`) VALUES
('test', 'WEE WEOO', 'True'),
('zildjian', 'Kain Bubog', 'FALSE'),
('zildjian', 'Sigi pa ', 'FALSE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `StudName` varchar(50) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `StudID` varchar(15) NOT NULL,
  `BDay` varchar(15) NOT NULL,
  `Year` varchar(5) NOT NULL,
  `Course` varchar(10) NOT NULL,
  `Section` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Username`, `Password`, `StudName`, `ContactNo`, `StudID`, `BDay`, `Year`, `Course`, `Section`) VALUES
(2, 'user', 'user', 'John Doe', '0927-348-3171', '2019-0269', '2001-02-02', '3', 'BSIS', 'A'),
(4, 'Username', 'password', 'Dax', '0927-348-3171', '2019-9999', '2001-06-04', '4', 'BSIS', 'A'),
(7, 'ethan', 'password', 'Ethan Jex Atienza', '0939-726-1711', '2019-0236', '2001-08-04', '4', 'BSIS', 'A'),
(8, 'admin', 'admin', 'Roseymel', '0969-969-6969', '2019-0000', '2001-02-02', '4', 'BSIS', 'A'),
(9, 'Kim', 'Password', 'Kim Rusell Tugbo', '0939-726-1711', '2019-0263', '2001-04-04', '4', 'BSIS', 'A'),
(10, 'rucemell', 'Password#4', 'Rucemell Dex Bruce', '0912-345-6789', '2019-1234', '2001-02-02', '4', 'BSIS', 'A'),
(11, 'terumy123', 'Password#4', 'Terumy Aderes', '0939-726-1711', '2019-3121', '2001-02-02', '4', 'BSCS', 'B'),
(12, 'zildjian', 'Password#4', 'Lance Daniel Gallos', '0927-348-3171', '2019-0274', '2001-06-04', '4', 'BSIS', 'A'),
(13, 'Leiza123', 'Password#4', 'Ricca Leiza Dela Cruz', '0927-348-3171', '2019-0263', '2001-06-04', '4', 'BSIS', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `ID` int(11) NOT NULL,
  `violationNumber` varchar(5) NOT NULL,
  `violationUser` varchar(50) NOT NULL,
  `violationDate` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`ID`, `violationNumber`, `violationUser`, `violationDate`) VALUES
(1, '15', 'zildjian', '08-12-2022'),
(2, '11', 'zildjian', '08-12-2022'),
(3, '7', 'zildjian', '08-12-2022'),
(4, '12', 'user', '08-12-2022'),
(5, '8', 'zildjian', '10-12-2022'),
(6, '16', 'zildjian', '10-12-2022'),
(7, '11', 'zildjian', '11-12-2022'),
(8, '12', 'Kim', '11-12-2022'),
(9, '15', 'zildjian', '11-12-2022'),
(10, '1', 'terumy123', '11-12-2022'),
(11, '14', 'terumy123', '11-12-2022'),
(12, '1', 'Leiza123', '11-12-2022'),
(13, '9', 'Leiza123', '11-12-2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar_entry`
--
ALTER TABLE `calendar_entry`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `subjectlist`
--
ALTER TABLE `subjectlist`
  ADD PRIMARY KEY (`SubjDesc`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calendar_entry`
--
ALTER TABLE `calendar_entry`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
