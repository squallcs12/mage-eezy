<?php
class Eezy_Note_Model_Article_Tag extends Mage_Core_Model_Abstract {
	public function _construct() {
		$this->_init ( 'note/article_tag', array('article_id', 'tag_id') );
	}
}