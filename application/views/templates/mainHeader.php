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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Roboto">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- <link rel="stylesheet" href="<?=base_url()?>assets/vendor/bootstrap/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> -->

<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/aos.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/owl.carousel.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/theme.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/prism/prism-line.css">
<?php myGlobalCss() ?>
<!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/content.css"> -->
<style>
/*internal*/
  .hero-section {
    background: linear-gradient(to right, rgba(39, 70, 133, 0.8) 0%, rgba(61, 179, 197, 0.8) 100%), url(<?=base_url()?>assets/img/feed/hero-bg.jpg);
    position: relative;
  }
  .panel-editor .splitter { 
    background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
  }
  .hero-section, .hero-section > .container > .row {
    min-height: 830px;
  }
  .hero-section.inner-page {
    min-height: 80vh;
  }
  .hero-section .iphone-wrap .phone-1 {
    width: 510px;
    border-radius: 5px;
  }
  .hero-section .iphone-wrap .phone-2 {
    width: 220px;
    border-radius: 5px;
    top: 60px;
    left: 30%;
    margin: 0 auto;
  }  
  .hero-section.log > .container > .row {
    height: 100vh;
    min-height: 660px;
  }
/*=============== external global*/  
  .btn-default, .btn-danger {
    color: #fff;
    border: 2px solid transparent;
    text-shadow: -1px -1px 3px #676d72, 1px -1px 2px #676d72, -1px 1px 3px #676d72, 1px 1px 2px #676d72;
    transition: none !important;
  }
  .btn-default {
    background: #d1ecf1;
  }
  .btn-danger {
    background: #F8D7DA; 
  }

  .btn-default:hover, .btn-danger:hover {
    color: #fff;
    border: 2px solid;
  }
  .btn-default:hover {
    background: linear-gradient(180deg, #0062cc, #007bff40);
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
  }
  .btn-danger:hover {
    background: linear-gradient(180deg, #E91E63, #e1536180);
    box-shadow: 0 0 0 0.2rem rgba(225,83,97,.5);
  }

/*================ external quiz*/
  h6.a {
    font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
  }
  .anch {
    display: block;
    height: 85px;
    margin-top: -85px;
    visibility: hidden;
  }
  .quiz-content .setup,
  .quiz-content .squence,
  .quiz-content .finish {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.5);   
  }
  .quiz-content .setup .groups,
  .quiz-content .squence .groups {
    margin: 30px auto;
  }
  .quiz-content .setup > .row,
  .quiz-content .squence > .row,
  .quiz-content .finish > .row {
    min-height: 78vh;
    padding-top: 20px;
    padding-bottom: 20px;
  }
  .side-setup {
    border-left: 1px solid;
    height: 100%;
  }
  .quiz-content .setup .card-body > img,
  .quiz-content .squence .card-body > img {
    display: block;
    margin: 10px auto;
    width: 150px;
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

  .quiz-content p {
    margin-bottom: 0;
  }
  .quiz-content .question {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
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
    top: 10px;
    left: 10px;
    right: 10px;
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
    font-family: Consolas, Monaco, 'Andale Mono', monospace;
    font-size: 18px;
    text-align: left;
  }

  .quiz-content .answer label:hover {
    background: #DDD;
  }
  .time-progress {
    width: 100%;
    height: 15px;
    background-color: #0A5F44;
  }

  .time-progress div {
    height: 100%;
    text-align: right;
    padding: 0 10px; 
    width: 0;
    background-color: #CBEA00;
    box-sizing: border-box;
  }

  /* Do not take in account */
  /*html{padding-top:30px}a.solink{position:fixed;top:0;width:100%;text-align:center;background:#f3f5f6;color:#cfd6d9;border:1px solid #cfd6d9;line-height:30px;text-decoration:none;transition:all .3s;z-index:999}a.solink::first-letter{text-transform:capitalize}a.solink:hover{color:#428bca}*/

/*================ external menu */
  .site-section > .container.menu {
    border-bottom: 2px solid;
  }
  .post-entry {
    position: relative;
    cursor: default;
  }
  .post-entry > .post-title {
    position: absolute;
    top: 10%;
    left: 50%;
    font-weight: bold;
    color: #f0dc3f;
    text-shadow: 2px 2px 4px rgba(0,0,0.4);
  }

/*================ external lesson */
  .note {
    position: relative;
    min-width: 0;
    word-wrap: break-word;
    background-color: #f1f1f1;
    background-clip: border-box;
    border: 1px solid #e74a3b;
    border-radius: 8px;
    border-left: 10px solid #e74a3b;
    border-bottom-color: #e74a3b;
    padding: 20px;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
  }
  :not(pre) > code[class*="language-"], pre[class*="language-"] {
    background: #495057;
  }
  :not(pre) > code[class*="language-"] {
    padding: 0 2px;
  }
  span.anchor {
    display: block;
    height: 155px;
    margin-top: -155px;
    visibility: hidden;
  }
  .blog-content {
    text-align: justify;
  }
  .blog-content h3 {
    color: #6c757d;
    font-size: 2rem;
    padding: 10px;
    text-align: center;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
    text-shadow: -1px -1px 5px #dae0e5, 1px -1px 5px #dae0e5, -1px 1px 10px #dae0e5, 1px 1px 10px #dae0e5;
  }
  .blog-content .wrapper-content {
    padding-top: 20px;
  }
  .blog-content table th {
    text-align: center;
    text-transform: capitalize;
    font-weight: bold;
  }
  .blog-content img {
    max-width: 70%;
    border-radius: 5px;
    border: 1px solid #dee2e6;
    padding: 5px;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
  }
  .blog-content img.wide {
    cursor: zoom-in;
  }
  .blog-content p + pre, .blog-content ul + pre {
    background: linear-gradient(45deg,#ddd,#d6c9c9);
    padding: 10px;
    max-width:90%;
    margin: 20px auto;
    border-radius: 10px;
  }
  .blog-content .code-toolbar {
    max-width: 800px;
    margin: 10px;
    margin-bottom: 30px;
    position: relative;
  }
  .blog-content .code-toolbar pre {
    max-height: 42vh;
    overflow-x: hidden;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
  }
  .blog-content .execute {
    font-size: .8em;
    padding: 5px 10px !important;
    transition: all ease 0.2s;
    position: absolute;
    top: 6px;
    right: 20px;
    transition: all 0.4s ease;
  }
  .blog-content .execute:hover {
    background: linear-gradient(-45deg, #86dbe9, #27857e);
  }
  .blog-content .navigate {
    margin-top: 30px;
    border-bottom: 2px solid #ccc;
    border-top: 2px solid #ccc;
    padding: 20px;
  }
  .blog-content .code-toolbar pre.language-javascript {
    overflow-x: auto;
  }
  .result-content .card-anchor {
    padding: 10px 0;
    cursor: pointer;
    display: block;
  }
  .result-content .card-header {
    padding: 2px 20px;
  }
  .result-content a.card-header:hover {
    text-decoration: none;
  }  
  .search-result span.highlight {
    color: red;
    background: yellow;
  }
  .sidebar-box {
    padding: 25px 5px;
    position: sticky;
    top: 80px;
  }
  .sidebar-box .card-body {
    padding: 10px;
    overflow-y: auto;
    max-height: 58vh;
  }
  .sidebar-box .hint {
    padding: 5px;
  }
  .sidebar-box .card-header {
    padding: 2px 20px;
  }
  .sidebar-box .card-anchor {
    padding: 10px 0;
    cursor: pointer;
    display: block;
  }
  .sidebar-box a.card-header:hover {
    text-decoration: none;
  }
  .sidebar-box ul {
    list-style: none;
    padding: 0;
  }
  .sidebar-box li {
    padding: 2px;
  }

/*==========================================*/
  @media screen and (max-width: 992px){
    .btn-panel {
      top: 65px !important;
    }
    .sign .midd {
      padding: 25px 10px !important;
    }
    .img-index {
      margin: 10px auto;
    }
    .hero-section .wave {
      bottom: -200px;
    }
    .hero-section .iphone-wrap .phone-1 {
      width: auto;
      margin: 10px auto;
    }
    .hero-section .iphone-wrap .phone-2 {
      margin: 0;
      max-width: 100%;
      right: 0;
      top: 45px;
      left: unset;
      width: 300px;
    }
  }
  @media screen and (max-width: 768px){
    .post-entry > .post-title {
      top: 15%;
    }
    .hero-section .iphone-wrap .phone-2 {
      width: 190px;;
    }
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
                <li><a href="<?=base_url('lesson')?>" class="nav-link">Materi</a></li>
                <li><a href="<?=base_url('lesson/quiz')?>" class="nav-link">Latihan</a></li>
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
