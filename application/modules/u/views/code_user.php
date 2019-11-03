
<script>$('body').addClass('sidebar-collapse')</script>
<div class="content-wrapper">
	<section class="content content-snippet-user">
		<?php if (count($code) == 0) { ?>
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="alert alert-info center">
					<h2><i class="icon fa fa-info-circle"></i> info</h4>
					<h4><i class="far fa-hand-point-right"></i> setiap snippet yang telah kamu buat akan ditampilkan di sini untuk bisa kamu edit di kemudian hari</h4>
					<h4><i class="far fa-hand-point-right"></i> administrator berhak sepenuhnya untuk mengontrol kelayakan snippet yang kamu buat untuk tetap ditampilkan ke publik.</h4>
				</div>			
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="not-yet center">
					<img class="img-circle" src="<?= base_url('assets/img/feed/hihi.gif') ?>">
					<h3 class="fred text-muted">sepertinya kamu belum pernah membuat snippet di sini</h3>
					<h3 class="fred text-muted">klik tombol di bawah ini untuk mulai membuatnya</h3>
				</div>
				<div class="create-new" onclick="window.location.href = '<?= base_url('u/snippet/create') ?>'">
					<img src="<?= base_url('assets/img/feed/add.png') ?>">					
				</div>					
		</div>
		<?php } ?>
		
		<?php if (count($code) > 0) { ?>
		<div class="">
			<div class="row">
				<h2 class="text-muted">Snippet kamu di Hello World</h2>
				<hr>
			<?php foreach ($code as $co) { ?>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 scale-in-center">
					<div class="snippet-box">
						<a class="open-to-editor" href="<?= base_url('snippet/s/').$co['code_id'] ?>"></a>
						<iframe class="frame-views" src="<?= base_url('snippet/p/').$co['code_id'] ?>"></iframe>
						<div class="snippet-box-info">
							<div class="author">
								<h4><?= $co['code_title'] ?></h4>
							</div>
							<div class="info-each-snippet">
								<a class="btn btn-sm btn-default"><i class="fa fa-eye"></i> 2</a> 
								<a class="btn btn-sm btn-default"><i class="fa fa-thumbs-up"></i> 4</a>
								<a class="btn btn-sm btn-default"><i class="fa fa-comment-alt"></i> 8</a>
								<a class="btn btn-sm btn-no pull-right" href="<?= base_url('u/snippet/edit/').$co['code_id'] ?>"><i class="fa fa-edit"></i> edit snippet</a>
							</div>  
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php	} ?> 

	</section>
</div>
<script>
	$('.create-new').on({
		'mouseover': function(){
			$(this).addClass('jello-horizontal');
		},
		'mouseleave': function(){
			$(this).removeClass('jello-horizontal');
		}
	});
	$('.snippet-box').on({
		'mouseenter': function(){
			$(this).find('.info-each-snippet').css('visibility','visible');
		},
		'mouseleave': function(){
			$(this).find('.info-each-snippet').css('visibility','hidden');
		}
	});
</script>
