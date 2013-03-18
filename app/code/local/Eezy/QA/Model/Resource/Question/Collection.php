<?php

class Eezy_QA_Model_Resource_Question_Collection extends Mage_Eav_Model_Entity_Collection_Abstract{
	
	protected function _construct()
	{
		$this->_init('qa/question');
	}
}