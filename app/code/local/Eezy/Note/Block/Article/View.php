<?php
/**
 * @method Eezy_Note_Block_Article_View setArticle(Eezy_Note_Model_Article $article) Set article
 * @method Eezy_Note_Model_Article getArticle() Get article
 */
class Eezy_Note_Block_Article_View extends Mage_Core_Block_Template {

    /**
     * 
     * @return Eezy_Note_Block_Article_View
     */
    public function _prepareLayout() {
        if (Mage::registry('article'))
            $this->setArticle(Mage::registry('article'));
        else if ($this->hasData('article_id'))
            $this->setArticleById ($this->getData ('article_id'));
        $this->getLayout()->getBlock('head')->setTitle($this->getArticle()->getTitle());
        return parent::_prepareLayout();
    }
    
    /**
     * 
     * @param type $id
     * @return \Eezy_Note_Block_Article_View
     */
    public function setArticleById($id) {
        $this->setArticle(Mage::getModel('note/article')->load($id));
        return $this;
    }
}