<?php
$lessonTable = whats_page(2,['less']);
$editPage = whats_page(2,['editor']);
$quizTable = whats_page(2,['quiz']);
?>

  </div> <!-- End of Content Wrapper -->

</div> <!-- End of Page Wrapper -->
<div class="url d-none" data-url="<?=isset($getData) ? $getData : ''?>"></div>
<div class="ajax"></div>

<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
<div class="modal fade" id="modal-logout">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-center">Are You Sure ?</h3>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-danger" data-dismiss="modal">No</button>
          <button class="btn btn-outline-primary" onclick="logout()">Yes</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php myGlobalJs() ?>
<script src="<?=log?>popper.min.js"></script>
<script src="<?=log?>bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/vendor/sb-admin/sb-admin-2.min.js"></script>
<script src="<?=log?>jquery-ui.js"></script>
<script src="<?=base_url()?>assets/vendor/ckeditor/ckeditor.js"></script>
<script src="<?=base_url()?>assets/vendor/ckeditor/adapters/jquery.js"></script>
<?php
echo $lessonTable || $quizTable ? '<script src="'.log.'dataTable.min.js"></script>' : '';
$editPage ? myEditorJs() : '';
echo $editPage ? '<script src="'.base_url().'assets/js/edit-lesson.js"></script>' : '';
echo $quizTable ? '<script src="'.log.'select-bootstrap.min.js"></script>' : '';
echo $quizTable ? '<script src="'.base_url().'assets/js/dt-quiz.js"></script>' : '';
echo $lessonTable ? '<script src="'.base_url().'assets/js/dt-lesson.js"></script>' : '';
?>


<script>
  function htmlDecode(input){
    let e = document.createElement('textarea');
    e.innerHTML = input;
    return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
  }
  function logout(){
    window.location.href = host + 'at/logout';
  }

  $(function(){
    let urlSB = window.location;
    $('.sidebar a').filter(function() {
      return this.href == urlSB;
    }).removeClass('active').addClass('active');

    $('.sidebar a').filter(function() {
      return this.href == urlSB;
    }).parentsUntil("collapse").removeClass('show').addClass('show');
  });
</script>

</body>
</html>