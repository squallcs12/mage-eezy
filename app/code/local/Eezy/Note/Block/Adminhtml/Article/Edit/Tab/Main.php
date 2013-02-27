<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Cms page edit form main tab
 *
 * @category Mage
 * @package Mage_Adminhtml
 * @author Magento Core Team <core@magentocommerce.com>
 */
class Eezy_Note_Block_Adminhtml_Article_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form {
	protected function _prepareForm() {
		$form = new Varien_Data_Form ();
		
		$form->setHtmlIdPrefix ( 'article_' );
		
		$fieldset = $form->addFieldset ( 'note_form', array (
				'legend' => Mage::helper ( 'note' )->__ ( 'Tag information' ) 
		) );
		
		$fieldset->addField ( 'image', 'image', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Image' ),
				'class' => 'required-entry',
				'required' => true,
				'name' => 'image' 
		) );
		
		$fieldset->addField ( 'title', 'text', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Title' ),
				'class' => 'required-entry',
				'required' => true,
				'name' => 'title' 
		) );

		$fieldset->addField ( 'key_url', 'text', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Key URL' ),
				'class' => '',
				'required' => false,
				'name' => 'key_url'
		) );
		$fieldset->addField ( 'order_number', 'text', array (
				'label' => Mage::helper ( 'note' )->__ ( 'Order Number' ),
				'class' => '',
				'required' => false,
				'name' => 'order_number' 
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

		$fieldset->addField ( 'description', 'editor', array (
				'name' => 'description',
				'label' => Mage::helper ( 'note' )->__ ( 'Description' ),
				'title' => Mage::helper ( 'note' )->__ ( 'Description' ),
				'style' => 'width:98%; height:100px;',
				'wysiwyg' => true,
				'required' => true
		) );
		
		$fieldset->addField ( 'content', 'editor', array (
				'name' => 'content',
				'label' => Mage::helper ( 'note' )->__ ( 'Content' ),
				'title' => Mage::helper ( 'note' )->__ ( 'Content' ),
				'style' => 'width:98%; height:500px;',
				'wysiwyg' => true,
				'required' => true 
		) );
		
		$fieldset->addField ( 'full_entry', 'editor', array (
				'name' => 'full_entry',
				'label' => Mage::helper ( 'note' )->__ ( 'Full Entry' ),
				'title' => Mage::helper ( 'note' )->__ ( 'Full Entry' ),
				'style' => 'width:98%; height:500px;',
				'wysiwyg' => true,
				'required' => true 
		) );
		
		$form->setValues ( array (
				'status' => 1 
		) );
		
		if (Mage::getSingleton ( 'adminhtml/session' )->getNoteArticleData ()) {
			$form->setValues ( Mage::getSingleton ( 'adminhtml/session' )->getNoteArticleData () );
			Mage::getSingleton ( 'adminhtml/session' )->setNoteArticleData ( null );
		} elseif (Mage::registry ( 'note_article' )) {
			$form->setValues ( Mage::registry ( 'note_article' )->getData () );
		}
		
		$this->setForm ( $form );
		
		return parent::_prepareForm ();
	}
}
