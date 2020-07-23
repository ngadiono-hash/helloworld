<style type="text/css">
	table th {
	    /*width: auto !important;*/
	}
	th:nth-child(1),
	td:nth-child(1) {
		/*width: 100px;*/
	}
	.w-10 { width: 10% !important; }
</style>
<main id="main">
  <?php wave('JavaScript Quiz','Soal Latihan Materi JavaScript') ?>
  <div class="site-section quiz-intro">
    <div class="container" data-aos="fade-up" data-aos-delay="200">
    	<div class="row">
    		<div class="col-md-6 offset-md-3">
					<div class="speech right p-4">
						<h1>halo semua</h1>
						<h4>perkenalkan, namaku qoobee</h4>
						<h4>mau bermain denganku ngga ?</h4>
						<h4>aku ingin menguji sejauh mana</h4>
						<h4>pemahamanmu tentang JavaScript</h4>
					</div>
					<img class="mt-5" src="<?=base_url('assets/img/emo/hai.gif')?>">
    		</div>
    	</div>
			<div class="row mt-5 text-center">
				<div class="col-md-8 offset-md-2 section-heading">
					<h3>ini adalah fitur dari kami untuk membantumu mengasah pengetahuan dan logika dalam bahasa program JavaScript</h3>
				</div>
    	</div>
    </div>
  </div>

  <section class="site-section quiz-content fluid-section">
  	<span class="anch"></span>
    <div class="container">
			<div class="setup welcome" data-aos="fade-up" data-aos-delay="200">
				<div class="row text-center">
			    <div class="col-lg-5">
		        <div class="card-body">
	            <div class="speech right">
			      		<h3>apa kamu yakin akan jadi yang terbaik di sini ?</h3>
			      		<h4>pilih kategori soal untuk memulainya</h4>
	            </div>
	            <img class="mt-5" src="<?=base_url('assets/img/emo/myc.gif')?>">
		        </div>
			    </div>
			    <div class="col-lg-7">
			    	<div class="side-setup">
			        <div class="card-body pt-5">
		      			<h5>silahkan pilih kategori</h5>
		      			<div class="row answer">
		      			<?php foreach ($category as $k => $v) : ?>
		      			  <div class="col-md-8 offset-md-2 wrap">
		      			    <input type="radio" name="c" id="<?=$v['name']?>" value="<?=$v['name']?>">
		      			    <label for="<?=$v['name']?>" class="text-center"><?=$v['description']?></label>
		      			  </div>
		      			<?php endforeach; ?>
		      			</div>
		      			<div class="groups"></div>
			        </div>
			    	</div>
			    </div>
				</div>
			</div>
			<div class="setup sign scale-in-center" style="display: none;">
				<div class="row text-center">
					<div class="col-lg-5">
						<div class="card-body">
							<div class="speech right">
			        	<h3>tunggu sebentar !</h3>
				        <h4>aku ingin tahu siapa kamu ?</h4>
				        <h4>agar aku mudah menyebut namamu</h4>
							</div>
		          <img class="mt-5" src="<?=base_url('assets/img/emo/search.gif')?>">
			        <br>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="side-setup">
			        <div class="card-body">
			        	<h5>silahkan masukkan username</h5>
				        <ul class="alert alert-info mb-3">
				        	<li>username minimal 5 sampai 20 karakter</li>
				        	<li>username hanya boleh huruf, angka dan underscore ( _ )</li>
				        	<li>username yang sudah terdaftar pada leaderboard tidak akan tersedia lagi untuk level kategori yang sama</li>
				        </ul>
				        <form class="p-3 text-center" style="background: #f7f7f7;" autocomplete="off">
				        	<div class="row">
					        	<div class="col-lg-6">
					        		<input type="text" class="form-control" placeholder="ketik username ...">
					        	</div>
					        	<div class="col-lg-6 midd">
					        		<img src="<?=base_url('assets/img/feed/bars.svg')?>" width="50" style="display: none;">
					        		<b class="valid-user" style="display: none;"></b>
					        	</div>
					        	<div class="groups"></div>
				        	</div>
				        </form>
							</div>
						</div>
					</div>
				</div>
			</div>
      <div class="setup start scale-in-center" style="display: none;">
      	<div class="row text-center">
      		<div class="col-lg-5">
      			<div class="card-body">
      				<div class="speech right">
			        	<h1>hai <span class="quiz-user"></span>,</h1>
			        	<h4>aku telah persiapkan soal latihan untukmu</h4>
			        	<h4>selamat mengerjakan</h4>
      				</div>
      				<img class="mt-5" src="<?=base_url('assets/img/emo/test.gif')?>">
      			</div>
      		</div>
      		<div class="col-lg-7">
      			<div class="side-setup">
			        <div class="card-body">
			        	<table class="table" style="text-align: left;">
			        		<tr>
			        			<td><h5>Kategori Soal</h5></td>
			        			<td><h5>: <span class="quiz-category"></span></h5></td>
			        		</tr>
			        		<tr>
			        			<td><h5>Total Soal</h5></td>
			        			<td><h5>: <span class="quiz-total"></span> soal</h5></td>
			        		</tr>
			        		<tr>
			        			<td><h5>Waktu per Soal</h5></td>
			        			<td><h5>: <span>30</span> detik</h5></td>
			        		</tr>
			        	</table>
			          <ul class="alert alert-info">
			          	<li>pilih satu jawaban yang menurut kamu benar, sebelum waktu habis.</li>
			          	<li>saat ada jawaban terpilih dan masih tersedia waktu, kamu bisa skip ke soal berikutnya.</li>
			          	<li>skor akan dihitung berdasarkan persentase jawaban benar dari total soal.</li>
			          </ul>
			          <button type="button" class="btn btn-default">Ayo Mulai</button>
			        </div>
      			</div>
      		</div>
      	</div>
      </div>
      <!--  -->
      <div class="finish scale-in-center" style="display: none;">
      	<div class="row text-center">
      		<div class="col-lg-5">
      			<div class="card-body">
      				<div class="speech right">
      					<h1 class="usr-result"></h1>
      					<h3 class="msg-result"></h3>
      				</div>	
      				<img class="img-result mt-5">
      				<div class="sum-result"></div>
      			</div>
      		</div>
      		<div class="col-lg-7">
      			<div class="side-setup">
      				<div class="card-body">
      					<div class="row">
	      					<div class="col-sm-4">
	      						<div class="alert alert-info">
	      							<h3 class="border-bottom">Soal</h3>
	      							<h2></h2>
	      						</div>
	      					</div>
	      					<div class="col-sm-4">
		      					<div class="alert alert-success">
		      						<h3 class="border-bottom">Benar</h3>
		      						<h2></h2>
		      					</div>
	      					</div>
	      					<div class="col-sm-4">
		      					<div class="alert alert-danger">
		      						<h3 class="border-bottom">Salah</h3>
		      						<h2></h2>
		      					</div>
	      					</div>
      					</div>
      					<hr>
      					<div class="row">
      						<div class="col-md-6">
      							<div class="card">
      								<h3 class="border-bottom py-2">skor</h3>
      								<span class="scores section-heading"></span>
      							</div>
      						</div>
      						<div class="col-md-6">
      							<div class="card">
			    						<h3 class="border-bottom py-2">durasi</h3>
			    						<span class="time-result section-heading"></span>
      							</div>
      						</div>
      					</div>
      					<hr>
    						<h4 class="fire-result heading"></h4>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
    </div>  		
  </section>

  <div class="site-section quiz-board border-bottom">
    <div class="container" data-aos="fade-up" data-aos-delay="200">
    	<h1 class="text-center mb-4 section-heading">Top Leaderboard</h1>
    	<h3 class="heading text-center mb-5">rangking skormu akan otomatis terupdate di tabel ini<br>ketika masuk 10 besar terbaik</h3>
    	
    	<div class="card-body">
	    	<ul class="nav nav-tabs nav-fill mb-3">
	    	  <li class="nav-item">
	    	    <a class="nav-link heading active" data-toggle="tab" href="#js-bg">JavaScript Dasar</a>
	    	  </li>
	    	  <li class="nav-item">
	    	    <a class="nav-link heading" data-toggle="tab" href="#js-md">JavaScript Medium</a>
	    	  </li>
	    	  <li class="nav-item">
	    	    <a class="nav-link heading" data-toggle="tab" href="#js-ad">JavaScript Lanjutan</a>
	    	  </li>
	    	</ul>
	    	<div class="tab-content">
	    	  <div class="tab-pane fade show active" id="js-bg"></div>
	    	  <div class="tab-pane fade" id="js-md"></div>
	    	  <div class="tab-pane fade" id="js-ad"></div>
	    	</div>
    	</div>
    </div>
  </div>

  <?php quotes() ?>

</main>

<div class="modal fade" id="modal-result">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card-header">
      	<h3 class="text-center">Soal Latihan <span class="quiz-category"></span></h3>
      </div>
     	<div class="card-body result-content"></div>
      </div>
    </div>
  </div>
</div>