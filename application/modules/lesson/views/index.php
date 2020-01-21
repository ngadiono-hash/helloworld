<?php mainNav() ?>
<article class="lesson">
	<h1>silahkan pilih materi</h1>
	<div class="container" style="padding: 20px;">
		<div class="choose">
			<div id="flow-index-materi">
				<ul class="flip-items">
					<li>
						<a href="<?=base_url('lesson/html')?>" class="hidden-link"></a>
						<img src="<?=base_url('assets/img/feed/html_logo.png')?>">
						<p>HTML</p>
					</li>
					<li>
						<a href="<?=base_url('lesson/css')?>" class="hidden-link"></a>
						<img src="<?=base_url('assets/img/feed/css_logo.png')?>">
						<p>CSS</p>
					</li>
					<li>
						<a href="<?=base_url('lesson/javascript')?>" class="hidden-link"></a>
						<img src="<?=base_url('assets/img/feed/js_logo.png')?>">
						<p>JavaScript</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<h1>atau silahkan ketik di pencarian</h1>
	<div class="container">	
		<div class="search-box">
		  <div class="search_bar">
		    <input class="search_input" type="text" placeholder="Cari..." spellcheck="false">
		    <a href="#break" class="search_icon"><i class="fas fa-search"></i></a>
		  </div>
		</div>
		<br id="break">
		<div class="result"></div>
	</div>
</article>
<script>
	$("#flow-index-materi").flipster({
		style: 'carousel',
		spacing: -0.3,
		scrollwheel: false,
		click: true
	});

	// $('a[href*=\\#]:not([href$=\\#])').click(function(e) {
	//   e.preventDefault();
	//   $('html, body').animate({ scrollTop: $($.attr(this,'href')).offset().top }, 500);
	// });

	$('.search_bar').on('keypress',function(e) {
		if (e.which == 13) {	
			searching_tutorial();
		}
	});
	$('.search_bar').on('click','a',function(){
		searching_tutorial();
	});
</script>