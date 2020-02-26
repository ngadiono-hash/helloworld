
/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
 CKEDITOR.editorConfig = function( config ) {
 	config.toolbarGroups = [
 		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
 		{ name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
 		{ name: 'forms', groups: [ 'forms' ] },
 		{ name: 'styles', groups: [ 'styles' ] },
 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
 		{ name: 'links', groups: [ 'links' ] },
 		{ name: 'insert', groups: [ 'insert' ] },
 		{ name: 'colors', groups: [ 'colors' ] },
 		{ name: 'others', groups: [ 'others' ] },
 		{ name: 'tools', groups: [ 'tools' ] },
 		{ name: 'about', groups: [ 'about' ] }
 	];
 	config.removeButtons = 'Save,NewPage,Print,PasteText,PasteFromWord,Scayt,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Strike,BidiLtr,BidiRtl,Language,Flash,FontSize,Blockquote,JustifyRight,Cut,Copy,Paste,PageBreak,Anchor,Undo,Redo,Replace,SelectAll,autoFormat,Sourcedialog,searchCode,CommentSelectedRange,UncommentSelectedRange,AutoComplete,Preview,Subscript,Superscript,Outdent,Indent,JustifyLeft,JustifyCenter,JustifyBlock,HorizontalRule,Smiley,SpecialChar,Iframe,Font,About';
 };
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	config.uiColor = '#393A3E';
	config.skin = 'moonocolor';
	config.extraPlugins = 'codeTag,imageuploader,codesnippet,wordcount,notification,sourcedialog,codemirror,stylescombo,bt_table';
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
	config.protectedSource.push( /<\/i>/g );
	config.fillEmptyBlocks = false;
	// config.fullPage = true,
	config.allowedContent = true;
	config.extraAllowedContent = 'html','head','style','script','body','img','input';
	for(var tag in CKEDITOR.dtd.$removeEmpty){
    CKEDITOR.dtd.$removeEmpty[tag] = false;
	}
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'about', groups: [ 'about' ] }
	];
	config.removeButtons = 'Save,NewPage,Print,PasteText,PasteFromWord,Scayt,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Strike,BidiLtr,BidiRtl,Language,Flash,FontSize,Blockquote,Cut,Copy,Paste,PageBreak,Anchor,Undo,Redo,Replace,SelectAll,autoFormat,Sourcedialog,searchCode,CommentSelectedRange,UncommentSelectedRange,AutoComplete,Preview,Subscript,Superscript,Outdent,Indent,HorizontalRule,Smiley,SpecialChar,Iframe,Font,About,JustifyLeft';
	
	// autogrow	
	// config.autoGrow_minHeight = 250;
	// config.autoGrow_maxHeight = 650;
	// config.autoGrow_onStartup = true;
	
	// codesnippet
	config.codeSnippet_theme = 'monokai_sublime';
	config.codeSnippet_languages = {
    	// javascript: 'JavaScript',
    	// php: 'PHP',
    	html: 'language-markup'
	};
	// size
	config.height = 440;

	// wordcount
	config.wordcount = {
    	showParagraphs: true, // Whether or not you want to show the Word Count
    	showWordCount: true, // Whether or not you want to show the Char Count
   	showCharCount: false, // Whether or not you want to count Spaces as Chars
    	countSpacesAsChars: false,	// Whether or not to include Html chars in the Char Count
    	countHTML: false, // Maximum allowed Word Count, -1 is default for unlimited
    	maxWordCount: -1, // Maximum allowed Char Count, -1 is default for unlimited
    	maxCharCount: -1, // Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
		filter: new CKEDITOR.htmlParser.filter({
		  elements: {
		      div: function( element ) {
		          if(element.attributes.class == 'mediaembed') {
		              return false;
		          }
		      }
		  }
		})
	};

}; // end