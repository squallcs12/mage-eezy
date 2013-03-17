<?php

class Eezy_Note_ArticleController extends Mage_Core_Controller_Front_Action{
	public function indexAction(){
		$this->loadLayout();
        
        $filter = $this->getRequest()->getParam('filter');
        $this->getLayout()->getBlock('article_grid')->addFilter($filter);
        
        $this->renderLayout();
	}
	
	public function viewAction(){
		$pageId = $this->getRequest()->getParam('page_id');
		if(!Mage::registry('article')){
			Mage::register('article', Mage::getModel('note/article')->load($pageId));
		}
		$this->loadLayout()->renderLayout();
	}
}
