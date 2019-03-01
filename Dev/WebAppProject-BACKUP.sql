-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2019 at 04:00 PM
-- Server version: 5.5.57-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_15080900`
--



--
-- Table structure for table `batteryspec`
--

CREATE TABLE `batteryspec` (
  `DroneID` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `Chemistry` varchar(30) NOT NULL,
  `PowerOutput` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checklist`
--

CREATE TABLE `checklist` (
  `ChecklistID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DroneID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `dateCreated` date NOT NULL,
  `Description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `checklistamendment`
--

CREATE TABLE `checklistamendment` (
  `ChecklistID` int(11) NOT NULL,
  `AmendmentNo` int(11) NOT NULL,
  `AmendmentDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drone`
--

CREATE TABLE `drone` (
  `DroneID` int(11) NOT NULL,
  `DroneName` varchar(40) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dronecharacteristics`
--

CREATE TABLE `dronecharacteristics` (
  `DroneID` int(11) NOT NULL,
  `MaxOperatingSpeed` int(11) NOT NULL,
  `LaunchType` varchar(40) NOT NULL,
  `MaxFlightTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dronedesignation`
--

CREATE TABLE `dronedesignation` (
  `DroneID` int(11) NOT NULL,
  `Manufacturer` varchar(40) NOT NULL,
  `ModelName` varchar(40) NOT NULL,
  `DroneType` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `environmentlimits`
--

CREATE TABLE `environmentlimits` (
  `DroneID` int(11) NOT NULL,
  `MaxHeight` int(11) NOT NULL,
  `MaxRadius` int(11) NOT NULL,
  `MaxWind` int(11) NOT NULL,
  `TempRangeMin` int(11) NOT NULL,
  `TempRangeMax` int(11) NOT NULL,
  `OperatingWeather` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loadinglist`
--

CREATE TABLE `loadinglist` (
  `ChecklistID` int(11) NOT NULL,
  `WeatherCheck` varchar(40) DEFAULT NULL,
  `OpsManual` bit(1) DEFAULT NULL,
  `Maps` bit(1) DEFAULT NULL,
  `TaskInfo` bit(1) DEFAULT NULL,
  `SafetyEquipment` bit(1) DEFAULT NULL,
  `LiPoBag` bit(1) DEFAULT NULL,
  `Controller` bit(1) DEFAULT NULL,
  `EquimentCharged` bit(1) DEFAULT NULL,
  `Camera` bit(1) DEFAULT NULL,
  `RPAPlatform` bit(1) DEFAULT NULL,
  `Propellers` bit(1) DEFAULT NULL,
  `CarryingCase` bit(1) DEFAULT NULL,
  `PermissionGranted` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payload`
--

CREATE TABLE `payload` (
  `DroneID` int(11) NOT NULL,
  `PayloadName` varchar(40) NOT NULL,
  `MinTemp` int(11) NOT NULL,
  `MaxTemp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postlanding`
--

CREATE TABLE `postlanding` (
  `ChecklistID` int(11) NOT NULL,
  `PowerDownRPA` bit(1) DEFAULT NULL,
  `RemoveRPABattery` bit(1) DEFAULT NULL,
  `RPABatteryOnCharge` bit(1) DEFAULT NULL,
  `RPADamagedCheck` bit(1) DEFAULT NULL,
  `PropellerCheck` bit(1) DEFAULT NULL,
  `LandingGearCheck` bit(1) DEFAULT NULL,
  `RecordFlightDetails` bit(1) DEFAULT NULL,
  `CameraDataDownloaded` bit(1) DEFAULT NULL,
  `ControllerOff` bit(1) DEFAULT NULL,
  `EquipmentPacked` bit(1) DEFAULT NULL,
  `AreaChecked` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posttakeoff`
--

CREATE TABLE `posttakeoff` (
  `ChecklistID` int(11) NOT NULL,
  `BothControlSticksInnter` bit(1) DEFAULT NULL,
  `ControllerResponds` bit(1) DEFAULT NULL,
  `RPAStable` bit(1) DEFAULT NULL,
  `TakeOffTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CameraCheck` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preflight`
--

CREATE TABLE `preflight` (
  `ChecklistID` int(11) NOT NULL,
  `WeatherCheck` varchar(40) DEFAULT NULL,
  `SiteSurveyed` bit(1) DEFAULT NULL,
  `RPASSService` bit(1) DEFAULT NULL,
  `TakeOffAreaEstablished` bit(1) DEFAULT NULL,
  `AssistantBriefed` bit(1) DEFAULT NULL,
  `ControllerConnects` bit(1) DEFAULT NULL,
  `RPADamageCheck` bit(1) DEFAULT NULL,
  `BatteryCompartment` bit(1) DEFAULT NULL,
  `RPAMotors` bit(1) DEFAULT NULL,
  `CheckPropellers` bit(1) DEFAULT NULL,
  `CheckCamera` bit(1) DEFAULT NULL,
  `DronePowered` bit(1) DEFAULT NULL,
  `DroneHomeLocked` bit(1) DEFAULT NULL,
  `CheckGroundStation` bit(1) DEFAULT NULL,
  `VideoCheck` bit(1) DEFAULT NULL,
  `TakeOffAreaClear` bit(1) DEFAULT NULL,
  `TakeOffClearence` bit(1) DEFAULT NULL,
  `AirspaceClear` bit(1) DEFAULT NULL,
  `FitToFly` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prelanding`
--

CREATE TABLE `prelanding` (
  `ChecklistID` int(11) NOT NULL,
  `LandingAreaClear` bit(1) DEFAULT NULL,
  `ManualAutoLand` bit(1) DEFAULT NULL,
  `LandingTimeRecorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rpsspecs`
--

CREATE TABLE `rpsspecs` (
  `DroneID` int(11) NOT NULL,
  `DataLink` varchar(40) NOT NULL,
  `VideoLink` varchar(40) NOT NULL,
  `antennaType` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `techspecs`
--

CREATE TABLE `techspecs` (
  `DroneID` int(11) NOT NULL,
  `Height` int(11) NOT NULL,
  `Width` int(11) NOT NULL,
  `Length` int(11) NOT NULL,
  `Weight` int(11) NOT NULL,
  `MaxTakeOffWeight` int(11) NOT NULL,
  `MotorType` varchar(40) NOT NULL,
  `MotorSpeed` int(11) NOT NULL,
  `ControlDataLink` varchar(40) NOT NULL,
  `VideoDataLink` varchar(40) NOT NULL,
  `FlightController` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `userKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Email`, `Name`, `Password`, `userKey`) VALUES
(16, 'user', 'go', '$2y$10$Xq3DXsLcU1Ye.Yi2ZAMCoOBB/IOclIguuMdtSUqeTIcgcbBxSLsre', NULL);

--
-- Indexes for dumped tables
--


--
-- Indexes for table `batteryspec`
--
ALTER TABLE `batteryspec`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `checklist`
--
ALTER TABLE `checklist`
  ADD PRIMARY KEY (`ChecklistID`),
  ADD KEY `FK_CHECKLIST_USER` (`UserID`),
  ADD KEY `FK_CHECKLIST_DRONE` (`DroneID`);

--
-- Indexes for table `checklistamendment`
--
ALTER TABLE `checklistamendment`
  ADD PRIMARY KEY (`ChecklistID`,`AmendmentNo`);

--
-- Indexes for table `drone`
--
ALTER TABLE `drone`
  ADD PRIMARY KEY (`DroneID`),
  ADD KEY `FK_DRONE` (`UserID`);

--
-- Indexes for table `dronecharacteristics`
--
ALTER TABLE `dronecharacteristics`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `dronedesignation`
--
ALTER TABLE `dronedesignation`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `environmentlimits`
--
ALTER TABLE `environmentlimits`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `loadinglist`
--
ALTER TABLE `loadinglist`
  ADD PRIMARY KEY (`ChecklistID`);

--
-- Indexes for table `payload`
--
ALTER TABLE `payload`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `postlanding`
--
ALTER TABLE `postlanding`
  ADD PRIMARY KEY (`ChecklistID`);

--
-- Indexes for table `posttakeoff`
--
ALTER TABLE `posttakeoff`
  ADD PRIMARY KEY (`ChecklistID`);

--
-- Indexes for table `preflight`
--
ALTER TABLE `preflight`
  ADD PRIMARY KEY (`ChecklistID`);

--
-- Indexes for table `prelanding`
--
ALTER TABLE `prelanding`
  ADD PRIMARY KEY (`ChecklistID`);

--
-- Indexes for table `rpsspecs`
--
ALTER TABLE `rpsspecs`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `techspecs`
--
ALTER TABLE `techspecs`
  ADD PRIMARY KEY (`DroneID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--


--
-- AUTO_INCREMENT for table `checklist`
--
ALTER TABLE `checklist`
  MODIFY `ChecklistID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drone`
--
ALTER TABLE `drone`
  MODIFY `DroneID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--


--
-- Constraints for table `batteryspec`
--
ALTER TABLE `batteryspec`
  ADD CONSTRAINT `FK_BS` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `checklist`
--
ALTER TABLE `checklist`
  ADD CONSTRAINT `FK_CHECKLIST_USER` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `FK_CHECKLIST_DRONE` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `checklistamendment`
--
ALTER TABLE `checklistamendment`
  ADD CONSTRAINT `FK_CHECKLISTAMENDMENT_CHECKLIST` FOREIGN KEY (`ChecklistID`) REFERENCES `checklist` (`ChecklistID`);

--
-- Constraints for table `drone`
--
ALTER TABLE `drone`
  ADD CONSTRAINT `FK_DRONE` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `dronecharacteristics`
--
ALTER TABLE `dronecharacteristics`
  ADD CONSTRAINT `FK_DD` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `dronedesignation`
--
ALTER TABLE `dronedesignation`
  ADD CONSTRAINT `FK_DD_Drone` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `environmentlimits`
--
ALTER TABLE `environmentlimits`
  ADD CONSTRAINT `FK_EL` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `loadinglist`
--
ALTER TABLE `loadinglist`
  ADD CONSTRAINT `FK_LL` FOREIGN KEY (`ChecklistID`) REFERENCES `checklist` (`ChecklistID`);

--
-- Constraints for table `payload`
--
ALTER TABLE `payload`
  ADD CONSTRAINT `FK_PL` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `postlanding`
--
ALTER TABLE `postlanding`
  ADD CONSTRAINT `FK_CPL` FOREIGN KEY (`ChecklistID`) REFERENCES `checklist` (`ChecklistID`);

--
-- Constraints for table `posttakeoff`
--
ALTER TABLE `posttakeoff`
  ADD CONSTRAINT `FK_PTO` FOREIGN KEY (`ChecklistID`) REFERENCES `checklist` (`ChecklistID`);

--
-- Constraints for table `preflight`
--
ALTER TABLE `preflight`
  ADD CONSTRAINT `FK_PFC` FOREIGN KEY (`ChecklistID`) REFERENCES `checklist` (`ChecklistID`);

--
-- Constraints for table `prelanding`
--
ALTER TABLE `prelanding`
  ADD CONSTRAINT `FK_PreLand` FOREIGN KEY (`ChecklistID`) REFERENCES `checklist` (`ChecklistID`);

--
-- Constraints for table `rpsspecs`
--
ALTER TABLE `rpsspecs`
  ADD CONSTRAINT `FK_RPS` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);

--
-- Constraints for table `techspecs`
--
ALTER TABLE `techspecs`
  ADD CONSTRAINT `FK_TS` FOREIGN KEY (`DroneID`) REFERENCES `drone` (`DroneID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
