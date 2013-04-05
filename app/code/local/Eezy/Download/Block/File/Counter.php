<?php

/**
 * 
 * @author DELL
 *
 *@method string getFile()
 *@method Eezy_Download_Block_File_Counter setFile($value) 
 */
class Eezy_Download_Block_File_Counter extends Mage_Core_Block_Template{
	protected function _toHtml(){
		return $this->helper('download')->getCounter($this->getFile());
	}
}