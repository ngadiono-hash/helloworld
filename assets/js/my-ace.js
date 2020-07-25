const srcHtm = ace.edit('source-htm'),
  srcCss = ace.edit('source-css'),
  srcJsc = ace.edit('source-jsc'),
  frame = document.getElementById('result-frame').contentWindow.document,
  inCss = `<link rel="stylesheet" href="${host}assets/css/injected.css">\n`,
  inJs = `<script src="${host}assets/js/injected.js"><\/script>\n`,
  liveEditor = $('.wrapper-editor'),
  play = $('#play');
let opt = {
  showFoldWidgets: true,
  showLineNumbers: true,
  showPrintMargin: false,
  wrap: true,
  fontSize: 15,
  tabSize: 2,
  highlightActiveLine: true,
  highlightSelectedWord: true,
  enableLiveAutocompletion: true,
  enableSnippets: true
};
let auto = true;

function runCode(){
  let pT = '';
  pT += '<meta charset="UTF-8">\n';
  pT += '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n';
  pT += `<title><\/title>\n`;
  pT += inCss;
  pT += inJs;
  pT += `<style>\n${srcCss.getValue()}\n<\/style>\n`;
  pT += `<body>\n${srcHtm.getValue()}\n`;
  pT += `<script>\n${srcJsc.getValue()}\n<\/script>\n`;
  pT += '<\/body>';
  frame.open();
  frame.write(pT);
  frame.close();
  play.addClass('blink');
  setTimeout(function() {
    play.removeClass('blink');
  }, 300);
}
srcHtm.session.setMode("ace/mode/html");
srcHtm.setTheme("ace/theme/monokai");
srcHtm.setOptions(opt);

srcCss.session.setMode("ace/mode/css")
srcCss.setTheme("ace/theme/monokai");;
srcCss.setOptions(opt);

srcJsc.session.setMode("ace/mode/javascript");
srcJsc.setTheme("ace/theme/monokai");
srcJsc.setOptions(opt);



$(function(){
  $('.panel-left,.content-left').resiz({ handleSelector: ".splitter", resizeHeight: false });
  
  $('.control a:not("#stop")').on('click',function(){
    let $this = $(this);
    $this.addClass('blink');
    setTimeout(function(){
      $this.removeClass('blink')
    },300)
  });
  $('#source-htm,#source-css,#source-jsc').on('keyup', wait(function(){
    if (auto) play.click();
  },1000));
  play.on('click', function(){
    runCode();
  });

  liveEditor.on('click','#stop',function(){
    auto = auto ? false : true;
    $(this).toggleClass('blink');
    let ic = $(this).find('i');
    ic.toggleClass('fa-hourglass-half fa-stop');
    if (ic.hasClass('fa-stop')) {
      ic.removeClass('fa-spin');
    } else {
      ic.addClass('fa-spin');
    }
    // source.focus();
  });
  
  liveEditor.on('click','#clipboard',function(e){
    let active = liveEditor.find('.tab-pane.show.active .body-source').attr('id');
    let tabActive = ace.edit(active);
    let sel = tabActive.selection.toJSON();
    tabActive.selectAll();
    tabActive.focus();
    document.execCommand('copy');
    tabActive.selection.fromJSON(sel);
    tabActive.selectAll();
  });
  // liveEditor.on('click','#del',function(){
  //   source.getSession().setValue('');
  //   source.focus();
  // });
  
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