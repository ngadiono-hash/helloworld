
  <main id="main">
    <div class="hero-section">
      <div class="wave">
        <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z"
                id="Path"></path>
            </g>
          </g>
        </svg>
      </div>

      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 hero-text-image">
            <div class="row">
              <div class="col-lg-7 text-center text-lg-left">
                <h1 data-aos="fade-right">Note JavaScript</h1>
                <p class="" data-aos="fade-right" data-aos-delay="100">Situs dokumentasi belajar Bahasa Program JavaScript</p>
                <p class="" data-aos="fade-right" data-aos-delay="200">Mulai dari tingkat dasar hingga tingkat mahir</p>
              </div>
              <div class="col-lg-5 iphone-wrap">
                <img src="<?=base_url()?>assets/img/feed/snippet.png" alt="Image" class="phone-1" data-aos="fade-right">
                <img src="<?=base_url()?>assets/img/feed/practice.gif" alt="Image" class="d-none d-lg-block phone-2" data-aos="fade-right" data-aos-delay="400">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="site-section">
      <div class="container">

        <div class="row justify-content-center text-center mb-5">
          <div class="col-lg-6" data-aos="fade-up">
            <h2 class="section-heading">Belajar Bahasa Program JavaScript</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon fa fa-archive"></span>
              </div>
              <h3 class="mb-3">Materi Belajar Simpel</h3>
              <p>Tersedia materi belajar dengan metode yang simpel dan mudah dipahami.</p>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon fa fa-laptop"></span>
              </div>
              <h3 class="mb-3">Dilengkapi Live Code Editor</h3>
              <p>Setiap materi disediakan contoh kode yang relevan dan siap untuk dijalankan.</p>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <span class="icon fa fa-code"></span>
              </div>
              <h3 class="mb-3">Materi Up to Date</h3>
              <p>Materi tentang JavaScript akan selalu kami berikan yang terupdate.</p>
            </div>
          </div>
        </div>

      </div>
    </div> <!-- .site-section -->

    <?php foreach ($label as $k => $v) { ?>
    <div class="site-section">
      <div class="container" data-aos="fade-left">
        <h2 class="mb-4 text-center section-heading"><?=$v['description']?></h2>
        <div class="col-md-8 offset-md-2 col-sm-12 thumbnail">
          <img src="<?=base_url('assets/img/feed/').$v['image']?>" class="img-fluid rounded mx-auto d-block shadow-lg">
          <div class="caption">
            <p><?=$v['content']?></p>
            <div class="text-center">
              <a class="btn btn-default" href="<?=base_url('js/').$v['name']?>">Mulai Belajar</a>
            </div>
          </div>
        </div>
        
        <div class="row d-none align-items-center py-3">
          <div class="col-md-6">
            
          </div>
          <div class="col-md-6 ml-auto" data-aos="fade-left">
            <a href="<?=base_url('js/').$v['name']?>">
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

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
