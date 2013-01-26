<?php
class Eezy_Note_Block_Adminhtml_Tag_Edit_Form extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		$form->setUseContainer ( true );
		$form->setAction ( $this->getUrl ( '*/*/save', array (
				'_current' => true 
		) ) );
		$form->setMethod ( 'post' );
		$form->setId ( 'edit_form' );
		
		$this->setForm ( $form );
		$fieldset = $form->addFieldset ( 'note_form', array (
				'legend' => Mage::helper ( 'note' )->__ ( 'Tag information' ) 
		) );
		
		$fieldset->addField ( 'name', 'text', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Name' ),
				'class' => 'required-entry',
				'required' => true,
				'name' => 'name' 
		) );
		
		$fieldset->addField ( 'key_url', 'text', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Key URL' ),
				'class' => 'required-entry',
				'required' => true,
				'name' => 'key_url' 
		) );
		
		$fieldset->addField ( 'status', 'select', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Status' ),
				'name' => 'status',
				'values' => array (
						array (
								'value' => 1,
								'label' => Mage::helper ( 'note' )->__ ( 'Active' ) 
						),
						array (
								'value' => 0,
								'label' => Mage::helper ( 'note' )->__ ( 'Inactive' ) 
						) 
				) 
		) );
		
		$fieldset->addField ( 'parent_id', 'select', array (
				'size' => 5,
				'label' => Mage::helper ( 'note' )->__ ( 'Parent' ),
				'name' => 'parent_id',
				'values' => Mage::getSingleton ( 'note/tag' )->getTree () 
		) );
		
		$fieldset->addField ( 'short_description', 'editor', array (
				'name' => 'short_description',
				'label' => Mage::helper ( 'note' )->__ ( 'Content' ),
				'title' => Mage::helper ( 'note' )->__ ( 'Content' ),
				'style' => 'width:98%; height:200px;',
				'wysiwyg' => false,
				'required' => true 
		) );
		
		if (Mage::getSingleton ( 'adminhtml/session' )->getNoteTagData ()) {
			$form->setValues ( Mage::getSingleton ( 'adminhtml/session' )->getNoteTagData () );
			Mage::getSingleton ( 'adminhtml/session' )->setNoteTagData ( null );
		} elseif (Mage::registry ( 'note_tag' )) {
			$form->setValues ( Mage::registry ( 'note_tag' )->getData () );
		}
		return parent::_prepareForm ();
	}
}
