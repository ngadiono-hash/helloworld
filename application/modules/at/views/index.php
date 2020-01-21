
<section class="main">
	<header class="main-header">
		<h1 class="welcome text-focus-in">Selamat Datang</h1>
			<h1 class="bounce-in-top">
				<span class="to fred text-focus-in">di</span> 
				<span class="hello-world">Hello World</span>
			</h1>
		<div class="typing" id="typing"></div>
	</header>
</section>
<?php mainNav() ?>
<div class="bg main box-sh"></div>
<article class="introduction">
	<div class="container" style="padding-top: 50px;">
		<h2 id="str2">Apa yang ada di Hello World</h2>
		<div class="intro-inner">
			<div class="row" style="min-height: 80vh;">
				<div class="col-md-4">
					<div class="box box-sh">
						<a href="<?=base_url('lesson')?>"></a>
						<img class="img-thumbnail img-responsive" src="<?= base_url('assets/img/feed/practice.gif') ?>" alt="hello world">
						<h3>Materi Utama</h3>
						<p>Tersedia belajar front-end web mulai dari hal yang paling dasar yaitu HTML, materi CSS, dan JavaScript</p>
					</div>					
				</div>
				<div class="col-md-4">
					<div class="box box-sh">
						<a href="<?=base_url('snippet')?>"></a>
						<img class="img-thumbnail img-responsive" src="<?= base_url('assets/img/feed/live.gif') ?>" alt="hello world">
						<h3>Snippet Program</h3>
						<p>Berbagi source code tentang front-end development di dalam potongan-potongan kode</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="box box-sh">
						<a href="<?=base_url('u')?>"></a>
						<img class="img-thumbnail img-responsive" src="<?= base_url('assets/img/feed/sign.gif') ?>" alt="hello world">
						<h3>Dashboard Member</h3>
						<p>Akses semua aktifitas dan koleksi kode kamu di dalam halaman dashbord Hello World</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</article>

<div class="hello hide">
	<div class="container">
		<h1 id="str2">Apa yang ada di Hello World</h1>
		<div class="row">
			<div class="wrapper-carousel">
				<div id="main-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#main-carousel" data-slide-to="1"></li>
						<li data-target="#main-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="about-live">							
								<div class="desc-inner center">	
									<div class="container">
										
									</div>
								</div>
								<div class="direct-to">
									<a class="effect" href="<?=base_url('lesson')?>"><span>Mulai Belajar</span></a>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="about-practice">
								<div class="desc-inner center">
									<div class="container">
										
									</div>
								</div>
								<div class="direct-to">
									<a class="effect" href="<?=base_url('snippet')?>"><span>Lihat Snippet</span></a>
								</div>
							</div>
						</div>

						<div class="item">
							<div class="about-sign">
								<div class="desc-inner center">
									<div class="container">
										<h2>Daftar Member</h2>
										<p>Daftar dengan menggunakan email aktif dan masuk ke halaman dashboard untuk mengetahui perkembangan belajarmu kemudian praktekkan apa yang sudah kamu ketahui dengan membuat snippet program</p>
									</div>
								</div>
								<div class="direct-to">
									<?php if (!startSession('sess_id')) { ?>
										<a class="effect" href="<?=base_url('at/sign')?>"><span>Daftar</span></a>
									<?php } ?>
								</div>
							</div>
						</div>  
						
					</div>
					<a class="carousel-control left" href="#main-carousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control right" href="#main-carousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>		
			</div>				
		</div>

	</div>
</div>

<main class="main-blockquote hide">
	<div class="container container-blockquote">
		<blockquote class="blockquote">
			<p id="quote">pendidikan ilmu komputer tidak dapat membuat <br>siapapun menjadi ahli pemrograman, <br>maka jangan khawatir kalau hasil kode tidak berjalan baik, <br>jika kode program berjalan dengan baik seketika itu,<br> maka kau akan berhenti untuk berkembang</p> 
			<i class="fas fa-quote-left"></i>
		</blockquote>
	</div>
</main>

<script type="text/javascript">
	$('.introduction .box').on({
		'mouseenter' : function(){
			$(this).children('p').fadeIn().addClass('scale-in-center');
		},
		'mouseleave' : function(){
			$(this).children('p').fadeOut().removeClass('scale-in-center');
		}
	});
	new TypeIt('#typing', {
		speed: 50,
		html: true,
		cursorChar: '',
		waitUntilVisible: true
	})
	.pause(3000)
	.type("<a>Komunitas Belajar FrontEnd Web Indonesia</a>")
	.go();

	new TypeIt('#str1,#str2,#quote', {
		speed: 70,
		cursorChar: '',
		waitUntilVisible: true
	}).go();
</script>