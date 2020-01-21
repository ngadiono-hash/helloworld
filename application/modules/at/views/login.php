<?php mainNav() ?>
<style type="text/css">
	.to-fb img {
		width: 250px;
	}
	.to-fb img:hover {
		transition: .3s ease;
		width: 260px;
	}
</style>
<main>
	<div class="container">
		<div class="row">
			<div class="wrapper-sign">
				<div class="left-side">	
					<div class="login scale-in-center col-lg-12">
						<div class="col-md-6 col-lg-6 border">
							<div class="info-login">
								<h1>silahkan masuk...</h1>
								<br>
								<br>
								<p>belum punya akun ? <a class="base-link to-register"><span>buat akun baru</span></a></p>
								
								<p>atau</p>
								<a href="<?= $this->facebook->login_url(); ?>" class="to-fb">
									<img src="<?=base_url('assets/img/feed/fb-button.png')?>">
								</a>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<form id="form-login" action="<?= base_url('xhrm/set_login') ?>" method="post" autocompllete="on">
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="key_email" class="input-text input-log" placeholder="Masukkan Email..." spellcheck="false" id="input-key_email">
									<div id="error"></div>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="key_pass" class="input-text input-log" placeholder="Masukkan Password..." id="input-key_pass">
									<div id="error"></div>
								</div>
								<div style="margin-top: 25px; margin-left: 4px;">
									<input type="checkbox" name="remember" value="1" class="checkin" id="remember" disabled>
									<label for="remember">selalu ingat saya ?</label>
								</div>	        
								<div class="form-group center" style="margin-top: 20px">
									<button type="submit" class="button effect effect-prm btn-log" disabled>
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span><i class="fa fa-sign-in-alt"></i> LOGIN</span>
									</button>
								</div>
								<div class="form-group center">
									<h4><a class="base-link forgot">Lupa Password ?</a></h4>
								</div>
							</form>
						</div>
					</div>
				
					<div class="register off scale-in-center text-focus-in col-lg-12">
						<div class="col-md-6 col-lg-6 border">
							<div class="info-login">
								<h1>silahkan daftar...</h1>
								<br>
								<ul style="text-align: left;">
									<li>gunakan email aktif untuk mendaftar</li>
									<li>lakukan verifikasi setelah berhasil mendaftar</li>
								</ul>
								<br>
								<p>sudah punya akun ? <a class="base-link to-login"><span>masuk ke akun</span></a></p>
								
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<form id="form-register" action="<?= base_url('xhrm/set_register'); ?>" method="post" autocomplete="on">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="input-text input-reg" placeholder="Daftarkan Username..." spellcheck="false" id="input-username">
									<div id="error"></div>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="email" class="input-text input-reg" placeholder="Daftarkan Email..." spellcheck="false" id="input-email">
									<div id="error"></div>
								</div>
									<div class="row">
										<div class="col-md-12 col-lg-6">
											<div class="form-group">
											<label>Password</label>
											<input type="password" name="pass_1" class="input-text input-reg" placeholder="Tulis Password..." id="input-pass_1">	        	
											<div id="error"></div>
											</div>
										</div>
										<div class="col-md-12 col-lg-6">
											<div class="form-group">
											<label>Konfirmasi Password</label>
											<input type="password" name="pass_2" class="input-text input-reg" placeholder="Konfirmasi Password..." id="input-pass_2">	        	
											<div id="error"></div>
											</div>
										</div>
									</div>
								<div class="form-group center" style="margin-top: 10px;">
									<button type="submit" class="button effect effect-ok btn-reg" disabled>
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span><i class="fa fa-user-plus"></i> REGISTER</span>
									</button>
								</div>
							</form>					
						</div>	
					</div>
				</div> 
				<div class="right-side hide">
					<div class="reset scale-in-center col-lg-12">
						<div class="col-md-6 col-lg-6 border">
							<div class="info-reset">
								<h1>Reset Password</h1>
								<br>
								<ul>
									<li>link reset akan dikirim ke alamat email yang tertaut pada akun</li>
									<li>pastikan akun telah terverifikasi untuk dapat mereset passwordnya kembali</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<form id="form-reset" action="<?= base_url('xhrm/set_pw_reset') ?>" method="post" autocompllete="on">
								<div class="form-group">
									<label>Email Akun</label>
									<input type="text" name="reset_email" class="input-text input-log" placeholder="Masukkan Email Akunmu..." spellcheck="false" id="input-reset_email" autocomplete="off">
									<div id="error"></div>
								</div>	        
								<div class="form-group center" style="margin-top: 20px">
									<button type="submit" class="button effect effect-prm btn-reset" disabled>
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span><i class="fa fa-sign-in-alt"></i> RESET</span>
									</button>
								</div>
								<div class="form-group center">
									<h3><a class="base-link back-login">kembali</a></h3>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
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