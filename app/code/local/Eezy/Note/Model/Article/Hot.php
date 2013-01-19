<?php
class Eezy_Note_Model_Article_Hot extends Mage_Core_Model_Abstract {
	public function _construct() {
		$this->_init ( 'note/article_hot', 'id' );
	}
    /**
     * Reset all model data
     *
     * @return Eezy_Note_Model_Article_Hot
     */
    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
}