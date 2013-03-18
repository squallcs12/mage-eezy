<?php

/**
 * Abstract class for QA model. enable to use store_id for EAV model 
 * @author Squall
 *
 * 
 */
class Eezy_QA_Model_Resource_Abstract extends Mage_Eav_Model_Entity_Abstract{
	
	public function _construct(){
		parent::_construct();
		$resource = Mage::getSingleton('core/resource');
		$this->setConnection(
				$resource->getConnection('qa_read'),
				$resource->getConnection('qa_write')
		);
	}
	
	/**
	 * Retrieve default entity attributes
	 *
	 * @return array
	 */
	protected function _getDefaultAttributes()
	{
		return array('entity_type_id', 'attribute_set_id', 'created_at', 'updated_at', 'parent_id', 'increment_id', 'store_id');
	}
	
	
	/**
	 * Save entity attribute value
	 *
	 * Collect for mass save
	 *
	 * @param Mage_Core_Model_Abstract $object
	 * @param Mage_Eav_Model_Entity_Attribute_Abstract $attribute
	 * @param mixed $value
	 * @return Mage_Eav_Model_Entity_Abstract
	 */
	protected function _saveAttribute($object, $attribute, $value)
	{
		$table = $attribute->getBackend()->getTable();
		if (!isset($this->_attributeValuesToSave[$table])) {
			$this->_attributeValuesToSave[$table] = array();
		}
	
		$entityIdField = $attribute->getBackend()->getEntityIdField();
	
		$data   = array(
				'entity_type_id'    => $object->getEntityTypeId(),
				$entityIdField      => $object->getId(),
				'attribute_id'      => $attribute->getId(),
				'value'             => $this->_prepareValueForSave($value, $attribute),
				'store_id' 			=> $object->getStoreId() ? $object->getStoreId() : Mage::app()->getStore()->getId()
		);
	
		$this->_attributeValuesToSave[$table][] = $data;
	
		return $this;
	}
	
	protected function _updateAttribute($object, $attribute, $valueId, $value)
	{
		$table = $attribute->getBackend()->getTable();
		if (!isset($this->_attributeValuesToSave[$table])) {
			$this->_attributeValuesToSave[$table] = array();
		}
	
		$entityIdField = $attribute->getBackend()->getEntityIdField();
	
		$data   = array(
				'entity_type_id'    => $object->getEntityTypeId(),
				$entityIdField      => $object->getId(),
				'attribute_id'      => $attribute->getId(),
				'value'             => $this->_prepareValueForSave($value, $attribute),
				'value_id'			=> $valueId,
				'store_id' 			=> $object->getStoreId() ? $object->getStoreId() : Mage::app()->getStore()->getId()
		);
	
		$this->_attributeValuesToSave[$table][] = $data;
	
		return $this;
	}
}