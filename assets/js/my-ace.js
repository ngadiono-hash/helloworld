const srcHtm = ace.edit('source-htm'),
  srcCss = ace.edit('source-css'),
  srcJsc = ace.edit('source-jsc'),
  frame = document.getElementById('result-frame').contentWindow.document,
  liveEditor = $('.wrapper-editor'),
  play = $('#play'),
  panel = $('.panel-left');
let opt = {
  showFoldWidgets: true,
  showLineNumbers: true,
  showPrintMargin: false,
  wrap: false,
  fontSize: 18,
  tabSize: 2,
  highlightActiveLine: true,
  highlightSelectedWord: true,
  enableLiveAutocompletion: true,
  enableSnippets: true
};
let auto = false;

srcHtm.session.setMode("ace/mode/html");
srcHtm.setTheme("ace/theme/monokai");
srcHtm.setOptions(opt);

srcCss.session.setMode("ace/mode/css")
srcCss.setTheme("ace/theme/monokai");;
srcCss.setOptions(opt);

srcJsc.session.setMode("ace/mode/javascript");
srcJsc.setTheme("ace/theme/monokai");
srcJsc.setOptions(opt);

function runCode(){
  let pT = `<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n
  <link rel="stylesheet" href="${host}assets/css/injected.css">\n
  <script src="${host}assets/js/injected.js"><\/script>\n
  <style>\n${srcCss.getValue()}\n</style>\n
  <body>\n
  ${srcHtm.getValue()}\n
  <script>\n(function(){\n${srcJsc.getValue()}\n})();\n</script>\n</body>`;
  frame.open();
  frame.write(pT);
  frame.close();
  play.addClass('blink');
  setTimeout(function() {
    play.removeClass('blink');
  }, 300);
}

$(function(){
  panel.resiz({ handleSelector: ".splitter", resizeHeight: false });
  frame.open();
  frame.write(`
    <div style="color: #808080; display: flex;height: 100%;font-family: fantasy;justify-content: center;flex-direction: column;align-items: center;">
    <h1 style="font-size: 3em;">click to run code</h1>
    <button name="run" style="color: inherit; font-size: 60px;padding: 0px 20px;padding-right: 10px;cursor: pointer; border-radius: 10px;">&#9658;</button>
    </div>
  `);
  frame.close();
  $('#result-frame').contents().find('[name=run]').click(function() {
    runCode();
  });

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
    $(this).find('i').toggleClass('fa-spin');
  });
  
  liveEditor.on('click','#clip',function(e){
    let active = liveEditor.find('.tab-pane.show.active .body-source').attr('id');
    let tabActive = ace.edit(active);
    let sel = tabActive.selection.toJSON();
    tabActive.selectAll();
    tabActive.focus();
    document.execCommand('copy');
    tabActive.selection.fromJSON(sel);
    tabActive.selectAll();
  });
  liveEditor.on('click','.t',function(e){
    let active = $(this).attr('href').slice(5);
    let tab = ace.edit('source-'+active);
    tab.blur();
    setTimeout(function(){
      tab.focus();
    },400);
  });
  liveEditor.on('click','#del',function(){
    let active = liveEditor.find('.tab-pane.show.active .body-source').attr('id');
    let tabActive = ace.edit(active);
    tabActive.getSession().setValue('');
    tabActive.focus();
    runCode();
  });
  
  panel.on('mousedown',function(e){
    dragstart(e);
  });
  $(window).on('mousemove',function(e){
    dragmove(e,'result-frame');
  });
  $(window).on('mouseup',function(e){
    dragend();
  });
});