<?php

class Eezy_QA_Controller_Abstract extends Mage_Core_Controller_Front_Action{
	
	/**
	 * Get front-end session
	 * @return Mage_Core_Model_Session
	 */
	protected function _getSession(){
		return Mage::getSingleton('core/session');
	}
	
}