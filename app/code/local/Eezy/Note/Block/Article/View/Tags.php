<?php
/**
 * @method Eezy_Note_Block_Article_View_Tags setTagsCollection(Eezy_Note_Model_Mysql4_Tag_Collection $cllection) Set tags
 * @method Eezy_Note_Model_Mysql4_Tag_Collection getTagsCollection() Get tags
 */
class Eezy_Note_Block_Article_View_Tags extends Mage_Core_Block_Template {

    /**
     * 
     * @return Eezy_Note_Block_Article_View
     */
    public function _prepareLayout() {
        if (($article = Mage::registry('article'))){
            /* @var $article Eezy_Note_Model_Article */
            $this->setTagsCollection($article->getTagsCollection());
        }
        return parent::_prepareLayout();
    }
}