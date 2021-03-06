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
        <div class="row pt-0">
          <div class="col-sm-6 mb-4 mb-md-0">
            <h3>Navigation</h3>
            <ul class="list-unstyled">
              <li><a class="link" href="<?=base_url('js/files')?>">Materi JavaScript</a></li>
              <li><a class="link" href="<?=base_url('tryit/file/demo')?>">JavaScript Editor</a></li>
              <li><a class="link" href="<?=base_url('js/quiz')?>">JavaScript Quiz</a></li>
            </ul>
          </div>
          <div class="col-sm-6 mb-4 mb-md-0">
            <h3>Services</h3>
            <ul class="list-unstyled">
              <li><a class="link" href="#">Contact</a></li>
              <li><a class="link" href="#">About</a></li>
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

</div>

<div class="overlay"></div>
<div class="ajax"></div>
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

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script src="<?=log?>jquery.min.js"></script>
<script src="<?= base_url('assets/js/global.js') ?>"></script>
<script src="<?=log?>popper.min.js"></script>
<script src="<?=log?>bootstrap.min.js"></script>
<script src="<?=log?>jquery.mark.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/easing.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/sticky.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/aos.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/owl.carousel.min.js"></script>
<script src="<?=log?>jquery-ui.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/theme.js"></script>
<script src="<?=base_url()?>assets/vendor/prism/prism-line.js"></script>
<?php
echo $quiz_page ? '<script src="'.base_url().'assets/js/js-quiz.js"></script>' : '';
echo $lesson_page ? '<script src="'.base_url().'assets/js/js-lesson.js"></script>' : '';
echo ($login_page && startSession('access')) ? '<script src="'.base_url().'assets/js/login.js"></script>' : '';
if ($login_page) { ?>
<script>
  let acc = $('#access');
  acc.on('keypress',function(e){
    if (e.which == 13) {
      ajaxTemp({
        u: 'xhrm/adm', d: { access: acc.val()}, b: null, c: null,
        s: function(data){
          myAlert(data);
          if (data[0] == 0) acc.val('');
        }
      });
    }
  });
</script>
<?php } ?>
<script>
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
        let inval = $(this).val();
        ajaxTemp({
          u: 'xhrm/search', d: { search: inval }, b: startAjax, c: endAjax,
          s: function(data){            
            $('#modal-search h3').html(data[1]);
            let temp = '';
            let arrays = [];
            if (data[0] == 1) {
              for (let i = 0; i < data[2].length; i++) {
                let $this = data[2][i];
                arrays = $this.keys.join(' | ');
                temp += `<div class="card"><span class="label shadow">${$this.level}</span>`;
                temp += `<a class="btn btn-block btn-default" href="${$this.link}">${$this.title} - ${$this.slug}</h5></a>`;
                temp += `<div class="card-body p-3 bg-light"><p class="m-0">${arrays}</p></div></div><hr>`;
              };
              $('#modal-search .search-result').html(temp);
              $('.search-result p').mark(inval,{ "element": "span","className": "highlight" });

            } else {
              $('#modal-search .search-result').html('');
            }
            $('#modal-search').modal('show');
          }
        });
      }
    });
  });
</script>

</body>
</html>