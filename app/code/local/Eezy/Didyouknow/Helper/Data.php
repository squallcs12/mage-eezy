<?php

class Eezy_Didyouknow_Helper_Data extends Mage_Core_Helper_Abstract {
	
	const CACHE_ALL_IDS = 'didyounow_ids';
	
	/**
	 * Get random quote from database
	 * @return Eezy_Didyouknow_Model_Quote
	 */
	public function getRandomQuote() {
		$cache = Mage::app() -> getCache();
		$ids = $cache -> load(self::CACHE_ALL_IDS);
		if($ids === false){
			$quoteCollection = Mage::getSingleton('didyouknow/quote') -> getCollection();
			$temp = $quoteCollection->getAllIds();
			$ids = implode(',', $temp);
			$cache->save(serialize($ids), self::CACHE_ALL_IDS);
		} else {
			$ids = explode(',', $ids);
		}
		$key = array_rand($ids);
		$id = $ids[$key];
		return Mage::getModel('didyouknow/quote') -> load($id);
	}

}
