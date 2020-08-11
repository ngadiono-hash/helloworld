<main id="main">
  <?php wave('JavaScript','hehe') ?>
  <div class="site-section">
    <div class="container">
      <?php foreach ($menu as $k => $v) { ?>
      <?php $cond = $k % 2 == 0; ?>
      <div class="site-section border-bottom <?= $cond ? 'pb-2' : 'pb-2' ?>" data-aos="<?= $cond ? 'fade-left' : 'fade-right'?>">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 <?= $cond ? ' mr-auto' : 'ml-auto order-2' ?>">
              <div class="card card-body bg-light shadow">
                <h2 class="d-none d-sm-block d-md-block d-lg-none py-2 heading text-center"><?=$v[0]['description']?></h2>
                <?php $i = 1; ?>
                <?php foreach ($v as $val) { ?>
                <?php $link = base_url('js/docs/').create_slug($val['les_slug']); ?>
                  <li style="list-style: none;">
                    <a href="<?=$link?>" class="p-2 link">
                      <span class="d-block lead heading"><?=$i .'. '.$val['les_title']?></span>
                      <span class="d-inline-block ml-4"><?=$val['les_slug']?></span>
                    </a>
                  </li>
                <?php $i++ ?>
                <?php } ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="stick align-items-center d-none d-lg-block">
                <h2 class="py-4 heading text-center"><?=$v[0]['description']?></h2>
                <img src="<?=base_url('assets/img/feed/js'.$v[0]["names"].'.png')?>" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

<?php quotes() ?>
</main>