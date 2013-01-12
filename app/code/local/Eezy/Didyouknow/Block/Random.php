<?php
class Eezy_Didyouknow_Block_Random extends Mage_Core_Block_Template {
	protected function _prepareLayout() {
		$this->setQuote ( Mage::helper ( 'didyouknow' )->getRandomQuote () );


		$this->setTemplate($this->getTemplate());
		
		return parent::_prepareLayout ();
	}
	
	public function getJsonQuotes($count = 20){
		return Mage::helper('didyouknow')->getJsonQuotes($count);
	}
}
