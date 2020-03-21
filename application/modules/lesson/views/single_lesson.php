
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
            <div class="col-md-10 text-center hero-text">
              <h1 data-aos="fade-up" data-aos-delay=""><?php echo $lesson['titles']?></h1>
              <h3 class="mb-5" data-aos="fade-up" data-aos-delay="100" style="color: #fff"><?php echo $lesson['title']?></h3>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="site-section">
    <div class="container">
      
      <div class="row">
        <div class="col-lg-8 blog-content">
          <h4 class="mt-5" data-aos="fade-up"  data-aos-delay="100">Kategori : <?php echo $label ?></h4>
          <p class="mb-5" data-aos="fade-up"  data-aos-delay="100">Terakhir diperbarui <?=date('M d, Y',$lesson['update'])?> &bullet; Oleh <a href="#" class="text-mute">Admin</a></p>
          <?php echo $lesson['content'] ?>

          <div class="row">
            <div class="col-12 navigate">
              <button class="btn btn-primary" data-href="<?=$linkPrev?>">
                <i class="fa fa-lg fa-angle-left"></i> Sebelumnya
              </button>
              <button class="btn btn-primary float-right" data-href="<?=$linkNext?>">
                Selanjutnya <i class="fa fa-lg fa-angle-right"></i>
              </button>
            </div>
          </div>
          <?php echo $lesson['disqus'] ?>
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


</main>
<?php playEditor() ?>