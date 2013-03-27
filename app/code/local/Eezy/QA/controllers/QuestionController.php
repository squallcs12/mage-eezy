<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Eezy_QA_QuestionController extends Eezy_QA_Controller_Abstract{
    
    public function askAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function saveAction(){
        $question = Mage::getModel('qa/question');
        $postData = $this->getRequest()->getPost();
        
        $question->setData($postData)->setId($this->getRequest()->getParam('id'));
        
        $question->save();
        
        $this->_getSession()->addSuccess("Ha ha ha");
        
        $this->_redirect($question->getQuestionUrl());
    }
    
    public function listAction(){
    	$this->loadLayout();
    	$this->renderLayout();
    }
}