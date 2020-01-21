<?php loader() ?>
<div class="overlay hide"></div>
<div class="ajax-send hide"></div>
<div id="result"></div>
<script src="<?=base_url('assets/prism-line.js')?>"></script>

<?php if (!whats_page(2,['reset','sign','change','s']) && !whats_page(1,['u']) && !(whats_page(1,['lesson']) && !empty($this->uri->segment(3))) ) mainFooter(); ?>

<script id="main_script">
	$(document).ready(function(){
		$(window).resize(function(){
			widthClass();
		});
		widthClass();
		loading();
		sideActive('.main-navbar a, .drop a, .lesson-menu a');
		$('input,textarea').attr('spellcheck',false);
		$('.frame-views').on('load', function() {
			$(this).contents().find("#user-body").css("overflow", "hidden");
		});
		$('#btn-nav').on('click',function(){
			$(this).addClass('active');
			$('.drop,.overlay').removeClass('hide');
			$('.overlay').fadeIn();
		});
		$('.overlay').on('click',function() {
			$('#btn-nav').removeClass('active');
			$(this).fadeOut();
			$('.drop').addClass('hide');
		});
	}); // document.ready
</script>
<script>
	dialog_confirm('#btn-logout','apa kamu yakin ingin logout ?',true);
</script>
</body>
</html>