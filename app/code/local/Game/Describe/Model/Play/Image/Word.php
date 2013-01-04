<?php

class Game_Describe_Model_Play_Image_Word extends Mage_Core_Model_Abstract {
	
	protected $_mainTable = 'game_describe_play_image_word';
	
	public function _construct(){
		parent::__construct();
		$this->_init('describe/play_image_word');
	}
}
