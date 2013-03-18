<?php

/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * 
 * @author Squall
 *
 * @method string getSubject()
 * @method Eezy_QA_Model_Question setSubject(string $value)
 * @method string getUrlKey()
 * @method Eezy_QA_Model_Question setUrlKey(string $value)
 * @method string getContent()
 * @method Eezy_QA_Model_Question setContent(string $value)
 * @method string getSubContent()
 * @method Eezy_QA_Model_Question setSubContent(string $value)
 * @method string getCustomerId()
 * @method Eezy_QA_Model_Question setCustomerId(string $value)
 * @method int getViewCount()
 * @method Eezy_QA_Model_Question setViewCount(int $value)
 * @method int getVoteCount()
 * @method Eezy_QA_Model_Question setVoteCount(int $value)
 * @method int getAnswerCount()
 * @method Eezy_QA_Model_Question setAnswerCount(int $value)
 * @method int getFavoriteCount()
 * @method Eezy_QA_Model_Question setFavoriteCount(int $value)
 * @method int getCommentCount()
 * @method Eezy_QA_Model_Question setCommentCount(int $value)
 * @method int getIsBounty()
 * @method Eezy_QA_Model_Question setIsBounty(bool $value)
 * @method int getIsClosed()
 * @method Eezy_QA_Model_Question getIsClosed(bool $value)
 * @method int getIsdeleted()
 * @method Eezy_QA_Model_Question setIsdeleted(bool $value)
 * @method int getHasRightAnswer()
 * @method Eezy_QA_Model_Question setHasRightAnswer(bool $value)
 * 
 * @method bool isBounty()
 * @method bool isClosed()
 * @method bool isDeleted()
 */

class Eezy_QA_Model_Question extends Eezy_QA_Model_Abstract{
    
    protected $_eventObject = 'eezy_qa_question';
    protected $_eventPrefix = 'eezy_qa_question';
    
    public function __construct() {
        parent::__construct();
        $this->_init('qa/question');
    }
}