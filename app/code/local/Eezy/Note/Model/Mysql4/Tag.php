<?php

class Eezy_Note_Model_Mysql4_Tag extends Mage_Core_Model_Mysql4_Abstract{
	public function _construct()
    {   
        $this->_init('note/tag', 'id');
    }
}
