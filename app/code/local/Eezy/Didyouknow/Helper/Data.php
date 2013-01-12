<?php

class Eezy_Didyouknow_Helper_Data extends Mage_Core_Helper_Abstract {
	
	const CACHE_ALL_IDS = 'didyounow_ids';
	
	public function clearCacheQuoteIds(){
		$cache = Mage::app() -> getCache();
		$cache->remove(self::CACHE_ALL_IDS);
	}
	
	/**
	 * Get all Ids cached
	 * @return array
	 */
	public function getQuoteIds(){
		$cache = Mage::app() -> getCache();
		$ids = $cache -> load(self::CACHE_ALL_IDS);
		if($ids === false){
			/* @var $quoteCollection Eezy_Didyouknow_Model_Mysql4_Quote_Collection */
			$quoteCollection = Mage::getSingleton('didyouknow/quote') -> getCollection();
			
			$quoteCollection->getSelect()->where('status = 1');
			
			$ids = $quoteCollection->getAllIds();
			$cache->save(implode(',', $ids), self::CACHE_ALL_IDS);
		} else {
			$ids = explode(',', $ids);
		}
		return $ids;
	}
	
	/**
	 * Get random quote from database
	 * @return Eezy_Didyouknow_Model_Quote
	 */
	public function getRandomQuote() {
		$ids = $this->getQuoteIds();
		$key = array_rand($ids);
		$id = $ids[$key];
		return Mage::getModel('didyouknow/quote') -> load($id);
	}

	public function getRandomQuotes($count){
		$temp = $this->getQuoteIds();
		if(count($temp) > $count){
			$keys = array_rand($temp, $count);
			$ids = array();
			foreach($keys as $key)
				$ids[] = $key;
		} else {
			$ids = $temp;
		}
		
		/* @var @quotes Eezy_Didyouknow_Model_Mysql4_Quote_Collection */
		$quotes = Mage::getSingleton('didyouknow/quote')
						->getCollection()
						->addFieldToFilter('id', array('in' => $ids))
						;
		return $quotes;
	}
	
	/**
	 * Get json quote setences
	 * @param unknown_type $count
	 */
	public function getJsonQuotes($count = 20){
		/* @var @quotes Eezy_Didyouknow_Model_Mysql4_Quote_Collection */
		$quotes = Mage::helper ( 'didyouknow' )->getRandomQuotes ($count);
		$quoteTexts = array();
		foreach($quotes as $quote)
			$quoteTexts[] = $quote->getContent();
	
		return Mage::helper('core')->jsonEncode($quoteTexts);
	}
}
