// let lessonTable = $('#lesson-table');
// let label = window.location.pathname.split('/').pop();
// // =================== EDIT ORDER
// $("#lesson-table tbody").sortable({
// 	placeholder : "ui-state-highlight",
// 	update : function(event, ui) {
// 		var num_order = new Array();
// 		$('#lesson-table tbody tr').each(function(){
// 			num_order.push($(this).data("id"));
// 		});
// 		$.ajax({
// 			url : host + "xhra/update_lesson_order",
// 			type :"POST",
// 			data : { num_order : num_order },
// 			success : function(data){
// 				var parse = $.parseJSON(data);
// 				if(parse === 1){
// 					reloadTable('#lesson-table');
// 				} else {
// 					alert('something error');
// 				}
// 			}
// 		});
// 	}
// });
// // =================== ADD TUTORIAL
// $('#lesson-form').submit(function(e){
// 	e.preventDefault();
// 	var data = {
// 		"title" : $('#lesson-title').val(),
// 		"slug" : $('#lesson-slug').val(),
// 		"label" : label
// 	};
// 	$.ajax({
// 		url : host + 'xhra/create_lesson',
// 		type : 'POST',
// 		dataType : 'json',
// 		data : data,
// 		success : function(data) {
// 			if(data == 'success'){
// 				$('#modal-lesson').modal('hide');
// 				$('#lesson-form input').val('');
// 				flashAlert('success','lesson has been added');
// 				reloadTable('#lesson-table');
// 			} else {
// 				alert(data);
// 			}
// 		}
// 	});
// });
// // =================== EDIT INLINE
// lessonTable.on('dblclick','.btn-title,.btn-slug',function(){
// 	var text = $(this).text();
// 	var id = $(this).parents('tr').data('id');
// 	var newText = prompt("Enter new content for:", text);
	
// 	if (newText != null) {
// 		var data = {
// 			'id' : id,
// 			'input' : newText
// 		};
// 		data.action = ($(this).hasClass('btn-title')) ? 'title' : 'slug';
// 		$.ajax({
// 			url : host + 'xhra/update_lesson_inline',
// 			type : 'post',
// 			dataType : 'json',
// 			data : data,
// 			success : function(data){
// 				if(data == 'success'){
// 					reloadTable('#lesson-table');
// 				} else {
// 					alert(data);
// 				}
// 			}
// 		});
//   }
// });
// // =================== EDIT PUBLIC
// lessonTable.on('click','.btn-public',function(){
// 	var button = $(this);
// 	var id = $(this).parents('tr').data('id');
// 	$.ajax({
// 		url : host + 'xhra/update_lesson_public/' + id,
// 		type: 'post',
// 		success : function(data){
// 			var parse = $.parseJSON(data);
// 			if (parse == 1) {
// 				button.toggleClass('btn-success btn-danger')
// 				.html('<i class="fa fa-globe-asia"></i>');
// 			} else {
// 				button.toggleClass('btn-danger btn-success')
// 				.html('<i class="fa fa-code"></i>');
// 			}
// 			reloadTable('#lesson-table');
// 		}
// 	});
// });
// $(document).ready(function() {
// 	$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
// 		return {
// 			"iStart": oSettings._iDisplayStart,
// 			"iEnd": oSettings.fnDisplayEnd(),
// 			"iLength": oSettings._iDisplayLength,
// 			"iTotal": oSettings.fnRecordsTotal(),
// 			"iFilteredTotal": oSettings.fnRecordsDisplay(),
// 			"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
// 			"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
// 		};
// 	};
// 	$('#lesson-table').dataTable({
// 		initComplete: function() {
// 			var api = this.api();
// 			$('#data-table_filter input')
// 					.off('.DT')
// 					.on('input.DT', function() {
// 							api.search(this.value).draw();
// 			});
// 		},
// 		ajax: 
// 		{
// 			url : host + $('.url').data('url'),
// 			type : "POST",
// 			data : { param : label }
// 		},
// 		createdRow: function( row, data, dataIndex, cells ) {
// 			var meta ,order, id, title, slug, words, linkEdit, linkTarget, status, public, preview, times;
// 			meta 	= data['les_meta'];
// 			order = data['les_order'];
// 			id 		= data['les_id'];
// 			title = data['les_title'];
// 			slug  = data['les_slug'];
// 			words = data['les_length'];
// 			updates = data['les_update'];
// 			status = data['les_publish'];
// 			linkEdit = host + 'a/editor/'+label+'/'+order;
// 			times = Number(updates)+''+Math.floor(101+(Math.random()*(999-101)));

// 			if(status == 1) {
// 				public = {
// 					btn : 'btn-success',
// 					icon : 'fa fa-globe-asia'
// 				}
// 				preview = '<button class="btn btn-sm btn-block btn-outline-primary btn-preview" data-href="'+host+'lesson/'+meta+'">'+
// 				  '<i class="fa fa-eye"></i></button>';
// 				linkTarget = '<a class="btn btn-sm btn-outline-primary" href="'+ host +'lesson/docs/'+ meta +'" target="_blank"> <i class="fa fa-thumbs-up"></i></a>';
// 			} else {
// 				public = {
// 					btn : 'btn-danger',
// 					icon : 'fa fa-code'
// 				}
// 				preview = '';
// 				linkTarget = '';
// 			}

// 			// rows
// 			$(row).attr('data-id', id);
// 			if (status == '0') $(row).css('color','red');
// 			// order
// 			$(cells[2]).html('<a class="btn" data-toggle="tooltip" title="edited: '+timeElapsed(times)+'" href="'+linkEdit+'"><i class="fa fa-fw fa-edit"></i></a>');
// 			// title
// 			$(cells[3]).html('<a class="btn btn-title">'+title+'</a>');
// 			// slug
// 			$(cells[4]).html('<a class="btn btn-slug">'+slug+'</a>');
// 			// public
// 			$(cells[6]).html('<button class="btn btn-block btn-sm btn-public '+public.btn+'"><i class="'+public.icon+'""></i></button>');
// 			// ready
// 			$(cells[7]).html(linkTarget);	
// 			// preview
// 			$(cells[8]).html(preview);
// 		},
// 		"columnDefs": [
// 			// no
// 			{ "targets": 0, "data": null, "width": "50px", orderable: false, "className": "order" },
// 			// order
// 			{ "targets": 1,	"data": 'les_order', "width": "50px", orderable: true },
// 			// action
// 			{ "targets": 2, "data": null, "width": "100px", orderable: false },
// 			// title
// 			{ "targets": 3, "data": null, "width": "220px", orderable: false },
// 			// slug
// 			{ "targets": 4, "data": null, orderable: false },
// 			// words
// 			{ "targets": 5, "data": 'les_length', "width": "80px", orderable: true },
// 			// public
// 			{ "targets": 6, "data": null, "width": "70px", orderable: false },
// 			// ready
// 			{ "targets": 7, "data": null, "width": "70px", orderable: false },
// 			// preview
// 			{ "targets": 8, "data": null, "width": "70px", orderable: false },
// 		],
// 		"lengthMenu": [[10,20,30,50,100,-1], [10,20,30,50,100, "All"]],
// 		"displayLength": 10,
// 		"lengthChange": true,
// 		"searching": false,
// 		"info": true,
// 		"scrollY": '70vh',
// 		"scrollCollapse": false,
// 		"paginate": true,
// 		"filter": false,
// 		"responsive": true,
// 		"processing": true,
// 		"serverSide": true,
// 		"order": [[1,"asc"]],
// 		oLanguage: {
// 			sProcessing: '<i class="fa fa-cog fa-spin fa-10x fa-fw"></i>',  
// 		},
// 		rowCallback: function(row, data, iDisplayIndex) {
// 			var info = this.fnPagingInfo();
// 			var page = info.iPage;
// 			var length = info.iLength;
// 			var index = page * length + (iDisplayIndex + 1);
// 			$('td:eq(0)', row).html(index);
// 		}
// 	});	
// });
// $(function(){
//   $('body').tooltip({
//   	selector: '[data-toggle="tooltip"]',
//   	tooltipClass: "mytooltip",
//   	position: { 
//   		my: "left+15 center", 
//   		at: "right center" 
//   	} 
//   });
// });