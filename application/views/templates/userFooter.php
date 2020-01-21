<div class="overlay hide"></div>
<div class="ajax-send hide"></div>
<div id="result"></div>
<?php if ( !whats_page(1,['a']) && !whats_page(3,['create','edit']) ) { ?>
	<footer class="main-footer">
		<strong>Copyright © <?= date('Y') ?> <a href="<?= base_url() ?>">Hello World</a></strong> All rights reserved
	</footer>
<?php } ?>
</div> <!-- wrapper -->

<script>
$(function(){
  $('.frame-views').on('load', function() {
    $(this).contents().find("#user-body").css("overflow", "hidden");
  });
});	
$(document).ready(function() {
	loading();
	activeSide();
});

</script>

<?php if ( whats_page(1,['a']) ) { ?>
<script id="adm">
	$(document).ready(function() {
		// TUTORIAL TABLE
		let tutorialsTable = $('#tutorials');
		$('#frame-full').on('load', function() {
			$(this).contents().find(".box-desc").removeClass('hide').addClass('slide-in-left');
		});
		// =================== EDIT ORDER
		$("#tutorials tbody").sortable({
			placeholder : "ui-state-highlight",
			update  : function(event, ui) {
				var snip_order = new Array();
				$('#tutorials tbody tr').each(function(){
					snip_order.push($(this).data("id"));
				});
				$.ajax({
					url: host + "xhra/update_tutorial_order",
					method:"POST",
					data: { snip_order : snip_order },
					success:function(ord){
						var parse = $.parseJSON(ord);
						if(parse === 1){
							reloadTable('#tutorials');
						} else {
							alert('something error');
						}
					}
				});
			}
		});
		// =================== EDIT TITLE
		tutorialsTable.on('dblclick','.action-title',function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var text = $(this).text();
			$(this).append(
				'<form class="form-title" method="post" autocomplete="off">'
				+ '<input type="hidden" name="id" value="'+ id +'">'
				+ '<input class="input-title" type="text" name="title" value="'+text+'" spellcheck="false">'
				+ '</form>'
				);
			$('.input-title').focus().change().keydown(function(e){
				if (e.keyCode === 13) {
					var datax = $('.form-title').serialize();
					$.ajax({
						data : datax,
						method : 'post',
						url  : host + 'xhra/update_tutorial_title',
						success : function(resultTitle){
							var parse = $.parseJSON(resultTitle);
							if(parse == 1){
								$('.form-title').remove();
								reloadTable('#tutorials');
							} else{
								alert('something error');
							}
						}
					});
					$('.form-title').remove();
				}
			});
		});
		// =================== EDIT SLUG
		tutorialsTable.on('dblclick','.action-slug',function(e){
			e.preventDefault();
			var id   = $(this).data('id');
			var text = $(this).text();
			$(this).append(
				'<form class="form-slug" method="post" autocomplete="off">'
				+ '<input type="hidden" name="id" value="'+ id +'">'
				+ '<input class="input-slug" type="text" name="slug" value="'+ text +'">'
				+ '</form>'
				);
			$('.input-slug').focus().change().keydown(function(e){
				if (e.keyCode === 13) {
					var datax = $('.input-slug').val();
					$.ajax({
						data : { 'id' : id, 'slug' : datax },
						method : 'post',
						url  : host + 'xhra/update_tutorial_slug',
						success : function(data){
							var parse = $.parseJSON(data);
							if(parse == 1){
								$('.form-slug').remove();
								reloadTable('#tutorials');
							} else {
								alert('something error');
							}
						}
					});
					$('.form-slug').remove();
				}
			});
		});
		// =================== PREVIEW
		tutorialsTable.on('click','.action-preview',function(){
			var href = $(this).data('href');
			preview_frame('#frame-full',href)
		});			
		// =================== EDIT PUBLIC
		tutorialsTable.on('click','.action-public',function(e){
			e.preventDefault();
			var button = $(this);
			var href = $(this).data('href');
			$.ajax({
				url : href,
				type: 'post',
				success : function(data){
					reloadTable('#tutorials');
				}
			});
		});
		// =================== ADD TUTORIAL
		$('#create-tutorial-form').submit(function(e){
			e.preventDefault();
			var data = $(this).serialize();
			$.ajax({
				url : host + 'xhra/create_tutorial',
				type : 'POST',
				data : data,
				success : function(data) {
					var parse = $.parseJSON(data);
					if(parse == '1'){
						$('#modal-tutorial').modal('hide');
						$('#create-tutorial-form input select').val('');
						flashAlert('success','tutorials has been added');
						reloadTable('#tutorials');
					} else {
						alert('something error');
					}
				}
			});
		});

		// TUTORIAL EDIT
		let edited = $('#tutorial-form');
		// =================== BTN EDIT
		$('.icon-bar a').on({
			'mouseover' : function(){
				$(this).children('span').css({
					display : 'inline-block',
					opacity : 1
				});
			},
			'mouseleave' : function(){
				$(this).children('span').css({
					display : 'none',
					opacity : 0
				});
			}
		});
		// =================== UPDATE
		edited.on('click', '#update', function(e) {
			e.preventDefault();
			var aa = '';
			for (instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			var words = $('#cke_wordcount_text-editor').text().replace(',','');
			words = words.split(' ');
			words = words[3];
			var data 	= edited.serialize()+'&'+$.param({ count_words: words });
			$.ajax({
				url : host + 'xhra/update_tutorial',
				type : 'post',
				data : data,
				dataType : 'json',
				success : function(data){
					var parse = $.parseJSON(data['status']);
					if(parse == 1){
						$('.alert-auto').removeClass('hide').fadeIn(1000);
						setTimeout(function(){
							$('.alert-auto').fadeOut(1000);
						}, 4000);
					}
					$('.label-updated span').html(data['last']);
					if(data['affect'] != ''){
						data['affect'].forEach(function(el){
							aa += '<a class="btn btn-default">'+el+'</a>';
						});						
					}
					$('.haha').html(aa);
				}
			});
		});
		// =================== DELETE
		edited.on('click','.btn-del',function(e){
			e.preventDefault();
			var href = $(this).data('href');
				// var vals = $(this).data('value');
			Swal.fire({
				title : 'Are you sure ?',
				html : '<p class="html-swal">This snippet will be removed</p>',
				type : 'warning',
				showCancelButton : true,
				buttonsStyling : false,
				customClass: {
					confirmButton: 'effect effect-prm',
					cancelButton: 'effect effect-no'
				},
				confirmButtonText: '<span>Yes</span>',
				cancelButtonText: '<span>No</span>',
			}).then((result) => {
				if(result.value){
					$.ajax({
						url : href,
						type : 'post',
						success : function(data){
							alertSuccess('blank',['success','tutorial has been deleted',''+imgLoad+''],'');
							window.history.back();
						}
					});
				}
			});
		});
		// =================== PREVIEW
		edited.on('click','.action-preview',function(){
			var href = $(this).data('href');
			preview_frame('#frame-full',href);
		});
		// =================== PUBLIC
		edited.on('click','.action-public',function(e){
			e.preventDefault();
			var button = $(this);
			var href = $(this).data('href');
			$.ajax({
				url : href,
				type: 'post',
				success : function(data){
					var parse = $.parseJSON(data);
					if(parse == 1){
						button.toggleClass('btn-ok btn-no')
						.html('<i class="fa fa-globe-asia"></i> <span class="hidden-sm hidden-xs">Public</span>');
					}else{
						button.toggleClass('btn-no btn-ok')
						.html('<i class="fa fa-code"></i> <span class="hidden-sm hidden-xs">Draft</span>');
					}
				}
			});
		});
	});
</script>
<?php }
if (whats_page(1,['u'])) { ?>
	<script id="usr">
	// ACTIVITY
	myModal('#html-request,#css-request,#js-request','#modal-progress','#diss-progress');
	$('#diss-progress').click(function(){
		$('.body-progress').css('min-height','0');
	});
	$('#html-request,#css-request,#js-request').on('click',function(){
		$('.body-progress').css('min-height','77vh');
		var datax = { request : $(this).data('id'), user: userData.id };
		var val = $(this).data('name');
		startAjax();
		$.ajax({
			url : host + 'xhrm/get_list_menu',
			type : 'POST',
			data : datax,
			success : function(data) {
				var temp = '';
				temp += '<div class="nav-tabs-custom"><ul class="nav nav-tabs">';
				temp += '<li class="active"><a data-toggle="tab" href="#menu1" aria-expanded="true">'+data['cat'][0]+'</a></li>';
				temp += '<li><a data-toggle="tab" href="#menu2">'+data['cat'][1]+'</a></li>';
				temp += '<li><a data-toggle="tab" href="#menu3">'+data['cat'][2]+'</a></li>';
				temp += '</ul>';
				temp += '<div class="tab-content">';
				temp += '<div id="menu1" class="tab-pane fade in active">';
				for(var i = 0; i < data['list'].length; i++) {
					if(data['list'][i]['level'] === data['cat'][0]) {
						var match_ = (data['list'][i]['match']) ? ' - telah dipelajari' : '' ;
						temp += '<h4><a class="fred base-link" target="_blank" href="'+data['list'][i]['link']+'">'+data['list'][i]['slug']+'</a> <span class="fred text-muted">'+match_+'</span></h4>';
					}else{
						temp += '';
					}
				}
				temp += '</div>';
				temp += '<div id="menu2" class="tab-pane fade in">';
				for(var i = 0; i < data['list'].length; i++) {
					if(data['list'][i]['level'] === data['cat'][1]) {
						var match_ = (data['list'][i]['match']) ? ' - telah dipelajari' : '' ;
						temp += '<h4><a class="fred base-link" target="_blank" href="'+data['list'][i]['link']+'">'+data['list'][i]['slug']+'</a> <span class="fred text-muted">'+match_+'</span></h4>';
					}else{
						temp += '';
					}
				}
				temp += '</div>';
				temp += '<div id="menu3" class="tab-pane fade in">';
				for(var i = 0; i < data['list'].length; i++) {
					if(data['list'][i]['level'] === data['cat'][2]) {
						var match_ = (data['list'][i]['match']) ? ' - telah dipelajari' : '' ;
						temp += '<h4><a class="fred base-link" target="_blank" href="'+data['list'][i]['link']+'">'+data['list'][i]['slug']+'</a> <span class="fred text-muted">'+match_+'</span></h4>';
					}else{
						temp += '';
					}
				}
				temp += '</div>';
				temp += '</div>';
				$('.target-request').html(temp);
			},
			error : function(xhr){
				handle_ajax(xhr);
			},
			complete : function(){
				endAjax();
			}
		});
	});
	// PROFILE
	myModal('#config-identity','#modal-identity','#diss-identity');
	myModal('#config-photo','#modal-photo','#diss-photo');
	myModal('#config-account','#modal-account','#diss-account');

	$('.content-profile').on('change','.btn-file :file',function(){
		var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});
	$('.btn-file :file').on('fileselect', function(event, label) {
		var input = $(this).parents('.input-group').find(':text'),
		log = label;
		if(input.length) {
			input.val(log);
		} else {
			if(log) alert(log);
		}
	});
	$("#i-photo").change(function(){
		readURL(this);
	});







	// CREATE




</script>
<?php } ?>
<script src="<?= base_url('assets/js/js_out.js') ?>"></script>
</body>
</html>