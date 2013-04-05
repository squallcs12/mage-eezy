<?php

/**
 * 
 * @author DELL
 * 
 * @method int getDownloadTime
 * @method Eezy_Download_Model_File setDownloadTime
 *
 */
class Eezy_Download_Model_File extends Mage_Core_Model_Abstract{
	public function _construct(){
		$this->_init('download/file', 'id');
	}
}