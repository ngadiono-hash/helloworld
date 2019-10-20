<style>
	.link-to-view {
		position: absolute;
    text-align: center;
    padding: 5px;
    left: 1px;
    right: 0;
    bottom: 0;
    margin-bottom: 0;
    background: rgba(0,0,0,0.1);
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
				<div class="info-box">
          <span class="info-box-icon">
          	<iframe class="frame-view" src="<?= base_url('snippet/p/').$r['line_code_id'] ?>"></iframe>
          </span>
          <div class="info-box-content">
          	<h3 class="fred center"><?=$r['line_code_title']?></h3>
          	<h4><?=$r['line_code_desc']?></h4>
          	<h4 class="link-to-view">
          		<a class="base-link" href="<?= base_url('snippet/s/').$r['line_code_id'] ?>">Lihat selengkapnya</a>
          	</h4>
          </div>
        </div>

					<ul class="list-inline">
						<li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Lihat</a></li>
						<li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
						<li class="pull-right">
							<a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> komentar
								(5)</a></li>
					</ul>
					<div class="box-footer box-comments">
            <div class="box-comment">
              <img class="img-circle img-sm" src="<?=base_url('assets/img/profile/default.gif')?>" alt="User Image">
              <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted pull-right">8:03 PM Today</span>
                    </span>
                It is a long established fact that a reader will be distracted
                by the readable content of a page when looking at its layout.
              </div>
            </div>
          </div>
					<div class="box-footer">
            <form class="post-comment">
            	<input type="hidden" name="id" value="">
              <img class="img-responsive img-circle img-sm" src="<?=getSession('sess_image')?>" alt="Alt Text">
              <div class="img-push">
                <input type="text" name="comment" class="form-control input-sm" placeholder="Press enter to post comment">
              </div>
            </form>
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