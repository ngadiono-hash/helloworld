
$(function(){
  const blog = $('.blog-content');
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

  let a = blog.find('[href*=tryit]').addClass('btn btn-default').attr('target','_blank').text('Try It');
  let pre = blog.find('.code-toolbar pre.language-javascript.line-numbers').siblings('.toolbar');
  for (let i = 0; i < a.length; i++) {
    pre[i].append(a[i]);
  }
  blog.find('a:not([href*=tryit])').addClass('link')
  blog.find('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
  blog.find('span').attr('id', function(){
    return $(this).prev('h3').text().replace(/\s+/g,'-').toLowerCase();
  });
  blog.on('click','.execute',function() {
    let snippet = $(this).parents('.code-toolbar').find('code').text();
    source.getSession().setValue(snippet);
    runCode();
    if (liveEditor.hasClass('slide-out')) {
      liveEditor.removeClass('slide-out');
    }
    liveEditor.show().addClass('slide-in');
    $('html').addClass('fix-scroll');
  });
});