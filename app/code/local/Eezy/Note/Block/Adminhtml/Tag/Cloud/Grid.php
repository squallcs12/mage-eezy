<?php
class Eezy_Note_Block_Adminhtml_Tag_Cloud_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	public function __construct() {
		parent::__construct ();
		$this->setId ( 'tagGrid' );
		$this->setUseAjax ( true );
		$this->setDefaultSort ( 'id asc' );
		$this->setSaveParametersInSession ( true );
		$this->setDefaultFilter ( array (
				'in_tags' => 1 
		) );
	}
	
	/**
	 * Prepare collection
	 *
	 * @return Mage_Adminhtml_Block_Widget_Grid
	 */
	protected function _prepareCollection() {
		
		/* @var $collection Eezy_Note_Model_Mysql4_Tag_Cloud_Collection */
		$collection = Mage::getModel ( 'note/tag' )->getCollection ();
		$collection->getSelect()->joinLeft(array('tag_cloud' => $collection->getTable('note/tag_cloud')), 'main_table.id = tag_id');
		$this->setCollection ( $collection );
		return parent::_prepareCollection ();
	}
	
	/**
	 * Retrieve selected related products
	 *
	 * @return array
	 */
	protected function _getSelectedProducts() {
		$products = $this->getProductsRelated ();
		if (! is_array ( $products )) {
			$products = array_keys ( $this->getSelectedRelatedProducts () );
		}
		return $products;
	}
	public function getCloudTagIds() {
		$tagIds = $this->getTagIds ();
		if (! is_array ( $tagIds )) {
			/* @var @$tagCloud Eezy_Note_Model_Tag_Cloud */
			$tagCloud = Mage::getSingleton ( 'note/tag_cloud' );
			$tagIds = $tagCloud->getCollection ()->getAllIds ();
			$this->setTagIds ( $tagIds );
		}
		return $tagIds;
	}
	protected function _addColumnFilterToCollection($column) {
		// Set custom filter for in product flag
		if ($column->getId () == 'in_tags') {
			$tagIds = $this->getCloudTagIds ();
			if (empty ( $tagIds )) {
				$tagIds = 0;
			}
			if ($column->getFilter ()->getValue ()) {
				$this->getCollection ()->addFieldToFilter ( 'id', array (
						'in' => $tagIds 
				) );
			} else {
				if ($tagIds) {
					$this->getCollection ()->addFieldToFilter ( 'id', array (
							'nin' => $tagIds 
					) );
				}
			}
		} else {
			parent::_addColumnFilterToCollection ( $column );
		}
		return $this;
	}
	protected function _prepareColumns() {
		$this->addColumn ( 'in_tags', array (
				'header_css_class' => 'a-center',
				'type' => 'checkbox',
				'name' => 'in_tags',
				'values' => $this->getCloudTagIds (),
				'align' => 'center',
				'index' => 'id' 
		) );
		

		$this->addColumn ( 'name', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Name' ),
				'index' => 'name'
		) );

		$this->addColumn ( 'style', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Style' ),
				'index' => 'style'
		) );
		
		$this->addColumn ( 'status', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Status' ),
				'width' => '100',
				'index' => 'status',
				'type' => 'options',
				'options' => array (
						1 => 'Active',
						0 => 'Inactive' 
				) 
		) );
		
		return parent::_prepareColumns ();
	}
	public function getGridUrl() {
		return $this->getData ( 'grid_url' ) ? $this->getData ( 'grid_url' ) : $this->getUrl ( '*/*/grid', array (
				'_current' => true 
		) );
	}
}
