<?php

$this -> startSetup();

$this -> run("

CREATE  TABLE IF NOT EXISTS `game_describe_image` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `path` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) );
");
$this -> run("
CREATE  TABLE IF NOT EXISTS `game_describe_image_word` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `image_id` INT UNSIGNED NULL ,
  `word` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) );
");
$this -> run("
CREATE  TABLE IF NOT EXISTS `game_describe_image_word_hint` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `class` VARCHAR(45) NULL ,
  `word_id` INT UNSIGNED NULL ,
  `content` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) );
");
$this -> run("
ALTER TABLE `game_describe_image_word` 
  ADD CONSTRAINT `DESCRIBE_IMAGE_ID`
  FOREIGN KEY (`image_id` )
  REFERENCES `game_describe_image` (`id` )
  ON DELETE RESTRICT
  ON UPDATE RESTRICT
, ADD INDEX `DESCRIBE_IMAGE_ID_idx` (`image_id` ASC) ;
");
$this -> run("
ALTER TABLE `game_describe_image_word_hint` 
  ADD CONSTRAINT `DESCRIBE_IMAGE_WORD_ID`
  FOREIGN KEY (`word_id` )
  REFERENCES `game_describe_image_word` (`id` )
  ON DELETE RESTRICT
  ON UPDATE RESTRICT
, ADD INDEX `DESCRIBE_IMAGE_WORD_ID_idx` (`word_id` ASC) ;
");
$this -> run("
CREATE  TABLE IF NOT EXISTS `game_describe_play` (
  `id` INT UNSIGNED NOT NULL ,
  `customer_id` INT UNSIGNED NULL ,
  `start_time` INT NULL ,
  `end_time` INT NULL ,
  PRIMARY KEY (`id`) );
");
$this -> run("
ALTER TABLE `game_describe_play` ADD COLUMN `class` VARCHAR(45) NULL  AFTER `end_time` ;
");
$this -> run("
CREATE  TABLE IF NOT EXISTS `game_describe_play_image` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `image_id` INT NULL ,
  `start_time` INT NULL ,
  `end_time` INT NULL ,
  `word_submit` INT NULL ,
  `word_correct` INT NULL ,
  PRIMARY KEY (`id`) );
");
$this -> run("
CREATE  TABLE IF NOT EXISTS `game_describe_play_image_word` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `image_id` INT NULL ,
  `word` VARCHAR(45) NULL ,
  `correct` TINYINT NULL ,
  `time` INT NULL ,
  PRIMARY KEY (`id`) );
");
$this -> run("
ALTER TABLE `game_describe_play_image` ADD COLUMN `play_id` INT NULL  AFTER `id` ;

ALTER TABLE `game_describe_play_image` CHANGE COLUMN `play_id` `play_id` INT(10) UNSIGNED NULL DEFAULT NULL  ;
");
$this -> run("
ALTER TABLE `game_describe_play_image` 
  ADD CONSTRAINT `DESCRIBE_PLAY_ID`
  FOREIGN KEY (`play_id` )
  REFERENCES `game_describe_play` (`id` )
  ON DELETE RESTRICT
  ON UPDATE RESTRICT
, ADD INDEX `DESCRIBE_PLAY_ID_idx` (`play_id` ASC) ;

");
$this -> run("
ALTER TABLE `game_describe_play_image_word` CHANGE COLUMN `image_id` `play_image_id` INT(10) UNSIGNED NULL DEFAULT NULL  , 
  ADD CONSTRAINT `DESCRIBE_PLAY_IMAGE_ID`
  FOREIGN KEY (`play_image_id` )
  REFERENCES `mage_eezy`.`game_describe_play_image` (`id` )
  ON DELETE RESTRICT
  ON UPDATE RESTRICT
, ADD INDEX `DESCRIBE_PLAY_IMAGE_ID_idx` (`play_image_id` ASC) ;

");

$this -> endSetup();
