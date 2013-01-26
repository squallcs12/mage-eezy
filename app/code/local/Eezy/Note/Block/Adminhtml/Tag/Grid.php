<?php

class Eezy_Note_Block_Adminhtml_Tag_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	public function __construct() {
		parent::__construct();
		$this -> setId('tagGrid');
		$this -> setUseAjax(true);
		$this -> setDefaultSort('id asc');
		$this -> setSaveParametersInSession(true);
	}

	protected function _prepareCollection() {
		$collection = Mage::getModel('note/tag') -> getCollection();

		$this -> setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns() {
		$this -> addColumn('id', array('header' => Mage::helper('note') -> __('ID'), 'width' => '50px', 'index' => 'id', 'type' => 'number', ));
		
		$this -> addColumn('name', array('header' => Mage::helper('note') -> __('Name'), 'index' => 'name'));
		$this -> addColumn('key_url', array('header' => Mage::helper('note') -> __('Key URL'), 'width' => '150', 'index' => 'key_url'));
		$this -> addColumn('short_description', array('header' => Mage::helper('note') -> __('Short Description'), 'width' => '30', 'index' => 'short_description'));

		$this -> addColumn('status', array('header' => Mage::helper('note') -> __('Status'), 'width' => '100', 'index' => 'status', 'type' => 'options', 'options' => array(1 => 'Active', 0 => 'Inactive'), ));
		
		$this -> addColumn('parent_id', array('header' => Mage::helper('note') -> __('Parent'), 'width' => '100', 'index' => 'parent_id', 'type' => 'options', 'options' => Mage::getSingleton('note/tag')->getTreeHash(), ));
		
		$this -> addColumn('action', array('header' => Mage::helper('customer') -> __('Action'), 'width' => '100', 'type' => 'action', 'getter' => 'getId', 'actions' => array( array('caption' => Mage::helper('customer') -> __('Edit'), 'url' => array('base' => '*/*/edit'), 'field' => 'id')), 'filter' => false, 'sortable' => false, 'index' => 'stores', 'is_system' => true, ));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row) {
		return $this -> getUrl('*/*/edit', array('id' => $row -> getId()));
	}

}
