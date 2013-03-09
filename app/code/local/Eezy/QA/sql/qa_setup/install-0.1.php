<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$installer = $this;
/* @var $installer Eezy_QA_Model_Resource_Setup */

$installer->startSetup();
$installer->addEntityType('qa_question', array(
    //entity_mode is the URI you'd pass into a Mage::getModel() call
    'entity_model'    => 'qa/question',

    //table refers to the resource URI complexworld/eavblogpost
    //<complexworld_resource>...<eavblogpost><table>eavblog_posts</table>
    'table'           =>'qa/question',
));

$installer->createEntityTables(
    $this->getTable('qa/question')
);

$this->addAttribute('qa_question', 'subject', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'varchar',
    'label'             => 'Subject',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'url_key', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'varchar',
    'label'             => 'URL',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => true,
));

$this->addAttribute('qa_question', 'content', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'text',
    'label'             => 'Content',
    'input'             => 'textarea',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'sub_content', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'text',
    'label'             => 'Sub Content',
    'input'             => 'textarea',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'asked_date', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'datetime',
    'label'             => 'Asked Date',
    'input'             => 'datetime',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));


$this->addAttribute('qa_question', 'customer_id', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Customer ID',
    'input'             => 'datetime',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => true,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'view_count', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Views',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'vote_count', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Votes',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));


$this->addAttribute('qa_question', 'answer_count', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Answers',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'favorite_count', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Favorites',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));


$this->addAttribute('qa_question', 'comment_count', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Comments',
    'input'             => 'text',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => '',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));



$this->addAttribute('qa_question', 'is_bounty', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Is Bounty',
    'input'             => 'select',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => 'eav/entity_attribute_source_boolean',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'is_closed', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Is Closed',
    'input'             => 'select',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => 'eav/entity_attribute_source_boolean',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'is_deleted', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Is Deleted',
    'input'             => 'select',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => 'eav/entity_attribute_source_boolean',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));

$this->addAttribute('qa_question', 'has_right_answer', array(
    //the EAV attribute type, NOT a MySQL varchar
    'type'              => 'int',
    'label'             => 'Is Deleted',
    'input'             => 'select',
    'class'             => '',
    'backend'           => '',
    'frontend'          => '',
    'source'            => 'eav/entity_attribute_source_boolean',
    'required'          => false,
    'user_defined'      => true,
    'default'           => '',
    'unique'            => false,
));


$installer->endSetup();