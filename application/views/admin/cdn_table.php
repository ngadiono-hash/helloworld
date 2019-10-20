
<div class="content-wrapper">
	<section class="content">
		<a class="btn btn-sm btn-ok btn-modal" data-toggle="modal" data-target="#modal_add"><i class="fa fa-fw fa-plus"></i> Add New</a>
		<div class="wrap-table">
			<div class="table-responsive">
				<table class="display" id="cdn_table">
					<thead>
						<tr>
							<th>No.</th>
							<th><i class="fa fa-cog"></i></th>
							<th>Type</th>
							<th>Name</th>
							<th>Version</th>
							<th>Link</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>	
	</section>
</div>
<div class="modal fade" id="modal_add">
  <div class="modal-dialog">
   	<form id="form_add">
	    <div class="modal-content">
  			<h2>ADD NEW CDN</h2>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-xs-6">
			      	<label>CDN Name</label>
			      	<input type="text" name="cdn_name" class="input-adjust">
			      	<hr>
			      	<label>CDN Version</label>
			      	<input type="text" name="cdn_version" class="input-adjust">
			      	<hr>	      			
	      		</div>
	      		<div class="col-xs-6">
			      	<label>CDN Type</label><br>
			      	<select name="cdn_type" class="selectpicker">
			      		<option value="1">CSS</option>
			      		<option value="2">JS</option>
			      	</select>
	      		</div>
	      	</div>
	      	<label>CDN Link</label>
	      	<input type="text" name="cdn_link" class="input-adjust">
	      </div>
	      <div class="modal-footer center">
	        <button class="btn button btn-ok btn-add" style="width: 50%">SUBMIT</button>
	      </div>
	    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal_edit">
  <div class="modal-dialog">
   	<form method="POST" id="form_edit">
	    <div class="modal-content">
  			<h2>EDIT CDN</h2>
	      <div class="modal-body">
	      	<input type="hidden" id="cdn-id" name="cdn_id">
	      	<label>CDN Name</label>
	      	<input type="text" id="cdn-name" name="cdn_name" class="input-adjust"><hr>
	      	<label>CDN Version</label>
	      	<input type="text" id="cdn-version" name="cdn_version" class="input-adjust"><hr>
	      	<label>CDN Link</label>
	      	<input type="text" id="cdn-link" name="cdn_link" class="input-adjust">
	      </div>
	      <div class="modal-footer center">
	        <button class="btn button btn-prm btn-update" style="width: 50%">UPDATE</button>
	      </div>
	    </div>
    </form>
  </div>
</div>

<script>

$(document).ready(function(){
	
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
	$('#cdn_table').dataTable({
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
		createdRow: function( row, data, dataIndex , cells) {
			if ( data['cdn_type'] == 1 ) {
	      $(cells[2]).html('<a class="btn btn-sm btn-block btn-prm">css</a>');
	    } else {
	    	$(cells[2]).html('<a class="btn btn-sm btn-block btn-warn">js</a>');;
	    }
		},
				
		// "rowId": 'staffId',
		"lengthMenu": [[10,20,30,50,100,-1], [10,20,30,50,100, "All"]],
		"displayLength": 20,
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
		"orderable": true, 
		oLanguage: {
			sProcessing: '<i class="fa fa-cog fa-spin fa-10x fa-fw"></i>',  
		},
		"columnDefs": [
			{ // no
				"targets": 0,
				"data": null,
				"className": "center",
				"orderable": false, 
			},
			{ // action
				"targets": 1,
				"data":  null,
				"className": "center",
				"orderable": false,
				"render": function(data){
						var obj, id, name, version, link, result;
						id 	= data['id'];
						name = data['cdn_name'];
						version = data['cdn_version'];
						link = data['cdn_link'];
						result = 
						'<a title="edit" data-id="'+id+'" data-name="'+name+'" data-version="'+version+'" data-link="'+link+'" class="action btn btn-sm btn-prm" data-toggle="modal" href="#modal_edit"><i class="fa fa-fw fa-edit"></i></a>' + 
						'<a title="delete" class="action btn btn-sm btn-no btn-del" data-href="'+ host +'admin/cdn_delete/'+ id +'"><i class="fa a-fw fa-trash-alt"></i></a>';
						return result;
					}
			},			
			{ // type
				"targets": 2,
				"data": 'cdn_type',
				"className": "center",
				"orderable": true
			},
			{ // name
				"targets": 3,
				"data": 'cdn_name',
				"orderable": true
			},
			{ // version
				"targets": 4,
				"data": 'cdn_version',
				"className": "center",
				"orderable": false
			},
			{ // link
				"targets": 5,
				"data": 'cdn_link',
				"orderable": false
			},
		],

		rowCallback: function(row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		}
	});	

	$('#modal_edit').on('show.bs.modal', function(e) {
		$('#cdn-id').val($(e.relatedTarget).data('id'));
		$('#cdn-name').val($(e.relatedTarget).data('name'));
		$('#cdn-version').val($(e.relatedTarget).data('version'));
		$('#cdn-link').val($(e.relatedTarget).data('link'));
	});
	$('.btn-update').on('click',function(e){
		e.preventDefault();
		var data = $('#form_edit').serialize();
		$.ajax({
			url : host + 'admin/update_cdn',
			method: 'POST', 
			data : data,
			success: function(result){
				var parse = $.parseJSON(result);
				if(parse == 1){
					reloadTable('#cdn_table');
					$('#modal_edit').modal('hide');
				} else if(parse = 0) {
				alert('something error');
				}
			}
		});
	});

	$('.btn-add').on('click', function(e) {
		e.preventDefault();
		var data = $('#form_add').serialize();	
		$.ajax({
			url : host + 'admin/add_cdn',
			method: 'POST', 
			data : data,
			success: function(result){
				var parse = $.parseJSON(result);
				if(parse == 1){
					reloadTable('#cdn_table');
					$('#form_add input, #form_add select').val('');
					$('#modal_add').modal('hide');
				} else if(parse == 0){
					alert('something error');
				}
			}
		});
	});

});	
</script>