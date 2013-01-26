<?php
class Eezy_Note_Model_Crontab_Tag_Cloud extends Mage_Core_Model_Abstract{
	public function _construct(){
		parent::_construct();
		$this->_init('note/crontab_tag_cloud');
	}
	

	/**
	 * Update tag cloud variable
	 * 
	 * @param integer $argc
	 * @param array $argv
	 */
	public function execute($argc, $argv){
		$data = array();
		
		/* @var $tagCloudCollection Eezy_Note_Model_Mysql4_Tag_Cloud_Collection */
		$tagCloudCollection = Mage::getModel('note/tag_cloud')->getCollection();
		
		foreach($tagCloudCollection as $tagCloud){
			/* @var $tagCloud Eezy_Note_Model_Tag_Cloud */
			/* @var $tag Eezy_Note_Model_Tag */
			$tag = Mage::getModel('note/tag')->load($tagCloud->getTagId());
			$data[] = "<a href='{$tag->getUrl()}' style='font-size: {$tagCloud->getFontSize()}pt;'>{$tag->getName()}</a>";
		}
		
		/* @var $variable Mage_Core_Model_Variable */
        $variable = Mage::getModel('core/variable');
        $variable = $variable->loadByCode('tags-cloud');
        
        $variable->setHtmlValue(urlencode('<tags>' . implode('', $data) . '</tags>'));
        $variable->save();
	}
}