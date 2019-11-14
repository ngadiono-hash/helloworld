<?
$keys = getTags($content, 'h3');
// debug($keys);
?>
<style>
.d { padding: 10px !important; }
.content-edit .nav-tabs li {
	min-width: 100px;
}
@media (max-width: 992px){
	.content-edit .nav-tabs li {
		min-width: 50px;
	}
}
.alert-auto {
	position: fixed;
	top: -1px;
	right: 60px;
	z-index: 9999;
	width: 300px;
	text-align: center;
}
.alert-auto h4 {
	margin: 0;
}
.label-created,.label-updated {
	position: absolute;
	bottom: 38px;
	font-size: 0.9em;
	color: #ccc;
	text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
}
.label-created {
	left: 200px;
}
.label-updated {
	left: 400px;
}
.cke_1 .cke_path_item {
	color: rgb(22, 23, 24);
	text-shadow: none;
}
.cke_maximized {
	/*width: 95vw !important;*/
}
.haha {
	margin-left: -25px;
	max-height: 73vh;
	overflow: auto;
}
.haha a {
	margin: 1px auto;
}
</style>
<script>
	$('body').addClass('sidebar-collapse');
	CKEDITOR.dtd.$removeEmpty['i'] = false;
</script>
<div class="content-wrapper">
	<section class="content content-edit">
		<div class="alert alert-success alert-auto hide">
			<h4><i class="fa fa-check"></i> sucessfully updated</h4>
		</div>
		<div class="wrap-table <?= $theme ?>">
			<form id="tutorial-form" action="<?=base_url('xhra/update_tutorial')?>">
				<input type="hidden" id="id" name="id" value="<?= $id ?>">
				<input type="hidden" name="category" value="<?= $cat_name ?>">
				<input type="hidden" name="public" value="<?= $public ?>">

				<ul class="nav nav-tabs">
					<li class="active center">
						<a class="button btn-def" data-toggle="tab" href="#desk">
							<i class="fa fa-book fa-lg"></i>
							<span class="hidden-xs hidden-sm"> Desc</span>
						</a>
					</li>
					<li class="center">
						<a class="button btn-def" data-toggle="tab" href="#info">
							<i class="fa fa-info-circle fa-lg"></i>
							<span class="hidden-xs hidden-sm"> Info</span>
						</a>
					</li>
					<li class="center">
						<a class="button btn-warn action-preview" data-href="<?=base_url('lesson/'.$cat_name.'/'.$meta) ?>">
							<i class="fa fa-eye"></i> 
							<span class="hidden-xs hidden-sm">View</span> 
						</a>
					</li>
					<li class="center">
						<a class="button btn-def" href="<?=base_url('lesson/'.$cat_name.'/'.$meta)?>" target="_blank">
							<i class="fas fa-link"></i> 
							<span class="hidden-xs hidden-sm">Link</span>
						</a>
					</li>
					<li class="center">
						<a class="button btn-pub action-public <?=$btn?>" data-href="<?=base_url('xhra/update_tutorial_public/'. $id)?>"><?= $fa ?></a>
					</li>
					<li class="center">
						<a class="button btn-def" href="<?= $linkPrev ?>">
							<i class="fa fa-arrow-left"></i>
							<span class="hidden-xs hidden-sm">Prev</span>
						</a>
					</li>
					<li class="center">
						<a class="button btn-def" href="<?= $linkNext ?>">
							<span class="hidden-xs hidden-sm">Next</span>
							<i class="fa fa-arrow-right"></i>
						</a>
					</li>
					<li class="center">
						<a class="button btn-def" href="<?=base_url('a/'.$cat_name) ?>">
							<i class="fa fa-reply"></i> 
							<span class="hidden-xs hidden-sm">Back</span>
						</a>
					</li>
					<li class="center">
						<a class="button btn-def btn-del" data-id="<?=$id?>" data-href="<?=base_url('xhra/delete_tutorial/'.$id)?>">
							<i class="fa a-fw fa-trash-alt"></i>
							<span class="hidden-sm hidden-xs">Delete</span>
						</a>
					</li>
				</ul>

				<div class="tab-content">
					<div id="desk" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-10 col-xs-12">
								<textarea id="text-editor" name="desc"><?= htmlentities($content) ?></textarea>
							</div>
							<div class="col-sm-2 hidden-xs">
								<div class="haha">
									<?php
									$keys = getTags($content,'h3');
									foreach ($keys as $k) { ?>
										<a class="btn btn-default"><?=$k?></a>
									<?php	}	?>
								</div>
							</div>
						</div>
						<label class="label-created">Created : <span><?= date('d M, Y H:i',$upload) ?></span></label>
						<label class="label-updated">Last Updated : <span><?= date('d M, Y H:i',$update) ?></span></label>
					</div>
					<div id="info" class="tab-pane fade">
						<div class="row">
							<div class="col-sm-6">
								<label for="title">Title Snippet</label>
								<input type="text" class="input-adjust" id="title" spellcheck="false" name="title" value="<?= $titlex; ?>" placeholder="Edit this Title">
								<label for="slug">Slug Snippet</label>
								<input type="text" class="input-adjust" id="slug" spellcheck="false" name="slug" value="<?= $slug; ?>" placeholder="Edit this Slug">
								<label for="level">Level Snippet</label>
								<input class="input-adjust" id="level" name="level" value="<?= $cat_name; ?>" disabled>
							</div>
						</div>
					</div>
				</div>

				<div class="icon-bar">
					<a class="a btn btn-prm" id="update">
						<span>Update</span> <i class="fa fa-edit"></i>
					</a>
				</div>
			</form>
		</div>
	</section>
</div>
<iframe id="frame-full" style="display: none" src=""></iframe>
<script>CKEDITOR.replace('text-editor')</script>