<?php

class Eezy_Note_Model_Mysql4_Article extends Mage_Core_Model_Mysql4_Abstract{
	public function _construct()
    {   
        $this->_init('note/article', 'id');
    }
}
