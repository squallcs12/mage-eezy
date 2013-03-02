<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Eezy_QA_Model_Question extends Mage_Core_Model_Abstract{
    public function __construct() {
        parent::__construct();
        $this->_init('qa/question');
    }
}