<?php

class Eezy_Download_Model_Resource_File_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract{
	public function _construct(){
		$this->_init('download/file');
	}
}