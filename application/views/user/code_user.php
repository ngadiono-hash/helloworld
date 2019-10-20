
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
		<div class="row">
		<?php foreach ($code as $co) { ?>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 scale-in-center">
				<div class="info-box">
          <p><?= $co['code_title'] ?></p>
          <span class="info-box-icon">
          	<iframe class="frame-view" src="<?= base_url('snippet/p/') . $co['code_id'] ?>"></iframe>
          </span>
          <div class="info-box-content">
            <span><i class="fa fa-fw fa-upload"></i></span>
            <p class="text-muted"><?= date('d M, Y H:i',$co['code_upload']) ?></p>
            <span><i class="fa fa-fw fa-edit"></i></span>
            <p class="text-muted"><?= time_elapsed_string('@'.$co['code_update']) ?></p>
            <span><i class="fa fa-fw fa-eye"></i></span>
            <p class="text-muted"> 2 tampilan</p>
            <span><i class="fas fa-fw fa-thumbs-up"></i></span>
            <p class="text-muted"> 4 orang menyukai<p>
          	<a href="<?= base_url('u/snippet/edit/') . $co['code_id'] ?>" class="link-detail">Edit <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
			<?php } ?>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="create-new" onclick="window.location.href = '<?= base_url('u/snippet/create') ?>'">
					<img src="<?= base_url('assets/img/feed/add.png') ?>">
				</div>			
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
</script>
