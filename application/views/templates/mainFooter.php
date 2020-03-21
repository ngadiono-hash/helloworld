<?php
$lesson_page = whats_page(2,['docs']) && !empty($this->uri->segment(3));
$login_page = whats_page(2,['sign']);
?>

<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="col-md-5 mb-4 mb-md-0">
        <h3>About My Note</h3>
        <p>Website My Note menyediakan rangkuman materi JavaScript yang ada dari berbagai sumber di internet. Semuanya didokumentasikan dan siap untuk dipelajari bagi siapapun yang ingin mahir dalam bahasa program JavaScript.</p>
        <p class="social">
          <a href="#"><span class="fab fa-twitter"></span></a>
          <a href="#"><span class="fab fa-facebook"></span></a>
          <a href="#"><span class="fab fa-dribbble"></span></a>
          <a href="#"><span class="fab fa-behance"></span></a>
        </p>
      </div>
      <div class="col-md-7 ml-auto">
        <div class="row site-section pt-0">
          <div class="col-md-6 mb-4 mb-md-0">
            <h3>Navigation</h3>
            <ul class="list-unstyled">
              <li><a href="#">JavaScript Dasar</a></li>
              <li><a href="#">JavaScript DOM</a></li>
              <li><a href="#">JavaScript Lanjutan</a></li>
            </ul>
          </div>
          <div class="col-md-6 mb-4 mb-md-0">
            <h3>Services</h3>
            <ul class="list-unstyled">
              <li><a href="#">Contact</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Todos</a></li>
              <li><a href="#">Events</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center text-center">
      <div class="col-md-7">
        <p class="copyright">&copy; Copyright My Note. All Rights Reserved</p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>

  </div>
</footer>
<div class="overlay">
  <img class="d-block img-thumbnail shadow">
</div>
<div class="modal fade" id="modal-search">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-center mb-4"></h3>
        <div class="search-result"></div>
      </div>
    </div>
  </div>
</div>
</div>
<?= ($lesson_page) ? '<a class="open-editor"><i class="fa fa-code"></i></a>' : ''; ?>
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>


<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/glo.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/popper.min.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/easing.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/sticky.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/aos.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php if ($lesson_page) { ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>
<script src="<?=base_url()?>assets/vendor/resize/resiz.js"></script>
<script src="<?=base_url()?>assets/vendor/prism/prism-line.js"></script>
<script src="<?=base_url()?>assets/js/conf.js"></script>
<?php } ?>
<script src="<?=base_url()?>assets/vendor/theme/theme.js"></script>
<script id="jsMain">

$('#newTab').on('click', function() {
  var win = window.open("","Title");
  win.document.open();
  win.document.write(source.getValue());
  win.document.close();
});

</script>
<?php if ($login_page && startSession('access')) { ?>
<script id="log-script">
 $(document).ready(function() {
  $('.nd label').css('opacity',0);
  let btnLog = $('.btn-log');
  $('#form-login input').on('keyup',function(){
   var rmb, $1,$2,$3;
   rmb = $('#remember');
   $1   = $('#input-key_email');
   $2   = $('#input-key_pass');
   if( $(this).val() != '' ){
    $(this).parents('.form-group').find('label').css('opacity',1);
  } else {
    $(this).parents('.form-group').find('label').css('opacity',0);
  }
  $(this).parents('.form-group').find('#error').html('');
  });

  $('#form-login').on('click','.btn-log',function(e) {
   e.preventDefault();
    // startAjax();
    var data = {
      key_email: $('[name="key_email"]').val(),
      key_pass: $('[name="key_pass"]').val(),
      remember: $('[type="checkbox"]').val(),
      csrf_token: csrf
    }
    $.ajax({
      url: host+'xhrm/set_login',
      type: 'post',
      dataType: 'json',
      data: data,
      success : function(data){
       $.each(data, function(key, value){
        $('[name="'+key+'"]').parents('.form-group').find('#error').html(value);
      });
       if (data[0] == 1) myAlert(data);
     },
     complete: function(){
				// endAjax();
			}
		});
  });
  });
</script>
<?php } ?>
<?php if ($lesson_page) { ?>
<script id="lesson-script">
  function onScroll(event){
    let scrollPos = $(document).scrollTop();
    $('.hint a').each(function() {
      let currentLink = $(this);
      let div = $(currentLink.attr("href")).next();
      let divPos = div.position();
      if (divPos != undefined) {
        if ((divPos.top + 300) < scrollPos && (divPos.top + 300) + div.outerHeight() > scrollPos) {
          $(currentLink).addClass("active");
        } else {
          $(currentLink).removeClass("active");
        }
      }
    });
  }

  $('#search-form input').on('keypress',function(e) {
    if (e.which == 13) {
    e.preventDefault();
      let datax = { csrf_token: csrf, search: $(this).val() };
      $.ajax({
        url: host + 'xhrm/search',
        type: 'POST',
        dataType: 'json',
        data: datax,
        success: function(data){
          $('#modal-search').modal('show');
          $('#modal-search h3').html(data[1]);
          let res = "";
          let arr = [];
          if (data[0] == 1) {
            for (let i = 0; i < data[2].length; i++) {
              arr = data[2][i].keys.join(' | ');
              res += '<div class="card"><div class="card-header">';
              res += '<a href="'+data[2][i].link+'" class="link"><h5>'+data[2][i].title+' - '+data[2][i].slug+'</h5></a></div>';
              res += '<div class="card-body p-2"><p class="m-0">'+arr+'</p></div></div><hr>'; 
            };
            $('#modal-search .search-result').html(res);
            $('.search-result p').mark(datax.search,{
              "element": "span",
              "className": "highlight"
            });
          } else {
            $('#modal-search .search-result').html('');
          }
        }
      });
    }
  });

  $(document).on("scroll", onScroll);

  $(function(){
    $('.navigate button').on('click', function() {
      let nav = $(this).data('href');
      setTimeout(function(){
        window.location.href = nav;
      },500);
    });
    $('.hint a').on('click', function () {
      let target = this.hash, $target = $(target);
      $(document).off("scroll");  
      $('.hint a').each(function () {
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
    linkActive('.site-menu a');
    linkActive('.lesson-menu a');
    $('.blog-content img.wide').on('click',function(e){
      e.preventDefault();
      let img = $(this).attr('src');
      $('.overlay').fadeIn().addClass('scale-in-center');
      $('.overlay').find('img').attr('src',img);
    });
    $('.overlay').on('click',function(){
      $(this).fadeOut();
    });

    $("#close").on("click", function() {
      $('.wrapper-editor').addClass('slide-out-bl').fadeOut();
      $('html').removeClass('body-fixed');
      $('.open-editor').fadeIn(1200);
    });
    $('.code-toolbar').append('<button class="execute btn btn-primary">Try It</button>');
    $('.blog-content a').addClass('link');
    $('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
    $('.blog-content span').attr('id', function(){
      return $(this).prev('h3').text().replace(/\s+/g,'-').toLowerCase();
    });
    $('.execute').on('click',function() {
      let snippet = $(this).siblings('pre').children('code').text();
      source.getSession().setValue(snippet);
      runCode();
      if ($('.wrapper-editor').hasClass('slide-out-bl')) {
        $('.wrapper-editor').removeClass('slide-out-bl');
      }
      $('.wrapper-editor').fadeIn().addClass('scale-in-center');
      $('html').addClass('body-fixed');
      $('.open-editor').fadeOut();
    });
  });
</script>
<?php } ?>

<?php if($login_page) { ?>
<script id="accessCode">
  $(document).ready(function() {
    let acc = $('#access');
    acc.on('keypress',function(e){
      if (e.which == 13) {
        $.ajax({
          url: host + 'xhrm/adm',
          type: 'post',
          dataType: 'json',
          data: {csrf_token: csrf, access: acc.val()},
          success : function(data){
            myAlert(data);
            if (data[0] == 0) {
              acc.val('');
            }
          }
        });
      }
    });
  });
</script>
<?php } ?>

</body>
</html>