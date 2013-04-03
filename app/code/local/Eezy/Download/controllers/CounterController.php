<?php

class Eezy_Download_CounterController extends Mage_Core_Controller_Front_Action{
	public function indexAction(){
		echo Mage::helper('download')->increaseCounter($this->getRequest()->getQuery('file'));
	}
}