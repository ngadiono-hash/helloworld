<?php mainNav() ?>
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
								<a href="<?= $this->facebook->login_url(); ?>" class="effect effect-prm social"><span><i class="fab fa-facebook"></i> Login via Facebook</span></a>
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