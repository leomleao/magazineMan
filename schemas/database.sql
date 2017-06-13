SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `magazineMan` ;
CREATE SCHEMA IF NOT EXISTS `magazineMan` DEFAULT CHARACTER SET utf8 ;
USE `magazineMan` ;


-- -----------------------------------------------------
-- Table `magazineMan`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magazineMan`.`users` ;

CREATE  TABLE IF NOT EXISTS `magazineMan`.`users` (
  `userID` INT NOT NULL AUTO_INCREMENT ,
  `userUser` VARCHAR(45) NOT NULL ,  
  `userName` VARCHAR(45) NOT NULL ,
  `userPassword` CHAR(128) NULL ,
  `userEmail` VARCHAR(45) NULL ,
  `userCreationDate` TIMESTAMP NULL DEFAULT NOW() ,
  `userLastMod` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP ,
  `userStatus` INT(1) NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`userID`))   
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `magazineMan`.`password_recoveries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magazineMan`.`password_recoveries` ;

CREATE  TABLE IF NOT EXISTS `magazineMan`.`password_recoveries` (
  `passwordID` INT NOT NULL AUTO_INCREMENT ,
  `userID` INT NOT NULL ,
  `token` VARCHAR(255) NOT NULL ,
  `status` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`passwordID`) ,
  INDEX `userID_idx` (`userID` ASC) ,
  CONSTRAINT `userID`
    FOREIGN KEY (`userID` )
    REFERENCES `magazineMan`.`users` (`userID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magazineMan`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magazineMan`.`login_attempts` ;

CREATE  TABLE IF NOT EXISTS `magazineMan`.`login_attempts` (
  `loginAttemptID` INT NOT NULL AUTO_INCREMENT ,
  `loginAttemptUserID` INT NOT NULL ,
  `tried_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`loginAttemptID`, `loginAttemptUserID`) ,
  INDEX `loginAttemptUserID_idx` (`loginAttemptUserID` ASC) ,
  CONSTRAINT `loginAttemptUserID`
    FOREIGN KEY (`loginAttemptUserID` )
    REFERENCES `magazineMan`.`users` (`userID` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magazineMan`.`brothers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magazineMan`.`brothers` ;

CREATE TABLE `magazineMan`.`brothers` (
 `brotherID` INT NOT NULL AUTO_INCREMENT , 
 `brotherName` VARCHAR(45) NOT NULL , 
 `brotherTakesMagazine` INT(1) NOT NULL DEFAULT '1' , 
 `brotherCreationDate` TIMESTAMP NULL DEFAULT NOW() ,
 `brotherLastMod` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP ,
 `brotherStatus` INT(1) NOT NULL DEFAULT 1 ,

  PRIMARY KEY (`brotherID`)) 
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `magazineMan`.`allocations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `magazineMan`.`allocations` ;

CREATE TABLE `magazineMan`.`allocations` (
 `allocationID` INT NOT NULL AUTO_INCREMENT ,
 `allocationBrotherID` INT NOT NULL ,  
 `allocationMagazineDate` DATE NOT NULL ,
 `allocationInsertionDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
 `allocationLastMod` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP ,
 PRIMARY KEY (`allocationID`) ,
 ADD UNIQUE( `allocationBrotherID`, `allocationMagazineDate`),
 INDEX `allocationUserID_idx` (`allocationBrotherID` ASC) , 
 CONSTRAINT `allocationBrotherID`
  FOREIGN KEY (`allocationBrotherID` )
  REFERENCES `magazineMan`.`brothers` (`brotherID` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


