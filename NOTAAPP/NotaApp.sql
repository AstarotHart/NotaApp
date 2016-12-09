-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Estrada
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Estrada
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Estrada` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `Estrada` ;

-- -----------------------------------------------------
-- Table `Estrada`.`Periodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Periodo` (
  `id_periodo` INT NOT NULL,
  `desc_periodo` VARCHAR(45) NULL,
  PRIMARY KEY (`id_periodo`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Grado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Grado` (
  `id_grado` INT NOT NULL,
  `desc_grado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_grado`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Alumno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Alumno` (
  `id_alumno` INT NOT NULL,
  `id_grado` INT NULL,
  `nombres` VARCHAR(45) NULL,
  `primer_apellido` VARCHAR(45) NULL,
  `segundo_apellido` VARCHAR(45) NULL,
  `desplazado` VARCHAR(45) NULL,
  `repitente` VARCHAR(45) NULL,
  `nombre_acudiente` VARCHAR(45) NULL,
  `primer_apellido_acudiente` VARCHAR(45) NULL,
  `segundo_apellido_acudiente` VARCHAR(45) NULL,
  `telefono_acudiente` DOUBLE NULL,
  PRIMARY KEY (`id_alumno`),
  INDEX `id_grado_idx` (`id_grado` ASC),
  CONSTRAINT `id_grado`
    FOREIGN KEY (`id_grado`)
    REFERENCES `Estrada`.`Grado` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Area` (
  `id_area` INT NOT NULL,
  `nombre_area` VARCHAR(45) NULL,
  PRIMARY KEY (`id_area`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Tipo_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Tipo_usuario` (
  `id_tipo_usuario` INT NOT NULL,
  `des_tipo_usuario` VARCHAR(45) NULL,
  PRIMARY KEY (`id_tipo_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estrada`.`Docente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Docente` (
  `id_docente` INT NOT NULL,
  `id_tipo_usuario` INT NULL,
  `nombres` VARCHAR(45) NULL,
  `prim_apellido` VARCHAR(45) NULL,
  `seg_apellido` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `pass` VARCHAR(45) NULL,
  `foto` VARCHAR(45) NULL,
  `Docentecol` VARCHAR(45) NULL,
  PRIMARY KEY (`id_docente`),
  INDEX `id_tipo_usuario_idx` (`id_tipo_usuario` ASC),
  CONSTRAINT `id_tipo_usuario`
    FOREIGN KEY (`id_tipo_usuario`)
    REFERENCES `Estrada`.`Tipo_usuario` (`id_tipo_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Notas_Definitivas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Notas_Definitivas` (
  `id_area` INT NULL,
  `id_alumno` INT NULL,
  `id_grado` INT NULL,
  `id_periodo` INT NULL,
  `nota_periodo1` INT NULL,
  `nota_periodo2` INT NULL,
  `nota_periodo3` INT NULL,
  `nota_periodo4` INT NULL,
  `cualitativa_anual` VARCHAR(45) NULL,
  INDEX `id_area_idx` (`id_area` ASC),
  INDEX `id_alumno_idx` (`id_alumno` ASC),
  INDEX `id_grado_idx` (`id_grado` ASC),
  INDEX `id_periodo_idx` (`id_periodo` ASC),
  CONSTRAINT `id_area`
    FOREIGN KEY (`id_area`)
    REFERENCES `Estrada`.`Area` (`id_area`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_alumno`
    FOREIGN KEY (`id_alumno`)
    REFERENCES `Estrada`.`Alumno` (`id_alumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_grado`
    FOREIGN KEY (`id_grado`)
    REFERENCES `Estrada`.`Grado` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_periodo`
    FOREIGN KEY (`id_periodo`)
    REFERENCES `Estrada`.`Periodo` (`id_periodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Asignatura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Asignatura` (
  `id_asignatura` INT NOT NULL,
  `id_doncente` INT NULL,
  `id_area` INT NULL,
  PRIMARY KEY (`id_asignatura`),
  INDEX `id_docente_idx` (`id_doncente` ASC),
  INDEX `id_area_idx` (`id_area` ASC),
  CONSTRAINT `id_docente`
    FOREIGN KEY (`id_doncente`)
    REFERENCES `Estrada`.`Docente` (`id_docente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_area`
    FOREIGN KEY (`id_area`)
    REFERENCES `Estrada`.`Area` (`id_area`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `Estrada`.`Logros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Logros` (
  `id_periodo` INT NULL,
  `id_grado` INT NULL,
  `id_asignatura` INT NULL,
  `descripcion` VARCHAR(255) NULL,
  INDEX `id_periodo_idx` (`id_periodo` ASC),
  INDEX `id_grado_idx` (`id_grado` ASC),
  INDEX `id_asignatura_idx` (`id_asignatura` ASC),
  CONSTRAINT `id_periodo`
    FOREIGN KEY (`id_periodo`)
    REFERENCES `Estrada`.`Periodo` (`id_periodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_grado`
    FOREIGN KEY (`id_grado`)
    REFERENCES `Estrada`.`Grado` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_asignatura`
    FOREIGN KEY (`id_asignatura`)
    REFERENCES `Estrada`.`Asignatura` (`id_asignatura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Estrada`.`Nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Estrada`.`Nota` (
  `id_alumno` INT NULL,
  `id_periodo` INT NULL,
  `id_grado` INT NULL,
  `id_asignatura` INT NULL,
  `nota_1` INT NULL,
  `nota_2` INT NULL,
  `nota_3` INT NULL,
  `nota_4` INT NULL,
  `nota_5` INT NULL,
  `nota_6` INT NULL,
  `nota_7` INT NULL,
  `nota_8` INT NULL,
  `nota_definitiva` INT NULL,
  `nota_cualitativa` VARCHAR(45) NULL,
  INDEX `id_alumno_idx` (`id_alumno` ASC),
  INDEX `id_periodo_idx` (`id_periodo` ASC),
  INDEX `id_grado_idx` (`id_grado` ASC),
  INDEX `id_asignatura_idx` (`id_asignatura` ASC),
  CONSTRAINT `id_alumno`
    FOREIGN KEY (`id_alumno`)
    REFERENCES `Estrada`.`Alumno` (`id_alumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_periodo`
    FOREIGN KEY (`id_periodo`)
    REFERENCES `Estrada`.`Periodo` (`id_periodo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_grado`
    FOREIGN KEY (`id_grado`)
    REFERENCES `Estrada`.`Grado` (`id_grado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_asignatura`
    FOREIGN KEY (`id_asignatura`)
    REFERENCES `Estrada`.`Asignatura` (`id_asignatura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
