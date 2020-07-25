<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?=base_url()?>assets/img/feed/favicon.ico">
<link rel="apple-touch-icon" href="<?=base_url()?>assets/img/feed/apple-touch-icon.png">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Roboto"> -->
<link rel="stylesheet" href="<?=log?>roboto.css">
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> -->
<link rel="stylesheet" href="<?=log?>all.min.css">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?=log?>bootstrap.min.css">
<link rel="stylesheet" href="<?=log?>jquery-ui.css">
<link rel="stylesheet" href="<?=base_url()?>assets/vendor/prism/prism-line.css">
<?php myGlobalCss() ?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">

<style>
.panel-editor .splitter {
  background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
}
.wrapper-editor {
  position: fixed;
  z-index: 999;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}

.ctrl {
  display: flex;
  display: none;
  background: #ccc;
  /*background: #aaa5a5;*/
}
.btn-control:focus {
  box-shadow: none !important;
}
.btn-control {
  padding: 10px 20px !important;
  margin: 2px; 
  border: 2px solid #6c757d;
}
.btn-control:hover {
	background: linear-gradient(180deg, #17a2b8, #0062cc);
	color: white;
	border: 2px solid #6c757d;
  /*border-color: transparent;*/
}
.btn-control.active {
  /*text-shadow: -1px -1px 3px #676d72, 1px -1px 2px #676d72, -1px 1px 3px #676d72, 1px 1px 2px #676d72;*/
  /*color: #e8e8efed;*/
  transition: box-shadow 200ms cubic-bezier(.4,0,.2,1) 0s;
  box-shadow: 0 0 20px 5px #e8e8efed inset;
  background: linear-gradient(180deg, #17a2b8, #0062cc);
  color: white;
  /*border: 2px solid #6c757d;*/
}

.panel-editor {
  display: flex;
  flex-direction: row;
  overflow: hidden;
  /*height: 100%;*/
  min-height: 92vh;
  box-shadow: 0px 2px 5px rgba(0,0,0,0.5);
}
.panel-editor .splitter {
  flex: 0 0 auto;
  width: 18px;
  min-height: 200px;
  cursor: col-resize;
  transition: all .3s ease-in-out;
}
.panel-editor .splitter:hover {
  background-color: #ccc;
}
.panel-editor .panel-left {
  flex: 0 0 auto;
  width: 50vw;
  min-width: 3%;
  max-width: 99%;
}
.panel-editor .body-source {
  height: 93vh;
  padding: 0;
}

.panel-editor .dimension {
  position: absolute;
  right: 40px;
  top: 10px;
  font-size: 1.3em;
}
.panel-editor .panel-right {
  flex: 1 1 auto;
  width: 100%;
  background: #fff;
}
.panel-editor .frame {
  width: 100%;
  height: 100%;
  border: none;
}
</style>
</head>
<body>

	<div class="wrapper-editor">
	  <nav class="ctrl">
	    <!-- <button id="close" class="btn btn-control" title="Close Editor"><i class="fa fa-lg fa-fw fa-times"></i></button> -->
	  </nav>
	  <ul class="nav nav-pills">
	  	<li class="nav-item">
	    	<a id="stop" class="nav-link" title="disable AutoRun"><i class="fas fa-lg fa-fw fa-hourglass-half fa-spin"></i></a>
	  	</li>
	  	<li class="nav-item">
	    	<a id="play" class="nav-link" title="Run Code"><i class="fa fa-lg fa-fw fa-play"></i></a>
	  	</li>
	  	<li class="nav-item">
	    	<a id="clipboard" class="nav-link" title="Copy to Clipboard"><i class="fa fa-lg fa-fw fa-copy"></i></a>
	  	</li>
	  	<li class="nav-item">
	    	<a id="newTab" class="nav-link" title="Save"><i class="fa fa-lg fa-fw fa-save"></i></a>
	  	</li>
	    <?php if (startSession('sess_log')) { ?>
	  	<li class="nav-item">
	    	<a id="temp" class="nav-link"><i class="fa fa-lg fa-fw fa-pen"></i></a>
	  	</li>
	  	<li class="nav-item">
	    	<a id="del" class="nav-link"><i class="fa fa-lg fa-fw fa-eraser"></i></a>
	  	</li>
	    <?php } ?>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="pill" href="#tab-htm">HTML</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" data-toggle="pill" href="#tab-css">CSS</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link active" data-toggle="pill" href="#tab-jsc">JavaScript</a>
	    </li>
	  </ul>
	  <div class="panel-editor">
	    <div class="panel-left">
	      <div class="tab-content">
	        <div class="tab-pane fade" id="tab-htm">
	          <div class="body-source" id="source-htm"></div>
	        </div>
	        <div class="tab-pane fade" id="tab-css">
	          <div class="body-source" id="source-css"></div>
	        </div>
	        <div class="tab-pane fade show active" id="tab-jsc">
	          <div class="body-source" id="source-jsc"></div>
	        </div>
	      </div>
	    </div>
	    <div class="splitter"></div>
	    <div class="panel-right">
	      <iframe class="frame" id="result-frame"></iframe>
	      <div class="dimension" id="dm"></div>
	    </div>
	  </div>
	</div>

<?php myGlobalJs() ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
<script src="<?=log?>popper.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
<script src="<?=log?>bootstrap.min.js"></script>
<script src="<?=log?>jquery-ui.js"></script>
<?php myEditorJs(); ?>

</body>
</html>