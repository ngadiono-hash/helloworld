// SCREEN DIMENSION 
function getStyle(elmnt,style) {
  if (window.getComputedStyle) {
    return window.getComputedStyle(elmnt,null).getPropertyValue(style);
  } else {
    return elmnt.currentStyle[style];
  }
}


var dragging = false;
function dragstart(e) {
  e.preventDefault();
  dragging = true;
}
function dragmove(e,target) {
  if (dragging) {
    showFrameSize(target);    
  }
}
function dragend() {
  dragging = false;
  $('#dm').fadeOut(4000);
}
function showFrameSize(target) {
  var width, height;
  width = Number(getStyle(document.getElementById(target), "width").replace("px", "")).toFixed();
  height = Number(getStyle(document.getElementById(target), "height").replace("px", "")).toFixed();
  $('#dm').fadeIn();
  $('#dm').html("<span>" + width + " x " + height + "</span>");
}
function download(filename,text){
  var element = document.createElement('a');
  element.style.display = 'none';
  element.setAttribute('href','data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}
function runCode(delay){
  var plainText = source.getValue();
  let resultFrame = document.getElementById('result-frame').contentWindow.document;
  delay = delay || 0;
  var timer = null;
  if (timer) clearTimeout(timer);
  timer = setTimeout(function() {
    timer = null;
    resultFrame.open();
    resultFrame.writeln(plainText);
    resultFrame.close();
  },delay);
  source.focus();
}

const source = ace.edit('source-code');
let play = false;
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
  
  $("#close").on("click", function() {
    $('.wrapper-editor').addClass('slide-out-bl').fadeOut();
  });
  $('#source-code').on('keyup',function() {
    if (play) runCode(500);
  });
  $("#live").on("click", function() {
    (play) ? play = false : play = true;
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
    sel = { status: 1, message: 'Copied!' }
    myAlert(sel);
  });
  $('#download').on("click", function(){
    var text, fileName;
    text = source.getValue();
    fileName = source.session.getLine(3);
    fileName = fileName.match(/<title>(.*?)<\/title>/);
    if (fileName != null) {
      fileName = fileName[1].replace(' ','_').toLowerCase() + '.html';
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
 
$('.open-editor').on('click',function() {
  if ($('.wrapper-editor').hasClass('slide-out-bl')) {
    $('.wrapper-editor').removeClass('slide-out-bl');
  }
  $('.wrapper-editor').fadeIn().addClass('scale-in-center');
  source.focus();
});