<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf" content="<?= $this->security->get_csrf_hash(); ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredericka+the+Great|Lobster">
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.flipster.min.css')?>">

<?php 
	bootstrap();
	myGlobal();
	typing(); 
	if (true) { ?>
	<!-- <link rel="stylesheet" href="<?= base_url('assets/css/css_main.css'); ?>">	 -->
<style>
	section { background-image: url('<?= base_url('assets/img/feed/main-background.jpg') ?>'); }
	.hello { background-image: url('<?= base_url('assets/img/feed/designs.png') ?>'); }
	.about-live { background-image: url('<?= base_url('assets/img/feed/live.gif') ?>'); }
	.about-practice {	background-image: url('<?= base_url('assets/img/feed/practice.gif') ?>'); }
	.about-easy { background-image: url('<?= base_url('assets/img/feed/easy.gif') ?>'); }
	.about-sign { background-image: url('<?= base_url('assets/img/feed/sign.gif') ?>'); }		
	main { background-image: url('<?= base_url('assets/img/feed/login.jpg') ?>'); }

  /*============ NAVBAR ==============*/
	.main-navbar {
		position: sticky;
		top: 0;
		z-index: 999;
	  height: 2.500em;
	  width: 100%;
	  padding: 0;
	  margin: 0;
	  background: #808080;
	  overflow: hidden;
	}
	.main-navbar a {
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
	.main-navbar a::before {
	  content: '';
	  position: absolute;
	  display: block; 
	  left: -1.5em;
	  width: 0;
	  height: 0;
	  
	  border-top: 2.5em solid transparent;
	  border-right: 1.563em solid #337ab7;
	}
	.main-navbar a::after {
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
	.main-navbar a:hover {  
	  color: #666;
	  background: #CCC;
	  transition: none;
	}
	.main-navbar a:hover::after {  
	  border-top: 2.5em solid #CCC;
	  border-right: 1.563em solid transparent;
	}
	.main-navbar a:hover::before {  
	  border-top: 2.5em solid transparent;
	  border-right: 1.563em solid #CCC;
	}

	.main-navbar a.active {  
	  color: #BBB;
	  background: #DDD;
	}
	.main-navbar a.active::after {  
	  border-top: 2.5em solid #DDD;
	  border-right: 1.563em solid transparent;
	}
	.main-navbar a.active::before {  
	  border-top: 2.5em solid transparent;
	  border-right: 1.563em solid #DDD;
	}
	.main-navbar .right-nav {
		margin-right: 0;
	}
	.main-navbar .right-nav.open {
		width: 2em;
	}
	.main-navbar a.mini {
		width: 2em;
	}

	/*============ HOME ALL ============*/
		body {
			background-image: linear-gradient(#FFF, #808080);
			position: relative;
			color: #808080;
			font-family: 'Rubik', Sans-serif;
			cursor: default;
			font-size: 18px;
		}
		img {
			cursor: pointer;
		}
		button#toTop {
	    position: fixed;
	    bottom: 50px;
	    right: 20px;
	    height: 60px;
	    z-index: 2;
	    min-width: 65px;
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
			z-index: 1;
		}
	/*============ HEADER ==============*/
		section{
			background-size: cover;
			background-attachment: fixed;
			min-height: 100vh;
		}
		section.main{
			margin-top: 0px;
			padding-top: 100px;
		}
		header.wrapper-header {
			position: relative;
		}
		.welcome {
			text-align: center;
			color: #f1f1f1;
		}
		section .welcome .h-one {
			font-size: 4em;
		}
		section .welcome h3 {
			font-size: 3em;
		}
		section .welcome .h-two {
			font-size: 6.5em;
			text-shadow: 3px 3px 4px rgba(0,0,0,0.5);
			color: #f5efefc9;
			font-family: 'Fredericka the Great', cursive;
			letter-spacing: 4px;
		}
		section #typing {
			max-width: 800px;
			margin: -10px auto;
			text-align: center;
		}
		section #typing a {
			color: #f1f1f1;
			text-shadow: 1px 1px 1px #fff, 0 0 10px blue, 0 0 5px lightblue;
			letter-spacing: 3px;
			font-size: 1.3em; 
			font-weight: bolder; 
			font-family: 'Anonymous Pro', monospace;	
		}

	/*============ CAROUSEL ============*/
		.wrapper-carousel {
			margin-top: 0px;
		}
		.carousel {
			position: relative;
	    width: 100%;
	    height: 100vh;
	    margin: 10px auto;
		}	

		.desc-inner {
			position: absolute;
	    bottom: -45px;
	    left: 10%;
	    right: 10%;
	    margin: 10px;
	    text-shadow: 3px 3px 4px rgba(0,0,0,0.5);
	    color: #f5efefc9; 
		}
		.desc-inner h3 {
			text-shadow: 2px 2px 3px rgba(0,0,0,0.5);
			text-align: center;
			color: #f5efef;
			font-family: 'Fredoka One', cursive;
			font-size: 2em;
			letter-spacing: 2px;
		}	
		.desc-inner p {
	    font-family: 'Fredoka One', cursive;
	    font-size: 1.1em;
	    text-align: center;
	    min-height: 150px;
		}


		.about-live {
			background-color: #6DBAC6;
		}
		.about-practice {
			background-color: #1AC7FF; 
		}
		.about-easy {
			background-color: #F08481; 
		}
		.about-sign {
			background-color: #4BAD30; 
		}
		.about-live, .about-practice, .about-easy, .about-sign {
			margin: 0;
			height: 100vh;
			box-shadow: none;
			padding: 10px;
			background-position: top center;
			background-repeat: no-repeat;		
		}

	/*============ INTRO ===============*/
		article .bg {
			position: absolute;
		  top: 10px;
		  bottom: 10px;
		  left: 10%;
		  right: 10%;
		  z-index: -1;
		  background: steelblue;
		}
		article {
			background: transparent;
		}
		.introduction h2 { 
			font-size: 3em;
			text-shadow: 3px 3px 4px rgba(0,0,0,0.5);
			cursor: default;
			color: #f5efefc9;
			margin-bottom: 30px;
		}
		.intro-inner {
			padding: 50px 0;
		}
		.intro-inner img {
			width: 300px;
			float: left;
			margin: 30px;
		}
		.intro-inner p {
			text-align: justify;
		}

	/*============ MAIN MENU ===========*/
		.hello {
			background-size: cover;
			background-attachment: fixed;
			padding: 100px 0;		
		}
		.hello h1 { font-size: 3em; }
		.hello h2 { font-size: 2em; }
		.hello h1, .hello h2, .hello p {
			cursor: default;
			text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
			color: #f5efef;
		}
		.hello-fiture {
			background: rgba(0,0,0,0.3);
			border-radius: 10px;
		}
		.hello-fiture .fiture-desc{
			text-align: center;
			font-weight: bold;
    	margin: 30px 20px;
		}
		.hello-fiture p.center {
			z-index: 1;
    	position: relative;
    	font-size: 2em;
    	font-family: 'Fredoka One', cursive;
		}
		.row.ex{
			margin: 0 !important;
		}
		.flip-items img {
			border: 2px solid #808080;
			border-radius: 10px;
			padding: 20px;
			width: 250px;
			background: #f1f1f1;
		}

	/*============ MAIN QUOTE ==========*/
		main {
			background-size: cover;
			background-attachment: fixed;
		}

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
	    color: rgba(0,0,0,0.5);  
		}

	/*============ SUB PAGE ============*/
	  /*.section {
	    padding-top: 140px;
	    color: #f1f1f1;
	    text-shadow: 2px 2px 3px rgba(0,0,0,0.5);
	  }
	  .section img {
	    display: block;
	    margin: 30px auto;
	    width: 250px;
	  }
	  .section h1 {
	    text-shadow: 3px 3px 4px rgba(0,0,0,0.5);
	    color: #f5efefc9;
	    font-family: 'Fredericka the Great', cursive;
	    letter-spacing: 4px;
	    font-size: 4em;
	  }
	  .description {
	    padding-bottom: 100px;
	  }
	  .title-ftg {
			text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
			color: #f5efef;
	    letter-spacing: 4px;
	    margin: 50px auto;
	    font-size: 3em;
	  }*/

	/*============ LIST MENU ===========*/
	  .btn-tabs { 
	    margin-bottom: 0px;
	    border: none;
	    text-align: center;
	  }
	  .btn-tabs a { 
	    border: 2px solid #808080;
	    width: 29.33%;
	    box-sizing: border-box;
	    display: inline-block;
	    border-radius: 0px;
	    border-top-right-radius: 25px;
	    border-bottom-color: transparent;
	    text-align: center;
	    margin-right: -1px; 
	    margin-bottom: -2px;
	    font-family: 'Fredoka One', cursive; 
	    letter-spacing: 2px;
	    font-size: 16px;
	    padding: 10px 15px;
	  }

	  .btn-tabs a:hover {
	    border-color: #808080;
	    color: white; 
	  }

	  .btn-tabs a.active,
	  .btn-tabs a.active:focus,
	  .btn-tabs a.active:hover
	  {
	    background-color: #f1f1f1;
	    color: #808080;
	    border: 2px solid #808080;
	    border-bottom-color: transparent;
	  }
	  .btn-tabs a.active {
	    text-shadow: none;
	    border-bottom: transparent;
	    background-color: #f1f1f1;
	  }
	  .tab-content { 
	    border: 2px solid #808080; 
	    height: 420px;
	    border-radius: 10px;
	    margin-top: -2px;
	    border-radius: 25px;
	    border-top-left-radius: 0;
	    border-bottom-right-radius: 0;
	  }
	  .tab-content-inner {
	    position: relative;
	    width: 100%;
	  }

	  .tab-pane {
	    height: 415px;
	    width: 90%;
	    overflow-y: auto;
	    overflow-x: hidden;
	    position: absolute;
	    top: 0px;
	    left: 5%;
	    right: 5%;
	    z-index: 0;
	    padding: 5px 0;
	    background-color: #f1f1f1;
	  }
	  .tab-pane.fade.in.active {
	    z-index: 1 !important;
	  }

	  .list-snippet { 
	    padding: 8px 20px; 
	    color: #808080;  
	    font-size: 18px; 
	    display: block; 
	    text-align: left; 
	    font-family: 'Fredoka One', cursive;
	    transition: ease-in-out 0.5s;
	  }
	  .list-snippet:hover { 
	    letter-spacing: 2px; 
	    color: white; 
	    text-decoration: none;
	    box-shadow: 0 6px 12px rgba(2,2,2,0.5);
	  }
	  .list-snippet span {
	    margin-right: 7px;
	  }

		.btn-tabs.html a {	color: #E44D26; }
		.btn-tabs.html a:hover { background: #EE8F77; }
		.tab-content.html { background: #EE8F77; }
		.list-snippet.html:hover { background: #EE8F77; }	

		.btn-tabs.css a {	color: #264DE4; }
		.btn-tabs.css a:hover { background: #778FEE; }
		.tab-content.css { background: #778FEE; }
		.list-snippet.css:hover { background: #778FEE; }

		.btn-tabs.javascript a {	color: #F3BE30; }
		.btn-tabs.javascript a:hover { background: #F7D26E; }
		.tab-content.javascript { background: #F7D26E; }
		.list-snippet.javascript:hover { background: #F7D26E; }		
	/*============ ROW EDITOR ==========*/
	  .row-editor {
	    margin-top: 50px;
	    min-height: 300px;
	  }
	  .code-editor {
	    position: relative;
	  }
	  .code-editor .num {
	    position: absolute;
	    min-height: 200px;
	    width: 30px;
	    top: 1px;
	    bottom: 7px;
	    padding-top: 10px;
	    border-radius: 5px;
	    border-top-right-radius: 0;
	  }
	  .num span {
	    display: block;
	    color: #f1f1f1;
	    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
	    font-size: 14px;
	    font-family: Consolas;
	    text-align: right;
	    padding-right: 8px;
	  }
	  #htmlx {
	    font-family: Consolas;
	    height: 510px;
	    overflow: hidden;
	    overflow-x: auto;
	    cursor: unset;
	    width: 100%;
	    padding-left: 35px;
	    padding-top: 10px;
	    font-weight: bold;
	    color: #fff;
	    background-color: #808080;
	    font-size: 14px;
	    border: 1px solid #ccc;
	    border-radius: 5px;
	    border-bottom-width: 5px;
	    transition: ease 0.4s;
	  }
	  #htmlx .ti-container:before {
	    content: '.';
	    display: inline-block;
	    width: 0px;
	    margin-left: -61px;
	    visibility: hidden;
		}

	  .container-window {
	    height: 38px;
	    background-color: #e1e1e1; 
	    border: 1px solid #ccc; 
	    border-top-right-radius: 5px; 
	    border-top-left-radius: 5px;
	  }
	  .row-window {
	    padding: 6px;
	    position: relative;
	  }
	  .row-window a {
	    margin: 1px 5px;
	    font-size: 18px;
	    position: absolute;
	    color: #ccc;
	    padding: 3px 2px;
	  }
	  .column-window {
	    display: inline;
	    width: 80%;  
	  }
	  .row-window:after {
	    content: "";
	    display: table;
	    clear: both;
	  }
	  .dot {
	    margin-top: 0px;
	    height: 12px;
	    width: 12px;
	    background-color: #bbb;
	    border-radius: 50%;
	    display: inline-block;
	  }    
	  .input-window {
	    min-width: 10%;
	    width: 70%;
	    position: absolute;
	    left: 20%;
	    border-radius: 15px;
	    border: none;
	    background-color: white;
	    height: 25px;
	    color: #666;
	    padding: 5px;
	    padding-left: 15px;
	  }
	  .browser-window iframe {
	    width: 100%; 
	    height: 470px;
	    background-color: #fff; 
	    border: 1px solid #ccc;
	    border-top: none;
	  }

	/*============ FOOTER ==============*/
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
			font-family: 'Anonymous Pro', monospace;
			margin: 10px auto;
			text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
		}

		hr {
			border: 2px solid;
			border-top: 1px solid #eee;
			width: 60%;
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
			background: rgba(0,0,0,0.3);
			min-height: 92.8vh;
			border-radius: 10px;
			padding: 10px;
			position: relative;
		}
		.login, .register, .reset, .change {
			min-height: 90vh;
		}
		.info-login, .info-register, .info-reset, .info-change {
	    text-align: center;
	    font-size: 0.9em;
	    min-height: 500px;
	    color: #f1eded;
	    padding: 20px;
		}
		.info-reset {
			text-align: left;
		}
		.info-login h1, .info-register h1, .info-reset h1, .info-change h1 {
			letter-spacing: 2px;
		}
		.info-login p, .info-register p, .info-reset li, .info-change p, .info-change li {
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
		.forgot {
			/*font-size: 0.8em;*/
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

	/*============ SNIPPET ============*/
	.content-snippet .splitter {
		flex: 0 0 auto;
		width: 18px;  
		background: url('<?=base_url('assets/img/feed/splitter.png')?>') center center no-repeat #aaa5a5;
		min-height: 200px;
		cursor: col-resize;
		transition: all .3s ease-in-out;
	}
	.content-snippet	.splitter:hover {
		background-color: #ccc;
		border-radius: 3px;
	}
	.content-snippet	.panel-container {
		display: flex;
		flex-direction: row;
		overflow: hidden;
		height: 100%;
		min-height: 92vh;
		box-shadow: 0px 2px 5px rgba(0,0,0,0.5);
		xtouch-action: none;
	}
	/*SIDE LEFT*/
	.content-snippet .panel-left {
		flex: 0 0 auto;
		width: 50vw;
		min-width: 460px;
		max-width: 98%;
		background-color: #ccc;
	}	
	.content-snippet .nav-tabs {
		letter-spacing: 3px;
		background: #ccc;
		display: inline-block;
		border-bottom: none;
	}	
	.content-snippet .nav > li > a {
		padding: 5px 10px;
		min-width: 45px;
	}	
	.content-snippet .nav-tabs > li > a {
		text-shadow: none !important;
		color: #808080;
		margin-right: 0px;
		font-size: 1.3em;
		width: 100px;
		font-family: 'Fredoka One', cursive;
	}	
	.content-snippet .nav-tabs > li > a.mini {
		width: 50px;
	}
	.content-snippet .nav-tabs > li > a:hover {
		border-radius: 0px !important;
		text-shadow: none !important;
	}	
	.content-snippet .nav-tabs > li.active a,
	.content-snippet .nav-tabs > li.active a:focus,
	.content-snippet .nav-tabs > li.active a:hover {
		border-radius: 5px 5px 0 0;
		text-shadow: none !important;
		background: #5F5F5F;
		color: #f1f1f1;
		opacity: 1;
		cursor: pointer;
	}
	.content-snippet .tab-content {
		min-height: 85vh; 
		margin-top: -6px; 
		border-top: 2px solid #5F5F5F;
		border-radius: 0;
		background-color: #ECF0F5;
		position: relative;
	}	
	.content-snippet .tab-pane {
		height: 100%;
		width: 100%;
		overflow-y: hidden;
		overflow-x: hidden;
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 0;
		padding: 0;
	}	
	.content-snippet	.body-html, .content-snippet .body-css, .content-snippet .body-js {
		height: 85.8vh;
		padding: 0;
	}	
	/*SIDE RIGHT*/
	.content-snippet	.panel-right {
		flex: 1 1 auto;
		width: 100%;
		min-height: 200px;
		min-width: 400px;
		background: #fff;
	}
	.content-snippet .frame {
		width: 100%;
		height: 100%;
		border: none;
	}

	/*PANEL COMMENT*/
	.content-snippet .side-info {
		position: fixed;
		top: 8%;
		bottom: 1%;
		left: 20%;
		right: 20%;
		padding: 15px;
		width: 60%;
		background: #f1f1f1;
		transition: .4s ease-in-out;
		z-index: 2;
	}	
	.content-snippet .side-info-inner {
    overflow: auto;
    overflow-x: hidden;
    width: 100%;
    height: 99%;
    border: 2px solid #808080;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    padding: 10px;
    border-right: none;
}	
	.content-snippet .side-info.open {
		display: block;
	} 
	.content-snippet .row-info {
		/*height: 40vh;	*/
	}
	.content-snippet .info-desc {
		min-height: 200px;
		max-height: 200px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	.content-snippet .info-author {
		text-align: center;
		min-height: 305px;
		margin-left: -20px;
	}
	.content-snippet .info-link {
		margin-top: 5px;
    min-height: 100px;
	}	
	.content-snippet .info-like, .content-snippet .info-comment {
    margin-top: 5px;
    text-align: center;
	}
	.content-snippet .info-like {
		margin-right: -10px;
	}
	.content-snippet .info-comment {
		margin-left: -10px;
	}
	.content-snippet .info-like p, .content-snippet .info-comment p {
    margin: 0;		
	}
	.content-snippet .info-like span, .content-snippet .info-comment span {
    float: left;
	}	
	.content-snippet .info-desc, .content-snippet .info-author, .content-snippet .info-link, .content-snippet .info-like, .content-snippet .info-comment {
		border-radius: 5px;
		background: rgba(0,0,0,0.2);
		padding: 10px;
		color: #f1f1f1;
	}
	.content-snippet .btn-diss {
		position: absolute;
		z-index: 2;
	}
	.content-snippet .img-user-post {
		border-radius: 50%;
		width: 50px !important;
		height: 50px !important;
		float: left;
		top: 15px;
		position: absolute;		
	}



.content-snippet .row-comment {
    margin: 30px 0;
}
.content-snippet .btn-sm {
	padding: 0 10px;
}
.content-snippet .action {
	visibility: hidden;
}
.content-snippet .action.open {
	visibility: visible;
}
.content-snippet .direct-chat-info {
    display: block;
    margin-bottom: 2px;
    font-size: 18px;
}
.content-snippet .img-user-comm {
		display: block;
    border-radius: 50%;
    width: 60px !important;
    height: 60px !important;
    margin: 10px auto;
}
.content-snippet .time-stamp {
	font-size: 12px;
}
.content-snippet .direct-chat-text {
    border-radius: 5px;
    position: relative;
    padding: 5px 10px;
    background: #d2d6de;
    border: 1px solid #d2d6de;
    color: #444;
}
.content-snippet .direct-chat-text:before {
    border-width: 6px;
    margin-top: -6px;
}
.content-snippet .direct-chat-text:after, .content-snippet .direct-chat-text:before {
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
.content-snippet .right .direct-chat-info {
	text-align: right;
}
.content-snippet .right .direct-chat-text {
    margin-left: 0;
}
.content-snippet .direct-chat-text:after {
    border-width: 10px;
    margin-top: -5px;
}
.content-snippet .right .direct-chat-text:after, .content-snippet .right .direct-chat-text:before {
    right: auto;
    left: 100%;
    border-right-color: transparent;
    border-left-color: #d2d6de;
}





.content-snippet .box-comment {
	position: relative;
	margin: 50px 0;
}
.content-snippet .text-area:focus {
	background: #fff;
}
.content-snippet .submit-comment {
    width: 100%;
    min-height: 50px;
    border-radius: 7px;
    border: 2px solid #808080;
}
.content-snippet .error {
		position: absolute;
    top: -25px;
    width: 100%;
    text-align: center;
    font-size: 14px;
}
	/*============ TABLET ==============*/
		@media only screen and (max-width: 992px){
			section	.welcome .h-one {	font-size: 4em; }
			section .welcome h3 {	font-size: 2.5em; }
			section .welcome .h-two {	font-size: 4.5em; }
			section #typing a {	font-size: 1.5em; }
			.html-img {
		    max-width: 200px;
		    padding: 10px;
			}
			.login .border {
				border-right: none;
				border-bottom: 3px solid #3535D3;
			}
			.reset .border {
				border-right: none;
				border-bottom: 3px solid #3535D3;
			}
			.change .border {
				border-right: none;
				border-bottom: 3px solid #3535D3;
			}
			.register .border {
				border-right: none;
				border-bottom: 3px solid #449D44;
			}
			.content-snippet .side-info {
				right: 10%;
				left: 10%;
				width: 80%;
			}
		}
	/*============= MOBILE ==============*/
		@media only screen and (max-width: 768px) {

			section	.welcome .h-one {	font-size: 3.5em; }
			section .welcome h3 {	font-size: 2.2em; }
			section .welcome .h-two {	font-size: 4em; }
			section #typing a {	font-size: 1.2em; }

			article.introduction h2 { font-size: 2.5em;  }
			article .bg {	left: 7%;	right: 7%; }
			article .lets { font-size: 2.1em; }
			.desc-inner{
				left: 0;
				right: 0;
			}
			article.hello h1 {
				font-size: 2em;
			}	
			.blockquote { padding-top: 30px; padding-left: 40px; }
			.blockquote i { font-size: 70px; top: 40px; }
			.blockquote p { font-size: 20px; }
			.section h1 { font-size: 3em; }
			.title-ftg { font-size: 3em; }
			.content img { width: 250px; float: none; display: block; margin: 20px auto; padding: 10px; } 
			.list-browser, .list-editor { font-size: 16px; }
			.tabs-box a { display: block; }
			.list-snippet { font-size: 16px; }
			.list-snippet:hover { letter-spacing: 0px; }
			.content-snippet .side-info {
			  right: 5%;
			  left: 5%;
			  width: 90%;
			}
		}
</style>
<?php }
script_user();
?>
</head>
<body>
<?php loader(); ?>