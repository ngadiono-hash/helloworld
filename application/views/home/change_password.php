<style>
	.image-user {
		width: 150px;
		height: 150px;
		border: 3px solid #ccc;
		padding: 5px;
		margin: 20px auto;
	}
</style>
<?php mainNav() ?>
<main>
	<div class="container">
		<div class="row">
			<div class="wrapper-sign">	
				<div class="change scale-in-center col-lg-12">
					<div class="col-md-6 col-lg-6 border">
						<div class="info-change">
							<h1>ganti password</h1>
							<p><?=$username?></p>
							<p><?=$email?></p>
							<img class="img-circle image-user" src="<?= base_url('assets/img/profile/').$image ?>" alt="image-user">
							<ul>
								<li>buat ulang password dari akunmu</li>
								<li>gunakan password yang mudah diingat dan sulit untuk ditebak orang lain</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<form id="form-change" action="<?= base_url('xhrm/set_pw_change') ?>" method="post" autocompllete="on">
							<div class="form-group">
								<label>Password Baru</label>
								<input type="password" class="input-text input-log" placeholder="Masukkan Password Baru..." spellcheck="false" name="pass_1" id="input-pass_1">
								<div id="error"></div>
							</div>
							<div class="form-group">
								<label>Konfirmasi Password</label>
								<input type="password" class="input-text input-log" placeholder="Masukkan Password Konfirmasi" name="pass_2" id="input-pass_2">
								<div id="error"></div>
							</div>
							<div class="form-group center" style="margin-top: 20px">
								<button type="submit" class="button effect effect-prm btn-change" disabled>
									<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
									<span><i class="fa fa-sign-in-alt"></i> UPDATE</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>