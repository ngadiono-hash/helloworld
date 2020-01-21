<?php 
reload_session();
$content = (isset($lesson['content']) ? $lesson['content'] : '' );
$description = read_more($content,250);
$keys = getTags($content, 'h3');
$keys = strtolower(implode(', ', $keys));
$keyword = 'belajar '.strtolower($lesson['category']).', belajar '.strtolower($lesson['level']).', '.strtolower($lesson['title']).', '. $keys;
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $lesson['title']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf" content="<?=$this->security->get_csrf_hash() ?>">
	<meta name="id" content="<?=$lesson['id']?>">
	<meta name="description" content="<?= $description ?>">
	<meta name="keywords" content="<?= $keyword ?>">
	<meta name="author" content="Hello World">
	<meta name ="revised" content ="Hello World, <?= date('m/d/Y',$lesson['update']) ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka+One|Rubik">
	<?php bootstrap().jqueryUi().myGlobal() ?>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/prisma.css">
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css">
	<?php script_user() ?>
	<style>
	html { font-size: 18px; }
	html, body {
		overflow-x: hidden;
	}
	/*============ ALL =================*/
	body { 
		color: #808080; 
		background: linear-gradient(135deg, #f5f5f5, #000000ab);
		/*font-family: Rubik, Sans-serif; */
		width: 100%;
		height: 100%;
		min-width: 640px;
		padding: 0;
		margin: 0;
		background: rgba(0, 0, 0, 0.5);
	}

	.overlay {
		position: fixed;
		display: none;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: rgba(0, 0, 0, 0.3);
		z-index: 10;
	}
	.overlay.block { display: block; }

	/*============ SIDENAV =============*/
	.menu { 
		width: 345px;
		border: 3px solid #ccc;
		border-left: none;
		background: linear-gradient(#fff, #ddd);
		position: fixed;
		top: 0;
		bottom: 0;
		z-index: 200;
		transition: ease-in-out 0.5s;
	}
	.menu.out { width: 0; opacity: 0; z-index: -1; }
	.menu-wrap {
		position: relative;
		height: 100%;
		top: -10px;
	}
	.backTo, .closed-menu {
		position: absolute;
		top: 10px;
		width: 40px;
		height: 37px;
		padding: 6px;
		font-size: 1.3rem;
		color: #808080;
		background: transparent;
		text-align: center;
	}
	.backTo {
		left: 0;    
	}
	.closed-menu {
		right: 0;
	}
	.closed-menu:hover,.backTo:hover{
		background: #ccc;
		color: #f1f1f1;
	}
	.control h4 { 
		font-family: 'Fredoka One', cursive; 
		text-align: center; 
		letter-spacing: 1px;
		position: absolute;
		left: 15%;
		right: 15%;
		top: 7px;
	}
	.side-menu { 
		box-sizing: border-box;
		list-style: none;
		position: absolute;
		width: 100%;
		top: 45px;
		bottom: 5px;
		padding: 10px 0;
		border-bottom: 2px solid #ccc;
		border-top: 2px solid #ccc;
		overflow-x: hidden;
		overflow-y: auto;
	}
	.side-menu li a { 
		padding: 8px 20px; 
		color: #808080; 
		font-size: .9rem; 
		display: block; 
		letter-spacing: 2px;
		text-align: left; 
		font-family: 'Fredoka One', cursive;
	}
	.side-menu li a:hover { 
		color: #f1f1f1; 
		transition: 0.3s ease-in-out;
		box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5) ;
	}
	.side-menu li .act {
		background-color: #ccc; 
		color: white; 
		text-shadow: 1px 1px 1px #fff, 0 0 5px blue, 0 0 5px lightblue;
		box-shadow: 0 6px 12px rgba(2,2,2,0.5);
	}
	
	/*============ TOOLBAR =============*/
	div#jktoolbar { 
		position: absolute; 
		top: 0; 
		left: 0; 
		z-index: 1; 
		width: 100%; 
	}
	div#jktoolbar ul { 
		margin-bottom: 0; 
		padding-left: 10px;
	}
	div#jktoolbar>ul>li>a { 
		padding: 10px; 
		border: none; 
		background: transparent; 
		color: #ccc; 
	}
	a.open-menu {
		position: absolute;
		top: 4px;
		left: 350px;
	}  
	div#jktoolbar>ul>li>a:active { box-sizing: border-box; }
	div#jktoolbar .select-style { 
		width: 70px; 
		height: 35px;
	}
	div#jktoolbar ul li select { 
		background: #f1f1f1; 
		color: #808080; 
		padding: 10px 5px; 
		border: none; 
		width: 70px; 
	}

	/*============ BROWSER WINDOW ======*/
	.container-window {
		height: 38px;
		width: 100%;
		position: absolute;
		background-color: #f1f1f1;
		border-bottom: 1px solid #808080;
	}
	.column-window {
		display: inline;
		width: 80%;
		
	}
	.dot {
		margin-top: 0px;
		height: 12px;
		width: 12px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block;
	}    
	.row-window {
		padding-left: 10px;
		position: relative;
	}
	.input-window {
		min-width: 10%;
		width: 80%;
		position: absolute;
		left: 65px;
		top: 3px;
		border-radius: 15px;
		border: none;
		background-color: white;
		color: #666;
		padding: 5px;
		padding-left: 15px;
		padding-right: 15px;
	}

	/*============ EDITOR ==============*/
	html.rowslayout #jkcodecontainer {
		padding: 0;
		height: 99%;
	}
	html.rowslayout iframe#jktargetCode {
		height: 90%;
	}
	html.rowslayout #jkcodeinput { padding-bottom: 3px; }
	.ace_content { margin-top: 0px; }
	#jkcodecontainer {
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		bottom: 0;
		background: #f1f1f1;
	}
	#jkcodeinput {
		height: 100%;
		padding-top: 37px;
	}

	#jkcodeoutput { 
		padding-left: 0px !important; 
		z-index: 2; 
		height: 100%;
	}
	div#jksourceCode {
		font-size: 16px;
	}

	div#jksourceCode, iframe#jktargetCode {
		height: 98%;
	}
	iframe#jktargetCode {
		border: 2px solid #eee;
		border-top: none;
		margin-top: 38px;
		height: 93%;
	}
	#jkdragbar {
		z-index: 99;
	}
	#dm {
		position: absolute;
		right: 25px;
		top: 50px;
		font-size: 1rem;
	}


	/*============ DESCRIPTION =========*/
	a.btn-desc-left {
		z-index: 99;
		padding: 5px;
		border: 3px solid #808080;
		border-left: none;    
		border-top-right-radius: 7px;
		border-bottom-right-radius: 7px;
		background: snow;
		padding: 5px 20px;
		font-size: 1.3rem;
		transition: 0.5s ease-in-out;
	}
	a.btn-desc-left {
		position: fixed;
		top: 50%;
		left: -45px;
		padding: 5px 10px;	
	}
	a.btn-desc-left:hover {
		color: #ccc;
		padding: 5px 25px;
		text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
		background-color: rgba(0,0,0,0.5); 
	}
	a.btn-desc-left.out {
		left: 0;
	}
	a.btn-desc-right {
		z-index: 99;
		position: absolute;
		top: 4px;
		right: 7px;	
	}
	a.open-col {
		position: absolute;
		top: 4px;
		left: 392px;
	}
	a.close-col {
		position: absolute;
		right: 5px;
	}
	a.btn-edit:hover, a.close-col:hover, a.open-col:hover, a.open-menu:hover, a.btn-desc-right:hover {
		color: #ccc;
		text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
		background-color: rgba(0,0,0,0.5);	
	}
	.btn-edit {
		position: absolute;
		top: 4px;
		background: yellow;
		right: 50px;
		width: 70px;
	}
	.box-desc {
		padding: 25px 0;
		position: absolute;
		top: 0;
		bottom: 0;
		right: 0;
		left: 0;
		border: 3px solid #808080;
		border-left: none;
		border-right: none;
		min-width: 500px;
		cursor: default;
		z-index: 100;
		overflow: hidden;
	}
	.inner-desc { 
		margin-top: 20px;
		padding: 0 5px;
		padding-left: 350px;
		overflow-y: auto;
		background: #f1f1f1; 
		height: 99%;
		box-shadow: 1px 2px 6px rgba(0, 0, 0,0.5);
		min-width: 500px;
	}

	.main-content { 
		/*font-family: Rubik, Sans-serif; */
		/*padding: 50px 10px;*/
	}
	.main-title { 
		margin-top: -25px;
		margin-bottom: -10px;
		padding-left: 350px;
		color: #f1f1f1;
		text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
	}
	.second-title {
		text-align: center;
		font-family: 'Fredoka One', cursive;
	}  
	.info-desc {
		margin-bottom: 20px;
	}
	.info-desc i { color: #2e2c2c; margin-right: 5px; }
	.info-desc p { 
		padding: 5px;
		/*color: #fff;*/
		margin-bottom: 0px;
		text-align: left;
		font-size: 1rem;
		font-family: 'Fredoka One', cursive;
		letter-spacing: 1.5px;
	}
	.info-desc a {
		margin-left: 26px;
	}
	.info-desc span { 
		/*color: #f1f1f1;*/
		margin-left: 32px;
		font-size: .9rem;
	}
	.col-left {
		width: 350px;
		z-index: 1;
		background: linear-gradient(#fff, #ddd);
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0px;
		padding: 5px;
		padding-left: 15px;
	}
	.col-left hr {
		border-top: 2px solid #a09292;
	}
	#point {
		overflow-y: auto;
		overflow-x: hidden;
		height: 50%;
	}
	#point h5 {
		margin: 0;
	}
	#point a {
		display: inline-block;
		font-size: .9rem;
		padding: 5px;
		margin-right: -5px;
		font-family: 'Fredoka One', cursive;
	}
	#point a:hover {
		letter-spacing: 2px;
	}
	#point a.active {
		text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
		color: lightblue;
		letter-spacing: 2px;
		text-align: center;
		pointer-events: none;
	}
	#point a.active::after {
		content: '';
		display: block;
		width: 0;
		height: 2px;
		background: royalblue;
		transition: width .3s;
		width: 100%;
	}	
	.main-content h3 { 
		font-family: 'Fredoka One', Sans-Serif; 
		letter-spacing: 2px;
		margin-bottom: -5px;
		margin-left: -1px;
		font-size: 2em;
		text-align: center;
		padding: 15px 25px 10px 30px;
		display: inline-block;
		border-radius: 10px;
		color: #eee;
	}  
	.main-content .wrapper-content {
		margin-top: -50px;
		margin-left: -1px;
		padding: 50px 20px;
		border-radius: 10px;
		border-top-left-radius: 0;
		border-top: none;
		border-right: none;
		box-shadow: 3px 3px 6px rgba(0,0,0,0.5);
	}  
	.execute {
		background-color: white;
		border: 2px solid #808080;
		border-radius: 25px;
		padding: 5px 10px;
		font-family: 'Fredoka One', cursive;
		font-size: 1em;
		box-sizing: border-box;
		transition: ease-in 0.4s;
		position: absolute;
		top: 6px;
		right: 12px;
	}
	.execute:hover{ 
		padding: 5px 15px;
		color: #f1f1f1; 
		text-shadow: 1px 1px 1px #fff, 0 0 10px blue, 0 0 5px lightblue;
	}
	.main-content .note {
		position: relative;
		background: #DEDEDE;
		min-height: 100px;
		padding: 10px 15px 10px 75px;
		margin: 40px 10px;
		font-family: 'Fredoka One', cursive;
		font-size: .8rem;
		line-height: 1.8;
		border-radius: 5px;
		box-shadow: 2px 3px 3px rgba(0,0,0,0.5);
	}
	.main-content .note::before {
		font-family: "Font Awesome 5 Free"; 
		content: "\f06a";
		font-weight: 1000;
		font-size: 30px;
		background: #8BA8AF;
		color: #f1f1f1;
		display: inline-block;
		padding: 20px 15px;
		text-shadow: 1px 2px 2px rgba(0,0,0,0.5);
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
	}
	.main-content hr {
		margin: 20px 60px;
		margin-bottom: 60px;
		box-shadow: 1px 1px 2px rgba(0,0,0,0.5);
		border-top: 1px solid #eee;
	}
	.wrapper-content i { float: right; }
	.wrapper-content .fab { font-size: 1.8em; color: limegreen; margin-bottom: 10px; margin-top: -10px; }
	.wrapper-content .fab.un { color: crimson; }
	.wrapper-content a.base-link {
		font-size: .9rem;
		color: royalblue;
		text-shadow: none;
	}
	.wrapper-content a.base-link:hover { color: #34b6e0; }


	/*============ FOOTER ==============*/
	.main-footer {
		padding: 20px 10px;
	}
	.main-footer .right-side {
		border: 2px solid #DEDEDE;
		border-radius: 10px;
		text-align: center;
		padding: 20px 10px;
		min-height: 295px;
		margin: 10px;
		background-image: linear-gradient(#fff, #ddd);
	}
	.main-footer .right-side .next-lesson {
		text-align: center;
		font-size: 25px;
		font-family: 'Fredoka One', cursive;
		line-height: 1.5;
		color: #eee;
		letter-spacing: 2px;
	}
	.main-footer .right-side .button {
		min-width: 100px;
		font-size: 20px;
		padding: 5px;
	} 
	#next p {
		text-align: center;
		font-family: 'Fredoka One', cursive;
		font-size: 1rem;
		color: #eee;
		line-height: 1.5;
	}
	.main-footer .right-side a {
		font-size: 1rem;
	}

	/*============ ADD CONTENT =========*/
	.main-content code { background-color: transparent; }
	.main-content .img-left { float: left; margin-left: 100px; }
	.main-content .img-right { float: right; margin-right: 100px; }
	.main-content .clear { clear: both; content: ''; }
	.main-content h4 { font-family: 'Fredoka One', cursive; margin-top: 30px; }
	.toolbar-item a { display: none; }
	.main-content p { font-size: .9rem; line-height: 2; text-align: justify; }
	.main-content p.reff { text-align: left; }
	.main-content p img { display: block; margin: 0 auto; }
	.main-content li { font-size: .9rem; line-height: 2; }
	.main-content em { font-weight: 600; font-style: normal; }
	.main-content .table thead tr th { text-align: center !important; text-transform: capitalize !important; }
	.code-toolbar { max-width: 800px; margin: 10px auto; }
	.main-content pre { overflow: auto; max-height: 480px; max-width: 800px; margin: 10px auto; box-shadow: 1px 2px 2px rgba(0,0,0,0.5); }
	.html-attr, .css-code { font-weight: bold; font-size: .8rem; font-family: Consolas; }
	.html-attr { color: #90ca1c;  }
	.css-code { color: #18c4e7; font-style: italic; }

	/*==================================*/
	/*============ ADD CONTENT =========*/
	.toolEditor ul li a:active, 
	.toolEditor ul li a:hover, 
	.toolEditor ul li select:hover,
	.toolEditor ul li select:focus,
	.toolEditor ul li a.selectedtool { 
		background: <?= $lesson['tmLight']; ?> !important;
	}
	.execute:hover{ 
		border: 2px solid <?= $lesson['tmDark'] ?>; 
		background: <?= $lesson['tmDark'] ?>; 
		text-shadow: none !important;
	}
	.box-desc, .side-menu li a:hover { background: <?= $lesson['tmLight'] ?>; }  
	.col-left { border-right: 5px solid <?= $lesson['tmLight'] ?>; }
	.main-content .wrapper-content { border: 10px solid <?= $lesson['tmLight']; ?>; border-top: none; border-right: none; }
	.main-content h3 { border-top: 10px solid <?= $lesson['tmLight'] ?>; } 
	.main-content h3, .main-footer .right-side .next-lesson, #next p
	{ text-shadow: -1px -1px 0 <?= $lesson['tmDark']; ?>, 1px -1px 0 <?= $lesson['tmDark']; ?>, -1px 1px 0 <?= $lesson['tmDark']; ?>, 1px 1px 0 <?= $lesson['tmDark']; ?>; }  

	/*============ MEDIUM ==============*/
	@media only screen and (max-width: 992px) {
		html { font-size: 17px; }
		.main-title {
			margin-top: -20px;
			font-size: 2em;
			padding-left: 0px;
		}
		.main-content .img-left { float: none; margin: 10px auto; display: block; }
		.main-content .img-right { float: none; margin: 10px auto; display: block; }
		.inner-desc { padding-left: 5px; }
		a.open-menu { left: 5px; }
		a.open-col { left: 47px; }
	}
	/*============ SMALL ==============*/	
	@media only screen and (max-width: 768px) {
		html { font-size: 15px; }
		.main-title {
			display: none;
		}
	}
	
</style>

</head>
<body>
	<?php loader(); ?>