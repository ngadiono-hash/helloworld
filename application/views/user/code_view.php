
<div class="content-wrapper">
	<section class="content content-create">

		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs">
			  	<li class="center active" data-toggle="tooltip" data-placement="top" title="INFO">
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
				</ul>
				<ul class="nav nav-tabs" style="float: right;">
					<li class="center <?= ($code['code_publish'] == 1) ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="top" title="PUBLIC">
						<a data-value="" id="btn-public">
							<i class="fa fa-globe-asia"></i>
						</a>
						<input type="hidden" id="input-public" value="<?= ($code['code_publish'] == 1) ? 1 : 0; ?>">
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="HAPUS">
						<a data-href="<?=base_url("snippet/xhr_delete/".$code['code_id'])?>">
							<i class="fa fa-trash-alt"></i>
						</a>
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="PREVIEW">
						<a target="_blank" href="<?=base_url("snippet/p/".$code['code_id'])?>">
							<i class="fa fa-arrows-alt"></i>
						</a>
					</li>
					<li class="center" id="update-snippet" data-toggle="tooltip" data-placement="top" title="UPDATE">
			  		<a><i class="fas fa-save"></i></a>
			  	</li>
					<li class="center run" data-toggle="tooltip" data-placement="top" title="jalankan kode">
			  		<a id="run">
							<i class="fa fa-play"></i>
						</a>
			  	</li>
			  	<li class="center" data-toggle="tooltip" data-placement="top" title="jalankan kode otomatis">
			  		<a class="" id="liveEdit">
							<i class="fa fa-sync"></i>
						</a>
			  	</li>
				</ul>
				<div class="tab-content">
					
					<div id="second" class="tab-pane fade in active">
				  	<div class="info-snippet">
				  		<input type="hidden" id="input-id" value="<?=$code['code_id']?>">
							<div class="form-group">
								<h4>Judul Snippet <span class="text-danger">*</span></h4>
								<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet" value="<?=$code['code_title']?>">
							</div>
							<hr>
							<div class="form-group">
								<h4>Deskripsi Snippet</h4>
								<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"><?=$code['code_desc']?></textarea>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-12"><h4>Framework</h4></div>
								<div class="col-sm-6">
									<input type="checkbox" data-name="jQuery library" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" value="<?=popu($jQuery[0]['cdn_js'])?>"
									<?= ($jq_snippet == 1) ? "checked" : "" ?>
									 >
									<label for="checkbox-jquery">jQuery</label><br>
									<input type="hidden" id="input-jquery" value="<?=$jq_snippet?>">
				  				<textarea class="hide" id="source-jquery">
				  					<?= ($jq_snippet == 1) ? popu($jQuery[0]['cdn_js']) : "";  ?>
				  				</textarea>
				  			</div>							
								<div class="col-sm-6">
									<select class="selectpicker" id="select-cdn-frame" multiple title="pilih framework/library" data-width="100%" data-live-search="true" data-dropup-auto="true" data-selected-text-format="">
										<?php	foreach ($framework as $f) { 
										$xx =	popu($f['cdn_css'])."\n".popu($f['cdn_js']);
										?>
											<option value="<?=$xx?>" data-name1="<?=$f['cdn_css']?>" data-name2="<?=$f['cdn_js']?>" data-id="<?=$f['id']?>" data-subtext="<?=$f['cdn_version']?>" 
												<?php for ($i=0;$i<count($fm_snippet);$i++){
													echo ($f['id'] == $fm_snippet[$i]) ? "selected" : "" ;  
													}
													?>
												><span><?=$f['cdn_name']?></span></option>
										<?php } ?>
									</select>
				  				<input type="hidden" id="input-framework" value="<?=implode(',',$fm_snippet)?>">
				  				<textarea class="hide" id="source-framework">
				  					<?php foreach ($framework as $k) {
				  						for ($i=0;$i<count($fm_snippet);$i++){
												echo ($k['id'] == $fm_snippet[$i]) ? popu($k['cdn_css'])."\n".popu($k['cdn_js']) : "" ;  
											}
				  					} ?>
				  				</textarea>		
								</div>
							</div>
							<hr>
				  	</div>
				  </div>
				  <div id="third" class="tab-pane fade">
				  	<div class="box-body body-html" id="html"><?= $code['code_html'] ?></div>
				  </div>
				  <div id="fourth" class="tab-pane fade">
			    	<div class="box-body body-css" id="css"><?= $code['code_css'] ?></div>
				  </div>
				  <div id="fifth" class="tab-pane fade">
				  	<div class="box-body body-js" id="js"><?= $code['code_js'] ?></div>
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
	$('#btn-public').on('click',function(){
		var par = $(this).parent('li');
		var val = $(this).data('value');
		par.toggleClass('active');
		if(par.hasClass('active')){
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
});
</script>

