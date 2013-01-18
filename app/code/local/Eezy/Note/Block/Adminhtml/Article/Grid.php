<?php
class Eezy_Note_Block_Adminhtml_Article_Grid extends Mage_Adminhtml_Block_Widget_Grid {
	public function __construct() {
		parent::__construct ();
		$this->setId ( 'articleGrid' );
		$this->setUseAjax ( true );
		$this->setDefaultSort ( 'id asc' );
		$this->setSaveParametersInSession ( true );
	}
	protected function _prepareCollection() {
		$collection = Mage::getModel ( 'note/article' )->getCollection ();
		
		$ids = $this->getHotArticleIds ();
		if (empty ( $ids ))
			$ids = array (
					0
			);
		$collection->addExpressionFieldToSelect ( 'in_hot', 'id IN ({{ids}})', array (
				'ids' => implode ( ',', $this->getHotArticleIds () )
		) );
		
		$this->setCollection ( $collection );
		
		return parent::_prepareCollection ();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Mage_Adminhtml_Block_Widget_Grid::_addColumnFilterToCollection()
	 */
	protected function _addColumnFilterToCollection($column) {
		// Set custom filter for in product flag
		if ($column->getId () == 'in_hot') {
			/* @var $collection Eezy_Note_Model_Mysql4_Article_Collection */
			$collection = $this->getCollection ();
			if ($column->getFilter ()->getValue ()) {
				$collection->addFieldToFilter ( 'id', array (
						'in' => $this->getHotArticleIds ()
				) );
			} else {
				if ($column->getFilter ()->getValue () === '0') {
					$collection->addFieldToFilter ( 'id', array (
							'nin' => $this->getHotArticleIds ()
					) );
				}
			}
		} else {
			parent::_addColumnFilterToCollection ( $column );
		}
		return $this;
	}
	
	protected function _prepareColumns() {
		
		$this->addColumn ( 'in_hot', array (
				'header' => 'Hot',
				'type' => 'options',
				'width' => '50px',
				'name' => 'in_hot',
				'values' => $this->getCloudTagIds (),
				'align' => 'center',
				'index' => 'in_hot',
				'options' => array (
						1 => 'Yes',
						0 => 'No' 
				) 
		) );
		
		$this->addColumn ( 'id', array (
				'header' => Mage::helper ( 'note' )->__ ( 'ID' ),
				'width' => '50px',
				'index' => 'id',
				'type' => 'number' 
		) );
		
		$this->addColumn ( 'title', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Title' ),
				'index' => 'title' 
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
		
		$this->addColumn ( 'action', array (
				'header' => Mage::helper ( 'note' )->__ ( 'Action' ),
				'width' => '100',
				'type' => 'action',
				'getter' => 'getId',
				'actions' => array (
						array (
								'caption' => Mage::helper ( 'customer' )->__ ( 'Edit' ),
								'url' => array (
										'base' => '*/*/edit' 
								),
								'field' => 'id' 
						) 
				),
				'filter' => false,
				'sortable' => false,
				'index' => 'stores',
				'is_system' => true 
		) );
		
		return parent::_prepareColumns ();
	}
	public function getRowUrl($row) {
		return $this->getUrl ( '*/*/edit', array (
				'id' => $row->getId () 
		) );
	}
	protected function _prepareMassaction() {
		$this->setMassactionIdField ( 'id' );
		$this->getMassactionBlock ()->setFormFieldName ( 'article' );
		
		$this->getMassactionBlock ()->addItem ( 'delete', array (
				'label' => $this->__ ( 'Delete' ),
				'url' => $this->getUrl ( '*/*/massDelete' ),
				'confirm' => $this->__ ( 'Are you sure?' ) 
		) );
		
		$this->getMassactionBlock ()->addItem ( 'active', array (
				'label' => $this->__ ( 'Active' ),
				'url' => $this->getUrl ( '*/*/massActive' ) 
		) );
		
		$this->getMassactionBlock ()->addItem ( 'deactive', array (
				'label' => $this->__ ( 'Deactive' ),
				'url' => $this->getUrl ( '*/*/massDeactive' ) 
		) );

		$this->getMassactionBlock ()->addItem ( 'hot', array (
				'label' => $this->__ ( 'Mark Hot' ),
				'url' => $this->getUrl ( '*/*/hot' )
		) );

		$this->getMassactionBlock ()->addItem ( 'unhot', array (
				'label' => $this->__ ( 'Unmark Hot' ),
				'url' => $this->getUrl ( '*/*/unhot' )
		) );
		
		return $this;
	}
	/**
	 * Get hot article IDs
	 * @return unknown
	 */
	public function getHotArticleIds() {
		$articleIds = $this->getArticleIds ();
		if (! is_array ( $articleIds )) {
			/* @var @$tagCloud Eezy_Note_Model_Tag_Cloud */
			$hotArticle = Mage::getModel ( 'note/article_hot' );
			$articleIds = $hotArticle->getCollection ()->getAllIds ();
			$this->setArticleIds ( $articleIds );
		}
		return $articleIds;
	}
}
