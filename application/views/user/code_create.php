<!-- <script>$('body').addClass('sidebar-collapse')</script> -->
<style>


</style>

<div class="content-wrapper">
	<section class="content content-create">

		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs">
			  	<li class="center" data-toggle="tooltip" data-placement="top" title="INFO">
			  		<a class="" data-toggle="tab" href="#second">
			  			<i class="fa fa-fw fa-info-circle"></i>
			  		</a>
			  	</li>
			  	<li class="center" data-toggle="tooltip" data-placement="top" title="HTML">
			  		<a class="" data-toggle="tab" href="#third">
			  			<i class="fab fa-fw fa-html5"></i>
			  		</a>
			  	</li>
			  	<li class="center" data-toggle="tooltip" data-placement="top" title="CSS">
			  		<a class="" data-toggle="tab" href="#fourth">
			  			<i class="fab fa-fw fa-css3-alt"></i>
			  		</a>
			  	</li>
			  	<li class="center" data-toggle="tooltip" data-placement="top" title="JAVASCRIPT">
			  		<a class="" data-toggle="tab" href="#fifth">
			  			<i class="fab fa-fw fa-js"></i>
			  		</a>
			  	</li>
			  	<li class="center " data-toggle="tooltip" data-placement="top" title="SELESAI">
			  		<a class="" data-toggle="tab" href="#sixth">
			  			<i class="fas fa-save"></i>
			  		</a>
			  	</li>			  	
				</ul>
				<ul class="nav nav-tabs" style="float: right;">
					<li class="center  run" data-toggle="tooltip" data-placement="top" title="jalankan kode">
			  		<a data-href="" class="" id="run">
							<i class="fa fa-play"></i>
						</a>
			  	</li>
			  	<li class="center " data-toggle="tooltip" data-placement="top" title="jalankan kode otomatis">
			  		<a class="" id="liveEdit">
							<i class="fa fa-sync"></i>
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
							<p class="center"><a class="effect effect-prm" data-toggle="tab" href="#second">
			  				<span>ayo mulai</span>
			  			</a></p>
				  	</div>							
					</div>
					<div id="second" class="tab-pane fade">
				  	<div class="info-snippet">
				  		<div class="alert alert-info alert-dissmisable fade in">
				  			<button class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-info-circle"></i> Info</h4>
					  		<p><i class="far fa-hand-point-right"></i> Tuliskan judul dan deskripsi singkat tentang Snippet yang akan kamu buat.</p>
					  		<p><i class="far fa-hand-point-right"></i> (Optional) Pilih beberapa library untuk digunakan dalam snippet, seperti bootstrap, jquery, dan lainnya.</p>
					  		<p><i class="far fa-hand-point-right"></i> Beberapa framework seperti Bootstrap dan DataTable membutuhkan library jQuery, jadi pastikan jika ingin menggunakannya, klik centang pada library jQuery.</p>
				  		</div>
							<div class="form-group">
								<h4>Judul Snippet <span class="text-danger">*</span></h4>
								<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet">
							</div>
							<hr>
							<div class="form-group">
								<h4>Deskripsi Snippet</h4>
								<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"></textarea>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-12"><h4>Framework</h4></div>
								<div class="col-sm-6">
									<input type="checkbox" data-name="<?=$jQuery[0]['cdn_js']?>" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" value="<?=popu($jQuery[0]['cdn_js'])?>">
									<label for="checkbox-jquery">gunakan library jQuery ?</label><br>
									<input type="hidden" id="input-jquery">
				  				<textarea class="hide" id="source-jquery"></textarea>
				  			</div>							
								<div class="col-sm-6">
									<select class="selectpicker" id="select-cdn-frame" multiple title="pilih framework/library" data-width="100%" data-live-search="true" data-dropup-auto="true" data-selected-text-format="">
										<?php	foreach ($framework as $f) { 
										$xx =	popu($f['cdn_css'])."\n".popu($f['cdn_js']);
										?>
											<option value="<?=$xx?>" data-name1="<?=$f['cdn_css']?>" data-name2="<?=$f['cdn_js']?>" data-id="<?=$f['id']?>" data-subtext="<?=$f['cdn_version']?>"><span><?=$f['cdn_name']?></span></option>
										<?php } ?>
									</select>
				  				<input type="hidden" id="input-framework">
				  				<textarea class="hide" id="source-framework"></textarea>		
								</div>
							</div>
							<hr>
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
				  	<div class="info-snippet">
				  		<div class="row">
					  		<div class="col-sm-12">
					  			<p>Sudah selesai membuat snippetnya ?</p>
					  			<p>Jika masih menemukan error pada program, silahkan cek kembali kode programnya.</p>
					  			<br>
					  			<p>Mari kita review kodemu</p>
					  			<label>Judul Snippet kamu :</label><br>
					  			<div id="title-snippet" class="input-adjust">
					  				belum ada judul yang dimasukkan
					  			</div>
					  			<br>
					  			<label>Framework library yang digunakan : </label> <span class="text-primary" id="jquery-name"></span><br>
							  	<div id="source-name" class="input-adjust">
							  		tidak ada framework atau library yang dipilih
							  	</div>
							  	<br><br>
							  	<p>Jika sudah yakin kodenya benar, silahkan klik centang publik dan klik tombol simpan.</p>
									<input type="checkbox" id="checkbox-public" class="checkin">
									<label for="checkbox-public">tampilkan ke publik ?</label><br>
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

			<div class="splitter"></div>

			<div class="panel-right">
				<iframe class="frame" id="result-frame"></iframe>
			</div>
			
		</div>
	</section>
</div>

<script src="<?= base_url('assets/js/config-edit.js') ?>"></script>

<script>	
	$('.welcome-snippet p a').on('click',function(){
		$('[href="#second"]').parent('li').addClass('active');
	});

	$('#input-title').on('change',function() {
		$('#title-snippet').text($(this).val());
	});
	
	$('#select-cdn-frame').on('change',function(){
		var selected_id = [];
		var selected_name = [];
		var selected_nam1 = [];
		var selected_nam2 = [];
		var sample = $(this).find('option:selected',this);
		var selected_val = $(this).val();	
		sample.each(function(){
			if($(this).data('name1') != '') selected_nam1.push($(this).data('name1'));
			if($(this).data('name2') != '')	selected_nam2.push($(this).data('name2'));
			selected_id.push($(this).data('id'));
			selected_name.push($(this).text());
			$('#input-framework').val(selected_id);
		  $('#source-framework').val(selected_val.join('\n'));
			$('#source-name').html(selected_name.join(', '));
			$('#badge-css').attr('title', selected_nam1.join('\n') );
			$('#badge-js').attr('title', selected_nam2.join('\n') );
		});
		if(sample.length == 0){
			$('#input-framework').val('');
			$('#source-framework').val('');
			$('#source-name').text('tidak ada framework yang dipilih');
			$('#badge-css').attr('title','');
			$('#badge-js').attr('title','');	
		}
	});
	$('#checkbox-jquery').on('change',function(){
		var check = $(this).data('id');
		var jVal 	= $(this).val();
		if(this.checked){
			$('#input-jquery').val(check);
			$('#source-jquery').val(jVal);
			$('#jquery-name').text('jQuery library');
			$('#badge-js').html('jQuery');
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
$(document).ready(function(){
	compilex();
	let first_load = '';
	first_load += '<!-- tulis kode HTML di tab ini -->\n';
	first_load += '<!-- cukup tulis tag HTML yang digunakan dalam tag body -->\n';
	first_load += '<!-- tanpa menulis tag seperti deklarasi doctype head atau meta -->';
	field.html.session.setValue(first_load);
	$("#html").one("click", function() {
    field.html.setValue("");
  });
});
	// var uri_pattern = /\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]))/ig;
</script>

