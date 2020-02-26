
const host = 'http://'+window.location.hostname+'/helloworld/';
const path = window.location.pathname;
const csrf = $('meta[name="csrf"]').attr('content');
const imgLoad = '<img src="'+ host +'assets/img/feed/bars.svg" height="50">';
const uri_pattern = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/ig;

function myAlert(data=[]){
	var alt = $('.alert-auto');
	alt.fadeIn(500);
	if (data['status'] == 1) {
		alt.addClass('alert-success')
		btn = '<i class="fa fa-check"></i> '+ data["message"] +'';
	} else {
		alt.addClass('alert-danger');
		btn = '<i class="fa fa-exclamation-triangle"></i> '+ data["message"] +'';
	}
	alt.find('h4').html(btn);
	setTimeout(function(){
		alt.fadeOut(1000);
	}, 4000);
	alt.removeClass('btn-success btn-danger');
}
function writeResult(data){
	$('#result').html('<script>'+data["message"]+'<\/script>');
	setTimeout(function(){
		$('#result').empty();
	}, 1000);	
}
function linkActive(target){
  var url = window.location.pathname;
  var urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
  $(target).each(function(){
    if(urlRegExp.test(this.href.replace(/\/$/,''))){
      $(this).addClass('active');
    }
  });
}
function startAjax(btn=''){
	if(btn != '') {
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');		
	}
}
function endAjax(btn=''){
	if(btn != '') {
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');		
	}
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
			buttonsStyling : true,
			customClass: {
				confirmButton: '',
				cancelButton: ''
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



