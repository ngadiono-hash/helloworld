
<main id="main">
  <?php wave('JavaScript Quiz','Soal Latihan Materi JavaScript') ?>
  <section class="site-section">
  	<span class="anch"></span>
    <div class="container quiz-content">
			<div class="setup welcome" data-aos="fade-up" data-aos-delay="200">
				<div class="row text-center">
			    <div class="col-lg-7">
		        <div class="card-body">
	            <img src="<?=base_url('assets/img/emo/hai.gif')?>">
				      <h1>Hai, sudah belajar hari ini ?</h1>
		      		<h4>Ingin menguji hasil belajarmu, dengan menjawab beberapa soal latihan ?</h4>
		        </div>
			    </div>
			    <div class="col-lg-5">
			    	<div class="side-setup">
			        <div class="card-body pt-5">
		      			<h4>Silahkan pilih kategori<br> Soal Latihan</h4>
		      			<div class="row answer">
		      			<?php foreach ($category as $k => $v) : ?>
		      			  <div class="col-lg-12 wrap">
		      			    <input type="radio" name="category" id="<?=$v['name']?>" value="<?=$v['name']?>">
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
		          <img src="<?=base_url('assets/img/emo/search.gif')?>">
			        <h3 class="text-center">Tunggu sebentar,<br> kami butuh username kamu</h3>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="side-setup">
			        <div class="card-body">
				        <ul class="alert alert-info mb-3">
				        	<li>masukkan username minimal 5 sampai 20 karakter.</li>
				        	<li>karakter yang diperbolehkan hanya huruf, angka dan underscore ( _ ).</li>
				        	<li>username tidak boleh terdapat karakter spasi.</li>
				        	<li>username yang sudah terdaftar tidak akan tersedia lagi.</li>
				        </ul>
				        <form class="p-3 text-center" style="background: #f7f7f7;" id="form-user" autocomplete="off">
				        	<div class="row" >
					        	<div class="col-lg-6">
					        		<input type="text" name="user-quiz" class="form-control" placeholder="ketik username ...">
					        	</div>
					        	<div class="col-lg-6 midd">
					        		<img src="<?=base_url('assets/img/feed/bars.svg')?>" width="50" style="display: none;">
					        		<b class="user-result" style="display: none;"></b>
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
      				<img src="<?=base_url('assets/img/emo/hai.gif')?>">
		        	<h1>Halo <span class="user-active"></span></h1>
		          <h5>Ada <span class="quiz-count"></span> soal yang tersedia untuk kategori</h5>
		          <h2><span class="category-active"></span></h2>
      			</div>
      		</div>
      		<div class="col-lg-7">
      			<div class="side-setup">
			        <div class="card-body">
			          <ul class="alert alert-info">
			          	<li>setiap soal disediakan waktu terbatas untuk dijawab.</li>
			          	<li>cukup pilih satu jawaban yang menurut kamu benar, sebelum waktu habis dan soal selanjutnya ditampilkan.</li>
			          	<li>skor akan dihitung berdasarkan persentase jawaban benar dari keseluruhan soal.</li>
			          	<li>kamu bisa submit skormu untuk disimpan di dalam leaderboard kami.</li>
			          </ul>
			          <h3>Apakah kamu siap, <span class="user-active"></span> ?</h3>
			          <button type="button" class="btn btn-default">Ayo Mulai</button>
			        </div>
      			</div>
      		</div>
      	</div>
      </div>

      <div class="finish scale-in-center" style="display: none;">
      	<div class="row text-center">
      		<div class="col-lg-5">
      			<div class="card-body">
      				<h2>Hasil latihan kamu, <span class="user-active"></span></h2>		
      				<img class="img-result d-block mx-auto my-3" width="150">
      				<h1 class="score-result"></h1>
      			</div>
      		</div>
      		<div class="col-lg-7">
      			<div class="side-setup">
      				<div class="card-body"></div>
      			</div>
      		</div>
      	</div>
      </div>
    </div>
    <hr class="my-5">
    <div class="container" data-aos="fade-up" data-aos-delay="400">
    	<h1 class="text-center">Top Leaderboard</h1>
    	<table class="table table-hover">
    		<thead>
    			<tr>
    				<th>No.</th>
    				<th>Username</th>
    				<th>Level</th>
    				<th>Score</th>
    				<th>Terdaftar</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php $num= 1; ?>
    			<?php foreach ($leaderboard as $key => $val) : ?>
    			<tr>
    				<td><?=$num?>.</td>
    				<td><?=$val['user']?></td>
    				<td><?=$val['level']?></td>
    				<td><?=$val['score']?></td>
    				<td><?=elapsed('@'.$val['date'])?></td>
    			</tr>
    			<?php $num++; ?>
    			<?php endforeach; ?>
    		</tbody>
    	</table>
    </div>
  </section>
</main>

<div class="modal fade" id="modal-result">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
      <div class="card-header">
      	<h3 class="text-center">Jawaban Soal Latihan</h3>
      </div>
     	<div class="card-body result-content"></div>
      </div>
    </div>
  </div>
</div>