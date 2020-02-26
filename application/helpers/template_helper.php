<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function playEditor() { ?>
	<div class="wrapper-editor" style="display: none;">
	  <div class="panel-editor">
	    <div class="panel-left">
	      <nav class="ctrl">
	        <button id="close" data-toggle="tooltip" data-placement="bottom" title="Close"><i class="fa fa-lg fa-fw fa-times"></i></button>
	        <button id="live" data-toggle="tooltip" data-placement="bottom" title="Run Code"><i class="fa fa-lg fa-fw fa-play"></i></button>
	        <button id="clipboard" data-toggle="tooltip" data-placement="bottom" title="Copy to Clipboard"><i class="fa fa-lg fa-fw fa-copy"></i></button>
	        <button id="download" data-toggle="tooltip" data-placement="bottom" title="Download"><i class="fa fa-lg fa-fw fa-download"></i></button>
	        <button id="snippet" data-toggle="tooltip" data-placement="bottom" title="Enable Snippet"><i class="fa fa-lg fa-fw fa-laptop-code"></i></button>
	        <?php if (startSession('sess_role') && getSession('sess_role') == 1) { ?>
	        <button id="temp"><i class="fa fa-lg fa-fw fa-pen"></i></button>
	        <?php } ?>
	      </nav>
	      <div class="body-source" id="source-code"></div>
	    </div>
	    <div class="splitter"></div>
	    <div class="panel-right">
	      <iframe class="frame" id="result-frame"></iframe>
	      <div class="dimension" id="dm"></div>
	    </div>
	  </div>
	</div>
<?php }

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

function blank_page($status) {
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