
<main id="main">
  <?php // wave('Materi JavaScript','Dokumentasi tentang bahasa program JavaScipt') ?>

  <?php foreach ($label as $k => $v) { ?>
  <div class="site-section">
    <div class="container menu">
      <div class="row align-items-center py-3">
        <div class="col-md-6">
          <h2 class="mb-4 text-center"><?=$v['description']?></h2>
          <p class="mb-4"><?=$v['content']?></p>
          <div class="text-center">
            <a class="btn btn-default" href="<?=base_url('lesson/').$v['name']?>">Mulai Belajar</a>
          </div>
        </div>
        <div class="col-md-6 ml-auto" data-aos="fade-left">
          <a href="<?=base_url('lesson/').$v['name']?>">
            <img src="<?=base_url('assets/img/feed/').$v['image']?>" class="img-fluid shadow-lg img-index">
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php quotes() ?>
</main>