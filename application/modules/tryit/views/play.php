<?php reload_session() ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title><?= $title ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?=base_url()?>assets/img/feed/favicon.ico">
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins|Roboto"> -->
<link rel="stylesheet" href="<?=log?>roboto.css">
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"> -->
<link rel="stylesheet" href="<?=log?>all.min.css">
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?=log?>bootstrap.min.css">
<link rel="stylesheet" href="<?=log?>jquery-ui.css">

<link rel="stylesheet" href="<?= base_url('assets/css/global.css') ?>">

<!-- <link rel="stylesheet" href="https://unpkg.com/jquery.terminal/css/jquery.terminal.css"> -->
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

.nav-pills .nav-link {
  padding: 10px 20px !important;
  margin: 2px; 
  border: 2px solid #6c757d;
  cursor: pointer;
  text-align: center;
  color: #808080;
}
.nav-pills .nav-link.t {
	min-width: 115px;
}
.nav-pills .nav-link:hover {
	background: linear-gradient(180deg, #17a2b8, #0062cc);
	color: white;
	border: 2px solid #6c757d;
}
.nav-pills .nav-link.blink {
  transition: box-shadow 200ms cubic-bezier(.4,0,.2,1) 0s;
  box-shadow: 0 0 20px 5px #e8e8efed inset;
  background: linear-gradient(180deg, #17a2b8, #0062cc);
  color: white;
}

.panel-editor {
  display: flex;
  flex-direction: row;
  overflow: hidden;
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
  height: 90vh;
  margin: 5px;
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
@media screen and (max-width: 768px){
	.hide-sm {
		display: none !important;
	}
}
</style>
</head>
<body>
	
	<main class="main">
		<div class="wrapper-editor">
		  <ul class="nav nav-pills control bg-light">
	  		<li class="nav-item hide-sm">
	  	  	<a class="nav-link" title="Menu" href="<?=base_url('js/files')?>"><i class="fas fa-lg fa-fw fa-home"></i></a>
	  		</li>
		  	<li class="nav-item hide-sm">
		    	<a id="stop" class="nav-link" title="Auto Run"><i class="fas fa-lg fa-fw fa-sync"></i></a>
		  	</li>
		  	<li class="nav-item hide-sm">
		    	<a id="play" class="nav-link" title="Run Code"><i class="fa fa-lg fa-fw fa-play"></i></a>
		  	</li>
	  		<li class="nav-item hide-sm">
	  	  	<a id="clip" class="nav-link" title="Copy"><i class="fa fa-lg fa-fw fa-copy"></i></a>
	  		</li>
		    <li class="nav-item">
		      <a class="nav-link t active" data-toggle="pill" href="#tab-htm">HTML</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link t" data-toggle="pill" href="#tab-css">CSS</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link t" data-toggle="pill" href="#tab-jsc">JavaScript</a>
		    </li>
		    <?php if (startSession('sess_log')) { ?>
		  	<li class="nav-item hide-sm">
		    	<a id="del" class="nav-link"><i class="fa fa-lg fa-fw fa-eraser"></i></a>
		  	</li>
		    <?php } ?>
		    <!-- <li class="nav-item">
		      <a class="nav-link t" data-toggle="pill" href="#tab-cns">Console</a>
		    </li> -->
		  </ul>
		  <div class="panel-editor">
		    <div class="panel-left">
		      <div class="tab-content">
		        <div class="tab-pane fade show active" id="tab-htm">
		          <div class="body-source" id="source-htm"><?=htmlentities($snippet['htm'])?></div>
		        </div>
		        <div class="tab-pane fade" id="tab-css">
		          <div class="body-source" id="source-css"><?=$snippet['css']?></div>
		        </div>
		        <div class="tab-pane fade" id="tab-jsc">
		          <div class="body-source" id="source-jsc"><?=htmlentities($snippet['jsc'])?></div>
		        </div>
		        <div class="tab-pane fade" id="tab-cns">
		          <div class="body-source" id="term_demo"></div>
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
	</main>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="<?=log?>jquery.min.js"></script>
<script src="<?= base_url('assets/js/global.js') ?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> -->
<script src="<?=log?>popper.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->
<script src="<?=log?>bootstrap.min.js"></script>
<script src="<?=log?>jquery-ui.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ace.js"></script> -->
<script src="<?=log?>ace.js"></script>
<!-- <script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.2/ext-language_tools.js"></script> -->
<script src="<?=log?>ace-language.js"></script>
<script src="<?=base_url()?>assets/vendor/resize/resiz.js"></script>
<script src="<?=base_url()?>assets/js/my-ace.js"></script>
<!-- <script src="https://unpkg.com/jquery.terminal/js/jquery.terminal.js"></script> -->
<script>

// $(function($, undefined) {
//   $('#term_demo').terminal(function(command) {
//     if (command !== '') {
//       try {
//         let result = window.eval(command);
//         if (result !== undefined) {
//             this.echo(new String(result));
//         }
//       } catch(e) {
//         this.error(new String(e));
//       }
//     } else {
//       this.echo('');
//     }
//   }, {
//     greetings: 'JavaScript Interpreter',
//     name: 'js_demo',
//     height: 200,
//     prompt: '> '
//   });
// });
</script>
</body>
</html>