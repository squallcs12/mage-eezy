<?php

class Eezy_Download_Helper_Data extends Mage_Core_Helper_Abstract{
	
	private $_codeSecret = "123123";
	
	public function getCounter($file){
		$model = Mage::getModel('download/file')->load($file, 'file');
		return $model->getDownloadTime();
	}
}