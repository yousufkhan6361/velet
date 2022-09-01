/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
// CKEDITOR.replace( 'editor', {
//   extraPlugins: 'imageuploader'
//   config.extraPlugins = 'imageuploader';
// });


// CKEDITOR.replace( 'editor', {
//   extraPlugins: 'imageuploader',
//    filebrowserImageBrowseUrl : '<?= base_url()?>assets/ckeditor/plugins/imageuploader/imgbrowser.php?CKEditor=textarea&CKEditorFuncNum=1&langCode=en-gb'
  
//    });


CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		// { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
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
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	// config.removeButtons = 'Underline,Subscript,Superscript,';
	//config.removeButtons = 'Underline,Subscript,Superscript,Paste,PasteText,PasteFromWord,Source';

	config.removeButtons = 'Underline,Subscript,Superscript,Paste,PasteText,PasteFromWord';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced;';
	//config.extraPlugins = 'imageuploader';
	config.extraPlugins = 'image';
    config.allowedContent = true;
    
    config.extraPlugins = 'justify';
	config.extraPlugins = 'pastefromword';
	config.extraPlugins = 'pastetools';
};
