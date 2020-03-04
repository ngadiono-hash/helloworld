<?php
$lesson_page = whats_page(2,['docs']) && !empty($this->uri->segment(3));
$login_page = whats_page(2,['sign']);
?>

<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4 mb-md-0">
        <h3>About SoftLand</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius ea delectus pariatur, numquam aperiam
        dolore nam optio dolorem facilis itaque voluptatum recusandae deleniti minus animi.</p>
        <p class="social">
          <a href="#"><span class="icofont-twitter"></span></a>
          <a href="#"><span class="icofont-facebook"></span></a>
          <a href="#"><span class="icofont-dribbble"></span></a>
          <a href="#"><span class="icofont-behance"></span></a>
        </p>
      </div>
      <div class="col-md-7 ml-auto">
        <div class="row site-section pt-0">
          <div class="col-md-4 mb-4 mb-md-0">
            <h3>Navigation</h3>
            <ul class="list-unstyled">
              <li><a href="#">Pricing</a></li>
              <li><a href="#">Features</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-4 mb-md-0">
            <h3>Services</h3>
            <ul class="list-unstyled">
              <li><a href="#">Team</a></li>
              <li><a href="#">Collaboration</a></li>
              <li><a href="#">Todos</a></li>
              <li><a href="#">Events</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-4 mb-md-0">
            <h3>Downloads</h3>
            <ul class="list-unstyled">
              <li><a href="#">Get from the App Store</a></li>
              <li><a href="#">Get from the Play Store</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center text-center">
      <div class="col-md-7">
        <p class="copyright">&copy; Copyright SoftLand. All Rights Reserved</p>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>

  </div>
</footer>
<div id="result d-none"></div>

</div> <!-- .site-wrap -->
<?= ($lesson_page) ? '<a class="open-editor"><i class="fa fa-code"></i></a>' : ''; ?>
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/global.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/popper.min.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/easing.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/sticky.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/aos.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php if ($lesson_page) { ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>
<script src="<?=base_url()?>assets/vendor/resize/resiz.js"></script>
<script src="<?=base_url()?>assets/vendor/prism/prism-line.js"></script>
<script type="text/javascript">

  function runCode(delay){
    var inject = `<script>
      (function(){
        var pre = document.createElement('pre');
        pre.setAttribute('id','cons');

          let printOnScreen = function (...args) {
            var li = document.createElement("li");
            var text = document.createTextNode("> " + args.join(" - ") );
            li.appendChild(text);
            pre.appendChild(li);
            window.document.body.appendChild(pre);            

            // window.document.getElementById('cons').appendChild(li);
          };
          let methods = Object.keys(console)
          for (var i = 0, j = methods.length; i < j; i++) {
              console[methods[i]] = printOnScreen;
          }
          window.onerror = function (...args) {
              printOnScreen(args)
          }
      })();
    <\/script>`;

    var plainText = source.getValue();
    plainText += inject;
    let resultFrame = document.getElementById('result-frame').contentWindow.document;
    delay = delay || 0;
    var timer = null;
    if (timer) clearTimeout(timer);
    timer = setTimeout(function() {
      timer = null;
      resultFrame.open();
      resultFrame.writeln(plainText);
      resultFrame.close();
    },delay);
    source.focus();

  }
</script>
<script src="<?=base_url()?>assets/js/ace-config.js"></script>
<?php } ?>
<script src="<?=base_url()?>assets/vendor/theme/theme.js"></script>

<script id="main_script">

</script>
<?php if ($login_page && startSession('access')) { ?>
  <script id="log-script">
   $(document).ready(function() {
    $('.nd label').css('opacity',0);
    let btnLog = $('.btn-log');
    $('#form-login input').on('keyup',function(){
     var rmb, $1,$2,$3;
     rmb = $('#remember');
     $1 	= $('#input-key_email');
     $2 	= $('#input-key_pass');
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

    if (window.addEventListener) {

      $("#close").on("click", function() {
        $('.wrapper-editor').addClass('slide-out-bl').fadeOut();
        $('html').removeClass('body-fixed');
        $('.open-editor').fadeIn(1200);
      });
    }

    $(function(){
      linkActive('.site-menu a');
      linkActive('.lesson-menu a');
      $('.code-toolbar').append('<button class="execute btn btn-primary">Try It</button>');
      $('.wrapper-content').addClass('p-3 rounded shadow').after('<hr class="mb-5">');
      $('.execute').on('click',function() {
        var snippet = $(this).siblings('pre').children('code').text();
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
  <script>
    $(document).ready(function() {
      let acc = $('#access');
      acc.on('keypress',function(e){
        if (e.which == 13) {
          $.ajax({
            url: host + 'xhrm/adm',
            type: 'post',
            dataType: 'json',
            data: {csrf_token:csrf, access:acc.val()},
            success : function(r){
              myAlert(r);
            }
          });
        }
      });
    });
  </script>
<?php } ?>
</body>
</html>