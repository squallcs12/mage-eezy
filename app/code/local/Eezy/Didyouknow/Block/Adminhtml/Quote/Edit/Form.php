<?php

class Eezy_Didyouknow_Block_Adminhtml_Quote_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form();
		$form -> setUseContainer(true);
		$form -> setAction($this -> getUrl('*/*/save'));
		$form -> setMethod('post');
		$form -> setId('edit_form');

		$this -> setForm($form);
		$fieldset = $form -> addFieldset('quote_form', array('legend' => Mage::helper('didyouknow') -> __('Add quote')));

		$fieldset -> addField('content', 'editor', array('label' => Mage::helper('didyouknow') -> __('Content'), 'class' => 'required-entry', 'required' => true, 'name' => 'content', ));

		$fieldset -> addField('status', 'select', array('label' => Mage::helper('didyouknow') -> __('Status'), 'name' => 'status', 'values' => array( array('value' => 1, 'label' => Mage::helper('didyouknow') -> __('Active'), ), array('value' => 0, 'label' => Mage::helper('didyouknow') -> __('Inactive'), ), ), ));

		if (Mage::getSingleton('adminhtml/session') -> getDidyouknowQuoteData()) {
			$form -> setValues(Mage::getSingleton('adminhtml/session') -> getDidyouknowQuoteData());
			Mage::getSingleton('adminhtml/session') -> setDidyouknowQuoteData(null);
		} elseif (Mage::registry('didyouknow_quote')) {
			$form -> setValues(Mage::registry('didyouknow_quote') -> getData());
		}
		return parent::_prepareForm();
	}

}
