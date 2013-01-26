<?php

/**
 * Note article model
 *
 * @method string getTitle()
 * @method Eezy_Note_Model_Article setTitle(string $value)
 * @method string getDescription()
 * @method Eezy_Note_Model_Article setDescription(string $value)
 * @method string getKeyUrl()
 * @method Eezy_Note_Model_Article setKeyUrl(string $value)
 * @method string getContent()
 * @method Eezy_Note_Model_Article setContent(string $value)
 * @method string getImage()
 * @method Eezy_Note_Model_Article setImage(string $value)
 * @method string getFullEntry()
 * @method Eezy_Note_Model_Article setFullEntry(string $value)
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
    /**
     * Override parent::save
     * Add url key and format key-url
     */
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
    /**
     * 
     * @param type $tagIds
     */
    public function saveTag($tagIds){
    	$tagLinks = $this->getTagsLinkCollection();
    	foreach($tagLinks as $tagLink)
    		$tagLink->delete();
    	
    	foreach($tagIds as $tagId){
    		$tagLink = Mage::getModel('note/article_tag');
    		$tagLink->setTagId($tagId);
    		$tagLink->setArticleId($this->getId());
    		$tagLink->save();
    	}
    }
    /**
     * Get article tags link collection
     * @return Eezy_Note_Model_Mysql4_Article_Tag_Collection
     */
    public function getTagsLinkCollection(){
    	if($this->_tags === null){
    		$this->_tags = Mage::getModel('note/article_tag')->getCollection()->addFieldToFilter('article_id', array('eq' => $this->getId()));
    	}
    	return $this->_tags;
    }
    /**
     * Get Tags Collection
     * @return Eezy_Note_Model_Mysql4_Tag_Collection
     */
    public function getTagsCollection(){
        $articleTagCollection = $this->getTagsLinkCollection();
        $tagIds = $articleTagCollection->getTagIds();
        return Mage::getModel('note/tag')->getCollection()->addFieldToFilter('id', array('in' => $tagIds));
    }


    /**
     * Get url link to this article
     * @return string
     */
    public function getUrl(){
    	return Mage::getBaseUrl() . $this->getKeyUrl() . '.html';
    }
    
    /**
     * Get image url
     * @return string
     */
    public function getImageUrl(){
    	return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $this->getImage();
    }
    /**
     * Check if an indentifier is an article or not
     * @param string $identifier
     * @return integer | boolean
     */
    public function checkIdentifier($identifier){
    	$identifier = basename($identifier, '.html');
    	$article = $this->load($identifier, 'key_url');
    	if(!$article->getId())
            return false;
    	Mage::register('article', $article);
    	return $article->getId();
    }
}
