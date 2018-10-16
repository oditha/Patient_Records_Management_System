/*
Navicat MySQL Data Transfer

Source Server         : mydb
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : PRMS

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2018-05-19 20:56:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for DocLogging
-- ----------------------------
DROP TABLE IF EXISTS `DocLogging`;
CREATE TABLE `DocLogging` (
  `idDocLogging` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `IsDelete` varchar(45) DEFAULT NULL,
  `idDoctor` int(11) NOT NULL,
  PRIMARY KEY (`idDocLogging`),
  KEY `fk_DocLogging_Doctor1_idx` (`idDoctor`),
  CONSTRAINT `fk_DocLogging_Doctor1` FOREIGN KEY (`idDoctor`) REFERENCES `Doctor` (`idDoctor`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of DocLogging
-- ----------------------------
INSERT INTO `DocLogging` VALUES ('1', 'amda', '123', 'Active', '1');
INSERT INTO `DocLogging` VALUES ('2', 'jula', '123', 'Active', '2');

-- ----------------------------
-- Table structure for Doctor
-- ----------------------------
DROP TABLE IF EXISTS `Doctor`;
CREATE TABLE `Doctor` (
  `idDoctor` int(11) NOT NULL AUTO_INCREMENT,
  `DoctorName` varchar(45) DEFAULT NULL,
  `DoctorContactNo` varchar(45) DEFAULT NULL,
  `DocterAddress1` varchar(45) DEFAULT NULL,
  `DoctorAddress2` varchar(45) DEFAULT NULL,
  `DocterAddressCity` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Createby` varchar(45) DEFAULT NULL,
  `Isdelete` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDoctor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Doctor
-- ----------------------------
INSERT INTO `Doctor` VALUES ('1', 'Amdaaaa', '0776953022', '123', 'kandy', 'kandy', 'amda@gmail.com', 'update by - udaya', 'Active', null);
INSERT INTO `Doctor` VALUES ('2', 'julaaaaa', '0776953022', '152', 'aaa', 'bbb', 'jula@gmail.com', 'update by - udaya', 'Active', null);
INSERT INTO `Doctor` VALUES ('3', 'teenaaaaaaaa', '075651255', '45', 'pujapitiya', 'kandy', 'teena@gmail.com', 'update by - udaya', 'Active', null);

-- ----------------------------
-- Table structure for Drug
-- ----------------------------
DROP TABLE IF EXISTS `Drug`;
CREATE TABLE `Drug` (
  `idDrug` int(11) NOT NULL AUTO_INCREMENT,
  `DrugName` varchar(45) DEFAULT NULL,
  `Isdelete` varchar(45) DEFAULT NULL,
  `CreateBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDrug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Drug
-- ----------------------------
INSERT INTO `Drug` VALUES ('1', 'Hykophos', 'Active', null);
INSERT INTO `Drug` VALUES ('2', 'Antagit-DS', 'Active', null);
INSERT INTO `Drug` VALUES ('3', 'Micogel cream', 'Active', null);
INSERT INTO `Drug` VALUES ('4', 'Cortileb', 'Active', null);
INSERT INTO `Drug` VALUES ('5', 'Aledrid', 'Active', null);

-- ----------------------------
-- Table structure for LoggingHistory
-- ----------------------------
DROP TABLE IF EXISTS `LoggingHistory`;
CREATE TABLE `LoggingHistory` (
  `idLoggingHistory` int(11) NOT NULL AUTO_INCREMENT,
  `logTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UserName` varchar(45) DEFAULT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `IsStaff` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idLoggingHistory`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of LoggingHistory
-- ----------------------------
INSERT INTO `LoggingHistory` VALUES ('2', '0000-00-00 00:00:00', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('3', '0000-00-00 00:00:00', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('4', '0000-00-00 00:00:00', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('5', '2018-04-06 13:06:56', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('6', '2018-04-06 13:15:33', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('7', '2018-04-06 13:16:24', 'oditha', 'cashier', 'YES');
INSERT INTO `LoggingHistory` VALUES ('8', '2018-04-06 13:17:52', 'oditha', 'cashier', 'YES');
INSERT INTO `LoggingHistory` VALUES ('9', '2018-04-06 13:26:23', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('10', '2018-04-06 13:32:25', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('11', '2018-04-06 18:14:40', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('12', '2018-04-07 09:34:53', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('13', '2018-04-07 13:06:40', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('14', '2018-04-29 10:04:21', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('15', '2018-04-30 10:41:31', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('16', '2018-05-01 10:04:12', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('17', '2018-05-01 17:18:35', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('18', '2018-05-02 12:17:54', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('19', '2018-05-02 15:31:15', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('20', '2018-05-03 11:27:40', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('21', '2018-05-03 12:07:37', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('22', '2018-05-03 12:40:19', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('23', '2018-05-05 13:08:56', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('24', '2018-05-07 12:26:51', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('25', '2018-05-07 16:19:16', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('26', '2018-05-07 16:35:30', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('27', '2018-05-08 11:49:33', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('28', '2018-05-09 11:10:40', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('29', '2018-05-09 11:17:06', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('30', '2018-05-11 13:08:16', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('31', '2018-05-11 14:48:23', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('32', '2018-05-11 16:20:03', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('33', '2018-05-12 11:46:44', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('34', '2018-05-12 19:23:45', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('35', '2018-05-13 22:18:43', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('36', '2018-05-15 11:26:42', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('37', '2018-05-15 16:55:08', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('38', '2018-05-16 09:03:34', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('39', '2018-05-16 13:50:41', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('40', '2018-05-16 13:53:24', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('41', '2018-05-16 15:21:35', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('42', '2018-05-17 16:46:07', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('43', '2018-05-18 10:05:10', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('44', '2018-05-18 17:24:20', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('45', '2018-05-19 11:16:11', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('46', '2018-05-19 14:43:26', 'udaya', 'Admin', 'YES');
INSERT INTO `LoggingHistory` VALUES ('47', '2018-05-19 15:30:30', 'udaya', 'Admin', 'YES');

-- ----------------------------
-- Table structure for Package
-- ----------------------------
DROP TABLE IF EXISTS `Package`;
CREATE TABLE `Package` (
  `idPackage` int(11) NOT NULL AUTO_INCREMENT,
  `PackageName` varchar(45) DEFAULT NULL,
  `PackageDescription` longtext,
  `PackagePriceMember` double DEFAULT NULL,
  `PackagePriceRegular` double DEFAULT NULL,
  `Isdelete` varchar(45) DEFAULT NULL,
  `Createby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPackage`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Package
-- ----------------------------
INSERT INTO `Package` VALUES ('25', 'Pro', 'dfddf                            ', '4000', '5000', 'Active', 'add by - udaya');
INSERT INTO `Package` VALUES ('26', 'Premium', 'get premium package                            ', '3000', '4000', 'Active', 'add by - udaya');
INSERT INTO `Package` VALUES ('27', 'Medium', 'get medium package                            ', '2500', '2800', 'Active', 'update by - udaya');

-- ----------------------------
-- Table structure for PackageHasPatient
-- ----------------------------
DROP TABLE IF EXISTS `PackageHasPatient`;
CREATE TABLE `PackageHasPatient` (
  `CreateBy` varchar(45) DEFAULT NULL,
  `packageDate` varchar(45) DEFAULT NULL,
  `PackageCost` double DEFAULT NULL,
  `idRecords` int(11) NOT NULL AUTO_INCREMENT,
  `idPackage` int(11) NOT NULL,
  `idPatient` int(11) NOT NULL,
  PRIMARY KEY (`idRecords`),
  KEY `fk_PackageHasPatient_Package1_idx` (`idPackage`),
  KEY `fk_PackageHasPatient_Patient1_idx` (`idPatient`),
  CONSTRAINT `fk_PackageHasPatient_Package1` FOREIGN KEY (`idPackage`) REFERENCES `Package` (`idPackage`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PackageHasPatient_Patient1` FOREIGN KEY (`idPatient`) REFERENCES `Patient` (`idPatient`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PackageHasPatient
-- ----------------------------
INSERT INTO `PackageHasPatient` VALUES ('add by - udaya', '05/05/18', '3000', '4', '26', '13');
INSERT INTO `PackageHasPatient` VALUES ('add by - udaya', '05/05/18', '4000', '5', '25', '14');
INSERT INTO `PackageHasPatient` VALUES ('add by - udaya', '05/05/18', '2500', '6', '27', '15');
INSERT INTO `PackageHasPatient` VALUES ('add by - udaya', '08/05/18', '3000', '7', '26', '16');

-- ----------------------------
-- Table structure for PackageHasTest
-- ----------------------------
DROP TABLE IF EXISTS `PackageHasTest`;
CREATE TABLE `PackageHasTest` (
  `idRecords` int(11) NOT NULL AUTO_INCREMENT,
  `IsDelete` varchar(45) DEFAULT NULL,
  `idPackage` int(11) NOT NULL,
  `IdTest` int(11) NOT NULL,
  PRIMARY KEY (`idRecords`),
  KEY `fk_PackageHasTest_Package_idx` (`idPackage`),
  KEY `fk_PackageHasTest_Test1_idx` (`IdTest`),
  CONSTRAINT `fk_PackageHasTest_Package` FOREIGN KEY (`idPackage`) REFERENCES `Package` (`idPackage`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PackageHasTest_Test1` FOREIGN KEY (`IdTest`) REFERENCES `Test` (`IdTest`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PackageHasTest
-- ----------------------------
INSERT INTO `PackageHasTest` VALUES ('4', 'Active', '25', '1');
INSERT INTO `PackageHasTest` VALUES ('5', 'Active', '25', '2');
INSERT INTO `PackageHasTest` VALUES ('6', 'Active', '26', '1');
INSERT INTO `PackageHasTest` VALUES ('7', 'Active', '27', '2');

-- ----------------------------
-- Table structure for PackagePayment
-- ----------------------------
DROP TABLE IF EXISTS `PackagePayment`;
CREATE TABLE `PackagePayment` (
  `idPackagePayment` int(11) NOT NULL AUTO_INCREMENT,
  `Amount` int(15) DEFAULT NULL,
  `PaymentDate` varchar(45) DEFAULT NULL,
  `Isdelete` varchar(45) DEFAULT NULL,
  `idPayments` int(11) NOT NULL,
  `idRecords` int(11) NOT NULL,
  `Doctor` varchar(45) DEFAULT NULL,
  `PackName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPackagePayment`),
  KEY `fk_PackagePayment_Payments1_idx` (`idPayments`),
  KEY `fk_PackagePayment_PackageHasPatient1_idx` (`idRecords`),
  CONSTRAINT `fk_PackagePayment_PackageHasPatient1` FOREIGN KEY (`idRecords`) REFERENCES `PackageHasPatient` (`idRecords`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PackagePayment_Payments1` FOREIGN KEY (`idPayments`) REFERENCES `Payments` (`idPayments`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PackagePayment
-- ----------------------------
INSERT INTO `PackagePayment` VALUES ('14', '3000', '19/05/18', 'Active', '34', '4', 'Dr. Amda (0776953022 )', 'Premium');

-- ----------------------------
-- Table structure for Patient
-- ----------------------------
DROP TABLE IF EXISTS `Patient`;
CREATE TABLE `Patient` (
  `idPatient` int(11) NOT NULL AUTO_INCREMENT,
  `RegNo` varchar(45) DEFAULT NULL,
  `FullName` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `DOB` varchar(45) DEFAULT NULL,
  `AddressHome1` varchar(45) DEFAULT NULL,
  `AddressHome2` varchar(45) DEFAULT NULL,
  `AddressHomeCity` varchar(45) DEFAULT NULL,
  `AddressOffice1` varchar(45) DEFAULT NULL,
  `AddressOffice2` varchar(45) DEFAULT NULL,
  `AddressOfficeCity` varchar(45) DEFAULT NULL,
  `ContactMobile` varchar(45) DEFAULT NULL,
  `ContactHome` varchar(45) DEFAULT NULL,
  `ContactOffice` varchar(45) DEFAULT NULL,
  `isDelete` varchar(45) DEFAULT NULL,
  `RegisterDate` varchar(45) DEFAULT NULL,
  `BloodGroup` varchar(45) DEFAULT NULL,
  `Createby` varchar(45) DEFAULT NULL,
  `Image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPatient`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Patient
-- ----------------------------
INSERT INTO `Patient` VALUES ('13', '001', 'udaya', '1994-05-29', '50/3', 'pujapitiya', 'kandy', '', '', '', '0776953022', '081902081', '', 'Active', '19/05/18', 'B+', 'update by - udaya', null);
INSERT INTO `Patient` VALUES ('14', '002', 'oditha', '1992-12-09', '12', 'badulla', 'badulla', '', '', '', '0776803088', '0552514452', '', 'Active', '27/03/18', 'B-', 'update by - udaya', null);
INSERT INTO `Patient` VALUES ('15', '003', 'arshak', '1997-06-12', '36', 'matale', 'matale', '', '', '', '0778451220', '0663665521', '', 'Active', '08/05/18', '', 'update by - udaya', null);
INSERT INTO `Patient` VALUES ('16', '004', 'danushka', '1992-10-21', '56', 'bandarawela', 'bandarawela', '', '', '', '0714552146', '0815421155', '', 'Active', '08/05/18', 'AB-', 'add by - udaya', null);

-- ----------------------------
-- Table structure for PatientHasDrug
-- ----------------------------
DROP TABLE IF EXISTS `PatientHasDrug`;
CREATE TABLE `PatientHasDrug` (
  `idDrugPT` int(11) NOT NULL AUTO_INCREMENT,
  `RequestDate` varchar(45) DEFAULT NULL,
  `IsDelete` varchar(45) DEFAULT NULL,
  `CreateBy` varchar(45) DEFAULT NULL,
  `DrugName` varchar(45) DEFAULT NULL,
  `Dose` varchar(45) DEFAULT NULL,
  `idDrug` int(11) NOT NULL,
  `idDoctor` int(11) NOT NULL,
  `idPatient` int(11) NOT NULL,
  `Doctor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDrugPT`),
  KEY `fk_PatientHasDrug_Drug1_idx` (`idDrug`),
  KEY `fk_PatientHasDrug_Doctor1_idx` (`idDoctor`),
  KEY `fk_PatientHasDrug_Patient1_idx` (`idPatient`),
  CONSTRAINT `fk_PatientHasDrug_Doctor1` FOREIGN KEY (`idDoctor`) REFERENCES `Doctor` (`idDoctor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientHasDrug_Drug1` FOREIGN KEY (`idDrug`) REFERENCES `Drug` (`idDrug`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientHasDrug_Patient1` FOREIGN KEY (`idPatient`) REFERENCES `Patient` (`idPatient`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PatientHasDrug
-- ----------------------------
INSERT INTO `PatientHasDrug` VALUES ('102', '18/05/18', 'Deactive', 'add by - udaya', 'Antagit-DS', '45', '2', '1', '13', 'Dr. Amda (0776953022 )');
INSERT INTO `PatientHasDrug` VALUES ('103', '17/05/18', 'Deactive', 'add by - udaya', 'Aledrid', '15', '5', '1', '13', 'Dr. Amda (0776953022 )');
INSERT INTO `PatientHasDrug` VALUES ('104', '16/05/18', 'Deactive', 'add by - udaya', 'Aledrid', '15', '5', '1', '13', 'Dr. Amda (0776953022 )');

-- ----------------------------
-- Table structure for PatientHasTest
-- ----------------------------
DROP TABLE IF EXISTS `PatientHasTest`;
CREATE TABLE `PatientHasTest` (
  `idPatientHasTest` int(11) NOT NULL AUTO_INCREMENT,
  `TestCost` double DEFAULT NULL,
  `Status` longtext,
  `CreateBy` varchar(45) DEFAULT NULL,
  `TestDate` varchar(45) DEFAULT NULL,
  `TestName` varchar(45) DEFAULT NULL,
  `IsDelete` varchar(45) DEFAULT NULL,
  `IdTest` int(11) DEFAULT NULL,
  `idPatient` int(11) DEFAULT NULL,
  `idDoctor` int(11) DEFAULT NULL,
  `Doctor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPatientHasTest`),
  KEY `fk_PatientHasTest_Test1_idx` (`IdTest`),
  KEY `fk_PatientHasTest_Patient1_idx` (`idPatient`),
  CONSTRAINT `fk_PatientHasTest_Patient1` FOREIGN KEY (`idPatient`) REFERENCES `Patient` (`idPatient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientHasTest_Test1` FOREIGN KEY (`IdTest`) REFERENCES `Test` (`IdTest`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PatientHasTest
-- ----------------------------
INSERT INTO `PatientHasTest` VALUES ('61', '2000', null, 'add by - udaya', '18/05/18', 'BLOOD TEST ', 'Deactive', '1', '13', '1', 'Dr. Amda (0776953022 )');
INSERT INTO `PatientHasTest` VALUES ('62', '2000', null, 'add by - udaya', '15/05/18', 'BLOOD TEST ', 'Deactive', '1', '13', '1', 'Dr. Amda (0776953022 )');
INSERT INTO `PatientHasTest` VALUES ('63', '2000', null, 'add by - udaya', '19/05/18', 'BLOOD TEST ', 'Active', '1', '13', '1', 'Dr. Amda (0776953022 )');

-- ----------------------------
-- Table structure for PatientTestHasDoctor
-- ----------------------------
DROP TABLE IF EXISTS `PatientTestHasDoctor`;
CREATE TABLE `PatientTestHasDoctor` (
  `idRecords` int(11) NOT NULL AUTO_INCREMENT,
  `IsDelete` varchar(45) DEFAULT NULL,
  `idDoctor` int(11) DEFAULT NULL,
  `idPatientHasTest` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRecords`),
  KEY `fk_PatientTestHasDoctor_Doctor1_idx` (`idDoctor`),
  KEY `fk_PatientTestHasDoctor_PatientHasTest1_idx` (`idPatientHasTest`),
  CONSTRAINT `fk_PatientTestHasDoctor_Doctor1` FOREIGN KEY (`idDoctor`) REFERENCES `Doctor` (`idDoctor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientTestHasDoctor_PatientHasTest1` FOREIGN KEY (`idPatientHasTest`) REFERENCES `PatientHasTest` (`idPatientHasTest`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of PatientTestHasDoctor
-- ----------------------------

-- ----------------------------
-- Table structure for Payments
-- ----------------------------
DROP TABLE IF EXISTS `Payments`;
CREATE TABLE `Payments` (
  `idPayments` int(11) NOT NULL AUTO_INCREMENT,
  `PaymentDay` varchar(45) DEFAULT NULL,
  `PaymentAmount` int(15) DEFAULT NULL,
  `PaymentType` varchar(45) DEFAULT NULL,
  `Isdelete` varchar(45) DEFAULT NULL,
  `CreateBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPayments`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Payments
-- ----------------------------
INSERT INTO `Payments` VALUES ('29', '18/05/18', '2000', 'Cash', 'Active', 'add by - udaya');
INSERT INTO `Payments` VALUES ('30', '18/05/18', '5000', 'Cash', 'Active', 'add by - udaya');
INSERT INTO `Payments` VALUES ('31', '19/05/18', '0', 'Cash', 'Active', 'add by - udaya');
INSERT INTO `Payments` VALUES ('32', '19/05/18', '2000', 'Cash', 'Active', 'add by - udaya');
INSERT INTO `Payments` VALUES ('33', '19/05/18', '3000', 'Cash', 'Active', 'add by - udaya');
INSERT INTO `Payments` VALUES ('34', '19/05/18', '3000', 'Cash', 'Active', 'add by - udaya');
INSERT INTO `Payments` VALUES ('35', '19/05/18', '3000', 'Cash', 'Active', 'add by - udaya');

-- ----------------------------
-- Table structure for Test
-- ----------------------------
DROP TABLE IF EXISTS `Test`;
CREATE TABLE `Test` (
  `IdTest` int(11) NOT NULL AUTO_INCREMENT,
  `TestReffrence` varchar(45) DEFAULT NULL,
  `TestName` varchar(100) DEFAULT NULL,
  `TestDescription` varchar(400) DEFAULT NULL,
  `TestPriceMember` double DEFAULT NULL,
  `TestPriceRegular` double DEFAULT NULL,
  `IsDelete` varchar(45) DEFAULT NULL,
  `Createby` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IdTest`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of Test
-- ----------------------------
INSERT INTO `Test` VALUES ('1', '001', 'BLOOD TEST ', '', '2000', '2500', 'Active', 'update by - udaya');
INSERT INTO `Test` VALUES ('2', null, 'URINE TEST', '         ', '800', '1000', 'Active', 'update by - udaya');
INSERT INTO `Test` VALUES ('3', null, 'ABC', '                      ', '1200', '1500', 'Active', 'update by - udaya');

-- ----------------------------
-- Table structure for TestPayment
-- ----------------------------
DROP TABLE IF EXISTS `TestPayment`;
CREATE TABLE `TestPayment` (
  `idTestPayment` int(11) NOT NULL AUTO_INCREMENT,
  `Amount` int(15) DEFAULT NULL,
  `PaymentDate` varchar(45) DEFAULT NULL,
  `Isdelete` varchar(45) DEFAULT NULL,
  `idPayments` int(11) NOT NULL,
  `IdTest` int(11) NOT NULL,
  `idPatientHasTest` int(11) NOT NULL,
  PRIMARY KEY (`idTestPayment`),
  KEY `fk_TestPayment_Payments1_idx` (`idPayments`),
  KEY `fk_TestPayment_Test1_idx` (`IdTest`),
  KEY `fk_TestPayment_PatientHasTest1_idx` (`idPatientHasTest`),
  CONSTRAINT `fk_TestPayment_PatientHasTest1` FOREIGN KEY (`idPatientHasTest`) REFERENCES `PatientHasTest` (`idPatientHasTest`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TestPayment_Payments1` FOREIGN KEY (`idPayments`) REFERENCES `Payments` (`idPayments`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TestPayment_Test1` FOREIGN KEY (`IdTest`) REFERENCES `Test` (`IdTest`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of TestPayment
-- ----------------------------
INSERT INTO `TestPayment` VALUES ('14', '2000', '18/05/18', 'Active', '29', '1', '61');
INSERT INTO `TestPayment` VALUES ('15', '2000', '18/05/18', 'Active', '30', '1', '62');
INSERT INTO `TestPayment` VALUES ('16', '2000', '19/05/18', 'Active', '32', '1', '63');

-- ----------------------------
-- Table structure for User
-- ----------------------------
DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `NIC` varchar(15) DEFAULT NULL,
  `Name` text,
  `ContactNo` varchar(45) DEFAULT NULL,
  `UserName` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `AddBy` varchar(45) DEFAULT NULL,
  `Image` longtext,
  `Type` varchar(45) DEFAULT NULL,
  `IsDelete` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of User
-- ----------------------------
INSERT INTO `User` VALUES ('1', '941501087v', 'udaya', '0776953022', 'udaya', '123', 'uslive1994@gmail.com', 'update by - udaya', null, 'Admin', 'Active');
INSERT INTO `User` VALUES ('2', '944210021v', 'prasad', '0715456455', null, null, 'prasadsudarshana@gmail.com', 'update by - udaya', null, 'cashier', 'Active');
INSERT INTO `User` VALUES ('3', '941501087v', 'oditha', '0778542225', 'oditha', '123', 'odk@gmail.com', 'update by - udaya', null, 'cashier', 'Active');
INSERT INTO `User` VALUES ('4', '927841254v', 'danushka', '07854525545', null, null, 'danushkasampath@gmail.com', 'update by - udaya', null, 'cashier', 'Active');
