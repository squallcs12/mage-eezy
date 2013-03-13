<?php

/**
 * Dictionary word
 *
 * @method string getTitle()
 * @method Eezy_Note_Model_Article setTitle(string $value)
 * @method string getDescription()
 * @method Eezy_Note_Model_Article setDescription(string $value)
 * @method string getKeyUrl()
 * @method Eezy_Note_Model_Article setKeyUrl(string $value)
 * @method string getContent()
 * @method Eezy_Note_Model_Article setContent(string $value)
 * @method string getImage()
 * @method Eezy_Note_Model_Article setImage(string $value)
 * @method string getFullEntry()
 * @method Eezy_Note_Model_Article setFullEntry(string $value)
 *
 * @category    Eezy
 * @package     Eezy_Note
 * @author      Eezy Team <contact@eezy.vn>
 */
class Eezy_Dictionary_Model_Word extends Mage_Core_Model_Abstract {
	
	protected $_tag = null;
	
	public function _construct() {
		$this->_init ( 'dictionary/word', 'word_id' );
	}

    /**
     * Reset all model data
     *
     * @return Eezy_Dictionary_Model_Word
     */
    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
}
