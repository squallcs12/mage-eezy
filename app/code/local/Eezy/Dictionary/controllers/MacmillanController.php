<?php

class Eezy_Dictionary_MacmillanController extends Mage_Core_Controller_Front_Action {
	public function ajaxAction() {
		$wordSearch = $this -> getRequest() -> getParam('w');
		$wordModel = Mage::getModel('dictionary/word') -> load($wordSearch, 'word');
		if (!$wordModel -> getWord()) {
			$wordModel = Mage::helper('dictionary/macmillan') -> getNewWord($wordSearch);
		}
		$this -> getResponse() -> setBody(json_encode(array('word' => $wordModel -> getWord(), 'mean' => $wordModel -> getMean())));

	}

}
