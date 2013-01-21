<?php
class Eezy_Note_Helper_Article extends Mage_Core_Helper_Abstract {
	protected $_hotArticleIds;
	protected $_lastestCollection;
	
	/**
	 * 
	 * @return Eezy_Note_Model_Mysql4_Article_Collection
	 */
	public function getHotArticles() {
		/* @var $collection Eezy_Note_Model_Mysql4_Article_Collection */
		$collection = Mage::getModel ( 'note/article' )->getCollection ();
		$ids = $this->getHotArticleIds ();
		if (empty ( $ids ))
			$ids = array (
					0 
			);
		$collection->addFieldToFilter ( 'id', array (
				'in' => $ids 
		) );
		return $collection;
	}
	
	/**
	 * Get hot article IDs
	 * 
	 * @return array
	 */
	public function getHotArticleIds() {
		if (! is_array ( $this->_hotArticleIds )) {
			/* @var @$tagCloud Eezy_Note_Model_Tag_Cloud */
			$hotArticle = Mage::getModel ( 'note/article_hot' );
			$this->_hotArticleIds = $hotArticle->getCollection ()->getAllIds ();
		}
		return $this->_hotArticleIds;
	}
	/**
	 * 
	 * @return Eezy_Note_Model_Mysql4_Article_Collection
	 */
	public function getLastest() {
		if (! $this->_lastestCollection) {
			$this->_lastestCollection = Mage::getModel ( 'note/article' )->getCollection ();
		}
		return $this->_lastestCollection;
	}
}
