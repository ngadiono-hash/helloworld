<?php signedNavbar() ?>

<div class="bg signed box-sh"></div>
<article class="edit-profile">
	<div class="container">
		<h1>silahkan perbarui data diri kamu</h1>
		<div class="row">
			<div class="cubic col-sm-8 col-sm-offset-2" style="padding: 10px;">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#photo">Info Foto</a></li>
					<li><a class="" data-toggle="tab" href="#info">Info Profil</a></li>
					<li><a class="" data-toggle="tab" href="#account">Info Akun</a></li>
				</ul>
				<div class="tab-content" style="background: #fff">
					<div id="photo" class="body-photo tab-pane fade in active">
						<div class="cubic" style="padding: 10px;">
							<form method="post" enctype="multipart/form-data" action="<?= base_url('u/xhr_photo') ?>" id="form-photo">
								<img id="img-upload" class=" img-circle" src="<?= getSession('sess_image') ?>" alt="User Image">
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
			        	<div class="errors center" style="margin-top: 20px"></div>
		            <div class="form-group submit-photo center">
		            	<button type="submit" class="effect lg" id="btn-update-photo">
		            		<span>UPDATE</span>
		            		<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
		            	</button>
		            </div>
							</form>
						</div>
					</div>
					<div id="info" class="body-info tab-pane fade">
						<div class="cubic" style="padding: 10px;">
							<form method="post" id="form-identity">
								<div class="" style="display: flex;">
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="input-adjust" name="name" value="<?= $fetch['name'] ?>" id="i-name" placeholder="masukkan nama lengkap kamu">
										<div class="errors"></div>
									</div>
									<div class="form-group" style="margin-left: 10px;">
										<label>Jenis Kelamin</label>
										<select class="selectpicker" name="gender" id="i-gender" data-width="100%">
											<option value="Laki-laki" <?= ($fetch['gender'] == 'Laki-laki') ? 'selected' : ''; ?> >Laki-laki</option>
											<option value="Perempuan" <?= ($fetch['gender'] == 'Perempuan') ? 'selected' : ''; ?> >Perempuan</option>
										</select>
										<div class="errors"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<label>Alamat Web</label>
											<input type="url" class="input-adjust" name="web" value="<?= $fetch['web'] ?>" id="i-web" placeholder="masukkan alamat web kamu jika ada">
											<div class="errors"></div>
										</div>
									</div>
									<div class="col-xs-12">
										<div class="form-group">
											<label>Profil Singkat</label>
											<textarea class="input-adjust" name="bio" id="i-bio" placeholder="jelaskan profilmu secara singkat"><?= $fetch['bio'] ?></textarea>
											<div class="errors"></div>
										</div>
									</div>
								</div>
								<div class="form-group submit-identity center">
									<button class="effect lg" id="btn-update-profile">
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span>UPDATE</span>
									</button>
								</div>
							</form>
						</div>
					</div>
					<div id="account" class="body-account tab-pane fade">
						<div class="cubic" style="padding: 10px;">
							<form method="post" id="form-account">
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group tip tip-bottom" title="username tidak dapat diubah" data-placement="bottom">
											<label>Username</label>
											<input type="text" class="input-adjust" value="<?=$fetch['username']?>" readonly>
										</div>
										<div class="form-group tip tip-bottom" title="email digunakan untuk masuk ke akun" data-placement="bottom">
											<label>Email</label>
											<input type="text" class="input-adjust" value="<?=$fetch['email']?>" readonly>
										</div>
										<div class="form-group">
											<label>Terdaftar</label>
											<input type="text" class="input-adjust" value="<?=date('d M Y - H:i',$fetch['register'])?>" readonly>
											<input type="text" class="input-adjust" value="<?=time_elapsed_string('@'.$fetch['register'])?>" readonly>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label>Password Aktif</label>
											<input type="password" class="input-adjust" name="pass_0" id="i-pass_0" placeholder="masukkan password saat ini">
											<div class="errors"></div>
										</div>
										<div class="form-group">
											<label>Password Baru</label>
											<input type="password" class="input-adjust" name="pass_1" id="i-pass_1" placeholder="masukkan password baru">
											<div class="errors"></div>
										</div>
										<div class="form-group">
											<label>Konfirmasi Password</label>
											<input type="password" class="input-adjust" name="pass_2" id="i-pass_2" placeholder="ketik ulang password baru">
											<div class="errors"></div>
										</div>										
									</div>
								</div>
								<div class="form-group submit-account center">
									<button class="effect lg" id="btn-update-account">
										<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
										<span>UPDATE</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
<?php mainFooter() ?>

<script>
	$('#form-identity input,#form-identity select, #form-account input').keyup(function() {
		$(this).parents('.form-group').find('.errors').html('');
	});	
	$('.edit-profile').on('change','.btn-file :file',function(){
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
	$('#form-photo').submit(function(e){
		e.preventDefault();
		var x = new FormData(this);
		startAjax();
		$.ajax({
			url : host + 'xhru/update_photo',
			type : 'POST',
			cache: false,
			contentType: false,
			async: false,
			processData: false,
			data : x,
			success: function(data){
				if(data['status'] == 1){
					writeResult(data);
				} else if (data['status'] == 0) {
					$('#form-photo').find('.errors').html(data['message']);
				}
				$('#form-photo').reset();
			},
			error: function(xhr){ handle_ajax(xhr) },
			complete : function(){ endAjax() }
		});
	});
	$('.edit-profile').on('click','#btn-update-profile',function(e){
		e.preventDefault();
		var datax = $('#form-identity').serialize()+'&'+$.param({ csrf_token: csrf });
		startAjax('#btn-update-profile');
		$.ajax({
			url: host + 'xhru/update_profile',
			type: 'POST',
			dataType: 'json',
			data: datax,
			success : function(data){
				$.each(data, function(key, value){
					$('#i-' + key).parents('.form-group').find('.errors').html(value);
				});
				if(data['status'] == 1){
					writeResult(data);
				}
			},
			error: function(xhr){ handle_ajax(xhr) },
			complete : function(){ endAjax('#btn-update-profile') }
		});
	});
	$('.edit-profile').on('click','#btn-update-account',function(e){
		e.preventDefault();
		var datax = $('#form-account').serialize()+'&'+$.param({ csrf_token: csrf });
		startAjax('#btn-update-account');
		$.ajax({
			url: host + 'xhru/update_password',
			type: 'POST',
			dataType: 'json',
			data: datax,
			success : function(data){
				$.each(data, function(key, value){
					$('#i-' + key).parents('.form-group').find('.errors').html(value);
				});
				writeResult(data);
			},
			error: function(xhr){ handle_ajax(xhr) },
			complete : function(){ endAjax('#btn-update-account') }
		});
	});
</script>

