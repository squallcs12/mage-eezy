<?php

class Eezy_Didyouknow_Model_Mysql4_Quote extends Mage_Core_Model_Mysql4_Abstract{
		
	public function _construct()
    {   
        $this->_init('didyouknow/quote', 'id');
    }
}
