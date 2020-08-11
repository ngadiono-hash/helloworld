
$(function(){
  const blog = $('.blog-content');
  let intLink, extLink, extA;
  
  $(document).on("scroll",onScroll);
  
  $('.navigate [data-href]').on('click', function() {
    let nav = $(this).data('href');
    setTimeout(function(){
      window.location.href = nav;
    },500);
  });
  
  $('.hint a').on('click', function() {
    let target = this.hash, $target = $(target);
    $(document).off("scroll");
    $('.hint a').each(function() {
      $(this).removeClass('active');
    });
    $(this).addClass('active');
    $('body').stop().animate({
      'scrollTop': $target.offset().top - 100
    }, 500, function(){
      window.location.hash = target;
      $(document).on("scroll", onScroll);
    });
  });
  
  blog.on('click','img.wide',function(){
    let img = $(this).attr('src');
    overide(img);
  });
  
  intLink = blog.find('pre.line-numbers.l:not(.language-html)').siblings('.toolbar')
  intLink.append('<button class="btn btn-default exe" title="Play It"><i class="fa fa-play"></i></button>');
  
  extLink = blog.find('[href*=tryit]')
  .addClass('btn btn-default')
  .attr({'target':'_blank','title': 'Open in Editor'})
  .html('<i class="fa fa-edit"></i>');
  extA = blog.find('.code-toolbar pre.line-numbers.e').siblings('.toolbar');
  for (let i = 0; i < extA.length; i++) {
    extA[i].append(extLink[i]);
  }

  blog.find('a:not([href*=tryit])').addClass('link');
  blog.find('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
  blog.find('span').attr('id', function(){
    return $(this).prev('h3').text().replace(/\s+/g,'-').toLowerCase();
  });

  blog.on('click','.exe',function() {
    let snip = $(this).parents('.code-toolbar').find('code').text();
    let tags = document.createElement('script');
    tags.appendChild(document.createTextNode('\n(function(){\n'+snip+'\n})()\n'));
    document.body.appendChild(tags);
    // document.body.removeChild(tags);
    window.onerror = function(msg,url,line) {
      alert(msg);
    }
  });
});