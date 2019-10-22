<section class="main" id="sub-page">
	<header class="wrapper-header">
		<div class="welcome text-focus-in">
			<h1 class="h-one text-sh">Snippet Program</h1>
			<div class="container fred">
				<h3>Snippet program dari para member Hello World terkumpul di sini.</h3>
				<h3>Kamu bisa membuat snippet kode program berdasarkan pengetahuan tentang kode programming seputar HTML, CSS dan JavaScript.</h3>
				<h3>Kembangkan kreatifitasmu dalam membuat kode program untuk bisa memberi manfaat bagi para pengunjung lainnya.</h3>
			</div>
		</div>
	</header>
</section>
<?php mainNav() ?>
<div class="hello" style="overflow-x: hidden;">
	<div class="container">
		<div class="">
		<?php foreach ($code as $co) { ?>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 scale-in-center">
				<div class="snippet-box">
					<a class="open-to-editor" href="<?= base_url('snippet/s/').$co['code_id'] ?>"></a>
          <iframe class="frame-views" src="<?= base_url('snippet/p/').$co['code_id'] ?>"></iframe>
	        <div class="snippet-box-info">
	        	<div class="image">
	        		<img src="<?= base_url('assets/img/profile/').$co['image_author'] ?>">
	        	</div>
	        	<div class="author">
	        		<h4><?= $co['code_title'] ?></h4>
	        		<h4><?= $co['user_author'] ?></h4>
	        	</div>
	        	<div class="clearfix"></div>
	        </div>  
        </div>
      </div>
			<?php } ?>
		</div>
	</div>
</div>

<script>
$(document).ready(function () {
  $('.frame-views').on('load', function() {
    $(this).contents().find("#user-body").css("overflow", "hidden");
  }); 
});

</script>