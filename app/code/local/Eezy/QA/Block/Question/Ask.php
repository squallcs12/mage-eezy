<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Eezy_QA_Block_Question_Ask extends Mage_Core_Block_Template {

    public function __construct() {
        $this->addData(array(
            'cache_lifetime' => 9999999,
            'cache_tags' => array('UNDEAD', 'EEZY_QA_QUESTION', 'EEZY_QA'),
            'cache_key' => 'EEZY_QA_QUESTION_ASK',
        ));
        parent::__construct();
    }

    public function _prepareLayout() {
        parent::_prepareLayout();
    }

}