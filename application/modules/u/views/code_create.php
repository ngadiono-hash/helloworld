<script>$('body').addClass('sidebar-collapse')</script>
<div class="content-wrapper">
	<section class="content content-create">

		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs" id="control-left">
					<li class="center">
						<a class="tab-html" data-toggle="tab" href="#third"><i class="fab fa-fw fa-html5"></i></a>
					</li>
					<li class="center">
						<a data-toggle="tab" href="#fourth"><i class="fab fa-fw fa-css3-alt"></i></a>
					</li>
					<li class="center">
						<a data-toggle="tab" href="#fifth"><i class="fab fa-fw fa-js"></i></a>
					</li>			  	
				</ul>
				<ul class="nav nav-tabs pull-right" id="control-right">
					<li class="center">
						<a class="" data-toggle="modal" href="#modal-config-snip"><i class="fa fa-fw fa-cog"></i></a>
					</li>						
					<li class="center run" data-toggle="tooltip" data-placement="top" title="RUN CODE">
						<a data-href="" class="" id="run"><i class="fa fa-fw fa-play"></i></a>
					</li>
					<li class="center " data-toggle="tooltip" data-placement="top" title="AUTO RUN">
						<a class="" id="liveEdit"><i class="fa fa-fw fa-sync"></i></a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="first" class="tab-pane fade in active">
						<div class="welcome-snippet">
							<h2 class="text-muted">Selamat datang <span><?= getSession('sess_user') ?></span></h2><br>
							<p>Di sini, kami menyediakan sarana belajar praktek menulis kode program dengan bermodalkan HTML, CSS, JavaScript dan beberapa resource library.</p>
							<p>Kode program yang kamu tulis akan ditampilkan di halaman lain dari website ini untuk bisa diberikan komentar dari anggota lainnya.</p>
							<p>Dengan adanya fitur ini, diharapkan bisa untuk berbagi pengetahuan tentang potongan-potongan kode program agar bisa digunakan atau mendapat apresiasi dari para pengunjung website.</p>
							<p class="center"><a class="effect effect-prm" data-toggle="modal" href="#modal-config-snip">
								<span>ayo mulai</span>
							</a></p>
						</div>							
					</div>
					<div id="second" class="tab-pane fade">
						<div class="info-snippet">

						</div>
					</div>
					<div id="third" class="tab-pane fade">
						<div class="box-body body-html" id="html"></div>
						<div class="info-tab">
							<button class="btn">Tab HTML</button>
						</div>
					</div>
					<div id="fourth" class="tab-pane fade">
						<div class="box-body body-css" id="css"></div>
						<div class="info-tab">
							<button class="btn" id="badge-css">Tab CSS</button>
						</div>
					</div>
					<div id="fifth" class="tab-pane fade">
						<div class="box-body body-js" id="js"></div>
						<div class="info-tab">
							<button class="btn" id="badge-js">Tab JAVASCRIPT</button>
						</div>
					</div>
					<div id="sixth" class="tab-pane fade">

					</div>				  
				</div>

			</div>

			<div class="splitter"></div>

			<div class="panel-right">
				<div id="dm"></div>
				<iframe class="frame" id="result-frame"></iframe>
			</div>
			
		</div>
		<div id="logger" class="hide" style="position: absolute; min-height: 100px; background: aqua; bottom: 17px; z-index: 1; width: 100%;"></div>
	</section>
</div>
<div class="modal fade" id="modal-config-snip">
	<div class="modal-dialog">
		<div class="modal-content" style="padding: 5px">
			<div class="nav-tabs-custom nav-tab-config">
				<ul class="nav nav-tabs">
					<li class="fred active"><a href="#tab_one" class="tab-info" data-toggle="tab">Info</a></li>
					<li class="fred"><a href="#tab_two" data-toggle="tab">Resource</a></li>
					<li class="fred"><a href="#tab_three" data-toggle="tab">Finish</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_one">
						<div class="form-group">
							<h4 class="fred text-muted">Judul Snippet <span class="text-danger">*</span></h4>
							<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet">
						</div>
						<div class="form-group">
							<h4 class="fred text-muted">Deskripsi Snippet</h4>
							<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"></textarea>
						</div>
						<div class="form-group">
							<h4 class="fred text-muted">Tag Snippet <span class="text-danger">*</span></h4>
							<select id="select-tag" multiple="multiple" style="width: 100%">
							<?php	foreach ($tag as $t) { ?>
								<option value='<?=$t['category_id']?>'>
									<span><?=$t['category_name']?></span>
								</option>
							<?php } ?>
							</select>
						</div>
					</div>
					<div class="tab-pane" id="tab_two">
						<div class="row">
							<div class="col-sm-12 hide">
								<div class="alert alert-info alert-dissmisable fade in">
									<button class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-info-circle"></i> Info</h4>
									<p><i class="far fa-hand-point-right"></i> (Optional) Pilih beberapa library untuk digunakan dalam snippet, seperti bootstrap, jquery, resource-font dan lainnya.</p>
									<p><i class="far fa-hand-point-right"></i> Beberapa framework seperti Bootstrap dan DataTable membutuhkan library jQuery, jadi pastikan jika ingin menggunakannya, klik centang pada library jQuery.</p>
								</div>									
							</div>
							<div class="col-sm-12">
								<h4 class="fred text-muted">resource library jQuery</h4>
								<input type="checkbox" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" value='<?=popu($jQuery[0]['cdn_link'])?>'>
								<label for="checkbox-jquery">library jQuery</label><br>
							</div>							
							<div class="col-sm-12">
								<h4 class="fred text-muted">resource library/framework</h4>
								<select class="input-adjust" id="select-library" multiple="multiple" style="width: 100%">
									<?php	foreach ($framework as $f) { ?>
										<option value='<?=popu($f['cdn_link'])?>' data-id='<?=$f['id']?>'>
											<span><?=$f['cdn_name']?></span>
											<span><?=$f['cdn_version']?></span>
										</option>
									<?php } ?>
								</select>

								<div class="add-library hide">
									<br>
									<h4 class="center fred text-muted">tidak ada framework atau library yang dibutuhkan ?</h4>
									<h4 class="center">
										<button class="btn btn-ok" data-toggle="modal" href="#modal-add-library">
											<span>tambahkan library</span></button>
										</h4>
									</div>	
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_three">
							<div class="info-snippet">
								<p>Mari kita review kodemu</p>
								<h4 class="fred text-muted">Judul Snippet :</h4>
								<div id="title-snippet" class="input-adjust">belum ada judul yang dimasukkan</div>
								<h4 class="fred text-muted">Tag Snippet : </h4>
								<div id="tag-name" class="input-adjust">belum ada tag</div>
								<h4 class="fred text-muted">jQuery Library : </h4>
								<div id="jquery-name" class="input-adjust">jQuery non-aktif</div>
								<h4 class="fred text-muted">Framework Library : </h4>
								<div id="source-name" class="input-adjust">tidak ada framework atau library yang dipilih</div>
								<br>
								<p>Jika sudah yakin kodenya benar, silahkan klik centang publik dan klik tombol SAVE.</p>
								<input type="checkbox" id="checkbox-public" class="checkin">
								<label for="checkbox-public">tampilkan snippet ini ke publik ?</label><br>
								
								<a style="position: absolute; top: 1px; right: 2px;" data-href="<?= base_url('snippet/xhr_create') ?>" class="effect" id="submit-snippet">
									<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
									<span><i class="fas fa-save"></i> SAVE</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<div class="modal fade" id="modal-add-library">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="alert alert-info alert-dissmisable fade in">
					<button class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-info-circle"></i> Info</h4>
					<p><i class="far fa-hand-point-right"></i> Kamu bisa menambahkan CDN resource dari berbagai sumber lain.</p>
					<p><i class="far fa-hand-point-right"></i> CDN yang kamu tambahkan nantinya akan bisa dipakai oleh member lainnya.</p>
					<p><i class="far fa-hand-point-right"></i> CDN akan melalui proses validasi oleh administrator sebelum nantinya akan bisa digunakan.</p>
				</div>
				<form id="form-add-cdn" method="post">
					<div class="row">
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
							<button data-href="<?=base_url('xhru/create_cdn')?>" class="btn btn-ok" id="submit-cdn">
								<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
								<span>ajukan permintaan</span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<input type="hidden" id="input-jquery">
<input type="hidden" id="input-framework">
<input type="hidden" id="input-tag">
<input type="hidden" id="input-public" value="0">
<textarea class="hide" id="source-jquery"></textarea>
<textarea class="hide" id="source-framework"></textarea>

<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>
<script src="<?= base_url('assets/js/config-edito.js') ?>"></script>

<script>

	if (window.addEventListener) {
		$('.splitter').on('mousedown',function(e){
			dragstart(e);
		});
		$(window).on('mousemove',function(e){
			dragmove(e,'result-frame');
		});
		$(window).on('mouseup',function(e){
			dragend();
		});
	}	
	$('#plus').on('click',function(){
		var id = $(this).data('id');
		$(this).data('id',(id+1));
		var temp = `
		<input type="text" name="cdn[`+(id+1)+`]" class="input-adjust" placeholder="tambahkan CDN link lainnya jika ada">
		<div id="cdn`+(id+1)+`"></div>
		`;
		if($('#field-link input').length < 3) {
			$('#field-link').append(temp);
		} else {
			$(this).remove();
		}
	});
	$('#modal-add-library').on('show.bs.modal',function(){
		$('#modal-config-snip').modal('hide');
	});	
</script>