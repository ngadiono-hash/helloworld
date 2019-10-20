
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
				<p>Definisi program sendiri adalah urutan instruksi terstruktur yang dirancang agar komputer dapat berperilaku sesuai dengan ketentuan dengan tujuan untuk menyelesaikan permasalahan.</p>
				<p>Seperti pada istilah Hello World yang merupakan program paling sederhana dari program komputer, media website ini memuat konten utama berupa kumpulan tutorial programing dasar yang diambil dari berbagai sumber lain di internet. Semuanya didokumentasikan sedemikian rupa untuk kemudian bisa dipelajari ulang oleh siapapun atau lebih khususnya kepada para programer pemula yang sedang mencari tutorial pembelajaran dalam bahasa Indonesia.</p>
			</div>
			<hr>
		</div>

	</div>
</article>

<div class="hello">
	<div class="container">
		<h1 id="str5">Apa yang ada di Hello World ?</h1>
		<br><br>
		<div class="row hello-fiture" id="lesson">
			<h2>Materi Utama</h2>
				<p class="fiture-desc">Kami menyediakan materi pembelajaran mulai dari hal yang paling dasar yaitu HTML, kemudian materi pembelajaran CSS, dan ditambah dengan bahasa program yang sangat powerfull berupa JavaScript. Semua materi terbuka untuk siapa pun.</p>
			<h2>pilih materi yang akan dipelajarai</h2><br>
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
		<hr>
		<div class="row hello-fiture">
			<h2>Snippet Program</h2>
				<p class="fiture-desc">Praktekkan kode program yang telah kamu pelajari dengan membuat snippet atau potongan kode program yang nantinya akan ditampilkan di halaman lain dari website ini untuk bisa dilihat para pengunjung yang lain.</p>
			<div class="row row-editor ex">
				<div class="col-md-6">
					<div class="code-editor">
						<div class="num">
						<?php for($i = 1; $i <= 24; $i++) {
							echo '<span>'. $i .'</span>';  
						} ?>
						</div>
							<pre id="htmlx"></pre>
					</div>
				</div>
				<div class="col-md-6">
					<div class="browser-window">
					<div class="container-window">
						<div class="row-window">
							<div class="column-window">
								<span class="dot" style="background:#ED594A;"></span>
								<span class="dot" style="background:#FDD800;"></span>
								<span class="dot" style="background:#5AC05A;"></span>
								<input class="input-window" type="text" value="<?= base_url() ?>">
							</div>
						</div>
					</div>
					<iframe id="browserx"></iframe>
					</div>
				</div>
			</div>
		</div>		
		<hr>
		<div class="row hello-fiture">
			<h2>Komunitas Belajar</h2>
				<p class="fiture-desc">Mari bergabung dengan komunitas kami untuk bisa berdiskusi seputar kode programing HTML, CSS, dan JavaScript. Daftar dengan menggunakan email aktif dan mulailah berdiskusi dengan para member lainnya.</p>
				<p class="center"><a href="<?=base_url('at/sign')?>" class="effect" style="min-width: 200px;"><span>DAFTAR</span></a></p>
			<div class="wrapper-carousel">
				<div id="tes-carousel" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#tes-carousel" data-slide-to="0" class="active"></li>
				    <li data-target="#tes-carousel" data-slide-to="1"></li>
				    <li data-target="#tes-carousel" data-slide-to="2"></li>
				    <li data-target="#tes-carousel" data-slide-to="3"></li>
				  </ol>
				    
				  <div class="carousel-inner">
				    <div class="item active">
							<div class="about-live">							
								<div class="desc-inner center">	
									<h3>Live Code Editor</h3>
									<p>dengan Live Code Editor yang sudah kami siapkan untuk pembelajaran di masing-masing materi, diharapkan dapat membantu pemahaman materi menjadi lebih cepat dan efisien</p>
								</div>
							</div>
				    </div>

				    <div class="item">
							<div class="about-practice">
								<div class="desc-inner center">	
									<h3>Best Practice</h3>
		        			<p>metode belajar yang "to the point" diharapkan tidak akan membuat bingung dalam proses pemahaman materi khususnya bagi yang masih awam terhadap dunia programing</p>
								</div>
							</div>
				    </div>

				    <div class="item">
							<div class="about-easy">
								<div class="desc-inner center">	
									<h2>Easy Run</h2>
		        			<p>tersedia contoh kode program untuk dapat dijalankan sekaligus melihat hasilnya secara langsung</p>
								</div>
							</div>
				    </div>

				    <div class="item">
							<div class="about-sign">
								<div class="desc-inner center">	
					        <h2>Sign Up</h2>
					        <p>daftarkan akun dan masuk ke halaman dashboard untuk mengetahui perkembangan belajarmu kemudian praktekkan apa yang sudah kamu ketahui dengan membuat snippet program</p>
								</div>
							</div>
				    </div>  
				    
				  </div>
				  <a class="carousel-control left" href="#tes-carousel" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control right" href="#tes-carousel" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>		
			</div>				
		</div>

	</div>
</div>

<main>
	<div class="container" style="padding: 100px 0">
		<blockquote class="blockquote">
			<p id="quote">pendidikan ilmu komputer tidak dapat membuat siapapun menjadi ahli pemrograman, <br>maka jangan khawatir kalau hasil kode tidak berjalan baik, <br>jika kode program berjalan dengan baik seketika itu,<br> maka kau akan berhenti untuk berkembang</p> 
			<i class="fas fa-quote-left"></i>
		</blockquote>
	</div>
</main>
<?php
$bbb = (explode("\n", $typing));
$ccc = implode(",", array_map(function($s) {
    return "'" . $s . "'";
}, $bbb));
?>
<script>	
	// let browserx  = document.getElementById('browserx').contentWindow.document;
	// let htmlx     = document.getElementById('htmlx');	
	// let inst = new TypeIt('#htmlx',{
	//   speed: 70,
	//   html:false,
	//   breakLines:true,
	//   cursorChar: '',
	//   strings: [<?=$ccc?>],
	//   waitUntilVisible: true
	// })
	// .go();
</script>
