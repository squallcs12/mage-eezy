<?php

/* @var $installer Mage_Customer_Model_Resource_Setup */
$installer = $this;

$table = $installer->getConnection()
->newTable($installer->getTable('download/file'))
->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity'  => true,
		'unsigned'  => true,
		'nullable'  => false,
		'primary'   => true,
), 'Id')
->addColumn('file', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'default'   => '',
), 'Filename including path')
->addColumn('download_time', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned'  => true,
		'nullable'  => false,
		'default'   => '0',
), 'Download counter');
$installer->getConnection()->createTable($table);