<?php

class Eezy_Note_Block_Adminhtml_Article_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form();
		$form -> setUseContainer(true);
		$form -> setAction($this -> getUrl('*/*/save'));
		$form -> setMethod('post');
		$form -> setId('edit_form');

		$this -> setForm($form);
		$fieldset = $form -> addFieldset('note_form', array('legend' => Mage::helper('note') -> __('Tag information')));

		$fieldset -> addField('image', 'image', array('label' => Mage::helper('note') -> __('Image'), 'class' => 'required-entry', 'required' => true, 'name' => 'image', ));

		$fieldset -> addField('subject', 'text', array('label' => Mage::helper('note') -> __('Title'), 'class' => 'required-entry', 'required' => true, 'name' => 'title', ));

		$fieldset -> addField('status', 'select', array('label' => Mage::helper('note') -> __('Status'), 'name' => 'status', 'values' => array( array('value' => 1, 'label' => Mage::helper('note') -> __('Active'),  ), array('value' => 0, 'label' => Mage::helper('note') -> __('Inactive'), ), ), ));

		$fieldset -> addField('parent_id', 'select', array('value' => 1, 'size' => 5, 'label' => Mage::helper('note') -> __('Parent'), 'name' => 'parent_id', 'values' => Mage::getSingleton('note/tag') -> getTree()));

		$fieldset -> addField('content', 'editor', array('name' => 'content', 'label' => Mage::helper('note') -> __('Content'), 'title' => Mage::helper('note') -> __('Content'), 'style' => 'width:98%; height:500px;', 'wysiwyg' => true, 'required' => true, ));

		$fieldset -> addField('full_entry', 'editor', array('name' => 'full_entry', 'label' => Mage::helper('note') -> __('Full Entry'), 'title' => Mage::helper('note') -> __('Full Entry'), 'style' => 'width:98%; height:500px;', 'wysiwyg' => true, 'required' => true, ));
		
		$form->setValues(array(
			'status' => 1
		));
		
		if (Mage::getSingleton('adminhtml/session') -> getNoteArticleData()) {
			$form -> setValues(Mage::getSingleton('adminhtml/session') -> getNoteArticleData());
			Mage::getSingleton('adminhtml/session') -> setNoteArticleData(null);
		} elseif (Mage::registry('note_article')) {
			$form -> setValues(Mage::registry('note_article') -> getData());
		}
		return parent::_prepareForm();
	}

}
