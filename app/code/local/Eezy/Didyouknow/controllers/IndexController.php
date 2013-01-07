<?php
class Eezy_Didyouknow_IndexController extends Mage_Core_Controller_Front_Action {
	public function randomAction() {
		$this->loadLayout ();
		$this->renderLayout();
	}
}
