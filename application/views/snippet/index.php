<style type="text/css">
	.snippet-box {
    position: relative;
    height: 350px;
    background: transparent;
    margin-bottom: 50px;
    border-radius: 10px;
    transition: all .4s ease-in-out;
	}
	.snippet-box:hover {
		background: rgba(0, 0, 0, 0.3);
		padding: 20px;
	}
	.frame-views {
		height: 150%;
    width: 200%;
    border-radius: 20px;
    pointer-events: none;
    border: none;
    transform: scale(0.5);
    transform-origin: 0 0;
	}
	.snippet-box-info {
    position: absolute;
    top: 76%;
    left: 0;
    right: 0;
    background: #337ab7ab;
    border-radius: 10px;
    padding: 10px;
	}
	.snippet-box-info .image {
		float: left;
		width: 20%;
		text-align: center;
	}
	.snippet-box-info .author {
		float: right;
		width: 80%;
	}
	.snippet-box-info .author h4 {
		font-family: 'Fredoka One', cursive;
		margin: 5px;
    color: #f1f1f1;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;		
	}
	.snippet-box-info .image img {
		width: 50px;
		height: 50px;
		border-radius: 50%;
	}
	.snippet-box a {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    border: 0 !important;
    z-index: 1;		
	}
</style>

<?php mainNav() ?>
<section class="main" style="overflow-x: hidden;">
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
	</section>
</div>

<script>
$(document).ready(function () {
  $('.frame-views').on('load', function() {
    $(this).contents().find("#user-body").css("overflow", "hidden");
  }); 
});

</script>