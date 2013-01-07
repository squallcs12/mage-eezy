<?php
class Eezy_Didyouknow_IndexController extends Mage_Core_Controller_Front_Action {
	public function randomAction() {
		if ($this->getRequest ()->get ( 'isAjax' )) {
			$this->getResponse ()->setBody ( Mage::helper ( 'didyouknow' )->getRandomQuote ()->getContent () );
		} else {
			$this->loadLayout ();
			$this->renderLayout ();
		}
	}
}
