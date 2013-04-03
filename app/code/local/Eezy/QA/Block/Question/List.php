<?php

/**
 * 
 * @author DELL
 *
 * @method int getPage()
 * @method int getPerPage()
 * @method array getOrders()
 * @method array getFilters()
 * @method array getFields()
 * 
 * @method Eezy_QA_Block_Question_List setPage(int $value)
 * @method Eezy_QA_Block_Question_List setPerPage(int $value)
 * @method Eezy_QA_Block_Question_List setOrders(array $value)
 * @method Eezy_QA_Block_Question_List setFilters(array $value)
 * @method Eezy_QA_Block_Question_List setFields(array $value)
 */
class Eezy_QA_Block_Question_List extends Mage_Core_Block_Template{
	
	public function __construct(){
		parent::__construct();
		$this->setPage(1);
		$this->setPerPage(20);
	}
	
	/**
	 * 
	 * @var Eezy_QA_Model_Resource_Question_Collection
	 */
	protected $_questions;

	/**
	 * Add order to array
	 * @param string $field
	 * @param string $direction
	 * @return Eezy_QA_Block_Question_List
	 */
	public function addOrder($field, $direction = 'ASC'){
		if($this->hasData('ordesr')){
			$this->_data['orders'][$field] = $direction;
		} else{
			$this->_data['orders'] = array($field => $direction);
		}
		return $this;
	}

	/**
	 * Add filter to array
	 * @param string $field
	 * @param array $condition
	 * @return Eezy_QA_Block_Question_List
	 */
	public function addFilter($field, $condition){
		if($this->hasData('filters')){
			$this->_data['filters'][$field] = $condition;
		} else{
			$this->_data['filters'] = array($field => $condition);
		}
		return $this;
	}
	
	/**
	 * Add field to array
	 * @param string $field
	 * @param array $condition
	 * @return Eezy_QA_Block_Question_List
	 */
	public function addField($field){
		if($this->hasData('fields')){
			$this->_data['fields'][] = $field;
		} else{
			$this->_data['fields'] = array(field);
		}
		return $this;
	}
	
	/**
	 * Load questions collection
	 */
	protected function _loadQuestions(){
		if(!$this->_questions)
			$this->_questions = Mage::getModel('qa/question')->getCollection();
		$this->_questions->setCurPage($this->getPage());
		$this->_questions->setPageSize($this->getPerPage());
		
		foreach($this->getOrders() as $field => $direction)
			$this->_questions->addOrder($field, $direction);
		
		foreach($this->getFilters() as $field => $condition)
			$this->_questions->addFieldToFilter($field, $condition);
		
		foreach($this->getFields() as $field)
			$this->_questions->addFieldToSelect($field);
		
		$this->_questions->load();
	}
	
	public function _prepareLayout(){
		parent::_prepareLayout();
	}
	
	public function _beforeToHtml(){
		if(!$this->_questions)
			$this->_loadQuestions();
		parent::_beforeToHtml();
	}
	
	public function setCollection($collection){
		$this->_questions = $collection;
		return $this;
	}
	
    public function getQuestions(){
    	return $this->_questions;
    }
}