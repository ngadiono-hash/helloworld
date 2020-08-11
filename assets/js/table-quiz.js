
const modalQuiz = $('#modal-quiz'), tableQuiz = $('#table-quiz');
CKEDITOR.replace('ckquiz',{ customConfig: `${host}assets/js/cke.js` });

$('#select-level').selectpicker({ size: 5,title: 'select level' })
$('#select-materi').selectpicker({ liveSearch: true,size: 5,title: 'select quiz' });
$('#select-answer').selectpicker({ title: 'correct answer' });

$('.add-modal').click(function() {
	modalQuiz.find('h3').html('Add New Quiz');
	modalQuiz.modal('show');
});
modalQuiz.on('hide.bs.modal',function(){
	CKEDITOR.instances.ckquiz.setData('');
	$('#select-materi,#select-answer').val('').attr('disabled',false).selectpicker('refresh');
	modalQuiz.find('input').val('');
});
modalQuiz.on('click','#btn-action-quiz',function() {
	let inputs = $('#add-answer input[name="choice[]"]');
	let names  = [].map.call(inputs,function(input) {
	      return input.value;
	    }).join(',');
	let myData = {
		id : $('#id-quiz').val(),
		rel : $('#select-materi').val(),
		label : $('#select-level').val(),
		title : $('#qlue').val(),
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
				$('#select-materi,#select-answer,#select-level').val('').selectpicker('refresh');
				modalQuiz.find('input').val('');
				modalQuiz.modal('hide');
				reloadTable('#table-quiz');
			}
			myAlert(data);
		},
		c: null
	});
});
tableQuiz.on('click','.btn-quest',function(e) {
	ajaxTemp({
		u: 'xhra/fetch_quiz',
		d: { id: $(e.target).parents('tr').data('id') }, c: null, b: null,
		s: function(data){
			modalQuiz.find('h3').html('Edit : #' + data.id);
			$('#select-level').val(data.q_level).selectpicker('refresh');
			$('#select-materi').val(data.q_rel).selectpicker('refresh');
			$('#select-answer').val(data.q_correct).selectpicker('refresh');
			// modalQuiz.find('#select-materi').attr('disabled',true);
			$('#id-quiz').val(data.id);
			$('#qlue').val(data.q_title);
			CKEDITOR.instances.ckquiz.setData(data.q_question);
			let some = [];
			let answerInArr = data.q_answer.split(',');
			for (let i = 0; i <= answerInArr.length; i++) {
				some[i] = htmlDecode(answerInArr[i]);
				$('#choice'+(i+1)).val(some[i]);
			}
			modalQuiz.modal('show');
		}
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
		$(row).attr({ 'data-id': id,'data-val': data.les_id });
		$(cells[3]).html(`<button class="btn btn-quest">${quest}</button>`);
		$(cells[4]).html(`<button class="btn btn-block btn-answer" data-correct="${cor}" data-choice="${ans}"><i class="fa fa-question"></i></button>`);
		$(cells[5]).html(`<button class="btn btn-block btn-outline-danger btn-trash">${correct}</button>`);
	}, 
	"columnDefs": [
		{ "targets": 0, "data": null, "width": "50px", orderable: false },
		{ "targets": 1,	"data": 'les_title', "width": "130px", 'className': 'text-left' },
		{ "targets": 2, "data": 'q_title' },
		{ "targets": 3, "data": null, orderable: false },
		{ "targets": 4, "data": null, "width": "100px", orderable: false },
		{ "targets": 5, "data": null, "width": "50px", orderable: false }
	],
	"lengthMenu": [[50,-1], [50, "All"]],
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
			var ips = [];
			  
			tableQuiz.find('tr').each(function(){
			  let ip = $(this).data('val');
			  ips.push(ip);
			});
			ips = jQuery.unique(ips);
			var colors = ['lightblue','lavender','lightsalmon','lightyellow','palegreen','lightcyan','lightsteelblue','bisque'];
			var ie = 0;

			$.each(ips,function(i,e) {
				if(ie > colors.length-1) ie = 0;

				$('table tr[data-val="' + e + '"]').css('background',colors[ie]);
				 ie++;
			});

		  $('body').popover({
        html: true,
        selector: '.btn-answer',
        trigger: 'hover',
        placement: 'left',
        content : function() {
        	var cor = $(this).data('correct');
        	var keys = $(this).data('choice').split(',').map(function(index,elem) {
        		let i = '';
        		i += `<span class="${(elem == (cor - 1)) ? 'text-danger': ''}">${index}</span>`;
        		return i;
        	});
        	
        	return '<div class="card"><div class="card-body">'+keys.join('<hr class="my-2">')+'</div></div>';
        }
      });
		});
	}
});

