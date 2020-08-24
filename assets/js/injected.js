var erPre = document.createElement('pre');
erPre.setAttribute('id','mydebug');
var erLi = document.createElement('li');
erLi.style.color = 'red';

window.onerror = function(msg,url,line) {
  var erNode = document.createTextNode(`${msg} on script line ${line - 2}\n`);
  erLi.appendChild(erNode);
  erPre.appendChild(erLi);
  window.document.body.appendChild(erPre);
}