<main id="main">
  <?php wave('JavaScript Quiz','Soal Latihan Materi '.$titles) ?>
  <section class="site-section">
  	<span class="anch"></span>
    <div class="container quiz-content">
			<div class="setup welcome" data-aos="fade-up"  data-aos-delay="200">
        <div class="card-body text-center">
          <img src="<?=base_url('assets/img/hai.gif')?>" class="mt-3">
	        <h3>Hai, sudahkah kamu belajar hari ini ?</h3>
	        <h5>Ingin menguji hasil belajarmu dengan menjawab beberapa soal latihan ?</h5>
        	<hr>
        	<button type="button" class="btn btn-danger" onclick="window.history.back()">Tidak</button>
        	<button type="button" class="btn btn-default">Iya</button>
				</div>
			</div>
			<div class="setup sign scale-in-center" style="display: none;">
        <div class="card-body">
          <img src="<?=base_url('assets/img/search.gif')?>" class="mt-3 d-block mx-auto">
	        <h3 class="text-center">Sebentar, kami butuh username kamu</h3>
	        <ul class="alert alert-info">
	        	<li>masukkan username minimal 5 sampai 20 karakter.</li>
	        	<li>karakter yang diperbolehkan hanya huruf, angka atau tanda underscore ( _ ).</li>
	        	<li>username tidak boleh terdapat karakter spasi.</li>
	        </ul>
	        <form class="row mt-3 text-center" id="form-user">
	        	<div class="col-lg-8">
	        		<input type="text" name="user-quiz" class="form-control" placeholder="ketik username ...">
	        	</div>
	        	<div class="col-lg-4 midd">
	        		<img src="<?=base_url('assets/img/feed/bars.svg')?>" width="50" style="display: none;">
	        		<b class="user-result" style="display: none;"></b>
	        	</div>
	        	<div class="form-group col-md-12 mt-3"></div>
	        </form>
				</div>
			</div>

      <div class="setup start scale-in-center" style="display: none;">
        <div class="card-body text-center">
        	<h1>Halo <span class="user-active"></span></h1>
          <h5>Ada <span class="quiz-count"><?=$count?></span> soal yang tersedia untuk kategori</h5>
          <h2><?=$titles?></h2>
          <hr>
          <ul class="alert alert-info">
          	<li>setiap soal disediakan waktu terbatas untuk dijawab.</li>
          	<li>cukup pilih satu jawaban yang menurut kamu benar, sebelum waktu habis.</li>
          	<li>skor akan dihitung berdasarkan persentase jawaban benar dari keseluruhan soal.</li>
          	<li>kamu bisa submit skormu untuk disimpan di dalam leaderboard kami.</li>
          </ul>
          <h3>Apakah kamu siap, <span class="user-active"></span> ?</h3>
          <button type="button" class="btn btn-default">Ayo Mulai</button>
        </div>
      </div>
      <div class="finish scale-in-center" style="display: none;">
        <div class="card-body text-center"></div>
      </div>

    </div>
  </section>
</main>

<div class="modal fade" id="modal-">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <h3 class="text-center">Submit Score</h3>
       	<form>
       		<div class="form-group">
       			<label>username</label>
       			<input type="text" name="user" class="form-control">
       		</div>
       		<div class="form-group text-center">
       			<button class="btn btn-default">Go...</button>
       		</div>
       	</form>
      </div>
    </div>
  </div>
</div>