<?php

class Eezy_Download_CounterController extends Mage_Core_Controller_Front_Action{
	public function indexAction(){
		$file = $this->getRequest()->get('file');
		$addressUrl = Mage::helper('download')->increaseDownload($file);
		$this->_redirectUrl($addressUrl);
	}
}