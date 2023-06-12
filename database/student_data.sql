-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 12:04 PM
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
-- Dumping data for table `tbladmapplications`
--

INSERT INTO `tbladmapplications` (`ID`, `UserId`, `CourseApplied`, `AdmissionType`, `FirstName`, `MiddleName`, `LastName`, `Nationality`, `DobGregorian`, `DobEthiopian`, `Gender`, `UserPic`, `CountryOfBirth`, `TownOfBirth`, `WoredaOfBirth`, `KebeleOfBirth`, `FatherFirstName`, `FatherMiddleName`, `FatherLastName`, `MotherFirstName`, `MotherMiddleName`, `MotherLastName`, `ResidenceTown`, `ResidenceWoreda`, `ResidenceKebele`, `ResidenceHouse`, `PhoneNumber`, `PhoneNumber2`, `Email`, `MaritalStatus`, `EmergencyName`, `EmergencyPhone`, `EmergencyTown`, `EmergencyRelation`, `SchoolName1`, `SchoolTown1`, `SchoolLastYear1`, `SchoolStream1`, `SchoolName2`, `SchoolTown2`, `SchoolLastYear2`, `SchoolStream2`, `SchoolName3`, `SchoolTown3`, `SchoolLastYear3`, `SchoolStream3`, `InsName1`, `InsCountry1`, `InsLastYear1`, `InsMajor1`, `InsName2`, `InsCountry2`, `InsLastYear2`, `InsMajor2`, `InsName3`, `InsCountry3`, `InsLastYear3`, `InsMajor3`, `Declaration`, `Signature`, `CourseApplieddate`, `AdminRemark`, `AdminStatus`, `AdminRemarkDate`) VALUES
(64, '63', 'Computer Science', 'regular', 'Abiel', 'Abrham', 'Yacob', 'Eritrean', '2023-06-21', '2023-06-13', 'Male', 'Abiel_e285509fa183f85b08fa8dd951d91bdf.jpg', 'Eritrea', 'Asmara', '', '', 'Abiel', 'Abrham', 'Yacob', 'Abiel', 'Abrham', 'Yacob', 'Asmara', '5', '08', '108', '+251996113866', '+251996113866', NULL, 'Single', 'Yosief Habtegabr', '+251996113866', 'Asmara', 'relative', 'Failth Mission Highschool', 'Asmara', '2017', 'Science', '', '', '', '', '', 'Asmara', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, 'Abiel Abrham Yacob', '2023-06-08 10:27:22', '', '1', '2023-06-08 10:28:24');

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
-- Dumping data for table `tbladmissions`
--

INSERT INTO `tbladmissions` (`Adm_App_ID`, `Adm_Course`, `Adm_Status`, `Adm_Payment_Status`, `Adm_Offer_Date`, `Adm_Accept_Date`, `Adm_Pay_Date`) VALUES
(64, 'Computer Science', 'accepted', 'unpaid', '2023-06-08 10:28:24', '2023-06-10 09:15:21', NULL);

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

--
-- Dumping data for table `tbldocument`
--

INSERT INTO `tbldocument` (`ID`, `UserID`, `Passport`, `HighSchoolTranscript`, `TenthCertificate`, `TwelfthCertificate`, `PostSecondaryTranscript`, `PostSecondaryCertificate`, `AdditionalDocuments`, `UploadDate`) VALUES
(36, 63, 'Abiel_95cffed8f7c16ad01c22ea83f032d25e.pdf', 'Abiel_f0a8806ed1b8399e8793eb3a60e9e98c.pdf', 'Abiel_3240c9ff40c6a510a6dff5c7abb35083.pdf', 'Abiel_ebd6140b6013a023d6844725ae2dda13.pdf', 'Abiel_a9ea898c5b775b37e02abe02b2e694f5.pdf', '', '', '2023-06-08 10:27:22');

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
(3, 'Admission Notice for BCA / MCA', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', '2021-10-26 03:36:07'),
(4, 'Test Notification for Demo', 'This is demo notification for demo project. Student Admission Management System....', '2021-10-26 04:52:14');

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

-- --------------------------------------------------------

--
-- Table structure for table `tblregistered`
--

CREATE TABLE `tblregistered` (
  `Reg_ID` int NOT NULL,
  `Reg_User_ID` int NOT NULL,
  `Reg_Course` varchar(120) DEFAULT NULL,
  `Reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FirstName`, `MiddleName`, `LastName`, `Email`, `Password`, `Token`, `PostingDate`, `status`) VALUES
(63, 'Tomas', 'Abrham', 'Yacob', 'tomy0abr@gmail.com', '858f9aad473a0109eaca99f73c7e032a', '47c651637a027325b279e224f9db750a', '2023-05-20 12:21:23', 'confirmed'),
(64, 'Abiel', 'Abrham', 'Yacob', 'abielabrhamyacob@gmail.com', 'dbd8c3060a93f6259d3cda549fc0691e', 'b3ca10f3211e8e9da91d88f3ed2ded75', '2023-05-25 10:33:56', 'confirmed'),
(67, 'Maryamawit', 'Mesfin', 'Teshome', 'maryamawit55mesfin@gmail.com', '242de1312002d1d378c567b2dad051cc', '815bd50adb2ef0128acbcb7a832dd3a2', '2023-05-29 08:50:50', 'confirmed'),
(68, 'abdishakur', 'mohamed', 'Yusuf', 'abdishakour.moyousuf@gmail.com', 'a01610228fe998f515a72dd730294d87', 'f549e371b4b943f07258c0b4969e85bb', '2023-06-04 15:03:05', 'confirmed'),
(69, 'Tufa', 'Tu', 'Fa', 'tufaabebe2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '695842b0584fdee281e9870d8db4dc13', '2023-06-09 07:26:57', 'unconfirmed'),
(70, 'Bernabas ', 'Alemayehu ', 'Demeke', 'bernabasalemayehu121@gmail.com', '9109fa688487688bc6538c40c9887199', '959eece74f63d29d3b88cb4d99d88039', '2023-06-09 07:32:06', 'confirmed');

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
  ADD UNIQUE(`UserID`);

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
  ADD UNIQUE KEY (`Pay_Ref`);

--
-- Indexes for table `tblregistered`
--
ALTER TABLE `tblregistered`
  ADD PRIMARY KEY (`Reg_ID`),
  ADD UNIQUE KEY (`Reg_User_ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblregistered`
--
ALTER TABLE `tblregistered`

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbldocument`
--
ALTER TABLE `tbldocument`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tblregistered`
--
ALTER TABLE `tblregistered`
  MODIFY `Reg_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;
  
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
