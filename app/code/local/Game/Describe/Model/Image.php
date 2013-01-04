<?php

class Game_Describe_Model_Image extends Mage_Core_Model_Abstract {
	
	protected $_mainTable = 'game_describe_image';
	
	public function _construct(){
		parent::__construct();
		$this->_init('describe/image');
	}
}
