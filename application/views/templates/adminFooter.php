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

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="<?=log?>jquery.min.js"></script>
<script src="<?= base_url('assets/js/global.js') ?>"></script>
<script src="<?=log?>popper.min.js"></script>
<script src="<?=log?>bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/vendor/sb-admin/sb-admin-2.min.js"></script>
<script src="<?=log?>jquery-ui.js"></script>
<script src="<?=base_url()?>assets/vendor/resize/resiz.js"></script>
<script src="<?=base_url()?>assets/vendor/ckeditor/ckeditor.js"></script>
<script src="<?=base_url()?>assets/vendor/ckeditor/adapters/jquery.js"></script>
<?php
echo $lessonTable || $quizTable ? '<script>$("html").addClass("fix-scroll")</script>' : '';
echo $lessonTable || $quizTable ? '<script src="'.log.'dataTable.min.js"></script>' : '';
// $editPage ? myEditorJs() : '';
echo $editPage ? '<script src="'.base_url().'assets/js/edit-lesson.js"></script>' : '';
echo $lessonTable || $quizTable ? '<script src="'.log.'select-bootstrap.min.js"></script>' : '';
echo $quizTable ? '<script src="'.base_url().'assets/js/table-quiz.js"></script>' : '';
echo $lessonTable ? '<script src="'.base_url().'assets/js/table-lesson.js"></script>' : '';
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

  function templateSnip(i){
    let links = `${host}tryit/file/${i.title.replace(/\s+/g,'-').toLowerCase()}`;
    let temp = '' +
    `<form>`+
    `<input type="hidden" name="rels" value="${i.relation}">`+
    `<button type="button" class="btn btn-block btn-default my-2" data-toggle="collapse" data-target="#acc-${i.id}" aria-expanded="false">${i.title}</button>`+
    `<div id="acc-${i.id}" data-id="${i.id}" class="collapse p-2" data-parent="#sub-accord">`+
    `<ul class="nav nav-tabs nav-fill">`+
    `<button type="button" class="btn btn-outline-success mx-1"><i class="fa fa-fw fa-save"></i></button>`+
    `<button type="button" data-href="${links}" class="btn btn-outline-dark mx-1"><i class="fa fa-fw fa-link"></i></button>`+
    `<a href="${links}" class="btn btn-outline-info mx-1" target="_blank"><i class="fa fa-fw fa-location-arrow"></i></a>`+
    `<button type="button" class="btn btn-outline-danger mx-1"><i class="fa fa-fw fa-trash-alt"></i></button>`+
    `<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-h-${i.id}">HTM</a></li>`+
    `<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-c-${i.id}">CSS</a></li>`+
    `<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-j-${i.id}">JSC</a></li>`+
    `<li class="nav-item">`+
    `<input type="hidden" name="id" value="${i.id}">`+
    `<input type="text" name="title" class="form-control" value="${i.title}"></li></ul>`+
    `<div class="tab-content">`+
    `<div class="tab-pane p-2 active" id="tab-h-${i.id}">`+
    `<textarea name="htm" rows="8">${i.htm}</textarea></div>`+
    `<div class="tab-pane p-2 fade" id="tab-c-${i.id}">`+
    `<textarea name="css" rows="8">${i.css}</textarea></div>`+
    `<div class="tab-pane p-2 fade" id="tab-j-${i.id}">`+
    `<textarea name="jsc" rows="8">${i.jsc}</textarea></div>`+
    `</div></div></form>`;
    return temp;
  }

  $(function(){
    let formConfig = $('.config form');
    formConfig.submit(function(e) {
      e.preventDefault();
      $this = $(this);
      let data = {
        key: $this.find('h3').text(),
        val: $this.find('textarea').val()
      }
      ajaxTemp({
        u: 'xhra/pages',
        d: data,
        b: null,
        s: function(data){
          myAlert(data);   
        },
        e: null
      });
    });
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