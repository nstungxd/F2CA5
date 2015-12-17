/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.toolbar_Basic =
    [
	    { name: 'clipboard', items: ['Paste', 'PasteText', 'PasteFromWord', '-', 'RemoveFormat', '-', 'Undo', 'Redo'] },
	    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
	    { name: 'insert', items: ['Image', 'Table', 'SpecialChar', '-', 'Link', 'Unlink', 'Anchor'] },
	    { name: 'document', items: ['Source'] },
	    '/',
	    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
	    { name: 'colors', items: ['TextColor'] },
	    { name: 'styles', items: ['Format', 'FontSize'] },
    ];

	config.filebrowserImageBrowseUrl = CKEDITOR.basePath + "ImageBrowser.aspx";
    config.filebrowserImageWindowWidth = 780;
    config.filebrowserImageWindowHeight = 720;
    config.filebrowserBrowseUrl = CKEDITOR.basePath + "LinkBrowser.aspx";
    config.filebrowserWindowWidth = 500;
    config.filebrowserWindowHeight = 650;

    config.enterMode = CKEDITOR.ENTER_BR;
    config.shiftEnterMode = CKEDITOR.ENTER_P;

};
