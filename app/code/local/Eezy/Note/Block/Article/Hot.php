<?php

class Eezy_Note_Block_Article_Hot extends Mage_Core_Block_Template{
	
	public function _prepareLayout(){
		
		$hotArticles = Mage::helper('note/article')->getHotArticles();
		$this->setHotArticles($hotArticles);
		return parent::_prepareLayout ();
	}
}