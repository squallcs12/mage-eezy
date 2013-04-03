<?php

/**
 * 
 */
class Eezy_Dictionary_Helper_Macmillan extends Mage_Core_Helper_Abstract {
	
	
	
	/**
	 * Get definition from entry content
	 * @param string $content
	 * @return string
	 */
	protected function _getDefninition($content){
		$index = strpos($content, '<DEFINITION>');
		if($index === false){
			return $this->getRefFromContent($content);
		}
		$index += strlen('<DEFINITION>');
        $index2 = strpos($content, '</DEFINITION>', $index);
        $definition = substr($content, $index, $index2 - $index);
        return strip_tags($definition);
	}
	

    public function getNewWord($w) {
        $word = Mage::getModel('dictionary/word');
        $word->setWord($w);
        $word->setKey('macmmillan');
        $word->setMean($this->getMeanFromEntry($w));
        if(!$word->getMean())
            $word->setMean($this->getMeanFromEntry(strtolower($w)));
        $word->save();
        return $word;
    }

	/**
	 * Get Mean of a word from API entry
	 * @param string $w word need to get mean
	 * @return string
	 */
    public function getMeanFromEntry($w) {
        $response = $this->getEntry($w);
		if($response->errorCode == 'InvalidEntryId'){
			return $this->getMeanFromBestMatch($w);
		}
        return $this->_getDefninition($response->entryContent);
    }
	
	/**
	 * Get Mean of a word from API best match
	 * @param string $w word need to get mean
	 * @return string
	 */
	public function getMeanFromBestMatch($w){
		$response = $this->getBestMatch($w);
		return $this->_getDefninition($response->entryContent);
	}
	
	/**
	 * Get REF from a entry content
	 * @param string $content
	 * @return string
	 */
	public function getRefFromContent($content){
		
		//get ref sentence
		$index = strpos($content, '<GREF-TYPE>') + strlen('<GREF-TYPE>');
		$index2 = strpos($content, '</GREF-TYPE>', $index);
		$ref = substr($content, $index, $index2 - $index);
		
		//get ref entry
		$index = strpos($content, '<GREF-ENTRY>') + strlen('<GREF-ENTRY>');
		$index2 = strpos($content, '</GREF-ENTRY>', $index);
		$entry = substr($content, $index, $index2 - $index);
		
		//combine return
		return strip_tags($ref) . strip_tags($entry);
	}

    /**
     * Get an entry from API
	 * 
     * @param string $dicCode
     * @param string $entryId
     * @param string $format
     * @param int $page
     * @param int $start
     * @param int $limit
     * @return type
     */
    public function getEntry($entryId, $dicCode = 'american', $format = 'xml', $page = 1, $start = 0, $limit = 25) {
        $url = "https://www.macmillandictionary.com/api/v1/dictionaries/$dicCode/entries/$entryId/?format=$format&page=$page&start=$start&limit=$limit";
        return $this->query($url);
    }
	
	public function getBestMatch($entryId, $dicCode = 'american', $format = 'xml', $page = 1, $start = 0, $limit = 25){
		$url = "https://www.macmillandictionary.com/api/v1/dictionaries/$dicCode/search/first/?q=$entryId&format=$format&page=$page&start=$start&limit=$limit";
        return $this->query($url);
	}

    /**
     * Get API code
     * @return string
     */
    public function getCode() {
        return 'nN9Gpl8MIz1CCLS0yftWYGFcbPbMONaMVm7wEXNKQTW44iDxLSF37X1bhUdajT2U';
    }

    /**
     * Send query to API and get json_decoded content
	 * 
     * @param string $url
     * @return object
     */
    public function query($url) {
        $client = new Zend_Http_Client($url);
        $client->setHeaders('accessKey', $this->getCode());
        $response = $client->request();
        return json_decode($response->getBody());
    }

}
