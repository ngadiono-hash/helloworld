<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function myGlobal(){ ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">
	<script src="<?= base_url('assets/js/gl.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.all.min.js"></script>
<?php	}

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
<?php	}

function aceEditor(){ ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script>
	<script src="<?= base_url('assets/js/resize.js')?>"></script>
<?php }

function dataTable(){ ?>
	<link rel="stylesheet" href="https://cdn.datatables.net/v/ju-1.12.1/rr-1.2.4/datatables.min.css"/>
	<script src="https://cdn.datatables.net/v/ju/dt-1.10.18/rr-1.2.4/datatables.min.js"></script>
<?php	}

function ckEditor(){ ?>
	<script src="<?= base_url('assets/js/ckeditor/ckeditor.js') ?>"></script>
	<script src="<?= base_url('assets/js/ckeditor/adapters/jquery.js') ?>"></script>
<?php	}

function adminLte(){ ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/css/skin-blue.css') ?>">
	<script src="<?= base_url('assets/js/adminlte.js') ?>"></script>
<?php	}

function jqueryUi(){ ?>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php	}

function typing(){ ?>
	<script src="https://cdn.jsdelivr.net/npm/typeit@6.0.2/dist/typeit.min.js"></script>
<?php	}

// 404
function blank_page($status) { ?>
	<?php
	$currentURL = current_url();
	$params   = (!empty($_SERVER['QUERY_STRING'])) ? '?'.$_SERVER['QUERY_STRING'] : '';
	$fullURL = $currentURL.$params; 
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Hello World - <?=$status['title']?></title>
		<style>
		div {
			margin: 20px auto;
			text-align: center;
			font-family: sans-serif;
			width: 90vw;
		}
		img {
			width: 350px;
		}
		h1 {
			font-family: Stencil, Fantasy;
		}
	</style>
</head>
<body>
	<div>
		<img src="<?= base_url('assets/img/feed/').$status['image']; ?>">
		<h1><?=$status['message']?></h1>
		<?php if($status['title'] == '404' ) { ?>
			<h3>kamu mencoba untuk mengakses url <u><?=$fullURL?></u></h3>
			<h3>yang kemungkinan besar tidak tersedia pada server atau sedang dalam proses perbaikan</h3>
			<button onclick="window.history.back()"><h3>silahkan kembali</h3></button>
		<?php } ?>
	</div>
</body>
</html>
<?php }

function script_user(){ ?>
	<script>
		var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		}
		var loadricheditor = !(!!isMobile.any())
		let csrf = $('meta[name="csrf"]').attr('content');
		let userData;
		<?php if ( startSession('sess_id') ) { ?>
			userData = {
				'id' : '<?=getSession("sess_id") ?>',
				'ip' : '<?=getIp()?>',
				'username' : '<?=getSession("sess_user") ?>',
				'image' : '<?=getSession("sess_image") ?>'
			};
		<?php } else { ?>
			userData = {
				'id' : null,
				'ip' : '<?=getIp()?>',
				'username' : null,
				'image' : null
			};
		<?php } ?>
	</script>
<?php }

// LOADING PAGE
function loader(){ ?>
	<div class="preloader">
		<div class="loading center">
			<img src="<?= base_url('assets/img/feed/waiting.gif') ?>" alt="loading...">
			<h3>Loading...</h3>
			<noscript>Sorry... Your browser does not support JavaScript!</noscript>
		</div>
	</div>
<?php }


// ========= MAIN NAVBAR =======
function mainNav($code=[],$lesson=[]) { ?>
	<?php
	$main_page = whats_page(1,['','at','lesson','snippet']) && whats_page(2,['']);
	$lesson_page = whats_page(1,['lesson']) && whats_page(2,['html','css','javascript']) && whats_page(3,['']);
	$main_lesson = whats_page(1,['lesson']) && !whats_page(3,['']);
	$snippet_page = whats_page(1,['snippet']) && whats_page(2,['s']);
	?>
	<nav class="main-navbar box-sh">
		<?php if ( true ) { ?>
		<a href="<?= base_url() ?>">
			<span class="hidden-xs hidden-sm" style="font-family: 'Fredericka the Great'; font-size: 2em; letter-spacing: 5px;">HW</span>
			<span class="visible-xs visible-sm"><i class="fa fa-home"></i></span>
		</a>
		<?php } ?>
		<?php if ( $main_page ) { ?>
		<a class="nav-adjust" href="<?=base_url('lesson')?>">
			<span class="hidden-xs hidden-sm">Materi</span>
			<span class="visible-xs visible-sm"><i class="fa fa-book"></i></span>
		</a>
		<a class="nav-adjust" href="<?=base_url('snippet')?>">
			<span class="hidden-xs hidden-sm">Snippet</span>
			<span class="visible-xs visible-sm"><i class="fa fa-code"></i></span>
		</a>
		<?php } ?>
		<?php if ( $lesson_page ) { ?>
		<a href="<?=base_url('lesson')?>">
			<span><i class="fa fa-arrow-left"></i></span>
		</a>
		<a class="mini hidden-xs hidden-sm" href="<?=base_url('lesson/html')?>">
			<span><i class="fab fa-html5"></i></span>
		</a>
		<a class="mini hidden-xs hidden-sm" href="<?=base_url('lesson/css')?>">
			<span><i class="fab fa-css3-alt"></i></span>
		</a>
		<a class="mini hidden-xs hidden-sm" href="<?=base_url('lesson/javascript')?>">
			<span><i class="fab fa-js-square"></i></span>
		</a>
		<?php } ?>
		<?php if( $main_lesson ) { ?>
		<a style="width: 10vw" id="open-menu">
			<span><?= (!empty($lesson)) ? $lesson['level'] : '' ?></span>
		</a>
		<a style="width: 25vw" id="open-doc">
			<span><?= (!empty($lesson)) ? $lesson['titles'] : '' ?></span>
		</a>
		<?php if (check_admin()) { ?>
			<a class="mini" data-href="<?=base_url('a/tutorial/'.$lesson['category'].'/'.$lesson['order'])?>" id="edit-this">
				<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
				<span><i class="fa fa-edit"></i></span>
			</a>
			<a class="mini" style="display: none;" id="save-this" data-href="<?=base_url('xhra/inline_tutorial')?>">
				<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
				<span><i class="fa fa-save"></i></span>
			</a>
			<a class="mini" id="close-this" style="display: none;"><i class="fa fa-times"></i></a>
		<?php } ?>
		<?php } ?>
		<?php if ( $snippet_page ) { ?>
		<a class="mini" href="<?=base_url('snippet')?>">
			<span><i class="fa fa-arrow-left"></i></span>
		</a>
		<a class="mini" data-toggle="modal" data-target="#modal-info-snippet">
			<span><i class="fa fa-info-circle"></i></span>
		</a>
		<a style="width: 30vw" class="hidden-xs" data-toggle="modal" data-target="#modal-info-snippet">
			<span><?= (!empty($code)) ? $code['code_title'] : '' ?></span>
		</a>
		<a style="width: 10vw" class="hidden-xs hidden-sm">
			<span><?= (!empty($code)) ? $code['user_author'] : '' ?></span>
		</a>
		<?php } ?>

		<?php if (!startSession('sess_user')) { ?>
			<a class="pull-right right-nav" href="<?= base_url('at/sign') ?>">
				<span class="hidden-xs hidden-sm">Masuk</span>
				<span class="visible-xs visible-sm"><i class="fa fa-sign-in-alt"></i></span>
			</a>
		<?php } else { ?>
			<a class="pull-right right-nav" id="btn-nav">
				<i class="fa fa-user"></i>
			</a>
			<!-- <a class="pull-right mini">
				<span><i class="fa fa-bell"></i></span>
				<span class="notif-circle">1</span>
			</a> -->
		<?php } ?>
	</nav>
	<?php if(startSession('sess_id')) { ?>
		<div class="drop hide slide-in-left">
			<div class="drop-inside">
				<a class="pull-right nav-adjust right-nav" data-href="<?= base_url('at/logout') ?>" id="btn-logout" style="width: 2em">
					<i class="fa fa-power-off"></i>
				</a>
				<a class="pull-right nav-adjust" href="<?= base_url('u') ?>">
					<span class="hidden-xs hidden-sm">Dashboard</span>
					<span class="visible-xs visible-sm"><i class="fa fa-tachometer-alt"></i></span>
				</a>
				<?php if(getSession('sess_role') == 1) { ?>
					<a class="pull-right nav-adjust" href="<?= base_url('a') ?>">
						<span class="hidden-xs hidden-sm">Admin</span>
						<span class="visible-xs visible-sm"><i class="fa fa-key"></i></span>
					</a>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
<?php }

function signedNavbar($code=[]) { ?>
	<nav class="main-navbar inside box-sh">
		<?php if (!whats_page(2,['create','edit'])) { ?>
		<a class="" href="<?= base_url() ?>">
			<span class="hidden-xs hidden-sm">Beranda</span>
			<span class="visible-xs visible-sm"><i class="fa fa-home"></i></span>
		</a>
		<a class="hidden-xs hidden-sm" href="<?= base_url('u') ?>">
			<span class="hidden-xs hidden-sm">Dashboard</span>
			<span class="visible-xs visible-sm"><i class="fa fa-tachometer-alt"></i></span>
		</a>
		<a class="hidden-xs hidden-sm" href="<?= base_url('u/timeline') ?>">
			<span class="hidden-xs hidden-sm">Timeline</span>
			<span class="visible-xs visible-sm"><i class="fa fa-chart-line"></i></span>
		</a>
		<a class="pull-right mini right-nav visible-xs visible-sm" id="btn-nav">
			<i class="fa fa-bars"></i>
		</a>
		<a class="pull-right mini" data-href="<?= base_url('at/logout') ?>" id="btn-logout">
			<span><i class="fa fa-power-off"></i></span>
		</a>
		<?php } else { ?>
		<a href="<?= base_url('u') ?>">
			<span class=""><i class="fa fa-arrow-left"></i></span>
		</a>
		<a class="mini" data-toggle="modal" data-target="#modal-config-snip">
			<i class="fa fa-fw fa-cog"></i>
		</a>
		<a class="mini" id="submit-snippet">
			<img class="hide" src="<?= base_url('assets/img/feed/bars.svg') ?>" height="35">
			<span><i class="fas fa-save"></i></span>
		</a>
			<?php if(whats_page(2,['edit'])) { ?>
			<a data-href="<?=base_url("u/delete/".$code['code_id'])?>" class="mini" id="delete-snippet">
				<span><i class="fa fa-trash-alt"></i></span>
			</a>
			<a data-href="<?=base_url("snippet/p/".$code['code_id'])?>" class="mini" id="btn-full">
				<span><i class="fa fa-arrows-alt"></i></span>
			</a>
			<a style="width: 30vw" class="visible-md visible-lg"><span><?=$code['code_title']?></span></a>
			<?php } ?>
		<?php } ?>
		<?php if(getSession('sess_role') == 1) { ?>
			<a class="pull-right mini" href="<?=base_url('a')?>">
				<span><i class="fa fa-key"></i></span>
			</a>
		<?php } ?>
		<!-- <a class="pull-right mini">
			<span><i class="fa fa-bell"></i></span>
			<span class="notif-circle">1</span>
		</a> -->
		<?php if ( whats_page(1,['lesson']) ) { ?>
			<?php if( whats_page(2,['']) ) { ?>
				<a class="" href="<?= base_url('lesson') ?>">
					<span class="hidden-xs hidden-sm"><i class="fa fa-home"></i></span>
					<span class="visible-xs visible-sm"><i class="fa fa-home"></i></span>
				</a>
			<?php } else { ?>
				<a class="" href="<?= base_url('lesson') ?>">
					<span class="hidden-xs hidden-sm"><i class="fas fa-search"></i></span>
					<span class="visible-xs visible-sm"><i class="fas fa-search"></i></span>
				</a>
			<?php } ?>
			<a class="nav-adjust" href="<?=base_url('lesson/html')?>">
				<span class="hidden-xs hidden-sm">HTML</span>
				<span class="visible-xs visible-sm"><i class="fab fa-html5"></i></span>
			</a>
			<a class="nav-adjust" href="<?=base_url('lesson/css')?>">
				<span class="hidden-xs hidden-sm">CSS</span>
				<span class="visible-xs visible-sm"><i class="fab fa-css3-alt"></i></span>
			</a>
			<a class="nav-adjust" href="<?=base_url('lesson/javascript')?>">
				<span class="hidden-xs hidden-sm">JavaScript</span>
				<span class="visible-xs visible-sm"><i class="fab fa-js-square"></i></span>
			</a>
		<?php } elseif ( whats_page(1,['snippet']) ) { ?>
			<a href="<?= base_url('snippet') ?>"><i class="fa fa-home"></i></a>
			<?php if( whats_page(2,['s']) ) { ?>
				<a style="width: 30vw" class="hidden-xs" data-toggle="modal" data-target="#modal-info-snippet"><?=$code['code_title']?></a>
				<a class="mini" data-toggle="modal" data-target="#modal-info-snippet" data-keyboard="true">
					<i class="fa fa-info-circle"></i>
				</a>
			<?php } ?>
		<?php } ?>
	</nav>
	<div class="drop hide inside slide-in-left">
		<div class="drop-inside">
			<a class="mini pull-right" href="<?= base_url('u/profile') ?>">
				<span class="visible-xs visible-sm"><i class="fa fa-user"></i></span>
			</a>
			<a class="mini pull-right" href="<?= base_url('u/timeline') ?>">
				<span class="visible-xs visible-sm"><i class="fa fa-chart-line"></i></span>
			</a>
			<a class="mini pull-right" href="<?= base_url('u') ?>">
				<span class="visible-xs visible-sm"><i class="fa fa-tachometer-alt"></i></span>
			</a>
		</div>
	</div>	
<?php }

function mainFooter() { ?>
	<footer>
		<div class="container fred">
			<div class="row" style="padding-bottom: 20px;">
				<div class="col-xs-4">
					<div class="about-us">
						<h4><a href="#" class="base-link">Tentang kami</a></h4>
						<h4><a href="#" class="base-link">Kontak kami</a></h4>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="menus">
						<h4><a href="<?= base_url('lesson') ?>" class="base-link">Materi</a></h4>
						<h4><a href="<?= base_url('snippet') ?>" class="base-link">Snippet</a></h4>
					</div>
				</div>
				<div class="col-xs-4">
					<div class="search">
						<div class="search-inner center">
							<form action="" method="" autocomplete="on">
								<div class="search-group">
									<input type="text" name="search" class="hide" placeholder="Search...">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="copyright">
				<p>All Rights Reserved &copy; Hello World - 2019</p>
			</div>
		</div>
	</footer>
<?php }

// ========= USER PAGE =========
// =============================

function navbar($title) {	?>
	<header class="main-header">
		<a href="<?=base_url()?>" class="logo hidden-xs">
			<span class="logo-mini"><b class="fred">HW</b></span>
			<span class="logo-lg"><b>Hello</b> World</span>
		</a>
		<nav class="navbar navbar-static-top">
			<a class="sidebar-toggle" data-toggle="push-menu" role="button"><i class="fa fa-bars"></i></a>
			<a class="fred" style="color: #f1f1f1; display: inline-block; padding: 13px; font-size: 18px;"><span class="hidden-xs hidden-sm"><?= $title; ?></span></a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?= base_url('u') ?>"><i class="fa fa-fw fa-lg fa-tachometer-alt"></i></a>
					</li>
					<li class="">
						<a href="<?=base_url('u/notification')?>"><i class="fa fa-bell fa-lg fa-fw"></i>
							<span class="badge label-danger badge-bar">1</span>
						</a>
					</li>
					<li class="user-menu">
						<a href="<?= base_url('u/activity') ?>">
							<img src="<?= getSession('sess_image') ?>" class="user-image" alt="User Image">
							<span class="hidden-xs user-name fred"><?= getSession('sess_user') ?></span>
						</a>
					</li>
					<li>
						<a data-href="<?= base_url('at/logout') ?>" id="btn-logout"><i class="fa fa-fw fa-lg fa-power-off"></i></a>
					</li>
					<li>
						<a data-toggle="control-sidebar"><i class="fa fa-fw fa-lg fa-question-circle"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
<?php }

function sidebar() { ?>
	<aside class="main-sidebar">
		<section class="sidebar">
			<ul class="sidebar-menu" data-widget="tree">
				<?php if( getSession('sess_role') == 1 ) : ?>
					<li class="header">Administrator</li>
					<li class="treeview">
						<a>
							<i class="fas fa-fw fa-tachometer-alt"></i>
							<span>Chart</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?= base_url('a'); ?>"><i class="fas fa-fw fa-chart-pie"></i> Dashboard Chart</a></li>
						</ul>
					</li>

					<li class="treeview">
						<a>
							<i class="fa fa-fw fa-book"></i>
							<span>Table</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?= base_url('a/html'); ?>"><i class="fab fa-fw fa-html5"></i> Tutorial HTML</a></li>
							<li><a href="<?= base_url('a/css'); ?>"><i class="fab fa-fw fa-css3-alt"></i> Tutorial CSS</a></li>
							<li><a href="<?= base_url('a/javascript'); ?>"><i class="fab fa-fw fa-js-square"></i> Tutorial JS</a></li>
							<li><a href="<?= base_url('a/users'); ?>"><i class="fa fa-fw fa-users"></i> List Users </a></li>
							<li><a href="<?= base_url('a/cdn'); ?>"><i class="fa fa-fw fa-code"></i> List CDN </a></li>
							<!-- <li><a href="<?= base_url('a/deleted'); ?>"><i class="fa fa-fw fa-trash-alt"></i> Deleted Tutorial </a></li> -->
						</ul>
					</li>
					<li class="treeview">
						<a>
							<i class="fa fa-fw fa-cog"></i>
							<span>Config</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">

							<li><a href="<?= base_url('a/menus'); ?>"><i class="fa fa-fw fa-bars"></i> Menu Access </a></li>
						</ul>
					</li>
				<?php endif; ?>
				<li class="header" style="margin-top: 10px;">Member</li>
				<li class="treeview">
					<a>
						<i class="fas fa-fw fa-user"></i> <span>Dashboard</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?= base_url('u') ?>"><i class="fas fa-fw fa-tachometer-alt"></i> Beranda</a></li>
						<li><a href="<?= base_url('u/profile') ?>"><i class="fas fa-fw fa-user"></i> Profil Saya</a></li>
						<li><a href="<?= base_url('u/activity') ?>"><i class="fas fa-fw fa-chart-line"></i> Aktivitas Saya</a></li>
						<li><a href="<?= base_url('u/snippet') ?>"><i class="fas fa-fw fa-pencil-ruler"></i> Snippet Saya</a></li>
						<li><a href="<?= base_url('u/snippet/create') ?>"><i class="fas fa-fw fa-plus"></i> Buat Snippet</a></li>
					</ul>
				</li>
			</ul>
		</section>

	</aside>
<?php }

function temp_profile($user=[]) {	?>
	<div class="profile-box-fixed cubic box-sh" id="profile-box">
		<div style="margin: 5px">
			<a class="btn btn-default fred btn-block" href="<?=base_url('u/profile')?>"><i class="fa fa-edit"></i> edit</a>
		</div>
		<img class="profile-user-img img-thumbnail img-circle" src="<?=getSession('sess_image') ?>" alt="User Image">
		<h3 class="fred center"><?= $user['username'] ?></h3>
		<p class="center fred">
			<?php if ($user['role'] == '1') : ?>
				<span>Administrator</span>
				<?php else : ?>
					<span>Member</span>
				<?php endif; ?>
			</p>
			<p class="text-muted fred center">bergabung sejak <?=time_elapsed_string('@'.$user['register'])?></p>
		<div style="display: flex; margin-bottom: 10px;">
			<a title="progress belajarmu pada materi di Hello World" data-placement="bottom" class="btn tip tip-bottom btn-block fred btn-default"><i class="fa fa-book"></i> 20%</a>
			<a title="jumlah snippet yang kamu publikasikan" data-placement="bottom" class="btn tip tip-bottom btn-block fred btn-default"><i class="fa fa-code"></i> 3</a>
			<a title="jumlah komentar pada forum snippet" data-placement="bottom" class="btn tip tip-bottom btn-block fred btn-default"><i class="fa fa-comment-alt"></i> 3</a>
		</div>
			<p class="text-muted fred center"><?= (!empty($user['bio'])) ? '"'.$user['bio'].'"' : 'belum ada info tentang '.$user['username'] ?></p>
		</div>
	<?php }
// ========= EDITOR PAGE =======
// =============================

// MENU
	function _menus($lesson){ ?>
		<div class="menu-wrap">
			<div class="control">
				<span><a class="tip-bottom backTo fa fa-home" href="<?=base_url()?>"></a></span>
				<span><h4><?=$lesson['level']?></h4></span>
				<span><a class="tip-bottom closed-menu fa fa-times"></a></span>
			</div>
			<ul class="side-menu">
				<?php
				foreach ($lesson['menu'] as $list) {
					$menu_href 	= base_url('lesson/').$lesson['category'].'/'.$list['meta']; ?>
					<li><a class="tip-right link-menu" href="<?=$menu_href?>" title="<?=$list['slug']?>"><?=$list['title']?></a></li>
				<?php	} ?>
			</ul>
		</div>
	<?php }

// TOOLBAR
	function _toolEditor() { ?>
		<div id="jktoolbar" class="toolEditor">
			<ul>
				<li><a id="rowslayoutbutton" href="#rowslayout" class="tip-bottom fa fa-fw fa-laptop fa-lg" title="orientation"></a></li>
				<li><a href="#wrap" title="wrap lines" class="tip-bottom fa fa-fw fa-align-left fa-lg"></a></li>
				<li><a href="#shownumbers" title="line number" class="tip-bottom fa fa-fw fa-sort-numeric-down fa-lg"></a></li>
				<li><a href="#copycode" title="copy code" class="tip-bottom fa fa-copy fa-lg"></a></li>
				<li>
					<div class="tip-bottom select-style" title="interval run">
						<select>
							<option value="0">disable</option>
							<option selected value="0.25">0.25s</option>
							<option value="0.5">0.5s</option>
							<option value="1">1s</option>
							<option value="2">2s</option>
							<option value="3">3s</option>
						</select>
					</div>
				</li>
				<li><a href="#runcode" title="run code" class="tip-bottom fa fa-fw fa-play fa-lg"></a></li>
			</ul>
		</div>
	<?php }

// CODE-EDITOR
	function _codeEditor($lesson) { ?>
		<div id="jkcodeinput">
			<div id="jksourceCode"></div>
			<textarea id="jkregulartextarea" class="jkdefault" style="display: none;">
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/external-demo.css">
	<style>
	body {
		background-image: linear-gradient(<?= $lesson['tmLight'] ?>,#DDD);
		background-repeat: no-repeat;
	}
	.intro h1, .intro h2 { color: <?= $lesson['tmDark'] ?>; }
</style>
</head>
<body>
<div class="intro text-focus-in">
	<h1><?= $lesson['category'] ?></h1>
	<h2><?= $lesson['title'] ?></h2>
	<img src="<?= base_url('assets/img/feed/') . $lesson['logo'] ?>">
	<p>arahkan pointer mouse ke sebelah kiri layar untuk membuka dokumentasi</p>
</div>
</body>
</html>
		</textarea>
		<div id="jkdragbar"></div>
	</div>

	<div id="jkcodeoutput">
		<div class="container-window">
			<div class="row-window">
				<div class="column-window">
					<span class="dot" style="background:#ED594A;"></span>
					<span class="dot" style="background:#FDD800;"></span>
					<span class="dot" style="background:#5AC05A;"></span>
				</div>
				<input class="input-window" type="text" value="<?=base_url('lesson/').$lesson['category'].'/'.$lesson['meta']?>">
			</div>
		</div>
		<div id="dm"></div>
		<iframe id="jktargetCode"></iframe>
	</div>
<?php }

// MAIN DOCUMENTATION
function _mainContent($lesson) { ?>
	<div class="col-left visible-md visible-lg">
		<a class="close-col btn btn-def visible-sm visible-xs"><i class="fa fa-angle-double-left"></i></a>
		<div class="info-desc">
			<p><i class="fas fa-tachometer-alt"></i> kategori</p>
			<span><?= strtoupper($lesson['category']) ?></span>
			<p><i class="far fa-hand-point-right"></i> kelas</p>
			<span><?= $lesson['level'] ?></span>
			<p><i class="far fa-clock"></i> update</p>
			<span><?= time_elapsed_string('@'.$lesson['update']) ?></span>
		</div>
		<hr>
		<h4 class="second-title"><?= $lesson['titles'] ?></h4>
		<h4 class="second-title"><?= $lesson['title'] ?></h4>
		<hr>
		<div id="point"></div>
	</div>
	<div class="inner-desc">
		<div class="main-content">
			<div class="col-right">
				<?=	change_host($lesson['content']) ?>
				<div class="row main-footer">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="right-side box-sh">
							<p class="next-lesson sh" style="margin-bottom: 15px;">materi ini telah habis<br>selanjutnya belajar apa lagi</p>
							<button id="btn-next" class="button <?= $lesson['btn'] ?> jello-vertical"><i class="fas fa-question"></i></button>
							<div id="next" class="hide bounce-in-top" style="margin-top: 10px;">
								<?php if(!empty($lesson['next'])) { ?>
									<p><?= $lesson['next']['title'] ?></p>
									<a href="<?= base_url('lesson/').$lesson['category'].'/'.$lesson['next']['meta']; ?>" class="base-link"><?= $lesson['next']['slug']; ?></a>
								<?php } else { ?>
									<p>materi <?= $lesson['level']; ?> ini sudah habis</p>
									<a href="<?= base_url('lesson') ?>">silahkan kembali ke index</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<div>
					<?php echo $lesson['disqus'] ?>
				</div>
			</div>
		</div>
	</div>
<?php }
