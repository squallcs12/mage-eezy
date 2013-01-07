<?php

/* @var $installer Mage_Customer_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Create table 'customer/entity'
 */
$table = $installer->getConnection()
		->newTable($installer->getTable('didyouknow/quote'))
		->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
				'identity'  => true,
				'unsigned'  => true,
				'nullable'  => false,
				'primary'   => true,
		), 'Id')
		->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
				'unsigned'  => true,
				'nullable'  => false,
				'default'   => '',
		), 'Quote Sentence');
$installer->getConnection()->createTable($table);


$installer->run("INSERT INTO {$installer->getTable('didyouknow/quote')} (`content`) VALUES
('The first animal sent up to outer space was a dog.'),
('The coldest outdoor temperature ever recorded on earth was 127 below zero in Antarctica on August 24, 1960.'),
('The \"countdown\" (counting down from 10 for an event such as New-Years Day) was first used in a 1929 German silent film called \"Die Frau I’m Monde\" (The Girl in the Moon).'),
('Every time the moon''s gravity causes a ten-foot tide at sea, all the continents on earth rise at least six inches.'),
('Police dogs were first used in 1816 in Scotland.'),
('It was the Romans who made the first popsicle. They took some ice and added flavors to it and then licked it.'),
('The first steam powered train was invented by Robert Stephenson. It was called the Rocket.'),
('The first car with four wheels was made in France in 1901 by Panhard et LeVassor.'),
('There are two species of camel: one-humped camels and two-humped camels'),
('A single common guava fruit contains about four times the amount of vitamin'),
('Seals may dive up to 1,000 feet to the ocean bottom to find food'),
('Brown onions have a stronger flavour than white onions'),
('Although Italy is very famous for pizza, it is Greece in origin!'),
('Trumpets are among the oldest musical instruments, dating back to at least 1500 BC.'),
('Do you know that a rabbit''s teeth never stop growing?'),
('The word broccoli comes from the Latin word brachium and the Italian word braccio, which means “arm”.'),
('Another name for the avocado is the \"alligator pear,\" so-called because of its alligator skin texture and pear shape.'),
('Although octopuses have wonderful eyesight and a complex sense of touch and taste, they are deaf.'),
('Koala spends most of their day (almost 20 hours each day) resting or sleeping.'),
('Platypus swims with their eyes, ears and nose shut.');");


$installer->endSetup();