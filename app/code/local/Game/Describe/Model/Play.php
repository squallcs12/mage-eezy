<?php

class Game_Describe_Model_Play extends Mage_Core_Model_Abstract {
	
	protected $_mainTable = 'game_describe_play';
	
	public function _construct(){
		parent::__construct();
		$this->_init('describe/play');
	}
}
