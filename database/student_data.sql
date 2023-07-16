-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2023 at 08:12 AM
-- Server version: 8.0.29
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmapplications`
--

CREATE TABLE `tbladmapplications` (
  `ID` int NOT NULL,
  `UserId` char(10) NOT NULL,
  `CourseApplied` varchar(120) DEFAULT NULL,
  `AdmissionType` varchar(120) DEFAULT NULL,
  `FirstName` varchar(120) DEFAULT NULL,
  `MiddleName` varchar(120) DEFAULT NULL,
  `LastName` varchar(120) DEFAULT NULL,
  `Nationality` varchar(120) DEFAULT NULL,
  `DobGregorian` varchar(25) DEFAULT NULL,
  `DobEthiopian` varchar(25) DEFAULT NULL,
  `Gender` varchar(200) DEFAULT NULL,
  `UserPic` varchar(200) DEFAULT NULL,
  `CountryOfBirth` varchar(200) DEFAULT NULL,
  `TownOfBirth` varchar(200) DEFAULT NULL,
  `WoredaOfBirth` varchar(200) DEFAULT NULL,
  `KebeleOfBirth` varchar(200) DEFAULT NULL,
  `FatherFirstName` varchar(120) DEFAULT NULL,
  `FatherMiddleName` varchar(120) DEFAULT NULL,
  `FatherLastName` varchar(120) DEFAULT NULL,
  `MotherFirstName` varchar(120) DEFAULT NULL,
  `MotherMiddleName` varchar(120) DEFAULT NULL,
  `MotherLastName` varchar(120) DEFAULT NULL,
  `ResidenceTown` varchar(120) DEFAULT NULL,
  `ResidenceWoreda` varchar(120) DEFAULT NULL,
  `ResidenceKebele` varchar(120) DEFAULT NULL,
  `ResidenceHouse` varchar(120) DEFAULT NULL,
  `PhoneNumber` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `PhoneNumber2` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `MaritalStatus` varchar(120) DEFAULT NULL,
  `EmergencyName` varchar(120) DEFAULT NULL,
  `EmergencyPhone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `EmergencyTown` varchar(120) DEFAULT NULL,
  `EmergencyRelation` varchar(120) DEFAULT NULL,
  `SchoolName1` varchar(120) DEFAULT NULL,
  `SchoolTown1` varchar(120) DEFAULT NULL,
  `SchoolLastYear1` varchar(4) DEFAULT NULL,
  `SchoolStream1` varchar(120) DEFAULT NULL,
  `SchoolName2` varchar(120) DEFAULT NULL,
  `SchoolTown2` varchar(120) DEFAULT NULL,
  `SchoolLastYear2` varchar(4) DEFAULT NULL,
  `SchoolStream2` varchar(120) DEFAULT NULL,
  `SchoolName3` varchar(120) DEFAULT NULL,
  `SchoolTown3` varchar(120) DEFAULT NULL,
  `SchoolLastYear3` varchar(4) DEFAULT NULL,
  `SchoolStream3` varchar(120) DEFAULT NULL,
  `InsName1` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `InsCountry1` varchar(120) DEFAULT NULL,
  `InsLastYear1` varchar(4) DEFAULT NULL,
  `InsMajor1` varchar(120) DEFAULT NULL,
  `InsName2` varchar(120) DEFAULT NULL,
  `InsCountry2` varchar(120) DEFAULT NULL,
  `InsLastYear2` varchar(4) DEFAULT NULL,
  `InsMajor2` varchar(120) DEFAULT NULL,
  `InsName3` varchar(120) DEFAULT NULL,
  `InsCountry3` varchar(120) DEFAULT NULL,
  `InsLastYear3` varchar(4) DEFAULT NULL,
  `InsMajor3` varchar(120) DEFAULT NULL,
  `Declaration` varchar(120) DEFAULT NULL,
  `Signature` varchar(120) DEFAULT NULL,
  `CourseApplieddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` varchar(255) DEFAULT NULL,
  `AdminStatus` varchar(20) DEFAULT NULL,
  `AdminRemarkDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int NOT NULL,
  `AdminuserName` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminuserName`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Rift Valley University', 'riftvalleyuniversity0@gmail.com', '370cf47a6f610f08a2a34fa1fba67c34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmissions`
--

CREATE TABLE `tbladmissions` (
  `Adm_App_ID` int NOT NULL,
  `Adm_Course` varchar(120) DEFAULT NULL,
  `Adm_Status` varchar(120) DEFAULT 'offered',
  `Adm_Payment_Status` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'unpaid',
  `Adm_Offer_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Adm_Accept_Date` timestamp NULL DEFAULT NULL,
  `Adm_Pay_Date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int NOT NULL,
  `CourseName` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `CourseName`) VALUES
(1, 'Computer Science'),
(2, 'Business Administration'),
(3, 'Accounting and Finance'),
(4, 'Nursing'),
(15, 'Pharmacy'),
(16, 'Marketing Management');

-- --------------------------------------------------------

--
-- Table structure for table `tbldocument`
--

CREATE TABLE `tbldocument` (
  `ID` int NOT NULL,
  `UserID` int NOT NULL,
  `Passport` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `HighSchoolTranscript` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `TenthCertificate` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `TwelfthCertificate` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `PostSecondaryTranscript` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `PostSecondaryCertificate` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `AdditionalDocuments` varchar(120) DEFAULT NULL,
  `UploadDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `ID` int NOT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`ID`, `Title`, `Description`, `CreationDate`) VALUES
(3, 'Class Start Date for Fall 2023 Semester', 'Dear Student,\r\n\r\nWe are excited to announce that the Fall 2023 semester is just around the corner. Classes are scheduled to commence on the 20th of September, 2023. \r\n\r\nBefore the class start date, we kindly request that you report to the Registrar\'s Office and collect your student identification card (ID). It is mandatory for every student to have their physical IDs with them at all times during the academic year. Please ensure that you visit the Registrar\'s Office and obtain your ID no later than the 19th of September, 2023.\r\n\r\nWe wish you all the best for the upcoming semester. Should you have any questions or require further information, please don\'t hesitate to reach out to the Registrar\'s Office or email rvu.admissions.sup@gmail.com.\r\n\r\nBest regards,\r\nRift Valley University', '2021-10-26 03:36:07'),
(4, 'Exit Exam Information', 'You will have to pass the National Exit exam after four years in order to graduate.', '2023-06-28 15:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `Application_ID` int NOT NULL,
  `Payer_ID` int NOT NULL,
  `Payer_Name` varchar(120) DEFAULT NULL,
  `Pay_Ref` varchar(120) DEFAULT NULL,
  `Pay_Date` varchar(25) DEFAULT NULL,
  `Pay_Receipt` varchar(200) DEFAULT NULL,
  `Pay_Confirmed` varchar(60) NOT NULL DEFAULT 'unverified',
  `Pay_Reg_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblregistered`
--

CREATE TABLE `tblregistered` (
  `Reg_ID` int NOT NULL,
  `Reg_User_ID` int NOT NULL,
  `Reg_Course` varchar(120) DEFAULT NULL,
  `Reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `MiddleName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `Token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'unconfirmed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FirstName`, `MiddleName`, `LastName`, `Email`, `Password`, `Token`, `PostingDate`, `status`) VALUES
(67, 'Maryamawit', 'Mesfin', 'Teshome', 'maryamawit55mesfin@gmail.com', '242de1312002d1d378c567b2dad051cc', '72859d0c11be4d8790c6e0a498018f65', '2023-05-29 08:50:50', 'confirmed'),
(68, 'abdishakur', 'mohamed', 'Yusuf', 'abdishakour.moyousuf@gmail.com', 'a01610228fe998f515a72dd730294d87', '72859d0c11be4d8790c6e0a498018f65', '2023-06-04 15:03:05', 'confirmed'),
(70, 'Bernabas ', 'Alemayehu ', 'Demeke', 'bernabasalemayehu121@gmail.com', '9109fa688487688bc6538c40c9887199', '72859d0c11be4d8790c6e0a498018f65', '2023-06-09 07:32:06', 'confirmed'),
(71, 'Abiel', 'Abrham', 'Yacob', 'tomy0abr@gmail.com', '858f9aad473a0109eaca99f73c7e032a', '72859d0c11be4d8790c6e0a498018f65', '2023-06-27 05:10:48', 'confirmed'),
(72, 'Tomas', 'Yemane', 'Berhe', 'abielabrhamyacob@gmail.com', 'f012160df82460f7d932a408334a7633', '72859d0c11be4d8790c6e0a498018f65', '2023-06-27 23:11:16', 'confirmed'),
(74, 'tom', 'sldjfns', 'sldjfnsdf', 'ksjdfsd@gmail.com', '34b7da764b21d298ef307d04d8152dc5', '72859d0c11be4d8790c6e0a498018f65', '2023-06-28 14:25:53', 'unconfirmed'),
(75, 'asds', 'sdfsd', 'sdfsdf', 'abr@gmail.com', 'e97deb1a81a22a8dbad2a563b4c7012e', 'f8e2cdfd106f968db8f5feb8078a8064', '2023-06-30 05:44:12', 'unconfirmed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbladmissions`
--
ALTER TABLE `tbladmissions`
  ADD PRIMARY KEY (`Adm_App_ID`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldocument`
--
ALTER TABLE `tbldocument`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`Application_ID`),
  ADD UNIQUE KEY `Pay_Ref` (`Pay_Ref`);

--
-- Indexes for table `tblregistered`
--
ALTER TABLE `tblregistered`
  ADD PRIMARY KEY (`Reg_ID`),
  ADD UNIQUE KEY `Reg_User_ID` (`Reg_User_ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbldocument`
--
ALTER TABLE `tbldocument`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblregistered`
--
ALTER TABLE `tblregistered`
  MODIFY `Reg_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
