<?php

class Eezy_Note_Block_Article_Random extends Mage_Core_Block_Template {
	public function getArticles(){
		if(!$this->hasData('articles')){
			$collection = Mage::getModel('note/article')->getCollection();
			/* @var $collection Eezy_Note_Model_Mysql4_Article_Collection */
			$collection->addOrder(new Zend_Db_Expr("RAND()"));
			$collection->setPageSize($this->getCount() > 0 ? $this->getCount() : 2);
			$this->setData('articles', $collection);
		}
		return $this->getData('articles');
	}
}