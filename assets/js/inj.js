(function () {
  var pre = document.createElement('pre');
  pre.setAttribute('id','mydebug');
  window.onerror = function(msg,url,line) {
    var erLi = document.createElement('li');
    erLi.style.color = 'red';
    var erNode = document.createTextNode(msg+' on script tag line '+(line-1));
    erLi.appendChild(erNode);
    pre.appendChild(erLi);
    window.document.body.appendChild(pre);
  }
})();