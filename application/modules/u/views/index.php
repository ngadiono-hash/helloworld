<style>
	.snippet-box.home {
    margin: 0;
    height: 300px;
	}
</style>
<div class="content-wrapper">
	<section class="content content-home">
	<?php temp_profile() ?>
		<?php foreach ($record as $r) { ?>
		<?php if($r['timeline_cat'] == 2 && $r['timeline_time'] > getSession('sess_reg')) { ?>
		<div class="box box-sh">
			<div class="box-body">
				<div class="post">
					<div class="user-block">
						<img class="img-circle img-bordered-sm" src="<?=base_url('assets/img/profile/'.$r['line_pic'])?>" alt="user image">
								<span class="username">
									<a class="base-link" href="#"><?=$r['line_user']?></a>
								</span>
						<span class="description"><?= date('d M, Y H:i',$r['timeline_time']) ?> - <?=time_elapsed_string('@'.$r['timeline_time']) ?></span>
					</div>
					<h3 class="fred"><?=$r['line_user']?> membuat snippet baru</h3>
					<div class="row">
						<div class="col-sm-6">
							<div class="snippet-box home">
								<a class="open-to-editor" href="<?= base_url('snippet/s/').$r['line_code_id'] ?>"></a>
								<iframe class="frame-views" src="<?= base_url('snippet/p/').$r['line_code_id'] ?>"></iframe>
							</div>
						</div>
						<div class="col-sm-6">
							<h3 class="fred text-muted"><?=$r['line_code_title']?></h3>
							<p><?=readMore($r['line_code_desc'],200)?>...
								<a class="base-link" href="<?=base_url('snippet/s/').$r['line_code_id']?>">selengkapnya</a>
							</p>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php	} elseif($r['timeline_cat'] == 1 && $r['timeline_time'] > getSession('sess_reg')) { ?>
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
		<div class="box box-sh">
			<div class="box-body">
				<div class="post">
					<div class="user-block">
						<img class="img-circle img-bordered-sm" src="<?=base_url('assets/img/profile/'.$r['line_pic'])?>" alt="user image">
								<span class="username">
									<a href="#">Administrator</a>
								</span>
						<span class="description"><?= date('d M, Y H:i',$r['timeline_time']) ?> - <?=time_elapsed_string('@'.$r['timeline_time']) ?></span>
					</div>
					<h3 class="fred">tutorial baru telah ditambahkan</h3>
					<div class="row">
						<div class="col-sm-6">
							<div class="small-box <?= $classBtn ?>">
								<div class="inner">
									<h3 class="fred"><?=strtoupper($r['line_tutor_cat'])?></h3>
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
		</div>
		<?php	} ?>
		<?php	} ?>

	</section>
</div>

<script>

</script>