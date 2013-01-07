<?php

class Eezy_Didyouknow_Admin_QuoteController extends Mage_Adminhtml_Controller_Action{
	
	public function newAction(){
		$this->loadLayout()->renderLayout();
	}
	
	public function editAction(){
		$id = $this->getRequest()->getParam('id');
		$quote = Mage::getModel('didyouknow/quote')->load($id);
		Mage::register('didyouknow_quote', $quote);
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
                $quoteModel = Mage::getModel('didyouknow/quote');
               
                $quoteModel
                    ->setData($postData)
                	->setId($this->getRequest()->getParam('id'));
                    $quoteModel->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setnoteData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setDidyouknowQuoteData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
    
	public function massDeleteAction()
    {
        $quotesIds = $this->getRequest()->getParam('quote');
        if(!is_array($quotesIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select quote(s).'));
        } else {
            try {
                $quote = Mage::getModel('didyouknow/quote');
                foreach ($quotesIds as $quoteId) {
                    $quote->reset()
                        ->load($quoteId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($quotesIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
    
	public function massActiveAction()
    {
        $quotesIds = $this->getRequest()->getParam('quote');
        if(!is_array($quotesIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select quote(s).'));
        } else {
            try {
                $quote = Mage::getModel('didyouknow/quote');
                foreach ($quotesIds as $quoteId) {
                    $quote->reset()
                        ->load($quoteId)
                        ->setStatus(1)
                        ->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($quotesIds))
                );
                
                Mage::helper('didyouknow')->clearCacheQuoteIds();
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
    
	public function massDeactiveAction()
    {
        $quotesIds = $this->getRequest()->getParam('quote');
        if(!is_array($quotesIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select quote(s).'));
        } else {
            try {
                $quote = Mage::getModel('didyouknow/quote');
                foreach ($quotesIds as $quoteId) {
                    $quote->reset()
                        ->load($quoteId)
                        ->setStatus(0)
                        ->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($quotesIds))
                );
                
                Mage::helper('didyouknow')->clearCacheQuoteIds();
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}
