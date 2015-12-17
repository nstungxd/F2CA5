/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/


// PACKAGER_RENAME( CKEDITOR.config )
CKEDITOR.editorConfig = function( config )
{
    config.toolbar = 'MyToolBar';

    config.toolbar_MyToolBar =
    [
        ['Source','NewPage','Preview'],
        ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Scayt'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
        ['Image','Table','HorizontalRule','SpecialChar','PageBreak'],
        '/',
        ['Styles','Format','Font','FontSize','FontColor'],
        ['TextColor','BGColor'],
        ['Bold','Italic','Strike'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['Link','Unlink','Anchor']
    ];
    //config.stylesCombo_stylesSet = 'my_styles:http://192.168.32.150/B2B/css/style.js';
   //config.contentsCss = 'http://192.168.32.150/B2B/css/style.css';
};