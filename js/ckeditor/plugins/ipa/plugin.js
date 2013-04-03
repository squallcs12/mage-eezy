/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Special Character plugin
 */
CKEDITOR.plugins.add( 'ipa',
{
	// List of available localizations.
	availableLangs : { en:1 },

	init : function( editor )
	{
	   try{
		var pluginName = 'ipa',
			plugin = this;

		// Register the dialog.
		CKEDITOR.dialog.add( pluginName, this.path + 'dialogs/ipa.js' );

		editor.addCommand( pluginName,
			{
				exec : function()
				{
					var langCode = editor.langCode;
					langCode = plugin.availableLangs[ langCode ] ? langCode : 'en';
                    langCode = 'en'; //for now
					CKEDITOR.scriptLoader.load(
							CKEDITOR.getUrl( plugin.path + 'lang/' + langCode + '.js' ),
							function()
							{
								CKEDITOR.tools.extend( editor.lang.ipa, plugin.langEntries[ langCode ] );
								editor.openDialog( pluginName );
							});
				},
				modes : { wysiwyg:1 },
				canUndo : false
			});
        
        CKEDITOR.lang.en.ipa = {toolbar:'Phonetic', title:'Phonetic', options:'Phonetic Options'};
		editor.ui.addButton( 'ipa',
			{
				label : editor.lang.ipa.toolbar,
				command : pluginName
			});
        }
        catch(e){}
	}
} );

/**
  * The list of special characters visible in Special Character dialog.
  * @type Array
  * @example
  * config.ipas = [ '&quot;', '&rsquo;', [ '&custom;', 'Custom label' ] ];
  * config.ipas = config.ipas.concat( [ '&quot;', [ '&rsquo;', 'Custom label' ] ] );
  */
CKEDITOR.config.ipas =
	[
		'\u00F0', '\u026B', '\u014B', '\u02B3', '\u0279', '\u027E', '\u0283', 
        '\u03B8', 't\u032C', '\u02C8', '\u02CC', '\u02D0', '\u00E6', '\u0251', 
        '\u028C', '\u0259', '\u025A', '\u025C', '\u025B', '\u025D', '\u026A',
        '\u026A\u0308', '\u0252', '\u0254', '\u028A', '\u028A\u0308'
	];
