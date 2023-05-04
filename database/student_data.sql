-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- PHP Version: 8.0.13

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
  `ID` int(11) NOT NULL,
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

  `PhoneNumber` varchar(10) DEFAULT NULL,
  `PhoneNumber2` varchar(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MaritalStatus` varchar(120) DEFAULT NULL,

  `EmergencyName` varchar(120) DEFAULT NULL,
  `EmergencyPhone` varchar(10) DEFAULT NULL,
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

  `InsName1` varchar(120) DEFAULT NULL,
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
  
  `CourseApplieddate` timestamp NOT NULL DEFAULT current_timestamp(),
  `AdminRemark` varchar(255) DEFAULT NULL,
  `AdminStatus` varchar(20) DEFAULT NULL,
  `AdminRemarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) NOT NULL,
  `MobileNumber` int(10) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(2, 'Abiel Abrham', 'tomy0abr@gmail.com', 1234567897, 'tomy0abr@gmail.com', 'Abi 07237626', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(11) NOT NULL,
  `CourseName` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `CourseName`) VALUES
(1, 'Computer Science'),
(2, 'Business Administration'),
(3, 'Accounting'),
(4, 'Nursing');

-- --------------------------------------------------------

--
-- Table structure for table `tbldocument`
--

CREATE TABLE `tbldocument` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TransferCertificate` varchar(120) DEFAULT NULL,
  `TenMarksheeet` varchar(120) DEFAULT NULL,
  `TwelveMarksheet` varchar(120) DEFAULT NULL,
  `GraduationCertificate` varchar(120) DEFAULT NULL,
  `PostgraduationCertificate` varchar(120) DEFAULT NULL,
  `UploadDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `ID` int(11) NOT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Decription` text DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`ID`, `Title`, `Decription`, `CreationDate`) VALUES
(3, 'Admission Notice for BCA / MCA', 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n1914 translation by H. Rackham\r\n\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"', '2021-10-26 06:36:07'),
(4, 'Test Notification for Demo', 'This is demo notification for demo project. Student Admission Management System....', '2021-10-26 07:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Password`, `PostingDate`) VALUES
(5, 'Abiel', 'Yacob', 0996113866, 'tomy0abr@gmail.com', 'Abi 07237626', '');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmapplications`
--
ALTER TABLE `tbladmapplications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbldocument`
--
ALTER TABLE `tbldocument`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
