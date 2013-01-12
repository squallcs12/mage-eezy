<?php
class Eezy_Note_Block_Adminhtml_Article_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
	public function __construct() {
		$this->_objectId = 'article_id';
		$this->_controller = 'note';
		$this->_blockGroup = 'note_adminhtml';
		parent::__construct ();
		
		$this->_updateButton ( 'save', 'label', $this->__ ( 'Save' ) );
		$this->_updateButton ( 'delete', 'label', $this->__ ( 'Delete' ) );
	}
	public function getHeaderText() {
		if (Mage::registry ( 'note_article' )) {
			return $this->__ ( 'Edit article' );
		} else {
			return $this->__ ( 'New article' );
		}
	}
}
