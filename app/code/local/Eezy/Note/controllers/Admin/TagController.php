<?php

class Eezy_Note_Admin_TagController extends Mage_Adminhtml_Controller_Action{
	
	public function newAction(){
		$this->loadLayout()->renderLayout();
	}
	
	public function editAction(){
		$id = $this->getRequest()->getParam('id');
		$tag = Mage::getModel('note/tag')->load($id);
		Mage::register('note_tag', $tag);
		$this->loadLayout()->renderLayout();
	}
	
	public function indexAction(){
		if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return;
        }
		$this->loadLayout()->renderLayout();
	}
	
	public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
	
	public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $noteModel = Mage::getModel('note/tag');
               
                $noteModel->setId($this->getRequest()->getParam('id'))
                    ->setData($postData)
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setnoteData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setnoteData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
}
