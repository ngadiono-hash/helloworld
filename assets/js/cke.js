CKEDITOR.editorConfig = function( config ) {
	config.uiColor = '#393A3E';
	config.skin = 'moonocolor';
	config.extraPlugins = 'codeTag,imageuploader,codesnippet,wordcount,notification,sourcedialog,codemirror,stylescombo,bt_table';
	config.protectedSource.push( /<i class[\s\S]*?\>/g );
	config.protectedSource.push( /<\/i>/g );
	config.fillEmptyBlocks = false;
	config.height = 200;
	config.allowedContent = true;
	config.extraAllowedContent = 'html','head','style','script','body','img','input';
	for(var tag in CKEDITOR.dtd.$removeEmpty){
    CKEDITOR.dtd.$removeEmpty[tag] = false;
	}
	config.codeSnippet_theme = 'monokai_sublime';
	config.codeSnippet_languages = { html: 'HTML', javascript: 'JavaScript' };

	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'searchCode,autoFormat,CommentSelectedRange,UncommentSelectedRange,AutoComplete,NewPage,Save,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Redo,Undo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Superscript,Subscript,RemoveFormat,CopyFormatting,NumberedList,BulletedList,Outdent,Indent,CreateDiv,Blockquote,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Link,Unlink,Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,pre,Font,FontSize,BGColor,UIColor,About';

};


