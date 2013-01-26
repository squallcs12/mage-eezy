<?php
/**
 * @method string getName()
 * @method string getKeyUrl()
 */
class Eezy_Note_Model_Tag extends Mage_Core_Model_Abstract {
	protected $_tagTree = null;
	protected $_tagTreeHash = null;
	public function _construct() {
		$this->_init ( 'note/tag', 'id' );
	}
	/**
	 * Get tree for form input
	 * 
	 * @return array
	 */
	public function getTree() {
		if (! $this->_tagTree) {
			$tagCollection = Mage::getModel ( 'note/tag' )->getCollection ();
			$tagCollection->getSelect ()->order ( 'parent_id' )->order ( 'name' );
			$tags = $tagCollection->getItems ();
			$this->_tagTree = array ();
			$this->createTree ( $this->_tagTree, $tags, false, 0 );
		}
		return $this->_tagTree;
	}
	/**
	 * Get tree hash for grid view
	 * 
	 * @return array
	 */
	public function getTreeHash() {
		if (! $this->_tagTreeHash) {
			$this->_tagTreeHash = array ();
			foreach ( $this->getTree () as $info )
				$this->_tagTreeHash [$info ['value']] = $info ['label'];
		}
		return $this->_tagTreeHash;
	}
	
	/**
	 * Create tag tree
	 * 
	 * @param array $tree        	
	 * @param array $tags        	
	 * @param int $parentId        	
	 * @param int $level        	
	 */
	protected function createTree(&$tree, $tags, $parentId, $level) {
		if ($level == 0) {
			$tree [] = array (
					'value' => NULL,
					'label' => Mage::helper ( 'note' )->__ ( 'ROOT' ) 
			);
			
			$this->createTree ( $tree, $tags, 0, $level + 1 );
		} else {
			foreach ( $tags as $tag ) {
				if ($tag->getParentId () == $parentId) {
					$tree [] = array (
							'value' => $tag->getId (),
							'label' => ($level ? str_repeat ( '-', $level ) : '') . ' ' . $tag->getName () 
					);
					$this->createTree ( $tree, $tags, $tag->getId (), $level + 1 );
				}
			}
		}
	}
	/**
	 * (non-PHPdoc)
	 * @see Mage_Core_Model_Abstract::save()
	 */
	public function save() {
		if (! $this->getParentId ())
			$this->setParentId ( null );
		parent::save ();
	}
	
    /**
     * Get url to tag page
     * @return string
     */
	public function getUrl(){
		return Mage::getModel('core/url')->getUrl('tags/' . $this->getKeyUrl());
	}
}
