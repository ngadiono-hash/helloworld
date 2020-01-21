
const host = 'http://'+window.location.hostname+'/helloworld/';
const path = window.location.pathname;
const imgLoad = '<img src="'+ host +'assets/img/feed/bars.svg" height="50">';
const uri_pattern = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/ig;
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#img-upload').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
function startAjax(btn=''){
	var temp = '<div class="loading">';
	temp += '<img src="'+ host +'assets/img/feed/bars.svg" height="250" alt="ajax-send">';
	temp += '</div>';
	$('.ajax-send').removeClass('hide');
	$('.ajax-send').html(temp);
	if(btn != '') {
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');		
	}
}
function endAjax(btn=''){
	$('.ajax-send').addClass('hide');
	$('.ajax-send').html('');
	if(btn != '') {
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');		
	}
}
function loading(){
	$('.preloader').fadeOut();
	$('[data-toggle="tooltip"]').tooltip(); 
	$('.tip').tooltip();
	$('.tip-right').tooltip({
		tooltipClass: "mytooltip",
		position: { my: "left+5 center", at: "right center" }
	});
	$('.tip-bottom').tooltip({
		tooltipClass: "mytooltip",
	});	
}

function activeSide(){
	var url = window.location;
	$('ul.sidebar-menu a').filter(function() {
			return this.href == url;
	}).parent().siblings().removeClass('active').end().addClass('active');
	$('ul.treeview-menu a').filter(function() {
			return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');	
}

function myModal(trigger,target,diss){
	$(trigger).on('click',function(){
		$(target).removeClass('hide').toggleClass('scale-in-center').fadeIn('fast');
		$('.overlay').toggleClass('hide');
		// $('body').addClass('body-fix');
	});
	$(diss).on('click',function(){
		$(target).toggleClass('scale-in-center').fadeOut('slow');
		$('.overlay').addClass('hide');
		// $('body').removeClass('body-fix');
	});
}

function reloadTable(table){
	$(table).DataTable().ajax.reload(null, false);
}

// SWAL
function flashAlert(info,message){
	body = 
			'<div class="img-swal">'
		+ '<img class="text-focus-in" src="'+ host +'assets/img/feed/ok.gif" alt="alt">'
		+ '</div>'
		+ '<h3 class="info-swal success">'+info+'</h3>'
		+ '<h4 class="message-swal">'+ message +'</h4>';
	swal.fire({
		title : '<h1 class="header-swal success">Y<small>eah...</small></h1>',
		type  : '',
		html  : body, 
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick: true,
		timer : 3000
	});	
}
function alertBug(tipe,message,hr){
	var body, button;
	if (tipe == 'ok'){
		button = '<a onclick="Swal.clickConfirm()" class="effect"><span>OK</span></a>';
	} else if (tipe == 'report') {
		button 	= '<a onclick="Swal.clickConfirm()" class="effect"><span>OK</span></a>';
		button += '<a onclick="send_bug('+hr+')" class="effect detail"><span>LAPORKAN</span></a>';
	} else if (tipe == 'home') {
		button = '<a class="effect" href="'+ host +'"><span>HOME</span></a>';
	} else if (tipe == 'back') {
		button = '<a onclick="window.history.back()" class="effect"><span>KEMBALI</span></a>';
	}
	body  =
			'<div class="img-swal">'
		+ '<img class="text-focus-in" src="'+ host +'assets/img/feed/maaf.gif" alt="alt">'
		+ '</div>'
		+ '<h3 class="info-swal danger">maaf, telah terjadi kesalahan</h3>'
		+ '<h4 class="message-swal">'+ message +'</h4>'
		+ '<input type="text" class="input-adjust hide" id="detail-bug" placeholder="tulis detail bug untuk dilaporkan" autocomplete="off">'
		+ '<br>'+button;
	swal.fire({
		title : '<h1 class="header-swal danger">O<small>ops...</small></h1>',
		type  : '',
		html  : body, 
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick: false
	});
}
function alertSuccess(tipe,message=array(),dir=''){
	var body, button;
	if (tipe == 'ok'){
		button = '<a onclick="Swal.clickConfirm()" class="effect"><span>OK</span></a>';
		button += '<a onclick="window.history.back()" class="effect"><span>KEMBALI</span></a>';
		img = 'ok';
	} else if (tipe == 'login') {
		button = '<a class="effect" href="'+ host +'at/sign"><span>LOGIN</span></a>';
		img = 'horray';
	} else if (tipe == 'home') {
		button = '<a class="effect" href="'+ host +'"><span>HOME</span></a>';
		img = 'ok';
	} else if (tipe == 'blank') {
		button = '';
		img = 'horray';
	} 
	body  =
			'<div class="img-swal">'
		+ '<img class="text-focus-in" src="'+host+'assets/img/feed/'+img+'.gif" alt="alt">'
		+ '</div>'
		+ '<h3 class="info-swal success">'+message[0]+'</h3>'
		+ '<h4 class="message-swal">'+message[1]+'<br>'+message[2]+'</h4>'
		+ button;
	swal.fire({
		title : '<h1 class="header-swal success">Y<small>eah...</small></h1>',
		type  : '',
		html  : body, 
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick: true
	});
	if(dir != ''){
		setTimeout(function(){
			window.location.href = dir
		},3000);
	}
}
function alertDanger(tipe,message){
	var body, button;
	if (tipe == 'ok'){
		button = '<a onclick="Swal.clickConfirm()" class="effect"><span>OK</span></a>';
	} else if (tipe == 'login') {
		button = '<a class="effect" href="'+ host +'at/sign"><span>LOGIN</span></a>';
	} else if (tipe == 'home') {
		button = '<a class="effect" href="'+ host +'"><span>HOME</span></a>';
	} else if (tipe == 'back') {
		button = '<a onclick="window.history.back()" class="effect"><span>KEMBALI</span></a>';
	}
	body  =
			'<div class="img-swal">'
		+ '<img class="text-focus-in" src="'+ host +'assets/img/feed/mikir.gif" alt="alt">'
		+ '</div>'
		+ '<h3 class="info-swal danger">sepertinya... ada yang salah di sini</h3>'
		+ '<h4 class="message-swal">'+ message +'</h4>'
		+ button;
	swal.fire({
		title : '<h1 class="header-swal danger">O<small>ops...</small></h1>',
		type  : '',
		html  : body, 
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick: false
	});
}
function handle_ajax(xhr){
	alertBug('report','bug code '+xhr.status+'',xhr.status);
}
function send_bug(x){
	$('#swal2-content').on('click','.detail',function(){
		$(this).html('<span>kirim</span>');
		$(this).siblings('a').remove();
		$(this).removeClass('detail').addClass('send');
		$(this).parents('.swal2-content').find('#detail-bug').addClass('scale-in-center').removeClass('hide').focus();
		$('.send').on('click',function(){
			var datax = {
		  		ip: userData.ip,
		  		page: window.location.href,
		  		code: (typeof x == 'undefined') ? 'undefined' : x,
		  		detail: $('#detail-bug').val()
		  	};
		  $.ajax({
		  	url: host + 'xhrm/create_report',
		  	type: 'POST',
		  	dataType: 'json',
		  	data: datax,
		  	complete: function(){
		  		Swal.clickConfirm();
		  		flashAlert('laporan berhasil dikirim','terima kasih');
		  	}
		  });
		});
	});
}
function writeResult(data){
	$('#result').html('<script>'+data["message"]+'<\/script>');
	setTimeout(function(){
		$('#result').empty();
	}, 1000);	
}

function showFrameSize(target) {
	var width, height;
	width = Number(getStyle(document.getElementById(target), "width").replace("px", "")).toFixed();
	height = Number(getStyle(document.getElementById(target), "height").replace("px", "")).toFixed();
	$('#dm').fadeIn();
	$('#dm').html("<span>" + width + " x " + height + "</span>");
	if(width > 750 ){
	// $('#control-right').fadeOut(1);
		if (width > 940) {
			// $('#control-left').fadeOut(1);
		} else {
			// $('#control-left').fadeIn();
		}
	} else {
		// $('#control-right').fadeIn();
	}
}
function preview_frame(target,href) {
	$(target).fadeIn().attr('src',''+href+'');
	$(target).after('<button class="close-frame btn btn-default"><i class="fa fa-times"></i></button>');
	$(document).on('click','.close-frame',function(){
		$(target).fadeOut().attr('src','');
		$(this).remove();
	});	
}
function dialog_confirm(trigger,message,response=false) {
	$(document).on('click',trigger, function(e){
		e.preventDefault();
		var btn  = $(trigger);
		var href = $(trigger).data('href');
		Swal.fire({
			title : '<h1 class="header-swal danger">H<small>mm...</small></h1>',
			html :
			'<div class="img-swal">' +
			'<div class="text-focus-in"><img src="'+ host +'assets/img/feed/no.gif"></div>' +
			'</div>' +
			'<h3 class="info-swal danger">'+ message +'</p>',
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
				if (response) {
					Swal.fire({
						title : '<h1 class="header-swal success">Y<small>eah...</small></h1>',
						html :
						'<div class="img-swal">'+
						'<img class="text-focus-in" src="'+ host +'assets/img/feed/bye.gif">'+
						'</div>' + 
						'<h3 class="info-swal success">sedang mengalihkan halaman</h3>' +
						'<h4 class="message-swal">mohon tunggu sebentar</h4>' +
						'<img src="'+ host +'assets/img/feed/bars.svg" height="50">',
						type : '',
						showConfirmButton: false,
						showCloseButton: false,
					});
					setTimeout(function(){
						window.location.href = href;
					}, 3000);
				} else {
					$.ajax({
						url : href,
						type : 'POST',
						data : { csrf_token : csrf },
						success : function(data){
							if (data.status == 1) {
								writeResult(data);
								$(btn).parents('.row-comment').remove();
								
							}
						},
						error : function(xhr){ handle_ajax(xhr) }
					});					
				}
			}
		});
	});
}
function searching_tutorial(){
	var search = $('.search_input').val();
	var result = $('.result');
	$(result).empty();
	startAjax();
	$.ajax({
		url: host+'xhrm/search_tutor',
		type: 'POST',
		data: { request : search },
		success: function(data){
			var temp = '';
			var count = data.count;
			if(count > 0) {
				var list = data.list;
				temp += '<div class="row">';
				temp += '<h3>ditemukan '+data.count+' hasil dengan keyword "'+data.keyword+'"</h3>';
				$.each(list, function(i,v) {
				temp += `<div class="col-sm-6 col-md-4">
					<div class="panel `+v.theme+`">
						<a class="hidden-link" href="`+v.link+`"></a>
						<div class="panel-body">
							<h1 class="title">`+v.title+`</h1>
							<h4 class="center"><a>`+v.slug+`</a></h4>
							<p>`+v.content+`...</p>
						</div>
						<div class="panel-footer">
							<ul class="breadcrumb" style="padding: 0">
								<li><a>`+v.category.toUpperCase()+`</a></li>
								<li><a>`+v.level+`</a></li>
							</ul>
						</div>
					</div>
				</div>`;
				});
				temp += '</div>';						
			} else {
				temp += '<h3>tidak ada hasil yang cocok untuk keyword pencarian</h3>';
				temp += '<h3>"'+data.keyword+'"</h3>';
			}
			$(result).html(temp);
		},
		error: function(xhr){
			handle_ajax(xhr);
		},
		complete: function(){
			endAjax();
			$('.search_bar input').val('');
		}
	});		
}
function widthClass() {
	let ww = document.body.clientWidth;
	if (ww < 992) {
		$('.nav-adjust').addClass('mini');
		$('#profile-box').addClass('hidden-sm hidden-xs');
		$('.main-side').css('margin-right','50px');
		$('.lesson-left').fadeOut();
		$('.lesson-right').css('margin-left',0);
	} else if (ww >= 993) {
		$('.nav-adjust').removeClass('mini');
		$('#profile-box').removeClass('hidden-sm hidden-xs');
		$('.main-side').css('margin-right','370px');
		$('.lesson-left').fadeIn();
		$('.lesson-right').css('margin-left',350);
	};
}
function sideActive(target){
	var url = window.location.pathname,
	urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
	$(target).each(function(){
		if(urlRegExp.test(this.href.replace(/\/$/,''))){
			$(this).addClass('active');
		}
	});
}

function timeElapsed(timeStamp) {
		var dateNow 		= new Date();
		var msPerMinute = 60 * 1000;
		var msPerHour   = msPerMinute * 60;
		var msPerDay    = msPerHour * 24;
		var msPerMonth  = msPerDay * 30;
		var msPerYear   = msPerDay * 365;
		
		var elapsed = dateNow - timeStamp;
		if (elapsed < msPerMinute) {
			return Math.round(elapsed/1000) + ' seconds ago';
		}
		else if (elapsed < msPerHour) {
			return Math.round(elapsed/msPerMinute) + ' minutes ago';   
		}
		else if (elapsed < msPerDay ) {
			return Math.round(elapsed/msPerHour ) + ' hours ago';
		}
		else if (elapsed < msPerMonth) {
			return Math.round(elapsed/msPerDay) + ' days ago';   
		}
		else if (elapsed < msPerYear) {
			return Math.round(elapsed/msPerMonth) + ' months ago';   
		}
		else {
			return Math.round(elapsed/msPerYear ) + ' years ago';   
		}
}

function convert_time(timeStamp,full=false){
	var time, Y, M, _M, Dt, Da, H, Min, S;
	time = new Date(timeStamp);
	Y    = time.getFullYear();
	M    = time.getMonth();
	_M   = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Augs','Sept','Oct','Nov','Dec'];
	M    = _M[M];
	Dt   = time.getDate();
	Da   = time.getDay();
	_Da  = ['Sun','Mon','Tue','Wed','Thr','Fri','Sat'];
	Da   = _Da[Da];
	H    = time.getHours();
	Min  = time.getMinutes();
	S    = time.getSeconds();
		
	function cek(i) {
		if (i < 10) {
			i = "0" + i;
		} return i;
	}
	H   = cek(H);
	Min = cek(Min);
	S   = cek(S);

	var _date, _time;
	_date = Da +", "+ Dt +" "+ M +" "+ Y ;
	_time = H +":"+ Min +":"+ S;
	if(full== false) {
		return _date;
	}else{
		return _date +' | '+ _time;
	}
}

// SCREEN DIMENSION 
	function getStyle(elmnt,style) {
		if (window.getComputedStyle) {
			return window.getComputedStyle(elmnt,null).getPropertyValue(style);
		} else {
			return elmnt.currentStyle[style];
		}
	}


	var dragging = false;
	function dragstart(e) {
		e.preventDefault();
		dragging = true;
		// var main = document.getElementById("jktargetCode");
	}
	function dragmove(e,target) {
		if (dragging) {
			showFrameSize(target);    
		}
	}
	function dragend() {
		dragging = false;
		$('#dm').fadeOut(4000);
	}

