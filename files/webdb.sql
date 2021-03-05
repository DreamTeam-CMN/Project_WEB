-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 02:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `identries` int(50) NOT NULL,
  `timings` time NOT NULL,
  `entriescol` varchar(200) NOT NULL,
  `serverIPaddress` varchar(200) NOT NULL,
  `startedDateTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fileinfo`
--

CREATE TABLE `fileinfo` (
  `idfileinfo` int(15) NOT NULL,
  `provider` varchar(200) NOT NULL,
  `ipaddress` varchar(200) NOT NULL,
  `dateoffile` date NOT NULL,
  `idresponse` int(50) NOT NULL,
  `idrequest` int(50) NOT NULL,
  `identries` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `headers`
--

CREATE TABLE `headers` (
  `idheaders` int(50) NOT NULL,
  `contentType` varchar(200) NOT NULL,
  `cacheControl` varchar(200) NOT NULL,
  `pragma` varchar(200) NOT NULL,
  `expires` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `lastModified` date NOT NULL,
  `host` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `idrequest` int(50) NOT NULL,
  `url` varchar(200) NOT NULL,
  `method` varchar(200) NOT NULL,
  `idheaders` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `response`
--

CREATE TABLE `response` (
  `idresponse` int(50) NOT NULL,
  `statusText` varchar(500) NOT NULL,
  `idheaders2` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

CREATE TABLE `timings` (
  `idtimings` int(20) NOT NULL,
  `wait` time NOT NULL,
  `identries` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `iduserinfo` int(15) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `idfileinfo` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`iduserinfo`, `username`, `password`, `email`, `city`, `idfileinfo`) VALUES
(1, 'xrysa', 'XRYSA123@', 'xrysa@tsouki.com', '', 0),
(2, 'manos', 'MANOS123@', 'manos@matakias.com', '', 0),
(3, 'nikol', 'NIKOL123@', 'nikol@sklav.com', '', 0),
(4, 'rico', 'RICO123@', 'rico@thedog.com', '', 0),
(5, 'java', 'JAVA123@', 'java@theotherdog.com', '', 0),
(6, 'bigbrother', 'BIG123@@', 'big@brother.com', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`identries`),
  ADD KEY `identries` (`identries`);

--
-- Indexes for table `fileinfo`
--
ALTER TABLE `fileinfo`
  ADD PRIMARY KEY (`idfileinfo`),
  ADD KEY `idresponse` (`idresponse`,`idrequest`,`identries`),
  ADD KEY `idrequest` (`idrequest`),
  ADD KEY `identries` (`identries`);

--
-- Indexes for table `headers`
--
ALTER TABLE `headers`
  ADD PRIMARY KEY (`idheaders`),
  ADD KEY `idheaders` (`idheaders`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`idrequest`),
  ADD KEY `idheaders` (`idheaders`);

--
-- Indexes for table `response`
--
ALTER TABLE `response`
  ADD PRIMARY KEY (`idresponse`),
  ADD KEY `idheaders` (`idheaders2`);

--
-- Indexes for table `timings`
--
ALTER TABLE `timings`
  ADD PRIMARY KEY (`idtimings`),
  ADD KEY `identries` (`identries`),
  ADD KEY `identries_2` (`identries`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`iduserinfo`),
  ADD KEY `idfileinfo` (`idfileinfo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `response`
--
ALTER TABLE `response`
  MODIFY `idresponse` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timings`
--
ALTER TABLE `timings`
  MODIFY `idtimings` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `iduserinfo` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`identries`) REFERENCES `fileinfo` (`identries`);

--
-- Constraints for table `fileinfo`
--
ALTER TABLE `fileinfo`
  ADD CONSTRAINT `fileinfo_ibfk_1` FOREIGN KEY (`idfileinfo`) REFERENCES `userinfo` (`idfileinfo`);

--
-- Constraints for table `headers`
--
ALTER TABLE `headers`
  ADD CONSTRAINT `headers_ibfk_1` FOREIGN KEY (`idheaders`) REFERENCES `request` (`idheaders`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`idrequest`) REFERENCES `fileinfo` (`idrequest`);

--
-- Constraints for table `response`
--
ALTER TABLE `response`
  ADD CONSTRAINT `response_ibfk_2` FOREIGN KEY (`idheaders2`) REFERENCES `fileinfo` (`idresponse`);

--
-- Constraints for table `timings`
--
ALTER TABLE `timings`
  ADD CONSTRAINT `timings_ibfk_1` FOREIGN KEY (`identries`) REFERENCES `entries` (`identries`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
