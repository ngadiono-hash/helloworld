const lessonTable = $('#table-lesson');
const mdSnip = $('#modal-snippet');
const mdAdds = $('#modal-lesson');

lessonTable.on('click','tr td:nth-child(7)',function() {
	let id = $(this).parent('tr').data('id');
	let title = $(this).parent('tr').children('td:nth-child(4)').text();
	ajaxTemp({
		u: 'xhra/fetch_snippet', d: {id: id}, c: null,
		b: function(){
			mdSnip.find('.modal-body').html('');
		},
		s: function(data){
			let temp = '';
			if (data.length > 0) {
				temp += `<h3 class="text-center">${title}</h3>`;
				temp += '<div class="accordion" id="sub-accord">';
				for (let i = 0; i < data.length; i++) {
					temp += templateSnip(data[i]);
				}
				temp += '</div>';
			} else {
				temp += '<h3 class="text-center">Nothing snippet found</h3>';
			}
			mdSnip.find('.modal-body').html(temp);
			mdSnip.modal('show');
		}
	})
});
// =================== EDIT ORDER
lessonTable.find('tbody').sortable({
	placeholder : "ui-state-highlight",
	update : function(event, ui) {
		let num_order = [];
		lessonTable.find('tbody tr').each(function(){
			num_order.push($(this).data("id"));
		});
		ajaxTemp({
			u: 'xhra/update_lesson_order', d: { num_order: num_order }, b: null, c: null,
			s: function(data){
				(data == 1) ? reloadTable('#table-lesson') : alert('something error');
			}
		});
	}
});
// =================== ADD TUTORIAL
$('.add-modal').click(function(event) {
	let tempAdd = `<h3 class="text-center">Add New Lesson</h3>
	<form id="lesson-form" autocomplete="off">
		<div class="card card-body">
			<input type="hidden" name="label" value="${label}">
			<input type="text" name="title" class="form-control my-1" placeholder="Enter Title Here...">
			<input type="text" name="slug" class="form-control my-1" placeholder="Enter Slug Here...">
			<button type="button" class="btn btn-block my-1 btn-primary">Submit</button>
		</div>
	</form>`;
	mdAdds.find('.modal-body').html(tempAdd);
	mdAdds.modal('show');
});

mdAdds.on('click','.btn-success,.btn-primary',function(e){
	e.preventDefault();
	let myData;
	myData = $(this).parents('form').serialize();
	if ($(e.target).hasClass('btn-primary')) {
		ajaxTemp({
			u: 'xhra/create_lesson', d: myData, b: null, c: null,
			s: function(data) {
				myAlert(data);
				if (data[0]) reloadTable('#table-lesson');
			}
		});
	} else if ($(e.target).hasClass('btn-success')) {
		ajaxTemp({
			u: 'xhra/update_lesson_level', d: myData, b: null, c: null,
			s: function(data) {
				myAlert(data);
				if (data[0]) reloadTable('#table-lesson');
			}
		});
	}
	mdAdds.modal('hide');
});
lessonTable.on('click','td:nth-child(2)', function(e) {
	e.preventDefault();
	let id = $(this).parent('tr').data('id');
	let lvl = $(this).parent('tr').data('level');
	let href = $('#collapseTwo').find('a').map(function(i,e) {
		return e.getAttribute('href').split('/').pop();
	});
	let tempSel = `<form><input type="hidden" name="id" value="${id}">`;
	tempSel += `<button class="btn btn-success">OK</button>`;
	tempSel += `<select id="select-level" name="level">`;
	for (let i = 0; i < href.length; i++) {
		tempSel += `<option>${href[i]}</option>`;
	}
	tempSel += `</select></form>`;
	mdAdds.find('.modal-body').html(tempSel);
	mdAdds.find('#select-level').val(lvl).selectpicker();
	mdAdds.modal('show');
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
			u: 'xhra/update_lesson_inline', d: myData,b: null, c: null,
			s: function(data){
				myAlert(data);
				reloadTable('#table-lesson');
			}
		});
	}
});
// =================== EDIT PUBLIC
lessonTable.on('click','.btn-public',function(e){
	let button = $(e.target);
	let id = $(button).parents('div').data('id') || $(button).parents('tr').data('id');
	ajaxTemp({
		u: 'xhra/update_lesson_public', d: { id: id }, b: null, c: null,
		s: function(data){
			if (data == 1) {
				$(button).toggleClass('btn-success btn-danger')
				.html('<i class="fa fa-globe-asia"></i>');
			} else {
				$(button).toggleClass('btn-danger btn-success')
				.html('<i class="fa fa-code"></i>');
			}
			reloadTable('#table-lesson');
		}
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
		url: host + $('.url').data('url'),
		type: "POST",
		data: { param : label }
	},
	createdRow: function( row, data, dataIndex, cells ) {
		var	meta 	= data['les_slug'].replace(/\s/g,'-').toLowerCase(),
		order = data['les_order'],
		id 		= data['les_id'],
		title = data['les_title'],
		slug  = data['les_slug'],
		words = data['les_length'],
		snips = data['les_snippet'],
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
			keyword = `<button class="btn btn-sm btn-block btn-outline-primary btn-keyword" data-con="${key}">${key.length}</button>`;
			linkTarget = `<a class="btn btn-sm btn-primary" href="${host}js/docs/${meta}" target="_blank"><i class="fa fa-location-arrow"></i></a>`;
		} else {
			public = {
				btn : 'btn-danger',
				icon : 'fa fa-code'
			}
			keyword = '';
			linkTarget = '';
		}

		// rows
		$(row).attr({'data-id': id, 'data-level': data['les_level']});

		if (status == '0') $(row).css('color','red');
		// order
		$(cells[2]).html(`<a class="btn" data-toggle="tooltip" title="edited: ${timeElapsed(times)}" href="${linkEdit}"><i class="fa fa-fw fa-edit"></i></a>`);
		// title
		$(cells[3]).html('<a class="btn btn-title">'+title+'</a>');
		// slug
		$(cells[4]).html('<a class="btn btn-slug">'+slug+'</a>');
		// public
		$(cells[7]).html(`<button class="btn btn-block btn-sm btn-public ${public.btn}"><i class="${public.icon}"></i></button>`);
		// ready
		$(cells[8]).html(linkTarget);
		// keyword
		$(cells[9]).html(keyword);
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
		// snippet
		{ "targets": 6, "data": 'les_snippet', "width": "80px", orderable: true },
		// public
		{ "targets": 7, "data": null, "width": "70px", orderable: false },
		// ready
		{ "targets": 8, "data": null, "width": "70px", orderable: false },
		// keyword
		{ "targets": 9, "data": null, "width": "70px", orderable: false },
	],
	"lengthMenu": [[20,50,-1], [20,50, "All"]],
	"displayLength": 20,
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
				selector: '.btn-keyword',
				trigger: 'hover',
				placement: 'left',
				content: function() {
					let temp = '';
					let k = $(this).data('con').split(',');
					for (let i = 0; i < k.length; i++) {
						temp += `<div class="card p-1 bg-light mb-1">${k[i]}</div>`;
					}
					return temp;
				}
			});


		});
	}
});