
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
        <div class="col-md-8 blog-content">
          <p class="mb-5" data-aos="fade-up"  data-aos-delay="100"><?=date('M d, Y',$lesson['update'])?> &bullet; By <a href="#" class="text-mute">Admin</a></p>
          <?php echo $lesson['content'] ?>
          <?php echo $lesson['disqus'] ?>
        </div>
        <div class="col-md-4 sidebar">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group">
                <span class="icon fa fa-search"></span>
                <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
              </div>
            </form>
          </div>
          <div class="sidebar-box">
            <div class="categories lesson-menu">
              <h3>List Menu</h3>
              <?php foreach ($lesson['menu'] as $mn) { ?>
                <li><a href="<?=$mn['link']?>"><?=$mn['title']?></a></li>
              <?php  } ?>
            </div>
          </div>
          <div class="sidebar-box">
            <img src="img/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
            <h3>About The Author</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            <p><a href="#" class="btn btn-danger btn-sm">Read More</a></p>
          </div>

          <div class="sidebar-box">
            <h3>Paragraph</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="site-section cta-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 mr-auto text-center text-md-left mb-5 mb-md-0">
          <h2>Starts Publishing Your Apps</h2>
        </div>
        <div class="col-md-5 text-center text-md-right">
          <p><a href="#" class="btn"><span class="icofont-brand-apple mr-3"></span>App store</a> <a href="#" class="btn"><span class="icofont-ui-play mr-3"></span>Google play</a></p>
        </div>
      </div>
    </div>
  </div>


</main>
<?php playEditor() ?>