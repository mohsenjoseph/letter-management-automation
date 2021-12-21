/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'fa';
	//config.uiColor = '#AADC6E';
    config.contentsCss = '/ckeditor/fonts/fonts.css';
    config.font_names = 'tahoma/tahoma;';
    config.font_names = 'B Nazanin/B Nazanin;'+ config.font_names;
    config.font_names = 'B Zar/B Zar;'+ config.font_names;
    config.font_names = 'B Yekan/B Yekan;'+ config.font_names;
    config.font_names = 'B Lotus/B Lotus;'+ config.font_names;
    config.resize_enabled= false;
    config.contentsLangDirection= 'rtl';
    config.font_defaultLabel= 'B Nazanin';
    config.fontSize='36pt';
};
