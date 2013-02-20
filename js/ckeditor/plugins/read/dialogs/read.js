/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.dialog.add( 'read', function( editor )
{
	/**
	 * Simulate "this" of a dialog for non-dialog events.
	 * @type {CKEDITOR.dialog}
	 */
	var dialog,
		lang = editor.lang.read;

	var onChoice = function( evt )
	{
		
	};

	var onClick = CKEDITOR.tools.addFunction( onChoice );

	var focusedNode;

	var onFocus = function( evt, target )
	{
		
	};

	var onBlur = function( evt, target )
	{
		
	};

	var onKeydown = CKEDITOR.tools.addFunction( function( ev )
	{
		
	});

	return {
		title : lang.title,
		minWidth : 430,
		minHeight : 100,
		buttons : [ CKEDITOR.dialog.cancelButton, (function()
			{
				var retval = function( editor, override )
				{
					override = override || {};
					return CKEDITOR.tools.extend( {
						id : 'play',
						type : 'button',
						label : editor.lang.read.play,
						'class' : 'cke_dialog_ui_button_ok',
						onClick : function( evt )
						{
							
						}
					}, override, true );
				};
				retval.type = 'button';
				retval.override = function( override )
				{
					return CKEDITOR.tools.extend( function( editor ){ return retval( editor, override ); },
							{ type : 'button' }, true );
				};
				return retval;
			})(), (function()
			{
				var retval = function( editor, override )
				{
					override = override || {};
					return CKEDITOR.tools.extend( {
						id : 'insert',
						type : 'button',
						label : editor.lang.read.insert,
						'class' : 'cke_dialog_ui_button_ok',
						onClick : function( evt )
						{
							
						}
					}, override, true );
				};
				retval.type = 'button';
				retval.override = function( override )
				{
					return CKEDITOR.tools.extend( function( editor ){ return retval( editor, override ); },
							{ type : 'button' }, true );
				};
				return retval;
			})()],
		charColumns : 6,
		contents : [
			{
				id : 'info',
				label : editor.lang.common.generalTab,
				title : editor.lang.common.generalTab,
				padding : 0,
				align : 'top',
				elements : [
					{
						type : 'hbox',
						align : 'top',
						widths : [ '410px'],
						children :
						[
							{
								type : 'html',
								id : 'charContainer',
								html : '<textarea id="textRead" style="width: 100%; height: 100px; background: white;"></textarea>'
							}
						]
					}
				]
			}
		]
	};
} );
