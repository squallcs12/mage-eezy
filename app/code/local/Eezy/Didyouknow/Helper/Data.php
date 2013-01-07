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

}
