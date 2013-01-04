<?php

class Eezy_Note_Model_Tag extends Mage_Core_Model_Abstract{
	
	protected $_tagTree = null;
	protected $_tagTreeHash = null;
	
	public function _construct(){
		$this->_init('note/tag', 'id');
	}
	
	public function getTree() {
		if(!$this->_tagTree){
			$tagCollection = Mage::getModel('note/tag') -> getCollection();
			$tagCollection -> getSelect() -> order('parent_id') -> order('name');
			$tags = $tagCollection -> getItems();
			$this->_tagTree = array();
			$this -> createTree($this->_tagTree, $tags, false, 0);
		}
		return $this->_tagTree;
	}
	
	public function getTreeHash(){
		if(!$this->_tagTreeHash){
			$this->_tagTreeHash = array();
			foreach($this->getTree() as $info)
				$this->_tagTreeHash[$info['value']] = $info['label'];
		}
		return $this->_tagTreeHash;
	}

	public function createTree(&$tree, $tags, $parentId, $level) {
		foreach ($tags as $tag) {
			if ($tag -> getParentId() == $parentId) {
				$tree[] = array('value' => $tag -> getId(), 'label' => ($level ? str_repeat('-', $level) : '') . ' ' . $tag -> getName());
				$this -> createTree($tree, $tags, $tag -> getId(), $level + 1);
			}
		}
	}
}
