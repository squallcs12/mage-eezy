<?php
class Eezy_Note_Model_Tag_Cloud extends Mage_Core_Model_Abstract {
	
	public function _construct() {
		$this->_init ( 'note/tag_cloud', 'tag_id' );
	}
}