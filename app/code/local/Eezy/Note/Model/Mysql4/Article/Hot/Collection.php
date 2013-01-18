<?php
class Eezy_Note_Model_Mysql4_Article_Hot_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('note/article_hot');
    }
}