const frame = document.getElementById('result-frame'),
  inCss = `<link rel="stylesheet" href="${host}assets/css/inj.css">`,
  inJs = `<script src="${host}assets/js/inj.js"><\/script>`,
  source = ace.edit('source-code')
  liveEditor = $('.wrapper-editor'),
  openEditor = $('#open-editor'),
  codeSource = $('#source-code');
let auto = false;
let opt = {
  showFoldWidgets: true,
  showLineNumbers: true,
  showPrintMargin: false,
  wrap: false,
  fontSize: 15,
  tabSize: 2,
  highlightActiveLine: true,
  highlightSelectedWord: true,
  enableLiveAutocompletion: false,
  enableSnippets: false
};

source.session.setMode("ace/mode/html");
source.setOptions(opt);
source.setTheme("ace/theme/monokai");

$(function(){
  $('.panel-left').resiz({ handleSelector: ".splitter", resizeHeight: false });
  $('nav.ctrl button').addClass('btn btn-ctrl btn-outline-dark btn-sm').tooltip({tooltipClass: "mytooltip"});
  $('nav.ctrl button').on('click',function(){
    $(this).addClass('jello');
    setTimeout(function(){
      $('nav.ctrl button').removeClass('jello')
    },500)
  });
  // editor control
  codeSource.on('keyup',function(){
    if (auto) runCode(500);
  });
  liveEditor.on('click','#live', function(e){
    let btn = $(this);
    auto ? auto = false : auto = true;
    btn.toggleClass("active");
    btn.find('i').toggleClass('fa-pause fa-play');
    if ($(btn).hasClass('active')) runCode();
  });
  liveEditor.on('click','#clipboard',function(){
    var sel = source.selection.toJSON();
    source.selectAll();
    document.execCommand('copy');
    source.selection.fromJSON(sel);
    myAlert([1,'copied!',null]);
    source.selectAll();
  });
  liveEditor.on('click','#snippet',function(){
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      source.setOptions({
        enableLiveAutocompletion : true,
        enableSnippets: true
      });
    } else {
      source.setOptions(opt);
    }
    source.focus();
  });
  liveEditor.on('click','#temp',function(){
    let temp = ``;
    temp += `<!DOCTYPE html>\n<html>\n<head>\n  <title></title>\n</head>`;
    temp += `\n<body>\n  <h1></h1>\n\n<script><\/script>\n</body>\n</html>`;
    source.getSession().setValue(temp);
    source.gotoLine(6);
    source.focus();
  });
  liveEditor.on('click','#del',function(){
    source.getSession().setValue('');
    source.focus();
  });
  liveEditor.on('click','#close',function(){
    liveEditor.addClass('scale-out-center').fadeOut();
    openEditor.fadeIn(1200);
  });
  openEditor.on('click',function(){
    if (liveEditor.hasClass('scale-out-center')){
      liveEditor.removeClass('scale-out-center');
    }
    openEditor.fadeOut();
    liveEditor.fadeIn().addClass('scale-in-center');
    source.focus();
  });
  $('.splitter').on('mousedown',function(e){
    dragstart(e);
  });
  $(window).on('mousemove',function(e){
    dragmove(e,'result-frame');
  });
  $(window).on('mouseup',function(e){
    dragend();
  });
});