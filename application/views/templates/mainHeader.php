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
<?php myGlobalCss() ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
<?= $lesson_page ? '<link rel="stylesheet" href="'.base_url().'assets/css/blog.css">' : ''; ?>

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
    background: #274685;
    border-radius: .4em;
    padding: 5px 10px;
  }

  .speech:after {
    content: '';
    position: absolute;
    bottom: 0;
    width: 0;
    height: 0;
    border: 22px solid transparent;
    border-top-color: #274685;
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
            	<a href="<?=base_url()?>" class="mb-0" title="aaaaaa">My Note</a>
            </h1>
          </div>
          <div class="col-12 col-md-10 d-none d-lg-block">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="has-children">
                  <a class="nav-link">JavaScript</a>
                  <ul class="dropdown">
                    <li><a href="<?=base_url('js/beginner')?>" class="nav-link">JavaScript Dasar</a></li>
                    <li><a href="<?=base_url('js/medium')?>" class="nav-link">JavaScript Medium</a></li>
                    <li><a href="<?=base_url('js/advance')?>" class="nav-link">JavaScript Lanjutan</a></li>
                  </ul>
                </li>
                <li><a href="<?=base_url('js/quiz')?>" class="nav-link">Vue</a></li>
                <li><a href="<?=base_url('js/quiz')?>" class="nav-link">React</a></li>
                <li><a href="<?=base_url('js/quiz')?>" class="nav-link">Angular</a></li>
                <li><a href="<?=base_url('js/quiz')?>" class="nav-link">Node JS</a></li>
                <li><a href="<?=base_url('js/quiz')?>" class="nav-link">Quiz</a></li>
                <?php if (is_admin()) { ?>
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
