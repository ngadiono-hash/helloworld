const source = ace.edit('source-code');
const opt = {
  showFoldWidgets: true,
  showLineNumbers: true,
  showPrintMargin: false,
  wrap: false,
  fontSize: 15,
  tabSize: 2,
  highlightActiveLine: true,
  highlightSelectedWord: true,
  enableLiveAutocompletion: true,
  enableSnippets: true
};
let auto = true;

source.session.setMode("ace/mode/html");
source.setOptions(opt);
source.setTheme("ace/theme/monokai");

$(function(){
  $('.panel-left,.content-left').resiz({ handleSelector: ".splitter", resizeHeight: false });
  
  $('nav.ctrl button:not("#stop")').on('click',function(){
    let $this = $(this);
    $this.addClass('active');
    setTimeout(function(){
      $this.removeClass('active')
    },300)
  });
  codeSource.on('keyup', wait(function(){
    if (auto) play.click();
  },1000));
  play.on('click', function(){
    runCode();
  });

  liveEditor.on('click','#stop',function(){
    auto = auto ? false : true;
    $(this).toggleClass('active');
    source.focus();
  });
  
  liveEditor.on('click','#clipboard',function(){
    var sel = source.selection.toJSON();
    source.selectAll();
    document.execCommand('copy');
    source.selection.fromJSON(sel);
    myAlert([1,'copied!',null]);
    source.selectAll();
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
  liveEditor.on('click','#newTab', function() {
    let win = window.open("","Title");
    win.document.open();
    win.document.write(source.getValue());
    win.document.close();
  });

  openEditor.on('click',function(){
    $(this).fadeOut();
    if (liveEditor.hasClass('slide-out')) {
      liveEditor.removeClass('slide-out');
    }
    liveEditor.show().addClass('slide-in');
    $('html').addClass('fix-scroll');
  });

  liveEditor.on('click','#close',function(){
    liveEditor.removeClass('slide-in').addClass('slide-out').fadeOut(1000);
    openEditor.fadeIn(1200);
    $('html').removeClass('fix-scroll');
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