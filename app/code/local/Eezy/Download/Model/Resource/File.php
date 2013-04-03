<?php

class Eezy_Download_Model_Resource_File extends Mage_Core_Model_Mysql4_Resource{
	public function _construct(){
		$this->_init('download/file', 'id');
	}
}