
<script>$('body').addClass('sidebar-collapse')</script>
<div class="content-wrapper">
	<section class="content content-create">		
		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs" id="control-left">
			  	<li class="center active">
			  		<a class="" data-toggle="tab" href="#third" style="min-width: 90px">
			  			<!-- <i class="fab fa-fw fa-html5"></i> -->
			  			HTML
			  		</a>
			  	</li>
			  	<li class="center">
			  		<a class="" data-toggle="tab" href="#fourth" style="min-width: 90px">
			  			<!-- <i class="fab fa-fw fa-css3-alt"></i> -->
			  			CSS
			  		</a>
			  	</li>
			  	<li class="center">
			  		<a class="" data-toggle="tab" href="#fifth" style="min-width: 90px">
			  			<!-- <i class="fab fa-fw fa-js"></i> -->
			  			JS
			  		</a>
			  	</li>
				</ul>
				<ul class="nav nav-tabs pull-right" id="control-right">
					<li class="center">
						<a class="" data-toggle="modal" href="#modal-config-snip">
							<i class="fa fa-fw fa-cog"></i>
						</a>
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="DELETE">
						<a data-href="<?=base_url("snippet/xhr_delete/".$code['code_id'])?>">
							<i class="fa fa-trash-alt"></i>
						</a>
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="PREVIEW">
						<a target="_blank" href="<?=base_url("snippet/p/".$code['code_id'])?>">
							<i class="fa fa-arrows-alt"></i>
						</a>
					</li>
					<li class="center run" data-toggle="tooltip" data-placement="top" title="RUN CODE">
			  		<a id="run">
							<i class="fa fa-play"></i>
						</a>
			  	</li>
			  	<li class="center" data-toggle="tooltip" data-placement="top" title="AUTO RUN">
			  		<a class="" id="liveEdit">
							<i class="fa fa-sync"></i>
						</a>
			  	</li>
				</ul>
				<div class="tab-content">
					
				  <div id="third" class="tab-pane fade in active">
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
				<div id="dm"></div>
				<iframe class="frame" id="result-frame"></iframe>
			</div>
			
		</div>
	</section>
</div>
<input type="hidden" id="input-id" value="<?=$code['code_id']?>">
<input type="hidden" id="input-tag" value="<?=implode(',',$tag_snippet)?>">
<input type="hidden" id="input-jquery" value="<?= ($fm_snippet[0] == 1) ? "1" : "" ?>">
<input type="hidden" id="input-framework" value="<?=implode(',',$fm_snippet)?>">
<input type="hidden" id="input-public" value="<?= ($code['code_publish'] == 1) ? '1' : '0'; ?>">
<textarea class="hide" id="source-jquery"><?= ($fm_snippet[0] == 1) ? popu($jQuery[0]['cdn_link']) : ""; ?></textarea>
<textarea class="hide" id="source-framework">
<?php foreach ($framework as $k) {
	for ($i = 0; $i < count($fm_snippet); $i++){
		echo ($k['id'] == $fm_snippet[$i]) ? popu($k['cdn_link']) : "" ;  
	}
} ?>
</textarea>
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
							<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet" value="<?=$code['code_title']?>">
						</div>
						<div class="form-group">
							<h4 class="fred text-muted">Deskripsi Snippet</h4>
							<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"><?=$code['code_desc']?></textarea>
						</div>
						<div class="form-group">
							<h4 class="fred text-muted">Tag Snippet</h4>
							<select id="select-tag" multiple="multiple" style="width: 100%">
							<?php	foreach ($tag as $t) { ?>
								<option value='<?=$t['category_id']?>'
								<?php	for ( $i = 0; $i < count($tag_snippet) ; $i++ ) {
									echo ($tag_snippet[$i] == $t['category_id']) ? "selected" : "" ;
								}
								?>
								><span><?=$t['category_name']?></span>
								</option>
							<?php } ?>
							</select>
						</div>
					</div>
					<div class="tab-pane" id="tab_two">
						<div class="row">
							<div class="col-sm-12">
								<h4 class="fred text-muted">resource library jQuery</h4>
								<input type="checkbox" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" <?= ($fm_snippet[0] == 1) ? "checked" : "" ?> value='<?=popu($jQuery[0]['cdn_link'])?>'>
								<label for="checkbox-jquery">library jQuery</label><br>
							</div>							
							<div class="col-sm-12">
								<h4 class="fred text-muted">resource library/framework</h4>
								<select class="input-adjust" id="select-library" multiple="multiple" style="width: 100%">
								<?php	foreach ($framework as $f) { ?>
									<option value='<?=popu($f['cdn_link'])?>' data-id='<?=$f['id']?>'
									<?php	for ( $i = 0; $i < count($fm_snippet) ; $i++ ) {
											echo ($fm_snippet[$i] == $f['id']) ? "selected" : "" ;
										}
									?>
									><span><?=$f['cdn_name']?></span><span><?=$f['cdn_version']?></span>
									</option>
								<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab_three">
						<div class="info-snippet">
							<h4 class="fred text-muted">Judul Snippet :</h4>
							<div id="title-snippet" class="input-adjust"><?=$code['code_title']?></div>
							<h4 class="fred text-muted">Tag Snippet : </h4>
							<div id="tag-name" class="input-adjust">belum ada tag</div>							
							<h4 class="fred text-muted">jQuery Library : </h4>
							<div id="jquery-name" class="input-adjust"></div>
							<h4 class="fred text-muted">Framework Library : </h4>
							<div id="source-name" class="input-adjust">tidak ada framework atau library yang dipilih</div>
							<br>
							<input type="checkbox" id="checkbox-public" class="checkin" <?= ($code['code_publish'] == 1) ? 'checked' : ''; ?>>
							<label for="checkbox-public">tampilkan snippet ini ke publik ?</label><br>
							<a style="position: absolute; top: 1px; right: 2px;" data-href="<?= base_url('snippet/xhr_create') ?>" class="effect" id="update-snippet">
								<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
								<span><i class="fas fa-save"></i> UPDATE</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>
<script src="<?= base_url('assets/js/config-edito.js') ?>"></script>
<script>
	
$(document).ready(function() {
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
	var tagSelect = [];
	var taged = $('#select-tag').find('option:selected',this);
	taged.each(function() {
		tagSelect.push('<a class="btn btn-sm btn-prm">'+ $(this).text() +'</a>');
		$('#tag-name').html(tagSelect.join(' - '));		
	});
	var frameSelect = [];
	var framed = $('#select-library').find('option:selected',this);
	framed.each(function() {
		frameSelect.push('<a class="btn btn-sm btn-prm" title="'+$(this).val().match(uri_pattern).join('\n')+'">'+ $(this).text() +'</a>');
		$('#source-name').html(frameSelect.join(' - '));
	});
	if ($('#checkbox-jquery').attr('checked') == "checked") {
		var jQueryCheck	= $('#checkbox-jquery').val();
		$('#jquery-name').html('<a class="btn btn-sm btn-prm" title="'+jQueryCheck.match(uri_pattern).join('\n')+'">jQuery</a>');
	} else {
		$('#jquery-name').html('jQuery non-aktif');
	}
});
</script>