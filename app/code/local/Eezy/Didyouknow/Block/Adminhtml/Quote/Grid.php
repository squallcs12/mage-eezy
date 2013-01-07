<?php

class Eezy_Didyouknow_Block_Adminhtml_Quote_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	public function __construct() {
		parent::__construct();
		$this -> setId('quoteGrid');
		$this -> setUseAjax(true);
		$this -> setDefaultSort('id asc');
		$this -> setSaveParametersInSession(true);
	}

	protected function _prepareCollection() {
		$collection = Mage::getModel('didyouknow/quote') -> getCollection();

		$this -> setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns() {
		$this -> addColumn('id', array('header' => Mage::helper('didyouknow') -> __('ID'), 'width' => '50px', 'index' => 'id', 'type' => 'number', ));

		$this -> addColumn('content', array('header' => Mage::helper('didyouknow') -> __('Content'), 'index' => 'content'));
		
		$this -> addColumn('status', array('header' => Mage::helper('didyouknow') -> __('Status'), 'width' => '100', 'index' => 'status', 'type' => 'options', 'options' => array(0 => Mage::helper('didyouknow') -> __('Inactive'), 1 => Mage::helper('didyouknow') -> __('Active')), ));
		
		$this -> addColumn('action', array('header' => Mage::helper('didyouknow') -> __('Action'), 'width' => '100', 'type' => 'action', 'getter' => 'getId', 'actions' => array( array('caption' => Mage::helper('didyouknow') -> __('Edit'), 'url' => array('base' => '*/*/edit'), 'field' => 'id')), 'filter' => false, 'sortable' => false, 'index' => 'stores', 'is_system' => true, ));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row) {
		return $this -> getUrl('*/*/edit', array('id' => $row -> getId()));
	}
	
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('quote');
	
		$this->getMassactionBlock()->addItem('delete', array(
				'label'    => Mage::helper('didyouknow')->__('Delete'),
				'url'      => $this->getUrl('*/*/massDelete'),
				'confirm'  => Mage::helper('didyouknow')->__('Are you sure?')
		));
	
		$this->getMassactionBlock()->addItem('active', array(
				'label'    => Mage::helper('didyouknow')->__('Active'),
				'url'      => $this->getUrl('*/*/massActive')
		));
	
		$this->getMassactionBlock()->addItem('deactive', array(
				'label'    => Mage::helper('didyouknow')->__('Deactive'),
				'url'      => $this->getUrl('*/*/massDeactive')
		));
	
		return $this;
	}

}
