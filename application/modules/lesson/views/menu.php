<main id="main">
  <div class="hero-section inner-page">
    <div class="wave">
      
      <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                  <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
              </g>
          </g>
      </svg>

    </div>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-md-7 text-center hero-text">
              <h1 data-aos="fade-up" data-aos-delay=""><?=$label['description']?></h1>
              <h3 class="mb-5 text-white" data-aos="fade-up"  data-aos-delay="100"><?=$label['slug']?></h3>  
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  

  <div class="site-section">
    <div class="container menu">
      <div class="row mb-5">
        <?php foreach ($list as $k => $v) {
        ?>
        <div class="col-md-6 col-lg-4">
          <div class="post-entry shadow p-2" data-aos="fade-up" data-aos-delay="">
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