<?php

class Eezy_Dictionary_Helper_Data extends Mage_Core_Helper_Abstract{
	public function getNewWord($w){
        $word = Mage::getModel('dictionary/word');
        $word->setWord($w);
        $word->setKey('macmmillan');
        $word->setMean($this->getMeanFromLive($w));
        $word->save();
        return $word;
    }
    
    public function getMeanFromLive($w){
        
    }
}
