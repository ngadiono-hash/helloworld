var pre = document.createElement('pre');
pre.setAttribute('id','mydebug');
var erLi = document.createElement('li');
erLi.style.color = 'red';
window.onerror = function(msg,url,line) {
  var erNode = document.createTextNode(msg+' on script tag line '+(line-1));
  erLi.appendChild(erNode);
  pre.appendChild(erLi);
  window.document.body.appendChild(pre);
} 