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

class Yireo_GooglePlusOne_Model_Observer
{
    /*
     * Listen to the event core_block_abstract_to_html_after
     * 
     * @access public
     * @parameter Varien_Event_Observer $observer
     * @return $this
     */
    public function coreBlockAbstractToHtmlAfter($observer)
    {
        $transport = $observer->getEvent()->getTransport();
        $block = $observer->getEvent()->getBlock();

        if($block->getNameInLayout() == 'head') {
            $layout = Mage::app()->getLayout();
            $html = $transport->getHtml()."\n".Mage::helper('googleplusone')->getHeaderScript();
            $transport->setHtml($html);
        }

        return $this;
    }
}
