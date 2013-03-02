<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Eezy_QA_QuestionController extends Mage_Core_Controller_Front_Action{
    public function askAction(){
        $weblog2 = Mage::getModel('qa/question');
        var_dump($weblog2->load(1));
        $this->loadLayout();
        $this->renderLayout();
    }
}