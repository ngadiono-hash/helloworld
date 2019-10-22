
<section class="main">
	<header class="wrapper-header">
		<div class="welcome">
			<h1 class="h-one text-sh text-focus-in">Selamat Datang</h1>
			<h3 class="fred text-sh text-focus-in">di</h3>
			<div class="main-brand">
				<h1 class="h-two bounce-in-top">Hello World</h1>			
			</div>
			<div class="typing" id="typing"></div>
		</div>
	</header>
</section>
<?php mainNav() ?>
<article class="introduction">
	<div class="bg box-sh"></div>
	<div class="container" style="padding: 80px 0;">

		<div class="intro-inner">
			<h2 id="str1">Apa itu Hello World</h2>
			<div class="arrow_box arrow_mid box-sh">
				<img class="img-block img-responsive" src="<?=base_url('assets/img/feed/hello.gif')?>" alt="hello world">
				<p>Istilah Hello World merupakan sebuah program komputer dasar yang ketika dijalankan akan menampilkan pesan <b>Hello World</b> ke layar. Hal tersebut dilakukan untuk mempresentasikan bahwa sebuah komputer diberikan perintah atau instruksi oleh manusia untuk menyapa dengan kata Hello World.</p>
				<p>Seperti pada istilah Hello World yang merupakan program paling sederhana dari program komputer, media website ini memuat konten utama berupa kumpulan tutorial programing dasar yang diambil dari berbagai sumber lain di internet. Semuanya didokumentasikan sedemikian rupa untuk kemudian bisa dipelajari ulang oleh siapapun atau lebih khususnya kepada para programer pemula yang sedang mencari tutorial pembelajaran dalam bahasa Indonesia.</p>
			</div>
			<hr>
		</div>

	</div>
</article>

<div class="hello">
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
										<h2>Materi Utama</h2>
										<p>Kami menyediakan materi pembelajaran website mulai dari hal yang paling dasar yaitu HTML, materi CSS, dan bahasa program yang sangat powerfull berupa JavaScript.</p>
										<p>Semua materi terbuka untuk siapa pun.</p>
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
										<h2>Snippet Program</h2>
										<p>Praktekkan apa yang telah kamu pelajari dengan menulis snippet program untuk bisa diberikan apresiasi oleh para member lainnya.</p>
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

<main class="main-blockquote">
	<div class="container container-blockquote">
		<blockquote class="blockquote">
			<p id="quote">pendidikan ilmu komputer tidak dapat membuat <br>siapapun menjadi ahli pemrograman, <br>maka jangan khawatir kalau hasil kode tidak berjalan baik, <br>jika kode program berjalan dengan baik seketika itu,<br> maka kau akan berhenti untuk berkembang</p> 
			<i class="fas fa-quote-left"></i>
		</blockquote>
	</div>
</main>