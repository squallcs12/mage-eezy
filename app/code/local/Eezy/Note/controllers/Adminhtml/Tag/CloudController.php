<?php

class Eezy_Note_Adminhtml_Tag_CloudController extends Mage_Adminhtml_Controller_Action{

	public function indexAction(){
		Mage::getModel('note/crontab_tag_cloud')->execute();
		$this->loadLayout()->renderLayout();
	}
	public function gridAction(){
		$this->loadLayout()->renderLayout();
	}
}