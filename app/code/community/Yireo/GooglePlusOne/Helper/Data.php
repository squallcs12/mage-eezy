<?php
/**
 * GooglePlusOne plugin for Magento 
 *
 * @package     Yireo_GooglePlusOne
 * @author      Yireo
 * @copyright   Copyright (c) 2011 Yireo (http://www.yireo.com/)
 * @license     Open Software License
 */

class Yireo_GooglePlusOne_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getConfigValue($key = null, $default_value = null)
    {
        $value = Mage::getStoreConfig('googleplusone/settings/'.$key);
        if(empty($value)) $value = $default_value;
        return $value;
    }

    public function getHeaderScript()
    {
        return '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';
    }

    /*
     * Usage: 
     *   echo Mage::helper('googleplusone')->getHtml($arguments);
     *   $arguments is an associative array (size, count, url)
    
     */
    public function getHtml($arguments = null)
    {
        if (!($layout = Mage::app()->getFrontController()->getAction()->getLayout())) {
            return '';
        }

        if (!($block = $layout->getBlock('googleplusone'))) {
            return '';
        }

        // Set the arguments
        if(!empty($arguments) && is_array($arguments)) {
            $block->setData('arguments', $arguments);
        }

        return $block->toHtml();
    }
}
