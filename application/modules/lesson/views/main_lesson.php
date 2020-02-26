<!-- 
<style>
	.doc {
    position: absolute;
    z-index: 99;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 10px;
	}
	.output {
		height: 100%;
		width: 100%;
	}
	.lesson-left, .lesson-menu {
		position: absolute;
    width: 350px;
    top: 0;
    bottom: 0;
	}
	.lesson-right {
		margin-left: 350px;
		height: 100%;
	}
	.cubic-left {
		height: 100%;
		padding: 10px;
		border-radius: 0;
	}
	.cubic-right {
		height: 100%;
		overflow-y: auto;
		padding: 20px;
		border-radius: 0;
	}
	.lesson-menu {
		z-index: 100;
		margin: 10px 0;
	}
	.lesson-menu .cubic {
		height: 100%;
		overflow-y: auto;
		border-radius: 0;
	}
	.lesson-menu a {
		padding: 8px 20px;
		color: #808080;
		font-size: 1em;
		display: block;
		letter-spacing: 1px;
		text-align: left;
		font-family: 'Fredoka One', cursive;
	}
	.lesson-menu a:hover {
		transition: 0.3s ease-in-out;
		box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5) ;
	}
	.lesson-menu .active {
		background-color: #ccc;
		color: white;
		text-shadow: 1px 1px 1px #fff, 0 0 5px blue, 0 0 5px lightblue;
		box-shadow: 0 6px 12px rgba(2,2,2,0.5);
	}
	.lesson-left hr {
		border-top: 2px solid #a09292;
	}
	#point {
		overflow-y: auto;
		overflow-x: hidden;
		height: 70%;
	}
	#point h5 {
		margin: 0;
	}
	#point a {
		display: inline-block;
		font-size: 1.2em;
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


	.img-left { float: left; margin-left: 100px; }
	.img-right { float: right; margin-right: 100px; }
	.clear { clear: both; content: ''; }
	.main-lesson h2, .main-lesson h3 {
		font-family: 'Fredoka One',cursive;
		text-shadow: -1px -1px 0 #909193, 1px -1px 0 #909193, -1px 1px 0 #909193, 1px 1px 0 #909193;
		color: #f5efef;
		font-size: 1.2em;
	}
	.cubic-right h3 { font-size: 1.5em; }
	.cubic-right h3, .cubic-right h4 { font-family: 'Fredoka One',cursive; margin-top: 30px; }
	.cubic-right .wrapper-content {
		border: 3px solid;
		box-shadow: 2px 3px 3px rgba(0,0,0,0.5);
    padding: 5px 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-left: none;
	}
	.cubic-right li, .cubic-right p { margin: 0; font-size: 1.2em; line-height: 1.5; text-align: justify; }
	.cubic-right p.reff { text-align: left; }
	.cubic-right p img { display: block; margin: 20px auto; }
	.cubic-right em { font-weight: 600; font-style: normal; }
	.cubic-right .table thead tr th { text-align: center !important; text-transform: capitalize !important; }

	code { background-color: transparent; }
	.html-attr, .css-code { font-weight: bold; font-size: 80%; font-family: Consolas; }
	.html-attr { color: #90ca1c; }
	.css-code { color: #18c4e7; font-style: italic; }

	.code-toolbar {
		max-width: 800px;
		margin: 10px auto;
		margin-bottom: 30px;
		position: relative;
	}
	.cubic-right pre { overflow: auto; max-height: 480px; max-width: 800px; margin: 10px auto; box-shadow: 1px 2px 2px rgba(0,0,0,0.5); }
	.cubic-right code[class*="language-"], pre[class*="language-"] {
	  line-height: 1.2;
	}
	pre[class*="language-"] { padding: .4em; }
	:not(pre) > code[class*="language-"] {
    padding: 1px 5px;
    border-radius: 5px;
    white-space: normal;
    font-size: 80%;
	}
	.execute {
		font-family: 'Fredoka One', cursive;
		font-size: .8em;
		padding: 1px 10px !important;
		transition: ease-in 0.4s;
		position: absolute;
		top: 6px;
		right: 12px;
	}
	.execute:hover{
		background: burlywood !important;
	}
	.cubic-right .note {
		position: relative;
		background: #DEDEDE;
		min-height: 100px;
		padding: 10px 15px 10px 75px;
		margin: 40px 10px;
		font-family: 'Fredoka One', cursive;
		line-height: 1.8;
		border-radius: 5px;
		box-shadow: 2px 3px 3px rgba(0,0,0,0.5);
	}
	.cubic-right .note::before {
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
	.editable-result .cubic-right {
		height: 89vh;
	}
</style>
 -->
<?php $tags = getTags($lesson['content'],'h3') ?>
<div class="main-lesson" data-id="<?=$lesson['id']?>">
	<div class="panel-container">
		<div id="menu" class="lesson-menu out" style="display: none;">
			<div class="cubic">
			<?php foreach ($lesson['menu'] as $k) { ?>
				<a href="<?=base_url('lesson/').$lesson['category'].'/'.$k['meta'] ?>"><?=$k['title']?></a>
			<?php } ?>
			</div>
		</div>
		<div id="doc" class="doc" style="display: none;">
			<div class="lesson-left">
				<div class="cubic cubic-left">
					<h2 class="center" style="margin-bottom: 5px"><?php echo $lesson['titles']?></h2>
					<h3 class="center" style="margin-top: 0"><?php echo $lesson['title']?></h3>
					<hr>
					<div id="point">
						<?php for ($i = 0; $i < count($tags); $i++) { ?>
						<h5><a href="#<?=strtolower(str_replace(' ','_',$tags[$i]))?>"><?=$tags[$i]?></a></h5>
						<?php } ?>
					</div>
					<div class="authorized center">
						<span>Administrator on </span><span><?=date('d M Y',$lesson['upload'])?></span>
					</div>
				</div>
			</div>
			<div class="lesson-right">
				<div class="cubic cubic-right">
					<?php echo $lesson['content']?>
				</div>
			</div>
		</div>
		<div class="panel-left">
			<div class="editable-source" style="display: none;"></div>
			<div class="editor">
				<ul class="nav nav-tabs control-left">
					<li class="run"><a class="mini" id="run"><i class="fa fa-play fa-fw"></i></a></li>
					<li><a class="mini" id="liveEdit"><i class="fa fa-sync fa-fw"></i></a></li>
					<li><a class="mini" id="wraps"><i class="fa fa-home fa-fw"></i></a></li>
				</ul>
				<div class="tab-content">
				<div id="first" class="tab-pane fade in active">
					<div class="body-html" id="source-code"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="splitter"></div>
		<div class="panel-right">
			<div class="editable-result" style="display: none;"></div>
			<div class="output">
				<div id="dm"></div>
				<iframe class="frame" id="result-frame"></iframe>
			</div>
		</div>
	</div>
</div>
<?php if(check_admin()) { ?>
<script>
	$('#edit-this').on('click',function(){
		$('.panel-left').css('width','33vw');
		startAjax('#edit-this');
		$('#save-this,#close-this').fadeIn();
		$('.editor,.output').fadeOut();
		$('.editable-source,.editable-result').fadeIn();
		$(this).fadeOut();
		$.ajax({
			url : host + 'xhra/getTutorial',
			data : { id : $('.main-lesson').data('id') },
			method : 'POST',
			success : function(data){
				var datas = $.parseJSON(data);
				$('.editable-source').html(
					`<form id="edit-inline">` +
					`<input type="hidden" name="id" value="`+$('.main-lesson').data('id')+`">` +
					`<textarea id="text-editor" name="desc">`+datas['left']+`</textarea>`+
					`</form>`
				);
				CKEDITOR.replace('text-editor');
				$('.editable-result').html(`<div class="cubic cubic-right">`+datas['right']+`</div>`);
				addContent();
				$('.editable-result').find('pre').addClass('language-html');
			},
			complete : function(){ endAjax('#edit-this') }
		});
	});
	$('#save-this').on('click',function(){
		startAjax('#save-this');
		var words = $('#cke_wordcount_text-editor').text().replace(',','');
		words = words.split(' ');
		words = words[3];
		for (instance in CKEDITOR.instances){
			CKEDITOR.instances[instance].updateElement();
		}
		var data = $('#edit-inline').serialize()+'&'+$.param({ count_words: words });
		$.ajax({
			url : host + 'xhra/inline_tutorial',
			data : data,
			method : 'POST',
			success : function(data){
				var datas = $.parseJSON(data);
				$('.editable-result').html(`<div class="cubic cubic-right">`+datas+`</div>`);
				addContent();
				$('.editable-result').find('pre').addClass('language-html');
			},
			complete : function(){ endAjax('#save-this') }
		});
	});
	$('#close-this').on('click',function() {
		$('#save-this,#close-this').fadeOut();
		$('#edit-this,.editor,.output').fadeIn();
		$('.editable-source,.editable-result').empty();
	});
</script>
<?php } ?>
<script>
	function addContent(){
		$('.editable-result .code-toolbar').append('<button class="execute btn btn-sm">run code</button>');
		$('.editable-result p > a').addClass('base-link');
		$('.editable-result li > a').addClass('base-link');
		$('.editable-result .wrapper-content').after('<hr>');
		$('.editable-result .wrapper-content i:last-of-type').after('<div class="clear"></div>');
		$('.editable-result .img-right').after('<div class="clear"></div>');
	}
	function runCode(delay){
		var plainText = '';
	  plainText += source.getValue();
	  delay = delay || 0;
    var timer = null;
    if (timer) clearTimeout(timer);
    timer = setTimeout(function() {
      timer = null;
		  resultFrame.open();
		  resultFrame.writeln(plainText);
		  resultFrame.close();
    }, delay);
	}
	function onScroll(){
		var scrollPos = $(document).scrollTop();
		$('#point a').each(function () {
			var currentLink = $(this);
			var div = $(currentLink.attr("href"));
			if ((div.position().top -200) < scrollPos && (div.position().top -200) + div.outerHeight() > scrollPos) {
				$(currentLink).removeClass("active");
				$(currentLink).addClass("active");
			}else{
				$(currentLink).removeClass("active");
			}
		});
	}
	let use = { liveEdit: false }
	let opt = {
		showFoldWidgets: true,
		showLineNumbers: true,
		showPrintMargin: false,
		minLines: 2,
		wrap: false,
		fontSize: 15,
		tabSize: 2,
		highlightActiveLine: true,
		highlightSelectedWord: true,
		enableBasicAutocompletion: true,
		enableLiveAutocompletion: true,
		enableSnippets: true
	}
	let source = ace.edit('source-code');
	let resultFrame = document.getElementById('result-frame').contentWindow.document;
	source.setOptions(opt);
	source.session.setMode("ace/mode/html");
	source.setTheme("ace/theme/tomorrow_night");
	if (window.addEventListener) {
		$("#wraps").on("click", function() {
			source.setOptions({
				wrap: true,
			});
		});
		$("#liveEdit").on("click", function() {
	    use.liveEdit ? use.liveEdit = false : use.liveEdit = true;
	    $(this).parent('li').toggleClass("active");
	    $(this).find('i').toggleClass('fa-pause fa-sync');
	   	$(this).parent('li').siblings('.run').toggleClass('hide');
	  });
		$('#run').on('click', function() {
	  	var a =  $(this).parent('li');
	    a.addClass("active");
			setTimeout(function() {
			  a.removeClass('active');
			}, 300);
			runCode();
		});
		$('#source-code').on('keyup',function() {
			if(use.liveEdit) runCode(1000);
		});
		$('.splitter').on('mousedown',function(e){
			dragstart(e);
		});
		$(window).on('mousemove',function(e){
			dragmove(e,'result-frame');
		});
		$(window).on('mouseup',function(e){
			dragend();
		});
	}
	
	
	$(function(){
		runCode();
		$('.cubic-right').on("scroll", onScroll);
		$(".panel-left").resizable({
			handleSelector: ".splitter",
			resizeHeight: false
		});
		$('.code-toolbar').append('<button class="execute btn btn-sm">run code</button>');
		$('.lesson-right p > a').addClass('base-link');
		$('.lesson-right li > a').addClass('base-link');
		$('.wrapper-content').after('<hr>');
		$('.wrapper-content i:last-of-type').after('<div class="clear"></div>');
		$('.img-right').after('<div class="clear"></div>');
		$('.execute').click(function() {
			var snippet = $(this).siblings('pre').children('code').text();
			source.getSession().setValue(snippet);
			runCode();
			$('#doc').fadeOut().removeClass('scale-in-center');
		});
		$('.wrapper-content').attr('id', function(){
			return $(this).prev('h3').text().replace(/\s+/g, '_').toLowerCase();
		});
		$('#point a').on('click', function (e) {
		 	e.preventDefault();
		 	$('.cubic-right').off("scroll");
		 	$('#point a').each(function() {
		 		$(this).removeClass('active');
		 	});
		 	$(this).addClass('active');
		 	var target 	= this.hash;
		 	var $target = $(target);
		 	$('.cubic-right').stop().animate({
		 		'scrollTop': $target.offset().top
		 	}, 500,'swing', function(){
		 		window.location.hash = target;
		 		$('.cubic-right').on("scroll", onScroll);
		 	});
		});
		$('#open-doc').on('click',function(){
			if ($('#doc').hasClass('scale-in-center')) {
				$(this).removeClass('active');
				$('#doc').fadeOut().removeClass('scale-in-center');
			} else {
				$(this).addClass('active');
				$('#doc').fadeIn().addClass('scale-in-center');
			}
		});
		$('#open-menu').on('click',function(){
			$(this).toggleClass('active');
			$('#menu').toggleClass('out');
			if ($('#menu').hasClass('out')) {
				$('#menu').addClass('slide-out-left').removeClass('slide-in-left').fadeOut();
			} else {
				$('#menu').addClass('slide-in-left').removeClass('slide-out-left').fadeIn();
			}
		});

	});

</script>
