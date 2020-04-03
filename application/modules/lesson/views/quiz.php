<main id="main">
  <?php wave('JavaScript Quiz','Soal Latihan Materi '.$titles) ?>
  <section class="site-section">
  	<span class="anch"></span>
    <div class="container quiz-content" id="quiz-content">
			
      <div class="start" data-aos="fade-up" data-aos-delay="200">
        <div class="card-body text-center">
          <img src="<?=base_url('assets/img/hai.gif')?>" class="mt-3">
	        <h3>Hai, sudahkah kamu belajar hari ini ?</h3>
	        <h5>Ingin menguji hasil belajarmu dengan menjawab beberapa soal latihan ?</h5>
          <h5>Ada <?=count($quiz)?> soal yang tersedia untuk kategori</h5>
          <h2><?=$titles?></h2>
          <hr>
          <div class="alert alert-info">
          	<p>Setiap soal disediakan waktu terbatas untuk dijawab.</p>
          	<p>Cukup pilih satu jawaban yang menurut kamu benar, sebelum waktu habis.</p>
          	<p>Kamu bisa submit skormu untuk disimpan di dalam leaderboard kami.</p>
          </div>
          <h3>Apakah kamu siap ?</h3>
          <button type="button" class="btn btn-default">Ayo Mulai</button>
        </div>
      </div>
      <?php
      	$num = 1; 
      	foreach ($quiz as $k => $v) : 
      	$ans[$k] = explode(',',$v['q_answer']);
      ?>
      <div class="card scale-in-center" style="display:none">
        <div class="card-body">
          <form class="quiz-form">
            <div class="btn-group btn-block btn-panel mb-3">
              <button type="button" class="btn btn-default">Soal Latihan #<?=$num?></button>
              <button type="button" style="display: none;" class="btn btn-default scale-in-center submit">Selanjutnya</button>
            </div>
            <input type="hidden" name="id" value="<?=$v['id']?>">
            <div class="question"><?=$v['q_question']?></div>
            <hr>
            <div class="row answer">
            <?php 
              $cho = 1;
              $letter = ord('A');
              foreach ($ans[$k] as $kv => $vk) : 
            ?>
              <div class="col-md-6 wrap">
                <input type="radio" name="ch" id="<?= 'choice'.$num.$cho ?>" value="<?=$cho?>">
                <label for="<?='choice'.$num.$cho?>">
                  <?='<b>'.chr($letter).'.</b> '.html_entity_decode($vk)?>
                </label>
              </div>
            <?php 
              $cho++;
              $letter++;
              endforeach;
            ?>
            </div>
            <h3 class="text-center mt-3">waktu tersisa : <span class="spent"></span></h3>
          </form>
        </div>
      </div>
      <?php
        $num++;
        endforeach; 
      ?>
      <div class="finish scale-in-center" style="display: none;">

        <div class="card-body text-center"></div>
      </div>

    </div>
  </section>
</main>

<div class="modal fade" id="modal-score">
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