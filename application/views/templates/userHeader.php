<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf" content="<?= $this->security->get_csrf_hash(); ?>">
	<?php
	reload_session();
	bootstrap();
	adminLte();
	myGlobal();
	selectBS();
	if ( whats_page(1,['a']) ) dataTable().selectBS().jqueryUi();
	if ( whats_page(1,['a']) && whats_page(2,['tutorial']) ) ckEditor();
	if ( whats_page(1,['u']) && whats_page(2,['snippet']) && whats_page(3,['create','edit'])) aceEditor().select2();
	?>
	<style>
	/*ALL*/
	.body-fix {
		overflow-y: hidden;
	}
	.wrap-table {
		min-height: 87vh;
	}
	.content { position: relative; }
	.fix .main-sidebar {
		position: fixed;
	}
	.fix .main-header {
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
	}
	.fix .content-wrapper {
		padding-top: 50px;
	}
	.bootstrap-select .dropdown-toggle:focus { outline: none !important; }
	.bootstrap-select button {
		border-radius: 4px !important;
		border: 2px solid gray !important;
		margin-top: 6px;
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
		padding: 4px 8px;
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
	}
	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
		background-color: burlywood;
	}
	/*MODAL*/
	.custom-modal {
		position: absolute;
		z-index: 1051;
		top: 5px;
		right: 5px;
		left: 5px;
		bottom: 5px;
		background: #d7f2fa;
	}
	.inner-modal {
		padding: 20px;
		overflow: auto;
		max-height: 480px;
		max-height: -webkit-fill-available;
	}
	.btn-diss{
		position: absolute;
		top: 0;
		right: 0;
		z-index: 1;
		background-color: #ccc;
	}
	.btn-diss:hover {
		background-color: burlywood;
	}
	.content-users .info_role button {
		margin-right: 5px;
	}
	/*SIDEBAR*/
	.main-sidebar a { text-shadow: none; }
	.sidebar-menu .treeview-menu >li.active >a {
		border-bottom: 2px solid;
	}
	.skin-blue .sidebar-menu > li.header {
		font-family: 'Fredoka One', cursive;
		color: #869398;
		background: #4c5153;
		font-size: 1.2em;
		letter-spacing: 1px;
	}
	/*INPUT*/
	.badge-bar {
		position: absolute;
		top: 10px;
		left: 30px;
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
	/*THEME*/
	.base-link {
		font-family: 'Fredoka One', cursive;
	}
	.base-link:hover {
		/*letter-spacing: 2px;*/
		transition: .4s ease-in-out;
	}
	.small-box {
		cursor: default;
	}
	.theme-html {
		color: #E44D26;
		border: 2px solid;
		transition: .4s ease-in-out;
	}
	.theme-html:hover {
		color: white;
		background: #EE8F77;
	}
	.theme-css {
		color: #264DE4;
		border: 2px solid;
		transition: .4s ease-in-out;
	}
	.theme-css:hover {
		color: white;
		background: #778FEE;
	}
	.theme-js {
		color: #F3BE30;
		border: 2px solid;
		transition: .4s ease-in-out;
	}
	.theme-js:hover {
		color: white;
		background: #F7D26E;
	}
	/*FRAME*/
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
</style>
<?php if ( whats_page(1,['a']) ) : ?>
	<style id="style-admin">
	/*=========== TABLE ===============*/
	.dataTables_processing {
		position: absolute !important;
		top: 235px !important;
		right: 500px !important;
	}
	.btn-slug, .btn-hr, .btn-title {
		border: 1px solid transparent;
	}
	.btn-slug:hover, .btn-hr:hover, .btn-title:hover {
		box-shadow: 1px 1px 2px rgba(0,0,0,0.5);
	}
	table thead tr th {
		text-transform: capitalize;
		text-align: center;
		color: #808080;
		cursor: pointer;
		background-color: #f1f1f1;
	}
	table.dataTable {
		border-spacing: 1px;
	}
	table.dataTable thead .sorting,
	table.dataTable thead .sorting_asc,
	table.dataTable thead .sorting_desc {
		background-image: none !important;
	}

	table.dataTable tbody tr td {
		padding: 3px 5px;
		font-family: Rubik, Sans-serif;
		font-weight: bold;
		border: 1px solid transparent;
	}

	table.dataTable tbody tr td:hover {
		cursor: default;
		background-image: linear-gradient(#fff,#ddd);
	}
	table.dataTable tbody tr td a {
		color: #808080;
		text-shadow: none !important;
	}

	table.dataTable tbody tr:hover {
		background-color: #d2d6de !important;
	}
	.dataTables_length label, .dataTables_filter label {
		color: #808080 !important;
	}

	table.dataTable tbody tr td .btn-pre,
	table.dataTable tbody tr td .btn-pub,
	table.dataTable tbody tr td .btn-ready {
		margin: 0px !important;
		padding: 5px !important;
		width: 50px;
	}
	table.dataTable tbody tr td .btn-title,
	table.dataTable tbody tr td .btn-slug {
		text-align: left;
	}
	table.dataTable tbody tr td .input-title,
	table.dataTable tbody tr td .input-slug {
		width: 100%;
	}
	.DataTables_sort_icon.css_right.ui-icon {
		display: inline;
		background-image: none;
	}
	td a.action {
		border-color: transparent;
	}
	#frame-pre {
		width: 100%;
		height: 100%;
		position: absolute;
		border: none;
	}
	.btn {
		border-radius: 4px;
		background: transparent;
	}

	.main-snippet {
		letter-spacing: 3px;
		margin-top: 0;
	}

	.wrap-table {
		box-shadow: 2px 3px 3px rgba(0,0,0,0.5);
		padding: 10px 20px;
	}

	.content a.btn-modal {
		position: absolute;
		right: 50px;
		bottom: 44px;
	}

	.wrap-html {
		background: #EE8F77;
	}

	.wrap-css {
		background: #778FEE;
	}

	.wrap-js {
		background: #F7D26E;
	}
	.arrow {
		width: 50%;
	}
	.row-style {
		margin: -10px -20px 20px -20px;
		padding: 10px 15px;
		background: #f1f1f1
	}
	/*=========== EDIT ===========*/
	.nav-tabs {
		font-family: 'Fredoka One', cursive;
		letter-spacing: 3px;
		background: transparent;
		z-index: 1;
	}

	.nav-tabs li a {
		border-radius: 30px !important;
		text-shadow: none !important;
		color: #808080;
		opacity: 1;
	}

	.nav-tabs li a:hover {
		border-radius: 30px !important;
		text-shadow: none !important;
	}

	.nav-tabs li.active a,
	.nav-tabs li.active a:focus,
	.nav-tabs li.active a:hover {
		border: 3px solid #5F5F5F;
		text-shadow: none !important;
		border-radius: 30px !important;
		background: #5F5F5F;
		color: #f1f1f1;
		opacity: 1;
	}

	.tab-content {
		border: 2px solid #5F5F5F;
	}
	.tab-content #info {
		padding: 10px;
	}

	#info label {
		display: inline-block;
		max-width: 100%;
		margin-bottom: 0px;
		margin-top: 10px;
		margin-left: 20px;
		font-weight: 700;
		font-size: 18px;
		cursor: pointer;
	}

	.text-code {
		background: #e1e1e1;
		color: #333;
		margin: 5px 10px;
		padding: 20px;
		font-family: Consolas;
		overflow-y: auto;
		overflow-x: hidden;

		width: 98%;
		height: 439px;
		resize: none;
		font-weight: bold;
		outline: none;
		white-space: pre;
		cursor: unset;
		text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
	}

	.icon-bar {
		position: fixed;
		top: 12%;
		right: 0px;
		z-index: 9999;
		direction: rtl;
	}
	.icon-bar a {
		display: inline-block;
		width: 55px;
		border-radius: 55px;
		margin: 0 !important;
		padding: 10px;
		transition: all 0.2s ease-in-out;
		color: #808080;
		font-family: 'Fredoka One', Sans-serif;
		position: absolute;
		max-height: 55px;
	}
	a.a span, a.b span, a.c span, a.d span, a.e span, a.f span, a.g span{ display: none; position: relative; }
	.icon-bar a.a{ top: 0; }
	.icon-bar a.b{ top: 50px; }
	.icon-bar a.c{ top: 100px; }
	.icon-bar a.d{ top: 150px; }
	.icon-bar a.e{ top: 200px; }
	.icon-bar a.f{ top: 250px; }
	.icon-bar a.g{ top: 300px; }

	a.a:hover,a.b:hover,a.c:hover,a.d:hover,a.e:hover,a.f:hover,a.g:hover {
		width: 150px;
	}

	.list-cat {
		padding: 10px 30px;
	}
</style>
<?php endif;
if ( whats_page(1,['u']) ) : ?>
	<style id="style-user">
	/* ============== NAVBAR*/
	.navbar .title-navbar {
		color: #f1f1f1;
		display: inline-block;
		padding: 13px;
		font-size: 18px;
		font-family: 'Fredoka One', cursive;
	}

	.navbar-custom-menu > .navbar-nav > li.user-menu {
		max-width: 150px;
		max-height: 50px;
	}
	.navbar-custom-menu > .navbar-nav > li.user-menu > a {
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
	}
	/*===============================*/
	.nav>li>a:focus, .nav>li>a:hover {
		text-decoration: none;
		background-color: inherit;
	}
	.alert-absolute {
		position: absolute;
		z-index: 5;
		left: 0;
		top: 0;
		bottom: 15%;
		right: 0;
	}
	.alert-absolute h4 {
		font-size: 22px;
		font-family: 'Fredoka One', cursive;
		letter-spacing: 2px;
	}
	.alert-absolute p {
		font-size: 18px;
	}
	/* ============== NOTIFICATION*/
	/*.side-notification {
		position: fixed;
		right: 0;
		top: 50px;
		z-index: 1030;
		width: 450px;
		height: 92vh;
		background: transparent;
	}
	.side-notification .nav-tabs-custom > .nav-tabs > li {
		width: 32%;
		text-align: center;
	}
	.side-notification .nav-tabs-custom > .nav-tabs > li > a {
		font-family: 'Fredoka One', cursive;
		padding: 10px;
	}
	.side-notification .nav-tabs-custom > .nav-tabs > li > a > span {
		font-family: Rubik, Sans-serif;
	}
	.side-notification .nav-tabs-custom > .tab-content {
		padding: 10px 0;
	}
	.side-notification .nav-tabs-custom > .tab-content > .tab-pane {
		overflow-y: auto;
		height: 84vh;
	}
	.side-notification .content-notification {
		margin: 0;
		padding: 0;
	}
	.side-notification .content-notification > li {
		list-style: none;
		padding: 5px;
		text-overflow: ellipsis;
		overflow: hidden;
		white-space: nowrap;
		position: relative;
		transition: 0.3s ease-in-out;
	}
	.side-notification .content-notification > li:hover {
		background: #ccc;
		color: #f1f1f1;
	}
	.side-notification .content-notification > li a {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		}*/
	/*.custom-image {
		float: left;
		width: 40px;
		height: 40px;
		border-radius: 50%;
		margin-right: 10px;
		margin-top: 8px;
		}*/
		/* ============== PROFILE BOX*/
		.profile-box-fixed {
			position: fixed;
			right: 15px;
			width: 270px;
		}
		.profile-box-fixed .profile-user-img{
			width: 150px;
			height: 150px;
		}
		.content-home, .content-activity {
			padding-right: 300px;
		}
		/* ============== CODE_CREATE*/
		.content-create	.splitter {
			flex: 0 0 auto;
			width: 18px;
			background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
			min-height: 200px;
			cursor: col-resize;
			transition: all .3s ease-in-out;
		}
		.content-create	.splitter:hover {
			background-color: #ccc;
			border-radius: 3px;
		}
		.content-create	.panel-container {
			display: flex;
			flex-direction: row;
			overflow: hidden;
			height: 100%;
			min-height: 87vh;
			box-shadow: 0px 2px 5px rgba(0,0,0,0.5);
			xtouch-action: none;
		}
		/*SIDE LEFT*/
		.content-create	.panel-left {
			flex: 0 0 auto;
			width: 50vw;
			min-width: 5%;
			max-width: 98%;
			background-color: #ccc;
		}
		/*TAB*/
		.checkin + label {
			font-size: 1em;
			letter-spacing: inherit;
			margin: 8px;

		}
		.content-create .nav-tabs {
			letter-spacing: 3px;
			display: inline-block;
			border-bottom: none;
		}
		.content-create .nav-tabs li a {
			text-align: center;
			text-shadow: none !important;
			padding: 5px 10px;
			color: #808080;
			margin-right: 0px;
			font-size: 1.3em;
			margin: 0 1px;
			width: 90px;
			font-family: 'Fredoka One', cursive;
			border-radius: 7px 7px 0 0;
			text-shadow: none !important;
			background: #1d1f21;
			color: #f1f1f1;
			opacity: 1;
			cursor: pointer;

			background: linear-gradient(#337ab7, transparent);
			color: #f1f1f1;
			text-shadow: none !important;
		}
		.content-create .nav-tabs li a.mini {
			width: 45px;
		}
		.content-create .nav-tabs li a.tab-modal {
			width: 125px;
		}
		.content-create .nav-tabs li.active a,
		.content-create .nav-tabs li.active a:focus,
		.content-create .nav-tabs li.active a:hover {
			background: #1d1f21;
			color: #f1f1f1;
		}
		.content-create .tab-content {
			height: 81vh;
			margin-top: -6px;
			border: 2px solid #1d1f21;
			border-left: none;
			border-radius: 0 5px 5px 0;
			background-color: #ECF0F5;
			position: relative;
		}
		.content-create .welcome-snippet {
			font-size: 1.2em;
			text-align: justify;
		}
		.info-snippet, .welcome-snippet {
			overflow-y: auto;
			padding: 10px;
			max-height: 78vh;
		}
		.content-create .info-snippet hr {
			margin: 15px 50px;
			border: 0;
			border-top: 2px solid #9E9E9E;
		}
		.content-create	.body-html, .content-create .body-css, .content-create .body-js {
			height: 80vh;
			padding: 0;
		}
		.input-adjust.text-area {
			min-height: 150px;
		}
		/*SIDE RIGHT*/
		#dm {
			position: absolute;
			right: 40px;
			top: 20px;
			font-size: 1em;
		}
		.content-create	.panel-right {
			flex: 1 1 auto;
			width: 100%;
			min-height: 200px;
			min-width: 400px;
			background: #fff;
		}
		.content-create	.frame {
			width: 100%;
			height: 100%;
			border: none;
		}
		.content-create .bootstrap-select .dropdown-menu li small {
			padding-left: 0em;
			position: absolute;
			right: 50px;
		}
		/*IN MODAL*/
		.nav-tab-config {
			margin-bottom: 0;
		}
		.nav-tab-config .tab-content {
			height: 70vh;
			overflow-y: auto;
		}
		#list-jquery, #list-framework {
			list-style: none;
			margin: 0;
			padding: 0;
		}
		#list-jquery li, #list-framework li {
			padding: 5px 0;	
		}
		/* ============== CODE_USER*/
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
		.info-each-snippet {
			position: absolute;
			width: 100%;
			left: 0;
			bottom: -33px;
			padding: 0 10px;
			visibility: hidden;
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
			bottom: 85px;
			border: 0 !important;
			z-index: 1;
		}
		/*-----------------*/
		.content-snippet-user .not-yet img {
			display: block;
			margin: 40px auto;
			border: 3px solid #ccc;
			border-radius: 50%;
			padding: 5px;
		}
		.content-snippet-user .create-new{
			text-align: center;
			margin: 54px auto;
			cursor: pointer;
		}
		.content-snippet-user .create-new img {
			width: 100px;
			height: 100px;
		}
		/* ============== ACTIVITY*/
		.content-activity .profile-body {
			min-height: 330px;
			border : 2px solid;
			position: relative;
			font-size: 1.2em;
		}
		.content-activity .profile-body .edit {
			position: absolute;
			bottom: 0;
			left: 5px;
			right: 5px;
			background-color: rgba(0, 0, 0, 0.15);
			padding: 4px;
		}
		.content-activity .profile-body p.edit:hover {
			background-color: burlywood;
		}
		.content-activity .profile-body .profile-user-img {
			height: 100px;
		}
		/* ============== PROFILE*/
		.content-profile .box {
			position: relative;
		}
		/*MODAL*/
		.content-profile .btn:hover {
			background: burlywood;
		}
		.content-profile .btn-file {
			position: relative;
			overflow: hidden;
		}
		.content-profile .submit-photo, .content-profile .submit-identity, .content-profile .submit-account {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
		}
		.content-profile .btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			display: block;
		}
		.content-profile #img-upload{
			width: 160px;
			height: 160px;
		}
		/*VIEW*/
		.content-profile .box-photo .profile-user-img {
			height: 160px;
			width: 160px;
		}
		.content-profile .box-identity, .content-profile .box-photo, .content-profile .box-account {
			min-height: 76vh;
		}
		.content-profile .box-identity p, .content-profile .box-account p {
			margin-top: 10px;
			font-size: 16px;
			font-family: 'Fredoka One', cursive;
		}
		@media only screen and (min-width: 768px){
			.modal-dialog {
				width: 700px;
			}
		}
		@media only screen and (max-width: 992px){
			.content-home, .content-activity {
				padding-right: 15px;
			}
		}
	</style>
<?php endif;
script_user();
?>
</head>
<body class="hold-transition fix skin-blue sidebar-mini">
	<?php
	loader();
	echo (isset($jsonUrl)) ? '<div class="url-read hide" data-url="'.$jsonUrl.'"></div>' : '';
	?>
	<div class="wrapper">
		<?php navbar($title) ?>
		<?php sidebar() ?>
