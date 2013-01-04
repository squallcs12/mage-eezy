<?php
class Eezy_Didyouknow_Model_Mysql4_Quote_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('didyouknow/quote');
    }
}