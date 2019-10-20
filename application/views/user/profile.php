

<div class="content-wrapper">
	<section class="content content-profile">
		<main class="row">
			<!-- PHOTO -->
			<div class="col-md-4">
				<div class="box box-primary box-photo box-sh">
					<div id="modal-photo" class="custom-modal hide box-sh">
						<div class="inner-modal">
							<div><button class="btn btn-diss" id="diss-photo"><i class="fa fa-times"></i></button></div>
							<form method="post" enctype="multipart/form-data" action="<?= base_url('u/xhr_photo') ?>" id="form-photo">
								<div class="box-body">
									<img id="img-upload" class="profile-user-img img-responsive img-circle" src="<?= getSession('sess_image') ?>" alt="User Image">
									
									<h3 class="profile-username fred center"><?= '@'.getSession('sess_user') ?></h3>
				        	<br>
				        	<div class="input-group">
				            <span class="input-group-btn">
				                <span class="btn btn-default btn-file">
				                    Pilih foto… <input type="file" name="photo" id="i-photo">
				                </span>
				            </span>
				            <input type="text" class="input-adjust" readonly style="height: 35px">
				        	</div>
				        	<div class="errors" style="margin-top: 20px"></div>			          
			            <div class="form-group submit-photo center">
			            	<button type="submit" class="effect effect-prm" id="btn-update-photo">
			            		<span>Update Photo</span>
			            		<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
			            	</button>
			            </div>
								</div>
							</form>
						</div>
					</div>
					<div class="box-body">
						<div><button id="config-photo" class="btn"><i class="fa fa-edit"></i> Edit Photo</button></div>
						<img class="profile-user-img img-responsive img-circle" src="<?= getSession('sess_image') ?>" alt="User Image">
						<h3 class="profile-username fred center"><?= '<i class="fa '.$icon_gen.'"></i> '.getSession('sess_user') ?></h3>
						<p class="text-muted text-center fred">
						<?php if ( getSession('sess_role') == '1' ) : ?>
							<span>Administrator</span>
						<?php else : ?>	
							<span>Member</span>
						<?php endif; ?>											
						</p>
						<p class="text-muted text-center"><?= ($bio) ? '"'.$bio.'"' : 'belum ada info tentang '.getSession('sess_user') ?></p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item"><i class="fa fa-user-friends"></i> <b>Teman</b> <a class="pull-right">322</a></li>
							<li class="list-group-item"><i class="fa fa-code"></i> <b>Snippet</b> <a class="pull-right">3</a></li>
							<li class="list-group-item"><i class="fa fa-book"></i> <b>Progress Belajar</b> <a class="pull-right">287</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- INFO -->
			<div class="col-md-4">
				<div class="box box-primary box-identity box-sh">
					<div id="modal-identity" class="custom-modal hide box-sh">
						<div class="inner-modal">
							<div><button class="btn btn-diss" id="diss-identity"><i class="fa fa-times"></i></button></div>
							<form method="post" id="form-identity" action="<?= base_url('u/xhr_profile') ?>">
								<div class="">
									<div class="">
										<div class="form-group">
											<label>Nama Lengkap</label><br>
											<input type="text" class="input-adjust" name="name" value="<?= $name ?>" id="i-name">
											<div class="errors"></div>
										</div>
										<div class="form-group">
											<label>Jenis Kelamin</label><br>
											<select class="selectpicker" name="gender" id="i-gender">
												<option value="Laki-laki" <?= ($gender == 'Laki-laki') ? 'selected' : ''; ?> >Laki-laki</option>
												<option value="Perempuan" <?= ($gender == 'Perempuan') ? 'selected' : ''; ?> >Perempuan</option>
											</select>
											<div class="errors"></div>
										</div>
									</div>
									<div class="">
										<div class="form-group">
											<label>Alamat Web</label><br>
											<input type="url" class="input-adjust" name="web" value="<?= $web ?>" id="i-web">
											<div class="errors"></div>
										</div>
										<div class="form-group">
											<label>Profil Singkat (maks 500 karakter)</label><br>
											<input type="text" class="input-adjust" name="bio" value="<?= $bio ?>" id="i-bio">
											<div class="errors"></div>
										</div>
									</div>
								</div>
								<div class="form-group submit-identity center">
									<button class="effect effect-prm" id="btn-update-profile">
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span>Update Profil</span>
									</button>
								</div>
							</form>				
						</div>
					</div>
					<div class="box-body">
						<div><button id="config-identity" class="btn"><i class="fa fa-edit"></i> Edit Info</button></div>
						<div class="" style="padding: 30px 10px 15px;">
							<div class="">
								<strong><i class="fa fa-portrait margin-r-5"></i>Nama Lengkap</strong>
								<p class="text-muted" style="text-transform: capitalize; letter-spacing: 1px;"><?= ($name) ? $name : 'N/A'; ?></p>
								<hr>
								<strong><i class="fa fa-venus-mars margin-r-5"></i>Jenis Kelamin</strong>
								<p class="text-muted"><?= ($gender) ? $gender : 'N/A'; ?></p>
								<hr>
								<strong><i class="fa fa-globe-asia margin-r-5"></i>Website</strong>
								<p class="text-muted"><?= ($web) ? '<a href="'.$web.'" target="_blank">'.$web.'</a>' : 'N/A'; ?></p>
								<hr>												
							</div>										
						</div>
					</div>
				</div>
			</div>
			<!-- ACCOUNT -->
			<?php if($provider == 'local') { ?>
			<div class="col-md-4">
				<div class="box box-primary box-account box-sh">
					<div id="modal-account" class="custom-modal hide box-sh">
						<div class="inner-modal">
							<div><button class="btn btn-diss" id="diss-account"><i class="fa fa-times"></i></button></div>
							<form method="post" id="form-account" action="<?= base_url('u/xhr_password') ?>">
								<div class="form-group">
										<label>Password Saat ini</label><br>
										<input type="password" class="input-adjust" name="pass_0" id="i-pass_0">
										<div class="errors"></div>
								</div>
									<div class="form-group">
										<label>Password Baru</label><br>
										<input type="password" class="input-adjust" name="pass_1" id="i-pass_1">
										<div class="errors"></div>
									</div>
									<div class="form-group">
										<label>Konfirmasi Password Baru</label><br>
										<input type="password" class="input-adjust" name="pass_2" id="i-pass_2">
										<div class="errors"></div>
									</div>
								<div class="form-group submit-account center">
									<button class="effect effect-prm" id="btn-update-account">
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span>Update Password</span>
									</button>
								</div>
							</form>				
						</div>
					</div>
					<div class="box-body">
						<div><button id="config-account" class="btn"><i class="fa fa-edit"></i> Edit Password</button></div>
						<div class="" style="padding: 30px 10px 15px;">
							<div class="">
								<strong><i class="fa fa-user margin-r-5"></i>Username</strong>
								<p class="text-muted"><?= getSession('sess_user') ?></p>
								<hr>
								<strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
								<p class="text-muted"><?= $email ?></p>
								<hr>
							</div>										
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</main>

	</section>
</div>
