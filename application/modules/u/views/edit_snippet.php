<?php signedNavbar($code) ?>
<div class="edit-snippet">
	<div class="panel-container">
		<div class="panel-left editor">
			<ul class="nav nav-tabs control-left">
				<li class="active"><a class="" data-toggle="tab" href="#third"> HTML</a></li>
				<li><a class="" data-toggle="tab" href="#fourth">	CSS</a></li>
				<li><a class="" data-toggle="tab" href="#fifth"> JS</a></li>
			</ul>
			<ul class="nav nav-tabs control-right">
				<li class="tip tip-bottom <?= ($code['code_publish'] == 1) ? 'active' : '' ?>" data-placement="bottom" title="privasi tampilan">
					<a class="mini private">
						<i class="fa fa-fw <?= ($code['code_publish'] == 1) ? 'fa-globe-asia' : 'fa-eye-slash' ?>"></i>
					</a>
				</li>
				<li class="run"><a class="mini" id="run"><i class="fa fa-play fa-fw"></i></a></li>
				<li><a class="mini" id="liveEdit"><i class="fa fa-sync fa-fw"></i></a></li>
			</ul>

			<div class="tab-content">
				<div id="third" class="tab-pane fade in active">
					<div class="body-html" id="html"><?= $code['code_html'] ?></div>
				</div>
				<div id="fourth" class="tab-pane fade">
					<div class="body-css" id="css"><?= $code['code_css'] ?></div>
				</div>
				<div id="fifth" class="tab-pane fade">
					<div class="body-js" id="js"><?= $code['code_js'] ?></div>
				</div>

			</div>

		</div>

		<div class="splitter"></div>

		<div class="panel-right">
			<div id="dm"></div>
			<iframe class="frame" id="result-frame"></iframe>
		</div>
	</div>

	<div id="modal-config-snip" class="modal fade modal-config-snip">
		<div class="modal-dialog">
			<div class="modal-content" style="padding: 5px">
				<div class="nav-tab-config editor">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_one" class="tab-modal tab-info" data-toggle="tab">Info</a></li>
						<li><a href="#tab_two" class="tab-modal" data-toggle="tab">Resource</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_one">
							<div class="info-snippet">
								<div class="col-xs-6">
									<h4 class="fred text-muted">Judul Snippet <span class="text-danger">*</span></h4>
									<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet" value="<?=$code['code_title']?>">
								</div>
								<div class="col-xs-6">
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
								<div class="col-xs-12">
									<h4 class="fred text-muted">Deskripsi Snippet</h4>
									<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"><?=$code['code_desc']?></textarea>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_two">
							<div class="info-snippet">
								<div class="col-xs-12">
									<h4 class="fred text-muted">resource library jQuery</h4>
									<input type="checkbox" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" <?= (!empty($cdn_snippet) && $cdn_snippet[0] == 1) ? "checked" : "" ?> value='<?=popu($jQuery[0]['cdn_link'])?>'>
									<label for="checkbox-jquery">jQuery</label><br>
								</div>
								<div class="col-xs-12">
									<h4 class="fred text-muted">resource package library/framework</h4>
									<select class="input-adjust" id="select-library" multiple="multiple" style="width: 100%">
										<?php	foreach ($framework as $f) { ?>
											<option value='<?=popu($f['cdn_link'])?>' data-id='<?=$f['id']?>'
												<?php	for ( $i = 0; $i < count($cdn_snippet) ; $i++ ) {
													echo ($cdn_snippet[$i] == $f['id']) ? "selected" : "" ;
												}
												?>
												><span><?=$f['cdn_name']?></span> <span><?=$f['cdn_version']?></span>
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
								<h4 class="fred text-muted">Judul Snippet :</h4>
								<div id="title-snippet" class="input-adjust"><?=$code['code_title']?></div>
								<h4 class="fred text-muted">Tag Snippet : </h4>
								<div id="tag-name" class="input-adjust">belum ada tag</div>
								<h4 class="fred text-muted">jQuery Library : </h4>
								<div id="jquery-name" class="input-adjust"></div>
								<h4 class="fred text-muted">Framework Library : </h4>
								<div id="source-name" class="input-adjust">tidak ada framework atau library yang dipilih</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<iframe id="frame-full" style="display: none" src=""></iframe>
<input type="hidden" id="input-id" value="<?=$code['code_id']?>">
<input type="hidden" id="input-tag" value="<?=implode(',',$tag_snippet)?>">
<input type="hidden" id="input-jquery" value="<?=(!empty($cdn_snippet) && $cdn_snippet[0] == 1) ? "1" : "" ?>">
<input type="hidden" id="input-framework" value="<?=implode(',',$frame_id)?>">
<input type="hidden" id="input-public" value="<?= ($code['code_publish'] == 1) ? 1 : 0 ?>">
<textarea class="hide" id="source-jquery">
	<?=(!empty($cdn_snippet) && $cdn_snippet[0] == 1) ? popu($jQuery[0]['cdn_link']) : "" ?>
</textarea>
<textarea class="hide" id="source-framework">
	<?php foreach ($framework as $k) {
		for ($i = 0; $i < count($cdn_snippet); $i++){
			echo ($k['id'] == $cdn_snippet[$i]) ? popu($k['cdn_link']) : "" ;
		}
	} ?>
</textarea>

<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>
<script src="<?= base_url('assets/js/config-editor.js') ?>"></script>
<script>
	$(document).ready(function(){
		dialog_confirm('#delete-snippet','apa kamu yakin akan menghapus snippet ini ?',true);

		$('.private').on('click',function(){
			$(this).parent('li').toggleClass('active');
			$(this).children('i').toggleClass('fa-eye-slash fa-globe-asia');
			if($(this).parent('li').hasClass('active')) {
				$('#input-public').val(1);
			} else {
				$('#input-public').val(0);
			}
		});
		$('#btn-full').on('click',function(){
			preview_frame('#frame-full',$(this).data('href'));
		});
		$('#submit-snippet').on('click', function(){
			var btn = $('#submit-snippet');
			$(btn).children('img').toggleClass('hide');
			$(btn).children('span').toggleClass('hide');
			var datax = {
				id: $('#input-id').val(),
				title: $('#input-title').val(),
				tag : $('#input-tag').val(),
				jquery : $('#input-jquery').val(),
				framework : $('#input-framework').val(),
				html: field.html.session.getValue(),
				css: field.css.session.getValue(),
				js: field.js.session.getValue(),
				description : $('#input-desc').val(),
				public : $('#input-public').val(),
				csrf_token : csrf
			};
			$.ajax({
				url : host + 'xhru/update_snip',
				type : 'post',
				dataType: 'json',
				data : datax,
				success : function(data){
					writeResult(data);
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
	});
</script>