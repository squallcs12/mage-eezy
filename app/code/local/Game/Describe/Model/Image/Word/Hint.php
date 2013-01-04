<?php

class Game_Describe_Model_Image_Word_Hint extends Mage_Core_Model_Abstract {
	
	protected $_mainTable = 'game_describe_image_word_hint';
	
	public function _construct(){
		parent::__construct();
		$this->_init('describe/image_word_hint');
	}
}
