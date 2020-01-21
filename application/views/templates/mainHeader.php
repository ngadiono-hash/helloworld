<?php
reload_session();
$home_page = whats_page(1,['','at']);
$snippet_page = whats_page(1,['snippet']) || whats_page(3,['snippet']);
$lesson_page = whats_page(1,['lesson']) && !empty($this->uri->segment(3));
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
	<?php }
	bootstrap();
	selectBS();
	if ($home_page) typing();
	if ($snippet_page) aceEditor().select2();
	if ($lesson_page) aceEditor();
	if ($lesson_page && check_admin()) ckEditor();
	myGlobal();
	?>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredericka+the+Great|Lobster">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One|PT+Sans">
	<link rel="stylesheet" href="<?=base_url('assets/prism-line.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.flipster.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.flipster.min.css')?>">
	<script src="<?=base_url('assets/js/jquery.flipster.min.js')?>"></script>
	<style>
		section, main { background-image: url("<?=base_url('assets/img/feed/login.jpg')?>"); }
		article.lesson { background-image: url("<?=base_url('assets/img/feed/designs.png')?>"); }
		article.index-snippet { background-image: url("<?=base_url('assets/img/feed/snippet.png')?>"); }
		.splitter { background: url("<?=base_url('assets/img/feed/splitter.png')?>")  center center no-repeat #aaa5a5; }
	
	/*============ NAVBAR =========*/
		.main-navbar {
			position: sticky;
			z-index: 999;
			height: 2.500em;
			padding: 0;
			margin: 0;
			overflow: hidden;
		}
		.main-navbar { 
			top: 0; 
			width: 100%;
			background: #808080;
		}
		.drop { 
			z-index: 999;
			position: sticky; top: 50px;
		}
		.drop-inside {
			position: absolute; 
			right: 0; 
			overflow: hidden; 
			width: 100%;
		}
		.main-navbar > a, .drop a {
			position: relative;
			display: block;
			float: left;
			font-family: 'Fredoka One', cursive;
			margin-right: 1.563em;
			height: 100%;
			width: 6.25em;
			cursor: pointer;
			user-select: none;
			background: #337ab7;
			color: #f1f1f1;
			text-align: center;
			line-height: 2.5em;
		}
		.drop.inside > a,.main-navbar.inside > a {
			background: #aaa;
		}
		.main-navbar > a::before, .drop a::before {
			content: '';
			position: absolute;
			display: block;
			left: -1.5em;
			width: 0;
			height: 0;
			border-top: 2.5em solid transparent;
			border-right: 1.563em solid #337ab7;
		}
		.main-navbar > a::after, .drop a::after {
			content: '';
			position: absolute;
			display: block;
			top: 0;
			right: -1.5em;
			width: 0;
			height: 0;
			border-top: 2.5em solid #337ab7;
			border-right: 1.563em solid transparent;
		}
		.drop.inside > a::after,.main-navbar.inside > a::after {
			border-top: 2.5em solid #aaa;
		}
		.drop.inside > a::before,.main-navbar.inside > a::before {
			border-right: 1.563em solid #aaa;
		}
		.main-navbar > a:hover, .drop a:hover {
			color: #666;
			background: #CCC;
			transition: none;
		}
		.main-navbar > a:hover::after, .drop a:hover::after {
			border-top: 2.5em solid #CCC;
			border-right: 1.563em solid transparent;
		}
		.main-navbar > a:hover::before, .drop a:hover::before  {
			border-top: 2.5em solid transparent;
			border-right: 1.563em solid #CCC;
		}

		.main-navbar > a.active, .drop a.active {
			color: #635f5f;
			background: #DDD;
		}
		.main-navbar > a.active::after, .drop a.active::after {
			border-top: 2.5em solid #DDD;
			border-right: 1.563em solid transparent;
		}
		.main-navbar > a.active::before, .drop a.active::before {
			border-top: 2.5em solid transparent;
			border-right: 1.563em solid #DDD;
		}
		.main-navbar .right-nav, .drop .right-nav {
			margin-right: 0;
		}
		.main-navbar .right-nav.open {
			width: 2em;
		}
		.main-navbar > a.mini, .drop a.mini {
			width: 2em;
		}
		
		.notif-circle {
			position: absolute;
			left: -8px;
			top: 0px;
			width: 25px;
			height: 25px;
			font-size: 13px;
			line-height: 2;
			color: #fff;
			background-color: #e42424;
			border-radius: 50%;
		}

	/*============ ALL ============*/
		body {
			background: linear-gradient(135deg, #f5f5f5, #000000ab);
			position: relative;
			color: #808080;
			font-family: 'PT Sans', Sans-serif;
			cursor: default;
			font-size: 18px;
			min-height: 100vh;
		}
		.overlay {
			position: fixed;
			width: 100%;
			height: 100%;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(0,0,0,0.3);
			z-index: 12;
		}
		.tip + .tooltip .tooltip-inner {
			background: #f1f1f1;
			color: #808080;
			padding: 5px;
			font-size: 14px;
			border: 2px solid gray;
			font-family: 'PT Sans', Sans-serif;
			min-width: 125px;
		}

		.tip + .tooltip.bottom .tooltip-arrow {
			border-bottom: 5px solid gray;
		}
		/*.tip + .tooltip.right .tooltip-arrow {
			border-bottom: 5px solid gray;
		}*/

		.mytooltip {
			border-radius: 5px !important;
			background-color: #f1f1f1;
			color: #808080 !important;
			padding: 5px;
			margin: 50px;
			text-align: center;
			font-size: 14px;
			border: 2px solid gray !important;
			min-width: 125px;
			max-width: 400px;
			font-family: 'PT Sans', Sans-serif;
		}

		.mytooltip:after {
			background: #f1f1f1;
			bottom: 26px;
			color: #808080;
			content: attr(title);
			right: 20%;
			padding: 5px;
			position: absolute;
			z-index: 888;
		}

		.mytooltip:before {
			bottom: 10px;
			content: "";
			right: 50%;
			position: absolute;
			z-index: 999;
		}
		.bg {
			position: absolute;
			top: 10px;
			bottom: 10px;
			left: 10%;
			right: 10%;
			z-index: -1;
		}
		.bg.main {
			background: steelblue;
		}
		.bg.signed {
			background: #aaa;
		}
		.cubic {
			background: #f1f1f1;
			border: 3px solid #808080;
			border-radius: 0;
			border-top-right-radius: 15px;
			border-bottom-left-radius: 15px;
		}
		.cubic:hover {
			background: linear-gradient(45deg, #eee, #d9edf7);
			transition: .3s ease-in-out;
		}
		.errors .text-danger {
			font-size: 16px;
			margin-left: 10px;
		}
		label {
			font-family: 'Fredoka One', cursive;
			letter-spacing: 1px;
		}
		section {
			background-size: cover;
			background-attachment: fixed;
		}
		article {
			background-size: cover;
			background-attachment: fixed;
			padding: 100px 0;
			margin-top: -45px;
			min-height: 80vh;
		}
		article h1, article h3 {
			text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
			color: #f5efef;
			font-family: 'Fredoka One', cursive;
			text-align: center;
		}
		a.hidden-link {
			position: absolute;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: 1;
		}
		.effect.lg span {
			padding: 5px 25px;
		}
		section.sub-page {
			padding: 5px;
			text-align: center;
		}
		.btn-block+.btn-block {
			margin-top: 0px; 
		}
		.search-box {
			justify-content: center!important;
			height: 100%!important;
			display: flex!important;
			padding: 30px;
		}
		.search_bar{
			margin-bottom: auto;
			margin-top: auto;
			height: 60px;
			background-color: #353b48;
			border-radius: 30px;
			padding: 10px;
		}

		.search_input{
			color: white;
			border: 0;
			outline: 0;
			background: none;
			width: 0;
			caret-color:transparent;
			line-height: 40px;
			transition: width 0.4s linear;
		}

		.search_bar:hover > .search_input{
			padding: 0 10px;
			width: 450px;
			caret-color:red;
			transition: width 0.4s linear;
		}

		.search_bar:hover > .search_icon{
			background: white;
			color: #e74c3c;
		}

		.search_icon{
			height: 40px;
			width: 40px;
			float: right;
			display: flex;
			justify-content: center;
			align-items: center;
			border-radius: 50%;
			color:white;
			text-decoration:none;
		}
		.panel {
			position: relative;
		}
		.panel p {
			white-space: pre-line;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		.panel .title { 
			font-size: 1.5em;
			padding: 10px;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			margin: 0;
		}
		.panel h4 { margin: 0; margin-bottom: 5px; }
		.panel h4 a {
			padding: 5px 0;
			color: lightblue;
			font-family: 'Fredoka One', cursive;
			text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
		}
		.small-box {
			position: relative;
			padding: 10px;
			margin-bottom: 10px;
		}
		.icon i {
			position: absolute;
			top: 0;
			right: 10px;
			font-size: 5em;
		}
		.modal-dialog {
			width: 800px;
		}
		.bootstrap-select .dropdown-toggle:focus { outline: none !important; }
		.bootstrap-select button {
			border-radius: 4px !important;
			border: 2px solid gray !important;
			margin-top: 2px;
			padding: 10px;
			font-family: 'PT Sans', sans-serif;
			font-size: 18px;
			color: #808080 !important;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__choice {
			position: relative;
			background-color: #e4e4e4;
			border: 1px solid #aaa;
			border-radius: 4px;
			cursor: default;
			margin-right: 5px;
			margin-top: 5px;
			padding: 5px;
			padding-left: 25px;
			padding-right: 10px;
			color: dimgray;
			font-family: 'Fredoka One', cursive;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
			color: #999;
			cursor: pointer;
			font-weight: bold;
			padding: 4px 6px;
			position: absolute;
			top: 0;
			left: 0;
			bottom: 0;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
			background-color: burlywood;
		}
		.select2-container--default .select2-selection--multiple {
			background-color: white;
			border: 2px solid #808080;
			border-radius: 4px;
			cursor: pointer;
		}
		.select2-container--default.select2-container--focus .select2-selection--multiple {
			border: 2px solid !important;
			border-color: #808080 !important;
		}
		input.input-adjust:hover,textarea.input-adjust:hover,select.input-adjust:hover,
		input.input-adjust:focus,textarea.input-adjust:focus,select.input-adjust:focus {
			background: white;
		}
		.input-adjust.text-area {
			min-height: 75px;
		}
		#frame-full {
			position: fixed;
			top: 0;
			width: 100%;
			height: 100%;
			border: none;
			z-index: 1050;
		}
		.close-frame {
			position: fixed;
			top: 10px;
			right: 15px;
			z-index: 1051;
		}

		.dropdown-menu {
			padding: 5px;
			font-size: 16px;
		}
		.dropdown-menu > li > a {
			padding: 5px;
		}

	/*============ SIGN ================*/
		.input-reg:focus {
			border: 2px solid #449D44;
			background: lightgreen;
		}
		.input-log:focus {
			border: 2px solid #3980be;
			background: lightblue;
		}
		#form-login .form-group, #form-register .from-group, #form-change .form-group {
			margin-bottom: 10px;
			position: relative;
		}
		#form-login {
			padding: 40px 50px;
		}
		#form-register {
			padding: 32px 20px;
		}
		#form-reset {
			padding: 100px 50px;
		}
		#form-change {
			padding: 80px 50px;
		}
		#form-login label, #form-register label, #form-reset label, #form-change label {
			display: inline-block;
			max-width: 100%;
			margin-bottom: 0px;
			font-weight: 1000;
			margin-left: 20px;
			transition: linear 0.4s;
			color: #ccc;
		}
		#form-login #error p, #form-register #error p, #form-reset #error p, #form-change #error p {
			margin-left: 20px;
			font-size: 13px;
			color: lightcoral;
			margin-top: 10px;
		}

		.login .border, .reset .border, .change .border {
			border-right: 5px solid #3535D3;
			min-height: 89vh;
		}
		.register .border {
			border-right: 5px solid #449D44;
			min-height: 89vh;
		}
		.wrapper-sign {
			min-height: 92.8vh;
			padding: 10px 0;
			position: relative;
		}
		.login, .register, .reset, .change {
			min-height: 90vh;
		}
		.info-login, .info-register, .info-reset, .info-change {
			text-align: center;
			font-size: 0.9em;
			color: #f1eded;
			padding: 20px 0;
		}
		.info-reset {
			text-align: left;
		}
		.info-login h1, .info-register h1, .info-reset h1, .info-change h1 {
			letter-spacing: 2px;
		}
		.info-login p, .info-login li, .info-reset li, .info-change p, .info-change li {
			font-family: 'Fredoka One', cursive;
			font-size: 1.5em;
			line-height: 1.5;
		}
		.info-change li {
			text-align: left;
		}

		.info-login h1, .info-login p, .info-reset h1, .info-reset li, .info-change h1, .info-change p, .info-change li  {
			text-shadow: -1px -1px 0 #3980BE, 1px -1px 0 #3980BE, -1px 1px 0 #3980BE, 1px 1px 0 #3980BE;
		}

		.info-register h1, .info-register p {
			text-shadow: -1px -1px 0 #449D44, 1px -1px 0 #449D44, -1px 1px 0 #449D44, 1px 1px 0 #449D44;
		}

		.register.off {
			display: none;
		}
		.login.off{
			display: none;
		}

		.btn-log, .btn-reg, .btn-reset, .btn-change {
			width: 200px;
			font-size: 16px;
			letter-spacing: 2px;
			margin-top: 15px;
			height: 55px;
			line-height: 0;
		}
		.btn-log img, .btn-reg img, .btn-reset img, .btn-change img {
			margin: -15px 0;
		}
		.button.disabled, .button[disabled] {
			cursor: not-allowed;
			opacity: 0.5;
			border: none;
			pointer-events: none;
		}
		.wrapper-sign .social { min-width: 200px; }
		.back {
			position: absolute;
			bottom: 10px;
			left: -5px;
		}
		input.input-text:-webkit-autofill {
			-webkit-animation-name: autofill;
			-webkit-animation-fill-mode: both;
		}
		@-webkit-keyframes autofill {
			to {
				color: #fff;
				background: transparent;
			}
		}

	/*============ HOMR HEADER =========*/
		section.main {
			position: relative;
			min-height: 80vh;
		}
		header.main-header {
			width: fit-content;
			height: auto;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			text-align: center;
			color: #f1f1f1;
		}
		.main-header .welcome {
			font-size: 3em;
		}
		.main-header .to {
			font-size: 1em;
		}
		.main-header .welcome, .main-header .to {
			text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
			color: #f5efefc9;
		}
		.main-header .hello-world {
			font-size: 2.5em;
			text-shadow: 3px 3px 4px rgba(0,0,0,0.5);
			color: #f5efefc9;
			font-family: 'Fredericka the Great', cursive;
			letter-spacing: 4px;
		}
		.main-header .typing {
			max-width: 800px;
			margin: 0px auto;
			text-align: center;
		}
		.main-header .typing a {
			color: lightblue;
			text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
			letter-spacing: 3px;
			font-size: 1.3em;
			font-family: Lobster, cursive;
			visibility: visible;
		}
	
	/*============ HOME INTRO ==========*/
		.introduction { padding: 50px 0; }
		.introduction .box {
			background: #f1f1f1;
			border: 3px solid #808080;
			border-top-right-radius: 15px;
			border-bottom-left-radius: 15px;
			padding: 10px;
			margin: 15px auto;
		}
		.introduction .box:hover {
			background: linear-gradient(45deg, #eee, transparent);
			transition: .3s ease-in-out;
		}
		.introduction h2 { font-size: 2.5em; }		
		.introduction h2, .introduction h3 {
			text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
			color: #f5efefc9;
			font-family: 'Fredoka One', cursive;
			text-align: center;
		}
		.introduction p {
			text-align: center;
			word-break: break-word;
			display: none;
		}
		.introduction img {
			width: 300px;
			display: block;
			margin: 30px auto;
		}
		.introduction a {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
		}

		.intro-inner {
			padding: 50px 0;
		}

	/*============ HOME QUOTE ==========*/
		main {
			background-size: cover;
			background-attachment: fixed;
		}
		.main-blockquote { min-height: 585px; }
		.container-blockquote { padding: 100px 0; }
		.blockquote {
			padding-top: 50px;
			padding-left: 60px;
			position: relative;
			margin-top: 45px;
			border-left: 10px solid #cccccc82;
		}
		.blockquote p {
			font-family: Lobster, cursive;
			font-size: 2em;
			text-align: center;
			text-shadow: 1px 1px 2px rgba(0,0,0, 0.5);
			color: #f1f1f1;
			text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
		}
		.blockquote i {
			position: absolute;
			top: 30px;
			left: 1%;
			font-size: 5em;
			color: #9e9c96bf;
		}

	/*============ MAIN FOOTER =========*/
		footer {
			background: #f1f1f1;
			width: 100%;
			position: relative;
		}
		footer .about-us, footer .menus, footer .search {
			height: auto;
			padding: 30px;
		}

		footer .about-us {

		}

		footer .copyright {
			background: #78C0A8;
			position: absolute;
			bottom: 0;
			right: 0;
			height: 45px;
			width: 100%;
		}
		footer .copyright p {
			color: #f1f1f1;
			text-align: center;
			margin: 10px auto;
			text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
		}

		hr {
			border: 2px solid;
			border-top: 1px solid #eee;
			width: 60%;
		}

	/*============ LESSON ==============*/
		#flow-index-materi {
			padding: 30px;
		}
		.lesson .flip-items img {
			border: 5px solid #909193;
			border-top-right-radius: 15px;
			border-bottom-left-radius: 15px;
			padding: 20px;
			width: 250px;
			background: linear-gradient(45deg, #dfdbdb, #3980be);
		}
		.lesson .flip-items p {
			z-index: 1;
			text-align: center;
			position: relative;
			font-size: 2em;
			font-family: 'Fredoka One', cursive;
			text-shadow: 3px 3px 4px rgba(0,0,0,0.5);
			color: #f5efefc9;
		}
		.lesson .panel .panel-body {
			height: 275px;
			overflow: hidden; 
		}

	/*============ SNIPPET INDEX =======*/
		.index-snippet {
			overflow-x: hidden;
		}
		.snippet-box {
			position: relative;
			height: 350px;
			background: transparent;
			margin-bottom: 50px;
			border-radius: 10px;
			transition: all .4s ease-in-out;
		}
		.snippet-box:hover {
			background: rgba(0, 0, 0, 0.3);
			padding: 20px;
			padding-bottom: 5px;
		}
		.frame-views {
			height: 150%;
			width: 200%;
			border-radius: 20px;
			pointer-events: none;
			border: none;
			transform: scale(0.5);
			transform-origin: 0 0;
		}
		.snippet-box-info {
			position: absolute;
			top: 76%;
			left: 0;
			right: 0;
			background: #337ab7ab;
			border-radius: 10px;
			padding: 10px;
		}
		.snippet-box-info .image {
			float: left;
			width: 20%;
			text-align: center;
		}
		.snippet-box-info .author {
			float: right;
			width: 80%;
		}
		.snippet-box-info .author h4 {
			font-family: 'Fredoka One', cursive;
			margin: 5px;
			color: #f1f1f1;
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}
		.snippet-box-info .image img {
			width: 50px;
			height: 50px;
			border-radius: 50%;
		}
		.snippet-box a.open-to-editor {
			position: absolute;
			top: 0;
			right: 0;
			left: 0;
			bottom: 0;
			border: 0 !important;
			z-index: 1;
		}
		.info-each-snippet {
			position: absolute;
			width: 100%;
			left: 0;
			top: -30px;
			display: flex;
			padding: 0 10px;
			visibility: hidden;
		}
		.info-each-snippet a {
			min-width: 33%;
		}

	/*============ SNIPPET EDITOR ======*/
		.panel-container {
			padding: 10px;
			display: flex;
			flex-direction: row;
			overflow: hidden;
			touch-action: none;
			position: relative;
		}
		/*LEFT*/
		.panel-left {
			flex: 0 0 auto;
			width: 50vw;
			background-color: #ccc;	
		}
		.editor .nav-tabs {
			background: #ccc;
			display: inline-block;
			border-bottom: none;
			position: absolute;
			top: 10px;
			z-index: 10;
		}
		.editor .nav-tabs > li {
			text-align: center;
		}
		.editor .nav-tabs > li > a {
			padding: 2px 10px;
			margin-top: 3px;
			margin-left: 2px;
			text-shadow: none !important;
			color: #808080;
			margin-right: 0px;
			font-size: 1.3em;
			width: 100px;
			min-width: 45px;
			font-family: 'Fredoka One', cursive;
		}
		.editor .nav-tabs > li > a.mini {
			width: 50px;
		}
		.editor .nav-tabs > li > a:not(.mini) {
			letter-spacing: 3px;
		}
		.editor .nav-tabs > li > a:hover {
			border-radius: 5px;
			text-shadow: none !important;
			background: linear-gradient(45deg, #b7b0b0, transparent);
			border-color: #808080;
		}
		.editor .nav-tabs > li.active a,
		.editor .nav-tabs > li.active a:focus,
		.editor .nav-tabs > li.active a:hover {
			border-radius: 5px;
			text-shadow: none !important;
			background: #5F5F5F;
			color: #f1f1f1;
			opacity: 1;
			cursor: default;
			border-color: transparent;
		}
		.editor .control-right > li.active > a {
			padding: 2px;
			border-radius: 5px;
			margin: 3px 1px;
		}
		.editor .nav-tabs.control-left {
			left: 10px;
		}
		.editor .nav-tabs.control-right {
			left: 320px;
		}
		.editor .tab-content {
			height: 82vh;
			margin-top: 45px;
			position: relative;
		}
		.body-html, .body-css, .body-js {
			height: 82vh;
			padding: 0;
		}
		/*MIDDLE*/
		.splitter {
			flex: 0 0 auto;
			width: 18px;
			min-height: 200px;
			cursor: col-resize;
			transition: all .3s ease-in-out;
			z-index: 11;
		}
		.splitter:hover {
			background-color: #ccc;
			border-radius: 3px;
		}
		/*RIGHT*/
		.panel-right {
			flex: 1 1 auto;
			width: 100%;
		}
		.frame {
			background: #fff;
			width: 100%;
			height: 100%;
			border: none;
			position: relative;
			z-index: 11;
		}
		#dm {
			position: absolute;
			right: 40px;
			top: 20px;
			font-size: 1em;
			z-index: 12;
		}

	/*============ SNIPPET SINGLE ======*/
		.single-snippet {

		}

		.single-snippet .editor .nav-tabs.control-left {
			left: 10px;
		}
		.single-snippet .editor .nav-tabs.control-right {
			left: 175px;
		}
		
		.modal-info-snippet .side-info-inner {
			overflow-y: auto;
			overflow-x: hidden;
			max-height: 86vh;
			padding: 10px;
			position: relative;
		}
		.modal-info-snippet .info-title {
			z-index: 1;
			margin-bottom: 5px;
		}
		.modal-info-snippet .info-title .title {
			font-size: 2rem;
			text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
			color: #f5efef;
			font-family: 'Fredoka One', cursive;
		}
		.modal-info-snippet .info-desc {
			min-height: 200px;
			max-height: 200px;
			overflow-y: auto;
			overflow-x: hidden;
		}
		.modal-info-snippet .info-author {
			text-align: center;
			min-height: 305px;
			margin-left: -25px;
		}
		.modal-info-snippet .info-link {
			margin-top: 5px;
			min-height: 100px;
		}
		.modal-info-snippet .info-like, 
		.modal-info-snippet .info-comment, 
		.modal-info-snippet .info-tags {
			text-align: center;
		}
		.modal-info-snippet .info-like,
		.modal-info-snippet .info-comment {
			margin-left: -25px;
		}
		.modal-info-snippet .info-like span, 
		.modal-info-snippet .info-comment span {
			margin-left: 40px;
		}
		.modal-info-snippet .info-like i, 
		.modal-info-snippet .info-comment i, 
		.modal-info-snippet .info-tags i {
			padding: 14px;
			background: #0000ff45;
			position: absolute;
			left: 0;
			top: 0;
		}
		.modal-info-snippet .info-title, .modal-info-snippet .info-desc, .modal-info-snippet .info-author, .modal-info-snippet .info-link, .modal-info-snippet .info-like, .modal-info-snippet .info-comment, .modal-info-snippet .info-tags {
			background: #D2D6DE;
			padding: 10px;
			color: #808080;
			position: relative;
		}
		.row-info {
			margin-bottom: 5px;
		}
		/*PANEL COMMENT*/
		.col-img {
			width: 15%;
		}
		.col-text {
			width: 85%;
		}
		.modal-info-snippet .row-comment {
			margin: 30px 0;
		}
		.modal-info-snippet .btn-sm {
			padding: 0 10px;
		}
		.modal-info-snippet .action {
			visibility: hidden;
		}
		.modal-info-snippet .action.open {
			visibility: visible;
		}
		.modal-info-snippet .direct-chat-info {
			display: block;
			margin-bottom: 2px;
			font-size: 18px;
		}
		.modal-info-snippet .img-user-comm {
			display: block;
			border-radius: 50%;
			width: 60px !important;
			height: 60px !important;
			margin: 10px auto;
		}
		.modal-info-snippet .time-stamp {
			font-size: 12px;
		}
		.modal-info-snippet .direct-chat-text {
			border-radius: 5px;
			position: relative;
			padding: 5px 10px;
			background: #d2d6de;
			border: 1px solid #d2d6de;
			color: #444;
		}
		.modal-info-snippet .direct-chat-text:before {
			border-width: 6px;
			margin-top: -6px;
		}
		.modal-info-snippet .direct-chat-text:after, .modal-info-snippet .direct-chat-text:before {
			position: absolute;
			right: 100%;
			top: 20px;
			border: solid transparent;
			border-right-color: #d2d6de;
			content: ' ';
			height: 0;
			width: 0;
			pointer-events: none;
		}
		.modal-info-snippet .right .direct-chat-info {
			text-align: right;
		}
		.modal-info-snippet .right .direct-chat-text {
			margin-left: 0;
		}
		.modal-info-snippet .direct-chat-text:after {
			border-width: 10px;
			margin-top: -5px;
		}
		.modal-info-snippet .right .direct-chat-text:after, .modal-info-snippet .right .direct-chat-text:before {
			right: auto;
			left: 100%;
			border-right-color: transparent;
			border-left-color: #d2d6de;
		}




		#fetch-comment {
			background: linear-gradient(45deg, #3980be, transparent);
			padding: 0 10px;
		}
		.modal-info-snippet #more {
			padding: 10px;
		}
		.modal-info-snippet .box-comment {
			position: relative;
			margin: 50px 0;
		}
		.modal-info-snippet .text-area:focus {
			background: #fff;
		}
		.modal-info-snippet .submit-comment {
			width: 100%;
			min-height: 75px;
			margin: 3px;
			border-radius: 7px;
			border: 2px solid #808080;
		}
		.modal-info-snippet .error {
			position: absolute;
			top: -25px;
			width: 100%;
			text-align: center;
			font-size: 14px;
		}

	/*============ SNIPPET CREATE ======*/
		.alert-absolute {
			position: absolute;
			z-index: 5;
			left: 0;
			top: 0;
			right: 0;
			min-height: 300px;
		}
		.alert-absolute h4 {
			font-size: 22px;
			font-family: 'Fredoka One', cursive;
			letter-spacing: 2px;
		}
		.alert-absolute p {
			font-size: 18px;
		}
		.editor .input-adjust.text-area {
			min-height: 225px;
		}

		.create-snippet .welcome-snippet, .edit-snippet .welcome-snippet {
			font-size: 2rem;
			text-align: justify;
		}
		.create-snippet .info-snippet, .edit-snippet .info-snippet,
		.create-snippet .welcome-snippet, .edit-snippet .welcome-snippet {
			overflow-y: auto;
			padding: 10px;
			max-height: 76vh;
		}
		.create-snippet .tab-content, .edit-snippet .tab-content {
			border: 2px solid #1d1f21;
			border-left: none;
			border-radius: 0 5px 5px 0;
			background-color: #ECF0F5;
			position: relative;
		}
		.modal-config-snip .editor .nav-tabs {
			background: transparent;
		}
		.modal-config-snip .editor .nav-tabs > li > a {
			width: 140px;
		}
		.modal-config-snip .editor .tab-content {
			height: 77vh;
			margin-top: 55px;
		}
		.modal-config-snip .checkin.pub + label {
			/*letter-spacing: 0;*/
		}
		.modal-config-snip .checkin.pub + label:before {
			/*padding-left: 0;*/
		}
	
	/*============ SNIPPET EDIT ========*/
		.edit-snippet .editor .nav-tabs.control-left {
			/*left: 10px;*/
		}
		.edit-snippet .editor .nav-tabs.control-right {
			/*left: 220px;*/
		}


		.main-side {
			margin: 0 50px;
			margin-right: 370px;
			overflow-x: hidden; 
			position: relative;
		}
	/*========= PROFILE-SIGNED ========*/
	/*==================================*/
		.edit-profile .nav-tabs > li > a {
			text-align: center;
			font-family: 'Fredoka One', cursive;
		}
		.body-photo, .body-info, .body-account {
			padding: 10px;
		}
		.body-photo .cubic, .body-info .cubic, .body-account .cubic {
			min-height: 70vh;
		}
		.edit-profile .body-photo img {
			height: 200px !important;
			width: 200px !important;
			padding: 3px;
			border: 3px solid #d2d6de;
			display: block;
			margin: 10px auto;
		}
		.edit-profile .btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0px;
			left: 0;
			width: 100%;
			min-height: 100%;
			font-size: 22px;
			opacity: 0;
			outline: none;
			background: #fff;
		}
		.edit-profile .input-group {
			width: 50vh;
			margin: 5px auto;
		}

	/*========= TIMELINE-SIGNED ========*/
	/*==================================*/
		.profile-box-fixed {
			position: fixed;
			top: 50px;
			right: 2px;
			width: 350px;
			height: 91vh;
			float: right;
		}
		.profile-user-img {
			width: 150px;
			height: 150px;
			display: block;
			margin: 10px auto;
		}
		.username {
			display: block;
			margin-top: -45px;
			margin-left: 55px;
		}
		.time {
			display: block;
			margin-left: 55px;
			margin-top: 0px;
		}

		.timeline .frame-views {
			height: 190%;
		}
		.timeline .snippet-box {
			height: 230px;
			margin-bottom: 0;
		}
		.timeline .panel-timeline {
			padding: 10px;
			margin: 15px auto;
			position: relative;
		}
		.timeline .img-footer {
			border-radius: 50%;
			height: 50px;
			width: 50px;
		}


	/*========= DASHBOARD-SIGNED =======*/
	/*==================================*/
		table thead tr th {
			text-transform: capitalize;
			color: #808080;
			cursor: pointer;
			background-color: #f1f1f1;
		}
		table.table {
			border-spacing: 1px;
		}
		table tbody tr:hover {
			background-color: #d2d6de !important;
		}

		.dashboard .nav-tabs > li > a,
		.dashboard .nav-tabs > li.active > a {
			width: 120px;
			text-align: center;
		}
		.dashboard .empty {
			text-align: center;
			padding: 10px 30px;
		}
		.dashboard .empty h3 {
			line-height: 1.5;
		}
		.dashboard .flip-items .small-box {
			width: 300px;
			height: 250px;
		}
		.dashboard .tab-content {
			min-height: 375px;
			background: #fff; 
			border-bottom-left-radius: 10px;
			padding: 10px;
		}
		.dashboard .snippet-box {
			height: 250px;
			border: 2px solid;
			padding: 5px;
			background: darkgrey;
		}
		.dashboard .snippet-box:hover {
			background: darkgrey;
			padding: 5px;
			padding-bottom: 5px;
		}
		.dashboard .snippet-box a.open-to-editor {
			bottom: 80px;
		}
		.dashboard .snippet-box-info .author {
			float: none;
			width: 100%;
			text-align: center;
			background: 
		}
		.dashboard .snippet-box-info {
			top: 79%;
			left: 1%;
			right: 1%;
			background: #337ab7;
		}
		.dashboard .small-box .icon {
			position: absolute;
			top: 30px;
			right: 10px;
			opacity: 0.5;
			font-size: 1.5em;
		}
		.dashboard .small-box .title {
			margin-top: 5px;
		}
		.dashboard .small-box .percent {
			text-align: left;
			font-size: 3em;
			margin-left: 15px;
		}
		.dashboard .small-box .progress-group {
			margin-top: 50px;
		}
	


	/*============ MEDIUM ==============*/
		@media only screen and (max-width: 992px){
			section	.welcome .h-one {	font-size: 4em; }
			section .welcome h3 {	font-size: 2.5em; }
			section .welcome .h-two {	font-size: 4.5em; }
			section #typing a {	font-size: 1.5em; }
			
			.login .border, .reset .border, .change .border {
				border-right: none;
				border-bottom: 3px solid #3535D3;
				min-height: 55vh;
			}
			.register .border {
				border-right: none;
				border-bottom: 3px solid #449D44;
				min-height: 55vh;
			}
		}

	/*============= SMALL ==============*/
		@media only screen and (max-width: 768px) {

			section	.welcome .h-one {	font-size: 3.5em; }
			section .welcome h3 {	font-size: 2.2em; }
			section .welcome .h-two {	font-size: 4em; }
			section #typing a {	font-size: 1.2em; }
			article.introduction h2 { font-size: 2.5em;  }
			article .bg {	left: 7%;	right: 7%; }
			.hello h1 { font-size: 2em; }
			.hello .desc-inner p { font-size: 1em; }
			.main-blockquote { min-height: 385px; }
			.container-blockquote { padding: 0; }
			.blockquote { padding-top: 30px; padding-left: 40px; }
			.blockquote i { font-size: 70px; top: 40px; }
			.blockquote p { font-size: 20px; }
			.content img { width: 250px; float: none; display: block; margin: 20px auto; padding: 10px; }
			.list-browser, .list-editor { font-size: 16px; }
			.tabs-box a { display: block; }
			.list-snippet { font-size: 16px; }
			.list-snippet:hover { letter-spacing: 0px; }
			.content-snippet .side-info {

			}
			.modal-dialog {
				width: auto;
				margin: 10px auto;
			}			
		}
		@media only screen and (max-width: 768px) {
		
		}
	</style>
<?php script_user() ?>
</head>
<body>