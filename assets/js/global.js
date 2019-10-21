
const host = 'http://'+window.location.hostname+'/helloworld/';
const path = window.location.pathname;
const imgLoad = '<img src="'+ host +'assets/img/feed/bars.svg" height="50">';

function startAjax(){
	var temp = '<div class="loading">';
	temp += '<img src="'+ host +'assets/img/feed/bars.svg" height="250" alt="ajax-send">';
	temp += '</div>';
	$('.overlay').removeClass('hide');
	$('.overlay').html(temp);
}
function endAjax(){
	$('.overlay').addClass('hide');
	$('.overlay').html('');
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

function C_Session() {
	var str = "chksession = true";
	$.ajax({
		type: "POST",
		url: host + "xhrm/get_session",
		data: { csrf_token: csrf },
		cache: false,
		success: function(data){
			if(data == "1") {
				alertDanger('login','server session expired<br>silahkan lakukan login kembali');
			}
		}
	});
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
		+ '<input type="text" class="input-adjust hide" id="detail-bug" placeholder="tulis bug di sini untuk dilaporkan" autocomplete="off">'
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
	} else if (tipe == 'back') {
		button = '<a onclick="Swal.clickConfirm()" class="effect"><span>OK</span></a>';
		button += '<a onclick="window.history.back()" class="effect"><span>KEMBALI</span></a>';
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
		allowOutsideClick: false
	});
	if(dir != '' && dir != 'back'){
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
	alertBug('report','bugs '+xhr.status+'',xhr.status);
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
	function showFrameSize() {
		var t;
		var width, height;
		width = Number(getStyle(document.getElementById("jktargetCode"), "width").replace("px", "")).toFixed();
		height = Number(getStyle(document.getElementById("jktargetCode"), "height").replace("px", "")).toFixed();
		$('#dm').fadeIn();
		$('#dm').html("<span>" + width + " x " + height + "</span>");
		
	}
	var dragging = false;
	function dragstart(e) {
		e.preventDefault();
		dragging = true;
		var main = document.getElementById("jktargetCode");
	}
	function dragmove(e) {
		if (dragging) {
			showFrameSize();    
		}
	}
	function dragend() {
		dragging = false;
		$('#dm').fadeOut(4000);
	}

