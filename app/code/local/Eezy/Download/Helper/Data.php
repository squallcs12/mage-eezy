<?php

class Eezy_Download_Helper_Data extends Mage_Core_Helper_Abstract{
	
	private $_codeSecret = "123123";
	
	public function getCounter($file){
		$fileMd5 = md5($file . $this->_codeSecret);
	}
}