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
				linkTarget = '<a class="btn btn-sm btn-outline-primary" href="'+ host +'js/docs/'+ meta +'" target="_blank"> <i class="fa fa-thumbs-up"></i></a>';
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