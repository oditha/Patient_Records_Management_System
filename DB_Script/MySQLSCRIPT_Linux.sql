-- MySQL Script generated by MySQL Workbench
-- Tue 03 Apr 2018 05:19:48 PM +0530
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema PRMS
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema PRMS
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `PRMS` DEFAULT CHARACTER SET utf8 ;
USE `PRMS` ;

-- -----------------------------------------------------
-- Table `PRMS`.`Patient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`Patient` (
  `idPatient` INT NOT NULL AUTO_INCREMENT,
  `RegNo` VARCHAR(45) NULL,
  `FullName` VARCHAR(300) BINARY NULL,
  `AddressHome1` VARCHAR(45) NULL,
  `AddressHome2` VARCHAR(45) NULL,
  `AddressHomeCity` VARCHAR(45) NULL,
  `AddressOffice1` VARCHAR(45) NULL,
  `AddressOffice2` VARCHAR(45) NULL,
  `AddressOfficeCity` VARCHAR(45) NULL,
  `ContactMobile` INT(15) NULL,
  `ContactHome` INT(15) NULL,
  `ContactOffice` INT(15) NULL,
  `isDelete` VARCHAR(45) NULL,
  `RegisterDate` VARCHAR(45) NULL,
  `Createby` VARCHAR(45) NULL,
  `Image` VARCHAR(45) NULL,
  PRIMARY KEY (`idPatient`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`Test`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`Test` (
  `IdTest` INT NOT NULL AUTO_INCREMENT,
  `TestReffrence` VARCHAR(45) NULL,
  `TestName` VARCHAR(100) NULL,
  `TestDescription` VARCHAR(400) NULL,
  `TestPriceMember` DOUBLE NULL,
  `TestPriceRegular` DOUBLE NULL,
  `IsDelete` VARCHAR(45) NULL,
  `Createby` VARCHAR(45) NULL,
  PRIMARY KEY (`IdTest`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`Package`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`Package` (
  `idPackage` INT NOT NULL AUTO_INCREMENT,
  `PackageName` VARCHAR(45) NULL,
  `PackageDescription` LONGTEXT NULL,
  `PackagePriceMember` DOUBLE NULL,
  `PackagePriceRegular` DOUBLE NULL,
  `Isdelete` VARCHAR(45) NULL,
  `Createby` VARCHAR(45) NULL,
  PRIMARY KEY (`idPackage`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`Doctor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`Doctor` (
  `idDoctor` INT NOT NULL AUTO_INCREMENT,
  `DoctorName` VARCHAR(45) NULL,
  `DoctorType` VARCHAR(45) NULL,
  `DocterAddress1` VARCHAR(45) NULL,
  `DoctorAddress2` VARCHAR(45) NULL,
  `DocterAddressCity` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `Createby` VARCHAR(45) NULL,
  `Isdelete` VARCHAR(45) NULL,
  `image` VARCHAR(45) NULL,
  `Drugs` VARCHAR(45) NULL,
  PRIMARY KEY (`idDoctor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`Drug`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`Drug` (
  `idDrug` INT NOT NULL AUTO_INCREMENT,
  `DrugName` VARCHAR(45) NULL,
  `Isdelete` VARCHAR(45) NULL,
  `CreateBy` VARCHAR(45) NULL,
  PRIMARY KEY (`idDrug`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`Payments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`Payments` (
  `idPayments` INT NOT NULL AUTO_INCREMENT,
  `PaymentDay` VARCHAR(45) NULL,
  `PaymentAmount` INT(15) NULL,
  `PaymentType` VARCHAR(45) NULL,
  `Isdelete` VARCHAR(45) NULL,
  `CreateBy` VARCHAR(45) NULL,
  PRIMARY KEY (`idPayments`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`PatientHasTest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`PatientHasTest` (
  `TestCost` DOUBLE NULL,
  `Status` LONGTEXT NULL,
  `CreateBy` VARCHAR(45) NULL,
  `RequestDate` VARCHAR(45) NULL,
  `TestDate` VARCHAR(45) NULL,
  `IsDelete` VARCHAR(45) NULL,
  `IdTest` INT NOT NULL,
  `idPatient` INT NOT NULL,
  `idRecords` INT NOT NULL AUTO_INCREMENT,
  INDEX `fk_PatientHasTest_Test1_idx` (`IdTest` ASC),
  INDEX `fk_PatientHasTest_Patient1_idx` (`idPatient` ASC),
  PRIMARY KEY (`idRecords`),
  CONSTRAINT `fk_PatientHasTest_Test1`
    FOREIGN KEY (`IdTest`)
    REFERENCES `PRMS`.`Test` (`IdTest`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientHasTest_Patient1`
    FOREIGN KEY (`idPatient`)
    REFERENCES `PRMS`.`Patient` (`idPatient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`TestPayment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`TestPayment` (
  `idTestPayment` INT NOT NULL,
  `Amount` INT(15) NULL,
  `PaymentDate` VARCHAR(45) NULL,
  `Isdelete` VARCHAR(45) NULL,
  `idPayments` INT NOT NULL,
  `IdTest` INT NOT NULL,
  `idRecords` INT NOT NULL,
  PRIMARY KEY (`idTestPayment`),
  INDEX `fk_TestPayment_Payments1_idx` (`idPayments` ASC),
  INDEX `fk_TestPayment_Test1_idx` (`IdTest` ASC),
  INDEX `fk_TestPayment_PatientHasTest1_idx` (`idRecords` ASC),
  CONSTRAINT `fk_TestPayment_Payments1`
    FOREIGN KEY (`idPayments`)
    REFERENCES `PRMS`.`Payments` (`idPayments`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TestPayment_Test1`
    FOREIGN KEY (`IdTest`)
    REFERENCES `PRMS`.`Test` (`IdTest`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TestPayment_PatientHasTest1`
    FOREIGN KEY (`idRecords`)
    REFERENCES `PRMS`.`PatientHasTest` (`idRecords`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`PackageHasPatient`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`PackageHasPatient` (
  `CreateBy` VARCHAR(45) NULL,
  `RequstDate` VARCHAR(45) NULL,
  `PackageCost` DOUBLE NULL,
  `packageDate` VARCHAR(45) NULL,
  `idRecords` INT NOT NULL AUTO_INCREMENT,
  `idPackage` INT NOT NULL,
  `idPatient` INT NOT NULL,
  PRIMARY KEY (`idRecords`),
  INDEX `fk_PackageHasPatient_Package1_idx` (`idPackage` ASC),
  INDEX `fk_PackageHasPatient_Patient1_idx` (`idPatient` ASC),
  CONSTRAINT `fk_PackageHasPatient_Package1`
    FOREIGN KEY (`idPackage`)
    REFERENCES `PRMS`.`Package` (`idPackage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PackageHasPatient_Patient1`
    FOREIGN KEY (`idPatient`)
    REFERENCES `PRMS`.`Patient` (`idPatient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`PackagePayment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`PackagePayment` (
  `idPackagePayment` INT NOT NULL,
  `Amount` INT(15) NULL,
  `PaymentDate` VARCHAR(45) NULL,
  `Isdelete` VARCHAR(45) NULL,
  `idPayments` INT NOT NULL,
  `idRecords` INT NOT NULL,
  PRIMARY KEY (`idPackagePayment`),
  INDEX `fk_PackagePayment_Payments1_idx` (`idPayments` ASC),
  INDEX `fk_PackagePayment_PackageHasPatient1_idx` (`idRecords` ASC),
  CONSTRAINT `fk_PackagePayment_Payments1`
    FOREIGN KEY (`idPayments`)
    REFERENCES `PRMS`.`Payments` (`idPayments`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PackagePayment_PackageHasPatient1`
    FOREIGN KEY (`idRecords`)
    REFERENCES `PRMS`.`PackageHasPatient` (`idRecords`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`User` (
  `idUser` INT NOT NULL AUTO_INCREMENT,
  `NIC` VARCHAR(15) NULL,
  `Name` TEXT NULL,
  `ContactNo` VARCHAR(45) NULL,
  `UserName` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  `Email` VARCHAR(45) NULL,
  `AddBy` VARCHAR(45) NULL,
  `Image` LONGTEXT NULL,
  `Type` VARCHAR(45) NULL,
  `IsDelete` VARCHAR(45) NULL,
  PRIMARY KEY (`idUser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`LoggingHistory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`LoggingHistory` (
  `idLoggingHistory` INT NOT NULL,
  `Date` VARCHAR(45) NULL,
  `Time` VARCHAR(45) NULL,
  `UserName` VARCHAR(45) NULL,
  `Type` VARCHAR(45) NULL,
  `IsStaff` VARCHAR(45) NULL,
  PRIMARY KEY (`idLoggingHistory`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`DocLogging`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`DocLogging` (
  `idDocLogging` INT NOT NULL AUTO_INCREMENT,
  `UserName` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  `IsDelete` VARCHAR(45) NULL,
  `idDoctor` INT NOT NULL,
  PRIMARY KEY (`idDocLogging`),
  INDEX `fk_DocLogging_Doctor1_idx` (`idDoctor` ASC),
  CONSTRAINT `fk_DocLogging_Doctor1`
    FOREIGN KEY (`idDoctor`)
    REFERENCES `PRMS`.`Doctor` (`idDoctor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`PatientTestHasDoctor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`PatientTestHasDoctor` (
  `idRecords` INT NOT NULL AUTO_INCREMENT,
  `IsDelete` VARCHAR(45) NULL,
  `idDoctor` INT NOT NULL,
  `idRecordsFK` INT NOT NULL,
  PRIMARY KEY (`idRecords`),
  INDEX `fk_PatientTestHasDoctor_Doctor1_idx` (`idDoctor` ASC),
  INDEX `fk_PatientTestHasDoctor_PatientHasTest1_idx` (`idRecordsFK` ASC),
  CONSTRAINT `fk_PatientTestHasDoctor_Doctor1`
    FOREIGN KEY (`idDoctor`)
    REFERENCES `PRMS`.`Doctor` (`idDoctor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientTestHasDoctor_PatientHasTest1`
    FOREIGN KEY (`idRecordsFK`)
    REFERENCES `PRMS`.`PatientHasTest` (`idRecords`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`PackageHasTest`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`PackageHasTest` (
  `idRecords` INT NOT NULL AUTO_INCREMENT,
  `IsDelete` VARCHAR(45) NULL,
  `idPackage` INT NOT NULL,
  `IdTest` INT NOT NULL,
  INDEX `fk_PackageHasTest_Package_idx` (`idPackage` ASC),
  INDEX `fk_PackageHasTest_Test1_idx` (`IdTest` ASC),
  PRIMARY KEY (`idRecords`),
  CONSTRAINT `fk_PackageHasTest_Package`
    FOREIGN KEY (`idPackage`)
    REFERENCES `PRMS`.`Package` (`idPackage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PackageHasTest_Test1`
    FOREIGN KEY (`IdTest`)
    REFERENCES `PRMS`.`Test` (`IdTest`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PRMS`.`PatientHasDrug`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `PRMS`.`PatientHasDrug` (
  `RequestDate` VARCHAR(45) NULL,
  `IsDelete` VARCHAR(45) NULL,
  `CreateBy` VARCHAR(45) NULL,
  `Dose` VARCHAR(45) NULL,
  `idDrug` INT NOT NULL,
  `idDoctor` INT NOT NULL,
  `idPatient` INT NOT NULL,
  `idDrugPT` INT NOT NULL AUTO_INCREMENT,
  INDEX `fk_PatientHasDrug_Drug1_idx` (`idDrug` ASC),
  INDEX `fk_PatientHasDrug_Doctor1_idx` (`idDoctor` ASC),
  INDEX `fk_PatientHasDrug_Patient1_idx` (`idPatient` ASC),
  PRIMARY KEY (`idDrugPT`),
  CONSTRAINT `fk_PatientHasDrug_Drug1`
    FOREIGN KEY (`idDrug`)
    REFERENCES `PRMS`.`Drug` (`idDrug`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientHasDrug_Doctor1`
    FOREIGN KEY (`idDoctor`)
    REFERENCES `PRMS`.`Doctor` (`idDoctor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PatientHasDrug_Patient1`
    FOREIGN KEY (`idPatient`)
    REFERENCES `PRMS`.`Patient` (`idPatient`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
