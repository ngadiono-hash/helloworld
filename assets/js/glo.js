const host = `http://${window.location.hostname}/helloworld/`;
const path = window.location.pathname;
const csrf = $('meta[name="csrf"]').attr('content');
const imgLoad = `<img src="${host}assets/img/feed/bars.svg" height="50">`;
const uri_pattern = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/ig;

function myAlert(data){
  let btn = '', alt = $('.alert-auto');
  alt.fadeIn(500);
  if (data[0] == 1) {
    alt.addClass('alert-success')
    btn = `<i class="fa fa-check"></i> ${data[1]} `;
  } else {
    alt.addClass('alert-danger');
    btn = `<i class="fa fa-exclamation-triangle"></i> ${data[1]} `;
  }
  alt.find('p').html(btn);
  setTimeout(function(){
    alt.fadeOut(1000);
    alt.removeClass('alert-success alert-danger');
    if (data[2] != null) {
      setTimeout(function(){
        if (data[2].includes('http')) {
          window.location.href = data[2];
        } else {
          window.location.href = host + data[2];
        }
      },1000);
    }
  }, 4000);
}

function linkActive(target){
  let url = window.location.pathname, urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
  $(target).each(function(){
    if(urlRegExp.test(this.href.replace(/\/$/,''))){
      $(this).addClass('active');
    }
  });
}

function reloadTable(table){
  $(table).DataTable().ajax.reload(null, false);
}

function timeElapsed(timeStamp) {
  let dateNow     = new Date(),
      msPerMinute = 60 * 1000,
      msPerHour   = msPerMinute * 60,
      msPerDay    = msPerHour * 24,
      msPerMonth  = msPerDay * 30,
      msPerYear   = msPerDay * 365;  
  let elapsed = dateNow - timeStamp;
  if (elapsed < msPerMinute) {
    return Math.round(elapsed/1000) + ' seconds ago';
  } else if (elapsed < msPerHour) {
    return Math.round(elapsed/msPerMinute) + ' minutes ago';   
  } else if (elapsed < msPerDay ) {
    return Math.round(elapsed/msPerHour ) + ' hours ago';
  } else if (elapsed < msPerMonth) {
    return Math.round(elapsed/msPerDay) + ' days ago';   
  } else if (elapsed < msPerYear) {
    return Math.round(elapsed/msPerMonth) + ' months ago';   
  } else {
    return Math.round(elapsed/msPerYear ) + ' years ago';   
  }
}

function convert_time(timeStamp,full=false){
  let time = new Date(timeStamp),
  Y    = time.getFullYear(),
  M    = time.getMonth(),
  _M   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Augs','Sept','Oct','Nov','Dec'],
  MStr = _M[M],
  Dt   = time.getDate(),
  Da   = time.getDay(),
  _Da  = ['Sun','Mon','Tue','Wed','Thr','Fri','Sat'],
  DaStr= _Da[Da],
  H    = time.getHours(),
  Min  = time.getMinutes(),
  S    = time.getSeconds();
    
  function cek(i) {
    return (i < 10) ? '0' + i : '';
  }
  H = cek(H);
  Min = cek(Min);
  S = cek(S);

  let _date, _time;
  _date = DaStr +", "+ Dt +" "+ MStr +" "+ Y ;
  _time = H +":"+ Min +":"+ S;
  if (full== false) {
    return _date;
  } else {
    return _date +' | '+ _time;
  }
}


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
  let width, height;
  width = Number(getStyle(document.getElementById(target), "width").replace("px", "")).toFixed();
  height = Number(getStyle(document.getElementById(target), "height").replace("px", "")).toFixed();
  $('#dm').fadeIn();
  $('#dm').html("<span>" + width + " x " + height + "</span>");
}
function download(filename,text){
  let element = document.createElement('a');
  element.style.display = 'none';
  element.setAttribute('href','data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}

function runCode(delay){
  var plainText = source.getValue();
  delay = delay || 0;
  var timer = null;
  if (timer) clearTimeout(timer);
  timer = setTimeout(function() {
    timer = null;
    frame.contentWindow.document.open();
    frame.contentWindow.document.write(inCss);
    frame.contentWindow.document.write(inJs);
    frame.contentWindow.document.write(plainText);
    frame.contentWindow.document.close();
  },delay);
  source.focus();
}