<?php signedNavbar() ?>
<div class="main-side">
	<div class="bg signed box-sh"></div>
	<article class="timeline">
		<div class="">
			<h1><?=greeting(getSession('sess_user'))?></h1>
			<h3>ketahui semua aktifitas terbaru di halaman ini</h3>
		<?php foreach ($record as $r) : ?>
			<?php if ( $r['timeline_cat'] == 2 ) : ?>
				<div class="panel-timeline cubic box-sh">
					<div class="panel-footer">
						<ul class="breadcrumb" style="padding: 0">
							<li>
								<img class="img-footer img-thumbnail" src="<?=base_url('assets/img/profile/'.$r['line_pic'])?>" alt="user image">
								<span class="username">
									<a class="base-link" href="#"><?=$r['line_user']?></a> <span>membuat snippet baru</span>
								</span>
								<span class="time">
									<a><?= time_elapsed_string('@'.$r['timeline_time']) ?></a>
								</span>
							</li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								<h3><?=$r['line_code_title']?></h3>
								<p><?=read_more($r['line_code_desc'],200)?>...</p>
							</div>
							<div class="col-sm-6">
								<div class="snippet-box text-focus-in">
									<a class="open-to-editor" href="<?= base_url('snippet/s/').$r['line_code_id'] ?>"></a>
									<iframe class="frame-views" src="<?= base_url('snippet/p/').$r['line_code_id'] ?>"></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php elseif ( $r['timeline_cat'] == 1 ) : ?>
				<?php if ($r['line_tutor_cat'] == 'html') {
					$classBtn = 'theme-html';
					$icon = 'fa-html5';
				} elseif ($r['line_tutor_cat'] == 'css') {
					$classBtn = 'theme-css';
					$icon = 'fa-css3-alt';
				} else {
					$classBtn = 'theme-js';
					$icon = 'fa-js-square';
				} ?>
				<div class="panel-timeline cubic box-sh">
					<div class="panel-footer">
						<ul class="breadcrumb" style="padding: 0">
							<li>
								<img class="img-footer img-thumbnail" src="<?=base_url('assets/img/profile/'.$r['line_pic'])?>" alt="user image">
								<span class="username">
									<a class="base-link" href="#">Administrator</a> <span>telah menambahkan materi baru</span>
								</span>
								<span class="time">
									<a><?= time_elapsed_string('@'.$r['timeline_time']) ?></a>
								</span>
							</li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6">
								<div class="small-box <?= $classBtn ?>">
									<a class="hidden-link" href="<?=base_url('lesson/').$r['line_tutor_cat'].'/'.$r['line_tutor_meta']?>"></a>
									<div class="inner">
										<h3><?=strtoupper($r['line_tutor_cat'])?></h3>
										<h4 class="fred"><?=$r['line_tutor_level']?></h4>
										<h4><?=$r['line_tutor_title']?></h4>
										<h4><?=$r['line_tutor_slug']?></h4>
									</div>
									<div class="icon">
										<i class="fab <?= $icon ?>"></i>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<p><?=$r['line_tutor_read']?>...
									<a class="base-link" href="<?=base_url('lesson/').$r['line_tutor_cat'].'/'.$r['line_tutor_meta']?>">selengkapnya</a>
								</p>
							</div>								
						</div>
					</div>
				</div>
			<?php	endif; ?>
		<?php	endforeach; ?>
		</div>
	</article>
	<?php mainFooter() ?>
</div>
<?php temp_profile($user) ?>