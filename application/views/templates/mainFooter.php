<div class="overlay hide"></div>
<div class="ajax-send hide"></div>
<div id="result"></div>
<?php if ( !whats_page(2,['reset','sign','change','s']) ) mainFooter(); ?>

<?php if ( whats_page(1,['','at','lesson','snippet']) ) { ?>
<script src="<?=base_url('assets/js/jquery.flipster.min.js')?>"></script>
<script id="main_script">
	$(function(){
	  $('.frame-views').on('load', function() {
	    $(this).contents().find("#user-body").css("overflow", "hidden");
	  });
	});
dialog_confirm('.delete-comment');
function dialog_confirm(trigger){
  $(document).on('click',trigger, function(e){
    e.preventDefault();
    var com = $(this);
    var href = $(this).data('href');
    Swal.fire({
      title : '<h1 class="header-swal danger">H<small>mm...</small></h1>',
      html :
      '<div class="img-swal">' +
      '<div class="text-focus-in"><img src="'+ host +'assets/img/feed/no.gif"></div>' +
      '</div>' +
      '<h3 class="info-swal danger">apa kamu yakin ?</p>',
      type : '',
      showCancelButton : true,
      confirmButtonText: '<span>Ya</span>',
      cancelButtonText: '<span>Tidak</span>',
      buttonsStyling : false,
      customClass: {
        confirmButton: 'effect effect-ok',
        cancelButton: 'effect effect-no'
      }
    }).then((result) => {
      if(result.value){
      	$.ajax({
      		url : href,
      		type : 'POST',
      		data : { csrf_token : csrf },
      		success : function(data){
      			if (data.status == 1) {
      				writeResult(data);
      				$(com).parents('.row-comment').remove();
      			}
      		},
      		error : function(xhr){ handle_ajax(xhr) }
      	});
      }
    });
  });
}
let widthClass = function() {
  let ww = document.body.clientWidth;
  if (ww < 992) {
    $('.nav-adjust').addClass('mini');
  } else if (ww >= 993) {
    $('.nav-adjust').removeClass('mini');
  };
};
	$(document).ready(function() {
	  $(window).resize(function(){
	    widthClass();
	  });
	  widthClass();
		loading();
		$("#coverflow").flipster();
		$(function(){
			var url = window.location.pathname,
			urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
			$('.main-navbar a').each(function(){
				if(urlRegExp.test(this.href.replace(/\/$/,''))){
					$(this).addClass('active');
				}
			});
		});
		$('#btn-nav').on('click',function(){
			$(this).toggleClass('open');
			$(this).children('i').toggleClass('fa-arrow-left fa-user');
			$('.drop').toggleClass('hide');
		});


		$('#coverflow').on('click','a',function(){
			var req = $(this).data('request');
			var val = $(this).data('value');
			var result = $('.result');
			$(result).empty();
			startAjax();
			$.ajax({
				url: host+'xhrm/get_list_menu',
				type: 'POST',
				data: { request : req },
				success: function(data){
					$('.content').removeClass('hide');
					$('#lessons').removeClass('hide');
					var temp = '';
					temp += '<h2>Index '+val.toUpperCase()+'</h2>';
					temp += '<br>';
					temp += '<div class="btn-tabs '+val+'"><div class="nava-inner">';
					temp += '<a class="sh active" data-toggle="tab" href="#menu1">'+data['cat'][0]+'</a>';
					temp += '<a class="sh" data-toggle="tab" href="#menu2">'+data['cat'][1]+'</a>';
					temp += '<a class="sh" data-toggle="tab" href="#menu3">'+data['cat'][2]+'</a>';
					temp += '</div></div>';
					temp += '<div class="tab-content box-sh '+val+'">';
					temp +=	'<div class="tab-content-inner">';
					temp += '<div id="menu1" class="tab-pane fade in active">';
					for(var i = 0; i < data['list'].length; i++) {
						if(data['list'][i]['level'] === data['cat'][0]) {
					  	temp += '<a class="list-snippet '+val+'" target="_blank" href="'+data['list'][i]['link']+'">'+data['list'][i]['slug']+'</a>';
						}else{
							temp += '';
						}
					}
					temp += '</div>';
					temp += '<div id="menu2" class="tab-pane fade in">';
					for(var i = 0; i < data['list'].length; i++) {
					  if(data['list'][i]['level'] === data['cat'][1]) {
					  	temp += '<a class="list-snippet '+val+'">'+data['list'][i]['slug']+'</a>';
						}else{
							temp += '';
						}
					}
					temp += '</div>';
					temp += '<div id="menu3" class="tab-pane fade in">';
					for(var i = 0; i < data['list'].length; i++) {
					  if(data['list'][i]['level'] === data['cat'][2]) {
					  	temp += '<a class="list-snippet '+val+'">'+data['list'][i]['slug']+'</a>';
						}else{
							temp += '';
						}
					}
					temp += '</div>';
					temp += '</div>';
					$(result).html(temp);
				},
				error: function(xhr){
					handle_ajax(xhr);
				},
				complete: function(){
					endAjax();
				}
			});
		});
	  $('.side-info').on('click','#more button',function(){
    	var btn = $('#more button');
    	$(btn).children('img').toggleClass('hide');
			$(btn).children('span').toggleClass('hide');
      var datax = {
      	id : $(this).data('id'),
      	page : $('.content-snippet').data('id'),
      	csrf_token : csrf
      };
      $.ajax({
        url : host+'xhrm/load_more_comment',
        type :'POST',
        data : datax,
        dataType : 'html',
        success : function(data){
    			$('.side-info').find('#more').remove();
					$('#fetch-comment').append(data);
        },
        error : function(xhr){ handle_ajax(xhr) },
        complete : function(){
		    	$(btn).children('img').toggleClass('hide');
					$(btn).children('span').toggleClass('hide');
        }
      });
	  });

		new TypeIt('#typing', {
			speed: 50,
			html: true,
			cursorChar: '',
			waitUntilVisible: true
		})
		.pause(3000)
		.type("<a>Situs Belajar FrontEnd Web Indonesia</a>")
		.go();

		new TypeIt('#str1,#str2,#quote', {
		  speed: 70,
		  cursorChar: '',
		  waitUntilVisible: true
		}).go();



		$(document).on('click','.btn-tabs a', function(){
			$('.btn-tabs a').removeClass('active');
			$(this).addClass('active');
		});

		var backToTop = $('#toTop');
		backToTop.hide();
		$(window).scroll(function() {
			if ($(this).scrollTop() > 1000) {
				backToTop.fadeIn();
			} else {
				backToTop.fadeOut();
			}
		});

		backToTop.click(function() {
			$("html, body").animate({scrollTop: 0}, 500);
		});
	});
</script>
<?php } if (startSession('sess_id')) { ?>
<script id="snippet-script">
	$('#like-this').on('click',function(){
		var liked = $('#like-this');
		var datax = {
			post : $('.content').data('id'),
			owner : $('.content').data('author'),
			csrf_token : csrf
		};
		$.ajax({
			url : host + 'xhru/create_like',
			type : 'POST',
			data : datax,
			success : function(data){
				writeResult(data);
				if (data.status == 1) {
					$(liked).parents('li').addClass('active');
				}
			},
			error : function(xhr){ handle_ajax(xhr) }
		});
	});
	$('.submit-comment').on('click',function(){
		var btn = $('.submit-comment');
		var datax = {
			post : $('.content').data('id'),
			owner : $('.content').data('author'),
			comment : $('#comment').val(),
			csrf_token : csrf
		};
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');
		$.ajax({
			url : host+'xhru/create_comment',
			type : 'POST',
			data : datax,
			success : function(data){
				var arr = data;
				if (arr.status == 1) {
					var i = 0;
					var template = '';
					arr[i] = arr.message[0];
					template += `
					<div class="row row-comment `+arr[i]['side']+`" id="`+arr[i]['created']+`">
						<div class="col-xs-12">
							<span class="action `+arr[i]['side-text']+`">
								<button class="btn btn-default btn-sm">edit</button>
								<button class="btn btn-default btn-sm" data-href="`+host+`xhru/delete_comment/`+arr[i]['created']+`">hapus</button>
							</span>
						</div>
						<div class="col-img `+arr[i]['side-img']+`">
							<img class="img-user-comm img-thumbnail" src="`+host+`assets/img/profile/`+arr[i]['img_comm']+`" alt="User Image">
						</div>
						<div class="col-text `+arr[i]['side-text']+`">
							<div class="direct-chat-text">
								<div class="direct-chat-info">
									<span class="fred"><a href="" class="base-link">`+arr[i]['name_comm']+`</a></span>
									<span class="time-stamp">`+arr[i]['create']+`</span>
								</div>
								<p>`+arr[i]['message']+`</p>
							</div>
						</div>
					</div>`;
					$('#fetch-comment').prepend(template);
					$('#fetch-comment').find('h1').remove();
					$('#comment').val('');
					$('.side-info-inner').animate({
					  scrollTop: $('#fetch-comment').offset().top
					}, 'slow');
				} else {
					$('.error').html(arr['message']);
					$('#comment').focus();
				}
			},
			error : function(xhr){
				handle_ajax(xhr);
			},
			complete : function(){
				$(btn).children('img').toggleClass('hide');
				$(btn).children('span').toggleClass('hide');
			}
		});
	});

  $('#fetch-comment').on('mouseenter','.row-comment', function() {
  	$(this).find('.action').addClass('open');
  });
  $('#fetch-comment').on('mouseleave','.row-comment', function() {
  	$(this).find('.action').removeClass('open');
  });
</script>
<script src="<?= base_url('assets/js/js_out.js') ?>"></script>
<?php } else { ?>
<script id="log-script">
	$(document).ready(function() {
		$('.to-register,.to-login').click(function() {
			$('.login,.register').toggleClass('off');
		});
		$('.forgot').on('click',function(){
			$('.left-side').addClass('slide-out-left');
			setTimeout(function(){
				$('.left-side').removeClass('slide-out-left');
			},1000);
			setTimeout(function(){
				$('.left-side,.right-side').toggleClass('hide');
			},1000);
		});
		$('.back-login').on('click',function(){
			$('.left-side').addClass('slide-in-left');
			setTimeout(function(){
				$('.left-side').removeClass('slide-in-left');
			},1000);
			setTimeout(function(){
				$('.left-side,.right-side').toggleClass('hide');
			},10);
		});
		$('.form-group label').css('opacity',0);

		let btnReg  = $('.btn-reg');
		$('#form-register input').on('keyup',function(){
			var $1,$2,$3,$4;
			$1 	= $('#input-username');
			$2 	= $('#input-email');
			$3 	= $('#input-pass_1');
			$4 	= $('#input-pass_2');
			if( $(this).val() != '' ){
				$(this).parents('.form-group').find('label').css('opacity',1);
			} else {
				$(this).parents('.form-group').find('label').css('opacity',0);
			}
			$(this).parents('.form-group').find('#error').html('');
	    if( $($1).val() != "" && $($2).val() != "" && $($3).val() != "" && $($4).val() != "" ){
	      $(btnReg).removeAttr("disabled");
	    }else{
	      $(btnReg).attr("disabled", "disabled");
	    }
		});
		let btnLog = $('.btn-log');
		$('#form-login input').on('keyup',function(){
			var rmb, $1,$2,$3;
			rmb = $('#remember');
			$1 	= $('#input-key_email');
			$2 	= $('#input-key_pass');
			if( $(this).val() != '' ){
				$(this).parents('.form-group').find('label').css('opacity',1);

			} else {
				$(this).parents('.form-group').find('label').css('opacity',0);
			}
			$(this).parents('.form-group').find('#error').html('');
	    if( $($1).val() != "" && $($2).val() != "" ){
	      $(btnLog).removeAttr("disabled");
	      $(rmb).removeAttr("disabled");
	    }else{
	      $(btnLog).attr("disabled", "disabled");
	      $(rmb).attr("disabled", "disabled");
	    }
		});
		let btnRest = $('.btn-reset');
		$('#form-reset input').on('keyup',function(){
			if( $(this).val() != '' ){
				$(this).parents('.form-group').find('label').css('opacity',1);
			} else {
				$(this).parents('.form-group').find('label').css('opacity',0);
			}
			$(this).parents('.form-group').find('#error').html('');
			$1 	= $('#input-reset_email');
	    if( $($1).val() != "" ){
	      $('.btn-reset').removeAttr("disabled");
	    }else{
	      $('.btn-reset').attr("disabled", "disabled");
	    }
		});
		let	btnChg  = $('.btn-change');
		$('#form-change input').on('keyup',function(){
			var $1,$2;
			if( $(this).val() != '' ){
				$(this).parents('.form-group').find('label').css('opacity',1);
			} else {
				$(this).parents('.form-group').find('label').css('opacity',0);
			}
			$(this).parents('.form-group').find('#error').html('');
			$1 	= $('#input-pass_1');
			$2 	= $('#input-pass_2');
	    if( $($1).val() != "" && $($2).val() != "" ){
	      $(btnChg).removeAttr("disabled");
	    } else {
	      $(btnChg).attr("disabled", "disabled");
	    }
		});


		$('#form-register').submit(function(ev) {
			ev.preventDefault();
			$(btnReg).attr('disabled', 'disabled');
			$(btnReg).children('img').toggleClass('hide');
			$(btnReg).children('span').toggleClass('hide');
			var datax = $(this).serialize()+'&'+$.param({ csrf_token: csrf });
			startAjax();
			$.ajax({
				url : host+'xhrm/set_register',
				data : datax,
				type : 'post',
				dataType : 'json',
				success : function(data){
					$.each(data, function(key, value){
						$('#input-' + key).parents('.form-group').find('#error').html(value);
					});
					if(data['status'] == 1){
						writeResult(data);
						$('.input-text').val('');
						$('.register').addClass('off');
						$('.login').removeClass('off');
					} else {
						writeResult(data);
					}
				},
				error : function(xhr) {
					handle_ajax(xhr);
				},
				complete : function(){
					endAjax();
					$(btnReg).children('img').addClass('hide');
					$(btnReg).children('span').removeClass('hide');
				}
			});
		});

		$('#form-login').submit(function(ev) {
			ev.preventDefault();
			$(btnLog).attr('disabled', 'disabled');
			$(btnLog).children('img').toggleClass('hide');
			$(btnLog).children('span').toggleClass('hide');
			var datax = $(this).serialize()+'&'+$.param({ csrf_token: csrf });
			startAjax();
			$.ajax({
				url : host+'xhrm/set_login',
				data : datax,
				type : 'post',
				dataType : 'json',
				success : function(data){
					$.each(data, function(key, value){
						$('#input-' + key).parents('.form-group').find('#error').html(value);
					});
					writeResult(data);
				},
				error : function(xhr) {
					handle_ajax(xhr);
				},
				complete : function(){
					endAjax();
					$(btnLog).children('img').addClass('hide');
					$(btnLog).children('span').removeClass('hide');
				}
			});
		});

		$('#form-reset').submit(function(ev) {
			ev.preventDefault();
			$(btnRest).attr('disabled', 'disabled');
			$(btnRest).children('img').toggleClass('hide');
			$(btnRest).children('span').toggleClass('hide');
			var datax = $(this).serialize()+'&'+$.param({ csrf_token: csrf });
			startAjax();
			$.ajax({
				url : host+'xhrm/set_pw_reset',
				data : datax,
				type : 'post',
				dataType : 'json',
				success : function(data){
					$.each(data, function(key, value){
						$('#input-' + key).parents('.form-group').find('#error').html(value);
					});
					writeResult(data);
				},
				error : function(xhr) {
					handle_ajax(xhr);
				},
				complete : function(){
					endAjax();
					$(btnRest).children('img').addClass('hide');
					$(btnRest).children('span').removeClass('hide');
				}
			});
		});

		$('#form-change').submit(function(ev) {
			ev.preventDefault();
			$(btnChg).attr('disabled', 'disabled');
			$(btnChg).children('img').toggleClass('hide');
			$(btnChg).children('span').toggleClass('hide');
			var datax = $(this).serialize()+'&'+$.param({ csrf_token: csrf });
			$.ajax({
				url : host+'xhrm/set_pw_change',
				data : datax,
				type : 'post',
				dataType : 'json',
				success : function(data){
					$.each(data, function(key, value){
						$('#input-' + key).parents('.form-group').find('#error').html(value);
					});
					writeResult(data);
				},
				error : function(xhr) {
					handle_ajax(xhr);
				},
				complete : function(){
					endAjax();
					$(btnChg).children('img').addClass('hide');
					$(btnChg).children('span').removeClass('hide');
				}
			});
		});
	});
</script>
<?php } ?>
</body>
</html>