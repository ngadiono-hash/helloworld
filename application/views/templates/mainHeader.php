<?php
reload_session();
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
<link rel="icon" href="<?=base_url()?>assets/img/feed/favicon.ico">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Roboto"> -->
<link rel="stylesheet" href="<?=log?>roboto.css">
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> -->
<link rel="stylesheet" href="<?=log?>all.min.css">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?=log?>bootstrap.min.css">

<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/aos.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/owl.carousel.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/theme/theme.css">
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
<link rel="stylesheet" href="<?=log?>jquery-ui.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/prism/prism-line.css">

<link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">
<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
<?= $lesson_page ? '<link rel="stylesheet" href="'.base_url().'assets/css/js-lesson.css">' : ''; ?>

<style>
  .hero-section, .fluid-section {
    background: linear-gradient(to right, rgba(39, 70, 133, 0.8) 0%, rgba(61, 179, 197, 0.8) 100%), url(<?=base_url()?>assets/img/feed/hero-bg.jpg);
    position: relative;
  }
  .panel-editor .splitter {
    background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
  }
  .heading {
    font-weight: 700;
    background: linear-gradient(-45deg, #3db3c5, #274685);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  .speech h1, .speech h2, .speech h3, .speech h4 {
    color: #fff;
  }
  .speech {
    position: relative;
    background: #274685b0;
    border-radius: .4em;
    padding: 5px 10px;
    box-shadow: 4px -3px 5px 1px rgba(0,0,0,.5);
  }

  .speech:after {
    content: '';
    position: absolute;
    bottom: 0;
    width: 0;
    height: 0;
    border: 22px solid transparent;
    border-top-color: #274685b0;
    border-bottom: 0;
    border-left: 0;
    margin-left: -11px;
    margin-bottom: -22px;
  }
  .speech.right:after {
    left: 80%;
  }
  .stick {
    position: sticky;
    top: 85px;
  }
  .site-navbar .site-navigation .site-menu .has-children .dropdown {
    visibility: hidden;
    opacity: 1;
    top: 100%;
    right: 0;
    position: absolute;
    text-align: left;
    width: 275px;
    font-family: fantasy;
    box-shadow: 0 2px 10px -2px rgba(0, 0, 0, 0.1);
    padding: 0px 0px;
    margin-top: 10px;
    transition: 0.2s 0s;
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
            <h1 class="mb-0 site-logo">
            	<a href="<?=base_url()?>" class="mb-0">My Note</a>
            </h1>
          </div>
          <div class="col-12 col-md-10 d-none d-lg-block">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="<?=base_url('js/files')?>" class="nav-link">JavaScript</a></li>
                <!-- <li><a href="<?=base_url('js/qui')?>" class="nav-link">React</a></li> -->
                <!-- <li><a href="<?=base_url('js/uiz')?>" class="nav-link">Angular</a></li> -->
                <li><a href="<?=base_url('js/quiz')?>" class="nav-link">Quiz</a></li>
                <li class="has-children">
                  <a class="nav-link"><i class="fa fa-search"></i></a>
                  <ul class="dropdown">
                    <li>
                      <form id="search-form" class="search-form">
                        <div class="">
                          <span class="icon fa fa-search"></span>
                          <input type="text" class="form-control" placeholder="ketik Keyword dan tekan Enter">
                        </div>
                      </form>
                    </li>
                  </ul>
                </li>
                <?php if ( is_admin() ) { ?>
                <li><a href="<?=base_url()?>a" class="nav-link" target="_blank"><i class="fas fa-lg fa-recycle"></i></a></li>
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
