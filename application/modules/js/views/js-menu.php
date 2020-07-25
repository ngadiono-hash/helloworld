<main id="main">
  <?php wave($label['description'],$label['slug']) ?>
  <div class="site-section">
    <div class="container">
      <?php if ($available) : ?>
      <div class="row mb-5">
        <?php foreach ($list as $k => $v) { ?>
        <div class="col-md-6 col-lg-4">
          <div class="post-entry rounded p-2" data-aos="fade-up" data-aos-delay="">
            <a class="back-link" href="<?=$v['link']?>"></a>
            <h3 class="mb-2"><?=preg_replace('/^JS /','',$v['title'])?></h3>
            <h4><small><?=$v['slug']?></small></h4>
            <div class="post-text p-2">
              <span class="post-meta"><?=$v['update']?> &bullet; By Administrator</span>
              <p><?=$v['content']?></p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

      <div class="row">
        <div class="col-12">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    <?php else :
      not_available();
    endif; ?>
    </div>
  </div>
  
  <div class="site-section cta-section">
    <div class="container">
      <h2 class="text-center mb-5">Cari materi dengan keyword di sini</h2>
      <div class="d-flex justify-content-center h-100">
        <div id="search-form" class="searchbar">
          <input class="search_input" type="text" placeholder="Ketik keyword lalu tekan Enter...">
          <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
        </div>
      </div>
    </div>
  </div>

<?php quotes() ?>
</main>