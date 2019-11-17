<?php mainNav() ?>
<div class="hello">
	<div class="container">
		<div class="row hello-fiture">
			<h1>index materi</h1>
			<h1>pilih materi yang akan dipelajarai</h1>
			<br><br>
			<div class="row ex">
		    <div id="coverflow">
		      <ul class="flip-items">
		        <li data-flip-title="Red">
		        	<a href="#lessons" data-request="1" data-value="html">
		          	<img src="<?=base_url('assets/img/feed/html_logo.png')?>">
		          </a>
		          <p class="fred center">HTML</p>
		        </li>
		        <li data-flip-title="Razzmatazz" data-flip-category="Purples">
		          <a href="#lessons" data-request="2" data-value="css">
		          	<img src="<?=base_url('assets/img/feed/css_logo.png')?>">
		        	</a>
		        	<p class="fred center">CSS</p>
		         </li>
		        <li data-flip-title="Deep Lilac" data-flip-category="Purples">
		          <a href="#lessons" data-request="3" data-value="javascript">
		          	<img src="<?=base_url('assets/img/feed/js_logo.png')?>">
		          </a>
		          <p class="fred center">JavaScript</p>
		        </li>
		      </ul>
		    </div>
			</div>
			<br id="lessons">
			<div class="content arrow_box arrow_mid hide">
				<div class="result"></div>
			</div>
		</div>		
	</div>
</div>
<script>
	$('a[href*=\\#]:not([href$=\\#])').click(function(e) {
	  e.preventDefault();
	  $('html, body').animate({
	      scrollTop: $($.attr(this,'href')).offset().top
	  }, 500);
	});	
</script>