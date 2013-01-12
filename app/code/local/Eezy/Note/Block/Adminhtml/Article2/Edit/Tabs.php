<?php
class Eezy_Note_Block_Adminhtml_Article_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {
	
	public function __construct() {
		parent::__construct ();
		$this->setId ( 'page_tabs' );
		$this->setDestElementId ( 'content' );
		$this->setTitle ( $this->__ ( 'Article' ) );
	}
	protected function _beforeToHtml() {
		$this->addTab ( 'content2', array (
				'label' => $this->__ ( 'Content' ),
				'title' => $this->__ ( 'Content' ),
				'content' => $this->getLayout ()->createBlock ( 'note/adminhtml_article_edit_form')->toHtml (),
				'active' => true 
		) );
		return parent::_beforeToHtml ();
	}
}