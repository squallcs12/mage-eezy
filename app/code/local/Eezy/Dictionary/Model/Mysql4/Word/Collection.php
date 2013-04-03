<?php
class Eezy_Dictionary_Model_Mysql4_Word_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('dictionary/word');
    }
}