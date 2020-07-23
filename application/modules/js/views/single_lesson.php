<main id="main">
  <?php wave($lesson['titles'],$lesson['title']) ?>
  <section class="site-section">
    <div class="container">
      
      <div class="row">
        <div class="col-lg-8 blog-content">
          <h4 class="mt-5 section-heading section-low">Kategori : <?php echo $label ?></h4>
          <h5 class="mb-5">Terakhir diperbarui pada <?=date('M d, Y',$lesson['update'])?></h5>
          <?php echo $lesson['content'] ?>

          <div class="row">
            <div class="col-12 navigate">
              <?php if($linkPrev != '') : ?>
              <button class="btn btn-default" data-href="<?=$linkPrev?>"><i class="fa fa-lg fa-angle-left"></i> Sebelumnya</button>
              <?php endif; ?>
              <?php if($linkNext != '') : ?>
              <button class="btn btn-default float-right" data-href="<?=$linkNext?>">Selanjutnya <i class="fa fa-lg fa-angle-right"></i></button>
              <?php endif; ?>
            </div>
          </div>
          <?php // echo $lesson['disqus'] ?>
        </div>
        <div class="col-lg-4 sidebar">
          <div class="sidebar-box">

            <div class="accordion" id="accord" data-aos="fade-up" data-aos-delay="100">
              <div class="card card-menu">
                <a href="#" class="btn btn-block btn-default" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"><?= $lesson['titles'] ?><span class="ml-auto"></span></a>

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
              <div class="card card-menu">
                <a href="#" class="btn btn-block btn-default collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"><?php echo $label ?><span class="ml-auto"></span></a>
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
                <a href="#" class="btn btn-block btn-default collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">Search<span class="ml-auto"></span></a>
                <div id="collapseThree" class="collapse" data-parent="#accord">
                  <div class="card-body">
                    <form id="search-form" class="search-form my-4">
                      <div class="form-group">
                        <span class="icon fa fa-search"></span>
                        <input type="text" class="form-control" placeholder="Search...">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="card card-menu">
                <a href="#" class="btn btn-block btn-default collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false">What New's<span class="ml-auto"></span></a>
                <div id="collapseFour" class="collapse" data-parent="#accord">
                  <div class="card-body">
                    <ul class="">
                    <?php foreach ($news as $n) { ?>
                      <li><a href="<?=$n['link']?>" class="link"><?=$n['title']?></a></li>
                    <?php } ?>
                    </ul>                    
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