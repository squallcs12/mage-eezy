<?php
class Eezy_Note_Model_Article_Hot extends Mage_Core_Model_Abstract {
	public function _construct() {
		$this->_init ( 'note/article_hot', 'article_id' );
	}
}