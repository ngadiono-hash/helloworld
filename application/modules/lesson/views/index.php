
<main id="main">
  <?php wave('Materi JavaScript','Dokumentasi tentang bahasa program JavaScipt') ?>
  <div class="site-section pb-0">
    <div class="container">
      <div class="row align-items-center py-3">
        <div class="col-md-6">
          <h2 class="mb-4 text-center"><?=$label[0]['description']?></h2>
          <p class="mb-4"><?=$label[0]['content']?></p>
          <div class="btn-block btn-group">
            <a class="btn btn-default" href="<?=base_url()?>lesson/beginner">Mulai Belajar</a>
            <a class="btn btn-default" href="<?=base_url()?>lesson/quiz/beginner">Mulai Latihan</a>
          </div>
        </div>
        <div class="col-md-6 ml-auto" data-aos="fade-left">
          <a href="<?=base_url()?>lesson/beginner"><img src="<?=base_url()?>assets/img/feed/jsbasic.png" alt="Image" class="img-fluid shadow-lg"></a>
        </div>
      </div>
    </div>
  </div>
  
  <div class="site-section">
    <div class="container">
      <div class="row align-items-center py-3">
        <div class="col-md-6 mr-auto order-2">
          <h2 class="mb-4 text-center"><?=$label[1]['description']?></h2>
          <p class="mb-4"><?=$label[1]['content']?></p>
          <div class="btn-block btn-group">
            <a class="btn btn-default" href="<?=base_url()?>lesson/intermediate">Mulai Belajar</a>
            <a class="btn btn-default" href="<?=base_url()?>lesson/quiz/intermediate">Mulai Latihan</a>
          </div>
        </div>
        <div class="col-md-6" data-aos="fade-right">
          <a href="<?=base_url()?>lesson/intermediate"><img src="<?=base_url()?>assets/img/feed/jsmedium.png" alt="Image" class="img-fluid shadow-lg"></a>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section pb-6">
    <div class="container">
      <div class="row align-items-center py-3">
        <div class="col-md-6">
          <h2 class="mb-4"><?=$label[2]['description']?></h2>
          <p class="mb-4"><?=$label[2]['content']?></p>
          <div class="btn-block btn-group">
            <a class="btn btn-default" href="<?=base_url()?>lesson/advance">Mulai Belajar</a>
            <a class="btn btn-default" href="<?=base_url()?>lesson/quiz/advance">Mulai Latihan</a>
          </div>
        </div>
        <div class="col-md-6 ml-auto" data-aos="fade-left">
          <a href="<?=base_url()?>lesson/advance"><img src="<?=base_url()?>assets/img/feed/jsadvance.png" alt="Image" class="img-fluid shadow-lg"></a>
        </div>
      </div>
    </div>
  </div>

  <?php quotes() ?>
</main>