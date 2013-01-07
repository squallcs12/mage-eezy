<?php

class Eezy_Didyouknow_Model_Quote extends Mage_Core_Model_Abstract{
	
	public function _construct(){
		$this->_init('didyouknow/quote', 'id');
	}

    /**
     * Reset all model data
     *
     * @return Eezy_Didyouknow_Model_Quote
     */
    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
	
}
