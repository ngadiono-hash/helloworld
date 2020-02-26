<?php
// var_dump($_SESSION);
// var_dump($_COOKIE);
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
<meta name="author" content="Hello World">
<meta name ="revised" content ="Hello World, <?= date('m/d/Y',$lesson['update']) ?>">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/prism/prism-line.css">
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
<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">

<style type="text/css">
	.body-fixed {
		overflow-y: hidden;
	}
	.hero-section {
		background: linear-gradient(to right, rgba(39, 70, 133, 0.8) 0%, rgba(61, 179, 197, 0.8) 100%), url(<?=base_url()?>assets/img/feed/hero-bg.jpg);
		position: relative;
	}
	.hero-section .iphone-wrap .phone-1 {
		width: 450px;
		border-radius: 10px;
	}
	.panel-editor .splitter { 
		background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
	}
/*===================*/
	.code-toolbar {
	  max-width: 800px;
	  margin: 10px auto;
	  margin-bottom: 30px;
	  position: relative;
	}
	.execute {
	  font-size: .8em;
	  padding: 5px 10px !important;
	  transition: all ease 0.2s;
	  position: absolute;
	  top: 6px;
	  right: 12px;
	}
	.execute:hover {
	  background: linear-gradient(-45deg, #86dbe9, #27857e);
	}
	/*ADD*/
	.open-editor {
    position: fixed;
    cursor: pointer;
    background: #2d71a1;
    color: #fff;
    width: 44px;
    height: 44px;
    text-align: center;
    line-height: 1;
    font-size: 16px;
    border-radius: 50%;
    left: 15px;
    bottom: 15px;
    transition: background 0.5s;
    z-index: 11;
	}
	.open-editor i, .back-to-top i {
    color: #fff;
    position: absolute;
	}
	.open-editor i {
		top: 12px;
    right: 10px;
    font-size: 20px;
	}
	.back-to-top i {
    top: 8px;
	  left: 15px;
    font-size: 24px;
	}
	.lesson-menu a.active {
		color: #000;
		text-decoration: underline;
	}
	.blog-content {
		text-align: justify;
	}
	.blog-content p + pre {
		background: linear-gradient(45deg,#ddd,#d6c9c9);
		padding: 10px;
		max-width:90%;
		margin: 20px auto;
		border-radius: 10px;
	}
	.blog-content img {
		max-width: 70%;
		border-radius: 5px;
		border: 1px solid #dee2e6;
		padding: 5px;
		box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
	}
	.blog-content a[href^="http"], .blog-content a[href^="https"] {
		color: #007bff;
		font-weight: bold;
	}
</style>
</head>
<body>
	<div class="alert-auto">
		<h4 class="m-0"></h4>
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
								<li><a href="<?=base_url()?>contact" class="nav-link">Kontak</a></li>
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
