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
					var mySelection = editor.getSelection();
                    
                    ranges = mySelection.getRanges();
                    if(ranges.length){
                        range = ranges[0];
                        mySelection.selectRanges([range]);
                        
                        if (CKEDITOR.env.ie) {
                            mySelection.unlock(true);
                            selectedText = mySelection.getNative().createRange().text;
                        } else {
                            selectedText = mySelection.getNative();
                        }
                        
                        selectedText = '[read]' + selectedText + '[/read]';
                        
                        
                        var span = editor.document.createElement( 'span' );
            			span.setHtml( selectedText );
            			editor.insertText( span.getText() );
                        
                        mySelection.selectRanges([range]);
                    } else {
                        selectedText = '[read][/read]';
                        
                        var span = editor.document.createElement( 'span' );
            			span.setHtml( selectedText );
            			editor.insertText( span.getText() );
                                            
                    }
				},
				modes : { wysiwyg:1 }
			});
        
        CKEDITOR.lang.en.read = {toolbar:'Read the text',
        title:'Read the text',
        options:'Read text option',insert : 'Insert',
    play : 'Play'};
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
