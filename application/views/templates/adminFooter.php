<?php
$lessonTable = whats_page(2,['less']);
$editPage = whats_page(2,['editor']);
$quizTable = whats_page(2,['quiz']);
?>
	<div class="url d-none" data-url="<?=isset($getData) ? $getData : ''?>"></div>
	<div class="ajax"></div>

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
<?php myGlobalJs() ?>
<script src="<?=base_url()?>assets/vendor/bootstrap/popper.min.js"></script>
<script src="<?=base_url()?>assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/vendor/theme/easing.js"></script>
<script src="<?=base_url()?>assets/vendor/sb-admin/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?=base_url()?>assets/vendor/ckeditor/ckeditor.js"></script>
<script src="<?=base_url()?>assets/vendor/ckeditor/adapters/jquery.js"></script>
<?php
if ($lessonTable || $quizTable) {
	// echo '<script src="https://cdn.datatables.net/v/ju/dt-1.10.18/rr-1.2.4/datatables.min.js"></script>';
	echo "<script src='http://localhost/offline/dataTable.min.js'></script>";
}
// if ($lessonTable) {
// echo '<script src="https://cdn.datatables.net/v/ju/dt-1.10.18/rr-1.2.4/datatables.min.js"></script>';
// echo '<script src="'.base_url().'assets/js/dt_lesson.js"></script>';
// }
if ($quizTable) {
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>';
}
if ($editPage) {
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>';
echo '<script src="'.base_url().'assets/vendor/resize/resiz.js"></script>';
echo '<script src="'.base_url().'assets/js/config.js"></script>';
} ?>


<script id="mainScript">
function htmlDecode(input){
  let e = document.createElement('textarea');
  e.innerHTML = input;
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}
function logout(){
  window.location.href = host + 'at/logout';
}
function publicLesson(e){
	let button = $(e.target);
	ajaxTemp({
		u: 'xhra/update_lesson_public',
		d: { id: $(button).parents('div').data('id') || $(button).parents('tr').data('id') },
		b: null,
		s: function(data){
			if (data == 1) {
				$(button).toggleClass('btn-success btn-danger')
				.html('<i class="fa fa-globe-asia"></i>');
			} else {
				$(button).toggleClass('btn-danger btn-success')
				.html('<i class="fa fa-code"></i>');
			}
			reloadTable('#table-lesson');
		},
		c: null
	});
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
<?php if ($quizTable) { ?>
<script name="quizTable">
	const modalQuiz = $('#modal-quiz'), tableQuiz = $('#table-quiz');
	
	$(function(){
		CKEDITOR.replace('ckquiz',{ customConfig: `${host}assets/js/cke.js` });
		$('#select-for').selectpicker({ liveSearch: true,size: 5,title: 'select quiz' });
		$('#select-answer').selectpicker({title: 'correct answer'});
		$('.btn-modal').click(function() {
			modalQuiz.modal('show');
			modalQuiz.find('h3').html('Add New Quiz');
		});
		modalQuiz.on('hide.bs.modal',function(){
			CKEDITOR.instances.ckquiz.setData('');
			$('#select-for,#select-answer').val('').attr('disabled',false).selectpicker('refresh');
			modalQuiz.find('input').val('');
		});
		tableQuiz.on('click','.btn-quest',function(e) {
			ajaxTemp({
				u: 'xhra/fetch_quiz',
				d: { id: $(e.target).parents('tr').data('id')},
				b: null,
				s: function(data){
					modalQuiz.modal('show');
					modalQuiz.find('h3').html('Edit this Quiz : #' +data.id);
					modalQuiz.find('#select-for').attr('disabled',true);
					$('#id').val(data.id);
					let some = [];
					let answerInArr = data.q_answer.split(',');
					for (let i = 0; i <= answerInArr.length; i++) {
						some[i] = htmlDecode(answerInArr[i]);
						$('#choice'+(i+1)).val(some[i]);
					}
					CKEDITOR.instances.ckquiz.setData(data.q_question);
					$('#select-for').val(data.q_rel).selectpicker('refresh');
					$('#select-answer').val(data.q_correct).selectpicker('refresh');
				},
				c: null
			});
		});
		tableQuiz.on('click','.btn-trash',function(e) {
			let conf = confirm('Are you sure want to delete this ?');
			if (conf) {
				ajaxTemp({
					u: 'xhra/delete_quiz',
					d: { id: $(e.target).parents('tr').data('id') },
					b: null,
					s: function(data){
						if (data[0] == 1) reloadTable('#table-quiz');
						myAlert(data);
					},
					c: null
				});
			}
		});
		
		modalQuiz.on('click','#btn-action-quiz',function() {
			let inputs = $('#add-answer input[name="choice[]"]'),
			    names  = [].map.call(inputs,function(input) {
			      return input.value;
			    }).join(',');
			let myData = {
				id : $('#id').val(),
				rel : $('#select-for').val(),
				label : label,
				question : CKEDITOR.instances.ckquiz.getData(),
				answer : names,
				correct : $('#select-answer').val()
			};
			ajaxTemp({
				u: 'xhra/create_quiz',
				d: myData,
				b: null,
				s: function(data){
					if (data[0] == 1) {
						CKEDITOR.instances.ckquiz.setData('');
						$('#select-for,#select-answer').val('').selectpicker('refresh');
						modalQuiz.find('input').val('');
						modalQuiz.modal('hide');
						reloadTable('#table-quiz');
					}
					myAlert(data);
				},
				c: null
			});
		});

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

		tableQuiz.dataTable({
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
				var	id 		= data['id'],
						cor   = data['q_correct'],
						ans   = data['q_answer'].split(','),
						quest = data['q_question'].replace(/<\/?[^>]+(>|$)/g,''),
						correct = '';
						switch(cor) {
							case '1': 
								correct = 'A'; break;
							case '2': 
								correct = 'B'; break;
							case '3': 
								correct = 'C'; break;
							case '4': 
								correct = 'D'; break;
							default:
								correct = '*'; 
						}
				$(row).attr('data-id', id);
				$(cells[3]).html(`<button class="btn btn-block btn-outline-primary btn-quest">${quest.substr(0,75)}</button>`);
				$(cells[4]).html(`<button class="btn btn-block btn-outline-primary btn-answer" data-correct="${cor}" data-choice="${ans}"><i class="fa fa-question"></i></button>`);
				$(cells[5]).html(`<button class="btn btn-block btn-outline-danger btn-trash">${correct}</button>`);
			}, 
			"columnDefs": [
				{ "targets": 0, "data": null, "width": "50px", orderable: false },
				{ "targets": 1,	"data": 'les_title', "width": "130px", orderable: true, 'className': 'text-left' },
				{ "targets": 2, "data": 'q_order', "width": "50px", orderable: true },
				{ "targets": 3, "data": null, orderable: false },
				{ "targets": 4, "data": null, "width": "100px", orderable: false },
				{ "targets": 5, "data": null, "width": "50px", orderable: false }
			],
			"lengthMenu": [[10,20,30,50,-1], [10,20,30,50, "All"]],
			"displayLength": 50,
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
				  $('body').popover({
            html: true,
            selector: '.btn-answer',
            trigger: 'hover',
            placement: 'left',
            content : function() {
            	var cor = $(this).data('correct');
            	var keys = $(this).data('choice').split(',').map(function(index,elem) {
            		var i = '';
            		i += `<span class="${(elem == (cor - 1)) ? 'text-danger': ''}">${index}</span>`;
            		return i;
            	});
            	
            	return '<div class="card"><div class="card-body">'+keys.join('<hr class="my-2">')+'</div></div>';
            }
          });
				});
			}
		});
	});
</script>
<?php } ?>
<?php if($lessonTable) { ?>
<script name="lessonTable">
	const lessonTable = $('#table-lesson');
	// =================== EDIT ORDER
	lessonTable.find('tbody').sortable({
		placeholder : "ui-state-highlight",
		update : function(event, ui) {
			var num_order = [];
			lessonTable.find('tbody tr').each(function(){
				num_order.push($(this).data("id"));
			});
			ajaxTemp({
				u: 'xhra/update_lesson_order',
				d: { num_order: num_order },
				b: null,
				s: function(data){
					(data == 1) ? reloadTable('#table-lesson') : alert('something error');
				},
				c: null
			});
		}
	});
	// =================== ADD TUTORIAL
	$('#lesson-form').submit(function(e){
		e.preventDefault();
		ajaxTemp({
			u: 'xhra/create_lesson',
			d: {
				title: $('#lesson-title').val(),
				slug: $('#lesson-slug').val(),
				label: label
			},
			b: null,
			s: function(data) {
				myAlert(data);
				reloadTable('#table-lesson');
				$('#modal-lesson').modal('hide');
				$('#lesson-form input').val('');
			},
			c: null
		});
	});
	// =================== EDIT INLINE
	lessonTable.on('dblclick','.btn-title,.btn-slug',function(){
		let text = $(this).text(),
			id = $(this).parents('tr').data('id'),
			newText = prompt("Enter new content for:",text);
		if (newText != null) {
			let myData = { id: id, input: newText };
			myData.action = ($(this).hasClass('btn-title')) ? 'title' : 'slug';
			ajaxTemp({
				u: 'xhra/update_lesson_inline',
				d: myData,
				b: null,
				s: function(data){
					myAlert(data);
					reloadTable('#table-lesson');
				},
				c: null
			});
	  }
	});
	// =================== EDIT PUBLIC
	lessonTable.on('click','.btn-public',function(e){
		publicLesson(e);
	});

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
	lessonTable.dataTable({
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
          trigger: 'hover',
          placement: 'left',
          content : function() {
          	var keys = $(this).data('con').split(',').join('<hr class="m-1">');
          	return '<div class="card">'+keys+'</div>';
          }
        });
			});
		}
	});
</script>
<?php } ?>

<?php if($editPage) { ?>
<script name="editPage">
	const edited = $('#edited-lesson');
	$(function(){
		CKEDITOR.dtd.$removeEmpty['i'] = false;
		CKEDITOR.replace('ckedit');

		edited.on('click','#btn-preview',function(){
			let container = CKEDITOR.instances.ckedit.getData();
			let previewFrame = document.getElementById('frame-preview').contentWindow.document;
			let plainText = '' +
			`<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Roboto">`+
		  `<link rel="stylesheet" href="${host}assets/vendor/bootstrap/bootstrap.min.css">`+
		  `<link rel="stylesheet" href="${host}assets/vendor/theme/theme.css">`+
		  `<link rel="stylesheet" href="${host}assets/vendor/prism/prism-line.css">`+
		  `<link rel="stylesheet" href="${host}assets/css/content.css">`+
		  `<style>body { padding: 30px; text-align: justify; }</style>`+
			container +
			`<script src="${host}assets/vendor/prism/prism-line.js"><\/script>`+
			`<script src="${host}assets/vendor/jquery/jquery.min.js"><\/script>`+
			`<script>$('.wrapper-content').addClass('p-3 rounded shadow').after('<hr class="mb-5">');<\/script>`;
			previewFrame.open();
			previewFrame.writeln(plainText);
			previewFrame.close();
		});
		// =================== UPDATE
		edited.on('click','#btn-update',function(){
			let countWords = $('#cke_wordcount_ckedit').text().replace(',','').split(' ');
			let myData = {
				id: $('#input-id').val(),
				title: $('#input-title').val(),
				slug: $('#input-slug').val(),
				content : CKEDITOR.instances.ckedit.getData(),
				length : countWords[3]
			};
			ajaxTemp({
				u: 'xhra/update_lesson',
				d: myData,
				b: startAjax,
				s: function(data){
					myAlert(data);
					if (data[0] == 1) {
						$('#input-update').val(data[3]).css('color','red');
						let h3 = '', h4 = '';
						if(data[4] != ''){
							data[4].forEach(function(el) { h3 += '<li>'+el+'</li>' });
						}
						if (data[5] != '') {
							data[5].forEach(function(el) { h4 += '<li>'+el+'</li>' });
						}
						$('#sub-h3').html(h3);
						$('#sub-h4').html(h4);
					}
				},
				c: endAjax
			});
		});

		// =================== PUBLIC
		edited.on('click','#btn-public',function(e){
			publicLesson(e);
		});
		// =================== DELETE
		edited.on('click','.btn-del',function(e){
			alert('nothing happend');
		});
	});
</script>
<?php } ?>
</body>
</html>