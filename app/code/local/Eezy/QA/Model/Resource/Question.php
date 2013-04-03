<?php

/*
 * To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * 
 * @author Squall
 *
 */
class Eezy_QA_Model_Resource_Question extends Eezy_QA_Model_Resource_Abstract
{

	public function _construct()
	{
		$this->_init('qa/question', 'question_id');
	}
}