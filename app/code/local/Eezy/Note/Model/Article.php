<?php

/**
 * Note article model
 *
 * @method string getTitle()
 * @method Eezy_Note_Model_Article setTitle(string $value)
 * @method string getShortDescription()
 * @method Eezy_Note_Model_Article setShortDescription(string $value)
 *
 * @category    Eezy
 * @package     Eezy_Note
 * @author      Eezy Team <contact@eezy.vn>
 */
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
    
    /**
     * Get url link to this article
     * @return string
     */
    public function getUrl(){
    	return '#123';
    }
    
    public function getImageUrl(){
    	return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $this->getImage();
    }
}
