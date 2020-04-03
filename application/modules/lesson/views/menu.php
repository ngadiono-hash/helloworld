<main id="main">
  <?php wave($label['description'],$label['slug']) ?>
  <div class="site-section">
    <div class="container menu">
      <div class="row mb-5">
        <?php foreach ($list as $k => $v) {
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="post-entry shad p-2" data-aos="fade-up" data-aos-delay="">
            <h3 class="post-title"><?=preg_replace('/^JS /', '',$v['title'])?></h3>
            <a href="<?=$v['link']?>" class="d-block mb-4">
              <img src="<?=base_url()?>assets/img/feed/jsblank.png" alt="Image" class="img-fluid">
            </a>
            <div class="post-text">
              <span class="post-meta"><?=$v['update']?> &bullet; By <a href="#">Admin</a></span>  
              <h3><a href="<?=$v['link']?>"><small><?=$v['slug']?></small></a></h3>
              
              <p><?=$v['content']?></p>
              <p><a href="<?=$v['link']?>" class="readmore">Selengkapnya</a></p>
            </div>
          </div>
        </div>
        <? } ?>

      </div>

      <div class="row">
        <div class="col-12">
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </div>

  <?php quotes() ?>
</main>