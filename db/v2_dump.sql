-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db
-- Generation Time: Jun 19, 2024 at 05:39 PM
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
  `id` int NOT NULL,
  `passenger_id` int DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL,
  `place_of_departure` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `destination` varchar(60) DEFAULT NULL,
  `category` varchar(40) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `route` text,
  `charges` int DEFAULT NULL,
  `payment_method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `payment_statement` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `payment_detail` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ticket_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `seat_id` int DEFAULT NULL,
  `route_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `passenger_id`, `vehicle_id`, `place_of_departure`, `destination`, `category`, `date_time`, `route`, `charges`, `payment_method`, `payment_statement`, `payment_detail`, `ticket_code`, `seat_id`, `route_id`) VALUES
(1, 2, 3, 'Nairobi', 'Kampala', 'coach', '2024-05-01 07:10:30', 'Bungoma', 1800, 'Mpesa', 'DNK6543', 'paid', NULL, NULL, NULL),
(2, 1, 2, 'Kisumu', 'Nairobi', 'firstclass', '2024-05-10 07:40:00', 'Nakuru', 1200, 'cash', NULL, 'paid', NULL, NULL, NULL),
(3, 12, 1, 'Nakuru', 'Narok', '', '2024-05-10 08:09:47', 'Nakuru-Narok', 2000, 'PESAPAL', NULL, NULL, 'CHf3AKK2', NULL, NULL),
(4, 12, 4, 'Nakuru', 'Narok', NULL, '2024-05-10 08:10:06', 'Nakuru-Narok', 2000, 'PESAPAL', NULL, NULL, 'hefkJyAx', NULL, NULL),
(5, 12, 4, 'Nakuru', 'Narok', NULL, '2024-05-10 08:11:03', 'Nakuru-Narok', 2000, 'PESAPAL', NULL, NULL, 'f9dmLewL', NULL, NULL),
(6, 12, NULL, 'Kisumu', 'Malaba', NULL, '2024-05-29 09:11:22', 'Kisumu-Malaba', 2000, 'PESAPAL', NULL, NULL, 'ZOUW9PX8', NULL, NULL),
(7, 12, NULL, 'Kisumu', 'Malaba', NULL, '2024-05-29 09:12:39', 'Kisumu-Malaba', 2000, 'PESAPAL', 'e6c7d5c6-f7e9-4036-8488-dd2d80592bec', NULL, '9SQ6KFSK', NULL, NULL),
(8, 12, NULL, 'Kisumu', 'Malaba', NULL, '2024-05-29 09:48:28', 'Kisumu-Malaba', 2000, 'PESAPAL', '12e5b851-c0d8-4370-80b5-dd2d3c02ace7', NULL, '25BXZXKM', NULL, NULL),
(9, 12, 1, 'Kisumu', 'Malaba', NULL, '2024-05-29 09:49:32', 'Kisumu-Malaba', 2000, 'PESAPAL', '36be5593-8f65-4fd0-9ed5-dd2d08def0ca', NULL, 'S5NLJP6D', 16, NULL),
(10, 12, 2, 'Kisumu', 'Malaba', NULL, '2024-05-29 18:31:01', 'Kisumu-Malaba', 2000, 'PESAPAL', '94b5e5fc-698c-4b2c-bbbb-dd2d4d0dfa3f', NULL, 'O02B3OI4', NULL, NULL),
(11, 12, 1, 'Kisumu', 'Malaba', NULL, '2024-05-29 18:32:09', 'Kisumu-Malaba', 2000, 'PESAPAL', NULL, NULL, 'SMGLU78F', NULL, NULL),
(12, 12, 2, 'Kisumu', 'Malaba', NULL, '2024-05-29 19:03:08', 'Kisumu-Malaba', 2000, 'PESAPAL', NULL, NULL, 'HRXRMHSK', NULL, NULL),
(13, 12, 1, 'Kisumu', 'Malaba', NULL, '2024-05-29 19:03:52', 'Kisumu-Malaba', 2000, 'PESAPAL', NULL, NULL, 'WB84JRBN', NULL, NULL),
(14, 12, 1, 'Kisumu', 'Malaba', NULL, '2024-05-29 19:05:02', 'Kisumu-Malaba', 2000, 'PESAPAL', NULL, NULL, 'XTD63IWN', 19, NULL),
(15, 12, 2, 'Kisumu', 'Malaba', NULL, '2024-01-02 02:00:00', NULL, NULL, 'cash', NULL, NULL, NULL, 21, 1),
(16, 12, 2, 'Kisumu', 'Malaba', NULL, '2024-12-11 03:00:00', NULL, NULL, 'cash', NULL, NULL, NULL, 21, 1),
(17, 12, 2, 'Kisumu', 'Malaba', NULL, '2024-11-12 02:00:00', NULL, NULL, 'cash', NULL, NULL, NULL, 21, 1),
(18, 12, 2, 'Kisumu', 'Malaba', NULL, '2023-07-02 05:00:00', NULL, NULL, 'cash', NULL, NULL, NULL, 21, 1),
(19, 12, 2, 'Kisumu', 'Malaba', NULL, '2023-07-02 05:00:00', NULL, NULL, 'cash', NULL, NULL, NULL, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bus_seats`
--

CREATE TABLE `bus_seats` (
  `id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `seat_id` varchar(10) NOT NULL,
  `row` int NOT NULL,
  `position` int NOT NULL,
  `status` enum('available','booked') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bus_seats`
--

INSERT INTO `bus_seats` (`id`, `vehicle_id`, `seat_id`, `row`, `position`, `status`) VALUES
(1, 1, 'A1', 1, 1, 'booked'),
(2, 1, 'A2', 1, 2, 'booked'),
(3, 1, 'A3', 1, 3, 'booked'),
(4, 1, 'A4', 1, 4, 'booked'),
(5, 1, 'A5', 1, 5, 'booked'),
(6, 1, 'B1', 2, 1, 'booked'),
(7, 1, 'B2', 2, 2, 'booked'),
(8, 1, 'B3', 2, 3, 'booked'),
(9, 1, 'B4', 2, 4, 'booked'),
(10, 1, 'B5', 2, 5, 'booked'),
(11, 1, 'C1', 3, 1, 'booked'),
(12, 1, 'C2', 3, 2, 'booked'),
(13, 1, 'C3', 3, 3, 'booked'),
(14, 1, 'C4', 3, 4, 'booked'),
(15, 1, 'C5', 3, 5, 'booked'),
(16, 1, 'D1', 4, 1, 'booked'),
(17, 1, 'D2', 4, 2, 'booked'),
(18, 1, 'D3', 4, 3, 'booked'),
(19, 1, 'D4', 4, 4, 'booked'),
(20, 2, 'D5', 4, 5, 'booked'),
(21, 2, 'E1', 5, 1, 'available'),
(22, 1, 'E2', 5, 2, 'available'),
(23, 1, 'E3', 5, 3, 'available'),
(24, 1, 'E4', 5, 4, 'booked'),
(25, 1, 'E5', 5, 5, 'booked'),
(26, 1, 'F1', 6, 1, 'booked'),
(27, 1, 'F2', 6, 2, 'booked'),
(28, 1, 'F3', 6, 3, 'booked'),
(29, 1, 'F4', 6, 4, 'booked'),
(30, 1, 'F5', 6, 5, 'booked'),
(31, 1, 'G1', 7, 1, 'booked'),
(32, 1, 'G2', 7, 2, 'booked'),
(33, 1, 'G3', 7, 3, 'booked'),
(34, 1, 'G4', 7, 4, 'booked'),
(35, 1, 'G5', 7, 5, 'booked'),
(36, 1, 'H1', 8, 1, 'booked'),
(37, 1, 'H2', 8, 2, 'booked'),
(38, 1, 'H3', 8, 3, 'booked'),
(39, 1, 'H4', 8, 4, 'booked'),
(40, 1, 'H5', 8, 5, 'booked'),
(41, 1, 'I1', 9, 1, 'booked'),
(42, 1, 'I2', 9, 2, 'booked'),
(43, 1, 'I3', 9, 3, 'booked'),
(44, 1, 'I4', 9, 4, 'booked'),
(45, 1, 'I5', 9, 5, 'booked'),
(46, 1, 'J1', 10, 1, 'booked'),
(47, 1, 'J2', 10, 2, 'booked'),
(48, 1, 'J3', 10, 3, 'booked'),
(49, 1, 'J4', 10, 4, 'booked'),
(50, 1, 'J5', 10, 5, 'booked'),
(51, 1, 'K1', 11, 1, 'booked'),
(52, 1, 'K2', 11, 2, 'booked'),
(53, 1, 'K3', 11, 3, 'booked'),
(54, 1, 'K4', 11, 4, 'booked'),
(55, 1, 'K5', 11, 5, 'booked');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_no` int DEFAULT NULL,
  `mobile_number` int DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `customer_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `customer_dob` date DEFAULT NULL,
  `customer_gender` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `id_no`, `mobile_number`, `email`, `customer_location`, `customer_dob`, `customer_gender`) VALUES
(1, 'Brian', 39402340, 796289156, 'brianotieno@gmail.com', 'Dodoma', '1980-12-06', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int NOT NULL,
  `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(20) DEFAULT NULL,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `date_time`, `source`, `feedback`) VALUES
(1, '2024-04-10 09:10:00', 'passenger', 'poor driving');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `ticket_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `passenger_id` int DEFAULT NULL,
  `passenger_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_no` int DEFAULT NULL,
  `mobile_number` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`ticket_id`, `customer_id`, `passenger_id`, `passenger_name`, `id_no`, `mobile_number`) VALUES
(1, 1, 1, 'Brian', 39402340, 796289156);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `place_of_departure` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_name`, `place_of_departure`, `destination`) VALUES
(1, 'KSM - MLB', 'Kisumu', 'Malaba');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `user_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_no` int DEFAULT NULL,
  `mobile_number` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(40) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `state` varchar(4) DEFAULT 'ON'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `user_name`, `id_no`, `mobile_number`, `email`, `role`, `gender`, `dob`, `state`) VALUES
(1, 'Michael', NULL, 39402340, 796289156, 'omollomichael@gmail.com', 'Admin', 'Male', '1980-12-06', 'ON'),
(2, 'Alice', NULL, 12345678, 987654321, 'alicesmith@gmail.com', 'Driver', 'Female', '1990-05-15', 'ON'),
(3, 'John', NULL, 87654321, 123456789, 'johnochueng@gmail.com', 'Conductor', 'Male', '1985-10-20', 'ON'),
(4, 'Emily', NULL, 56789012, 345678901, 'emilyjones@gmail.com', 'Cashier', 'Female', '1988-07-25', 'ON'),
(6, 'Sophia', NULL, 23456789, 456789012, 'sophiadavis@gmail.com', 'Admin', 'Female', '1987-12-10', 'ON'),
(7, 'David', NULL, 45678901, 789012345, 'davidwilson@gmail.com', 'Driver', 'Male', '1984-09-05', 'ON'),
(8, 'Emma', NULL, 67890123, 901234567, 'emmataylor@gmail.com', 'Conductor', 'Female', '1991-06-28', 'ON'),
(9, 'James', NULL, 89012345, 123456789, 'jamesanderson@gmail.com', 'Cashier', 'Male', '1986-11-30', 'ON'),
(10, 'Olivia', NULL, 90123456, 234567890, 'oliviamartinez@gmail.com', 'Manager', 'Female', '1989-08-15', 'ON'),
(14, 'Adams Okode', 'adams.okode', 12345678, 717707791, 'a.okode@gmail.com', 'admin', 'Male', '1998-01-01', 'ON'),
(15, 'Justin Leto', 'justin.leto', 23456789, 1234567890, 'justin.leto@gmail.com', 'admin', 'Male', '1990-02-02', 'ON'),
(19, 'Vincent Onduto', 'Onduto', 12345678, 1234567873, 'v.onduto@gmail.com', 'driver', 'Male', '1998-05-05', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int NOT NULL,
  `passenger_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `passenger_id` int DEFAULT NULL,
  `ticket_code` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `passenger_name`, `passenger_id`, `ticket_code`) VALUES
(1, 'Brian', 1, 6752),
(4, 'Peter', 2, 6754);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile_number` int DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_no` int DEFAULT NULL,
  `dob` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `staff_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `mobile_number`, `email`, `role`, `user_name`, `password`, `id_no`, `dob`, `gender`, `staff_id`) VALUES
(1, 'Brian', 796289156, 'brianotieno@gmail.com', 'Passenger', 'brayo', 'Brian@123!', 39402340, '1998-05-05', 'Male', NULL),
(2, 'Peter01', 798639274, 'PeterMose@gmail.com', 'admin', 'Mose', 'Peter@123!', 37660526, '2000-01-04', 'Male', NULL),
(3, 'Andrew', 796407372, 'andrewiman.com', 'driver', 'Iman', '$2y$10$xdGAvpGNhvsextEHxujzgeGOZvurb67zotsvPZBhRuKywlN/f/L4.', 35279245, '2004-03-12', 'Male', NULL),
(4, 'Felix', 794455836, 'felixmuhia@gmail.com', 'manager', 'Felo', 'Felix@123!', 33572892, '1992-05-11', 'Male', NULL),
(5, 'Lena', 796813527, 'lenamumbi@gmail.com', 'cashier', 'mumbi', 'Lenah@123!', 36814257, '1997-05-10', 'Female', NULL),
(6, 'George', 786244678, 'georgeooro@gmail.com', 'conductor', 'ooro', 'George@123!', 35618735, '2004-01-01', 'Male', NULL),
(8, 'Morgan', 719255466, 'morganchuma@gmail.com', 'driver', 'chuma', 'Morgan@123!', 37836528, '1992-11-07', 'Male', NULL),
(9, 'Henry', 745679627, 'henryshiemi@gmail.com', 'conductor', 'shiemi', 'Henry@123!', 36374256, '2003-12-12', 'Male', NULL),
(10, 'Roy', 778356272, 'royjakinda@gmail.com', 'cashier', 'Jaks', 'Roy@123!', 33410254, '1992-05-11', 'Male', NULL),
(12, 'Sample sample', 123451351, 'sample@gmail.com', 'Passenger', NULL, '$2y$10$xdGAvpGNhvsextEHxujzgeGOZvurb67zotsvPZBhRuKywlN/f/L4.', 123456, '01/01/1980', 'Male', NULL),
(13, 'Samuel Odoyo', 1234567890, 'samuel.odoyo@gmail.com', 'admin', 'samuel.odoyo', '$2y$10$LDVpMHlJSEOlwf1qXrS7Cul/LEawmVbkddZPQ84MJ5cCH2.zywkIy', NULL, '1980-01-12', 'Male', NULL),
(16, 'Adams Okode', 702759950, 'adamsokode@gmail.com', 'admin', 'adams.okode', '$2y$10$LDVpMHlJSEOlwf1qXrS7Cul/LEawmVbkddZPQ84MJ5cCH2.zywkIy', 12345678, '1998-01-01', 'Male', 14),
(17, 'Justin Leto', 1234567890, 'justin.leto@gmail.com', 'admin', 'justin.leto', '$2y$10$H9jbvFn/w5oxwhkfesX3MueNKSx8pT7Gk9AgxWGfMB5ZLpcoX5.l.', 23456789, '1990-02-02', 'Male', 15),
(19, 'Samuel Kamau', 1234567873, 'samuelkamau@gmail.com', 'Passenger', 'Kamau', '$2y$10$PqNPIhkC35XYVo1RjhCUpOueCX/ObPi9KsNj1in4JmjUrQsLvaYDe', 98765432, '1999-10-10', 'Male', NULL),
(20, 'Collins Oyoo', 707869127, 'collinsoyoo@gmail.com', 'admin', 'Oyoo', '$2y$10$NEoV.q.ucqEQSekSKSQS0u1eT3rBWgnR1fgvXXrr3E17XBYk9kA9K', 98765432, '2000-01-24', 'Male', 17),
(21, 'jacob ojee', 1234567873, 'j.ojee@gmail.com', 'driver', 'Ojee', '$2y$10$XmepPFvBpdzWehA2qndKFucM1faCqVeLWaUs5AoNpCLQCOFcj8PJW', 12345678, '1998-03-30', 'Male', 18),
(22, 'Vincent Onduto', 1234567873, 'v.onduto@gmail.com', 'driver', 'Onduto', '$2y$10$NXwQJNOHU66nXs5zVvltKuSScICanaDqt5/A8U.p7XmH.ekw6zB4S', 12345678, '1998-05-05', 'Male', 19);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int NOT NULL,
  `plate_number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `brand` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `capacity` int NOT NULL,
  `driver_id` int DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `route_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `plate_number`, `brand`, `model`, `capacity`, `driver_id`, `disabled`, `route_id`) VALUES
(1, 'KCT 513T', NULL, NULL, 55, 12, 1, 1),
(2, 'KDD 570Q', NULL, NULL, 55, 12, 0, 1),
(3, 'KDM 008J', NULL, NULL, 55, 5, 0, 1),
(4, 'KDA 675R', NULL, NULL, 55, 7, 0, 1),
(5, 'KDD 921E', NULL, NULL, 55, 21, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `passengerId` (`passenger_id`),
  ADD KEY `item_ibfk_2` (`vehicle_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `bus_seats`
--
ALTER TABLE `bus_seats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `route_name` (`route_name`,`place_of_departure`,`destination`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
