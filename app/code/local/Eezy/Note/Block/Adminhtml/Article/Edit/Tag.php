<?php
class Eezy_Note_Block_Adminhtml_Article_Edit_Tag extends Mage_Adminhtml_Block_Widget_Grid {
	
	public function __construct()
	{
		parent::__construct();
		$this->setId('article_edit_tag');
		$this->setDefaultSort('name');
		$this->setUseAjax(true);
		if ($this->_getArticle() && $this->_getArticle()->getId()) {
			$this->setDefaultFilter(array('in_tags' => 1));
		}
	}
	/**
	 * Prepare collection
	 *
	 * @return Mage_Adminhtml_Block_Widget_Grid
	 */
	protected function _prepareCollection() {
		$collection = Mage::getModel ( 'note/tag' )->getCollection ();
		
		$this->setCollection ( $collection );
		return parent::_prepareCollection ();
	}
	
	public function getGridUrl()
	{
		return $this->getUrl('*/*/tagAjax', array('_current' => true));
	}
	
	/**
	 * Add filter
	 *
	 * @param object $column
	 * @return Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Related
	 */
	protected function _addColumnFilterToCollection($column)
	{
		// Set custom filter for in product flag
		if ($column->getId() == 'in_tags') {
			$tagIds = $this->getArticleTags();
			
			if (empty($tagIds)) {
				$tagIds = 0;
			}
			if ($column->getFilter()->getValue()) {
				$this->getCollection()->addFieldToFilter('id', array('in' => $tagIds));
			} else {
				if($tagIds) {
					$this->getCollection()->addFieldToFilter('id', array('nin' => $tagIds));
				}
			}
		} else {
			parent::_addColumnFilterToCollection($column);
		}
		return $this;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Grid::_prepareColumns()
	 */
	protected function _prepareColumns() {
		$this->addColumn('in_tags', array(
				'header_css_class'  => 'a-center',
				'type'              => 'checkbox',
				'name'              => 'in_tags',
				'values'            => $this->getArticleTags(),
				'align'             => 'center',
				'index'             => 'id'
		));
		
		$this->addColumn ( '_id', array (
				'header' => Mage::helper ( 'note' )->__ ( 'ID' ),
				'width' => '50px',
				'index' => 'id',
				'type' => 'number' 
		) );
		
		$this->addColumn ( '_name', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Name' ),
				'index' => 'name' 
		) );
		$this->addColumn ( '_key_url', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Key URL' ),
				'width' => '150',
				'index' => 'key_url' 
		) );
		$this->addColumn ( '_short_description', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Short Description' ),
				'width' => '30',
				'index' => 'short_description' 
		) );
		
		$this->addColumn ( '_status', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Status' ),
				'width' => '100',
				'index' => 'status',
				'type' => 'options',
				'options' => array (
						1 => 'Active',
						0 => 'Inactive' 
				) 
		) );
		
		$this->addColumn ( '_parent_id', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Parent' ),
				'width' => '100',
				'index' => 'parent_id',
				'type' => 'options',
				'options' => Mage::getSingleton ( 'note/tag' )->getTreeHash () 
		) );
		
		return parent::_prepareColumns ();
	}
	
	public function getArticleTags(){
		return $this->_getArticleTags();
	}
	
	protected function _getArticleTags(){
		$links = array();
		foreach (Mage::registry('note_article')->getTagLinks() as $link) {
			$links[] = $link->getTagId();
		}
		return $links;
	}
	
	public function getSelectedTags(){
		return $this->_getArticleTags();
	}
	
	protected function _getArticle(){
		return Mage::registry('note_article');
	}
}