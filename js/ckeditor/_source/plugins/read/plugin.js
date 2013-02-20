/**
 * @file Special Character plugin
 */
CKEDITOR.plugins.add( 'read',
{
	// List of available localizations.
	availableLangs : { en:1 },

	init : function( editor )
	{
	   try{
		var pluginName = 'read',
			plugin = this;

		// Register the dialog.
		CKEDITOR.dialog.add( pluginName, this.path + 'dialogs/read.js' );

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
								CKEDITOR.tools.extend( editor.lang.read, plugin.langEntries[ langCode ] );
								editor.openDialog( pluginName );
							});
				},
				modes : { wysiwyg:1 },
				canUndo : false
			});
        
        CKEDITOR.lang.en.read = {toolbar:'Read the text',
        title:'Read the text',
        options:'Read text option'};
		// Register the toolbar button.
		editor.ui.addButton( 'read',
			{
				label : editor.lang.read.toolbar,
				command : pluginName
			});
        }
        catch(e){}
	}
} );
