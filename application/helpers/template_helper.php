<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function myGlobalCss(){ ?>
  <link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">
<?php }
function myGlobalJs(){ ?>
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
  <script src="<?=log?>jquery.min.js"></script>
  <script src="<?= base_url('assets/js/global.js') ?>"></script>
<?php }
function myEditorJs(){ ?>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script> -->
  <script src="<?=log?>ace.js"></script>
  <!-- <script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script> -->
  <script src="<?=log?>ace-language.js"></script>
  <script src="<?=base_url()?>assets/vendor/resize/resiz.js"></script>
  <script src="<?=base_url()?>assets/js/my-ace.js"></script>
<?php }
function not_available() { ?>
  <div class="card not-available" data-aos="fade-up" data-aos-delay="200">
    <div class="card-body text-center">
      <img src="<?=base_url('assets/img/emo/maaf.gif')?>" class="my-3" width='150'>
      <h1>Maaf...</h1>
      <h3>Sayangnya halaman ini belum tersedia</h3>
      <h3>Cobalah untuk kembali lagi besok</h3>
      <hr>
      <button type="button" class="btn btn-danger mx-1" onclick="window.history.back()">kembali</button>
    </div>
  </div> 
<?php }
function wave($first,$second) { ?>
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
              <h1 data-aos="fade-up" data-aos-delay=""><?=$first?></h1>
              <h3 class="mb-5 text-white" data-aos="fade-up" data-aos-delay="100"><?=$second?></h3>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }

function quotes() { ?>
  <div class="site-section border-top border-bottom">
    <div class="container">
      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-6">
          <h2 class="section-heading">Master of JavaScript</h2>
        </div>
      </div>
      <div class="row justify-content-center text-center">
        <div class="col-md-7">
          <div class="owl-carousel testimonial-carousel">
            <div class="review text-center">
              <h3>Elegant Language</h3>
              <blockquote>
                <p>Fortunately, JavaScript has some extraordinarily good parts. In JavaScript, there is a beautiful, elegant, highly expressive language that is buried under a steaming pile of good intentions and blunders.</p>
              </blockquote>

              <p class="review-user">
                <span class="d-block">
                  <span class="text-black">&bullet; Douglas Crockford &bullet;</span>
                </span>
              </p>

            </div>

            <div class="review text-center">
              <p class="stars">
                <span class="icofont-star"></span>
                <span class="icofont-star"></span>
                <span class="icofont-star"></span>
                <span class="icofont-star"></span>
                <span class="icofont-star muted"></span>
              </p>
              <h3>Awesome Language</h3>
              <blockquote>
                <p>Technically, web browsers can control what users see, and sites using Javascript can overwrite anything coming from the original authors. Browsers heavily utilize Javascript to create an interactive Internet. Sites like YouTube, Facebook, and Gmail could be crippled without it.</p>
              </blockquote>
              <p class="review-user">
                <span class="d-block">
                  <span class="text-black">&bullet; Ben Shapiro &bullet;</span>
                </span>
              </p>

            </div>


            <div class="review text-center">
              <p class="stars">
                <span class="icofont-star"></span>
                <span class="icofont-star"></span>
                <span class="icofont-star"></span>
                <span class="icofont-star"></span>
                <span class="icofont-star muted"></span>
              </p>
              <h3>Other Side</h3>
              <blockquote>
                <p>JavaScript: This is a super-popular programming language primarily used in web apps. But it doesn't have much to do with Java besides the name. JavaScript runs a lot of the modern web, but it also catches a lot of flak for slowing browsers down and sometimes exposing users to security vulnerabilities.</p>
              </blockquote>
              <p class="review-user">
                <span class="d-block">
                  <span class="text-black">&bullet; Dmitry Baranovskiy &bullet;</span>
                </span>
              </p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php }

function playEditor() { 
  $adm = whats_page(1,['a']);
  ?>
<style type="text/css">
#mySidenav a {
  position: absolute; /* Position them relative to the browser window */
  left: -80px; /* Position them outside of the screen */
  transition: 0.3s; /* Add transition on hover */
  padding: 15px; /* 15px padding */
  width: 100px; /* Set a specific width */
  text-decoration: none; /* Remove underline */
  font-size: 20px; /* Increase font size */
  color: white; /* White text color */
  border-radius: 0 5px 5px 0; /* Rounded corners on the top right and bottom right side */
}

#mySidenav a:hover {
  left: 0; /* On mouse-over, make the elements appear as they should */
}

/* The about link: 20px from the top with a green background */
#about {
  top: 20px;
  background-color: #4CAF50;
}

#blog {
  top: 80px;
  background-color: #2196F3; /* Blue */
}

#projects {
  top: 140px;
  background-color: #f44336; /* Red */
}

#contact {
  top: 200px;
  background-color: #555 /* Light Black */
}  
</style>

<?php }

function blank_page($status) { ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Oops... <?=$status?></title>
    <style>
    div {
      margin: 20px auto;
      padding: 20px;
      text-align: center;
      font-family: sans-serif;
      max-width: 700px;
      border: 2px solid #ccc;
      color: #808080;
    }
    h1 { font-family: Stencil, Fantasy; }
    img { width: 70%; }
    button {
      min-width: 220px;
      cursor: pointer;
      text-transform: uppercase;
    }
  </style>
  </head>
  <body>
    <div>
      <img src="<?= base_url('assets/img/feed/'.$status.'.gif') ?>">
      <?php if($status == 404) { ?>
        <h1>Invalid URL</h1>
        <h3><small><?= current_url() ?></small></h3>
        <h3>URL tidak tersedia</h3>
        <button onclick="window.history.back()"><h3>kembali</h3></button>
      <?php } elseif ($status == 403) { ?>
        <h1>You must login to enter this page</h1>
        <button onclick="window.location.href='<?=base_url("at/sign")?>'"><h3>Login</h3></button>
      <?php } ?>
    </div>
  </body>
  </html>
<?php }


function selectBS(){ ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
  <script src="<?=base_url('assets/js/jquery.chained.js')?>"></script>
<?php }

function select2(){ ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.js"></script>
<?php }

function bootstrap(){ ?>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.all.min.js"></script>
<?php }

function aceEditor(){ ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>
  <script src="<?= base_url('assets/js/resize.js')?>"></script>
<?php }

function dataTable(){ ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/v/ju-1.12.1/rr-1.2.4/datatables.min.css"/>
  <script src="https://cdn.datatables.net/v/ju/dt-1.10.18/rr-1.2.4/datatables.min.js"></script>
<?php }