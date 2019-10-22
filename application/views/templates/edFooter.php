
<div id="cats" style="display: none;"><?= $category ?></div>
<?php ace() ?>
<?php typing() ?>	
	<script src="<?= base_url('assets/js/fieldtoclipboard.js') ?>"></script>
	<script src="<?= base_url('assets/js/classie.js') ?>"></script>
	<script src="<?= base_url('assets/js/main.js') ?>"></script>
	<script src="<?= base_url('assets/js/prisma.js') ?>"></script>
	<!-- <script src="<?= base_url() ?>assets/js/js_tutorial.js"></script> -->

	<script type="text/javascript">
		function onScroll(event){
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
		// ACTIVE MENU
		$(function(){
			var url = window.location.pathname,
			urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
			$('.side-menu li a').each(function(){
				if(urlRegExp.test(this.href.replace(/\/$/,''))){
					$(this).addClass('act');
				}
			});
		});
		if (window.addEventListener) {              
			document.getElementById("jkdragbar").addEventListener("mousedown", function(e) {dragstart(e);});
			document.getElementById("jkdragbar").addEventListener("touchstart", function(e) {dragstart(e);});
			window.addEventListener("mousemove", function(e) {dragmove(e);});
			window.addEventListener("touchmove", function(e) {dragmove(e);});
			window.addEventListener("mouseup", dragend);
			window.addEventListener("touchend", dragend);
		}
		$(document).ready(function() {
			loading();			
			jkglobals.jkruncode();

			// DOCUMENT CONTENT
			$('.main-content p > a').addClass('base-link');
			$('.wrapper-content').after('<hr>');
			$('.wrapper-content i:last-of-type').after('<div class="clear"></div>');
			$('.img-right').after('<div class="clear"></div>');	

			$('.wrapper-content').attr('id', function(){
				return $(this).prev("h3").text().replace(/\s+/g, '-').toLowerCase();
			});
			var res = [];
			res = $('.wrapper-content').map(function(){
				return $.trim($(this).prev('h3').text());
			}).get();
			var result = "";
			for (var i = 0; i < res.length; i++) {
				result += "<a class='base-link' href='#" + res[i].toLowerCase().replace(/\s+/g, '-') + "'> "+ res[i].replace(/-/g, ' ') + "</a>";
			}
			$('#point').html(result);	
			$('.inner-desc').on("scroll", onScroll);
			
		 // SMOOTH SCROOL
		 $('a[href^="#"]').on('click', function (e) {
		 	e.preventDefault();
		 	$('.inner-desc').off("scroll");  
		 	$('#point a').each(function () {
		 		$(this).removeClass('active');
		 	});
		 	$(this).addClass('active');
		 	
		 	var target 	= this.hash,
		 	menu   	= target,
		 	$target = $(target);
		 	$('.inner-desc').stop().animate({
		 		'scrollTop': $target.offset().top+2
		 	}, 500, 'swing', function(){
		 		window.location.hash = target;
		 		$('.inner-desc').on("scroll", onScroll);
		 	});
		 });
		 var btn_in 	  = $('.btn-desc-left'),
		 btn_out 	= $('.btn-desc-right'),
		 boxDesc 	= $('.box-desc'),
		 overlay 	= $('.overlay'),
		 edit 			= ace.edit("jksourceCode"),
		 exe 			= $('.execute'),
		 codeTool 	= $('.code-toolbar'),
		 side_menu = $('.menu');
		 edit.setOptions({ tabSize: 2, useSoftTabs: true });
		 edit.setTheme("ace/theme/tomorrow_night");

		// TOGGLE DOCUMENTATION
		$(document).on("mousemove", function(e) {
			if(e.pageX < 40 && e.pageY > 50){
				btn_in.addClass('out');
			} else {
				btn_in.removeClass('out');
			}
		});

			// TOGGLE MENU
			$('.open-menu').click(function(){
				$(side_menu).toggleClass('out');
				$(overlay).addClass('block');
			});
			$('.closed-menu').click(function(){
				$(side_menu).addClass('out');
				$(overlay).removeClass('block');
			});

			// EXECUTE BUTTON
			codeTool.append('<button class="execute jello-horizontal">run code</button>');
			$('.execute').click(function() {
				var snippet = $(this).siblings('pre').children('code').text();
				edit.getSession().setValue(snippet);
				jkglobals.jkruncode();
				$(boxDesc).addClass('slide-out-left').removeClass('slide-in-left');
				setTimeout(descHide,1000);
			});

			// DOC BUTTON
			$(btn_in).on('click', function(){
				$(boxDesc).removeClass('hide slide-out-left').addClass('slide-in-left');
			});
			function descHide(){
				$('.box-desc').addClass('hide');
			}
			$(btn_out).on('click',function(){
				$(boxDesc).addClass('slide-out-left').removeClass('slide-in-left');
				setTimeout(descHide,1000);
			});

			// NEXT BUTTON
			var nextBtn  = $('#btn-next'),
			nextLink = $('#next');				
			nextBtn.on('click', function(){
				nextBtn.removeClass('jello-vertical');
				var ie = nextBtn.children('i');
				if($(nextLink).hasClass('hide')){
					nextLink.removeClass('hide');
					ie.removeClass('fas fa-question').addClass('fa fa-cog fa-spin')
					setTimeout(function(){
						ie.removeClass('fa fa-cog fa-spin').addClass('far fa-smile-beam')},3000);
				}
			});
		});		
	</script>
</body>
</html>