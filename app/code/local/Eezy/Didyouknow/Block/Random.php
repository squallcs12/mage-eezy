<?php

class Eezy_Didyouknow_Block_Random extends Mage_Core_Block_Template {

	/**
	 * @var Eezy_Didyouknow_Model_Quote
	 */

	protected $_quote = NULL;

	public function _construct() {
		parent::_construct();
	}

	protected function _prepareLayout() {
		$this -> _quote = Mage::helper('didyouknow') -> getRandomQuote();

		return parent::_prepareLayout();
	}

}
