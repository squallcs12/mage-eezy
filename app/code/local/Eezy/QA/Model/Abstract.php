<?php

/**
 * 
 * @author Squall
 *
 * @method int getStoreId()
 * @method Eezy_QA_Model_Abstract setStoreId(int $value)
 * @method int getIncrementId()
 * @method Eezy_QA_Model_Abstract setIncrementId(int $value)
 * @method int getParentId()
 * @method Eezy_QA_Model_Abstract setParentId(int $value)
 * @method datetime getUpdatedAt()
 * @method Eezy_QA_Model_Abstract setUpdatedAt(datetime $value)
 * @method datetime getCreatedAt()
 * @method Eezy_QA_Model_Abstract setCreatedAt(datetime $value)
 * @method int getAttributeSetId()
 * @method Eezy_QA_Model_Abstract setAttributeSetId(int $value)
 * @method int getEntityTypeId()
 * @method Eezy_QA_Model_Abstract setEntityTypeId(int $value)
 */
class Eezy_QA_Model_Abstract extends Mage_Core_Model_Abstract{


	public function __call($method, $args){
		if(substr($method, 0, 2) == 'is'){
			$key = $this->_underscore($method);
			$data = $this->getData($key, isset($args[0]) ? $args[0] : null);
			//Varien_Profiler::stop('GETTER: '.get_class($this).'::'.$method);
			return $data;
		}
		parent::__call($method, $args);
	}
}