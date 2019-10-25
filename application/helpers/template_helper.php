<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ========= ALL PAGE ==========
// =============================

// TEMPLATE HEADER
function myGlobal(){ ?>
	<link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">
	<script src="<?= base_url('assets/js/global.js') ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.5.0/dist/sweetalert2.all.min.js"></script>
<?php	}

function adminCss(){ ?>

<?php }
function adminJs(){ ?>

<?php }
function userCss(){ ?>

<?php }
function userJs(){ ?>

<?php }
function snipCss(){ ?>
	
<?php }
function snipJs(){ ?>
	
<?php }

function selectBS(){ ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
	<!-- <script src="<?=base_url('assets/js/jquery.chained.js')?>"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-chained/1.0.1/jquery.chained.min.js"></script>
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
	<link rel="stylesheet" href="<?= base_url('assets/css/AdminLTEe.css') ?>">
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
	<!DOCTYPE html>
	<html>
	<head>
		<title>Hello World - <?=$status['title']?></title>
	<style>
		div {
			margin: 20px auto;
			text-align: center;
			line-height: 15vh;
		}
		img{
	    width: 350px;
		}
		h1{
			font-family: Stencil, Fantasy; 
		}
	</style>
	</head>
	<body>
		<div>
			<img src="<?= base_url('assets/img/feed/').$status['image']; ?>">
			<h1><?=$status['message']?></h1>
		</div>
	</body>
	</html>
<?php }

function script_user(){ ?>
	<script>
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
		<div class="loading">
			<img src="<?= base_url('assets/img/feed/waiting.gif') ?>" alt="loading...">
			<h3 class="center">Loading...</h3>
		</div>
	</div>
<?php }
 

// ========= MAIN NAVBAR =======
function mainNav($code=[]) { ?>
<div class="main-navbar box-sh">
	<?php if (whats_page(1,['','at','snippet','lesson']) && !whats_page(2,['s'])) { ?>
	<a class="" href="<?= base_url() ?>">
		<span class="hidden-xs hidden-sm">Home</span>
		<span class="visible-xs visible-sm"><i class="fa fa-home"></i></span>
	</a>
	<a class="nav-adjust" href="<?=base_url('lesson')?>">
		<span class="hidden-xs hidden-sm">Pelajaran</span>
		<span class="visible-xs visible-sm"><i class="fa fa-book"></i></span>
	</a>
	<a class="nav-adjust" href="<?=base_url('snippet')?>">
		<span class="hidden-xs hidden-sm">Snippet</span>
		<span class="visible-xs visible-sm"><i class="fa fa-code"></i></span>	
	</a>
	<a class="nav-adjust" href="#">
		<span class="hidden-xs hidden-sm">Artikel</span>
		<span class="visible-xs visible-sm"><i class="fa fa-file"></i></span>		
	</a> 
	<?php } elseif (whats_page(1,['snippet']) && whats_page(2,['s'])) { ?>
	<a href="<?= base_url('snippet') ?>"><i class="fa fa-arrow-left"></i></a>
	<a style="width: 30vw" class="hidden-xs"><?=$code['code_title']?></a>
	<a id="like-this" class="mini"><i class="fa fa-thumbs-up"></i></a>
	<a id="open-comment" class="mini"><i class="fa fa-comment-alt"></i></a>
	<?php } ?>
	<?php if (!startSession('sess_user')) { ?>
	<?php if (!whats_page(2,['sign'])) { ?>
	<a class="pull-right right-nav" href="<?= base_url('at/sign') ?>">
		<span class="hidden-xs hidden-sm">Login</span>
		<span class="visible-xs visible-sm"><i class="fa fa-sign-in-alt"></i></span>		
	</a>
	<?php } ?>
	<?php } else { ?>
	<a class="pull-right right-nav" id="btn-nav"><i class="fa fa-user"></i></a>
	<div class="drop hide slide-in-left">
		<a class="pull-right" data-href="<?= base_url('at/logout') ?>" id="btn-logout" style="width: 2em"><i class="fa fa-power-off"></i></a>
		<a class="pull-right" href="<?= base_url('u') ?>" style="width: 2em"><i class="fa fa-tachometer-alt"></i></a>
	</div>
	<?php } ?>
</div>
<?php }


function mainFooter() { ?>
	<footer>
		<div class="container fred">
			<div class="row" style="padding-bottom: 20px;">
				<div class="col-sm-4">
					<div class="about-us">
						<h4><a href="#" class="base-link">Tentang kami</a></h4>
						<h4><a href="#" class="base-link">Kontak kami</a></h4>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="menus">
						<h4><a href="<?= base_url('lesson') ?>" class="base-link">Pelajaran</a></h4>
						<h4><a href="<?= base_url('snippet') ?>" class="base-link">Snippet Program</a></h4>
						<!-- <h4><a href="<?= base_url('javascript') ?>" class="base-link">JavaScript</a></h4> -->
					</div>
				</div>
				<div class="col-sm-4">
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

function navbar($title) {
	$CI = get_instance();
	$CI->load->model('Read_model');
	$user = $CI->Read_model->getDataUser();
	$cekNotif = $CI->Read_model->getNewNotif();
	$countNotif = [];
	if($cekNotif['c'] == 1 || $cekNotif['l'] == 1 || $cekNotif['s'] == 1){
		$com  = $CI->Read_model->countNotifCom();
		$like = $CI->Read_model->countNotifLike();
		$sec  = $CI->Read_model->countNotifSec(['user' => $user['email'], 'status' => 1]);	
		$countNotif = [
			'all' => $com + $sec + $like
		];
	}

	$badge = ($countNotif['all'] > 0) ? $countNotif['all'] : '';
	?>
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
							<span class="badge label-danger badge-bar"><?=$badge?></span>
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

function side_notification($countNotif,$contentNotif){ ?>
	<div class="side-notification box-sh hide slide-out-left">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a class="text-muted" href="#tab1" data-toggle="tab" aria-expanded="true"><i class="fa fa-comment-alt text-primary"></i> komentar <?=($countNotif['comment'] != 0) ? '<span class="badge label-danger">'.$countNotif['comment'].'</span>' : '' ?></a>
				</li>
				<li class="">
					<a class="text-muted" href="#tab2" data-toggle="tab" aria-expanded="false"><i class="fa fa-thumbs-up text-primary"></i> suka <?=($countNotif['like'] != 0) ? '<span class="badge label-danger">'.$countNotif['like'].'</span>' : '' ?></a>
				</li>
				<li class="">
					<a class="text-muted" href="#tab3" data-toggle="tab" aria-expanded="false"><i class="fa fa-exclamation-triangle text-danger"></i> system <?=($countNotif['security'] != 0) ? '<span class="badge label-danger">'.$countNotif['security'].'</span>' : '' ?></a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<ul class="content-notification">
					<?php
						foreach ($contentNotif['comment'] as $k => $v) { ?>
							<li>
								<a href="<?=base_url('snippet/s/').$v['id']?>"></a>
								<img class="custom-image" src="<?=base_url('assets/img/profile/').$v['image']?>">
									<span class="fred"><?=$v['post']?></span><br>
									<?php if ($v['author'] == getSession('sess_id')) { ?>
									<span><?=$v['commentator']?> menambahkan sebuah komentar</span><br> 
									<?php } else { ?>
									<span><?=$v['commentator']?> membalas komentar kamu</span><br>
									<?php } ?>
									<small class=""><?=time_elapsed_string('@'.$v['created'])?></small>
							</li>
					<?php	}
					?>
					</ul>
				</div>
				<div class="tab-pane" id="tab2">
					<ul class="content-notification">
					<?php
						foreach ($contentNotif['like'] as $k => $v) { ?>
							<li>
								<a href="<?=base_url('snippet/s/').$v['id']?>"></a>
								<img class="custom-image" src="<?=base_url('assets/img/profile/').$v['image']?>">
									<span class="fred"><?=$v['post']?></span><br>
									<span><?=$v['liker']?> menyukai postingan kamu</span><br> 
									<small class=""><?=time_elapsed_string('@'.$v['created'])?></small>
							</li>
					<?php	}
					?>
					</ul>				
				</div>
				<div class="tab-pane" id="tab3">
					<ul class="content-notification">
					<?php
						foreach ($contentNotif['security'] as $k => $v) { ?>
							<li>
								<a href=""></a>
									<i class="fa fa-exclamation-triangle text-danger"></i>
									<span>Aktifitas login mencurigakan</span><br>
									<small class=""><?=time_elapsed_string('@'.$v['created'])?></small>
							</li>
					<?php	}
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
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

function temp_profile(){
	$userLog = fetch_data();
	$gender = $userLog['u_gender'];
	$icon   = ($gender == 'Laki-laki') ? 'fa-mars' : 'fa-venus';
	$bio	  = $userLog['u_bio'];
	$reg		= $userLog['u_register'];
	?>
	<div class="profile-box-fixed hidden-xs hidden-sm">
		<div class="box box-sh">
			<div class="box-body">
				<img class="profile-user-img img-responsive img-circle" src="<?= getSession('sess_image') ?>" alt="User Image">
				<h3 class="fred center"><?= '<i class="fa '.$icon.'"></i> '.getSession('sess_user') ?></h3>
				<p class="text-muted text-center fred">
				<?php if (getSession('sess_role') == '1') : ?>
					<span>Administrator</span>
				<?php else : ?>	
					<span>Member</span>
				<?php endif; ?>					
				</p>
				<p class="text-muted center">bergabung sejak <?=time_elapsed_string('@'.$reg)?></p>
				<p class="text-muted center"><?= ($bio) ? '"'.$bio.'"' : 'belum ada info tentang '.getSession('sess_user') ?></p>
				<p class="edit center"><a class="base-link" href="<?= base_url('u/profile') ?>">Edit Profile</a></p>
			</div>
		</div>
	</div>
<?php }
// ========= EDITOR PAGE =======
// =============================

// MENU
function _menus($menu,$level,$category){ ?>
	<div class="menu-wrap">
		<div class="control">
			<span><a class="tip-bottom backTo fa fa-home" href="<?=base_url()?>" title="back to home"></a></span>
			<span><h4><?=$level?></h4></span>
			<span><a class="tip-bottom closed-menu fa fa-times" title="close menu"></a></span>
		</div>
		<ul class="side-menu">
		<?php	
			foreach ($menu as $list) {
			$menu_href 	= base_url('lesson/').$category.'/'.$list['meta']; ?>
			<li><a class="tip-right link-menu" href="<?=$menu_href?>" title="<?=$list['slug']?>"><?=$list['title']?></a></li>
			<?php	} ?>
		</ul>
	</div>
<?php }

// TOOLBAR
function _toolEditor() { ?>
	<div id="jktoolbar" class="toolEditor">
		<div class="wrap-btn">
			<a class="tip-bottom open-menu" title="open menu">
				<i class="fa fa-fw fa-bars fa-lg"></i>
			</a>			
		</div>
		<ul>
			<li><a id="rowslayoutbutton" href="#rowslayout" class="tip-bottom fa fa-fw fa-laptop fa-lg" title="orientation"></a></li>
			<li><a href="#wrap" title="wrap lines" class="tip-bottom fa fa-fw fa-align-left fa-lg"></a></li>
			<li><a href="#shownumbers" title="line number" class="tip-bottom fa fa-fw fa-sort-numeric-down fa-lg"></a></li>
			<li><a href="#runcode" title="run code" class="tip-bottom fa fa-fw fa-play fa-lg"></a></li>
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
			<li><a href="#copycode" title="copy code" class="tip-bottom fa fa-copy fa-lg"></a></li>
		</ul>
	</div>
<?php }

// CODE-EDITOR
function _codeEditor($code,$tmLight,$tmDark,$category,$title,$logo,$meta) { ?>
	<div id="jkcodeinput"> 
		<div id="jksourceCode"></div>
<textarea id="jkregulartextarea" class="jkdefault" style="display: none;">		
<?php
if(isset($code)) {
	if($code != '') {
		showCode($code);
	}	else {
		defaultCode($tmLight,$tmDark,$category,$title,$logo);
	} 
} ?>
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
				<input class="input-window" type="text" value="<?=base_url('lesson/').$category.'/'.$meta?>">
			</div>
		</div>
		<div id="dm"></div>
		<iframe id="jktargetCode"></iframe>
	</div>		
<?php }

// MAIN DOCUMENTATION
function _mainContent($id,$order,$title,$titles,$level,$category,$content,$update,$next,$btn) { ?>
	<div class="col-left visible-md visible-lg">
		<div class="info-desc">
			<p><i class="fas fa-tachometer-alt"></i> kategori</p>
			<span><?= strtoupper($category) ?></span>
			<p><i class="far fa-hand-point-right"></i> kelas</p>
			<span><?= $level ?></span>
			<p><i class="far fa-clock"></i> update</p>
			<span><?= time_elapsed_string('@'.$update) ?></span>
		</div>
		<hr>
		<h4 class="second-title"><?= $title ?></h4>
		<hr>		
		<div id="point"></div>
	</div>
	<div class="inner-desc">
		<div class="main-content">
			<?php 
				if ( startSession('sess_role') ) :
					if ( getSession('sess_role') == 1 ) :
						echo '<a href="' . base_url('a/tutorial/') . strtolower($category) . '/' . $order .'" target="_blank" class="button btn-admin" ><i class="fa fa-cog"></i></a>';
					endif;
				endif;
			?>
			<h1 class="main-title sh"><?= $titles; ?></h1>

			<div class="col-right">
			<?php 
				if($content != '') {
					showDoc($content);
					footerDoc($id,$next,$category,$level,$btn);		
				} else {
					emptyDoc();
				}
			?>
			</div>
		</div>
	</div>
<?php }

// ========= HELPER EDITOR =====
// =============================
// TEMPLATE CODE
function showCode($code) {
	$newCode = change_host($code);
echo $newCode;
}

function defaultCode($tmLight,$tmDark,$category,$title,$logo) { ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/external-demo.css">
	<style>
		body { 
			background-image: linear-gradient(<?= $tmLight ?>,#DDD); 
			background-repeat: no-repeat;
		}
		.intro h1, .intro h2 { color: <?= $tmDark ?>; }
	</style>
</head>
<body>
	<div class="intro">
		<h1 class="text-focus-in"><?= $category; ?></h1>
		<h2 class="text-focus-in"><?= $title; ?></h2>
		<img class="bounce-in-top" src="<?= base_url('assets/img/feed/') . $logo; ?>">
		<p>arahkan pointer mouse ke sebelah kiri layar untuk membuka dokumentasi</p>
	</div>
</body>
</html>
<?php }

// TEMPLATE CONTENT
function showDoc($content) {
	$newContent = change_host($content);
	echo $newContent;	
}

function emptyDoc() { ?>
	<h1>Maaf...</h1>
	<h2>Materinya belum siap nih...</h2>
	<div class="center">
		<img class="img-feed" style='width: 400px; margin: 20px auto; display: block;' src="<?= base_url('assets/img/feed/maaf.gif') ?>" alt="sorry">
	</div>
<?php }

function footerDoc($id,$next,$category,$level,$btn) { ?>
	<div class="row main-footer">
		<div class="col-lg-12">
			<div class="right-side box-sh">
				<p class="next-lesson sh" style="margin-bottom: 15px;">materi ini telah habis<br>selanjutnya belajar apa lagi</p>
				<button id="btn-next" class="button <?= $btn; ?> jello-vertical"><i class="fas fa-question"></i></button>
				<div id="next" class="hide bounce-in-top" style="margin-top: 10px;">	
					<?php if(isset($next)) { ?>
					<p><?= $next['title'] ?></p>
					<a href="<?= base_url('lesson/').$category.'/'.$next['meta']; ?>" class="base-link"><?= $next['slug']; ?></a>
					<?php } else { ?>
						<p>materi <?= $level; ?> ini sudah habis</p>
						<a href="<?= base_url().'#lesson' ?>">silahkan kembali ke index</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php }
