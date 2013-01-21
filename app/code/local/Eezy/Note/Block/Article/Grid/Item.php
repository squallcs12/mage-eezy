<?php

class Eezy_Note_Block_Article_Grid_Item extends Mage_Core_Block_Template{
	
	/**
	 * Set article by article id
	 * @param int $articleId
	 * @return Eezy_Note_Block_Article_Grid
	 */
	public function setArticleById($articleId){
		$this->setArticle(Mage::getModel('note/article')->load($articleId));
		return $this;
	}
}