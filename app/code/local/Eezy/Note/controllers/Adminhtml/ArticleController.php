<?php
class Eezy_Note_Adminhtml_ArticleController extends Mage_Adminhtml_Controller_Action {
	public function newAction() {
		$this->loadLayout ();
		
		$this->getLayout ()->getBlock ( 'head' )->setCanLoadTinyMce ( true );
		
		$this->renderLayout ();
	}
	
	/**
	 * Load article along with request
	 * @return Eezy_Note_Adminhtml_ArticleController
	 */
	protected function _loadArticle() {
		$id = $this->getRequest ()->getParam ( 'id' );
		$article = Mage::getModel ( 'note/article' )->load ( $id );
		Mage::register ( 'note_article', $article );
		return $this;
	}
	
	
	public function editAction() {
		$this->_loadArticle ();
		$this->loadLayout ();
		$this->getLayout ()->getBlock ( 'head' )->setCanLoadTinyMce ( true );
		$this->renderLayout ();
	}
	public function indexAction() {
		if ($this->getRequest ()->getQuery ( 'ajax' )) {
			$this->_forward ( 'grid' );
			return;
		}
		$this->loadLayout ()->renderLayout ();
	}
	public function gridAction() {
		$this->loadLayout ();
		$this->renderLayout ();
	}
	
	/**
	 * Upload image/file and update post data
	 */
	public function upload() {
		$request = $this->getRequest ();
		
		$path = Mage::getBaseDir ( 'media' ) . DS . 'article' . DS;
		if (isset ( $_FILES ) && count ( $_FILES )) {
			foreach ( $_FILES as $formKey => $fileInfo ) {
				$postData = $request->getPost ( $formKey );
				if (is_array ( $postData ) && ! empty ( $postData ['delete'] )) {
					$request->setPost ( $formKey, NULL );
				} elseif ($fileInfo ['error']) {
					$request->setPost ( $formKey, $postData ['value'] );
				} elseif (file_exists ( $fileInfo ['tmp_name'] )) {
					$uploader = new Varien_File_Uploader ( $formKey );
					$uploader->setAllowedExtensions ( array (
							'jpg',
							'jpeg',
							'gif',
							'png' 
					) );
					
					$uploader->setAllowRenameFiles ( false );
					$uploader->setFilesDispersion ( false );
					$uploader->save ( $path, $fileInfo ['name'] );
					
					$request->setPost ( $formKey, 'article/' . $fileInfo ['name'] );
				}
			}
		}
	}
	public function saveAction() {
		if ($this->getRequest ()->getPost ()) {
			try {
				$this->upload ();
				
				$postData = $this->getRequest ()->getPost ();
				
				$this->_loadArticle();
				$noteModel = Mage::registry('note_article');
				var_dump($postData);
				$noteModel->setData ( $postData )->setId ( $this->getRequest ()->getParam ( 'id' ) )->save ();
				
				if(isset($postData['tags']))
					$noteModel->saveTag(explode('&', $postData['tags']));
				
				Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Article was successfully saved' ) );
				Mage::getSingleton ( 'adminhtml/session' )->setNoteArticleData ( false );
				
				$this->_redirect ( '*/*/' );
				return;
			} catch ( Exception $e ) {
				Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
				Mage::getSingleton ( 'adminhtml/session' )->setNoteArticleData ( $this->getRequest ()->getPost () );
				$this->_redirect ( '*/*/edit', array (
						'id' => $this->getRequest ()->getParam ( 'id' ) 
				) );
				return;
			}
		}
		$this->_redirect ( '*/*/' );
	}
	public function deleteAction() {
		try {
			$id = $this->getRequest ()->getParam ( 'id' );
			$article = Mage::getModel ( 'note/article' )->load ( $id );
			$article->delete ();
			
			Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Article "' . $article->getTitle () . '" was deleted.' ) );
		} catch ( Exception $e ) {
			Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
		}
		$this->_redirect ( '*/*/index' );
	}
	public function massDeleteAction() {
		$quotesIds = $this->getRequest ()->getParam ( 'article' );
		if (! is_array ( $quotesIds )) {
			Mage::getSingleton ( 'adminhtml/session' )->addError ( Mage::helper ( 'adminhtml' )->__ ( 'Please select quote(s).' ) );
		} else {
			try {
				$quote = Mage::getModel ( 'note/article' );
				foreach ( $quotesIds as $quoteId ) {
					$quote->reset ()->load ( $quoteId )->delete ();
				}
				Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Total of %d record(s) were deleted.', count ( $quotesIds ) ) );
			} catch ( Exception $e ) {
				Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
			}
		}
		
		$this->_redirect ( '*/*/index' );
	}
	public function massActiveAction() {
		$quotesIds = $this->getRequest ()->getParam ( 'article' );
		if (! is_array ( $quotesIds )) {
			Mage::getSingleton ( 'adminhtml/session' )->addError ( Mage::helper ( 'adminhtml' )->__ ( 'Please select quote(s).' ) );
		} else {
			try {
				$quote = Mage::getModel ( 'note/article' );
				foreach ( $quotesIds as $quoteId ) {
					$quote->reset ()->load ( $quoteId )->setStatus ( 1 )->save ();
				}
				Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Total of %d record(s) were deleted.', count ( $quotesIds ) ) );
			} catch ( Exception $e ) {
				Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
			}
		}
		
		$this->_redirect ( '*/*/index' );
	}
	public function massDeactiveAction() {
		$quotesIds = $this->getRequest ()->getParam ( 'article' );
		if (! is_array ( $quotesIds )) {
			Mage::getSingleton ( 'adminhtml/session' )->addError ( Mage::helper ( 'adminhtml' )->__ ( 'Please select quote(s).' ) );
		} else {
			try {
				$quote = Mage::getModel ( 'note/article' );
				foreach ( $quotesIds as $quoteId ) {
					$quote->reset ()->load ( $quoteId )->setStatus ( 0 )->save ();
				}
				Mage::getSingleton ( 'adminhtml/session' )->addSuccess ( Mage::helper ( 'adminhtml' )->__ ( 'Total of %d record(s) were deleted.', count ( $quotesIds ) ) );
			} catch ( Exception $e ) {
				Mage::getSingleton ( 'adminhtml/session' )->addError ( $e->getMessage () );
			}
		}
		
		$this->_redirect ( '*/*/index' );
	}
	public function tagAction() {
		$this->_loadArticle();
		$this->loadLayout ();
		$this->renderLayout ();
	}
	
	public function tagAjaxAction() {
		$this->_loadArticle();
		$this->loadLayout ();
		$this->renderLayout ();
	}
}
