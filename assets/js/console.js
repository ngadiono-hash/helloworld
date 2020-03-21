(function () {

  var methods, generateNewMethod, i, j, cur, old, addEvent;
  var pre = document.createElement('pre');
  pre.setAttribute('style','position:absolute;background:aliceblue;color:blue;font-size:18px;font-weight:bold;bottom:0;left:0;right:0;height:50%;margin: 0;padding:10px;');
  var button = {
    el: document.createElement('button'),
    node: document.createTextNode('console')
  };
  button.el.setAttribute('style','position:absolute; bottom:10px;right:10px;z-index:1;');
  button.el.appendChild(button.node);
  window.document.body.appendChild(button.el);
  button.el.onclick = function(){
    pre.classList.toggle('on');
    if(pre.classList.contains('on')){
      pre.style.height = '50%';
      button.el.innerHTML = 'close';
    } else {
      pre.style.height = '10%';
      button.el.innerHTML = 'console';
    }
  }

  generateNewMethod = function (oldCallback, methodName) {
    return function () {
      var args = Array.prototype.slice.call(arguments, 0);
      var li = document.createElement('li');
      var text = document.createTextNode(": " + args);
      li.appendChild(text);
      pre.appendChild(li);
      window.document.body.appendChild(pre);
    };
  };
  var methods = Object.keys(console);
  for (i = 0, j = methods.length; i < j; i++) {
    cur = methods[i];
    if (cur in console) {
      old = console[cur];
      console[cur] = generateNewMethod(old, cur);
    }
  }

  window.onerror = function (msg) {
    var erLi = document.createElement('li');
    erLi.style.color = 'red';
    var erNode = document.createTextNode('x '+ msg);
    erLi.appendChild(erNode);
    pre.appendChild(erLi);
    window.document.body.appendChild(pre);

  };
})();