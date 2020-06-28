<?php
$lesson_page = whats_page(2,['docs']) && !empty($this->uri->segment(3));
$login_page = whats_page(2,['sign']);
$quiz_page = whats_page(2,['quiz']);
?>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-5 mb-4 mb-md-0">
        <h3>About My Note</h3>
        <p class="pr-2">My Note menyediakan rangkuman materi JavaScript yang ada dari berbagai sumber di internet.</p>
        <p class="pr-2">Semuanya didokumentasikan dan siap untuk dipelajari bagi siapapun yang ingin mahir dalam bahasa program JavaScript.</p>
        <p class="social">
          <a href="#"><span class="fab fa-twitter"></span></a>
          <a href="#"><span class="fab fa-facebook"></span></a>
          <a href="#"><span class="fab fa-dribbble"></span></a>
          <a href="#"><span class="fab fa-behance"></span></a>
        </p>
      </div>
      <div class="col-md-7 ml-auto">
        <div class="row site-section pt-0">
          <div class="col-sm-6 mb-4 mb-md-0">
            <h3>Navigation</h3>
            <ul class="list-unstyled">
              <li><a href="<?=base_url('js/beginner')?>">JavaScript Dasar</a></li>
              <li><a href="<?=base_url('js/medium')?>">JavaScript Medium</a></li>
              <li><a href="<?=base_url('js/advance')?>">JavaScript Lanjutan</a></li>
            </ul>
          </div>
          <div class="col-sm-6 mb-4 mb-md-0">
            <h3>Services</h3>
            <ul class="list-unstyled">
              <li><a href="#">Contact</a></li>
              <li><a href="#">About</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center text-center">
      <div class="col-md-7">
        <p class="copyright">&copy; Copyright My Note. All Rights Reserved</p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a>
        </div>
      </div>
    </div>

  </div>
</footer>
<div class="overlay"></div>
<div class="ajax"></div>

</div>
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
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


<?php myGlobalJs() ?>
<script src="<?=log?>jquery.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
<script src="<?=log?>popper.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
<script src="<?=log?>bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script> -->
<script src="<?=log?>jquery.mark.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/easing.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/sticky.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/aos.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/owl.carousel.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="<?=log?>jquery-ui.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/theme.js"></script>
<script src="<?=base_url()?>assets/vendor/prism/prism-line.js"></script>
<?php
if ($lesson_page) myEditorJs();
if ($login_page && startSession('access')) { ?>
<script src="<?=base_url('assets/js/login.js')?>"></script>
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
<script>
  const blog = $('.blog-content');
  
  linkActive('.site-menu a');
  linkActive('.lesson-menu a');  
  $('.thumbnail').hover(
    function(){
      $(this).find('.caption').slideDown(250);
    },
    function(){
      $(this).find('.caption').slideUp(250);
    }
  );
  // search function
  $(function(){
    $('#search-form input').on('keypress',function(e){
      if (e.which == 13) {
      e.preventDefault();
        let inval = { search: $(this).val() };
        ajaxTemp({
          u: 'xhrm/search',
          d: inval,
          b: function(){
            startAjax();
            $('html').addClass('fix-scroll');
          },
          s: function(data){
            $('#modal-search').modal('show');
            $('#modal-search h3').html(data[1]);
            let temp = "";
            let arr = [];
            if (data[0] == 1) {
              for (let i = 0; i < data[2].length; i++) {
                arr = data[2][i].keys.join(' | ');
                temp += '<div class="card"><div class="card-header">';
                temp += '<a href="'+data[2][i].link+'"><h5 class="section-heading section-low">'+data[2][i].title+' - '+data[2][i].slug+'</h5></a></div>';
                temp += '<div class="card-body p-2"><p class="m-0">'+arr+'</p></div></div><hr>';
              };
              $('#modal-search .search-result').html(temp);
              $('.search-result p').mark(inval.search,{ "element": "span","className": "highlight" });
            } else {
              $('#modal-search .search-result').html('');
            }
          },
          c: function(){
            endAjax();
            $('html').removeClass('fix-scroll');
          },
        });
      }
    });
  });
</script>
<?php if ($quiz_page) { ?>
<script>
  const form = $('.quiz-content'), userForm = $('#form-user'), fin = $('.finish');
  let myRest, active, iData, user, timeleft, timer, barWidth, barDiv;
  let myQuiz = [], timetotal = 60;
  function getFormData(form){
    let in_array = {}, un_array = form.serializeArray();
    $.map(un_array, function(n, i){
      in_array[n['name']] = n['value'];
    });
    return in_array;
  }
  function myTimer() {
    timeleft = (timeleft === undefined) ? timetotal : timeleft ;
    barDiv = form.find('.quiz-form').parents('.active').find('.time-progress');
    barWidth = timeleft * barDiv.width() / timetotal;
    barDiv.find('div').animate({ width: barWidth }, 500);
    form.find('.quiz-form').parents('.active').find('.spent').html( timeleft + " detik");
    timeleft--;
    if (timeleft <= -1) {
      clearInterval(timer);
      slide();
    }
  }
  function generateResult(){
    let temp = `<div class="accordion" id="accord">`;
    let term;
    for (let i = 0; i < myRest[0].length; i++){
      link = myRest[0][i].rel.replace(/\s+/g,'-').toLowerCase();
      term = (myRest[0][i].result) ? 'btn-default' : 'btn-danger';
      temp += `<div class="card mb-1">`;
      temp += `<div class="card-header ${term}">`;
      temp += `<a class="card-anchor" data-toggle="collapse" data-target="#co${i}" aria-expanded="false">Soal Latihan#${i+1}<span class="ml-auto"></span></a>`;
      temp += `</div>`;
      temp += `<div id="co${i}" class="collapse" data-parent="#accord">`;
      temp += `<div class="card-body">`;
      temp += myRest[0][i].question;
      temp += `<div class="row text-center">`;
      temp += `<div class="col-lg-6"><div class="alert-success py-3 px-1 rounded"><h5>jawaban benar</h5><hr><h6 class="a">${myRest[0][i].correct}</h6></div></div>`;
      if (!myRest[0][i].result) {
        temp += `<div class="col-lg-6"><div class="alert-warning py-3 px-1 rounded"><h5>jawaban kamu</h5><hr><h6 class="a">${myRest[0][i].yours}</h6></div></div>`;
      }
      temp += `</div>`;
      temp += `<h5 class="mt-3">referensi : <a href="${myRest[0][i].rel}" class="link" target="_blank">${myRest[0][i].title}</a></h5>`;
      temp += `</div>`;
      temp += `</div>`;
      temp += `</div>`;
    }
    temp += `</div>`;

    $('#modal-result').find('.result-content').html(temp);
    Prism.highlightAll();
  }
  function slide(){
    timeleft = timetotal;
    timer = setInterval(myTimer,1000);
    active = form.find('.quiz-form').parents('.active');
    iData = getFormData(active.find('form'));
    myQuiz.push(iData);

    active.removeClass('scale-in-center').addClass('slide-out-left');
    setTimeout(function(){
      active.next('.card').addClass('active').fadeIn();
      active.hide().removeClass('slide-out-left active').addClass('scale-in-center');
      if (active.next('div.card').length == 0) {
        ajaxTemp({
          u: 'xhrm/get_result',
          d: { quest: myQuiz },
          b: startAjax,
          s: function(data){
            clearInterval(timer);
            let dat = data;
            let temp = '';
            temp += `<h1>Hai ${user},</h1>`;
            temp += `<h3>${dat.plain.h3}</h3>`;
            temp += `<h4 class="mb-3">${dat.plain.h4}</h4>`;
            temp += `<button class="btn btn-default mx-1 check-rest">Periksa Jawaban</button>`;
            temp += `<button class="btn btn-default mx-1 submit-rest">Submit Score</button>`;

            fin.find('.side-setup .card-body').html(temp);
            fin.find('.score-result').html('score ' + dat.score.toFixed(2));
            fin.find('.img-result').attr('src',`${host}assets/img/emo/${dat.plain.img}`);
            fin.fadeIn();
            myRest = [dat.evaluate,dat.score.toFixed(2)];
            generateResult();
          },
          c: endAjax
        });
      }
    },700);
  }
  function slidePre(select){
    $(select).removeClass('scale-in-center').addClass('slide-out-left');
    setTimeout(function(){
      $(select).next('.setup').fadeIn();
      $(select).hide().removeClass('slide-out-left').addClass('scale-in-center');
    },700);
  }

  // quiz function
  $(function(){
    $('.quiz-content').on('click','button', function(){
      let $target = $('.anch');
      $('html').animate({'scrollTop': $target.offset().top });
    });

    form.on('change','input[name="category"]',function(e){
      label = $(this).val();
      $(e.target).parents('.side-setup').find('.groups').html('<button type="button" class="btn scale-in-center btn-default">Selanjunya</button>');
    });
    $('.welcome').on('click','.btn-default',function(){
      slidePre('.welcome');
    });
    userForm.find('input').keyup(wait(function(e){
      user = $(this).val();
      $(this).blur();
      ajaxTemp({
        u: 'xhrm/check_user',
        d: {user: user, label: label},
        b: function(){
          userForm.find('.user-result').hide();
          userForm.find('img').show();
        },
        s: function(data){
          let dat = data;
          userForm.find('img').hide();
          $('.user-result').html(dat[1]).show();
          if (dat[0]) {
            userForm.find('input').removeClass('input-error');
            userForm.find('.groups').html('<button type="button" class="btn btn-default scale-in-center">Selanjutnya</button>');
          } else {
            userForm.find('input').addClass('input-error');
            userForm.find('.groups').html('');
          }
        },
        c: null
      });
    }, 1000));
    $('.sign').on('click','.btn-default',function(){
      $.post(host+'xhrm/get_quiz',{ level:label },function(data){
        $('.start').after(data);
        let len = form.find('form.quiz-form');
        let cat = form.find('form.quiz-form').data('name');
        $('.quiz-count').html(len.length);
        $('.category-active').html(cat);
        Prism.highlightAll();
      });
      $('.user-active').html(user);
      slidePre('.sign');
    });
    userForm.find('input').focus(function(){
      userForm.find('input').removeClass('input-error');
      userForm.find('.groups').html('');
    });
    $('.start').on('click','.btn-default',function(){
      timer = setInterval(myTimer,1000);
      $('.start').hide().next('.card').fadeIn().addClass('active');
    });
    form.on('change','input[name="ch"]',function(e){
      $(e.target).parents('.active').find('.next-slide').fadeIn();
    });
    form.on('click',function(e){
      let $this = $(e.target);
      if ($this.hasClass('next-slide')) {
        timeleft = -1;
        myTimer();
      } else if ($this.hasClass('check-rest')) {
        $('#modal-result').modal('show');
      } else if ($this.hasClass('submit-rest')) {
        ajaxTemp({
          u: 'xhrm/submit_score',
          d: { score: myRest[1], label: label, user: user },
          b: startAjax,
          s: function(data) { 
            myAlert(data);
            $this.remove() 
          },
          c: endAjax
        });
      }
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
    blog.find('.code-toolbar pre.language-html').siblings('.toolbar').append('<button class="btn btn-default execute">Try It</button>');
    blog.find('a').addClass('link');
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
    // blog.on('click','.copy',function(){
    //   let sn = $(this).parents('.code-toolbar').find('code').text();
    //   $('body').append('<textarea>'+sn+'</textarea>');
    //   var clip = $('body>textarea');
    //   clip.select();
    //   document.execCommand('copy');
    //   clip.remove();
    // });
  });
</script>
<?php } ?>
</body>
</html>