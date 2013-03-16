<?php
/**
 * GooglePlusOne plugin for Magento 
 *
 * @category    design_default
 * @package     Yireo_GooglePlusOne
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (c) 2010 Yireo (http://www.yireo.com/)
 * @license     Open Software License
 */

class Yireo_GooglePlusOne_Model_Backend_Source_Pagetype
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'default', 'label'=> Mage::helper('googleplusone')->__('HTML4 / XHTML1 style')),
            array('value' => 'html5', 'label'=> Mage::helper('googleplusone')->__('HTML5 style')),
        );
    }

}
