<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One|PT+Sans">
<?php
	reload_session();
	bootstrap();
	adminLte();
	myGlobal();
	selectBS();
	if ( whats_page(1,['a']) ) dataTable().jqueryUi();
	if ( whats_page(1,['a']) && whats_page(2,['tutorial']) ) ckEditor();
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
		transition: .4s ease-in-out;
	}
	.small-box {
		cursor: default;
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
		padding: 10px;
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
		text-shadow: none !important;
		color: #808080;
		padding: 5px;
		opacity: 1;
	}

	.nav-tabs li a:hover {
		text-shadow: none !important;
	}

	.nav-tabs li.active a,
	.nav-tabs li.active a:focus,
	.nav-tabs li.active a:hover {
		text-shadow: none !important;
		background: #5F5F5F;
		color: #f1f1f1;
		opacity: 1;
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

	.icon-bar {
		position: fixed;
		top: 12%;
		right: 20px;
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
	a.a span { display: none; position: relative; }
	.icon-bar a.a { top: 0; }
	a.a:hover { width: 150px; }

	.list-cat {
		padding: 10px 30px;
	}
</style>
</head>
<body class="hold-transition fix skin-blue sidebar-mini">
<?php
loader();
echo (isset($jsonUrl)) ? '<div class="url-read hide" data-url="'.$jsonUrl.'"></div>' : '';
?>
<div class="wrapper">
<?php navbar($title) ?>
<?php sidebar() ?>
