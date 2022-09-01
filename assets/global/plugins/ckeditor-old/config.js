/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' /*, groups: [ 'colorbutton', 'floatpanel', 'panel', 'panelbutton', 'button', 'colordialog','dialog','dialogui' ]*/},
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.extraPlugins = 'colorbutton';
	//config.colorButton_colors = 'CF5D4E,454545,FFF,CCC,DDD,CCEAEE,66AB16';
	//config.extraPlugins = 'colorbutton';
	//config.extraPlugins = 'floatpanel';
	//config.extraPlugins = 'panel';
	//config.extraPlugins = 'panelbutton';
	//config.extraPlugins = 'button';
	//config.extraPlugins = 'colordialog';
	//config.extraPlugins = 'dialog';
	//config.extraPlugins = 'dialogui';
	config.allowedContent = true;
	//config.extraAllowedContent = 'span(*)';
	config.colorButton_foreStyle = {
	    element: 'font',
	    attributes: { 'color': '#(color)' }
	};

	config.colorButton_backStyle = {
	    element: 'font',
	    styles: { 'background-color': '#(color)' }
	};
};
