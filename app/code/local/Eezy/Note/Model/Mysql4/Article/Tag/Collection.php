<?php
class Eezy_Note_Model_Mysql4_Article_Tag_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('note/article_tag');
    }
    /**
     * Get Tag Ids of collection
     * @return array
     */
    public function getTagIds(){
        $idsSelect = clone $this->getSelect();
        $idsSelect->reset(Zend_Db_Select::ORDER);
        $idsSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $idsSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        $idsSelect->reset(Zend_Db_Select::COLUMNS);

        $idsSelect->columns('tag_id', 'main_table');
        return $this->getConnection()->fetchCol($idsSelect);
    }
}