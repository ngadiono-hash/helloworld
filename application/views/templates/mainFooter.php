<?php
$lesson_page = whats_page(2,['docs']) && !empty($this->uri->segment(3));
$login_page = whats_page(2,['sign']);
$quiz_page = whats_page(2,['quiz']);
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
<div class="overlay"></div>
<div class="ajax"></div>

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
<script src="<?=base_url()?>assets/vendor/theme/theme.js"></script>
<script src="<?=base_url()?>assets/vendor/prism/prism-line.js"></script>
<?php if ($lesson_page) { ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>
<script src="<?=base_url()?>assets/vendor/resize/resiz.js"></script>
<script src="<?=base_url()?>assets/js/conf.js"></script>
<?php } ?>
<?php if ($login_page && startSession('access')) { ?>
<script src="<?=base_url('assets/js/log.js')?>"></script>
<?php } ?>
<?php if($login_page) { ?>
<script>
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
</script>
<?php } ?>
<script name="mainScript">
const over = $('.overlay'), blog = $('.blog-content'), form = $('.quiz-form'), fin = $('.finish');
let xhrRest, imgRest, myRest, active, iData, turn, time,
    myQuiz = [],
    sec = 8;
linkActive('.site-menu a');
linkActive('.lesson-menu a');
function handling(xhr){
  if (xhr.status == 404) {
    xhrRest = ``;
    imgRest = `${host}assets/img/feed/404.gif`;
  } else if (xhr.status == 403) {
    xhrRest = window.location.href;
    imgRest = `${host}assets/img/feed/403.gif`;
  } else if (xhr.status == 500) {
    xhrRest = ``;
    imgRest = `${host}assets/img/feed/500.gif`;
  }
  overide(imgRest,xhrRest);  
}
function overide(image,direct=''){
  over.fadeIn();
  over.html(`<img class="scale-in-center img-responsive" src="${image}">`);
  $(document).scroll(function() {
    over.fadeOut(1000);
    if (direct != '') window.location.href = direct;
    setTimeout(function(){
      over.fadeOut().empty();
    },1000);
  });
}
function startAjax(){
  $('.ajax').fadeIn().addClass('scale-in-center').html(`<div class="contain"><img src="${host}assets/img/feed/bars.svg"></div>`);
}
function endAjax(){
  $('.ajax').toggleClass('scale-in-center scale-out-center');
  setTimeout(function(){
    $('.ajax').empty();
    $('.ajax').fadeOut();
  },400);
}

</script>
<?php if ($quiz_page) { ?>
<script>
  function getFormData(form){
    let in_array = {}, un_array = form.serializeArray();
    $.map(un_array, function(n, i){
      if (n['value'] != '') {
        in_array[n['name']] = n['value'];
      } else {
        in_array[n['name']] = null;
      }
    });
    return in_array;
  }
  function myTimer() {
    form.parents('.active').find('.spent').html(sec + " detik");
    sec--;
    if (sec == -1) {
      clearInterval(time);
      slide();
    }
  }
  function slide(){
    sec = 8;
    turn++;
    time = setInterval(myTimer,1000);
    active = form.parents('.active');
    iData = getFormData(active.find('form'));
    myQuiz.push(iData);
    form.find('input[type="radio"]').prop('checked',false);
    form.find('.submit').fadeOut();

    active.removeClass('scale-in-center').addClass('slide-out-left');
    setTimeout(function(){
      active.next('.card').addClass('active').fadeIn();
      active.hide().removeClass('slide-out-left active').addClass('scale-in-center');
      if (active.next('div.card').length == 0) {
        
        $.ajax({
          url : host + 'xhrm/get_quiz',
          type : 'POST',
          data : { quest: myQuiz, csrf_token: csrf },
          beforeSend : function(){
            startAjax();
          },
          success : function(data){
            clearInterval(time);
            let dat = $.parseJSON(data);
            fin.fadeIn();
            let temp = '';
            temp += `<img src="${host}assets/img/${dat.plain.img}" class="mt-3">`;
            temp += `<h1>score : ${dat.score}</h1>`;
            temp += `<h3>${dat.plain.h3}</h3>`;
            temp += `<h4 class="mb-3">${dat.plain.h4}</h4>`;
            temp += `<div class="btn-group">`;
            temp += `<button class="btn btn-default check-rest">Periksa Jawaban</button>`;
            temp += `<button class="btn btn-default submit-rest">Submit Score</button>`;
            temp += `</div>`;
            fin.find('.card-body').html(temp);
            myQuiz = [];
            myRest = dat.evaluate;
          },
          error : function(xhr){
            handling(xhr);
          },
          complete : function(){
            endAjax()
          }
        });
      }
    },700);
  }

  // quiz function
  $(function(){
    $('.quiz-content').on('click','button', function(){
      let $target = $('#quiz-content').prev('.anch');
      $('html').animate({'scrollTop': $target.offset().top });
    });

    $('.start').on('click','.btn-default',function() {
      turn = 0;
      time = setInterval(myTimer,1000);
      $('.start').hide().removeClass('active').next('.card').fadeIn().addClass('active');
    });
    fin.on('click','.btn-again',function() {
      fin.hide();
      fin.parents('.quiz-content').find('.start').fadeIn();
    });

    form.on('change','input[type="radio"]',function(){
      $(this).parents('.quiz-form').find('.submit').fadeIn();
    });

    form.on('click','.submit',function(e) {
      clearInterval(time);
      slide();
    });
  });
</script>
<?php } ?>
<?php if ($lesson_page) { ?>
<script id="lesson-script">
  function onScroll(event){
    let scrollPos = $(document).scrollTop();
    $('.hint a').each(function() {
      let currentLink = $(this), div = $(currentLink.attr("href")).next(), divPos = div.position();
      if (divPos != undefined) {
        if ((divPos.top + 300) < scrollPos && (divPos.top + 300) + div.outerHeight() > scrollPos) {
          $(currentLink).addClass("active");
        } else {
          $(currentLink).removeClass("active");
        }
      }
    });
  }
  // search function
  $(function(){
    $('#search-form input').on('keypress',function(e){
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
  });

  // editor function
  $(function(){
    $('#newTab').on('click', function() {
      let win = window.open("","Title");
      win.document.open();
      win.document.write(source.getValue());
      win.document.close();
    });
    $("#close").on("click", function() {
      $('.wrapper-editor').addClass('slide-out-bl').fadeOut();
      $('html').removeClass('fix-scroll');
      $('.open-editor').fadeIn(1200);
    });
  });

  // main function
  $(function(){
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
    blog.find('.code-toolbar').append('<button class="btn btn-primary execute">Try It</button>');
    blog.find('a').addClass('link');
    blog.find('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
    blog.find('span').attr('id', function(){
      return $(this).prev('h3').text().replace(/\s+/g,'-').toLowerCase();
    });
    blog.on('click','.execute',function() {
      let snippet = $(this).siblings('pre').children('code').text();
      source.getSession().setValue(snippet);
      runCode();
      if ($('.wrapper-editor').hasClass('slide-out-bl')) {
        $('.wrapper-editor').removeClass('slide-out-bl');
      }
      $('.wrapper-editor').fadeIn().addClass('scale-in-center');
      $('html').addClass('fix-scroll');
      $('.open-editor').fadeOut();
    });
  });
</script>
<?php } ?>
</body>
</html>