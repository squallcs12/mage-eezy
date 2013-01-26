<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* @var $installer Mage_Customer_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("CREATE TABLE IF NOT EXISTS `{$installer->getTable('eezy_note_article')}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `full_entry` text COLLATE utf8_unicode_ci,
  `order_number` int(11) unsigned DEFAULT NULL COMMENT 'Use this number to custom order of article',
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `eezy_note_article_hot`
--

CREATE TABLE IF NOT EXISTS `{$installer->getTable('eezy_note_article_hot')}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `article_id_UNIQUE` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `eezy_note_article_tag`
--

CREATE TABLE IF NOT EXISTS `{$installer->getTable('eezy_note_article_tag')}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `EEZY_NOTE_ARTICLE_TAG_ARTICLE_ID_idx` (`article_id`),
  KEY `EEZY_NOTE_ARTICLE_TAG_TAG_ID_idx` (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `eezy_note_tag`
--

CREATE TABLE IF NOT EXISTS `{$installer->getTable('eezy_note_tag')}` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key_url` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` tinytext COLLATE utf8_unicode_ci,
  `status` tinyint(4) DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `EEZY_NOT_TAG_PARENT_ID_idx` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `eezy_note_tag_cloud`
--

CREATE TABLE IF NOT EXISTS `{$installer->getTable('eezy_note_tag_cloud')}` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `font_size` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eezy_note_article_tag`
--
ALTER TABLE `{$installer->getTable('eezy_note_article_tag')}`
  ADD CONSTRAINT `EEZY_NOTE_ARTICLE_TAG_ARTICLE_ID` FOREIGN KEY (`article_id`) REFERENCES `{$installer->getTable('eezy_note_article')}` (`id`),
  ADD CONSTRAINT `EEZY_NOTE_ARTICLE_TAG_TAG_ID` FOREIGN KEY (`tag_id`) REFERENCES `{$installer->getTable('eezy_note_tag')}` (`id`);

--
-- Constraints for table `eezy_note_tag`
--
ALTER TABLE `{$installer->getTable('eezy_note_tag')}`
  ADD CONSTRAINT `EEZY_NOT_TAG_PARENT_ID` FOREIGN KEY (`parent_id`) REFERENCES `{$installer->getTable('eezy_note_tag')}` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;");

$installer->endSetup();