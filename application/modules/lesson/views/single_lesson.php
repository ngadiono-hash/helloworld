<main id="main">
  <?php wave($lesson['titles'],$lesson['title']) ?>
  <section class="site-section">
    <div class="container">
      
      <div class="row">
        <div class="col-lg-8 blog-content">
          <h4 class="mt-5" data-aos="fade-up"  data-aos-delay="100">Kategori : <?php echo $label ?></h4>
          <p class="mb-5" data-aos="fade-up"  data-aos-delay="100">Terakhir diperbarui <?=date('M d, Y',$lesson['update'])?> &bullet; Oleh <a href="#" class="text-mute">Admin</a></p>
          <?php echo $lesson['content'] ?>

          <div class="row">
            <div class="col-12 navigate" style="display: grid;">
              <div class="btn-group">
                <button class="btn btn-primary" data-href="<?=$linkPrev?>">
                  <i class="fa fa-lg fa-angle-left"></i> Sebelumnya
                </button>
                <?php if (count($quiz) > 0) : ?>
                <button type="button" class="btn btn-primary" id="open-quiz">Start Quiz</button>
                <?php endif; ?>
                <button class="btn btn-primary" data-href="<?=$linkNext?>">
                  Selanjutnya <i class="fa fa-lg fa-angle-right"></i>
                </button>
              </div>
            </div>
          </div>
          <?php // echo $lesson['disqus'] ?>
        </div>
        <div class="col-lg-4 sidebar">
          <div class="sidebar-box">

            <div class="accordion" id="accord" data-aos="fade-up" data-aos-delay="100">
              <div class="card card-menu">
                <div class="card-header">
                  <a class="card-anchor" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">Anchor Keyword<span class="ml-auto"></span></a>
                </div>

                <div id="collapseOne" class="collapse show" data-parent="#accord">
                  <div class="card-body">
                      <ul class="hint">
                      <?php 
                      foreach ($lesson['hint'] as $k => $v) {
                        $hash[$k] = strtolower(str_replace(' ','-',$v)); 
                        $linked[$k] = $v;
                       ?>
                        <li><a href="#<?=$hash[$k]?>" class="link"># <?=$linked[$k]?></a></li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <a class="card-anchor collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">List Menu <?php echo $label ?><span class="ml-auto"></span></a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accord">
                  <div class="card-body">
                    <ul class="lesson-menu">
                    <?php foreach ($lesson['menu'] as $mn) { ?>
                      <li><a href="<?=$mn['link']?>" class="link"><?=$mn['title']?></a></li>
                    <?php } ?>
                    </ul>                    
                  </div>
                </div>
              </div>
              <div class="card card-menu">
                <div class="card-header">
                  <a class="card-anchor collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">Search For<span class="ml-auto"></span></a>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accord">
                  <div class="card-body">
                    <form id="search-form" class="search-form my-4">
                      <div class="form-group">
                        <span class="icon fa fa-search"></span>
                        <input type="text" class="form-control" placeholder="Cari...">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>

<?php if (count($quiz) > 0) : ?>
  <div class="modal fade" id="modal-quiz">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content quiz-content">
        <div class="card start " data-aos="fade-up"  data-aos-delay="200">
          <div class="card-body text-center">
            <img src="<?=base_url('assets/img/hai.gif')?>" class="mt-3">
            <h3>Hai, sudahkah kamu belajar hari ini ?</h3>
            <h5>Ingin menguji hasil belajarmu dengan menjawab beberapa soal latihan ?</h5>
            <h5>Ada <?=count($quiz)?> soal yang tersedia untuk materi tentang</h5>
            <h2><?=$title?></h2>
            <h3>Apakah kamu siap ?</h3>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
            <button type="button" class="btn btn-primary">Ayo Mulai</button>
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
              <div class="btn-group btn-block mb-3">
                <button type="button" class="btn btn-primary">Soal Latihan #<?=$num?></button>
                <button type="submit" style="display: none;" class="btn btn-primary scale-in-center">SUBMIT</button>
              </div>
              <input type="hidden" name="id" value="<?=$v['id']?>">
              <div class="question"><?=$v['q_question']?></div>
              <div class="row answer">
              <?php 
                $cho = 1;
                $letter = ord('A');
                foreach ($ans[$k] as $kv => $vk) : 
              ?>
                <div class="col-md-6 wrap">
                  <input type="radio" name="choice" id="<?= 'choice'.$num.$cho ?>" value="<?=$cho?>">
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
              <hr>
            </form>
          </div>
        </div>
        <?php
          $num++;
          endforeach; 
        ?>
        <div class="card finish scale-in-center" style="display: none;">
          <div class="card-body text-center">
            <img src="" class="mt-3">
            <h3></h3>
            <h4 class="mb-3"></h4>
            <button class="btn btn-danger" data-dismiss="modal">Tidak</button>
            <button class="btn btn-primary">Ulangi</button>
          </div>
        </div>
        <div id="notif" class="notif text-center scale-in-center">
          <img src="" class="mt-3">
          <h1 class="n"></h1>
          <div class="q mx-3"></div>
          <h3 class="a my-3 alert-success"></h3>
          <hr>
          <button class="btn-secondary float"><i class="fa fa-times"></i></button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

</main>
<?php playEditor() ?>