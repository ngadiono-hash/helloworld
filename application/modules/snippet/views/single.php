
	<div class="content content-snippet" data-id="<?=$code['code_id']?>" data-author="<?=$code['id_author']?>">
	<?php mainNav($code) ?>
		<div class="panel-container">
			<div class="panel-left">
				<ul class="nav nav-tabs" id="control-left">
					<li class="dropdown center">
						<a class="dropdown-toggle mini" data-toggle="dropdown" href="#" aria-expanded="false">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a class="" id="liveEdit"><i class="fa fa-fw fa-sync"></i> <span>Auto Run</span></a>
							</li>
							<li>
								<a target="_blank" href="<?=base_url("snippet/p/".$code['code_id'])?>">
									<i class="fa fa-arrows-alt"></i> 
									<span>View Full Screen</span>
								</a>
							</li>
							<li>
								<a >
									<i class="fa fa-align-left"></i> 
									<span>Wrap Editor</span>
								</a>
							</li>
							<?php if (startSession('sess_id') && $code['id_author'] == getSession('sess_id')) { ?>
							<li>
								<a target="_blank" href="<?=base_url("u/snippet/edit/".$code['code_id'])?>">
									<i class="fa fa-edit"></i> 
									<span>Edit</span>
								</a>
							</li>
							<?php } ?>						
						</ul>
					</li>					
					<li class="center active">
						<a class="" data-toggle="tab" href="#third">HTML</a>
					</li>
					<li class="center">
						<a class="" data-toggle="tab" href="#fourth">CSS</a>
					</li>
					<li class="center">
						<a class="" data-toggle="tab" href="#fifth">JS</a>
					</li>
				</ul>
				<ul class="nav nav-tabs pull-right" id="control-right">
					<li class="center" data-toggle="tooltip" data-placement="top" title="BOOKMARK">
						<a id="book-this" class="mini"><i class="fa fa-bookmark"></i></a>
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="LIKE">
						<a id="like-this" class="mini"><i class="fa fa-thumbs-up"></i></a>
					</li>
					<li class="center" data-toggle="tooltip" data-placement="top" title="INFO">
						<a id="open-comment" class="mini"><i class="fa fa-info-circle"></i></a>
					</li>
				</ul>				
				<ul class="nav nav-tabs pull-right">
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

		<div class="side-info scale-in-center hide">
			<div class="side-info-inner">
				<button class="btn btn-default btn-diss"><i class="fa fa-times"></i></button>
				<div class="row row-info">
					<div class="col-sm-12">
						<div class="info-title center fred">
							<?=$code['code_title']?>
						</div>
					</div>
					<div class="col-sm-12 col-md-8">
						<div class="info-desc">
							<p class="fred">deskripsi :</p>
							<p><?=(!empty($code['code_desc'])) ? $code['code_desc'] : 'tidak ada deskripsi yang disematkan' ?></p>
						</div>
						<div class="info-link">
							<p class="fred">dukungan library :</p>
							<?php foreach ($framework as $k) {
								$pieces = explode(',',$k['cdn_link']);
								$singgle = implode(PHP_EOL, $pieces);
								if($k != '') {
									echo '<a class="btn btn-default" title="'.$singgle.'">'.$k['cdn_name'].' '.$k['cdn_version'].'</a> ';
								} else {
									echo "tidak ada (pure JS & pure CSS)";
								}
							} ?>
						</div>
					</div>
					<div class="hidden-xs hidden-sm col-md-4">
						<div class="info-author">
							<h3 class="fred">author</h3>
							<img style="width: 100px; height: 100px;" class="img-circle" src="<?=base_url('assets/img/profile/').$code['image_author']?>">
							<h3 class="fred"><a class="base-link" href="#"><?=$code['user_author'] ?></a></h3>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-xs-2">
						<div class="info-like">
							<i class="fa fa-thumbs-up"></i>
							<p><span class="fred">4</span></p>
						</div>
					</div>
					<div class="col-xs-2">
						<div class="info-comment">
							<i class="fa fa-comment-alt"></i>
							<p><span class="fred"><?=$count_comm?></span></p>
						</div>
					</div>
					<div class="col-xs-8">
						<div class="info-tags">
							<i class="fas fa-tags"></i>
						<?php foreach ($tags_snippet as $k) { ?>
							<a href="#" class="base-link fred">#<?=$k['category_name']?></a>	
						<?php	}	?>
						</div>
					</div>
				</div>
				<div class="clearfix" id="fetch-comment">
					<?php if(!empty($comment)) { ?>	
					<?php foreach ($comment as $k => $v) { ?>
					<div class="row row-comment <?=$v['side']?>" id="<?=$v['created']?>">
						<div class="col-xs-12">
							<span class="action <?=$v['side-text']?>">
								<?php if ( startSession('sess_id') && $v['id_comm'] == getSession('sess_id')) { ?>
								<a class="btn btn-default btn-sm">edit</a>
								<a class="btn btn-default btn-sm delete-comment" data-href="<?=base_url('xhru/delete_comment/').$v['created']?>">hapus</a>
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
								<pre><?=$v['message']?></pre>
							</div>						
						</div>
					</div>
					<?php } ?>
					<div class="center" id="more">
						<button data-id="<?=$v['created']?>" class="btn-default btn">
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
			</div>			
		</div>
	</div>
<textarea class="hide" id="source-jquery"></textarea>
<textarea class="hide" id="source-framework">
<?php foreach ($framework as $k) {
	for ($i = 0; $i < count($fm_snippet); $i++){
		echo ($k['id'] == $fm_snippet[$i]) ? popu($k['cdn_link']) : "" ;  
	}
} ?>
</textarea>
<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>

<script>
	$(".content-snippet .panel-left").resizable({
		handleSelector: ".splitter",
		resizeHeight: false
	});
</script>

<script>
$(document).ready(function(){
	compilex();
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
	if(document.referrer == host + 'u/notification'){
		$('.side-info').fadeIn().removeClass('hide');
		$('.overlay').fadeIn().removeClass('hide');
	}

});
</script>