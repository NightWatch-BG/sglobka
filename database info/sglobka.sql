-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sglobka
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sglobka
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sglobka` DEFAULT CHARACTER SET utf8 ;
USE `sglobka` ;

-- -----------------------------------------------------
-- Table `sglobka`.`manufacturer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`manufacturer` (
  `manufacturer_id` INT NOT NULL AUTO_INCREMENT,
  `manufacturer_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`manufacturer_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`role` (
  `role_id` INT NOT NULL AUTO_INCREMENT,
  `role` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`model`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`model` (
  `model_id` INT NOT NULL AUTO_INCREMENT,
  `model_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`model_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`part`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`part` (
  `part_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `part_number` VARCHAR(45) NOT NULL,
  `model_id` INT NULL,
  `manufacturer_id` INT NOT NULL,
  `role_id` INT NOT NULL,
  `overal_rating` INT NULL,
  `more_info` VARCHAR(300) NULL,
  `price` DECIMAL(10,3) NULL,
  PRIMARY KEY (`part_id`),
  INDEX `part_manufacturer_idx` (`manufacturer_id` ASC),
  INDEX `part_part_type_idx` (`role_id` ASC),
  INDEX `part_model_idx` (`model_id` ASC),
  CONSTRAINT `part_manufacturer`
    FOREIGN KEY (`manufacturer_id`)
    REFERENCES `sglobka`.`manufacturer` (`manufacturer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `part_role`
    FOREIGN KEY (`role_id`)
    REFERENCES `sglobka`.`role` (`role_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `part_model`
    FOREIGN KEY (`model_id`)
    REFERENCES `sglobka`.`model` (`model_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`country` (
  `country_id` INT NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`country_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`city`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`city` (
  `city_id` INT NOT NULL AUTO_INCREMENT,
  `city` VARCHAR(45) NOT NULL,
  `country_id` INT NOT NULL,
  PRIMARY KEY (`city_id`),
  INDEX `city_country_idx` (`country_id` ASC),
  CONSTRAINT `city_country`
    FOREIGN KEY (`country_id`)
    REFERENCES `sglobka`.`country` (`country_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`address` (
  `address_id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `address2` VARCHAR(100) NULL DEFAULT 'null',
  `city_id` INT NOT NULL,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`address_id`),
  INDEX `address_city_idx` (`city_id` ASC),
  CONSTRAINT `address_city`
    FOREIGN KEY (`city_id`)
    REFERENCES `sglobka`.`city` (`city_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`user_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`user_type` (
  `user_type_id` INT NOT NULL AUTO_INCREMENT,
  `user_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_type_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `salt` VARCHAR(64) NOT NULL,
  `registration_date` DATETIME NOT NULL,
  `user_type_id` INT NULL,
  `address` INT NOT NULL,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  INDEX `staff_address_idx` (`address` ASC),
  INDEX `staff_user_type_idx` (`user_type_id` ASC),
  CONSTRAINT `user_address`
    FOREIGN KEY (`address`)
    REFERENCES `sglobka`.`address` (`address_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_user_type`
    FOREIGN KEY (`user_type_id`)
    REFERENCES `sglobka`.`user_type` (`user_type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`review` (
  `review_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `part_id` INT NOT NULL,
  `review` VARCHAR(300) NULL,
  `rating` INT NOT NULL,
  PRIMARY KEY (`review_id`),
  INDEX `fk_review_part1_idx` (`part_id` ASC),
  INDEX `review_customer_user_idx` (`user_id` ASC),
  CONSTRAINT `review_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `review_part`
    FOREIGN KEY (`part_id`)
    REFERENCES `sglobka`.`part` (`part_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`parameter_name`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`parameter_name` (
  `parameter_name_id` INT NOT NULL AUTO_INCREMENT,
  `parameter_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`parameter_name_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`parameter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`parameter` (
  `parameter_id` INT NOT NULL AUTO_INCREMENT,
  `parameter_name_id` INT NOT NULL,
  `parameter_value` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`parameter_id`),
  INDEX `paparameter_parameter_name_idx` (`parameter_name_id` ASC),
  CONSTRAINT `paparameter_parameter_name`
    FOREIGN KEY (`parameter_name_id`)
    REFERENCES `sglobka`.`parameter_name` (`parameter_name_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`part_parameter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`part_parameter` (
  `part_parameter_id` INT NOT NULL AUTO_INCREMENT,
  `part_id` INT NOT NULL,
  `parameter_id` INT NOT NULL,
  PRIMARY KEY (`part_parameter_id`),
  INDEX `part_parameter_part_idx` (`part_id` ASC),
  INDEX `part_parameter_parameter_idx` (`parameter_id` ASC),
  CONSTRAINT `part_parameter_part`
    FOREIGN KEY (`part_id`)
    REFERENCES `sglobka`.`part` (`part_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `part_parameter_parameter`
    FOREIGN KEY (`parameter_id`)
    REFERENCES `sglobka`.`parameter` (`parameter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`build_guide`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`build_guide` (
  `build_guide_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `guide` VARCHAR(5000) NULL,
  PRIMARY KEY (`build_guide_id`),
  INDEX `build_customer_user_idx` (`user_id` ASC),
  CONSTRAINT `build_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`build_part`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`build_part` (
  `build_part_id` INT NOT NULL AUTO_INCREMENT,
  `build_guide_id` INT NOT NULL,
  `part_id` INT NOT NULL,
  `quantity` INT NULL DEFAULT 1,
  PRIMARY KEY (`build_part_id`),
  INDEX `build_part_build_idx` (`build_guide_id` ASC),
  INDEX `build_part_part_idx` (`part_id` ASC),
  CONSTRAINT `build_part_build_guide`
    FOREIGN KEY (`build_guide_id`)
    REFERENCES `sglobka`.`build_guide` (`build_guide_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `build_part_part`
    FOREIGN KEY (`part_id`)
    REFERENCES `sglobka`.`part` (`part_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`status` (
  `status_id` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`status_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`order` (
  `order_id` INT NOT NULL AUTO_INCREMENT,
  `customer_id` INT NOT NULL,
  `staff_id` INT NULL,
  `build_id` INT NOT NULL,
  `status_id` INT NOT NULL,
  `notes` VARCHAR(5000) NULL,
  `date_of_order` DATETIME NOT NULL,
  `last_update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  INDEX `order_staff_idx` (`staff_id` ASC),
  INDEX `order_build_idx` (`build_id` ASC),
  INDEX `order_status_idx` (`status_id` ASC),
  INDEX `order_customer_idx` (`customer_id` ASC),
  CONSTRAINT `order_customer_user`
    FOREIGN KEY (`customer_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `order_staff_user`
    FOREIGN KEY (`staff_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `order_build`
    FOREIGN KEY (`build_id`)
    REFERENCES `sglobka`.`build_guide` (`build_guide_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `order_status`
    FOREIGN KEY (`status_id`)
    REFERENCES `sglobka`.`status` (`status_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`announcement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`announcement` (
  `announcement_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `announcement` VARCHAR(5000) NULL,
  `announcement_date` TIMESTAMP NULL,
  PRIMARY KEY (`announcement_id`),
  INDEX `announcement_staff_idx` (`user_id` ASC),
  CONSTRAINT `announcement_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sglobka`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sglobka`.`messages` (
  `messages_id` INT NOT NULL AUTO_INCREMENT,
  `author_id` INT NOT NULL,
  `receiver_id` INT NOT NULL,
  `message` VARCHAR(500) NOT NULL,
  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`messages_id`),
  INDEX `message_author_staff_idx` (`author_id` ASC),
  INDEX `message_receiver_staff_idx` (`receiver_id` ASC),
  CONSTRAINT `message_author_user`
    FOREIGN KEY (`author_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `message_receiver_user`
    FOREIGN KEY (`receiver_id`)
    REFERENCES `sglobka`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
