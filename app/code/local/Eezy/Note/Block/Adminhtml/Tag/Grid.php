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
		/*$this->addColumn('firstname', array(
		 'header'    => Mage::helper('customer')->__('First Name'),
		 'index'     => 'firstname'
		 ));
		 $this->addColumn('lastname', array(
		 'header'    => Mage::helper('customer')->__('Last Name'),
		 'index'     => 'lastname'
		 ));*/
		$this -> addColumn('name', array('header' => Mage::helper('note') -> __('Name'), 'index' => 'name'));
		$this -> addColumn('key_url', array('header' => Mage::helper('note') -> __('Key URL'), 'width' => '150', 'index' => 'key_url'));
		$this -> addColumn('short_description', array('header' => Mage::helper('note') -> __('Short Description'), 'width' => '30', 'index' => 'short_description'));

		$this -> addColumn('status', array('header' => Mage::helper('note') -> __('Status'), 'width' => '100', 'index' => 'status', 'type' => 'options', 'options' => array(1 => 'Active', 0 => 'Inactive'), ));
		
		$this -> addColumn('status', array('header' => Mage::helper('note') -> __('Status'), 'width' => '100', 'index' => 'status', 'type' => 'options', 'options' => Mage::getSingleton('note/tag')->getTreeHash(), ));
		/*

		 $this->addColumn('group', array(
		 'header'    =>  Mage::helper('customer')->__('Group'),
		 'width'     =>  '100',
		 'index'     =>  'group_id',
		 'type'      =>  'options',
		 'options'   =>  $groups,
		 ));

		 $this->addColumn('Telephone', array(
		 'header'    => Mage::helper('customer')->__('Telephone'),
		 'width'     => '100',
		 'index'     => 'billing_telephone'
		 ));

		 $this->addColumn('billing_postcode', array(
		 'header'    => Mage::helper('customer')->__('ZIP'),
		 'width'     => '90',
		 'index'     => 'billing_postcode',
		 ));

		 $this->addColumn('billing_country_id', array(
		 'header'    => Mage::helper('customer')->__('Country'),
		 'width'     => '100',
		 'type'      => 'country',
		 'index'     => 'billing_country_id',
		 ));

		 $this->addColumn('billing_region', array(
		 'header'    => Mage::helper('customer')->__('State/Province'),
		 'width'     => '100',
		 'index'     => 'billing_region',
		 ));

		 $this->addColumn('customer_since', array(
		 'header'    => Mage::helper('customer')->__('Customer Since'),
		 'type'      => 'datetime',
		 'align'     => 'center',
		 'index'     => 'created_at',
		 'gmtoffset' => true
		 ));

		 if (!Mage::app()->isSingleStoreMode()) {
		 $this->addColumn('website_id', array(
		 'header'    => Mage::helper('customer')->__('Website'),
		 'align'     => 'center',
		 'width'     => '80px',
		 'type'      => 'options',
		 'options'   => Mage::getSingleton('adminhtml/system_store')->getWebsiteOptionHash(true),
		 'index'     => 'website_id',
		 ));
		 }
		 */
		$this -> addColumn('action', array('header' => Mage::helper('customer') -> __('Action'), 'width' => '100', 'type' => 'action', 'getter' => 'getId', 'actions' => array( array('caption' => Mage::helper('customer') -> __('Edit'), 'url' => array('base' => '*/*/edit'), 'field' => 'id')), 'filter' => false, 'sortable' => false, 'index' => 'stores', 'is_system' => true, ));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row) {
		return $this -> getUrl('*/*/edit', array('id' => $row -> getId()));
	}

}
