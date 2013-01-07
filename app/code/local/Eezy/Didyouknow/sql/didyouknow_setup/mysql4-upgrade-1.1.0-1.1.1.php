<?php

/* @var $installer Mage_Customer_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
UPDATE {$installer->getTable('didyouknow/quote')} SET `content`='The \"countdown\" was first used in a 1929 German silent film called \"Die Frau I\'m Monde\" (The Girl in the Moon).' WHERE `id`='3';

DELETE FROM {$installer->getTable('didyouknow/quote')} WHERE `id` IN (16, 18);

");

$installer->endSetup();
