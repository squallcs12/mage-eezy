<?php
class Eezy_Download_IndexController extends Mage_Core_Controller_Front_Action {
	public function randomAction() {
		if ($this->getRequest ()->get ( 'isAjax' )) {
			$this->getResponse ()->setBody ( Mage::helper('didyouknow')->getJsonQuotes(20) );
		} else {
			$this->loadLayout ();
			$this->renderLayout ();
		}
	}
}
