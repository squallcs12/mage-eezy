<?php

class Eezy_Download_Helper_Data extends Mage_Core_Helper_Abstract{
	
	/**
	 * 
	 * @return Eezy_Download_Model_File
	 */
	protected function _getFileModel(){
		return Mage::getModel('download/file');
	}
	
	/**
	 * Get download time of tile
	 * @param string $file
	 */
	public function getCounter($file){
		$model = $this->_getFileModel()->load($file, 'file');
		return $model->getDownloadTime();
	}
	
	public function increaseDownload($file){
		$model = $this->_getFileModel()->load($file, 'file');
		$model->setDownloadTime($model->getDownloadTime() + 1);
		return 'http://download.eezy.vn/' . $file;
	}
}