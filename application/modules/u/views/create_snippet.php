<?php signedNavbar() ?>
<div class="create-snippet">
	<div class="panel-container">
		<div class="panel-left editor">
			<ul class="nav nav-tabs control-left">
				<li><a class="tab-html" data-toggle="tab" href="#third">HTML</a></li>
				<li><a data-toggle="tab" href="#fourth">CSS</a></li>
				<li><a data-toggle="tab" href="#fifth">JS</a></li>
			</ul>
			<ul class="nav nav-tabs control-right">
				<li class="run tip tip-bottom" data-placement="bottom" title="RUN">
					<a class="mini" id="run"><i class="fa fa-fw fa-play"></i></a>
				</li>
				<li class="tip tip-bottom" data-placement="bottom" title="AUTO">
					<a class="mini" id="liveEdit"><i class="fa fa-fw fa-sync"></i></a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="first" class="tab-pane fade in active">
					<div class="welcome-snippet">
						<p>Kami menyediakan sarana belajar praktek menulis kode program dengan bermodalkan HTML, CSS, JavaScript dan beberapa resource library.</p>
						<p>Kode program yang kamu tulis akan ditampilkan pada segmen Snippet dari website ini untuk bisa diberikan komentar dari anggota lainnya.</p>
						<p>Dengan adanya fitur ini, diharapkan bisa untuk berbagi pengetahuan tentang potongan-potongan kode program agar bisa digunakan atau mendapat apresiasi dari para pengunjung website.</p>
						<p class="center">
							<a class="effect lg" data-toggle="modal" data-target="#modal-config-snip"><span>ayo mulai</span></a>
						</p>
					</div>
				</div>
				<div id="third" class="tab-pane fade">
					<div class="body-html" id="html"></div>
					<div class="alert alert-info alert-dissmisable fade in alert-absolute">
						<h4><i class="icon fa fa-info-circle"></i> Info</h4>
						<p><i class="far fa-hand-point-right"></i> kamu bisa memulai dengan menulis kode HTML.</p>
						<p><i class="far fa-hand-point-right"></i> cukup tulis tag HTML yang sering digunakan dalam tag body misalkan <code>&lt;h1&gt;</code> , <code>&lt;p&gt;</code> , atau <code>&lt;div&gt;</code>.</p>
						<p><i class="far fa-hand-point-right"></i> tidak perlu menulis tag seperti deklarasi <code>&lt;!DOCTYPE&gt;</code> ataupun <code>&lt;head&gt;</code>.</p>
						<p><i class="far fa-hand-point-right"></i> begitu juga pada tab CSS dan tab JS, tidak perlu lagi menulis tag <code>&lt;style&gt;</code> atau <code>&lt;script&gt;</code>.</p>
						<p class="center">
							<a class="effect" data-dismiss="alert" aria-hidden="true"><span>OK</span></a>
						</p>
					</div>
				</div>
				<div id="fourth" class="tab-pane fade">
					<div class="body-css" id="css"></div>
				</div>
				<div id="fifth" class="tab-pane fade">
					<div class="body-js" id="js"></div>
				</div>
			</div>
		</div>
		<div class="splitter"></div>
		<div class="panel-right">
			<div id="dm"></div>
			<iframe class="frame" id="result-frame"></iframe>
		</div>
	</div>

	<div id="modal-config-snip" class="modal modal-config-snip fade">
		<div class="modal-dialog">
			<div class="modal-content" style="padding: 5px">
				<div class="nav-tab-config editor">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_one" class="tab-modal tab-info" data-toggle="tab">Info</a></li>
						<li><a class="tab-modal" href="#tab_two" data-toggle="tab">Resource</a></li>
						<li><a class="tab-modal" href="#tab_three" data-toggle="tab">Review</a></li>
						<li class="add-library hide"><a class="tab-modal" href="#tab_four" data-toggle="tab">Library</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_one">
							<div class="info-snippet">
								<div class="col-xs-6">
									<h4 class="fred text-muted">Judul Snippet <span class="text-danger">*</span></h4>
									<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet">
								</div>
								<div class="col-xs-6">
									<h4 class="fred text-muted">Tag Snippet <span class="text-danger">*</span></h4>
									<select id="select-tag" multiple="multiple" style="width: 100%">
										<?php	foreach ($tag as $t) { ?>
											<option value='<?=$t['category_id']?>'>
												<span><?=$t['category_name']?></span>
											</option>
										<?php } ?>
									</select>
								</div>
								<div class="col-xs-12">
									<h4 class="fred">Deskripsi Snippet</h4>
									<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"></textarea>
								</div>
								<div class="col-xs-12">
									<h4 class="fred">Privasi Snippet</h4>
									<input type="checkbox" id="checkbox-public" class="checkin pub">
									<label for="checkbox-public">tampilkan snippet ini ke publik ?</label>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_two">
							<div class="info-snippet">
								<div class="alert alert-info alert-dissmisable fade in alert-absolute">
									<h4><i class="icon fa fa-info-circle"></i> Info</h4>
									<p><i class="far fa-hand-point-right"></i> Kamu bisa menggunakan beberapa library yang tersedia untuk digunakan dalam snippet</p>
									<p><i class="far fa-hand-point-right"></i> Library CDN yang disediakan umumnya sudah berupa satu paket resource berupa file <code>.css</code> dan file <code>.js</code></p>
									<p><i class="far fa-hand-point-right"></i> Beberapa framework seperti Bootstrap dan DataTable membutuhkan library jQuery, jadi pastikan jika ingin menggunakannya, klik centang pada library jQuery.</p>
									<p class="center">
										<a class="effect lg" data-dismiss="alert" aria-hidden="true"><span>OK</span></a>
									</p>
								</div>
								<div class="col-xs-12">
									<h4 class="fred text-muted">resource library jQuery</h4>
									<input type="checkbox" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" value='<?=popu($jQuery[0]['cdn_link'])?>'>
									<label for="checkbox-jquery">jQuery</label><br>
								</div>
								<div class="col-xs-12">
									<h4 class="fred text-muted">resource package library/framework</h4>
									<select class="input-adjust" id="select-library" multiple="multiple" style="width: 100%">
										<?php	foreach ($framework as $f) { ?>
											<option value='<?=popu($f['cdn_link'])?>' data-id='<?=$f['id']?>'>
												<span><?=$f['cdn_name']?> <?=$f['cdn_version']?></span>
											</option>
										<?php } ?>
									</select>
								</div>
								<div class="col-xs-12">
									<ul id="list-jquery"></ul>
									<ul id="list-framework"></ul>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_three">
							<div class="info-snippet">
								<p>Mari kita review kodemu</p>
								<p>Jika sudah yakin snippet tidak ada error, silahkan simpan snippet ini dengan menekan tombol ikon <i class="fa fa-save"></i> pada navbar.</p>
								
								<div class="col-xs-12">
									<h4 class="fred text-muted">Judul Snippet :</h4>
									<p id="title-snippet">belum ada judul yang dimasukkan</p>
								</div>
								<div class="col-xs-12">
									<h4 class="fred text-muted">Tag Snippet : </h4>
									<div id="tag-name" class="input-">belum ada tag</div>
								</div>
								<div class="col-xs-4">
									<h4 class="fred text-muted">jQuery Library : </h4>
									<div id="jquery-name" class="input-">jQuery non-aktif</div>
								</div>
								<div class="col-xs-8">
									<h4 class="fred text-muted">package Framework/Library : </h4>
									<div id="source-name" class="input-">tidak ada framework atau library yang dipilih</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="tab-pane" id="tab_four">
							<div class="info-snippet">
								<div class="alert alert-info alert-dissmisable fade in alert-absolute">
									<h4><i class="icon fa fa-info-circle"></i> Info</h4>
									<p><i class="far fa-hand-point-right"></i> Kamu bisa menambahkan library CDN resource dari berbagai sumber lain selain yang telah disediakan.</p>
									<p><i class="far fa-hand-point-right"></i> Library CDN yang kamu tambahkan nantinya akan bisa dipakai oleh member lainnya.</p>
									<p><i class="far fa-hand-point-right"></i> CDN akan melalui proses validasi oleh administrator sebelum nantinya akan bisa digunakan.</p>
									<p class="center">
										<a class="effect lg" data-dismiss="alert" aria-hidden="true"><span>OK</span></a>
									</p>
								</div>
								<form id="form-add-cdn" method="post">
									<div class="">
										<div class="col-xs-6">
											<h4 class="fred">Nama CDN <small class="text-danger">*</small></h4>
											<input type="text" name="cdn_name" class="input-adjust" placeholder="contoh : jquery-validate">
											<div id="cdn-name"></div>
										</div>
										<div class="col-xs-6">
											<h4 class="fred">Versi CDN <small class="text-danger">*</small></h4>
											<input type="text" name="cdn_version" class="input-adjust" placeholder="contoh : 3.4.5">
											<div id="cdn-version"></div>
										</div>
										<div class="col-xs-12">
											<h4 class="fred">
												<span>Link CDN <small class="text-danger">*</small> (maksimal 3 link)</span>
												<a id="plus" data-id="0" class="btn btn-sm btn-default"><i class="fa fa-plus"></i></a>
											</h4>
											<div id="field-link">
												<input type="text" name="cdn[0]" class="input-adjust" placeholder="contoh : https://domain/version/resource.css">
												<div id="cdn0"></div>
											</div>
										</div>
										<div class="col-xs-12 center">
											<br>
											<a data-href="<?=base_url('xhru/create_cdn')?>" class="effect lg" id="submit-cdn">
												<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
												<span>ajukan</span>
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="display: none;">
	<input type="hidden" id="input-jquery">
	<input type="hidden" id="input-framework">
	<input type="hidden" id="input-tag">
	<input type="hidden" id="input-public" value="0">
	<textarea class="hide" id="source-jquery"></textarea>
	<textarea class="hide" id="source-framework"></textarea>	
</div>

<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>
<script src="<?= base_url('assets/js/config-editor.js') ?>"></script>

<script>
	$('#plus').on('click',function(){
		var id = $(this).data('id');
		$(this).data('id',(id+1));
		var temp = `
		<input type="text" name="cdn[`+(id+1)+`]" class="input-adjust" placeholder="tambahkan link CDN lainnya">
		<div id="cdn`+(id+1)+`"></div>
		`;
		if($('#field-link input').length < 3) {
			$('#field-link').append(temp);
		} else {
			$(this).remove();
		}
	});
	$('#select-library').one('change',function(){
		$('.add-library').removeClass('hide')
	});
	$('#form-add-cdn').on('click','#submit-cdn',function(e){
		e.preventDefault();
		var btn = $('#submit-cdn');
		var datax = $('#form-add-cdn').serialize()+'&'+$.param({ csrf_token: csrf });
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');
		$.ajax({
			url : host + 'xhru/create_cdn',
			type : 'POST',
			data : datax,
			success : function(data){
				$('#form-add-cdn').siblings('.alert').remove();
				$.each(data, function(key, value){
					$('#'+key).html(value);
				});
				writeResult(data);
				if (data.status == 1) {
					$("#form-add-cdn")[0].reset();
					$('#modal-add-library').modal('hide');
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
	$('#submit-snippet').on('click', function(){
		var btn = $('#submit-snippet');
		var datax = {
			title: $('#input-title').val(),
			tag : $('#input-tag').val(),
			framework: $('#input-framework').val(),
			jquery: $('#input-jquery').val(),
			html: field.html.session.getValue(),
			css: field.css.session.getValue(),
			js: field.js.session.getValue(),
			description : $('#input-desc').val(),
			public : $('#input-public').val(),
			csrf_token : csrf
		};
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');
		$.ajax({
			url : host + 'xhru/create_snip',
			type : 'post',
			dataType: 'json',
			data : datax,
			success : function(data){
				writeResult(data);
				if (data.status == 1) {
					$('#modal-config-snip').modal('show');
					$('.nav-tab-config .nav-tabs').children('li').removeClass('active');
					$('.tab-info').parent('li').addClass('active');
					$('.nav-tab-config .tab-pane').removeClass('in active');
					$('#tab_one').addClass('in active');
				} else if (data.status == 2) {
					$('#modal-config-snip').modal('hide');
					$('.tab-html').parent('li').addClass('active');
					$('.panel-left .tab-pane').removeClass('in active');
					$('#third').addClass('in active');
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
</script>