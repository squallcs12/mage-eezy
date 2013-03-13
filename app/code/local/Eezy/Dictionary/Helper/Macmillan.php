<?php

/**
 * 
 */
class Eezy_Dictionary_Helper_Macmillan extends Mage_Core_Helper_Abstract {

    public function getNewWord($w) {
        $word = Mage::getModel('dictionary/word');
        $word->setWord($w);
        $word->setKey('macmmillan');
        $word->setMean($this->getMeanFromLive($w));
        $word->save();
        return $word;
    }

    public function getMeanFromLive($w) {
        $response = $this->getEntry('american', $w);
        $content = $response->entryContent;
        $index = strpos($content, '<span class="DEFINITION">') + strlen('<span class="DEFINITION">');
        $index2 = strpos($content, '</span>', $index);
        $definition = substr($content, $index, $index2 - $index);
        return $definition;
    }

    /**
     * 
     * @param string $dicCode
     * @param string $entryId
     * @param string $format
     * @param int $page
     * @param int $start
     * @param int $limit
     * @return type
     */
    public function getEntry($dicCode, $entryId, $format = 'html', $page = 1, $start = 0, $limit = 25) {
        $url = "https://www.macmillandictionary.com/api/v1/dictionaries/$dicCode/entries/$entryId/?format=$format&page=$page&start=$start&limit=$limit";
        return $this->query($url);
    }

    /**
     * 
     * @return string
     */
    public function getCode() {
        return 'nN9Gpl8MIz1CCLS0yftWYGFcbPbMONaMVm7wEXNKQTW44iDxLSF37X1bhUdajT2U';
    }

    /**
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
