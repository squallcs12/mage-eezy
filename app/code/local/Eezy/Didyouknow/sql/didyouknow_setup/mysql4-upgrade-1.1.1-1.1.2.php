<?php

/* @var $installer Mage_Customer_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$installer->getTable('didyouknow/quote')} ADD COLUMN `status` TINYINT NULL DEFAULT 1  AFTER `content` ;");

$installer->endSetup();
