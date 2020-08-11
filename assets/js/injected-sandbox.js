$(function(){
  let blog = $('.blog-content') ,intLink, extLink, extA;
  intLink = blog.find('pre.line-numbers.l:not(.language-html)').siblings('.toolbar')
  intLink.append('<button class="btn btn-default exe">Try</button>');

  extLink = blog.find('[href*=tryit]')
  .addClass('btn btn-default')
  .attr('target','_blank')
  .html('Open');
  extA = blog.find('.code-toolbar pre.line-numbers.e').siblings('.toolbar');
  for (let i = 0; i < extA.length; i++) {
    extA[i].append(extLink[i]);
  }
  blog.find('a:not([href*=tryit])').addClass('link');
  blog.find('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
  blog.on('click','.exe',function() {
    var snip = $(this).parents('.code-toolbar').find('code').text();
    var tags = document.createElement('script');
    tags.appendChild(document.createTextNode(`(function(){\n${snip}\n})()\n`));
    document.body.appendChild(tags);
    document.body.removeChild(tags);
    window.onerror = function(msg,url,line) {
      alert(msg);
    }
  });
});