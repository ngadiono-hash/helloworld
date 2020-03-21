<?php
$tablePage = whats_page(2,['less']);
$editPage = whats_page(2,['editor']);
?>
	<div class="url d-none" data-url="<?=isset($getLesson) ? $getLesson : ''?>"></div>
	<div id="result"></div>

  </div> <!-- End of Content Wrapper -->

</div> <!-- End of Page Wrapper -->

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
<script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>assets/js/glo.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/popper.min.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/easing.js"></script>

<script src="<?=base_url()?>assets/vendor/sb-admin/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php if ($tablePage) {
echo '<script src="https://cdn.datatables.net/v/ju/dt-1.10.18/rr-1.2.4/datatables.min.js"></script>';
// echo '<script src="'.base_url().'assets/js/dt_lesson.js"></script>';
} ?>
<?php if ($editPage) {
echo '<script src="'.base_url().'assets/vendor/ckeditor/ckeditor.js"></script>';
echo '<script src="'.base_url().'assets/vendor/ckeditor/adapters/jquery.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>';
echo '<script src="'.base_url().'assets/vendor/resize/resiz.js"></script>';
echo '<script src="'.base_url().'assets/js/conf.js"></script>';
} ?>


<script id="main-script">
function logout(){
  window.location.href = host + 'at/logout';
}
$(function(){
	var url = window.location;
	$('.sidebar a').filter(function() {
			return this.href == url;
	}).removeClass('active').addClass('active');

	$('.sidebar a').filter(function() {
			return this.href == url;
	}).parentsUntil("collapse").removeClass('show').addClass('show');
});
</script>


<?php if($tablePage) { ?>
<script id="lesson-dataTable">
	let lessonTable = $('#lesson-table');
	let label = window.location.pathname.split('/').pop();
	// =================== EDIT ORDER
	$("#lesson-table tbody").sortable({
		placeholder : "ui-state-highlight",
		update : function(event, ui) {
			var num_order = new Array();
			$('#lesson-table tbody tr').each(function(){
				num_order.push($(this).data("id"));
			});
			$.ajax({
				url : host + "xhra/update_lesson_order",
				type :"POST",
				data : { num_order : num_order },
				success : function(data){
					var parse = $.parseJSON(data);
					if(parse === 1){
						reloadTable('#lesson-table');
					} else {
						alert('something error');
					}
				}
			});
		}
	});
	// =================== ADD TUTORIAL
	$('#lesson-form').submit(function(e){
		e.preventDefault();
		var data = {
			"title" : $('#lesson-title').val(),
			"slug" : $('#lesson-slug').val(),
			"label" : label
		};
		$.ajax({
			url : host + 'xhra/create_lesson',
			type : 'POST',
			dataType : 'json',
			data : data,
			success : function(data) {
				myAlert(data);
				reloadTable('#lesson-table');
				$('#modal-lesson').modal('hide');
				$('#lesson-form input').val('');
			}
		});
	});
	// =================== EDIT INLINE
	lessonTable.on('dblclick','.btn-title,.btn-slug',function(){
		var text = $(this).text();
		var id = $(this).parents('tr').data('id');
		var newText = prompt("Enter new content for:", text);

		if (newText != null) {
			var data = {
				'id' : id,
				'input' : newText
			};
			data.action = ($(this).hasClass('btn-title')) ? 'title' : 'slug';
			$.ajax({
				url : host + 'xhra/update_lesson_inline',
				type : 'post',
				dataType : 'json',
				data : data,
				success : function(data){
					myAlert(data);
					reloadTable('#lesson-table');
				}
			});
	  }
	});
	// =================== EDIT PUBLIC
	lessonTable.on('click','.btn-public',function(){
		var button = $(this);
		var id = $(this).parents('tr').data('id');
		$.ajax({
			url : host + 'xhra/update_lesson_public/' + id,
			type: 'post',
			success : function(data){
				var parse = $.parseJSON(data);
				if (parse == 1) {
					button.toggleClass('btn-success btn-danger')
					.html('<i class="fa fa-globe-asia"></i>');
				} else {
					button.toggleClass('btn-danger btn-success')
					.html('<i class="fa fa-code"></i>');
				}
				reloadTable('#lesson-table');
			}
		});
	});
	$(document).ready(function() {
		$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
			return {
				"iStart": oSettings._iDisplayStart,
				"iEnd": oSettings.fnDisplayEnd(),
				"iLength": oSettings._iDisplayLength,
				"iTotal": oSettings.fnRecordsTotal(),
				"iFilteredTotal": oSettings.fnRecordsDisplay(),
				"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
				"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
			};
		};
		$('#lesson-table').dataTable({
			initComplete: function() {
				var api = this.api();
				$('#data-table_filter input')
						.off('.DT')
						.on('input.DT', function() {
								api.search(this.value).draw();
				});
			},
			ajax:
			{
				url : host + $('.url').data('url'),
				type : "POST",
				data : { param : label }
			},
			createdRow: function( row, data, dataIndex, cells ) {
				var	meta 	= data['les_slug'].replace(/\s/g,'-').toLowerCase(),
						order = data['les_order'],
						id 		= data['les_id'],
						title = data['les_title'],
						slug  = data['les_slug'],
						words = data['les_length'],
						updates = data['les_update'],
						status = data['les_publish'],
						key = data['les_key'],
						key = (key != null) ? key.split(',') : [],
						linkEdit = host + 'a/editor/'+label+'/'+order,
						times = Number(updates)+''+Math.floor(101+(Math.random()*(999-101)));

				var public, linkTarget;
				if(status == 1) {
					public = {
						btn : 'btn-success',
						icon : 'fa fa-globe-asia'
					}
					preview = `<button class="btn btn-sm btn-block btn-outline-primary btn-preview" data-con="${key}"><i class="fa fa-eye"></i></button>`;
					linkTarget = '<a class="btn btn-sm btn-outline-primary" href="'+ host +'lesson/docs/'+ meta +'" target="_blank"> <i class="fa fa-thumbs-up"></i></a>';
				} else {
					public = {
						btn : 'btn-danger',
						icon : 'fa fa-code'
					}
					preview = '';
					linkTarget = '';
				}

				// rows
				$(row).attr('data-id', id);
				if (status == '0') $(row).css('color','red');
				// order
				$(cells[2]).html('<a class="btn" data-toggle="tooltip" title="edited: '+timeElapsed(times)+'" href="'+linkEdit+'"><i class="fa fa-fw fa-edit"></i></a>');
				// title
				$(cells[3]).html('<a class="btn btn-title">'+title+'</a>');
				// slug
				$(cells[4]).html('<a class="btn btn-slug">'+slug+'</a>');
				// public
				$(cells[6]).html('<button class="btn btn-block btn-sm btn-public '+public.btn+'"><i class="'+public.icon+'""></i></button>');
				// ready
				$(cells[7]).html(linkTarget);
				// preview
				$(cells[8]).html(preview);
			},
			"columnDefs": [
				// no
				{ "targets": 0, "data": null, "width": "50px", orderable: false, "className": "order" },
				// order
				{ "targets": 1,	"data": 'les_order', "width": "50px", orderable: true },
				// action
				{ "targets": 2, "data": null, "width": "100px", orderable: false },
				// title
				{ "targets": 3, "data": null, "width": "220px", orderable: false },
				// slug
				{ "targets": 4, "data": null, orderable: false },
				// words
				{ "targets": 5, "data": 'les_length', "width": "80px", orderable: true },
				// public
				{ "targets": 6, "data": null, "width": "70px", orderable: false },
				// ready
				{ "targets": 7, "data": null, "width": "70px", orderable: false },
				// preview
				{ "targets": 8, "data": null, "width": "70px", orderable: false },
			],
			"lengthMenu": [[10,20,30,50,100,-1], [10,20,30,50,100, "All"]],
			"displayLength": 10,
			"lengthChange": true,
			"searching": false,
			"info": true,
			"scrollY": '70vh',
			"scrollCollapse": false,
			"paginate": true,
			"filter": false,
			"responsive": true,
			"processing": true,
			"serverSide": true,
			"order": [[1,"asc"]],
			"oLanguage": {
				sProcessing: '<i class="fa fa-cog fa-spin fa-10x fa-fw"></i>',
			},
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
				$(function(){
				  $('body').tooltip({
				  	selector: '[data-toggle="tooltip"]',
				  	tooltipClass: "mytooltip",
				  	position: {
				  		my: "left+15 center",
				  		at: "right center"
				  	}
				  });
				  $('body').popover({
            html: true,
            selector: '.btn-preview',
            trigger: 'hover click',
            placement: 'left',
            content : function() {
            	var keys = $(this).data('con').split(',').join('<hr class="m-1">');
            	return '<div class="card">'+keys+'</div>';
            }
          });
				});
			}
		});
	});
</script>
<?php } ?>

<?php if($editPage) { ?>
<script id="editPage">
	$(function(){
		$('#temp').on('click', function(){
			let temp = ``;
			temp += `<!DOCTYPE html>\n<html>\n<head>\n  <title></title>\n</head>`;
			temp += `\n<body>\n  <h1></h1>\n\n<script><\/script>\n</body>\n</html>`;
		  source.getSession().setValue(temp);
		  source.gotoLine(6);
		  source.focus();
		});
		$('#del').on('click', function() {
			source.getSession().setValue('');
			source.focus();
		});
		$("#close").on("click", function() {
		  $('.wrapper-editor').addClass('slide-out-bl').fadeOut();
		  $('.temp-editor').fadeIn(1200);
		});
		$('.temp-editor').on('click',function() {
		  if ($('.wrapper-editor').hasClass('slide-out-bl')) {
		    $('.wrapper-editor').removeClass('slide-out-bl');
		  }
		  $('.temp-editor').fadeOut();
		  $('.wrapper-editor').fadeIn().addClass('scale-in-center');
		  source.focus();
		});
	});

	CKEDITOR.dtd.$removeEmpty['i'] = false;
	CKEDITOR.replace('ckedit');

	let edited = $('#edited-lesson');
	edited.on('click','#btn-preview',function(){
		let container = CKEDITOR.instances.ckedit.getData();
		let previewFrame = document.getElementById('frame-preview').contentWindow.document;
		let plainText = '' +
		`<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700|Roboto:300,400,700&display=swap">`+
	  `<link rel='stylesheet' href='${host}assets/vendor/bootstrap/bootstrap.min.css'>`+
	  `<link rel='stylesheet' href='${host}assets/vendor/theme/theme.css'>`+
	  `<link rel='stylesheet' href='${host}assets/vendor/prism/prism-line.css'>`+
	  `<link rel='stylesheet' href='${host}assets/css/content.css'>`+
	  `<style>body { padding: 30px; text-align: justify; }</style>`+
		container +
		`<script src='${host}assets/vendor/prism/prism-line.js'><\/script>`+
		`<script src='${host}assets/vendor/jquery/jquery.min.js'><\/script>`+
		`<script>$('.wrapper-content').addClass('p-3 rounded shadow').after('<hr class="mb-5">');<\/script>`;
		previewFrame.open();
		previewFrame.writeln(plainText);
		previewFrame.close();
	});
	// =================== UPDATE
	edited.on('click','#btn-update',function(){
		let countWords = $('#cke_wordcount_ckedit').text().replace(',','').split(' ');
		let datax = {
			'id': $('#input-id').val(),
			'title' : $('#input-title').val(),
			'slug' : $('#input-slug').val(),
			'content' : CKEDITOR.instances.ckedit.getData(),
			'length' : countWords[3],
		};
		$.ajax({
			url : host + 'xhra/update_lesson',
			type : 'post',
			dataType : 'json',
			data : datax,
			success : function(data){
				myAlert(data);
				if (data[0] == 1) {
					$('#input-update').val(data[3]).css('color','red');
					let h3 = '', h4 = '';
					if(data[4] != ''){
						data[4].forEach(function(el){
							h3 += '<li>'+el+'</li>';
						});
					}
					if (data[5] != '') {
						data[5].forEach(function(el){
							h4 += '<li>'+el+'</li>';
						});
					}
					$('#sub-h3').html(h3);
					$('#sub-h4').html(h4);
				}
			}
		});
	});
	// =================== PUBLIC
	edited.on('click','#btn-public',function(){
		let button = $(this);
		let id = $(button).data('id');
		$.ajax({
			url : host + 'xhra/update_lesson_public/' + id,
			type: 'post',
			success : function(data){
				let parse = $.parseJSON(data);
				if(parse == 1){
					button.toggleClass('btn-success btn-danger')
					.html('<i class="fa fa-globe-asia"></i>');
				}else{
					button.toggleClass('btn-danger btn-success')
					.html('<i class="fa fa-code"></i>');
				}
			}
		});
	});
	// =================== DELETE
	// edited.on('click','.btn-del',function(e){
	// 	e.preventDefault();
	// 	let href = $(this).data('href');
	// 		// var vals = $(this).data('value');
	// 	Swal.fire({
	// 		title : 'Are you sure ?',
	// 		html : '<p class="html-swal">This snippet will be removed</p>',
	// 		type : 'warning',
	// 		showCancelButton : true,
	// 		buttonsStyling : false,
	// 		customClass: {
	// 			confirmButton: 'effect effect-prm',
	// 			cancelButton: 'effect effect-no'
	// 		},
	// 		confirmButtonText: '<span>Yes</span>',
	// 		cancelButtonText: '<span>No</span>',
	// 	}).then((result) => {
	// 		if(result.value){
	// 			$.ajax({
	// 				url : href,
	// 				type : 'post',
	// 				success : function(data){
	// 					alertSuccess('blank',['success','tutorial has been deleted',''+imgLoad+''],'');
	// 					window.history.back();
	// 				}
	// 			});
	// 		}
	// 	});
	// });
</script>
<?php } ?>
</body>
</html>