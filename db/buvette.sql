-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema buvette
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema buvette
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `buvette` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `buvette` ;

-- -----------------------------------------------------
-- Table `buvette`.`staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`staff` (
  `stf_id` INT NOT NULL AUTO_INCREMENT,
  `stf_name` VARCHAR(45) NULL,
  PRIMARY KEY (`stf_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`order` (
  `ord_id` INT NOT NULL,
  `ord_status` VARCHAR(45) NULL,
  `ord_stf_id` INT NOT NULL,
  `ord_number` INT NOT NULL,
  `ord_datetime_send` DATETIME NOT NULL,
  `ord_datetime_prepare` DATETIME NULL,
  `ord_datetime_delivery` DATETIME NULL,
  PRIMARY KEY (`ord_id`, `ord_stf_id`),
  INDEX `fk_order_staff_idx` (`ord_stf_id` ASC),
  CONSTRAINT `fk_order_staff`
    FOREIGN KEY (`ord_stf_id`)
    REFERENCES `buvette`.`staff` (`stf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`categories_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`categories_products` (
  `cat_id` INT NOT NULL AUTO_INCREMENT,
  `cat_title` VARCHAR(45) NULL,
  PRIMARY KEY (`cat_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`products` (
  `pro_id` INT NOT NULL AUTO_INCREMENT,
  `pro_title` VARCHAR(45) NULL,
  `pro_price` FLOAT NULL,
  `pro_cat_id` INT NOT NULL,
  PRIMARY KEY (`pro_id`, `pro_cat_id`),
  INDEX `fk_products_categories_products1_idx` (`pro_cat_id` ASC),
  CONSTRAINT `fk_products_categories_products1`
    FOREIGN KEY (`pro_cat_id`)
    REFERENCES `buvette`.`categories_products` (`cat_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`combo_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`combo_products` (
  `cmb_id` INT NOT NULL AUTO_INCREMENT,
  `cmb_title` VARCHAR(45) NOT NULL,
  `cmb_price` FLOAT NOT NULL,
  PRIMARY KEY (`cmb_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`products_has_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`products_has_order` (
  `pro_id` INT NULL,
  `ord_id` INT NOT NULL,
  `ord_pro_quantity` FLOAT NOT NULL DEFAULT 1,
  `cmb_id` INT NULL,
  INDEX `fk_products_has_order_order1_idx` (`ord_id` ASC),
  INDEX `fk_products_has_order_products1_idx` (`pro_id` ASC),
  INDEX `fk_products_has_order_combo_products1_idx` (`cmb_id` ASC),
  PRIMARY KEY (`ord_id`),
  CONSTRAINT `fk_products_has_order_products1`
    FOREIGN KEY (`pro_id`)
    REFERENCES `buvette`.`products` (`pro_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_order_order1`
    FOREIGN KEY (`ord_id`)
    REFERENCES `buvette`.`order` (`ord_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_order_combo_products1`
    FOREIGN KEY (`cmb_id`)
    REFERENCES `buvette`.`combo_products` (`cmb_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`unities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`unities` (
  `uni_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`uni_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`categories_prima_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`categories_prima_products` (
  `cpp_id` INT NOT NULL,
  `ccp_title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cpp_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`prima_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`prima_products` (
  `prm_id` INT NOT NULL AUTO_INCREMENT,
  `prm_title` VARCHAR(45) NOT NULL,
  `prm_uni_id` INT NOT NULL,
  `prm_category` INT NOT NULL,
  PRIMARY KEY (`prm_id`, `prm_category`, `prm_uni_id`),
  INDEX `fk_prima_products_unities1_idx` (`prm_uni_id` ASC),
  INDEX `fk_prima_products_categories_prima_products1_idx` (`prm_category` ASC),
  CONSTRAINT `fk_prima_products_unities1`
    FOREIGN KEY (`prm_uni_id`)
    REFERENCES `buvette`.`unities` (`uni_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prima_products_categories_prima_products1`
    FOREIGN KEY (`prm_category`)
    REFERENCES `buvette`.`categories_prima_products` (`cpp_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`recette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`recette` (
  `prima_products_prm_id` INT NOT NULL,
  `products_pro_id` INT NOT NULL,
  `re_prm_quantity` FLOAT NULL,
  INDEX `fk_prima_products_has_products_products1_idx` (`products_pro_id` ASC),
  INDEX `fk_prima_products_has_products_prima_products1_idx` (`prima_products_prm_id` ASC),
  PRIMARY KEY (`products_pro_id`, `prima_products_prm_id`),
  CONSTRAINT `fk_prima_products_has_products_prima_products1`
    FOREIGN KEY (`prima_products_prm_id`)
    REFERENCES `buvette`.`prima_products` (`prm_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prima_products_has_products_products1`
    FOREIGN KEY (`products_pro_id`)
    REFERENCES `buvette`.`products` (`pro_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`event` (
  `evn_id` INT NOT NULL AUTO_INCREMENT,
  `evn_start` DATETIME NOT NULL,
  `evn_end` DATETIME NOT NULL,
  `evn_title` VARCHAR(45) NOT NULL,
  `evn_stf_id_creat` INT NOT NULL,
  `evn_created` DATETIME NOT NULL,
  `evn_deleted` INT NOT NULL DEFAULT 0,
  `evn_date_deleted` DATETIME NULL,
  `evn_date_modified` DATETIME NULL,
  `evn_stf_id_delet` INT NULL,
  `evn_stf_id_modif` INT NULL,
  PRIMARY KEY (`evn_id`),
  INDEX `fk_event_staff1_idx` (`evn_stf_id_creat` ASC),
  CONSTRAINT `fk_event_staff1`
    FOREIGN KEY (`evn_stf_id_creat`)
    REFERENCES `buvette`.`staff` (`stf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`option_recette`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`option_recette` (
  `ore_prm_id` INT NOT NULL,
  `ore_pro_id` INT NOT NULL,
  `ore_pro_quantity` FLOAT NULL,
  INDEX `fk_prima_products_has_products_products2_idx` (`ore_pro_id` ASC),
  INDEX `fk_prima_products_has_products_prima_products2_idx` (`ore_prm_id` ASC),
  CONSTRAINT `fk_prima_products_has_products_prima_products2`
    FOREIGN KEY (`ore_prm_id`)
    REFERENCES `buvette`.`prima_products` (`prm_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prima_products_has_products_products2`
    FOREIGN KEY (`ore_pro_id`)
    REFERENCES `buvette`.`products` (`pro_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`stock` (
  `stk_id` INT NOT NULL AUTO_INCREMENT,
  `stk_prm_id` INT NOT NULL,
  `stk_quantity` FLOAT NOT NULL DEFAULT 1,
  `stk_movement` INT NOT NULL,
  `stk_datetime` DATETIME NOT NULL,
  `stk_staff_id` INT NOT NULL,
  `stk_price` FLOAT NOT NULL,
  `stk_event_id` INT NOT NULL,
  PRIMARY KEY (`stk_id`, `stk_prm_id`, `stk_staff_id`),
  INDEX `fk_stock_prima_products1_idx` (`stk_prm_id` ASC),
  INDEX `fk_stock_staff1_idx` (`stk_staff_id` ASC),
  INDEX `fk_stock_event1_idx` (`stk_event_id` ASC),
  CONSTRAINT `fk_stock_prima_products1`
    FOREIGN KEY (`stk_prm_id`)
    REFERENCES `buvette`.`prima_products` (`prm_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_staff1`
    FOREIGN KEY (`stk_staff_id`)
    REFERENCES `buvette`.`staff` (`stf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_event1`
    FOREIGN KEY (`stk_event_id`)
    REFERENCES `buvette`.`event` (`evn_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `buvette`.`products_has_combo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `buvette`.`products_has_combo` (
  `products_pro_id` INT NOT NULL,
  `combo_products_cmb_id` INT NOT NULL,
  INDEX `fk_products_has_combo_products_combo_products1_idx` (`combo_products_cmb_id` ASC),
  INDEX `fk_products_has_combo_products_products1_idx` (`products_pro_id` ASC),
  PRIMARY KEY (`products_pro_id`, `combo_products_cmb_id`),
  CONSTRAINT `fk_products_has_combo_products_products1`
    FOREIGN KEY (`products_pro_id`)
    REFERENCES `buvette`.`products` (`pro_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_combo_products_combo_products1`
    FOREIGN KEY (`combo_products_cmb_id`)
    REFERENCES `buvette`.`combo_products` (`cmb_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
