<?php

/**
 * 
 */
class Eezy_Note_Block_Article_Grid extends Mage_Core_Block_Template{
	
	public function _prepareLayout(){
		return parent::_prepareLayout ();
	}
	
	/**
	 * Set articles collection to block
	 * 
	 * @param string $helper
	 * @param string $method
	 * @param array $params
	 * @return Eezy_Note_Block_Article_Hot
	 */
	public function setCollection($helper = 'note/article', $method = 'getLastest', $params = array()){
		if(is_string($helper)){
			$collection = call_user_func_array(array(Mage::helper($helper), $method), $params);
		} else if ($helper instanceof Mage_Core_Model_Mysql4_Collection_Abstract){
			$collection = $helper;
		} else {
			throw new Mage_Exception('Wrong collection set for Article_Grid');
		}
		/* @var @collection Eezy_Note_Model_Mysql4_Article_Collection */
		$this->setData('collection', $collection);
		return $this;
	}
	
	/**
	 * 
	 * @return Eezy_Note_Block_Article_Grid
	 * @see Varien_Data_Collection_Db::addOrder
	 */
	public function addOrder($field, $direction){
		$this->getCollection()->addOrder($field, $direction);
		return $this;
	}
    
    /**
     * Add filter to collection
     * 
     * @param type $filters
     */
    public function addFilter($filters){
        if(isset($filters['tag_id'])){
            $tag_id = $filters['tag_id'];
            $this->getCollection()->join(array('article_tag' => 'note/article_tag'), 'article_tag.article_id = main_table.id', 'tag_id');
            $this->getCollection()->addFieldToFilter('article_tag.tag_id', array('eq' => $tag_id));
        }
    }
	
	/**
	 * Set Page size
	 * @param int $size
	 * @return Eezy_Note_Block_Article_Grid
	 */
	public function setPageSize($size){
		$this->getCollection()->setPageSize($size);
		return $this;
	}
	
	/**
	 * Set cur page
	 * @param int $page
	 * @return Eezy_Note_Block_Article_Grid
	 */
	public function setCurPage($page){
		$this->getCollection()->setCurPage($page);
		return $this;
	}
	
	
	/**
	 * Get artcile collection
	 * 
	 * @return Eezy_Note_Model_Mysql4_Article_Collection
	 */
	public function getCollection(){
		if(!$this->hasData('collection')){
			$this->setCollection();
		}
		return $this->getData('collection');
	}
	
	/**
	 * Render item list view
	 * @param Eezy_Note_Model_Article $article
	 * @return string
	 */
	public function renderItem(Eezy_Note_Model_Article $article){
		return $this->getLayout()->createBlock('note/article_grid_item')->setTemplate($this->getItemTemplate())->setArticle($article)->toHtml();
	}
}