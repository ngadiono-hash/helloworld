
const frame = document.getElementById('result-frame');
const inCss = `<link rel="stylesheet" href="${host}assets/css/inj.css">`;
const inJs = `<script src="${host}assets/js/inj.js"><\/script>`;

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
  enableLiveAutocompletion: false,
  enableSnippets: false
};
let auto = false;
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
  
  $("#close").on("click", function() {
    $('.wrapper-editor').addClass('slide-out-bl').fadeOut();
    $('.open-editor').fadeIn(1200);
  });
  $('#source-code').on('keyup',function() {
    if (auto) runCode(500);
  });
  $("#live").on("click", function() {
    (auto) ? auto = false : auto = true;
    $(this).toggleClass("active");
    $(this).find('i').toggleClass('fa-pause fa-play');
    runCode();
  });
  $('#clipboard').on('click', function(){
    var sel = source.selection.toJSON();
    source.selectAll();
    source.focus();
    document.execCommand('copy');
    source.selection.fromJSON(sel);
    myAlert([1,'copied!',null]);
  });
  $('#download').on("click", function(){
    var text, fileName;
    text = source.getValue();
    fileName = source.session.getLine(3);
    fileName = fileName.match(/<title>(.*?)<\/title>/);
    if (fileName != null) {
      fileName = fileName[1].replace(/\s/g,'_').toLowerCase() + '.html';
    } else {
      fileName = 'untitled.html';
    }
    download(fileName,text);
  });
  $('#snippet').on('click', function() {
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
  $('.open-editor').on('click',function() {
    if ($('.wrapper-editor').hasClass('slide-out-bl')) {
      $('.wrapper-editor').removeClass('slide-out-bl');
    }
    $('.open-editor').fadeOut();
    $('.wrapper-editor').fadeIn().addClass('scale-in-center');
    runCode();
    source.focus();
    $('html').addClass('body-fixed');
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