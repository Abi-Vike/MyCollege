-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 09:26 PM
-- Server version: 8.0.29
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+03:00";


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
-- --------------------------------------------------------

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
(5, 'Rift Valley University', 'riftvalleyuniversity0@gmail.com', '370cf47a6f610f08a2a34fa1fba67c34', NULL);

-- --------------------------------------------------------

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
(3, 'Accounting'),
(4, 'Nursing'),
(15, 'Electrical Engineering');

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
-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `ID` int NOT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Decription` text,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`ID`, `Title`, `Decription`, `CreationDate`) VALUES
(3, 'Upcoming Class Starting date', 'Hey There, Next Season Class Starts on the 20th of September, 2023', '2023-05-26 03:36:07'),
(4, 'Test Notification for Demo', 'This is demo notification for demo project. Student Admission Management System....', '2023--26 04:52:14');

-- --------------------------------------------------------

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


CREATE TABLE `tbladmissions` (
  `Adm_ID` int NOT NULL, --should take UserId from tbladmmapplications
  `Adm_Course` varchar(120) DEFAULT NULL,
  `Adm_Status` varchar(120) DEFAULT 'offered',
  `Adm_Payment_Status` varchar(60) NOT NULL DEFAULT 'unpaid',
  `Adm_Offer_Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Adm_Accept_Date` timestamp NULL DEFAULT NULL,
  `Adm_Pay_Date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tblregistered` (
  `Reg_ID` int NOT NULL, --same as the application ID
  `Reg_User_ID` int NOT NULL, --same as the user ID
  `Reg_Course` varchar(120) DEFAULT NULL,
  `Reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldocument`
--
ALTER TABLE `tbldocument`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbladmissions`
--
ALTER TABLE `tbladmissions`
  ADD PRIMARY KEY (`Adm_ID`);

--
-- Indexes for table `tblregistered`
--
ALTER TABLE `tblregistered`
  ADD PRIMARY KEY (`Reg_ID`);



--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbldocument`
--
ALTER TABLE `tbldocument`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
