<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Eezy_QA_Model_Resource_Question extends Mage_Catalog_Model_Resource_Abstract
{
    protected function _construct()
    {
        $resource = Mage::getSingleton('core/resource');
        $this->setType('qa_question');
        $this->setConnection(
            $resource->getConnection('qa_read'),
            $resource->getConnection('qa_write')
        );
    }
}