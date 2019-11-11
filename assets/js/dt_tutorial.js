$(document).ready(function() {
// DRAW DATATABLE TUTORIAL
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
	$('#tutorials').dataTable({
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
			"url": host + $('.url-read').data('url'),
			"type": "POST"
		},
		createdRow: function( row, data, dataIndex, cells ) {
			var meta ,order, id, category, title, slug, link;
			meta 	= data['snip_meta'];
			order = data['snip_order'];
			id 		= data['snip_id'];
			title = data['snip_title'];
			slug  = data['snip_slug'];
			category = data['snip_category'];
			content = data['snip_content'];
			updates = data['snip_update'];
			status = data['snip_publish'];

			// rows
			$(row).attr('data-id', id);
			
			// edit action
			var catName; 
			if(category == '1'){
				link = host + 'a/tutorial/html/'+ order;
				catName = 'html';
			} else if (category == '2') {
				link = host + 'a/tutorial/css/'+ order;
				catName = 'css';
			} else if (category == '3') {
				link = host + 'a/tutorial/javascript/'+ order;
				catName = 'javascript';
			}
			$(cells[2]).html(
				'<a class="action btn btn-sm btn-prm" href="'+ link +'"><i class="fa fa-fw fa-edit"></i></a>'	
			);
			// title
			$(cells[3]).html(
				'<a class="btn btn-block btn-title action-title" data-id="'+ id +'">'+ title +'</a> '
			);
			// slug
			$(cells[4]).html(
				'<a class="btn btn-block btn-slug action-slug" data-id="'+ id +'">'+ slug +'</a>'
			);
			// time update
			var	rand = Math.floor(101+(Math.random()*(999-101)));
			var	times = Number(updates) +''+ rand;
			$(cells[5]).html(
				'<a class="btn btn-hr" title="'+ convert_time(Number(times),true) +'">'+ timeElapsed(times) +'</a>'
			);
			// word count
			$(cells[6]).html(
				'<span>'+ countWords(content) + '</span>'
			);
			// status public
			var set; 
			if(status == '1'){
				set = '<a class="button btn-block btn-pub btn-ok action-public" data-href="'+ host +'xhra/update_tutorial_public/'+ id +'"><i class="fa fa-globe-asia"></i></button>';
			}else{
				set = '<a class="button btn-block btn-pub btn-no action-public" data-href="'+ host +'xhra/update_tutorial_public/'+ id +'"><i class="fa fa-code"></i></button>';
			}
			$(cells[7]).html(set);

			var target, targetLink;
			if(countWords(content) == ''){
				target = '<a href="#" class="button btn-block btn-no btn-ready"> <i class="fa fa-thumbs-down"></i></a>';
			} else {
				target = '<a href="'+ host +'lesson/'+ catName +'/'+ meta +'" class="button btn-block btn-ok btn-ready" target="_blank"> <i class="fa fa-thumbs-up"></i></a>';
			}
			$(cells[8]).html(target);	

			var pre;
			if(status == '1'){
				pre = '<a class="button btn-block btn-warn btn-pre action-preview" data-href="'+host+'lesson/'+catName+'/'+meta+'">'+
				  '<i class="fa fa-eye"></i></a>';
			} else {
				pre = '';
			}
			$(cells[9]).html(pre);						
		},
		"lengthMenu": [[10,20,30,50,100,-1], [10,20,30,50,100, "All"]],
		"displayLength": 10,
		"lengthChange": true,
		"searching": false,
		"info": true,
		"scrollY": '66vh',
		"scrollCollapse": true,
		"paginate": true,
		"filter": false,
		"responsive": true,
		"processing": true,
		"serverSide": true,
		"orderable": false, 
		oLanguage: {
			sProcessing: '<i class="fa fa-cog fa-spin fa-10x fa-fw"></i>',  
		},
		"columnDefs": [
			// no
			{ "targets": 0, "data": null, "className": "center" },
			// order
			{ "targets": 1,	"data": 'snip_order', "className": "center"},
			// action
			{ "targets": 2, "data": null, "className": "center" },
			// title
			{ "targets": 3, "data": null },
			// slug
			{ "targets": 4, "data": null },
			// last update
			{ "targets": 5, "data": null },
			// words
			{ "targets": 6, "data": null, "className": "center" },
			// publish
			{ "targets": 7, "data": null, "className": "center" },
			// ready
			{ "targets": 8, "data": null, "className": "center" },
			// publish
			{ "targets": 9, "data": null, "className": "center" },
		],

		rowCallback: function(row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		}
	});	
});