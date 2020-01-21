<?php mainNav($code) ?>
<?php if ($exist) : ?>
	<div class="single-snippet" data-id="<?=$code['code_id']?>" data-author="<?=$code['id_author']?>">
		<div class="panel-container">
			<div class="panel-left editor">
				<ul class="nav nav-tabs control-left">
					<li class="">
						<a class="mini dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu cubic">
							<li>
								<a class="" id="liveEdit">
									<i class="fa fa-fw fa-sync"></i> <span>Auto Run</span>
								</a>
							</li>
							<li>
								<a target="_blank" href="<?=base_url("snippet/p/".$code['code_id'])?>">
									<i class="fa fa-fw fa-arrows-alt"></i> <span>View Full Screen</span>
								</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-fw fa-align-left"></i> <span>Wrap Editor</span></a>
							</li>
							<?php if ( (startSession('sess_id')) && ($code['id_author'] == getSession('sess_id')) ) { ?>
								<li>
									<a target="_blank" href="<?=base_url("u/snippet/edit/".$code['code_id'])?>">
										<i class="fa fa-fw fa-edit"></i> <span>Edit snippet</span>
									</a>
								</li>
							<?php } ?>
						</ul>
					</li>
						<li>
							<a id="book-this" class="mini"><i class="fa fa-bookmark"></i></a>
						</li>
						<li class="center <?=$like?>">
							<a id="like-this" class="mini"><i class="fa fa-thumbs-up"></i></a>
						</li>
					<?php if(startSession('sess_id') && $code['id_author'] == getSession('sess_id')) { ?>
					<?php } ?>
				</ul>
				<ul class="nav nav-tabs control-right">
					<li class="center active">
						<a class="" data-toggle="tab" href="#third">HTML</a>
					</li>
					<li>
						<a class="" data-toggle="tab" href="#fourth">CSS</a>
					</li>
					<li>
						<a class="" data-toggle="tab" href="#fifth">JS</a>
					</li>
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

		<div id="modal-info-snippet" class="modal modal-info-snippet fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="info-title center box-sh">
						<div class="row">
							<div class="col-xs-11">
								<span class="title"><?=$code['code_title']?></span>
							</div>
							<div class="col-xs-1">
								<button class="pull-right btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i></button>
							</div>
						</div>
					</div>
					<div class="side-info-inner">

						<div class="row row-info">
							<div class="col-sm-12 col-md-8">
								<div class="info-desc">
									<p class="fred">deskripsi :</p>
									<p><?=(!empty($code['code_desc'])) ? $code['code_desc'] : 'tidak ada deskripsi' ?></p>
								</div>
								<div class="info-link">
									<p class="fred">dukungan library :</p>
									<?php foreach ($framework as $k) {
										$pieces = explode(',',$k['cdn_link']);
										$single = implode(PHP_EOL, $pieces);
										if($k != '') {
											echo '<a class="btn btn-default" title="'.$single.'">'.$k['cdn_name'].' '.$k['cdn_version'].'</a> ';
										} else {
											echo "tidak ada (pure JS & pure CSS)";
										}
									} ?>
								</div>
							</div>
							<div class="hidden-xs col-md-4 hidden-sm">
								<div class="info-author">
									<h3 class="fred">author</h3>
									<img style="width: 100px; height: 100px;" class="img-circle" src="<?=base_url('assets/img/profile/').$code['image_author']?>">
									<h3 class="fred"><a class="base-link" href="#"><?=$code['user_author'] ?></a></h3>
								</div>
							</div>
						</div>
						<div class="row row-info">
							<div class="col-sm-8 col-xs-12">
								<div class="info-tags">
									<i class="fas fa-tags"></i>
									<?php foreach ($tags_snippet as $k) { ?>
										<a href="#" class="base-link">#<?=$k['category_name']?></a>
									<?php	}	?>
								</div>
							</div>
							<div class="col-sm-2 hidden-xs">
								<div class="info-like">
									<i class="fa fa-thumbs-up"></i>
									<span class="fred"><?=$code['code_like']?></span>
								</div>
							</div>
							<div class="col-sm-2 hidden-xs">
								<div class="info-comment">
									<i class="fa fa-comment-alt"></i>
									<span class="fred"><?=$count_comm?></span>
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
					<?php if($count_comm > 5) { ?>
						<div class="center" id="more">
							<button data-id="<?=$v['created']?>" class="btn-default btn">
								<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
								<span>tampilkan lebih banyak komentar</span>
							</button>
						</div>
					<?php } ?>
				<?php } else { ?>
					<h1 style="padding: 50px 0">belum ada komentar pada snippet ini</h1>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<?php if (startSession('sess_id')) { ?>
				<div class="box-comment">
					<div class="row">
						<div class="col-xs-8 col-sm-10" style="margin-right: -20px;">
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
</div>

<div style="display: none;">
	<textarea class="hide" id="source-jquery"></textarea>
	<textarea class="hide" id="source-framework">
		<?php foreach ($framework as $k) {
			for ($i = 0; $i < count($fm_snippet); $i++){
				echo ($k['id'] == $fm_snippet[$i]) ? popu($k['cdn_link']) : "" ;
			}
		} ?>
	</textarea>
</div>
</div>
<?php else : ?>
	<article class="container">
		<div class="cubic center" style="width: 500px; margin: auto; background: #fff; padding: 50px;">
			<h1 style="line-height: 1.4">sepertinya snippet ini tidak lagi tersedia</h1>
			<img src="<?=base_url('assets/img/feed/what.gif')?>">
			<h3 style="line-height: 1.2">kemungkinan snippet ini telah dihapus oleh pemiliknya</h3>
			<a onclick="history.back()" class="effect lg"><span>kembali</span></a>
		</div>
	</article>
<?php endif; ?>

<script src="<?= base_url('assets/js/config-ace.js') ?>"></script>
<script>
	$(document).ready(function(){
		compilex();
		$('#fetch-comment').on('mouseenter','.row-comment', function() {
			$(this).find('.action').addClass('open');
		});
		$('#fetch-comment').on('mouseleave','.row-comment', function() {
			$(this).find('.action').removeClass('open');
		});
		dialog_confirm('.delete-comment','apa kamu yakin ?');
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
		$(function(){
			$(".panel-left").resizable({
				handleSelector: ".splitter",
				resizeHeight: false
			});
		});
		$('#comment').on('keyup',function(){
			$('.error').html('');
		});
		if(document.referrer == host + 'u/notification'){

		}
	});
	$(function(){
		$(window).on('unload',function(e) {
			if ($('.content-snippet').data('author') != userData.id) {
				$.ajax({
					url : host + 'xhrm/add_view_snippet',
					type : 'post',
					async : false,
					data : {
						page : $('.content-snippet').data('id'),
						csrf_token : csrf
					},
				}).done();
			}
		});
	});
	$('.single-snippet').on('click','#like-this',function(){
		// if(userData.id != null) {
			var liked = $('#like-this');
			var datax = {
				post : $('.single-snippet').data('id'),
				owner : $('.single-snippet').data('author'),
				csrf_token : csrf
			};
			$.ajax({
				url : host + 'xhru/create_like',
				type : 'POST',
				data : datax,
				success : function(data){
					writeResult(data);
					if (data.status == 1) {
						$(liked).parents('li').addClass('active');
					}
				},
				error : function(xhr) { handle_ajax(xhr) }
			});
		// } else {
			// alertDanger('ok','kamu harus login dulu untuk memberikan jempol');
		// }
	});
	$('.single-snippet').on('click','#book-this',function(){
		if(userData.id != null) {
			var book = $('#book-this');
			var datax = {
				post : $('.single-snippet').data('id'),
				owner : $('.single-snippet').data('author'),
				csrf_token : csrf
			};
			$.ajax({
				url : host + 'xhru/create_book',
				type : 'POST',
				data : datax,
				success : function(data){
					writeResult(data);
					if (data.status == 1) {
						$(book).parents('li').addClass('active');
					}
				},
				error : function(xhr) { handle_ajax(xhr) }
			});
		} else {
			alertDanger('ok','kamu harus login dulu untuk menandai snippet ini');
		}
	});
	$('.modal-info-snippet').on('click','#more button',function(){
		var btn = $('#more button');
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');
		var datax = {
			id : $(this).data('id'),
			page : $('.single-snippet').data('id'),
			csrf_token : csrf
		};
		$.ajax({
			url : host+'xhrm/load_more_comment',
			type :'POST',
			data : datax,
			dataType : 'html',
			success : function(data){
				$('.modal-info-snippet').find('#more').remove();
				$('#fetch-comment').append(data);
			},
			error : function(xhr){ handle_ajax(xhr) },
			complete : function(){
				$(btn).children('img').toggleClass('hide');
				$(btn).children('span').toggleClass('hide');
			}
		});
	});
	$('.submit-comment').on('click',function(){
		var btn = $('.submit-comment');
		var datax = {
			post : $('.content').data('id'),
			owner : $('.content').data('author'),
			comment : $('#comment').val(),
			csrf_token : csrf
		};
		$(btn).children('img').toggleClass('hide');
		$(btn).children('span').toggleClass('hide');
		$.ajax({
			url : host+'xhru/create_comment',
			type : 'POST',
			data : datax,
			success : function(data){
				var arr = data;
				if (arr.status == 1) {
					var i = 0;
					var template = '';
					arr[i] = arr.message[0];
					template += `
					<div class="row row-comment `+arr[i]['side']+`" id="`+arr[i]['created']+`">
						<div class="col-xs-12">
							<span class="action `+arr[i]['side-text']+`">
								<button class="btn btn-default btn-sm">edit</button>
								<button class="btn btn-default btn-sm" data-href="`+host+`xhru/delete_comment/`+arr[i]['created']+`">hapus</button>
							</span>
						</div>
						<div class="col-img `+arr[i]['side-img']+`">
							<img class="img-user-comm img-thumbnail" src="`+host+`assets/img/profile/`+arr[i]['img_comm']+`" alt="User Image">
						</div>
						<div class="col-text `+arr[i]['side-text']+`">
							<div class="direct-chat-text">
								<div class="direct-chat-info">
									<span class="fred"><a href="" class="base-link">`+arr[i]['name_comm']+`</a></span>
									<span class="time-stamp">`+arr[i]['create']+`</span>
								</div>
								<p>`+arr[i]['message']+`</p>
							</div>
						</div>
					</div>`;
					$('#fetch-comment').prepend(template);
					$('#fetch-comment').find('h1').remove();
					$('#comment').val('');
					$('.side-info-inner').animate({
						scrollTop: $('#fetch-comment').offset().top
					}, 'slow');
				} else {
					$('.error').html(arr['message']);
					$('#comment').focus();
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