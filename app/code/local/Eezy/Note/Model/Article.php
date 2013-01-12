<?php
class Eezy_Note_Model_Article extends Mage_Core_Model_Abstract {
	
	protected $_tag = null;
	
	public function _construct() {
		$this->_init ( 'note/article', 'id' );
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
    
    public function save(){
    	if(!$this->getKeyUrl()){
    		require_once 'Mage/Catalog/Helper/Product/Url.php';
    		require_once 'Mage/Catalog/Model/Product/Url.php';
    		$urlHelper = new Mage_Catalog_Helper_Product_Url();
    		$keyFormated = $urlHelper->format($this->getTitle());
    		
    		$urlModel = new Mage_Catalog_Model_Product_Url();
    		$keyUrl = $urlModel->formatUrlKey($keyFormated);
    		$this->setKeyUrl($keyUrl);
    	}
    	parent::save();
    }
    
    public function saveTag($tagIds){
    	$tagLinks = $this->getTagLinks();
    	foreach($tagLinks as $tagLink)
    		$tagLink->delete();
    	
    	foreach($tagIds as $tagId){
    		$tagLink = Mage::getModel('note/article_tag');
    		$tagLink->setTagId($tagId);
    		$tagLink->setArticleId($this->getId());
    		$tagLink->save();
    	}
    }
    
    public function getTagLinks(){
    	if($this->_tags === null){
    		$this->_tags = Mage::getModel('note/article_tag')->getCollection()->addFieldToFilter('article_id', array('eq' => $this->getId()));
    	}
    	return $this->_tags;
    }
}
