-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 02:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
  `startedDateTime` varchar(300) NOT NULL,
  `serverIPAddress` varchar(300) NOT NULL,
  `timings-wait` varchar(300) NOT NULL,
  `identries` int(11) NOT NULL,
  `idharfiles` int(11) NOT NULL,
  `request-method` varchar(300) NOT NULL,
  `request-url` varchar(300) NOT NULL,
  `response-status` varchar(300) NOT NULL,
  `response-statusText` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `harfiles`
--

CREATE TABLE `harfiles` (
  `idharfiles` int(15) NOT NULL,
  `harname` varchar(300) NOT NULL,
  `city` varchar(300) NOT NULL,
  `date` date NOT NULL,
  `ipaddress` varchar(300) NOT NULL,
  `provider` varchar(300) NOT NULL,
  `iduserinfo` int(15) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `headers`
--

CREATE TABLE `headers` (
  `idheaders` int(11) NOT NULL,
  `content-type` varchar(300) NOT NULL,
  `cache-control` varchar(300) NOT NULL,
  `pragma` varchar(300) NOT NULL,
  `expires` varchar(300) NOT NULL,
  `age` varchar(300) NOT NULL,
  `last-modified` varchar(300) NOT NULL,
  `host` varchar(300) NOT NULL,
  `identries` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `iduserinfo` int(15) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`iduserinfo`, `username`, `password`, `email`) VALUES
(1, 'bigbrother', 'BIG123@@', 'big@brother.com'),
(2, 'java', 'JAVA123@', 'java@theotherdog.com'),
(3, 'rico', 'RICO123@', 'rico@thedog.com'),
(4, 'nikol', 'NIKOL123@', 'nikol@sklav.com'),
(5, 'manos', 'MANOS123@', 'manos@matakias.com'),
(6, 'xrysa', 'XRYSA123@', 'xrysa@tsouki.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`identries`),
  ADD KEY `idheaders` (`idharfiles`);

--
-- Indexes for table `harfiles`
--
ALTER TABLE `harfiles`
  ADD PRIMARY KEY (`idharfiles`),
  ADD KEY `iduserinfo` (`iduserinfo`);

--
-- Indexes for table `headers`
--
ALTER TABLE `headers`
  ADD PRIMARY KEY (`idheaders`),
  ADD KEY `identries` (`identries`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`iduserinfo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `identries` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `harfiles`
--
ALTER TABLE `harfiles`
  MODIFY `idharfiles` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `headers`
--
ALTER TABLE `headers`
  MODIFY `idheaders` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `iduserinfo` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`idharfiles`) REFERENCES `harfiles` (`idharfiles`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `harfiles`
--
ALTER TABLE `harfiles`
  ADD CONSTRAINT `harfiles_ibfk_1` FOREIGN KEY (`iduserinfo`) REFERENCES `userinfo` (`iduserinfo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `headers`
--
ALTER TABLE `headers`
  ADD CONSTRAINT `headers_ibfk_1` FOREIGN KEY (`identries`) REFERENCES `entries` (`identries`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
