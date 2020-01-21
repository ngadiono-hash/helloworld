<?php signedNavbar() ?>
<div class="main-side">
	<div class="bg signed box-sh"></div>
	<article class="dashboard">
		<div class="container-fluid" style="overflow-x: hidden;">
			<h1><?=greeting(getSession('sess_user'))?></h1>
			<h3>apa yang ingin kamu lakukan ?</h3>
			<div class="cubic" id="">
				<h1>Snippet kamu di Hello World</h1>
				<ul class="nav nav-tabs">
					<li><a class="fred active" data-toggle="tab" href="#one">Publish</a></li>
					<li><a class="fred" data-toggle="tab" href="#two">Draft</a></li>
					<li><a class="fred" data-toggle="tab" href="#three">Bookmark</a></li>
				</ul>
				<div class="tab-content" style="padding: 10px;">
					<div id="one" class="tab-pane fade in active center">
						<?php if (empty($code)) { ?>
							<div class="empty">
								<img class="" src="<?= base_url('assets/img/feed/search.gif') ?>">
								<h3>sepertinya kamu belum pernah membuat snippet di sini</h3>
							</div>
						<?php } else { ?>
							<div id="flow-publish" style="overflow: hidden;">
								<ul class="flip-items">
									<?php foreach ($code as $co) { ?>
										<li>
											<div class="snippet-box">
												<a class="open-to-editor" href="<?= base_url('snippet/s/').$co['code_id'] ?>"></a>
												<iframe class="frame-views" src="<?= base_url('snippet/p/').$co['code_id'] ?>"></iframe>
												<div class="snippet-box-info">
													<div class="author">
														<h4><?= $co['code_title'] ?></h4>
														<a class="btn btn-sm btn-default btn-block" href="<?= base_url('u/edit/snippet/').$co['code_id'] ?>"><i class="fa fa-edit"></i> edit</a>
													</div>
													<div class="info-each-snippet">
														<a class="btn btn-sm btn-default"><i class="fa fa-eye"></i> <?=$co['code_view']?></a>
														<a class="btn btn-sm btn-default"><i class="fa fa-thumbs-up"></i> <?=$co['code_like']?></a>
														<a class="btn btn-sm btn-default"><i class="fa fa-comment-alt"></i> <?=$co['comment']?></a>
													</div>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<a href="<?=base_url('u/create/snippet')?>" class="effect lg"><span>buat snippet</span></a>
					</div>
					<div id="two" class="tab-pane fade">
						<?php if (empty($draft)) { ?>
							<div class="empty">
								<img class="" src="<?= base_url('assets/img/feed/what.gif') ?>">
								<h3>tidak ada snippet yang disimpan sebagai draft</h3>
							</div>
						<?php } else { ?>
							<div id="flow-draft" style="overflow: hidden;">
								<ul class="flip-items">
									<?php foreach ($draft as $co) { ?>
										<li>
											<div class="snippet-box">
												<a class="open-to-editor" href="<?= base_url('snippet/s/').$co['code_id'] ?>"></a>
												<iframe class="frame-views" src="<?= base_url('snippet/p/').$co['code_id'] ?>"></iframe>
												<div class="snippet-box-info">
													<div class="author">
														<h4><?= $co['code_title'] ?></h4>
														<a class="btn btn-sm btn-default btn-block" href="<?= base_url('u/edit/snippet/').$co['code_id'] ?>"><i class="fa fa-edit"></i> edit</a>
													</div>
													<div class="info-each-snippet">
														<a class="btn btn-sm btn-default"><i class="fa fa-eye"></i> <?=$co['code_view']?></a>
														<a class="btn btn-sm btn-default"><i class="fa fa-thumbs-up"></i> <?=$co['code_like']?></a>
														<a class="btn btn-sm btn-default"><i class="fa fa-comment-alt"></i> <?=$co['comment']?></a>
													</div>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
					</div>
					<div id="three" class="tab-pane fade">
						<?php if (empty($book)) { ?>
							<div class="empty">
								<img class="" src="<?= base_url('assets/img/feed/what.gif') ?>">
								<h3>tidak ada bookmark yang disimpan</h3>
							</div>
						<?php } else { ?>
							<div id="flow-book" style="overflow: hidden;">
								<ul class="flip-items">
									<?php foreach ($book as $co) { ?>
										<li>
											<div class="snippet-box">
												<a class="open-to-editor" href="<?= base_url('snippet/s/').$co['code_id'] ?>"></a>
												<iframe class="frame-views" src="<?= base_url('snippet/p/').$co['code_id'] ?>"></iframe>
												<div class="snippet-box-info">
													<div class="author">
														<h4><?= $co['code_title'] ?></h4>
													</div>
													<div class="info-each-snippet">
													</div>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<hr>
			<div class="cubic" id="">
				<h1>Progress kamu di Hello World</h1>
				<ul class="nav nav-tabs">
					<li class="fred"><a data-toggle="tab" href="#four">Materi</a></li>
					<li><a class="fred" data-toggle="tab" href="#five">Terakhir</a></li>
				</ul>
				<div class="tab-content">
					<div id="four" class="tab-pane fade in active">
						<div id="flow-progress">
							<ul class="flip-items">
								<li>
									<div class="small-box theme-html">
										<a href="<?=base_url('lesson/html')?>" class="hidden-link"></a>
										<div class="inner">
											<h3 class="title">Materi HTML</h3>
											<h3 class="percent"><?= round(floor($html['prog'] * 100 / $html['all'])) ?> %</h3>
											<div class="progress-group">
												<span class="progress-text">
													<b><?= $html['prog'] ?></b> dari <b><?= $html['all'] ?></b> materi
												</span>
												<div class="progress sm">
													<div id="progress-html"></div>
												</div>
											</div>
										</div>
										<div class="icon">
											<i class="fab fa-html5"></i>
										</div>
									</div>
								</li>
								<li>
									<div class="small-box theme-css">
										<a href="<?=base_url('lesson/css')?>" class="hidden-link"></a>
										<div class="inner">
											<h3 class="title">Materi CSS</h3>
											<h3 class="percent"><?= round(floor($css['prog'] * 100 / $css['all'])) ?> %</h3>
											<div class="progress-group">
												<span class="progress-text">
													<b><?= $css['prog'] ?></b> dari <b><?= $css['all'] ?></b> materi
												</span>

												<div class="progress sm">
													<div id="progress-css"></div>
												</div>
											</div>
										</div>
										<div class="icon">
											<i class="fab fa-css3-alt"></i>
										</div>
									</div>
								</li>
								<li>
									<div class="small-box theme-js">
										<a href="<?=base_url('lesson/javascript')?>" class="hidden-link"></a>
										<div class="inner">
											<h3 class="title">Materi JavaScript</h3>
											<h3 class="percent"><?= round(floor($js['prog'] * 100 / $js['all'])) ?> %</h3>
											<div class="progress-group">
												<span class="progress-text">
													<b><?= $js['prog'] ?></b> dari <b><?= $js['all'] ?></b> materi
												</span>
												<div class="progress sm">
													<div id="progress-js"></div>
												</div>
											</div>
										</div>
										<div class="icon">
											<i class="fab fa-js-square"></i>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div id="five" class="tab-pane fade" style="padding: 10px">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>
										<th>Judul</th>
										<th>Slug</th>
										<th>Kelas</th>
										<th>Akses terakhir</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								if(!empty($last)) {
									foreach ($last as $k) { ?>
									<tr>
										<!-- <a href="#" class="hidden-link"></a> -->
										<td><?=$k['snip_title']?></td>
										<td><a href="" class="base-link"><?=$k['snip_slug']?></a></td>
										<td><?=$k['_name']?></td>
										<td><?=time_elapsed_string('@'.$k['timing'])?></td>
									</tr>		
									<?php }
								} else { ?>
									<div class="empty">
										<img class="" src="<?= base_url('assets/img/feed/what.gif') ?>">
										<h3>belum ada track</h3>
									</div>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
	<?php mainFooter() ?>
</div>
<?php temp_profile($user) ?>

<script>
	$("#flow-publish,#flow-draft,#flow-book").flipster({
		style: 'carousel',
		spacing: -0.5,
		scrollwheel: false,
		click: true,
		buttons: true,
	});
	$("#flow-progress").flipster({
		style: 'carousel',
		spacing: -0.3,
		scrollwheel: false,
		click: true,
	});
	$(function() {
		$( "#progress-html" ).progressbar({
			classes: { "ui-progressbar-value": "html-pro" },
			value: <?= $html['prog'] ?>,
			max: <?= $html['all'] ?>
		});
		$( "#progress-css" ).progressbar({
			classes: { "ui-progressbar-value": "css-pro" },
			value: <?= $css['prog'] ?>,
			max: <?= $css['all'] ?>
		});
		$( "#progress-js" ).progressbar({
			classes: { "ui-progressbar-value": "js-pro" },
			value: <?= $js['prog'] ?>,
			max: <?= $js['all'] ?>
		});
	});
	$(function() {
		$('.snippet-box').on({
			'mouseenter': function(){
				$(this).find('.info-each-snippet').css('visibility','visible');
			},
			'mouseleave': function(){
				$(this).find('.info-each-snippet').css('visibility','hidden');
			}
		});
	});
	$(document).ready(function() {
		// $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings){
		// 	return {
		// 		"iStart": oSettings._iDisplayStart,
		// 		"iEnd": oSettings.fnDisplayEnd(),
		// 		"iLength": oSettings._iDisplayLength,
		// 		"iTotal": oSettings.fnRecordsTotal(),
		// 		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		// 		"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
		// 		"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		// 	};
		// };
		// $('#last').dataTable({
		// 	initComplete: function() {
		// 		var api = this.api();
		// 		$('#data-table_filter input')
		// 		.off('.DT')
		// 		.on('input.DT', function() {
		// 			api.search(this.value).draw();
		// 		});
		// 	},
		// 	ajax:
		// 	{
		// 		"url": host + 'u/progress',
		// 		"type": "POST"
		// 	},
		// 	createdRow: function( row, data, dataIndex, cells ) {
		// 		var meta ,order, id, category, title, slug, link;
		// 		meta 	= data['snip_meta'];
		// 		id 		= data['snip_id'];
		// 		title = data['snip_title'];
		// 		slug  = data['snip_slug'];
		// 		category = data['snip_category'];
		// 		$(row).attr('data-id', id);
		// 		var catName;
		// 		if(category == '1'){
		// 			link = host + 'lesson/html/'+ meta;
		// 			catName = 'html';
		// 		} else if (category == '2') {
		// 			link = host + 'lesson/css/'+ meta;
		// 			catName = 'css';
		// 		} else if (category == '3') {
		// 			link = host + 'lesson/javascript/'+ meta;
		// 			catName = 'javascript';
		// 		}
		// 	},
		// 	"lengthMenu": [[10,20,30,50,100,-1], [10,20,30,50,100, "All"]],
		// 	"displayLength": false,
		// 	"lengthChange": false,
		// 	"searching": false,
		// 	"info": false,
		// 	"paginate": true,
		// 	"filter": false,
		// 	"processing": true,
		// 	"serverSide": true,
		// 	oLanguage: {
		// 		sProcessing: '<i class="fa fa-cog fa-spin fa-10x fa-fw"></i>',
		// 	},
		// 	"columnDefs": [
		// 		// no
		// 		{ "targets": 0, "data": null, "orderable": true, "className": "center" },
		// 		// order
		// 		{ "targets": 1,	"data": 'snip_title', "orderable": true},
		// 		// action
		// 		{ "targets": 2, "data": 'snip_slug', "orderable": true, "className": '' },
		// 		],

		// 	rowCallback: function(row, data, iDisplayIndex) {
		// 		var info = this.fnPagingInfo();
		// 		var page = info.iPage;
		// 		var length = info.iLength;
		// 		var index = page * length + (iDisplayIndex + 1);
		// 		$('td:eq(0)', row).html(index);
		// 	}
		// });
	});
</script>
