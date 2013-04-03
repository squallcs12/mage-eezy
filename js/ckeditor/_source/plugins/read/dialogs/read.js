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
		var target, value;
		if ( evt.data )
			target = evt.data.getTarget();
		else
			target = new CKEDITOR.dom.element( evt );

		if ( target.getName() == 'a' && ( value = target.getChild( 0 ).getHtml() ) )
		{
			target.removeClass( "cke_light_background" );

			// We must use "insertText" here to keep text styled.
			var span = editor.document.createElement( 'span' );
			span.setHtml( value );
			editor.insertText( span.getText() );
		}
	};

	var onClick = CKEDITOR.tools.addFunction( onChoice );

	var focusedNode;

	var onFocus = function( evt, target )
	{
		var value;
		target = target || evt.data.getTarget();

		if ( target.getName() == 'span' )
			target = target.getParent();

		if ( target.getName() == 'a' && ( value = target.getChild( 0 ).getHtml() ) )
		{
			// Trigger blur manually if there is focused node.
			if ( focusedNode )
				onBlur( null, focusedNode );

			var htmlPreview = dialog.getContentElement( 'info', 'htmlPreview' ).getElement();

			dialog.getContentElement( 'info', 'charPreview' ).getElement().setHtml( value );
			htmlPreview.setHtml( CKEDITOR.tools.htmlEncode( value ) );
			target.getParent().addClass( "cke_light_background" );

			// Memorize focused node.
			focusedNode = target;
		}
	};

	var onBlur = function( evt, target )
	{
		target = target || evt.data.getTarget();

		if ( target.getName() == 'span' )
			target = target.getParent();

		if ( target.getName() == 'a' )
		{
			dialog.getContentElement( 'info', 'charPreview' ).getElement().setHtml( '&nbsp;' );
			dialog.getContentElement( 'info', 'htmlPreview' ).getElement().setHtml( '&nbsp;' );
			target.getParent().removeClass( "cke_light_background" );

			focusedNode = undefined;
		}
	};

	var onKeydown = CKEDITOR.tools.addFunction( function( ev )
	{
		ev = new CKEDITOR.dom.event( ev );

		// Get an Anchor element.
		var element = ev.getTarget();
		var relative, nodeToMove;
		var keystroke = ev.getKeystroke(),
			rtl = editor.lang.dir == 'rtl';

		switch ( keystroke )
		{
			// UP-ARROW
			case 38 :
				// relative is TR
				if ( ( relative = element.getParent().getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( [element.getParent().getIndex(), 0] );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
				}
				ev.preventDefault();
				break;
			// DOWN-ARROW
			case 40 :
				// relative is TR
				if ( ( relative = element.getParent().getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( [ element.getParent().getIndex(), 0 ] );
					if ( nodeToMove && nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
					}
				}
				ev.preventDefault();
				break;
			// SPACE
			// ENTER is already handled as onClick
			case 32 :
				onChoice( { data: ev } );
				ev.preventDefault();
				break;

			// RIGHT-ARROW
			case rtl ? 37 : 39 :
			// TAB
			case 9 :
				// relative is TD
				if ( ( relative = element.getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( 0 );
					if ( nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
						ev.preventDefault( true );
					}
					else
						onBlur( null, element );
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getNext() ) )
				{
					nodeToMove = relative.getChild( [ 0, 0 ] );
					if ( nodeToMove && nodeToMove.type == 1 )
					{
						nodeToMove.focus();
						onBlur( null, element );
						onFocus( null, nodeToMove );
						ev.preventDefault( true );
					}
					else
						onBlur( null, element );
				}
				break;

			// LEFT-ARROW
			case rtl ? 39 : 37 :
			// SHIFT + TAB
			case CKEDITOR.SHIFT + 9 :
				// relative is TD
				if ( ( relative = element.getParent().getPrevious() ) )
				{
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
					ev.preventDefault( true );
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getPrevious() ) )
				{
					nodeToMove = relative.getLast().getChild( 0 );
					nodeToMove.focus();
					onBlur( null, element );
					onFocus( null, nodeToMove );
					ev.preventDefault( true );
				}
				else
					onBlur( null, element );
				break;
			default :
				// Do not stop not handled events.
				return;
		}
	});

	return {
		title : lang.title,
		minWidth : 430,
		minHeight : 280,
		buttons : [ CKEDITOR.dialog.cancelButton ],
		charColumns : 6,
		onLoad :  function()
		{
			html = []
            html.push('<textarea></textarea>');
			this.getContentElement( 'info', 'charContainer' ).getElement().setHtml( html.join( '' ) );
		},
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
						widths : [ '320px', '90px' ],
						children :
						[
							{
								type : 'html',
								id : 'charContainer',
								html : '',
								onMouseover : onFocus,
								onMouseout : onBlur,
								focus : function()
								{
									var firstChar = this.getElement().getElementsByTag( 'a' ).getItem( 0 );
									setTimeout( function()
									{
										firstChar.focus();
										onFocus( null, firstChar );
									}, 0 );
								},
								onShow : function()
								{
									var firstChar = this.getElement().getChild( [ 0, 0, 0, 0, 0 ] );
									setTimeout( function()
										{
											firstChar.focus();
											onFocus( null, firstChar );
										}, 0 );
								},
								onLoad : function( event )
								{
									dialog = event.sender;
								}
							},
							{
								type : 'hbox',
								align : 'top',
								widths : [ '100%' ],
								children :
								[
									{
										type : 'vbox',
										align : 'top',
										children :
										[
											{
												type : 'html',
												html : '<div></div>'
											},
											{
												type : 'html',
												id : 'charPreview',
												className : 'cke_dark_background',
												style : 'border:1px solid #eeeeee;font-size:28px;height:40px;width:70px;padding-top:9px;font-family:\'Microsoft Sans Serif\',Arial,Helvetica,Verdana;text-align:center;',
												html : '<div>&nbsp;</div>'
											},
											{
												type : 'html',
												id : 'htmlPreview',
												className : 'cke_dark_background',
												style : 'border:1px solid #eeeeee;font-size:14px;height:20px;width:70px;padding-top:2px;font-family:\'Microsoft Sans Serif\',Arial,Helvetica,Verdana;text-align:center;',
												html : '<div>&nbsp;</div>'
											}
										]
									}
								]
							}
						]
					}
				]
			}
		]
	};
} );
