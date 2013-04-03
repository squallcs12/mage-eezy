<?php

class Eezy_Download_Model_File extends Mage_Core_Model_Abstract{
	public function __construct(){
		parent::__construct();
		$this->_init('download/file');
	}
}