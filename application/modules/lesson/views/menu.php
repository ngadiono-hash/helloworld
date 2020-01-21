<?php
$url = $this->uri->segment(2);
if ($url == 'html') {
	$theme = '#EE8F77';
} elseif ($url == 'css') {
	$theme = '#778FEE';
} else {
	$theme = '#F7D26E';
}
?>
<?php mainNav() ?>
<article class="">
	<div class="bg box-sh" style="background: <?=$theme?>"></div>
	<div class="container-fluid lesson" style="padding: 20px;">
		<h1>Index materi <?=strtoupper($list[0]['category'])?></h1>
		<div class="row" style="margin: 30px -15px;">
			<?php foreach ($list as $k => $v) { ?>
				<div class="col-sm-6 col-md-4">
					<div class="panel <?=$v['theme']?>">
						<a class="hidden-link" href="<?=$v['link']?>"></a>
						<div class="panel-body">
							<h1 class="title"><?=$v['title']?></h1>
							<h4 class="center"><a><?=$v['slug']?></a></h4>
							<p><?=$v['content']?>...</p>
						</div>
						<div class="panel-footer">
							<ul class="breadcrumb" style="padding: 0">
								<li><a><?=strtoupper($v['category'])?></a></li>
								<li><a><?=$v['level']?></a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="center">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</article>