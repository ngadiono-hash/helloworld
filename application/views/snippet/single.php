<?php ace() ?>

<style>
	.col-img {
		width: 15%;
	}
	.col-text {
		width: 85%;
	}
</style>

	<div class="content content-snippet" data-id="<?=$code['code_id']?>" data-author="<?=$code['id_author'] ?>">
	<?php mainNav($code) ?>
		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs">
					<li class="center">
						<a class="" data-toggle="tab" href="#third">HTML</a>
					</li>
					<li class="center">
						<a class="" data-toggle="tab" href="#fourth">CSS</a>
					</li>
					<li class="center">
						<a class="" data-toggle="tab" href="#fifth">JS</a>
					</li>
				</ul>
				<ul class="nav nav-tabs pull-right">
					<li class="center run" data-toggle="tooltip" data-placement="top" title="RUN">
						<a id="run" class="mini">
							<i class="fa fa-play"></i>
						</a>
					</li>
					
					<li class="dropdown center">
						<a class="dropdown-toggle mini" data-toggle="dropdown" href="#" aria-expanded="false">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a target="_blank" href="<?=base_url("snippet/p/".$code['code_id'])?>">
									<i class="fa fa-arrows-alt"></i> 
									<span>View Fullscreen</span>
								</a>
							</li>
							<li role="presentation" class="divider"></li>
							<li>
								<a target="_blank" href="<?=base_url("snippet/p/".$code['code_id'])?>">
									<i class="fa fa-comment-alt"></i> 
									<span>Wrap Editor</span>
								</a>
							</li>
						</ul>
					</li>			  	
				</ul>				
				<ul class="nav nav-tabs" style="float: right;">
				</ul>
				<div class="tab-content">
					
					<div id="second" class="tab-pane fade">

					</div>
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
				<iframe class="frame" id="result-frame"></iframe>
			</div>
		</div>

		<div class="side-info scale-in-center hide">
			<div class="side-info-inner">
				<button class="btn btn-default btn-diss"><i class="fa fa-times"></i></button>
				<h2 style=""><?=$code['code_title']?></h2>
				<div class="row row-info">
					<div class="col-sm-12 col-md-8">
						<div class="info-desc">
							<p><?=$code['code_desc']?></p>
						</div>
						<div class="info-link">
							<p>Snippet ini menggunakan :</p>
							<p>bootstrap v 3.32</p>
						</div>
					</div>
					<div class="hidden-xs hidden-sm col-md-4">
						<div class="info-author">
							<h3>author</h3>
							<img style="width: 100px" class="img-circle" src="<?=base_url('assets/img/profile/').$code['image_author']?>">
							<h3 class="fred"><a class="base-link" href="#"><?=$code['user_author'] ?></a></h3>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="info-like">
							<span><i class="fa fa-thumbs-up"></i></span>
							<p>4 orang menyukai snippet ini</p>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="info-comment">
							<span><i class="fa fa-comment-alt"></i></span>
							<p><?=$count_comm?> komentar pada snippet ini</p>
						</div>
					</div>
				</div>
				<div class="clearfix" id="fetch-comment">
					<?php if(!empty($comment)) { ?>	
					<?php foreach ($comment as $k => $v) { ?>
					<div class="row row-comment <?=$v['side']?>" id="<?=$v['id']?>">
						<div class="col-xs-12">
							<span class="action <?=$v['side-text']?>">
								<?php if ( startSession('sess_id') && $v['id_comm'] == getSession('sess_id')) { ?>
								<button class="btn btn-default btn-sm">edit</button>
								<button class="btn btn-default btn-sm">hapus</button>
								<?php } ?>
							</span>							
						</div>
						<div class="col-img <?=$v['side-img']?>">
							<img class="img-user-comm img-thumbnail" src="<?=base_url('assets/img/profile/').$v['img_comm']?>" alt="User Image">
						</div>
						<div class="col-text <?=$v['side-text']?>">
							<div class="direct-chat-text">
								<div class="direct-chat-info">
									<span class="fred"><a href="" class="base-link"><?=$v['name_comm']?></a></span>
									<span class="time-stamp"><?=$v['create']?></span>
								</div>
								<p><?=$v['message']?></p>
							</div>						
						</div>
					</div>
					<?php } ?>
					<div class="center" id="more">
						<button data-id="<?=$v['id']?>" class="btn-default btn">
							<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
							<span>tampilkan lebih banyak komentar</span>
						</button>
					</div>
					<?php } else { ?>
						<h1 style="padding: 100px 0">belum ada komentar pada snippet ini</h1>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				<?php if (startSession('sess_id')) { ?>
				<div class="box-comment">
					<div class="row">
						<div class="col-xs-8 col-sm-10">
							<div class="error"></div>
							<textarea id="comment" class="input-adjust text-area" placeholder="Tulis komentar di sini" spellcheck="false"></textarea>
						</div>
						<div class="col-xs-4 col-sm-2">
							<button class="submit-comment btn-default">
								<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
								<span>POST</span>
							</button>
						</div>
					</div>
				</div>				
				<?php } else { ?>
				<h4 class="center fred">silahkan login untuk memberikan komentar</h4>
				<h3 class="center fred"><a class="effect effect-prm" href="<?=base_url('at/sign')?>"><span>login</span></a></h3>
				<?php } ?>

				<div class="row hide">
					<div class="col-sm-12"><h4>Framework</h4></div>
					<div class="col-sm-6">
						<input type="checkbox" data-name="jQuery library" data-id="<?=$jQuery[0]['id']?>" id="checkbox-jquery" class="checkin" value="<?=popu($jQuery[0]['cdn_js'])?>"
						<?= ($jq_snippet == 1) ? "checked" : "" ?>
						 >
						<label for="checkbox-jquery">jQuery</label><br>
						<input type="hidden" id="input-jquery" value="<?=$jq_snippet?>">
						<textarea class="hide" id="source-jquery"><?= ($jq_snippet == 1) ? popu($jQuery[0]['cdn_js']) : "";  ?></textarea>
						<textarea class="hide" id="source-framework">
							<?php foreach ($framework as $k) {
								for ($i=0;$i<count($fm_snippet);$i++){
									echo ($k['id'] == $fm_snippet[$i]) ? popu($k['cdn_css'])."\n".popu($k['cdn_js']) : "" ;  
								}
							} ?>
						</textarea>		
					</div>							
					<div class="col-sm-6">
					</div>
				</div>
			</div>			
		</div>
	</div>


<script src="<?= base_url('assets/js/config-edit.js') ?>"></script>

<script>

	$(".content-snippet .panel-left").resizable({
		handleSelector: ".splitter",
		resizeHeight: false
	});

</script>

<script>
$(document).ready(function(){
	compilex();
	$('#open-comment').on('click',function(){
		$(this).addClass('active');
		$('.side-info').fadeIn().removeClass('hide');
		$('.overlay').removeClass('hide').fadeIn();
	});
	$('.btn-diss').on('click',function(){
		$('#open-comment').removeClass('active');
		$('.overlay').fadeOut();
		$('.side-info').fadeOut();
	});
	$('#comment').on('keyup',function(){
		$('.error').html('');
	});
	if(document.referrer == host + 'u'){
		$('.side-info').fadeIn().removeClass('hide');
		$('.overlay').fadeIn().removeClass('hide');
	}

});
</script>