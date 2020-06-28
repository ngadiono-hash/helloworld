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
<link rel="stylesheet" href="<?=base_url()?>assets/css/blog.css">
<style>
/*internal*/
	.slide-out {
		z-index: 1200;
	}
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
  .hero-section .iphone-wrap .phone-2 {
    margin-top: 130px;
  }
  .hero-section.log > .container > .row {
    height: 100vh;
    min-height: 660px;
  }
/*=============== external global*/



/*================ external quiz*/
  table thead tr th {
    text-transform: capitalize;
    text-align: center;
    color: #808080;
    cursor: pointer;
    background-color: #f1f1f1;
  }
  table tbody tr td {
    text-align: center;
  }
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

	.back-link {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		z-index: 1;
	}
  .post-entry {
    position: relative;
    cursor: default;
    transition: all .4s ease;
    min-height: 300px;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
  }
  .post-entry > h4 {
  	text-align: center;
  }
  .post-entry > h3 {
    text-align: center;
    top: 10%;
    left: 50%;
    font-weight: bold;
    color: #f0dc3f;
    text-shadow: 2px 2px 4px rgba(0,0,0.4);
  }
  .post-entry:hover {
  	box-shadow: 2px 2px 7px rgba(0,0,0.7);
 	}

/*================ external lesson */





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
  }
  @media screen and (max-width: 768px){
    .post-entry > .post-title {
      top: 15%;
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
                    <li><a href="<?=base_url('js/advanced')?>" class="nav-link">JavaScript Lanjutan</a></li>
                  </ul>
                </li>
                <li><a href="<?=base_url('lesson/quiz')?>" class="nav-link">Vue</a></li>
                <li><a href="<?=base_url('lesson/quiz')?>" class="nav-link">React</a></li>
                <li><a href="<?=base_url('lesson/quiz')?>" class="nav-link">Angular</a></li>
                <li><a href="<?=base_url('lesson/quiz')?>" class="nav-link">Node JS</a></li>
                <li><a href="<?=base_url('lesson/quiz')?>" class="nav-link">Quiz</a></li>
                <?php if (is_admin()) { ?>
                <li><a href="<?=base_url()?>a" class="nav-link"><i class="fas fa-lg fa-recycle"></i></a></li>
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
