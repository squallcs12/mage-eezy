<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Eezy_QA_QuestionController extends Mage_Core_Controller_Front_Action{
    
    public function askAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
    
    public function saveAction(){
        $question = Mage::getModel('qa/question');
        $posts = $this->getRequest()->getPost();
        $question->setData($posts);
        
        $question->save();
    }
}