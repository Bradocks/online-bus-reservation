-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db
-- Generation Time: May 23, 2024 at 04:04 AM
-- Server version: 8.0.37
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busreservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingid` int NOT NULL,
  `PassengerId` int DEFAULT NULL,
  `vehicleId` int DEFAULT NULL,
  `departure` varchar(50) DEFAULT NULL,
  `destination` varchar(60) DEFAULT NULL,
  `category` varchar(40) DEFAULT NULL,
  `dateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `route` text,
  `charges` int DEFAULT NULL,
  `PaymentMethod` varchar(20) DEFAULT NULL,
  `PaymentStatement` varchar(70) DEFAULT NULL,
  `paymentDetail` varchar(20) DEFAULT NULL,
  `ticketCode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingid`, `PassengerId`, `vehicleId`, `departure`, `destination`, `category`, `dateTime`, `route`, `charges`, `PaymentMethod`, `PaymentStatement`, `paymentDetail`, `ticketCode`) VALUES
(1, 2, 3, 'Nairobi', 'Kampala', 'coach', '2024-05-01 07:10:30', 'Bungoma', 1800, 'Mpesa', 'DNK6543', 'paid', NULL),
(2, 1, 2, 'Kisumu', 'Nairobi', 'firstclass', '2024-05-10 07:40:00', 'Nakuru', 1200, 'cash', NULL, 'paid', NULL),
(3, 12, 1, 'Nakuru', 'Narok', '', '2024-05-10 08:09:47', 'Nakuru-Narok', 2000, 'PESAPAL', NULL, NULL, 'CHf3AKK2'),
(4, 12, 4, 'Nakuru', 'Narok', NULL, '2024-05-10 08:10:06', 'Nakuru-Narok', 2000, 'PESAPAL', NULL, NULL, 'hefkJyAx'),
(5, 12, 4, 'Nakuru', 'Narok', NULL, '2024-05-10 08:11:03', 'Nakuru-Narok', 2000, 'PESAPAL', NULL, NULL, 'f9dmLewL');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int NOT NULL,
  `customerName` varchar(50) DEFAULT NULL,
  `customerIdNo` int DEFAULT NULL,
  `customerPhoneNo` int DEFAULT NULL,
  `customerEmail` varchar(60) DEFAULT NULL,
  `customerLocation` text,
  `customerDOB` date DEFAULT NULL,
  `customerGender` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `customerName`, `customerIdNo`, `customerPhoneNo`, `customerEmail`, `customerLocation`, `customerDOB`, `customerGender`) VALUES
(1, 'Brian', 39402340, 796289156, 'brianotieno@gmail.com', 'Dodoma', '1980-12-06', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedBackId` int NOT NULL,
  `dateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(20) DEFAULT NULL,
  `feedBack` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedBackId`, `dateTime`, `source`, `feedBack`) VALUES
(1, '2024-04-10 09:10:00', 'passenger', 'poor driving');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `ticketId` int NOT NULL,
  `customerId` int NOT NULL,
  `passengerId` int DEFAULT NULL,
  `passengerName` varchar(50) DEFAULT NULL,
  `passengerIdNo` int DEFAULT NULL,
  `passengerPhoneNo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`ticketId`, `customerId`, `passengerId`, `passengerName`, `passengerIdNo`, `passengerPhoneNo`) VALUES
(1, 1, 1, 'Brian', 39402340, 796289156);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `userName` varchar(20) DEFAULT NULL,
  `IdNO` int DEFAULT NULL,
  `phoneNO` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(40) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `state` varchar(4) DEFAULT 'ON'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `name`, `userName`, `IdNO`, `phoneNO`, `email`, `role`, `gender`, `DOB`, `state`) VALUES
(1, 'Michael', NULL, 39402340, 796289156, 'omollomichael@gmail.com', 'Admin', 'Male', '1980-12-06', 'ON'),
(2, 'Alice', NULL, 12345678, 987654321, 'alicesmith@gmail.com', 'Driver', 'Female', '1990-05-15', 'ON'),
(3, 'John', NULL, 87654321, 123456789, 'johnochueng@gmail.com', 'Conductor', 'Male', '1985-10-20', 'ON'),
(4, 'Emily', NULL, 56789012, 345678901, 'emilyjones@gmail.com', 'Cashier', 'Female', '1988-07-25', 'ON'),
(5, 'Michael', NULL, 34567890, 678901234, 'michaelbrown@gmail.com', 'Manager', 'Male', '1992-03-18', 'ON'),
(6, 'Sophia', NULL, 23456789, 456789012, 'sophiadavis@gmail.com', 'Admin', 'Female', '1987-12-10', 'ON'),
(7, 'David', NULL, 45678901, 789012345, 'davidwilson@gmail.com', 'Driver', 'Male', '1984-09-05', 'ON'),
(8, 'Emma', NULL, 67890123, 901234567, 'emmataylor@gmail.com', 'Conductor', 'Female', '1991-06-28', 'ON'),
(9, 'James', NULL, 89012345, 123456789, 'jamesanderson@gmail.com', 'Cashier', 'Male', '1986-11-30', 'ON'),
(10, 'Olivia', NULL, 90123456, 234567890, 'oliviamartinez@gmail.com', 'Manager', 'Female', '1989-08-15', 'ON'),
(14, 'Adams Okode', 'adams.okode', 12345678, 717707791, 'a.okode@gmail.com', 'admin', 'Male', '1998-01-01', 'ON'),
(15, 'Justin Leto', 'justin.leto', 23456789, 1234567890, 'justin.leto@gmail.com', 'admin', 'Male', '1990-02-02', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int NOT NULL,
  `passengerName` varchar(50) DEFAULT NULL,
  `passengerID` int DEFAULT NULL,
  `ticketCode` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketId`, `passengerName`, `passengerID`, `ticketCode`) VALUES
(1, 'Brian', 1, 6752),
(4, 'Peter', 2, 6754);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobileNumber` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `userName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `IdNO` int DEFAULT NULL,
  `DOB` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `staff_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `name`, `mobileNumber`, `email`, `role`, `userName`, `password`, `IdNO`, `DOB`, `gender`, `staff_id`) VALUES
(1, 'Brian', 796289156, 'brianotieno@gmail.com', 'Passenger', 'brayo', 'Brian@123!', 39402340, '1998-05-05', 'Male', NULL),
(2, 'Peter01', 798639274, 'PeterMose@gmail.com', 'admin', 'Mose', 'Peter@123!', 37660526, '2000-01-04', 'Male', NULL),
(3, 'Andrew', 796407372, 'andrewiman.com', 'driver', 'Iman', 'Andrew@123!', 35279245, '2004-03-12', 'Male', NULL),
(4, 'Felix', 794455836, 'felixmuhia@gmail.com', 'manager', 'Felo', 'Felix@123!', 33572892, '1992-05-11', 'Male', NULL),
(5, 'Lena', 796813527, 'lenamumbi@gmail.com', 'cashier', 'mumbi', 'Lenah@123!', 36814257, '1997-05-10', 'Female', NULL),
(6, 'George', 786244678, 'georgeooro@gmail.com', 'conductor', 'ooro', 'George@123!', 35618735, '2004-01-01', 'Male', NULL),
(7, 'Mitchell', 743567245, 'mitchellohawa@gmail.com', 'passenger', 'Ohawa', 'mitchell@123', 39657842, '2000-07-11', 'Female', NULL),
(8, 'Morgan', 719255466, 'morganchuma@gmail.com', 'driver', 'chuma', 'Morgan@123!', 37836528, '1992-11-07', 'Male', NULL),
(9, 'Henry', 745679627, 'henryshiemi@gmail.com', 'conductor', 'shiemi', 'Henry@123!', 36374256, '2003-12-12', 'Male', NULL),
(10, 'Roy', 778356272, 'royjakinda@gmail.com', 'cashier', 'Jaks', 'Roy@123!', 33410254, '1992-05-11', 'Male', NULL),
(12, 'Sample sample', 123451351, 'sample@gmail.com', 'Passenger', NULL, '$2y$10$xdGAvpGNhvsextEHxujzgeGOZvurb67zotsvPZBhRuKywlN/f/L4.', 123456, '01/01/1980', 'Male', NULL),
(13, 'Samuel Odoyo', 1234567890, 'samuel.odoyo@gmail.com', 'admin', 'samuel.odoyo', '$2y$10$LDVpMHlJSEOlwf1qXrS7Cul/LEawmVbkddZPQ84MJ5cCH2.zywkIy', NULL, '1980-01-12', 'Male', NULL),
(16, 'Adams Okode', 702759950, 'adamsokode@gmail.com', 'admin', 'adams.okode', '$2y$10$LDVpMHlJSEOlwf1qXrS7Cul/LEawmVbkddZPQ84MJ5cCH2.zywkIy', 12345678, '1998-01-01', 'Male', 14),
(17, 'Justin Leto', 1234567890, 'justin.leto@gmail.com', 'admin', 'justin.leto', '$2y$10$H9jbvFn/w5oxwhkfesX3MueNKSx8pT7Gk9AgxWGfMB5ZLpcoX5.l.', 23456789, '1990-02-02', 'Male', 15);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleId` int NOT NULL,
  `plateNo` text,
  `brand` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `capacity` int NOT NULL,
  `driverId` int DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleId`, `plateNo`, `brand`, `model`, `capacity`, `driverId`, `disabled`) VALUES
(1, 'KCT 513T', NULL, NULL, 55, 12, 1),
(2, 'KDD 570Q', NULL, NULL, 55, 12, 0),
(3, 'KDM 008J', NULL, NULL, 55, 5, 0),
(4, 'KDA 675R', NULL, NULL, 55, 7, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingid`),
  ADD KEY `passengerId` (`PassengerId`),
  ADD KEY `item_ibfk_2` (`vehicleId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedBackId`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedBackId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`vehicleId`) REFERENCES `vehicle` (`vehicleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
