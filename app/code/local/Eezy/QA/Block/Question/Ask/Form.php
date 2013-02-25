<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Eezy_QA_Block_Question_Ask_Form extends Mage_Core_Block_Template {

    public function _prepareLayout() {

        $form = new Varien_Data_Form(array(
                    'id' => 'ask_form',
                    'method' => 'post',
                    'action' => $this->getUrl('qa/question/new'),
                ));

        $form->setUseContainer(true);

        $form->addField('subject', 'text', array(
            'label' => $this->__('Subject'),
            'required' => true,
            'name' => 'subject'
        ));
        
        $form->addField('content', 'editor', array(
            'label' => '',
            'required' => false,
            'class' => 'wysiwyg',
            'name' => 'content'
        ));
        
        $form->addField('tags', 'text', array(
            'label' => $this->__('Tags'),
            'required' => true,
            'name' => 'tags'
        ));
        
        $form->addField('submit', 'submit', array(
            'value' => $this->__('Ask question')
        ));
        
        

        $this->setForm($form);
        parent::_prepareLayout();
    }

}