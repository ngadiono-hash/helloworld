<style>
#frame-full {
	position: fixed;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	z-index: 1050;	
}	
.close-frame {
	position: fixed;
	top: 10px;
	right: 15px;
	z-index: 1051;			
}
</style>
<script>$('body').addClass('sidebar-collapse')</script>
<div class="content-wrapper">
	<section class="content content-create">
		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs" id="control-left">
					<li class="center">
						<a class="mini" data-toggle="modal" href="#modal-config-snip"><i class="fa fa-fw fa-cog"></i></a>
					</li>
					<li class="center active">
						<a class="" data-toggle="tab" href="#third" style="min-width: 90px"> HTML</a>
					</li>
					<li class="center">
						<a class="" data-toggle="tab" href="#fourth" style="min-width: 90px">	CSS</a>
					</li>
					<li class="center">
						<a class="" data-toggle="tab" href="#fifth" style="min-width: 90px"> JS</a>
					</li>
				</ul>
				<ul class="nav nav-tabs" id="control-right">
					<li class="center run" data-toggle="tooltip" data-placement="top" title="RUN CODE">
						<a class="mini" id="run"><i class="fa fa-play fa-fw"></i></a>
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="AUTO RUN">
						<a class="mini" id="liveEdit"><i class="fa fa-sync fa-fw"></i></a>
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
		<div class="modal fade" id="modal-config-snip">
			<div class="modal-dialog">
				<div class="modal-content" style="padding: 5px">
					<div class="nav-tab-config">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_one" class="tab-modal tab-info" data-toggle="tab">Info</a></li>
							<li><a href="#tab_two" class="tab-modal" data-toggle="tab">Resource</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_one">
								<div class="info-snippet">
									<div class="col-xs-12">
										<h4 class="fred text-muted">Judul Snippet <span class="text-danger">*</span></h4>
										<input type="text" class="input-adjust" id="input-title" spellcheck="false" placeholder="Masukkan judul Snippet" value="<?=$code['code_title']?>">
									</div>
									<div class="col-xs-12">
										<h4 class="fred text-muted">Deskripsi Snippet</h4>
										<textarea class="input-adjust text-area" id="input-desc" spellcheck="false" placeholder="Masukkan deskripsi tentang Snippet"><?=$code['code_desc']?></textarea>
									</div>
									<div class="col-xs-12">
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
							</div>
							<div class="tab-pane" id="tab_two">
								<div class="info-snippet">
									<div class="col-xs-12">
										<h4 class="fred text-muted">resource library jQuery</h4>
										<input type="checkbox" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" <?= (!empty($cdn_snippet) && $cdn_snippet[0] == 1) ? "checked" : "" ?> value='<?=popu($jQuery[0]['cdn_link'])?>'>
										<label for="checkbox-jquery">library jQuery</label><br>
									</div>
									<div class="col-xs-12">
										<h4 class="fred text-muted">resource library/framework</h4>
										<select class="input-adjust" id="select-library" multiple="multiple" style="width: 100%">
											<?php	foreach ($framework as $f) { ?>
												<option value='<?=popu($f['cdn_link'])?>' data-id='<?=$f['id']?>'
													<?php	for ( $i = 0; $i < count($cdn_snippet) ; $i++ ) {
														echo ($cdn_snippet[$i] == $f['id']) ? "selected" : "" ;
													}
													?>
													><span><?=$f['cdn_name']?></span><span><?=$f['cdn_version']?></span>
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
						<input type="checkbox" id="checkbox-public" class="checkin" <?= ($code['code_publish'] == 1) ? 'checked' : ''; ?>>
						<label for="checkbox-public"> publik </label>
						<a data-href="<?=base_url("xhru/delete_snippet/".$code['code_id'])?>" class="effect" id="delete-snippet">
							<span><i class="fa fa-trash-alt"></i> DELETE</span>
						</a>
						<a data-href="<?=base_url("snippet/p/".$code['code_id'])?>" class="effect" id="btn-full">
							<span><i class="fa fa-arrows-alt"></i> PREVIEW</span>
						</a>
						<a class="effect" id="update-snippet">
							<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
							<span><i class="fas fa-save"></i> UPDATE</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<iframe id="frame-full" style="display: none" src=""></iframe>
<input type="hidden" id="input-id" value="<?=$code['code_id']?>">
<input type="hidden" id="input-tag" value="<?=implode(',',$tag_snippet)?>">
<input type="hidden" id="input-jquery" value="<?=(!empty($cdn_snippet) && $cdn_snippet[0] == 1) ? "1" : "" ?>">
<input type="hidden" id="input-framework" value="<?=implode(',',$frame_id)?>">
<input type="hidden" id="input-public" value="<?= ($code['code_publish'] == 1) ? '1' : '0'; ?>">
<textarea class="hide" id="source-jquery">
	<?=(!empty($cdn_snippet) && $cdn_snippet[0] == 1) ? popu($jQuery[0]['cdn_link']) : ""; ?>
</textarea>
<textarea class="hide" id="source-framework">
	<?php foreach ($framework as $k) {
		for ($i = 0; $i < count($cdn_snippet); $i++){
			echo ($k['id'] == $cdn_snippet[$i]) ? popu($k['cdn_link']) : "" ;
		}
	} ?>
</textarea>

<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>
<script src="<?= base_url('assets/js/config-edito.js') ?>"></script>
<script>
	function dialog_confirm(trigger,back=false){
		$(document).on('click',trigger, function(e){
			e.preventDefault();
			var com = $(this);
			var href = $(this).data('href');
			Swal.fire({
				title : '<h1 class="header-swal danger">H<small>mm...</small></h1>',
				html :
				'<div class="img-swal">' +
				'<div class="text-focus-in"><img src="'+ host +'assets/img/feed/no.gif"></div>' +
				'</div>' +
				'<h3 class="info-swal danger">apa kamu yakin ?</p>',
				type : '',
				showCancelButton : true,
				confirmButtonText: '<span>Ya</span>',
				cancelButtonText: '<span>Tidak</span>',
				buttonsStyling : false,
				customClass: {
					confirmButton: 'effect effect-ok',
					cancelButton: 'effect effect-no'
				}
			}).then((result) => {
				if(result.value){
					$.ajax({
						url : href,
						type : 'POST',
						data : { csrf_token : csrf },
						success : function(data){
							if (data.status == 1) {
								writeResult(data);
								$(com).parents('.row-comment').remove();
								if (back) {
									setTimeout(function(){
										window.history.href = host + '/u/snippet';
									},3000);
								}
							}
						},
						error : function(xhr){ handle_ajax(xhr) }
					});
				}
			});
		});
	}
	$(document).ready(function(){
		dialog_confirm('#delete-snippet',true);
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
		$('#btn-full').on('click',function(){
			preview_frame('#frame-full',$(this).data('href'));
		});
		$(document).on('click','.close-frame',function(){
			$('#frame-full').fadeOut();
			$(this).remove();
		});

	});
	function preview_frame(target,href) {
		$(target).css('display','block').attr('src',''+href+'');
		$(target).after('<button class="close-frame btn btn-default"><i class="fa fa-times"></i></button>');
	}	
</script>