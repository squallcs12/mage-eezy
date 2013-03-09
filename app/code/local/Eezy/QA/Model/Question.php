<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Eezy_QA_Model_Question extends Mage_Catalog_Model_Abstract{
    
    protected $_eventObject = 'eezy_qa_question';
    protected $_eventPrefix = 'eezy_qa_question';
    
    public function __construct() {
        parent::__construct();
        $this->_init('qa/question');
    }
    
}