/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    
    config.entities_latin = false;
    config.baseHref = BASE_URL + 'js/ckeditor';
    config.toolbar = 'MyToolbar';
    config.extraPlugins = 'ipa,read';
    config.removePlugins = 'elementspath';
	config.toolbar_MyToolbar =
	[
        { name: 'common', items : ['ipa', 'read', 'Blockquote']}, 
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule',/*'Smiley', */'SpecialChar', 'PageBreak' ] },
		{ name: 'styles', items : ['Format' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] }
	];
};
