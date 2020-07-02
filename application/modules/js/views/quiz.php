
<main id="main">
  <?php wave('JavaScript Quiz','Soal Latihan Materi JavaScript') ?>
  <div class="site-section">
    <div class="container" data-aos="fade-up" data-aos-delay="200">
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
  </div>

  <section class="site-section">
  	<span class="anch"></span>
  	<div class="fluid-section">
	    <div class="container quiz-content">
				<div class="setup welcome" data-aos="fade-up" data-aos-delay="200">
					<div class="row text-center">
				    <div class="col-lg-7">
			        <div class="card-body">
		            <div class="speech right">
						      <h1>Hai...</h1>
				      		<h3>Kamu mau ikut mencantumkan namamu pada tabel leaderboard ?</h3>
		            </div>
		            <img class="mt-5" src="<?=base_url('assets/img/emo/hai.gif')?>">
			        </div>
				    </div>
				    <div class="col-lg-5">
				    	<div class="side-setup">
				        <div class="card-body pt-5">
			      			<h5>silahkan pilih kategori</h5>
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
								<div class="speech right">
				        	<h3>Tunggu sebentar !</h3>
					        <h4>Kami ingin tahu siapa kamu ?</h4>
					        <h4>Agar kami mudah menyebut namamu</h4>
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
					        	<li>username hanya huruf, angka dan underscore ( _ )</li>
					        	<li>username tidak boleh terdapat karakter spasi</li>
					        	<li>username yang sudah terdaftar pada leaderboard tidak akan tersedia lagi</li>
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
	      				<div class="speech right">
				        	<h1>Hai <span class="user-active"></span>,</h1>
				        	<h4>kami telah persiapkan beberapa soal latihan untuk kamu jawab</h4>
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
				        			<td><h5>: <span class="category-active"></span></h5></td>
				        		</tr>
				        		<tr>
				        			<td><h5>Total Soal</h5></td>
				        			<td><h5>: <span class="quiz-count"></span> soal</h5></td>
				        		</tr>
				        		<tr>
				        			<td><h5>Waktu per Soal</h5></td>
				        			<td><h5>: <span>30</span> detik</h5></td>
				        		</tr>
				        	</table>
				          <ul class="alert alert-info">
				          	<li>pilih satu jawaban yang menurut kamu benar, sebelum waktu habis.</li>
				          	<li>skor akan dihitung berdasarkan persentase jawaban benar dari total soal.</li>
				          	<li>kamu bisa submit skormu untuk disimpan ke dalam leaderboard kami.</li>
				          </ul>
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
	      				<div class="speech right">
	      					<h1 class="usr-result"></h1>
	      					<h3 class="msg-result"></h3>
	      				</div>	
	      				<img class="img-result mt-5">
	      				
	      			</div>
	      		</div>
	      		<div class="col-lg-7">
	      			<div class="side-setup">
	      				<div class="card-body">
	      					<div class="row">
		      					<div class="col-sm-4">
		      						<div class="alert alert-info">
		      							<h3>Soal</h3>
		      							<h2></h2>
		      						</div>
		      					</div>
		      					<div class="col-sm-4">
			      					<div class="alert alert-success">
			      						<h3>Benar</h3>
			      						<h2></h2>
			      					</div>
		      					</div>
		      					<div class="col-sm-4">
			      					<div class="alert alert-danger">
			      						<h3>Salah</h3>
			      						<h2></h2>
			      					</div>
		      					</div>
	      					</div>
	      					<hr>
      						<h3>skor kamu :</h3>
      						<span class="scores section-heading"></span>
	      					<div class="sum-result"></div>
	      				</div>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	    </div>  		
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