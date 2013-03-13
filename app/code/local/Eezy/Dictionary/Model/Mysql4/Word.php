<?php

class Eezy_Dictionary_Model_Mysql4_Word extends Mage_Core_Model_Mysql4_Abstract{
	public function _construct()
    {   
        $this->_init('dictionary/word', 'word_id');
    }
}
