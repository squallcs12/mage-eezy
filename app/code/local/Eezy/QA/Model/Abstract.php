<?php

/**
 * 
 * @author Squall
 *
 */
abstract class Eezy_QA_Model_Abstract extends Mage_Core_Model_Abstract{


	public function __call($method, $args){
		if(substr($method, 0, 2) == 'is'){
			$key = $this->_underscore($method);
			$data = $this->getData($key, isset($args[0]) ? $args[0] : null);
			return $data;
		}
		return parent::__call($method, $args);
	}
}