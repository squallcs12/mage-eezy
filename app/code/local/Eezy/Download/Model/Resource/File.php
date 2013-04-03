<?php

class Eezy_Download_Model_Resource_File extends Mage_Core_Model_Mysql4_Resource{
	public function __construct(){
		parent::__construct();
		$this->_init('download/file');
	}
}