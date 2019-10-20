
<div class="content-wrapper">
	<section class="content content-users">
		<div class="wrap-table">
			<div class="custom-modal hide box-sh" id="user-modal">
				<div class="inner-modal">
					<div><button class="btn btn-diss"><i class="fa fa-times"></i></button></div>
						<div class="row" style="padding: 5px 10px 15px;">
							<div class="col-sm-6">
								<h3 class="center">Detail User</h3>
								<table class="table">
									<tr>
										<td colspan="3" class="center"><img class="info_image img-circle" src="" height="100" width="100"></td>
									</tr>
									<tr>
										<td>Uid</td><td>:</td> 
										<td class="info-uid"></td>
									</tr>
									<tr>
										<td>Username</td><td>:</td>
										<td class="info-username"></td>
									</tr>
									<tr>
										<td>Email</td><td>:</td>
										<td class="info-email"></td>
									</tr>
									<tr>
										<td>Name</td><td>:</td>
										<td class="info-name"></td>
									</tr>
									<tr>
										<td>Gender</td><td>:</td>
										<td class="info-gender"></td>
									</tr>
									<tr>
										<td>Register</td><td>:</td>
										<td class="info-register"></td>
									</tr>
									<tr>
										<td>Role</td><td>:</td>
										<td class="info_role"></td>
									</tr>
								</table>								
							</div>
							<div class="col-sm-6">
								<h3 class="center">User Activity</h3>

							</div>													
						</div>
					

				</div>
			</div>
			<div class="table-responsive">
				<table class="display" id="users_table">
					<thead>
						<tr>
							<th>No.</th>
							<th><i class="fa fa-cog"></i></th>
							<th>Provider</th>
							<th>Role</th>
							<th>Username</th>
							<th>Email</th>
							<th>Active</th>
							<th>Register</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>	
	</section>
</div>



<script>
$(document).ready(function(){
	let users_table = $('#users_table');	
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
	users_table.dataTable({
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
			if (data['u_id']) {
				$(cells[1]).html('<a title="detail" data-id="'+ data['u_id'] +'"  class="info-user btn btn-sm btn-prm"><i class="fa fa-fw fa-info-circle"></i></a>');
			}
			if ( data['u_provider'] == 'local' ) {
	      $(cells[2]).html('<a class="btn btn-sm btn-block btn-def">local</a>');
	    } else {
	    	$(cells[2]).html('<a class="btn btn-sm btn-block btn-prm">facebook</a>');;
	    }
	    if ( data['u_role'] == 1 ) {
	      $(cells[3]).html('<a class="btn btn-sm btn-block btn-ok">admin</a>');
	    } else if ( data['u_role'] == 2 ){
	    	$(cells[3]).html('<a data-id="'+ data['u_id'] +'" class="btn btn-sm btn-block btn-warn">author</a>');
	    } else {
	    	$(cells[3]).html('<a data-id="'+ data['u_id'] +'" class="btn btn-sm btn-block btn-def">member</a>');;
	    }
	    if ( data['u_active'] == 1 ) {
	      $(cells[6]).html('<i class="fa fa-check text-success"></i>');
	    } else {
	    	$(cells[6]).html('<i class="fa fa-times text-danger"></i>');;
	    }
		},
		rowId: 'staffId',
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
				"data": 'u_id',
				"className": "center",
				"orderable": false
			},			
			{ // provider
				"targets": 2,
				"data": 'u_provider',
				"className": "center",
				"orderable": true, 
			},
			{ // role
				"targets": 3,
				"data": 'u_role',
				"className": "center",
				"orderable": true,
			},
			{ // username
				"targets": 4,
				"data": 'u_username',
				"orderable": false
			},
			{ // email
				"targets": 5,
				"data": 'u_email',
				"orderable": false
			},			
			{ // active
				"targets": 6,
				"data": 'u_active',
				"className": "center",
				"orderable": true
			},
			{ // register
				"targets": 7, 
				"data": null,
				"orderable": false,
				"render": function(data){
						var rand,times,b,c,d;
						rand = Math.floor(101+(Math.random()*(999-101)));
						times = Number(data['u_register']) +''+ rand;
						b = timeElapsed(times);
						c = convert_time(Number(times),true);
						d = '<a class="btn btn-hr tip-bottom" title="'+ c +'">'+ b +'</a>';
						return d;
				}
			}			
		],

		rowCallback: function(row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			var index = page * length + (iDisplayIndex + 1);
			$('td:eq(0)', row).html(index);
		}
	});
	$('#user-modal').on('click','.btn-diss',function(){
		$('#user-modal').toggleClass('scale-in-center').fadeOut('slow');
	});
	users_table.on('click','.info-user',function(e){
    e.preventDefault();
		$('.custom-modal').removeClass('hide').toggleClass('scale-in-center').fadeIn('fast');
		var id = $(this).data('id');
		$.ajax({
			url : host + 'xhra/get_detail_user',
			data : { id : id },
			type: 'POST',
			cache: false,
			success : function(data){
				var x = data['image'];
				if(x.startsWith("https")){
					$('.info_image').attr('src', ''+ x +'');	
				} else {
					$('.info_image').attr('src', host + 'assets/img/profile/' + x);
				}
				var y = data['role'];
				if (y == 2){
					$('.info_role').html(
						'<button class="btn btn-sm btn-def action">author </button>' +
						'<button data-action="change" data-id="'+ data ['uid'] +'" data-role="'+ data['role'] +'" class="hide btn btn-sm btn-prm proggres-act">demote</button>' +
						'<button data-action="delete" data-id="'+ data ['uid'] +'" data-role="'+ data['role'] +'" class="hide btn btn-sm btn-no proggres-act">remmove</button>'
						);
				} else if (y == 3){
					$('.info_role').html(
						'<button class="btn btn-sm btn-def action">member </button>' +
						'<button data-action="change" data-id="'+ data ['uid'] +'" data-role="'+ data['role'] +'" class="hide btn btn-sm btn-prm proggres-act">promote</button>' +
						'<button data-action="delete" data-id="'+ data ['uid'] +'" data-role="'+ data['role'] +'" class="hide btn btn-sm btn-no proggres-act">remove</button>'
						);
				}
				$.each(data, function(key, value){
					$('.info-'+ key +'').html('<span>'+ value +'</span>')
				});
			}
		});
	});



	$('.info_role').on('click','.action',function(e){
    e.preventDefault();
    $('.proggres-act,.proggres-del').toggleClass('hide');
    
    $('.proggres-act,.proggres-del').on('click',function(){
	    var conf = confirm('Are you sure ?');
	    if(conf) {
		    var x = $(this).data('id');
		    var y = $(this).data('role');
		    var z = $(this).data('action');
		    $.ajax({
		    	url: host + 'xhra/update_role',
		    	data: { 
		    		id : x, 
		    		role : y, 
		    		action: z 
		    	},
		    	dataType : 'json',
		    	type: 'POST',
		    	success: function(result){
		    		var parse = $.parseJSON(result);
		    		if (parse == 1){
		    			$('.custom-modal').toggleClass('scale-in-center').fadeOut('slow');
		    			$('.overlay').addClass('hide');
		    			reloadTable('#users_table');
		    		} else {
		    			alert('failed');
		    		}
		    	}
		    });
	    }
    });
  });
				
});		
</script>