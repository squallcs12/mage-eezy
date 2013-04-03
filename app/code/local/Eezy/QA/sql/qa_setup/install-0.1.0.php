<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$installer = $this;
/* @var $installer Eezy_QA_Model_Resource_Setup */

$installer->startSetup();

$table = $installer->getConnection()->newTable($installer->getTable('qa/question'));


$table
	->addColumn('question_id', Varien_Db_Ddl_Table::TYPE_BIGINT, null, array(
			'primary' => true,
			'identity' => true,
			'nullable' => false,
			'unsigned' => true,	
	), 'ID')
	->addColumn('subject', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(), 'Question subject')
	->addColumn('url_key', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(), 'Question short url key')
	->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(), 'Question full content')
	->addColumn('sub_content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(), 'Question short content version for listing')
	->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_BIGINT, null, array(), 'Asker customer ID')
	->addIndex('EEZY_QA_INDEX_QUESTION_KEY_URL', array('url_key'), array('INDEX'));
	;

$installer->getConnection()->createTable($table);

$installer->endSetup();