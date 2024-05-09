-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: busreservation
-- ------------------------------------------------------
-- Server version	8.0.36
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Table structure for table `booking`
--
DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
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
    `ticketCode` int DEFAULT NULL,
    PRIMARY KEY (`bookingid`),
    KEY `passengerId` (`PassengerId`),
    KEY `item_ibfk_2` (`vehicleId`),
    CONSTRAINT `item_ibfk_2` FOREIGN KEY (`vehicleId`) REFERENCES `vehicle` (`vehicleId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `booking`
--
LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */
;
INSERT INTO `booking`
VALUES (
        1,
        2,
        3,
        'Nairobi',
        'Kampala',
        'coach',
        '2024-05-01 07:10:30',
        'Bungoma',
        1800,
        'Mpesa',
        'DNK6543',
        'paid',
        NULL
    ),
    (
        2,
        1,
        2,
        'Kisumu',
        'Nairobi',
        'firstclass',
        '2024-05-10 07:40:00',
        'Nakuru',
        1200,
        'cash',
        NULL,
        'paid',
        NULL
    );
/*!40000 ALTER TABLE `booking` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `customer`
--
DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `customer` (
    `customerId` int NOT NULL,
    `customerName` varchar(50) DEFAULT NULL,
    `customerIdNo` int DEFAULT NULL,
    `customerPhoneNo` int DEFAULT NULL,
    `customerEmail` varchar(60) DEFAULT NULL,
    `customerLocation` text,
    `customerDOB` date DEFAULT NULL,
    `customerGender` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`customerId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `customer`
--
LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */
;
INSERT INTO `customer`
VALUES (
        1,
        'Brian',
        39402340,
        796289156,
        'brianotieno@gmail.com',
        'Dodoma',
        '1980-12-06',
        'Male'
    );
/*!40000 ALTER TABLE `customer` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `feedback`
--
DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `feedback` (
    `feedBackId` int NOT NULL AUTO_INCREMENT,
    `dateTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `source` varchar(20) DEFAULT NULL,
    `feedBack` text,
    PRIMARY KEY (`feedBackId`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `feedback`
--
LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */
;
INSERT INTO `feedback`
VALUES (
        1,
        '2024-04-10 09:10:00',
        'passenger',
        'poor driving'
    );
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `passenger`
--
DROP TABLE IF EXISTS `passenger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `passenger` (
    `ticketId` int NOT NULL,
    `customerId` int NOT NULL,
    `passengerId` int DEFAULT NULL,
    `passengerName` varchar(50) DEFAULT NULL,
    `passengerIdNo` int DEFAULT NULL,
    `passengerPhoneNo` int DEFAULT NULL,
    PRIMARY KEY (`ticketId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `passenger`
--
LOCK TABLES `passenger` WRITE;
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */
;
INSERT INTO `passenger`
VALUES (1, 1, 1, 'Brian', 39402340, 796289156);
/*!40000 ALTER TABLE `passenger` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `staff`
--
DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `staff` (
    `staffId` int NOT NULL AUTO_INCREMENT,
    `name` varchar(40) DEFAULT NULL,
    `userName` varchar(20) DEFAULT NULL,
    `IdNO` int DEFAULT NULL,
    `phoneNO` int DEFAULT NULL,
    `email` varchar(50) DEFAULT NULL,
    `role` varchar(40) DEFAULT NULL,
    `gender` varchar(10) DEFAULT NULL,
    `DOB` date DEFAULT NULL,
    PRIMARY KEY (`staffId`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `staff`
--
LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */
;
INSERT INTO `staff`
VALUES (
        1,
        'Michael',
        NULL,
        39402340,
        796289156,
        'omollomichael@gmail.com',
        'Admin',
        'Male',
        '1980-12-06'
    ),
    (
        2,
        'Alice',
        NULL,
        12345678,
        987654321,
        'alicesmith@gmail.com',
        'Driver',
        'Female',
        '1990-05-15'
    ),
    (
        3,
        'John',
        NULL,
        87654321,
        123456789,
        'johnochueng@gmail.com',
        'Conductor',
        'Male',
        '1985-10-20'
    ),
    (
        4,
        'Emily',
        NULL,
        56789012,
        345678901,
        'emilyjones@gmail.com',
        'Cashier',
        'Female',
        '1988-07-25'
    ),
    (
        5,
        'Michael',
        NULL,
        34567890,
        678901234,
        'michaelbrown@gmail.com',
        'Manager',
        'Male',
        '1992-03-18'
    ),
    (
        6,
        'Sophia',
        NULL,
        23456789,
        456789012,
        'sophiadavis@gmail.com',
        'Admin',
        'Female',
        '1987-12-10'
    ),
    (
        7,
        'David',
        NULL,
        45678901,
        789012345,
        'davidwilson@gmail.com',
        'Driver',
        'Male',
        '1984-09-05'
    ),
    (
        8,
        'Emma',
        NULL,
        67890123,
        901234567,
        'emmataylor@gmail.com',
        'Conductor',
        'Female',
        '1991-06-28'
    ),
    (
        9,
        'James',
        NULL,
        89012345,
        123456789,
        'jamesanderson@gmail.com',
        'Cashier',
        'Male',
        '1986-11-30'
    ),
    (
        10,
        'Olivia',
        NULL,
        90123456,
        234567890,
        'oliviamartinez@gmail.com',
        'Manager',
        'Female',
        '1989-08-15'
    );
/*!40000 ALTER TABLE `staff` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `ticket`
--
DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `ticket` (
    `ticketId` int NOT NULL,
    `passengerName` varchar(50) DEFAULT NULL,
    `passengerID` int DEFAULT NULL,
    `ticketCode` int DEFAULT NULL,
    PRIMARY KEY (`ticketId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `ticket`
--
LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */
;
INSERT INTO `ticket`
VALUES (1, 'Brian', 1, 6752),
    (4, 'Peter', 2, 6754);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `user` (
    `userId` int NOT NULL AUTO_INCREMENT,
    `name` varchar(50) DEFAULT NULL,
    `mobileNumber` int DEFAULT NULL,
    `email` varchar(50) DEFAULT NULL,
    `role` varchar(50) DEFAULT NULL,
    `userName` varchar(50) NOT NULL,
    `password` varchar(50) DEFAULT NULL,
    `IdNO` int DEFAULT NULL,
    `DOB` varchar(20) DEFAULT NULL,
    `gender` varchar(10) DEFAULT NULL,
    PRIMARY KEY (`userId`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `user`
--
LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */
;
INSERT INTO `user`
VALUES (
        1,
        'Brian',
        796289156,
        'brianotieno@gmail.com',
        'Passenger',
        'brayo',
        'Brian@123!',
        39402340,
        '1998-05-05',
        'Male'
    ),
    (
        2,
        'Peter01',
        798639274,
        'PeterMose@gmail.com',
        'admin',
        'Mose',
        'Peter@123!',
        37660526,
        '2000-01-04',
        'Male'
    ),
    (
        3,
        'Andrew',
        796407372,
        'andrewiman.com',
        'driver',
        'Iman',
        'Andrew@123!',
        35279245,
        '2004-03-12',
        'Male'
    ),
    (
        4,
        'Felix',
        794455836,
        'felixmuhia@gmail.com',
        'manager',
        'Felo',
        'Felix@123!',
        33572892,
        '1992-05-11',
        'Male'
    ),
    (
        5,
        'Lena',
        796813527,
        'lenamumbi@gmail.com',
        'cashier',
        'mumbi',
        'Lenah@123!',
        36814257,
        '1997-05-10',
        'Female'
    ),
    (
        6,
        'George',
        786244678,
        'georgeooro@gmail.com',
        'conductor',
        'ooro',
        'George@123!',
        35618735,
        '2004-01-01',
        'Male'
    ),
    (
        7,
        'Mitchell',
        743567245,
        'mitchellohawa@gmail.com',
        'passenger',
        'Ohawa',
        'mitchell@123',
        39657842,
        '2000-07-11',
        'Female'
    ),
    (
        8,
        'Morgan',
        719255466,
        'morganchuma@gmail.com',
        'driver',
        'chuma',
        'Morgan@123!',
        37836528,
        '1992-11-07',
        'Male'
    ),
    (
        9,
        'Henry',
        745679627,
        'henryshiemi@gmail.com',
        'conductor',
        'shiemi',
        'Henry@123!',
        36374256,
        '2003-12-12',
        'Male'
    ),
    (
        10,
        'Roy',
        778356272,
        'royjakinda@gmail.com',
        'cashier',
        'Jaks',
        'Roy@123!',
        33410254,
        '1992-05-11',
        'Male'
    );
/*!40000 ALTER TABLE `user` ENABLE KEYS */
;
UNLOCK TABLES;
--
-- Table structure for table `vehicle`
--
DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `vehicle` (
    `vehicleId` int NOT NULL AUTO_INCREMENT,
    `plateNo` text,
    `capacity` decimal(10, 0) DEFAULT NULL,
    `driverId` int DEFAULT NULL,
    PRIMARY KEY (`vehicleId`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `vehicle`
--
LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */
;
INSERT INTO `vehicle`
VALUES (1, 'KCT 513T', 55, 2),
    (2, 'KDD 570Q', 55, 3),
    (3, 'KDM 008J', 55, 5),
    (4, 'KDA 675R', 55, 7);
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */
;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2024-05-02 11:46:14