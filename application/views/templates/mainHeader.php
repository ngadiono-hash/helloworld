<?php
// var_dump($_COOKIE);
reload_session();
// bug($_SESSION);
$lesson_page = whats_page(2,['docs']) && !empty($this->uri->segment(3));
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="csrf" content="<?= $this->security->get_csrf_hash(); ?>">
<?php if ($lesson_page) { ?>
<meta name="id" content="<?=$lesson['id']?>">
<meta name="description" content="<?= $lesson['description'] ?>">
<meta name="keywords" content="<?= $lesson['keyword'] ?>">
<meta name="author" content="My Note">
<meta name ="revised" content ="My Note, <?= date('m/d/Y',$lesson['update']) ?>">
<?php } ?>
<link rel="icon" href="<?=base_url()?>assets/img/feed/favicon.png">
<link rel="apple-touch-icon" href="<?=base_url()?>assets/img/feed/apple-touch-icon.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700|Roboto:300,400,700&display=swap">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/aos.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/owl.carousel.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/theme.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/prism/prism-line.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/glo.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/content.css">
<style>
  .hero-section {
    background: linear-gradient(to right, rgba(39, 70, 133, 0.8) 0%, rgba(61, 179, 197, 0.8) 100%), url(<?=base_url()?>assets/img/feed/hero-bg.jpg);
    position: relative;
  }
  .hero-section.inner-page {
    min-height: 80vh;
  }
  .panel-editor .splitter { 
    background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
  }
  .anch {
    display: block;
    height: 85px;
    margin-top: -85px;
    visibility: hidden;
  }
  .shad:hover {
    transition: all 0.3s ease;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
  }
  .blog-content h3 {
    color: #6c757d;
    font-size: 2rem;
    padding: 10px;
    text-align: center;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
    text-shadow: -1px -1px 5px #dae0e5, 1px -1px 5px #dae0e5, -1px 1px 10px #dae0e5, 1px 1px 10px #dae0e5;
  }
  .blog-content .code-toolbar pre {
    max-height: 42vh;
    overflow-x: hidden;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
  }

  .blog-content .navigate {
    margin-top: 30px;
    border-bottom: 2px solid #ccc;
    border-top: 2px solid #ccc;
    padding: 20px;
  }
  .overlay {
    text-align: center;
    background: rgba(0,0,0,0.9);
  }
  
  .overlay img {
    display: inline-block;
    vertical-align: middle;
  }

  .btn-danger {
    box-shadow: 0 10px 30px 0 rgba(0, 0, 0, 0.15);
    background: linear-gradient(-45deg,#dd7b9bfa,#e31428);
  }

  .quiz-content .finish {
    min-height: 80vh;
  }

  .quiz-content .card, .quiz-content .start, .quiz-content .finish {
    max-width: 800px;
    margin: 10px auto;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.5);
  }
  .ajax {
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    text-align: center;
    background: rgba(0,0,0,0.9);
  }
  .ajax:before {
    content: '';
    height: 100%;
    display: inline-block;
    vertical-align: middle;
  }
  .ajax .contain {
    display: inline-block;
    vertical-align: middle;
  }
  .ajax .contain > img {
    min-width: 30vw;
  }
  .quiz-content .btn {
    min-width: 150px;
  }
  .quiz-content .btn-panel {
    position: sticky;
    top: 85px;
    padding-top: 10px;
    background: #fff;
    z-index: 100;
  }

  .quiz-content .notif {
    display: none;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.5);
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    background: #fff;
    z-index: 100;
    border-radius: 5px;
    overflow-y: auto;
  }
  .quiz-content p {
    margin-bottom: 0;
  }
  .quiz-content .notif .a, .quiz-content .notif .y {
    font-family: monospace;
    display: inline-block;
  }
  .quiz-content .question, .q, .a, .y {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
  }
  .quiz-content .notif .float {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
  }
  .float:hover {
    border: 2px solid;
  }
  .float:focus, .float:active {
    outline: none;
  }
  

  .quiz-content .answer {
    padding: 10px;
  }

  .quiz-content .answer .wrap {
    height: 60px;
  }

  .quiz-content .answer label,
  .quiz-content .answer input {
    display: block;
    position: absolute;
    top: 3px;
    left: 3px;
    right: 3px;
    bottom: 3px;
  }

  .quiz-content .answer input[type="radio"] {
    opacity: 0.01;
    z-index: 88;
  }

  .quiz-content .answer input[type="radio"]:checked+label {
    background: linear-gradient(180deg, #17a2b8, #0062cc);
    color: white;
    border: 2px solid #6c757d;
  }

  .quiz-content .answer label {
    padding: 10px;
    border: 1px solid #CCC;
    cursor: pointer;
    z-index: 90;
    margin: 0;
    border-radius: 5px;
    transition: background .4s ease;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-family: monospace;
    font-size: 20px;
  }

  .quiz-content .answer label:hover {
    background: #DDD;
  }  
  .btn-default {
    background: #2D71A1;
    color: #fff;
    transition: none !important;
  }

  .btn-default:hover {
    color: #fff;
    outline: 2px solid #f1f1f1;
    background: linear-gradient(180deg, #0062cc, #ccc);
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
  }

</style>
</head>
<body>
  <div class="alert-auto">
    <p class="m-1"></p>
  </div>
  <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="fa fa-times js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-lg-2">
            <h1 class="mb-0 site-logo"><a href="<?=base_url()?>" class="mb-0">My Note</a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-lg-block">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class=""><a href="<?=base_url()?>" class="nav-link">Beranda</a></li>
                <li><a href="<?=base_url()?>lesson" class="nav-link">Materi</a></li>
                <li><a href="<?=base_url()?>tutorial" class="nav-link">Tutorial</a></li>
                <?php if (is_admin()) { ?>
                <li><a href="<?=base_url()?>a" class="nav-link">Dashboard</a></li>
                <?php } ?>
              </ul>
            </nav>
          </div>
          <div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">
            <a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse"
            data-target="#main-navbar">
            <span></span>
          </a>
          </div>
        </div>
      </div>
    </header>
