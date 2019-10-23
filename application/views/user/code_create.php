<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.js"></script>
<div class="content-wrapper">
	<section class="content content-create">

		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs">
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
				<ul class="nav nav-tabs" style="float: right;">
					<li class="center">
						<a class="" data-toggle="modal" href="#modal-config-snip">
							<i class="fa fa-fw fa-cog"></i>
						</a>
					</li>						
					<li class="center run" data-toggle="tooltip" data-placement="top" title="RUN CODE">
						<a data-href="" class="" id="run">
							<i class="fa fa-fw fa-play"></i>
						</a>
					</li>
					<li class="center " data-toggle="tooltip" data-placement="top" title="AUTO RUN">
						<a class="" id="liveEdit">
							<i class="fa fa-fw fa-sync"></i>
						</a>
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
					<li class="active"><a href="#tab_one" class="tab-info" data-toggle="tab">Info Snippet</a></li>
					<li class=""><a href="#tab_two" data-toggle="tab">Resource CDN</a></li>
					<li class=""><a href="#tab_three" data-toggle="tab">Selesai</a></li>
					<!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-cog"></i></a></li> -->
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_one">
						<div class="form-group">
							<h4 class="fred text-muted">Judul Snippet <span class="text-danger">*</span></h4>
							<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet">
						</div>
						<hr>
						<div class="form-group">
							<h4 class="fred text-muted">Deskripsi Snippet</h4>
							<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"></textarea>
						</div>
						<hr>
						<div class="form-group">
							<h4 class="fred text-muted">Tag Snippet</h4>
							<select class="selectpick" id="select-tag" multiple="multiple" style="width: 50%">
								<option>dnodod</option>
								<option>dnodod</option>
								<option>dnodod</option>
								<option>dnodod</option>
							</select>
						</div>
					</div>
					<div class="tab-pane" id="tab_two">
						<div class="row">
							<div class="col-sm-12">
								<div class="alert alert-info alert-dissmisable fade in">
									<button class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4><i class="icon fa fa-info-circle"></i> Info</h4>
									<p><i class="far fa-hand-point-right"></i> (Optional) Pilih beberapa library untuk digunakan dalam snippet, seperti bootstrap, jquery, resource-font dan lainnya.</p>
									<p><i class="far fa-hand-point-right"></i> Beberapa framework seperti Bootstrap dan DataTable membutuhkan library jQuery, jadi pastikan jika ingin menggunakannya, klik centang pada library jQuery.</p>
								</div>									
							</div>
							<div class="col-sm-12">
								<h4 class="fred text-muted">resource library jQuery</h4>
								<input type="checkbox" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" value='<?=popu($jQuery[0]['cdn_js'])?>'>
								<label for="checkbox-jquery">library jQuery</label><br>
								<input type="hidden" id="input-jquery">
								<textarea class="hide" id="source-jquery"></textarea>
							</div>							
							<div class="col-sm-12">
								<h4 class="fred text-muted">resource library/framework</h4>
								<select class="input-adjust" id="select-library" multiple="multiple" style="width: 50%">
									<option>pilih library</option>
									<?php	foreach ($framework as $f) { ?>
										<option value='<?=popu($f['cdn_js'])?>' data-id='<?=$f['id']?>'>
											<span><?=$f['cdn_name']?></span>
											<span><?=$f['cdn_version']?></span>
										</option>
									<?php } ?>
								</select>
								<input type="hidden" id="input-framework">
								<textarea class="hide" id="source-framework"></textarea>		
							</div>
						</div>
					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="tab_three">
						<div class="info-snippet">
							<p>Mari kita review kodemu</p>
							<h4 class="fred text-muted">Judul Snippet kamu :</h4>
							<div id="title-snippet" class="input-adjust">belum ada judul yang dimasukkan</div>
							<h4 class="fred text-muted">Framework library yang digunakan : </h4> <span class="text-primary" id="jquery-name"></span>
							<div id="source-name" class="input-adjust">tidak ada framework atau library yang dipilih</div>
							<h4 class="fred text-muted">jQuery Library : </h4>
							<div id="jquery-name" class="input-adjust">tidak</div>
							<br>
							<p>Jika sudah yakin kodenya benar, silahkan klik centang publik dan klik tombol simpan.</p>
							<input type="checkbox" id="checkbox-public" class="checkin">
							<label for="checkbox-public">tampilkan snippet ini ke publik ?</label><br>
							<input type="hidden" id="input-public">
							<div class="center">
								<a data-href="<?= base_url('snippet/xhr_create') ?>" class="effect" id="submit-snippet">
									<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
									<span><i class="fas fa-save"></i> Simpan</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url('assets/js/config-edit.js') ?>"></script>

<script>
	// $(document).ready(function(){
	// 	let first_load = '';
	// 	first_load += '<!-- tulis kode HTML di tab ini -->\n';
	// 	first_load += '<!-- cukup tulis tag HTML yang digunakan dalam tag body -->\n';
	// 	first_load += '<!-- tanpa menulis tag seperti deklarasi doctype head atau meta -->';
	// 	// field.html.session.setValue(first_load);
	// 	$("#html").one("click", function() {
	// 		field.html.setValue("");
	// 	});
	// });

	$(document).ready(function() {
		compilex();
		$('#select-library').select2({
			placeholder: 'pilih resource library'
		});
		$('#select-tag').select2({
			placeholder: 'pilih maksimal 3 tag'
		});
	});

	$('#input-title').on('change',function() {
		$('#title-snippet').text($(this).val());
	});

	$('#select-library').on('change',function(){
		var selected_id = [];
		var selected_name = [];
		var sample = $(this).find('option:selected',this);
		var selected_val = $(this).val();	
		sample.each(function(){
			selected_id.push($(this).data('id'));
			selected_name.push($(this).text());
			$('#input-framework').val(selected_id);
			$('#source-framework').val(selected_val.join('\n'));
			$('#source-name').html(selected_name.join(', '));
			compilex();
		});
		if(sample.length == 0){
			$('#input-framework').val('');
			$('#source-framework').val('');
			$('#source-name').text('tidak ada framework yang dipilih');
			// $('#badge-css').attr('title','');
			// $('#badge-js').attr('title','');	
		}
	});
	$('#checkbox-jquery').on('change',function(){
		var check = $(this).data('id');
		var jVal 	= $(this).val();
		if(this.checked){
			$('#input-jquery').val(check);
			$('#source-jquery').val(jVal);
			$('#jquery-name').text('jQuery library');
			$('#badge-js').html('JS + jQuery');
		} else {
			$('#input-jquery').val('');
			$('#source-jquery').val('');
			$('#jquery-name').text('');
			$('#badge-js').html('Tab JAVASCRIPT');
		}
	});
	$('#input-public').val(0);
	$('#checkbox-public').on('change',function(){
		if(this.checked){
			$('#input-public').val(1);
		} else {
			$('#input-public').val(0);
		}
	});
	$(".content-create .panel-left").resizable({
		handleSelector: ".splitter",
		resizeHeight: false
	});
</script>

<script>

	// var uri_pattern = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/ig;
</script>

