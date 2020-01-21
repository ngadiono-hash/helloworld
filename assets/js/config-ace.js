function compilex(delay){
	var plainText = '';
  plainText += '<meta charset="UTF-8">\n';
  plainText += '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n';
  plainText += '<title>'+$('#input-title').val()+'<\/title>\n';
	plainText += field.query.value;
	plainText += field.framework.value;
  plainText += '<style>\n';
  plainText += field.css.getValue();
  plainText += '\n';
  plainText += '<\/style>\n';
  plainText += field.html.getValue();
  plainText += '<script>\n';
  plainText += field.js.getValue();
  plainText += '\n';
	plainText += '<\/script>\n';
  
  delay = delay || 0;
    var timer = null;
    if (timer) clearTimeout(timer);
    timer = setTimeout(function() {
      timer = null;
		  field.resultFrame.open();
		  field.resultFrame.writeln(plainText);
		  field.resultFrame.close();
    }, delay);
}

let field = {
	title : document.getElementById('input-title'),
	html : ace.edit('html'),
	css : ace.edit('css'),
	js : ace.edit('js'),
	query : document.getElementById('source-jquery'), 
	framework : document.getElementById('source-framework'),
	resultFrame : document.getElementById('result-frame').contentWindow.document
};
let use = { liveEdit: false };
let opt = {
	showFoldWidgets: true,
	showLineNumbers: true,
	showPrintMargin: false,
	minLines: 2,
	wrap: false,
	fontSize: 15,
	tabSize: 2,
	highlightActiveLine: true,
	highlightSelectedWord: true,
	enableBasicAutocompletion: true,
	enableLiveAutocompletion: false,
	enableSnippets: true
};
field.html.setOptions(opt);
field.html.session.setMode("ace/mode/html");
field.html.setTheme("ace/theme/tomorrow_night");
field.css.setOptions(opt);
field.css.session.setMode("ace/mode/css");
field.css.setTheme("ace/theme/tomorrow_night");
field.js.setOptions(opt);
field.js.session.setMode("ace/mode/javascript");
field.js.setTheme("ace/theme/tomorrow_night");

if(window.addEventListener){
	$("#liveEdit").on("click", function() {
    use.liveEdit ? use.liveEdit = false: use.liveEdit = true;
    $(this).parent('li').toggleClass("active");
    $(this).find('i').toggleClass('fa-pause fa-sync');
   	$(this).parent('li').siblings('.run').toggleClass('hide');
  });
	$('#run').on('click', function() {
  	var a =  $(this).parent('li');
    a.addClass("active");
		setTimeout(function() {
		  a.removeClass('active');
		}, 300);
		compilex();
	});
	$('#html,#css,#js').on('keyup',function() {
		if(use.liveEdit) compilex(1000);
	});
}